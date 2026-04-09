<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healora | Live Operations Board</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --bg-soft: #e9f3f4;
            --teal: #157b84;
            --teal-dark: #0f5d68;
            --surface: #ffffff;
            --line: #e2e8f0;
            --text: #1e293b;
            --muted: #64748b;
        }
        body.dark-mode {
            --bg-soft: #0b1320;
            --teal: #2dd4bf;
            --teal-dark: #14b8a6;
            --surface: #0f1b2e;
            --line: #21324f;
            --text: #dce7f7;
            --muted: #9ab0cf;
        }
        .app-shell { background: var(--bg-soft); }
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0,0,0,0);
            white-space: nowrap;
            border: 0;
        }
        body.dark-mode .bg-white { background-color: var(--surface) !important; }
        body.dark-mode .bg-white\/95 { background-color: rgba(15, 27, 46, 0.92) !important; }
        body.dark-mode .bg-slate-50 { background-color: rgba(255,255,255,0.04) !important; }
        body.dark-mode .border-slate-200,
        body.dark-mode .border-slate-100,
        body.dark-mode .border-teal-100 { border-color: var(--line) !important; }
        body.dark-mode .text-slate-800,
        body.dark-mode .text-slate-700,
        body.dark-mode .text-slate-600,
        body.dark-mode .text-slate-500 { color: var(--muted) !important; }
        body.dark-mode .text-teal-700 { color: var(--teal) !important; }
        body.dark-mode .operations-console-nav {
            background: var(--surface) !important;
            border-color: var(--line) !important;
        }
        body.dark-mode .operations-console-nav .border-slate-100,
        body.dark-mode .operations-console-nav .border-slate-200 { border-color: var(--line) !important; }
        body.dark-mode .operations-console-nav .bg-slate-50 { background: rgba(255,255,255,0.04) !important; }
        body.dark-mode .operations-console-nav .text-slate-700,
        body.dark-mode .operations-console-nav .text-slate-500 { color: var(--muted) !important; }
        body.dark-mode .ops-network-flow-summary {
            background: rgba(255, 255, 255, 0.04) !important;
            border-color: var(--line) !important;
        }
        body.dark-mode .ops-network-flow-summary .border-slate-200\/80 { border-color: var(--line) !important; }
        body.dark-mode .ops-network-flow-summary .bg-white\/90 { background: rgba(255, 255, 255, 0.06) !important; }
        body.dark-mode .ops-network-flow-summary .ring-slate-200\/60,
        body.dark-mode .ops-network-flow-summary .ring-teal-200\/50 { --tw-ring-color: var(--line) !important; }
        body.dark-mode .ops-network-flow-summary .text-amber-800 { color: #fcd34d !important; }
        body.dark-mode .ops-network-flow-summary .text-emerald-800 { color: #6ee7b7 !important; }
        body.dark-mode .ops-network-flow-summary .text-teal-800 { color: var(--teal) !important; }
        body.dark-mode .dash-sidebar > .border-b {
            background: rgba(255, 255, 255, 0.04) !important;
            border-color: var(--line) !important;
        }
        body.dark-mode .dash-sidebar .from-slate-50\/90,
        body.dark-mode .dash-sidebar .to-white { background-color: transparent !important; background-image: none !important; }
        body.dark-mode .dash-card {
            background: var(--surface) !important;
            border-color: var(--line) !important;
        }
        .dash-card {
            border-radius: 1rem;
            border: 1px solid rgb(204 251 241 / 0.6);
            background: #fff;
            box-shadow: 0 1px 3px 0 rgb(15 23 42 / 0.06);
        }
        body.dark-mode .dash-card { box-shadow: none; }
        .dash-focus:focus-visible {
            outline: 2px solid var(--teal);
            outline-offset: 2px;
        }
        .chip-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 0.65rem;
            margin-right: 0.625rem;
            background: rgba(20, 184, 166, 0.1);
            border: 1px solid rgba(20, 184, 166, 0.25);
            flex-shrink: 0;
        }
        .chip-icon svg { width: 1.125rem; height: 1.125rem; stroke: currentColor; color: var(--teal-dark); }
        body.dark-mode .chip-icon { background: rgba(45, 212, 191, 0.12); border-color: rgba(45, 212, 191, 0.25); color: var(--teal); }
        body.dark-mode .chip-icon svg { color: var(--teal); }
        .theme-icon { width: 1rem; height: 1rem; stroke: currentColor; }
        /* SFH emblem: solid white tile so the circular mark reads clearly */
        .hospital-logo-slot--sfh,
        body.dark-mode .hospital-logo-slot--sfh {
            background-color: #fff !important;
        }
        .hospital-hero-logo--sfh,
        body.dark-mode .hospital-hero-logo--sfh {
            background-color: #fff !important;
        }
        .electrical-energy-chart-wrap {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }
    </style>
</head>
<body class="app-shell min-h-screen text-slate-800 antialiased">
    <a href="#main-content" class="dash-focus sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[100] focus:rounded-lg focus:bg-teal-700 focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-white">Skip to board</a>

    <header class="sticky top-0 z-50 border-b border-slate-200/90 bg-white/95 shadow-sm backdrop-blur-md">
        <div class="mx-auto flex max-w-[1560px] items-center justify-between gap-4 px-4 py-3 sm:py-3.5 lg:px-8">
            <a href="{{ route('landing') }}" class="dash-focus flex shrink-0 items-center gap-3 rounded-lg outline-none ring-offset-2">
                <img src="{{ asset('brand/healora-wordmark.png') }}" alt="Healora" class="h-9 w-auto object-contain sm:h-10">
            </a>
            <nav class="hidden items-center gap-1 md:flex" aria-label="Primary">
                <a href="{{ route('landing') }}" class="dash-focus rounded-lg px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 hover:text-slate-900">Home</a>
                <a href="{{ route('dashboard') }}" class="dash-focus rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-teal-50 font-semibold text-teal-800 ring-1 ring-teal-200/80' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}" @if(request()->routeIs('dashboard')) aria-current="page" @endif>Live Board</a>
                <a href="{{ route('recommendations') }}" class="dash-focus rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('recommendations') ? 'bg-teal-50 font-semibold text-teal-800 ring-1 ring-teal-200/80' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}" @if(request()->routeIs('recommendations')) aria-current="page" @endif>Recommendations</a>
                <a href="{{ route('hospitals.index') }}" class="dash-focus rounded-lg px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 hover:text-slate-900">Hospital charts</a>
            </nav>
            <div class="flex items-center gap-2">
                <button id="themeToggleDashboard" type="button" class="dash-focus inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:bg-slate-50" aria-label="Toggle color theme" title="Toggle color theme">
                    <span id="themeIconDashboard" aria-hidden="true">
                        <svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"/>
                        </svg>
                    </span>
                </button>
                <a href="{{ route('landing') }}#contact" class="dash-focus hidden rounded-lg bg-teal-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-800 sm:inline-flex">Contact</a>
            </div>
        </div>
    </header>

    <section class="border-b border-teal-800/20 bg-gradient-to-br from-[#115e63] via-[#157b84] to-[#0f766e]" aria-labelledby="page-title">
        <div class="mx-auto max-w-[1560px] px-4 py-8 sm:py-10 lg:px-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-md border border-white/20 bg-white/10 px-2.5 py-1 text-xs font-medium text-white">
                            <span class="relative flex h-2 w-2"><span class="absolute inline-flex h-full w-full animate-pulse rounded-full bg-emerald-300 opacity-70"></span><span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-200"></span></span>
                            Demo
                        </span>
                        <span class="text-xs font-medium text-teal-100/90">Illustrative metrics</span>
                    </div>
                    <h1 id="page-title" class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-4xl">Command center</h1>
                    <p class="mt-3 max-w-2xl text-base leading-relaxed text-teal-50 sm:text-lg">ED load, boarding pressure, forecasts, and alerts in one place—built for operations and leadership walkthroughs.</p>
                </div>
                <div class="shrink-0 rounded-xl border border-white/15 bg-black/10 px-4 py-3 text-right backdrop-blur-sm sm:min-w-[10rem]">
                    <p class="text-[10px] font-semibold uppercase tracking-wider text-teal-200/90">Asia / Riyadh</p>
                    <p id="boardClock" class="mt-1 font-mono text-xl font-semibold tabular-nums text-white sm:text-2xl">--:--:--</p>
                    <p class="mt-2 text-[10px] text-teal-100/80">Auto-refresh · 8s</p>
                </div>
            </div>
        </div>
    </section>

    <main id="main-content" class="mx-auto max-w-[1560px] px-4 py-8 lg:px-8" tabindex="-1">
        <div class="flex flex-col gap-8 lg:grid lg:grid-cols-12 lg:items-start lg:gap-10">
            <aside class="order-2 lg:order-none lg:col-span-3 xl:col-span-3" aria-label="Dashboard navigation and demo hospitals">
                <div class="lg:sticky lg:top-20 lg:z-10 xl:top-24">
                    @include('partials.operations-console-nav', [
                        'hospitalNav' => $hospitalNav ?? [],
                        'activeHospitalSlug' => null,
                        'opsNetworkFlow' => $opsNetworkFlow ?? null,
                    ])
                </div>
            </aside>

            <div class="order-1 min-w-0 lg:order-none lg:col-span-9 xl:col-span-9">
        {{-- Primary scan line: key metrics first --}}
        <section class="mb-8" aria-labelledby="kpi-heading">
            <div class="mb-4 flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
                <h2 id="kpi-heading" class="text-xs font-bold uppercase tracking-[0.12em] text-slate-500">At a glance</h2>
                <p class="text-xs text-slate-500">Updated <span id="kpiUpdatedHint" class="font-medium text-slate-600">—</span></p>
            </div>
            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                <div class="dash-card px-4 py-4 sm:px-5 sm:py-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">ED occupancy</p>
                    <p class="mt-2 text-3xl font-bold tabular-nums tracking-tight text-teal-700 sm:text-4xl"><span id="occupancy">{{ $ed_occupancy }}</span><span class="ml-0.5 text-xl font-semibold text-slate-400">%</span></p>
                </div>
                <div class="dash-card px-4 py-4 sm:px-5 sm:py-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Boarding</p>
                    <p id="boarding" class="mt-2 text-3xl font-bold tabular-nums tracking-tight text-slate-900 sm:text-4xl">{{ $boarding_patients }}</p>
                    <p class="mt-1 text-[11px] text-slate-500">Patients awaiting admission</p>
                </div>
                <div class="dash-card px-4 py-4 sm:px-5 sm:py-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Beds available</p>
                    <p id="beds" class="mt-2 text-3xl font-bold tabular-nums tracking-tight text-slate-900 sm:text-4xl">{{ $available_beds }}</p>
                </div>
                <div class="dash-card px-4 py-4 sm:px-5 sm:py-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Avg wait</p>
                    <p class="mt-2 text-3xl font-bold tabular-nums tracking-tight text-teal-700 sm:text-4xl"><span id="wait">{{ $avg_wait_time }}</span><span class="ml-0.5 text-xl font-semibold text-slate-400">m</span></p>
                </div>
            </div>

            @php
                $electricalEnergyDemo = [
                    ['device' => 'Central HVAC', 'kwh' => 41.2],
                    ['device' => 'CT imaging', 'kwh' => 28.6],
                    ['device' => 'Hemodialysis', 'kwh' => 36.8],
                    ['device' => 'Elevators', 'kwh' => 12.4],
                    ['device' => 'Emergency lighting', 'kwh' => 8.9],
                    ['device' => 'IT servers', 'kwh' => 19.3],
                ];
                $electricalEnergyKwh = [];
                foreach ($electricalEnergyDemo as $row) {
                    $electricalEnergyKwh[] = (float) ($row['kwh'] ?? 0);
                }
                $electricalEnergyPayload = [
                    'labels' => array_column($electricalEnergyDemo, 'device'),
                    'values' => $electricalEnergyKwh,
                ];
            @endphp
            <div class="electrical-energy-chart-wrap mt-6 dash-card p-4 sm:p-6">
                <div class="mb-4 flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h3 class="text-base font-bold text-slate-800 sm:text-lg">Electrical energy use</h3>
                        <p class="mt-1 text-sm text-slate-500">Illustrative data · consumption in kWh</p>
                    </div>
                    <span class="inline-flex w-fit rounded-md bg-slate-100 px-2 py-1 text-[10px] font-semibold uppercase tracking-wide text-slate-500">Demo</span>
                </div>
                <figure class="overflow-hidden rounded-xl border border-slate-100 bg-slate-50 p-2 sm:p-4">
                    <figcaption class="sr-only">Horizontal bar chart of energy consumed by equipment</figcaption>
                    <div class="relative h-72 w-full sm:h-80">
                        <canvas id="chartElectricalEnergy"></canvas>
                    </div>
                </figure>
                <p class="mt-2 text-center text-[11px] text-slate-400">X-axis: Energy consumed (kWh) · Y-axis: Equipment</p>
            </div>
            <script type="application/json" id="electrical-energy-payload">@json($electricalEnergyPayload)</script>
        </section>

        <section class="grid gap-6 lg:grid-cols-12 lg:gap-8" aria-label="Board detail">
            <div class="space-y-6 lg:col-span-4">
                <section class="dash-card p-6" aria-labelledby="rec-heading">
                    <h2 id="rec-heading" class="flex items-center text-lg font-semibold text-slate-900 sm:text-xl">
                        <span class="chip-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3a6 6 0 0 0-3.8 10.6c.8.7 1.3 1.5 1.3 2.4h5c0-.9.5-1.7 1.3-2.4A6 6 0 0 0 12 3Z"/><path stroke-linecap="round" d="M10 19h4M10.5 21h3"/></svg></span>
                        AI recommendations
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">Suggested next steps from the demo model.</p>
                    <ol id="recommendationsList" class="mt-5 list-decimal space-y-3 pl-5 text-sm leading-relaxed text-slate-800 marker:font-semibold marker:text-teal-600 sm:text-base sm:leading-7">
                        @foreach ($recommendations as $recommendation)
                            <li class="pl-1">{{ $recommendation }}</li>
                        @endforeach
                    </ol>
                </section>
            </div>

            <div class="space-y-6 lg:col-span-8">
                <section class="dash-card p-6" aria-labelledby="chart-heading">
                    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <h2 id="chart-heading" class="flex flex-wrap items-center gap-2 text-lg font-semibold text-slate-900 sm:text-xl">
                                <span class="chip-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19h16M7 15l3-3 3 2 4-5"/></svg></span>
                                Predicted ED congestion
                            </h2>
                            <p class="mt-1 text-sm text-slate-500">Next 12 hours · occupancy % (demo projection)</p>
                        </div>
                        <span class="inline-flex w-fit items-center rounded-md bg-teal-50 px-2.5 py-1 text-xs font-semibold text-teal-800 ring-1 ring-teal-100">Model active</span>
                    </div>
                    <figure class="overflow-hidden rounded-xl border border-slate-100 bg-slate-50 p-2 sm:p-4">
                        <figcaption class="sr-only">Line chart of predicted emergency department occupancy by hour</figcaption>
                        <div class="h-64 w-full sm:h-72 md:h-80">
                            <svg id="chart" viewBox="0 0 700 260" class="h-full w-full" role="img" aria-labelledby="chart-title"></svg>
                        </div>
                        <p id="chart-title" class="sr-only">ED occupancy forecast</p>
                    </figure>
                    <p class="mt-2 text-center text-[11px] text-slate-400">Y-axis: occupancy % · X-axis: hours</p>
                </section>

                <section class="dash-card p-6" aria-labelledby="alerts-heading">
                    <div class="mb-2 flex flex-col gap-1 sm:flex-row sm:items-baseline sm:justify-between">
                        <h2 id="alerts-heading" class="flex items-center text-lg font-semibold text-slate-900 sm:text-xl">
                            <span class="chip-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.9 2.6 17.2A2 2 0 0 0 4.3 20h15.4a2 2 0 0 0 1.7-2.8L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg></span>
                            Alert feed
                        </h2>
                        <p class="text-xs text-slate-500">Last refresh <time id="updatedAt" datetime="">{{ $updated_at }}</time></p>
                    </div>
                    <p class="mb-4 text-sm text-slate-600">Severity-ordered signals. New items surface on refresh.</p>
                    <ul id="alertsList" class="space-y-3">
                        @foreach ($alerts as $alert)
                            <li class="flex gap-3 rounded-xl border px-4 py-3 text-sm font-medium leading-snug sm:text-base {{ str_starts_with($alert, 'High:') ? 'border-rose-200 bg-rose-50 text-rose-900' : (str_starts_with($alert, 'Medium:') ? 'border-amber-200 bg-amber-50 text-amber-900' : 'border-emerald-200 bg-emerald-50 text-emerald-900') }}">
                                <span class="mt-0.5 shrink-0 font-bold uppercase text-[10px] leading-none {{ str_starts_with($alert, 'High:') ? 'text-rose-600' : (str_starts_with($alert, 'Medium:') ? 'text-amber-700' : 'text-emerald-700') }}" aria-hidden="true">{{ str_starts_with($alert, 'High:') ? '!!' : (str_starts_with($alert, 'Medium:') ? '!' : 'OK') }}</span>
                                <span>{{ $alert }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>
        </section>
            </div>
        </div>
    </main>

    <footer class="border-t border-slate-200 bg-white py-6 text-center text-xs text-slate-500 sm:text-sm">
        © 2026 Healora · Demo data for presentation only
    </footer>

    <script>
        const dataUrl = @json(route('dashboard.data'));
        let currentPredictions = @json($predictions);
        let alertHistory = @json($alerts).map((message) => ({ message, time: null }));
        const themeKey = 'healora-theme';

        function getRiyadhTime() {
            return new Intl.DateTimeFormat('en-GB', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
                timeZone: 'Asia/Riyadh',
            }).format(new Date());
        }

        function tickClock() {
            const t = getRiyadhTime();
            const el = document.getElementById('boardClock');
            const hint = document.getElementById('kpiUpdatedHint');
            if (el) el.textContent = t;
            if (hint) hint.textContent = t;
        }

        function buildChart(predictions) {
            const svg = document.getElementById('chart');
            const width = 700;
            const height = 260;
            const padding = { t: 16, r: 20, b: 32, l: 44 };
            const innerW = width - padding.l - padding.r;
            const innerH = height - padding.t - padding.b;
            const minY = 40;
            const maxY = 100;

            const dark = document.body.classList.contains('dark-mode');
            const axis = dark ? '#475569' : '#94a3b8';
            const grid = dark ? '#334155' : '#e2e8f0';
            const lineCol = dark ? '#2dd4bf' : '#0f766e';
            const fillCol = dark ? '#2dd4bf' : '#14b8a6';
            const labelCol = dark ? '#94a3b8' : '#64748b';

            const xFor = (index) => padding.l + (index * (innerW / 11));
            const yFor = (value) => padding.t + innerH - (((value - minY) / (maxY - minY)) * innerH);

            const pts = predictions.map((item, index) => `${xFor(index)},${yFor(item.occupancy)}`);
            const points = pts.join(' ');
            const bottom = padding.t + innerH;
            const areaPolygon = `${xFor(0)},${bottom} ${points} ${xFor(11)},${bottom}`;

            const dots = predictions.map((item, index) =>
                `<circle cx="${xFor(index)}" cy="${yFor(item.occupancy)}" r="4.5" fill="${lineCol}"/>`
            ).join('');

            const xLabels = predictions.map((item, index) =>
                `<text x="${xFor(index)}" y="${height - 10}" text-anchor="middle" font-size="10" fill="${labelCol}">${item.hour}h</text>`
            ).join('');

            const yTicks = [40, 60, 80, 100].map((v) => {
                const y = yFor(v);
                return `<line x1="${padding.l}" y1="${y}" x2="${padding.l + innerW}" y2="${y}" stroke="${grid}" stroke-dasharray="4 4" opacity="0.85"/>
                    <text x="${padding.l - 8}" y="${y + 4}" text-anchor="end" font-size="10" fill="${labelCol}">${v}</text>`;
            }).join('');

            svg.innerHTML = `
                <line x1="${padding.l}" y1="${bottom}" x2="${padding.l + innerW}" y2="${bottom}" stroke="${axis}" />
                <line x1="${padding.l}" y1="${padding.t}" x2="${padding.l}" y2="${bottom}" stroke="${axis}" />
                ${yTicks}
                <text x="8" y="${padding.t + innerH / 2}" transform="rotate(-90 8 ${padding.t + innerH / 2})" font-size="10" fill="${labelCol}">% occ.</text>
                <polygon points="${areaPolygon}" fill="${fillCol}" fill-opacity="0.12" />
                <polyline points="${points}" fill="none" stroke="${lineCol}" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                ${dots}
                ${xLabels}
            `;
        }

        let electricalEnergyChartInstance = null;
        const chartFontUi = 'system-ui, -apple-system, "Segoe UI", Roboto, sans-serif';

        function buildEnergyChart() {
            const canvas = document.getElementById('chartElectricalEnergy');
            if (!canvas || typeof Chart === 'undefined') return;
            let payload = { labels: [], values: [] };
            try {
                const el = document.getElementById('electrical-energy-payload');
                if (el) payload = JSON.parse(el.textContent);
            } catch (e) {}
            if (!payload.labels || !payload.values || payload.labels.length === 0) return;

            if (electricalEnergyChartInstance) {
                electricalEnergyChartInstance.destroy();
                electricalEnergyChartInstance = null;
            }

            const dark = document.body.classList.contains('dark-mode');
            const tick = dark ? '#94a3b8' : '#64748b';
            const grid = dark ? 'rgba(148, 163, 184, 0.14)' : 'rgba(15, 23, 42, 0.06)';
            const teal = dark ? '#2dd4bf' : '#157b84';
            const tealDark = dark ? '#14b8a6' : '#0f5d68';

            const ctx = canvas.getContext('2d');
            const w = canvas.parentElement ? canvas.parentElement.clientWidth : 400;
            const gradient = ctx.createLinearGradient(0, 0, Math.max(w, 320), 0);
            gradient.addColorStop(0, tealDark + 'cc');
            gradient.addColorStop(1, teal + '99');

            electricalEnergyChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: payload.labels,
                    datasets: [{
                        label: 'Energy consumed (kWh)',
                        data: payload.values,
                        backgroundColor: gradient,
                        borderColor: teal,
                        borderWidth: 1,
                        borderRadius: 6,
                    }],
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Energy consumed (kWh)',
                                color: tick,
                                font: { family: chartFontUi, size: 12 },
                            },
                            ticks: { color: tick, font: { family: chartFontUi, size: 11 } },
                            grid: { color: grid },
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Equipment',
                                color: tick,
                                font: { family: chartFontUi, size: 12 },
                            },
                            ticks: { color: tick, font: { family: chartFontUi, size: 11 } },
                            grid: { display: false },
                        },
                    },
                },
            });
        }

        function alertItemHtml(message) {
            const hi = message.startsWith('High:');
            const med = message.startsWith('Medium:');
            const badge = hi ? '!!' : med ? '!' : 'OK';
            const badgeCls = hi ? 'text-rose-600' : med ? 'text-amber-700' : 'text-emerald-700';
            const box = hi
                ? 'border-rose-200 bg-rose-50 text-rose-900'
                : med
                    ? 'border-amber-200 bg-amber-50 text-amber-900'
                    : 'border-emerald-200 bg-emerald-50 text-emerald-900';
            return `<li class="flex gap-3 rounded-xl border px-4 py-3 text-sm font-medium leading-snug sm:text-base ${box}"><span class="mt-0.5 shrink-0 text-[10px] font-bold uppercase leading-none ${badgeCls}" aria-hidden="true">${badge}</span><span>${message}</span></li>`;
        }

        function renderList(elementId, items, classes, listType = 'normal') {
            const list = document.getElementById(elementId);
            if (listType === 'alerts') {
                list.innerHTML = items.map((item) => {
                    const message = typeof item === 'string' ? item : item.message;
                    return alertItemHtml(message);
                }).join('');
                return;
            }
            list.innerHTML = items.map((item) => `<li class="pl-1 ${classes}">${item}</li>`).join('');
        }

        function applyData(data) {
            const nowRiyadh = getRiyadhTime();
            document.getElementById('occupancy').textContent = data.ed_occupancy;
            document.getElementById('boarding').textContent = data.boarding_patients;
            document.getElementById('beds').textContent = data.available_beds;
            document.getElementById('wait').textContent = data.avg_wait_time;
            const timeEl = document.getElementById('updatedAt');
            timeEl.textContent = nowRiyadh;
            timeEl.setAttribute('datetime', new Date().toISOString());
            const hint = document.getElementById('kpiUpdatedHint');
            if (hint) hint.textContent = nowRiyadh;
            currentPredictions = data.predictions;
            buildChart(currentPredictions);

            data.alerts.forEach((message) => {
                alertHistory.unshift({ message, time: nowRiyadh });
            });
            alertHistory = alertHistory.slice(0, 12);

            renderList('recommendationsList', data.recommendations, 'text-sm leading-relaxed sm:text-base sm:leading-7');
            renderList('alertsList', alertHistory, '', 'alerts');
        }

        async function refreshData() {
            try {
                const response = await fetch(dataUrl, { headers: { 'Accept': 'application/json' } });
                if (!response.ok) return;
                applyData(await response.json());
            } catch (error) {
                console.error('Unable to refresh dashboard data.', error);
            }
        }

        (function () {
            const toggle = document.getElementById('themeToggleDashboard');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const saved = localStorage.getItem(themeKey);
            if (saved ? saved === 'dark' : prefersDark) document.body.classList.add('dark-mode');

            function updateThemeLabel() {
                const icon = document.getElementById('themeIconDashboard');
                icon.innerHTML = document.body.classList.contains('dark-mode')
                    ? '<svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8"><circle cx="12" cy="12" r="4"></circle><path stroke-linecap="round" d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"></path></svg>'
                    : '<svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"></path></svg>';
            }

            updateThemeLabel();
            toggle.addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem(themeKey, document.body.classList.contains('dark-mode') ? 'dark' : 'light');
                updateThemeLabel();
                buildChart(currentPredictions);
                buildEnergyChart();
            });
        })();

        const initTime = getRiyadhTime();
        document.getElementById('updatedAt').textContent = initTime;
        document.getElementById('updatedAt').setAttribute('datetime', new Date().toISOString());
        document.getElementById('kpiUpdatedHint').textContent = initTime;
        tickClock();
        setInterval(tickClock, 1000);
        buildChart(currentPredictions);
        buildEnergyChart();
        renderList('alertsList', alertHistory, '', 'alerts');
        setInterval(refreshData, 8000);
    </script>
</body>
</html>
