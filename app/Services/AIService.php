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
            $recommendations[] = 'Now: Reallocate 2 nurses from Ward B to ED triage.';
            $recommendations[] = 'Next 1h: Open fast-track pathway for lower-acuity cases.';
        }

        if ($boardingPatients > 18) {
            $recommendations[] = 'Next 30 min: Prioritize discharge of 6 medically ready patients.';
            $recommendations[] = 'Next 1h: Activate bed turnover team for rapid room readiness.';
        }

        if ($availableBeds < 15) {
            $recommendations[] = 'Next 1h: Delay non-urgent OR slot and release recovery beds.';
        }

        if ($recommendations === []) {
            $recommendations[] = 'Now: Maintain current staffing model and monitor every 10 minutes.';
            $recommendations[] = 'Next 2 hrs: Prepare surge intake if occupancy trend accelerates.';
        }

        return $recommendations;
    }

    public function generateAlerts(int $occupancy, int $boardingPatients, int $waitTime): array
    {
        $alerts = [];

        if ($occupancy > 90) {
            $alerts[] = 'High: ED occupancy projected to cross 90% in 70 minutes.';
        }

        if ($boardingPatients > 20) {
            $alerts[] = 'High: Boarding queue may exceed safe limit in 2 hours.';
        }

        if ($waitTime > 75) {
            $alerts[] = 'Medium: Bed turnover delay detected in medical unit.';
        }

        if ($alerts === []) {
            $alerts[] = 'Low: Discharge coordination improving after intervention.';
        }

        return $alerts;
    }
}
