<?php

namespace App\Services;

use App\Models\DepartmentNotification;
use App\Notifications\DepartmentTestAlert;
use Illuminate\Support\Facades\Notification;

class GuidelieAiActionsService
{
    /**
     * @return array{
     *     answer:string,
     *     citations:list<array{source:string,title:string,year:int,domain:string}>,
     *     hits:list<array{source:string,title:string,score:int}>
     * }
     */
    public function answer(string $question): array
    {
        $normalized = trim(mb_strtolower($question));
        if ($normalized === '') {
            return [
                'answer' => 'Ask about alerts, recommendations, bed capacity, reporting, telemedicine, Saudi regulation, or AI governance.',
                'citations' => [],
                'hits' => [],
            ];
        }

        $notificationCommand = $this->parseNotificationCommand($normalized);
        if ($notificationCommand !== null) {
            if (($notificationCommand['recipient_email'] ?? null) === null) {
                return [
                    'answer' => 'I can send it now. Please include recipient email in your command, for example: send test notification to pharmacy@hospital.sa for Pharmacy.',
                    'citations' => [],
                    'hits' => [],
                ];
            }

            Notification::route('mail', $notificationCommand['recipient_email'])
                ->notify(new DepartmentTestAlert(
                    $notificationCommand['target_department'],
                    $notificationCommand['title'],
                    $notificationCommand['message'],
                    $notificationCommand['severity'],
                ));

            DepartmentNotification::query()->create([
                'target_department' => $notificationCommand['target_department'],
                'recipient_email' => $notificationCommand['recipient_email'],
                'title' => $notificationCommand['title'],
                'message' => $notificationCommand['message'],
                'severity' => $notificationCommand['severity'],
                'sent_via_mail' => true,
                'sent_at' => now(),
            ]);

            return [
                'answer' => 'Test notification sent to '.$notificationCommand['recipient_email'].' for '.$notificationCommand['target_department'].' (severity: '.strtoupper($notificationCommand['severity']).').',
                'citations' => [],
                'hits' => [
                    [
                        'source' => 'Healora Notification Center',
                        'title' => 'Command executed from AI chat',
                        'score' => 100,
                    ],
                ],
            ];
        }

        $results = $this->search($normalized);
        $top = array_slice($results, 0, 3);
        $bedFocused = $this->isBedManagementQuestion($normalized);

        if ($top === []) {
            if ($this->isHealoraQuestion($normalized)) {
                return [
                    'answer' => $this->healoraFallbackAnswer($bedFocused),
                    'citations' => [
                        [
                            'source' => 'Healora Product Profile (demo)',
                            'title' => 'Healora AI Control Tower',
                            'year' => 2026,
                            'domain' => 'Platform overview',
                        ],
                    ],
                    'hits' => [
                        [
                            'source' => 'Healora Product Profile (demo)',
                            'title' => 'Healora AI Control Tower',
                            'score' => 100,
                        ],
                    ],
                ];
            }

            return [
                'answer' => 'No strong match found in the current demo index. Try asking about predictive alerts, CDSS, LOS forecasting, SVH telemedicine, or SFDA/SDAIA governance.',
                'citations' => [],
                'hits' => [],
            ];
        }

        $highlights = [];
        $citations = [];
        $hits = [];

        foreach ($top as $row) {
            $doc = $row['doc'];
            $highlights[] = '- '.$doc['highlight'];
            $citations[] = [
                'source' => $doc['source'],
                'title' => $doc['title'],
                'year' => $doc['year'],
                'domain' => $doc['domain'],
            ];
            $hits[] = [
                'source' => $doc['source'],
                'title' => $doc['title'],
                'score' => $row['score'],
            ];
        }

        $answer = "Deep-search answer for your system:\n\n"
            ."What this means for Healora operations:\n"
            .implode("\n", $highlights)
            ."\n\nRecommended product action:\n"
            .($bedFocused
                ? "- Build every shift decision around bed-state: occupied, discharge-ready, cleaning, and assignable.\n"
                    ."- Trigger early discharge huddles from LOS + boarding predictions to release capacity before peak demand.\n"
                    ."- Add a bed-turnover SLA monitor (decision-to-discharge, discharge-to-clean, clean-to-next-patient).\n"
                : "- Keep AI in human-in-the-loop mode for clinical decisions and report sign-off.\n"
                    ."- Use predictive alerts for ED congestion and LOS to trigger staffing and discharge workflows.\n"
                    ."- Add governance checks for fairness, explainability, and Saudi compliance requirements.\n");

        return [
            'answer' => $answer,
            'citations' => $citations,
            'hits' => $hits,
        ];
    }

