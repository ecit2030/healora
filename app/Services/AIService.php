<?php

namespace App\Services;

class AIService
{
    public function predictCongestion(int $currentOccupancy): array
    {
        $predictions = [];
        $value = $currentOccupancy;

        for ($hour = 1; $hour <= 12; $hour++) {
            $value += random_int(-4, 6);
            $value = max(45, min(98, $value));

            $predictions[] = [
                'hour' => $hour,
                'occupancy' => $value,
            ];
        }

        return $predictions;
    }

    public function generateRecommendations(int $occupancy, int $boardingPatients, int $availableBeds): array
    {
        $recommendations = [];

        if ($occupancy > 85) {
            $recommendations[] = 'Reallocate 2 nurses to ED to reduce triage queue pressure.';
            $recommendations[] = 'Open fast-track pathway for lower-acuity cases.';
        }

        if ($boardingPatients > 18) {
            $recommendations[] = 'Prioritize discharge of 6 stable inpatients before 4 PM.';
            $recommendations[] = 'Activate bed turnover team for rapid room readiness.';
        }

        if ($availableBeds < 15) {
            $recommendations[] = 'Delay non-urgent OR cases for the next 2 hours.';
        }

        if ($recommendations === []) {
            $recommendations[] = 'Maintain current staffing and monitor demand shift every 10 minutes.';
            $recommendations[] = 'Prepare surge playbook if occupancy trend rises above baseline.';
        }

        return $recommendations;
    }

    public function generateAlerts(int $occupancy, int $boardingPatients, int $waitTime): array
    {
        $alerts = [];

        if ($occupancy > 90) {
            $alerts[] = 'ED occupancy > 90% soon';
        }

        if ($boardingPatients > 20) {
            $alerts[] = 'Exit Block risk high';
        }

        if ($waitTime > 75) {
            $alerts[] = 'Average wait time crossing critical threshold';
        }

        if ($alerts === []) {
            $alerts[] = 'Operations stable - no critical alerts';
        }

        return $alerts;
    }
}
