@php
    $series = $hospital['series'] ?? ['ed_census' => [], 'ward_stress' => [], 'risk_mix' => []];
    $metrics = $hospital['metrics'] ?? [];
    $patientFlow = $hospital['patient_flow'] ?? ['stuck' => [], 'discharge_ready' => []];
    $stuckPatients = $patientFlow['stuck'] ?? [];
    $dischargeReadyPatients = $patientFlow['discharge_ready'] ?? [];
    $hours = ['−5h', '−4h', '−3h', '−2h', '−1h', 'Now', '+1h', '+2h', '+3h', '+4h', '+5h', '+6h'];
    $wards = ['ICU', 'Med/Surg', 'ED hold', 'PACU', 'Ortho', 'Onc'];
    $riskLabels = ['Stable', 'Elevated', 'Critical'];
    $chartPayload = [
        'ed' => array_values($series['ed_census'] ?? []),
        'ward' => array_values($series['ward_stress'] ?? []),
        'risk' => array_values($series['risk_mix'] ?? []),
        'hours' => $hours,
        'wards' => $wards,
        'riskLabels' => $riskLabels,
    ];
    $formatLosHours = static function (float $h): string {
        $totalMin = max(0, (int) round($h * 60));
        $hh = intdiv($totalMin, 60);
        $mm = $totalMin % 60;

        return sprintf('%dh %02dm', $hh, $mm);
    };
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $hospital['name'] ?? 'Hospital' }} · Healora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" defer></script>
    <style>
        :root {
            --brand-green: #009785;
            --brand-green-hover: #006b60;
            --brand-green-ink: #004d45;
            --brand-pink: #d57bfe;
            --brand-purple: #b275ff;
            --bg-soft: #faf5fc;
            --surface: #ffffff;
            --teal: var(--brand-green);
            --teal-dark: var(--brand-green-hover);
            --card: #fdf8ff;
            --line: #e5c7f9;
            --text: #1e293b;
            --muted: #5f7188;
            --chart-grid: rgba(15,23,42,0.06);
            --chart-tick: #64748b;
        }
        body.dark-mode {
            --brand-green: #5fe8d4;
            --brand-green-hover: #009785;
            --brand-green-ink: #b8fff0;
            --bg-soft: #0f0818;
            --surface: #1a1224;
            --teal: var(--brand-green);
            --teal-dark: var(--brand-green-hover);
            --card: #1e1635;
            --line: rgba(178, 117, 255, 0.35);
            --text: #f5e9ff;
            --muted: #c9a8e8;
            --chart-grid: rgba(148,163,184,0.12);
            --chart-tick: #94a3b8;
        }
        .theme-icon { width: 1rem; height: 1rem; stroke: currentColor; }
        .hospital-logo-slot--sfh,
        body.dark-mode .hospital-logo-slot--sfh {
            background-color: #fff !important;
        }
        .hospital-hero-logo--sfh,
        body.dark-mode .hospital-hero-logo--sfh {
            background-color: #fff !important;
        }
        body.dark-mode .operations-console-nav {
            background: var(--surface) !important;
            border-color: var(--line) !important;
        }
        body.dark-mode .operations-console-nav .border-slate-100,
        body.dark-mode .operations-console-nav .border-slate-200 { border-color: var(--line) !important; }
        body.dark-mode .operations-console-nav .bg-slate-50 { background: rgba(255,255,255,0.04) !important; }
        body.dark-mode .ops-network-flow-summary {
            background: rgba(255, 255, 255, 0.04) !important;
            border-color: var(--line) !important;
        }
        body.dark-mode .ops-network-flow-summary .border-slate-200\/80 { border-color: var(--line) !important; }
        body.dark-mode .ops-network-flow-summary .bg-white\/90 { background: rgba(255, 255, 255, 0.06) !important; }
        body.dark-mode .ops-network-flow-summary .ring-slate-200\/60,
        body.dark-mode .ops-network-flow-summary .ring-\[\#d57bfe\]\/40 { --tw-ring-color: var(--line) !important; }
        body.dark-mode .ops-network-flow-summary .text-amber-800 { color: #fcd34d !important; }
        body.dark-mode .ops-network-flow-summary .text-emerald-800 { color: #6ee7b7 !important; }
        body.dark-mode .ops-network-flow-summary .text-[var(--teal)] { color: var(--teal) !important; }
        body.dark-mode .dash-sidebar > .border-b {
            background: rgba(255, 255, 255, 0.04) !important;
            border-color: var(--line) !important;
        }
        body.dark-mode .dash-sidebar .from-slate-50\/90,
        body.dark-mode .dash-sidebar .to-white { background-color: transparent !important; background-image: none !important; }
        body.dark-mode .demo-panel {
            border-color: var(--line) !important;
            background: var(--surface) !important;
        }
        body.dark-mode .demo-panel-muted {
            background: rgba(255,255,255,0.04) !important;
            border-color: var(--line) !important;
        }
        body.dark-mode #meds-ai-action {
            background: rgba(120, 53, 15, 0.35) !important;
            border-color: rgba(251, 191, 36, 0.35) !important;
            color: #fef3c7;
        }
        body.dark-mode #meds-ai-action .text-amber-900,
        body.dark-mode #meds-ai-action .text-amber-950 { color: #fef3c7 !important; }
        body.dark-mode #meds-ai-action #meds-ai-action-bays {
            background: rgba(15, 23, 42, 0.5) !important;
            border-color: rgba(251, 191, 36, 0.25) !important;
        }
    </style>
</head>
<body class="min-h-screen bg-[var(--bg-soft)] text-[var(--text)] antialiased">
    <header class="border-b border-[#d57bfe]/40 bg-white/95">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 lg:px-8">
            <a href="{{ route('landing') }}" class="flex items-center gap-2.5">
                <img src="{{ asset('brand/healora-logo.png') }}" alt="Healora logo" class="h-10 w-auto object-contain">
                <span class="text-lg font-semibold tracking-tight text-[var(--teal)]">Healora</span>
            </a>
            <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 md:flex">
                <a href="{{ route('landing') }}" class="transition hover:text-[var(--teal)]">Home</a>
                <a href="{{ route('dashboard') }}" class="transition hover:text-[var(--teal)]">Live Board</a>
                <a href="{{ route('recommendations') }}" class="transition hover:text-[var(--teal)]">Recommendations</a>
                <a href="{{ route('dashboard.hospitals') }}" class="text-[var(--teal)]">Hospital Charts</a>
            </nav>
            <div class="flex items-center gap-2">
                <button id="themeToggleHospital" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-300 bg-white text-slate-700 transition hover:bg-slate-50" aria-label="Toggle color theme">
                    <span id="themeIconHospital" aria-hidden="true">
                        <svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"/>
                        </svg>
                    </span>
                </button>
                <a href="{{ route('dashboard') }}" class="rounded-xl bg-[var(--teal)] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[var(--brand-green-hover)]">Command Center</a>
            </div>
        </div>
    </header>

    <section class="border-b border-[#009785]/30 bg-gradient-to-br from-[#003d38] via-[#009785] to-[#b275ff]" aria-labelledby="hospital-page-title">
        <div class="mx-auto max-w-[1560px] px-4 py-8 sm:py-10 lg:px-8">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:gap-8">
                @if (! empty($hospital['logo']))
                    <div class="flex h-16 w-16 shrink-0 overflow-hidden rounded-2xl border shadow-lg sm:h-20 sm:w-20 {{ ($hospital['slug'] ?? '') === 'security-forces-riyadh' ? 'hospital-hero-logo--sfh border-white/20 bg-white' : 'border-white/25 bg-white/10 backdrop-blur-sm' }}">
                        @include('partials.hospital-logo-img', [
                            'src' => asset($hospital['logo']),
                            'alt' => $hospital['name'],
                        ])
                    </div>
                @endif
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-md border border-white/20 bg-white/10 px-2.5 py-1 text-xs font-medium text-white">
                            <span class="relative flex h-2 w-2"><span class="absolute inline-flex h-full w-full animate-pulse rounded-full bg-[#d57bfe] opacity-70"></span><span class="relative inline-flex h-2 w-2 rounded-full bg-[#7ef0dc]"></span></span>
                            Demo
                        </span>
                        <span class="text-xs font-medium text-white/85">Illustrative metrics</span>
                    </div>
                    <h1 id="hospital-page-title" class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-4xl">{{ $hospital['name'] }}</h1>
                    <p class="mt-3 max-w-3xl text-base leading-relaxed text-white/90 sm:text-lg">{{ $hospital['city'] ?? '' }} · Demo throughput charts (synthetic data).</p>
                </div>
            </div>
        </div>
    </section>

    <main class="mx-auto max-w-[1560px] px-4 py-8 lg:px-8">
        <div class="flex flex-col gap-8 lg:grid lg:grid-cols-12 lg:items-start lg:gap-10">
            <aside class="order-2 lg:order-none lg:col-span-3 xl:col-span-3" aria-label="Hospital demo navigation">
                <div class="lg:sticky lg:top-20 lg:z-10 xl:top-24">
                    @include('partials.operations-console-nav', [
                        'hospitalNav' => $hospitalNav,
                        'activeHospitalSlug' => $hospital['slug'] ?? null,
                        'opsNetworkFlow' => $opsNetworkFlow ?? null,
                    ])
                </div>
            </aside>

            <div class="order-1 min-w-0 lg:order-none lg:col-span-9 xl:col-span-9 space-y-8">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <article class="demo-panel rounded-2xl border border-[#d57bfe]/40 bg-gradient-to-br from-white to-[rgba(213,123,254,0.1)] p-5 shadow-sm">
                <p class="text-sm text-slate-500">ED occupancy</p>
                <p class="mt-1 text-3xl font-bold text-[var(--teal)]">{{ $metrics['ed_occupancy'] ?? '—' }}%</p>
            </article>
            <article class="demo-panel rounded-2xl border border-[#d57bfe]/40 bg-gradient-to-br from-white to-[rgba(213,123,254,0.1)] p-5 shadow-sm">
                <p class="text-sm text-slate-500">Boarding</p>
                <p class="mt-1 text-3xl font-bold text-slate-800">{{ $metrics['boarding'] ?? '—' }}</p>
            </article>
            <article class="demo-panel rounded-2xl border border-[#d57bfe]/40 bg-gradient-to-br from-white to-[rgba(213,123,254,0.1)] p-5 shadow-sm">
                <p class="text-sm text-slate-500">Avg wait</p>
                <p class="mt-1 text-3xl font-bold text-[var(--teal)]">{{ $metrics['avg_wait'] ?? '—' }}<span class="text-lg font-semibold text-slate-400">m</span></p>
            </article>
            <article class="demo-panel rounded-2xl border border-[#d57bfe]/40 bg-gradient-to-br from-white to-[rgba(213,123,254,0.1)] p-5 shadow-sm">
                <p class="text-sm text-slate-500">Model confidence</p>
                <p class="mt-1 text-3xl font-bold text-[var(--teal)]">{{ $metrics['prediction'] ?? '—' }}%</p>
            </article>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <article class="demo-panel rounded-2xl border border-amber-100 bg-white p-5 shadow-sm ring-1 ring-amber-100/60">
                <p class="text-sm font-medium text-slate-600">Stuck patients</p>
                <p class="mt-1 text-3xl font-bold tabular-nums text-amber-800">{{ count($stuckPatients) }}</p>
                <p class="mt-1 text-xs text-slate-500">LOS over target (demo)</p>
            </article>
            <article class="demo-panel rounded-2xl border border-[#009785]/25 bg-white p-5 shadow-sm ring-1 ring-[rgba(0,151,133,0.2)]">
                <p class="text-sm font-medium text-slate-600">Near discharge</p>
                <p class="mt-1 text-3xl font-bold tabular-nums text-[var(--brand-green-ink)]">{{ count($dischargeReadyPatients) }}</p>
                <p class="mt-1 text-xs text-slate-500">Awaiting final steps (demo)</p>
            </article>
        </div>

        <section class="demo-panel rounded-2xl border border-[#d57bfe]/40 bg-gradient-to-br from-white to-[rgba(213,123,254,0.1)] p-6 shadow-sm" aria-labelledby="patient-flow-heading">
            <div class="flex flex-col gap-1 border-b border-slate-100 pb-4 sm:flex-row sm:items-end sm:justify-between">
                <h2 id="patient-flow-heading" class="text-lg font-semibold text-[var(--teal)]">Patient flow</h2>
                <p class="text-xs text-slate-500">Synthetic rows</p>
            </div>
            <div class="mt-6 grid gap-8 lg:grid-cols-2">
                <div>
                    <h3 class="text-sm font-semibold text-slate-800">Stuck</h3>
                    <p class="mt-0.5 text-xs text-slate-500">ED time in department</p>
                    <div class="demo-panel-muted mt-3 overflow-x-auto rounded-xl border border-slate-100">
                        <table class="min-w-full text-left text-sm">
                            <thead class="border-b border-slate-200 bg-slate-50/80 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                <tr>
                                    <th class="min-w-[7rem] px-3 py-2.5">Patient</th>
                                    <th class="px-3 py-2.5">Bay</th>
                                    <th class="px-3 py-2.5">Time</th>
                                    <th class="px-3 py-2.5">Meds status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($stuckPatients as $row)
                                    @php
                                        $los = $formatLosHours((float) ($row['los_hours'] ?? 0));
                                        $meds = ! empty($row['meds_received']);
                                        $patientName = $row['patient_name'] ?? '—';
                                    @endphp
                                    <tr class="bg-white/80"@unless ($meds) data-meds-pending="1" data-bay="{{ $row['zone'] ?? '' }}" data-patient-name="{{ $patientName }}" data-flow-context="stuck"@endunless>
                                        <td class="px-3 py-2.5 text-sm font-semibold text-slate-800">{{ $patientName }}</td>
                                        <td class="px-3 py-2.5 font-mono text-xs font-semibold text-slate-600">{{ $row['zone'] ?? '—' }}</td>
                                        <td class="px-3 py-2.5 tabular-nums text-slate-700">{{ $los }}</td>
                                        <td class="px-3 py-2.5 text-xs">
                                            <span class="font-semibold tabular-nums {{ $meds ? 'text-[var(--teal)]' : 'text-amber-700' }}">{{ $meds ? 'Received' : 'Pending' }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="px-3 py-4 text-center text-sm text-slate-500">No demo rows</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-800">Near discharge</h3>
                    <p class="mt-0.5 text-xs text-slate-500">ETA to leave</p>
                    <div class="demo-panel-muted mt-3 overflow-x-auto rounded-xl border border-slate-100">
                        <table class="min-w-full text-left text-sm">
                            <thead class="border-b border-slate-200 bg-slate-50/80 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                <tr>
                                    <th class="min-w-[7rem] px-3 py-2.5">Patient</th>
                                    <th class="px-3 py-2.5">Bay</th>
                                    <th class="px-3 py-2.5">ETA</th>
                                    <th class="px-3 py-2.5">Meds status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($dischargeReadyPatients as $row)
                                    @php
                                        $m = (int) ($row['minutes_to_dc'] ?? 0);
                                        $meds = ! empty($row['meds_received']);
                                        $patientName = $row['patient_name'] ?? '—';
                                    @endphp
                                    <tr class="bg-white/80"@unless ($meds) data-meds-pending="1" data-bay="{{ $row['zone'] ?? '' }}" data-patient-name="{{ $patientName }}" data-flow-context="discharge"@endunless>
                                        <td class="px-3 py-2.5 text-sm font-semibold text-slate-800">{{ $patientName }}</td>
                                        <td class="px-3 py-2.5 font-mono text-xs font-semibold text-slate-600">{{ $row['zone'] ?? '—' }}</td>
                                        <td class="px-3 py-2.5 tabular-nums text-slate-700">{{ $m }} min</td>
                                        <td class="px-3 py-2.5 text-xs">
                                            <span class="font-semibold tabular-nums {{ $meds ? 'text-[var(--teal)]' : 'text-amber-700' }}">{{ $meds ? 'Received' : 'Pending' }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="px-3 py-4 text-center text-sm text-slate-500">No demo rows</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="meds-ai-action" class="mt-6 hidden rounded-xl border border-amber-200 bg-amber-50/90 p-4 text-sm text-amber-950 shadow-sm ring-1 ring-amber-100" role="status" aria-live="polite">
                <p class="flex flex-wrap items-center gap-2 font-semibold text-amber-900">
                    <span class="inline-flex h-2 w-2 animate-pulse rounded-full bg-amber-500" aria-hidden="true"></span>
                    AI action
                </p>
                <p class="mt-2 text-xs font-medium text-amber-800/90">When <strong>meds status</strong> is <strong>Pending</strong> for any row:</p>
                <ul class="mt-2 list-inside list-disc space-y-1 text-xs text-amber-900/95">
                    <li><strong>Stuck:</strong> Open a high-priority pharmacy task, ping the charge nurse, and add an EMR flag for delayed throughput.</li>
                    <li class="mt-2"><strong>Near discharge:</strong> Block discharge paperwork, notify pharmacy STAT, and surface a countdown risk if ETA is under 30 minutes.</li>
                </ul>
                <p id="meds-ai-action-bays" class="mt-3 rounded-lg border border-amber-200/80 bg-white/70 px-3 py-2 text-xs leading-relaxed text-amber-950"></p>
            </div>
        </section>

        <div class="grid gap-6 lg:grid-cols-12">
            <section class="demo-panel flex flex-col rounded-2xl border border-[#d57bfe]/40 bg-gradient-to-br from-white to-[rgba(213,123,254,0.1)] p-6 shadow-sm lg:col-span-7">
                <h2 class="text-lg font-semibold text-[var(--teal)]">ED census · 12h</h2>
                <div class="demo-panel-muted mt-4 flex-1 rounded-xl border border-slate-100 bg-slate-50 p-3">
                    <div class="relative h-64 w-full md:h-72"><canvas id="chartEdCensus"></canvas></div>
                </div>
            </section>
            <section class="demo-panel flex flex-col rounded-2xl border border-[#d57bfe]/40 bg-gradient-to-br from-white to-[rgba(213,123,254,0.1)] p-6 shadow-sm lg:col-span-5">
                <h2 class="text-lg font-semibold text-[var(--teal)]">Risk mix</h2>
                <div class="demo-panel-muted mt-4 flex flex-1 items-center justify-center rounded-xl border border-slate-100 bg-slate-50 p-4">
                    <div class="relative mx-auto h-56 w-56 max-w-full"><canvas id="chartRiskMix"></canvas></div>
                </div>
            </section>
            <section class="demo-panel rounded-2xl border border-[#d57bfe]/40 bg-gradient-to-br from-white to-[rgba(213,123,254,0.1)] p-6 shadow-sm lg:col-span-12">
                <h2 class="text-lg font-semibold text-[var(--teal)]">Ward stress</h2>
                <div class="demo-panel-muted mt-4 rounded-xl border border-slate-100 bg-slate-50 p-3">
                    <div class="relative h-64 w-full md:h-72"><canvas id="chartWardStress"></canvas></div>
                </div>
            </section>
        </div>
            </div>
        </div>
    </main>

    <footer class="border-t border-slate-200 bg-white py-5 text-center text-sm text-slate-500">
        © 2026 Healora Demo · Illustrative data
    </footer>

    <script type="application/json" id="hospital-chart-payload">@json($chartPayload)</script>
    <script>
        (function () {
            const key = 'healora-theme';
            const toggle = document.getElementById('themeToggleHospital');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const saved = localStorage.getItem(key);
            if (saved ? saved === 'dark' : prefersDark) document.body.classList.add('dark-mode');
            function icon() {
                return document.body.classList.contains('dark-mode')
                    ? '<svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8"><circle cx="12" cy="12" r="4"></circle><path stroke-linecap="round" d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"></path></svg>'
                    : '<svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"></path></svg>';
            }
            document.getElementById('themeIconHospital').innerHTML = icon();
            toggle.addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem(key, document.body.classList.contains('dark-mode') ? 'dark' : 'light');
                document.getElementById('themeIconHospital').innerHTML = icon();
                window.dispatchEvent(new Event('healora-theme-changed'));
            });
        })();

        window.addEventListener('DOMContentLoaded', function () {
            let payload = { ed: [], ward: [], risk: [], hours: [], wards: [], riskLabels: [] };
            try { payload = JSON.parse(document.getElementById('hospital-chart-payload').textContent); } catch (e) {}
            function cssVar(n, f) {
                var v = getComputedStyle(document.documentElement).getPropertyValue(n).trim();
                return v || f;
            }
            function P() {
                return {
                    teal: cssVar('--teal', '#009785'),
                    muted: cssVar('--muted', '#64748b'),
                    line: cssVar('--chart-grid', '#ccc'),
                    tick: cssVar('--chart-tick', '#64748b'),
                    surface: cssVar('--surface', '#fff'),
                };
            }
            var charts = [];
            function destroy() { charts.forEach(function (c) { try { c.destroy(); } catch (e) {} }); charts = []; }
            function build() {
                destroy();
                var col = P();
                var sc = { ticks: { color: col.tick, font: { size: 11 } }, grid: { color: col.line } };
                var c1 = document.getElementById('chartEdCensus');
                if (c1 && window.Chart) {
                    var g = c1.getContext('2d');
                    var h = c1.parentElement && c1.parentElement.clientHeight ? c1.parentElement.clientHeight : 260;
                    var gr = g.createLinearGradient(0, 0, 0, h);
                    gr.addColorStop(0, col.teal + '55');
                    gr.addColorStop(1, col.teal + '05');
                    charts.push(new Chart(c1, {
                        type: 'line',
                        data: { labels: payload.hours, datasets: [{ data: payload.ed, borderColor: col.teal, backgroundColor: gr, borderWidth: 2, fill: true, tension: 0.35, pointRadius: 0 }] },
                        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: sc, y: Object.assign({}, sc, { beginAtZero: true }) } }
                    }));
                }
                var c2 = document.getElementById('chartWardStress');
                if (c2 && window.Chart) {
                    var t2 = cssVar('--brand-purple', '#b275ff');
                    charts.push(new Chart(c2, {
                        type: 'bar',
                        data: { labels: payload.wards, datasets: [{ data: payload.ward, borderRadius: 10, backgroundColor: [col.teal, t2, col.teal, t2, col.teal, t2], borderColor: col.line, borderWidth: 1 }] },
                        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: sc, y: Object.assign({}, sc, { beginAtZero: true }) } }
                    }));
                }
                var c3 = document.getElementById('chartRiskMix');
                if (c3 && window.Chart) {
                    charts.push(new Chart(c3, {
                        type: 'doughnut',
                        data: { labels: payload.riskLabels, datasets: [{ data: payload.risk, borderWidth: 2, borderColor: col.surface, backgroundColor: [col.teal, '#d57bfe', '#f97316'] }] },
                        options: { responsive: true, maintainAspectRatio: false, cutout: '58%', plugins: { legend: { position: 'bottom', labels: { color: col.tick, boxWidth: 10, font: { size: 11 } } } } }
                    }));
                }
            }
            function wait(cb, n) {
                n = n || 0;
                if (window.Chart) return cb();
                if (n > 40) return;
                setTimeout(function () { wait(cb, n + 1); }, 50);
            }
            wait(build);
            window.addEventListener('healora-theme-changed', function () { wait(build); });

            var panel = document.getElementById('meds-ai-action');
            var baysEl = document.getElementById('meds-ai-action-bays');
            function updateMedsAiPanel() {
                if (!panel || !baysEl) return;
                var pendingRows = document.querySelectorAll('tr[data-meds-pending="1"]');
                var open = [];
                pendingRows.forEach(function (tr) {
                    var bay = tr.getAttribute('data-bay') || '—';
                    var patientName = tr.getAttribute('data-patient-name') || '';
                    var ctx = tr.getAttribute('data-flow-context') === 'discharge' ? 'Near discharge' : 'Stuck';
                    open.push(patientName + ' — ' + bay + ' (' + ctx + ')');
                });
                if (open.length === 0) {
                    panel.classList.add('hidden');
                    baysEl.textContent = '';
                    return;
                }
                panel.classList.remove('hidden');
                baysEl.textContent = 'Pending meds status: ' + open.join(' · ');
            }
            updateMedsAiPanel();
        });
    </script>
</body>
</html>