    /**
     * @return list<array{doc:array<string,mixed>,score:int}>
     */
    private function search(string $question): array
    {
        $tokens = $this->tokens($question);
        $results = [];

        foreach ($this->knowledgeBase() as $doc) {
            $haystack = mb_strtolower(
                $doc['title'].' '.$doc['domain'].' '.implode(' ', $doc['tags']).' '.$doc['summary'].' '.$doc['highlight']
            );
            $score = 0;

            foreach ($tokens as $token) {
                if (mb_strlen($token) < 3) {
                    continue;
                }

                if (str_contains($haystack, $token)) {
                    $score += 10;
                }
            }

            foreach ($doc['tags'] as $tag) {
                if (str_contains($question, mb_strtolower($tag))) {
                    $score += 20;
                }
            }

            if ($this->isBedManagementQuestion($question)) {
                foreach ($doc['tags'] as $tag) {
                    $lowerTag = mb_strtolower($tag);
                    if (str_contains($lowerTag, 'bed') || str_contains($lowerTag, 'los') || str_contains($lowerTag, 'boarding')) {
                        $score += 25;
                    }
                }
            }

            if ($score > 0) {
                $results[] = ['doc' => $doc, 'score' => $score];
            }
        }

        usort($results, static fn (array $a, array $b): int => $b['score'] <=> $a['score']);

        return $results;
    }

    /**
     * @return list<string>
     */
    private function tokens(string $text): array
    {
        $parts = preg_split('/[^a-z0-9_]+/i', mb_strtolower($text)) ?: [];
        return array_values(array_filter($parts, static fn (string $v): bool => $v !== ''));
    }

    private function isHealoraQuestion(string $question): bool
    {
        $keywords = [
            'healora',
            'our system',
            'our platform',
            'our app',
            'command center',
            'dashboard',
            'hospital charts',
            'recommendations',
            'ed',
            'boarding',
            'wait time',
            'patient flow',
            'capacity',
            'throughput',
        ];

        foreach ($keywords as $keyword) {
            if (str_contains($question, $keyword)) {
                return true;
            }
        }

        return false;
    }

    private function healoraFallbackAnswer(bool $bedFocused = false): string
    {
        if ($bedFocused) {
            return "Healora bed management answer:\n\n"
                ."For your focus, Healora should run as a Bed Command workflow.\n"
                ."- Primary objective: keep the assignable-bed pipeline continuously open, not only track occupancy.\n"
                ."- Core bed metrics: total occupied, discharge-ready, pending-clean, assignable-now, and boarding pressure.\n"
                ."- Operational loop: predict LOS/boarding -> prioritize discharge actions -> accelerate turnover -> reassign beds in real time.\n"
                ."- Shift triggers: if boarding rises and assignable beds drop, activate discharge huddle and housekeeping fast-lane.\n"
                ."- Governance: human-approved final clinical decisions, with AI supporting prioritization and timing.\n\n"
                ."Ask for a specific unit (ED, ICU, ward) and I can return a targeted bed-management playbook.";
        }

        return "Healora answer:\n\n"
            ."Healora is an AI-powered hospital operations control tower focused on throughput and congestion prevention.\n"
            ."- Core views: live board metrics (ED occupancy, boarding, available beds, wait time), recommendations, alerts, and hospital charts.\n"
            ."- Core AI behavior: predict congestion, prioritize operational actions, and surface early warnings for patient-flow risk.\n"
            ."- Operational model: convert forecasting into immediate actions (staff reallocation, discharge coordination, bed-turnover acceleration).\n"
            ."- Safety model: human-in-the-loop for clinical decisions and final report sign-off.\n"
            ."- Strategy alignment: built to support Saudi health transformation direction and AI governance requirements.\n\n"
            ."If you ask a specific Healora question (feature, workflow, KPI, role, or deployment), I will answer with a targeted step-by-step response.";
    }

