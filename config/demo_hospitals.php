<?php

/**
 * Demo hospital directory. `logo` paths are under /public (see asset()).
 * KFSH, SFH, and DSFH marks are user-supplied emblem PNGs; other logos as noted.
 * Trademark rights remain with the respective institutions.
 */
return [
    'hospitals' => [
        [
            'slug' => 'king-faisal-specialist',
            'name' => 'King Faisal Specialist Hospital',
            'short' => 'KFSH',
            'city' => 'Riyadh',
            'logo' => 'hospitals/king-faisal-specialist.png',
            'beds' => 1_250,
            'metrics' => ['ed_occupancy' => 78, 'boarding' => 14, 'avg_wait' => 38, 'prediction' => 96],
            'patient_flow' => [
                'stuck' => [
                    ['patient_name' => 'Mohammed Al-Otaibi', 'zone' => 'ED-7', 'los_hours' => 5.25, 'meds_received' => false],
                    ['patient_name' => 'Noura Al-Ghamdi', 'zone' => 'ED-2', 'los_hours' => 4.1, 'meds_received' => true],
                    ['patient_name' => 'Fahad Al-Shehri', 'zone' => 'FastTrack-1', 'los_hours' => 3.4, 'meds_received' => false],
                ],
                'discharge_ready' => [
                    ['patient_name' => 'Abdullah Al-Qahtani', 'zone' => 'OBS-4', 'minutes_to_dc' => 22, 'meds_received' => true],
                    ['patient_name' => 'Hind Al-Mutairi', 'zone' => 'ED-1', 'minutes_to_dc' => 48, 'meds_received' => false],
                    ['patient_name' => 'Saad Al-Dosari', 'zone' => 'Hall-B', 'minutes_to_dc' => 15, 'meds_received' => true],
                ],
            ],
            'series' => [
                'ed_census' => [42, 45, 51, 58, 64, 71, 68, 62, 59, 55, 53, 61],
                'ward_stress' => [22, 35, 28, 41, 33, 26],
                'risk_mix' => [48, 35, 17],
            ],
        ],
        [
            'slug' => 'security-forces-riyadh',
            'name' => 'Security Forces Hospital',
            'short' => 'SFH',
            'city' => 'Riyadh',
            'logo' => 'hospitals/security-forces-riyadh.png',
            'beds' => 680,
            'metrics' => ['ed_occupancy' => 74, 'boarding' => 12, 'avg_wait' => 41, 'prediction' => 95],
            'patient_flow' => [
                'stuck' => [
                    ['patient_name' => 'Khalid Al-Zahrani', 'zone' => 'ED-4', 'los_hours' => 4.75, 'meds_received' => false],
                    ['patient_name' => 'Reem Al-Anzi', 'zone' => 'ED-9', 'los_hours' => 3.9, 'meds_received' => false],
                ],
                'discharge_ready' => [
                    ['patient_name' => 'Yousef Al-Harbi', 'zone' => 'OBS-2', 'minutes_to_dc' => 30, 'meds_received' => true],
                    ['patient_name' => 'Lina Al-Baqmi', 'zone' => 'ED-6', 'minutes_to_dc' => 60, 'meds_received' => false],
                ],
            ],
            'series' => [
                'ed_census' => [39, 42, 46, 52, 59, 65, 63, 58, 54, 50, 48, 55],
                'ward_stress' => [20, 32, 27, 36, 29, 23],
                'risk_mix' => [49, 37, 14],
            ],
        ],
        [
            'slug' => 'national-guard-jeddah',
            'name' => 'National Guard Hospital',
            'short' => 'NGH',
            'city' => 'Jeddah',
            'logo' => 'hospitals/national-guard-jeddah.webp',
            'beds' => 820,
            'metrics' => ['ed_occupancy' => 71, 'boarding' => 11, 'avg_wait' => 44, 'prediction' => 94],
            'patient_flow' => [
                'stuck' => [
                    ['patient_name' => 'Omar Al-Sahli', 'zone' => 'ED-3', 'los_hours' => 3.6, 'meds_received' => true],
                ],
                'discharge_ready' => [
                    ['patient_name' => 'Maha Al-Omari', 'zone' => 'OBS-7', 'minutes_to_dc' => 40, 'meds_received' => true],
                    ['patient_name' => 'Turki Al-Ahmadi', 'zone' => 'ED-8', 'minutes_to_dc' => 25, 'meds_received' => false],
                ],
            ],
            'series' => [
                'ed_census' => [36, 39, 44, 49, 55, 61, 59, 54, 51, 48, 46, 52],
                'ward_stress' => [18, 29, 34, 38, 31, 24],
                'risk_mix' => [52, 33, 15],
            ],
        ],
        [
            'slug' => 'kauh',
            'name' => 'King Abdulaziz University Hospital',
            'short' => 'KAUH',
            'city' => 'Jeddah',
            'logo' => 'hospitals/kauh.png',
            'beds' => 940,
            'metrics' => ['ed_occupancy' => 83, 'boarding' => 19, 'avg_wait' => 51, 'prediction' => 97],
            'patient_flow' => [
                'stuck' => [
                    ['patient_name' => 'Bandar Al-Khalidi', 'zone' => 'ED-12', 'los_hours' => 6.1, 'meds_received' => false],
                    ['patient_name' => 'Amal Al-Subaie', 'zone' => 'ED-5', 'los_hours' => 4.4, 'meds_received' => false],
                    ['patient_name' => 'Rakan Al-Otaibi', 'zone' => 'FT-2', 'los_hours' => 3.2, 'meds_received' => true],
                    ['patient_name' => 'Dana Al-Maliki', 'zone' => 'Hall-A', 'los_hours' => 5.0, 'meds_received' => false],
                ],
                'discharge_ready' => [
                    ['patient_name' => 'Faisal Al-Ghamdi', 'zone' => 'OBS-1', 'minutes_to_dc' => 18, 'meds_received' => true],
                    ['patient_name' => 'Jawaher Al-Qarni', 'zone' => 'ED-11', 'minutes_to_dc' => 52, 'meds_received' => false],
                ],
            ],
            'series' => [
                'ed_census' => [48, 52, 57, 63, 70, 76, 74, 69, 66, 63, 60, 67],
                'ward_stress' => [28, 40, 36, 44, 39, 32],
                'risk_mix' => [41, 39, 20],
            ],
        ],
        [
            'slug' => 'dr-suliman-fakeeh',
            'name' => 'Dr. Suliman Fakeeh Hospital',
            'short' => 'DSFH',
            'city' => 'Jeddah',
            'logo' => 'hospitals/dr-suliman-fakeeh.png',
            'beds' => 470,
            'metrics' => ['ed_occupancy' => 69, 'boarding' => 9, 'avg_wait' => 33, 'prediction' => 95],
            'patient_flow' => [
                'stuck' => [
                    ['patient_name' => 'Sultan Al-Yami', 'zone' => 'ED-2', 'los_hours' => 2.9, 'meds_received' => true],
                    ['patient_name' => 'Latifa Al-Harbi', 'zone' => 'ED-7', 'los_hours' => 3.7, 'meds_received' => false],
                ],
                'discharge_ready' => [
                    ['patient_name' => 'Majed Al-Sharif', 'zone' => 'OBS-3', 'minutes_to_dc' => 35, 'meds_received' => true],
                ],
            ],
            'series' => [
                'ed_census' => [31, 34, 38, 44, 50, 54, 52, 47, 44, 41, 40, 45],
                'ward_stress' => [16, 24, 30, 27, 22, 19],
                'risk_mix' => [56, 31, 13],
            ],
        ],
    ],
];
