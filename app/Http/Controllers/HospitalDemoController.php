<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HospitalDemoController extends Controller
{
    public function index(): View
    {
        return view('hospitals.index', [
            'hospitals' => self::hospitalRows(),
            'hospitalNav' => self::navItems(),
            'opsNetworkFlow' => self::networkPatientFlowSummary(),
        ]);
    }

    public function show(string $hospital): View
    {
        $row = $this->find($hospital);
        if ($row === null) {
            throw new NotFoundHttpException;
        }

        return view('hospital-demo', [
            'hospital' => $row,
            'hospitalNav' => self::navItems(),
            'opsNetworkFlow' => self::networkPatientFlowSummary(),
        ]);
    }

    /**
     * Demo-only: mean stuck and near-discharge counts per hospital across the configured network.
     *
     * @return array{
     *     hospital_count:int,
     *     total_stuck:int,
     *     total_near_discharge:int,
     *     avg_stuck:float,
     *     avg_near_discharge:float,
     *     avg_combined:float,
     *     solution:string
     * }
     */
    public static function networkPatientFlowSummary(): array
    {
        $rows = self::hospitalRows();
        $n = count($rows);
        if ($n === 0) {
            return [
                'hospital_count' => 0,
                'total_stuck' => 0,
                'total_near_discharge' => 0,
                'avg_stuck' => 0.0,
                'avg_near_discharge' => 0.0,
                'avg_combined' => 0.0,
                'solution' => 'Add demo hospitals in config to see network patient-flow averages.',
            ];
        }

        $totalStuck = 0;
        $totalNear = 0;
        foreach ($rows as $h) {
            $flow = $h['patient_flow'] ?? [];
            $totalStuck += count($flow['stuck'] ?? []);
            $totalNear += count($flow['discharge_ready'] ?? []);
        }

        $avgStuck = round($totalStuck / $n, 1);
        $avgNear = round($totalNear / $n, 1);
        $avgCombined = round(($totalStuck + $totalNear) / $n, 1);

        return [
            'hospital_count' => $n,
            'total_stuck' => $totalStuck,
            'total_near_discharge' => $totalNear,
            'avg_stuck' => $avgStuck,
            'avg_near_discharge' => $avgNear,
            'avg_combined' => $avgCombined,
            'solution' => self::networkPatientFlowSolution($avgStuck, $avgNear, $avgCombined),
        ];
    }

    private static function networkPatientFlowSolution(float $avgStuck, float $avgNear, float $avgCombined): string
    {
        if ($avgCombined >= 5.5) {
            return 'Network pressure is high: hold a cross-site huddle on pharmacy, boarding, and discharge documentation.';
        }
        if ($avgStuck >= 3.0) {
            return 'Stuck patients are elevated: prioritize ED length-of-stay, meds verification, and bed placement across sites.';
        }
        if ($avgNear >= 3.0) {
            return 'Near-discharge volume is elevated: align pharmacy STAT tasks and final sign-offs in one daily pass.';
        }
        if ($avgStuck > $avgNear + 0.5) {
            return 'Throughput skews toward delays in care: clear stuck patients before adding discharge capacity.';
        }
        if ($avgNear > $avgStuck + 0.5) {
            return 'Discharge pipeline is busy: keep pharmacy and transport ahead of ETAs to avoid last-minute blocks.';
        }

        return 'On average, flow is balanced across the demo network; keep monitoring each site on Hospital Charts.';
    }

    /**
     * @return list<array{slug:string,name:string,short:string,city:string,logo?:string}>
     */
    public static function navItems(): array
    {
        return array_map(static function (array $h): array {
            return Arr::only($h, ['slug', 'name', 'short', 'city', 'logo']);
        }, self::hospitalRows());
    }

    /**
     * @return list<array<string,mixed>>
     */
    private static function hospitalRows(): array
    {
        return config('demo_hospitals.hospitals', []);
    }

    /**
     * @return array<string,mixed>|null
     */
    private function find(string $slug): ?array
    {
        foreach (self::hospitalRows() as $row) {
            if (($row['slug'] ?? null) === $slug) {
                return $row;
            }
        }

        return null;
    }
}