    private function isBedManagementQuestion(string $question): bool
    {
        $keywords = [
            'bed',
            'beds',
            'bed management',
            'bed turnover',
            'bed capacity',
            'capacity',
            'occupancy',
            'boarding',
            'discharge',
            'length of stay',
            'los',
            'assignable',
        ];

        foreach ($keywords as $keyword) {
            if (str_contains($question, $keyword)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array{
     *     target_department:string,
     *     recipient_email:?string,
     *     title:string,
     *     message:string,
     *     severity:string
     * }|null
     */
    private function parseNotificationCommand(string $question): ?array
    {
        $wantsNotification = (str_contains($question, 'send') || str_contains($question, 'notify'))
            && str_contains($question, 'notification');

        if (! $wantsNotification) {
            return null;
        }

        $recipient = null;
        if (preg_match('/[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}/i', $question, $matches) === 1) {
            $recipient = $matches[0];
        }

        $department = 'Pharmacy';
        $departmentMap = [
            'pharmacy' => 'Pharmacy',
            'radiology' => 'Radiology',
            'laboratory' => 'Laboratory',
            'lab' => 'Laboratory',
            'icu' => 'ICU',
            'ed' => 'Emergency Department',
            'er' => 'Emergency Department',
            'nursing' => 'Nursing',
            'operations' => 'Operations',
        ];

        foreach ($departmentMap as $token => $name) {
            if (str_contains($question, $token)) {
                $department = $name;
                break;
            }
        }

        $severity = 'medium';
        if (str_contains($question, 'high')) {
            $severity = 'high';
        } elseif (str_contains($question, 'low')) {
            $severity = 'low';
        }

        return [
            'target_department' => $department,
            'recipient_email' => $recipient,
            'title' => 'Test notification from Healora AI',
            'message' => 'This is a test notification sent from the Healora AI chat command.',
            'severity' => $severity,
        ];
    }

    /**
     * Fake, demo-only evidence documents.
     *
     * @return list<array{
     *     source:string,
     *     title:string,
     *     year:int,
     *     domain:string,
     *     tags:list<string>,
     *     summary:string,
     *     highlight:string
     * }>
     */
    private function knowledgeBase(): array
    {
        return [
            [
                'source' => 'Healora Product Profile (demo)',
                'title' => 'Healora AI Control Tower',
                'year' => 2026,
                'domain' => 'Platform overview',
                'tags' => [
                    'healora',
                    'control tower',
                    'dashboard',
                    'ed occupancy',
                    'boarding',
                    'wait time',
                    'recommendations',
                    'alerts',
                    'patient flow',
                ],
                'summary' => 'Healora centralizes live operations metrics and converts predictions into actions for hospital flow optimization.',
                'highlight' => 'Use Healora to monitor occupancy pressure, prioritize discharge and staffing interventions, and keep executive and operations teams aligned in real time.',
            ],
            [
                'source' => 'Healora Workflow Blueprint (demo)',
                'title' => 'Predict -> Recommend -> Act Loop',
                'year' => 2026,
                'domain' => 'Operational workflow',
                'tags' => [
                    'healora workflow',
                    'predictive ai',
                    'recommendation engine',
                    'alerts',
                    'capacity',
                    'throughput',
                ],
                'summary' => 'Healora workflow runs in continuous loops to detect risk early and trigger response playbooks.',
                'highlight' => 'Run a closed loop: forecast demand, rank next best actions, execute interventions, and refresh signals every cycle.',
            ],
            [
                'source' => 'Healora KPI Guide (demo)',
                'title' => 'Primary Throughput KPIs',
                'year' => 2026,
                'domain' => 'Performance metrics',
                'tags' => [
                    'kpi',
                    'throughput',
                    'occupancy',
                    'boarding',
                    'bed turnover',
                    'wait time',
                    'los',
                ],
                'summary' => 'Operational KPI set for reducing delays and balancing bed capacity across units.',
                'highlight' => 'Track occupancy trend, boarding load, available beds, average wait time, and LOS as a linked KPI set rather than isolated numbers.',
            ],
            [
                'source' => 'Healora Bed Management Playbook (demo)',
                'title' => 'Bed State Orchestration and Turnover SLAs',
                'year' => 2026,
                'domain' => 'Bed management',
                'tags' => [
                    'bed management',
                    'bed state',
                    'turnover',
                    'cleaning',
                    'assignable bed',
                    'boarding',
                    'discharge readiness',
                    'los',
                ],
                'summary' => 'Bed operations playbook focused on assignable capacity and discharge-to-admit cycle time reduction.',
                'highlight' => 'Manage beds as states (occupied, discharge-ready, cleaning, assignable) and optimize transitions with SLA-driven actions.',
            ],
            [
                'source' => 'Healora Capacity Command SOP (demo)',
                'title' => 'Boarding Relief and Capacity Escalation',
                'year' => 2026,
                'domain' => 'Capacity operations',
                'tags' => [
                    'capacity escalation',
                    'boarding relief',
                    'ed crowding',
                    'surge',
                    'bed allocation',
                    'transfer',
                ],
                'summary' => 'Escalation policy for predicted crowding and constrained bed supply.',
                'highlight' => 'When predicted boarding exceeds threshold, trigger transfer, discharge prioritization, and rapid bed-turnover pathways within one command cycle.',
            ],
            [
                'source' => 'Harvard Health Systems Lab (demo)',
                'title' => 'AI Alerting and Clinical Deterioration Meta-Synthesis',
                'year' => 2025,
                'domain' => 'Inpatient safety',
                'tags' => ['alerts', 'deterioration', 'icu', 'mortality', 'early warning'],
                'summary' => 'Synthetic benchmark set indicating lower in-hospital and 30-day mortality with multivariate AI alerts.',
                'highlight' => 'Use multivariate warning scores (vitals + labs + history) to detect deterioration earlier and reduce missed critical cases.',
            ],
            [
                'source' => 'Harvard Clinical AI Program (demo)',
                'title' => 'Generative CDSS: Differential + Treatment Planning',
                'year' => 2026,
                'domain' => 'Clinical decision support',
                'tags' => ['cdss', 'recommendations', 'diagnosis', 'treatment', 'human in loop'],
                'summary' => 'Synthetic validation where AI-generated differentials improved coverage of "cannot-miss" conditions.',
                'highlight' => 'Pair AI differential suggestions with physician validation workflows to prevent automation bias.',
            ],
            [
                'source' => 'Saudi MOH Digital Health Program (demo)',
                'title' => 'Virtual Care Expansion and Rural Access',
                'year' => 2025,
                'domain' => 'Telemedicine operations',
                'tags' => ['saudi', 'virtual hospital', 'rural', 'stroke', 'oncology'],
                'summary' => 'Synthetic operational report for remote specialty access uplift via virtual consultation pathways.',
                'highlight' => 'Route remote high-risk cases to virtual specialty hubs to reduce transfer delays and improve access equity.',
            ],
            [
                'source' => 'SDAIA Health Data Sandbox (demo)',
                'title' => 'AI Governance for Public Health Systems',
                'year' => 2026,
                'domain' => 'Governance and trust',
                'tags' => ['sdaia', 'governance', 'bias', 'explainability', 'privacy'],
                'summary' => 'Synthetic framework for model lifecycle controls, data minimization, and fairness monitoring.',
                'highlight' => 'Require explainability, drift checks, and fairness audits before scaling AI recommendations system-wide.',
            ],
            [
                'source' => 'SFDA Regulatory Intelligence Unit (demo)',
                'title' => 'AI Medical Device Oversight Baseline',
                'year' => 2026,
                'domain' => 'Regulation',
                'tags' => ['sfda', 'regulation', 'medical device', 'validation', 'risk'],
                'summary' => 'Synthetic checklist aligning AI software validation with intended-use boundaries and safety tests.',
                'highlight' => 'Keep autonomous sign-off disabled; use clinician final approval for diagnostics and treatment documentation.',
            ],
            [
                'source' => 'Saudi Hospital Command Center Network (demo)',
                'title' => 'Predictive Bed Capacity and LOS Orchestration',
                'year' => 2025,
                'domain' => 'Operations and flow',
                'tags' => ['capacity', 'los', 'bed management', 'staffing', 'ed crowding'],
                'summary' => 'Synthetic demand forecasting report using time-series models for capacity planning.',
                'highlight' => 'Trigger staffing and discharge coordination from predicted occupancy and LOS, not only current load.',
            ],
        ];
    }
}
