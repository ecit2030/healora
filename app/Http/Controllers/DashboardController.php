<?php

namespace App\Http\Controllers;

use App\Services\AIService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly AIService $aiService)
    {
    }

    public function index(): View
    {
        $metrics = $this->buildMetrics();

        return view('dashboard', $metrics);
    }

    public function data(): JsonResponse
    {
        return response()->json($this->buildMetrics());
    }

    private function buildMetrics(): array
    {
        $occupancy = random_int(68, 96);
        $boardingPatients = random_int(10, 28);
        $availableBeds = random_int(6, 35);
        $waitTime = random_int(24, 95);

        return [
            'ed_occupancy' => $occupancy,
            'boarding_patients' => $boardingPatients,
            'available_beds' => $availableBeds,
            'avg_wait_time' => $waitTime,
            'predictions' => $this->aiService->predictCongestion($occupancy),
            'recommendations' => $this->aiService->generateRecommendations(
                $occupancy,
                $boardingPatients,
                $availableBeds
            ),
            'alerts' => $this->aiService->generateAlerts($occupancy, $boardingPatients, $waitTime),
            'updated_at' => now()->format('H:i:s'),
        ];
    }
}
