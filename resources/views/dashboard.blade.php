<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healora | Live Operations Board</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        .app-shell {
            background: var(--bg-soft);
        }
        body.dark-mode .bg-white { background-color: var(--surface) !important; }
        body.dark-mode .bg-white\/95 { background-color: rgba(15, 27, 46, 0.95) !important; }
        body.dark-mode .bg-slate-50 { background-color: rgba(255,255,255,0.03) !important; }
        body.dark-mode .border-slate-200,
        body.dark-mode .border-slate-100,
        body.dark-mode .border-teal-100 { border-color: var(--line) !important; }
        body.dark-mode .text-slate-800,
        body.dark-mode .text-slate-700,
        body.dark-mode .text-slate-600,
        body.dark-mode .text-slate-500 { color: var(--muted) !important; }
        body.dark-mode .text-teal-700 { color: var(--teal) !important; }
        .chip-icon{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            width:2rem;
            height:2rem;
            border-radius:9999px;
            margin-right:.5rem;
            background:rgba(20,184,166,.12);
            border:1px solid rgba(20,184,166,.32);
        }
        .chip-icon svg{
            width:1rem;
            height:1rem;
            stroke:currentColor;
        }
        .theme-icon{
            width:1rem;
            height:1rem;
            stroke:currentColor;
        }
    </style>
</head>
<body class="app-shell min-h-screen text-slate-800 antialiased">
    <header class="border-b border-slate-200 bg-white/95">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 lg:px-8">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <img src="{{ asset('brand/healora-wordmark.png') }}" alt="Healora wordmark" class="h-10 w-auto object-contain">
            </a>
            <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 md:flex">
                <a href="{{ route('landing') }}" class="transition hover:text-teal-700">Landing</a>
                <a href="{{ route('dashboard') }}" class="text-teal-700">Live Board</a>
                <a href="{{ route('recommendations') }}" class="transition hover:text-teal-700">Recommendations</a>
            </nav>
            <div class="flex items-center gap-2">
                <button id="themeToggleDashboard" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-300 bg-white text-slate-700 transition hover:bg-slate-50" aria-label="Toggle color theme" title="Toggle color theme">
                    <span id="themeIconDashboard" aria-hidden="true">
                        <svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"/>
                        </svg>
                    </span>
                </button>
                <a href="{{ route('landing') }}#contact" class="rounded-xl bg-teal-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-800">Contact</a>
            </div>
        </div>
    </header>

    <section class="bg-gradient-to-r from-[#1a8a90] to-[#116b75]">
        <div class="mx-auto max-w-7xl px-4 py-10 lg:px-8">
            <div class="mb-4 flex flex-wrap gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-full border border-white/35 bg-white/15 px-3 py-1 text-xs font-medium text-white"><svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M10 3v5l-4.5 8a2 2 0 0 0 1.7 3h9.6a2 2 0 0 0 1.7-3L14 8V3"/></svg>Demo Environment</span>
                <span class="inline-flex items-center gap-1.5 rounded-full border border-white/35 bg-white/15 px-3 py-1 text-xs font-medium text-white"><svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19h16M7 14l3-3 3 2 4-5"/></svg>Data-Driven Decisions</span>
            </div>
            <h1 class="text-4xl font-bold text-white md:text-5xl">Healora Command Center</h1>
            <p class="mt-3 max-w-4xl text-lg text-teal-50 md:text-xl">Example of how hospital operations teams monitor congestion, receive predictive alerts, and execute decisions in one control-tower dashboard.</p>
        </div>
    </section>

    <main class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        <section class="grid gap-6 lg:grid-cols-12">
            <div class="space-y-5 lg:col-span-4">
                <article class="rounded-2xl border border-teal-100 bg-white p-6 shadow-sm">
                    <p class="text-2xl font-semibold text-[var(--teal)]"><span class="chip-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 20V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14M9 20v-4h6v4M9 8h.01M15 8h.01M9 12h.01M15 12h.01"/></svg></span>Hospital Status</p>
                    <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
                        <div class="rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">
                            <p class="text-sm text-slate-500">ED Occupancy</p>
                            <p class="text-3xl font-bold text-teal-700"><span id="occupancy">{{ $ed_occupancy }}</span>%</p>
                        </div>
                        <div class="rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">
                            <p class="text-sm text-slate-500">Boarding Patients</p>
                            <p class="text-3xl font-bold text-slate-800" id="boarding">{{ $boarding_patients }}</p>
                        </div>
                        <div class="rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">
                            <p class="text-sm text-slate-500">Available Beds</p>
                            <p class="text-3xl font-bold text-slate-800" id="beds">{{ $available_beds }}</p>
                        </div>
                        <div class="rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">
                            <p class="text-sm text-slate-500">Avg Wait Time</p>
                            <p class="text-3xl font-bold text-teal-700"><span id="wait">{{ $avg_wait_time }}</span>m</p>
                        </div>
                    </div>
                </article>

                <section class="rounded-2xl border border-teal-100 bg-white p-6 shadow-sm">
                    <h2 class="text-2xl font-semibold text-teal-700"><span class="chip-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3a6 6 0 0 0-3.8 10.6c.8.7 1.3 1.5 1.3 2.4h5c0-.9.5-1.7 1.3-2.4A6 6 0 0 0 12 3Z"/><path stroke-linecap="round" d="M10 19h4M10.5 21h3"/></svg></span>AI Recommendations</h2>
                    <ul id="recommendationsList" class="mt-3 list-disc space-y-2 pl-5 text-slate-700">
                        @foreach ($recommendations as $recommendation)
                            <li class="text-base leading-8 md:text-lg">{{ $recommendation }}</li>
                        @endforeach
                    </ul>
                </section>
            </div>

            <div class="space-y-5 lg:col-span-8">
                <section class="rounded-2xl border border-teal-100 bg-white p-6 shadow-sm">
                    <div class="mb-3 flex items-center justify-between">
                        <h2 class="text-2xl font-semibold text-teal-700 md:text-3xl"><span class="chip-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19h16M7 15l3-3 3 2 4-5"/></svg></span>Predicted ED Congestion (Next 12 Hours)</h2>
                        <span class="rounded-full bg-teal-50 px-3 py-1 text-xs font-semibold text-teal-700">AI Model Active</span>
                    </div>
                    <div class="h-72 rounded-xl bg-slate-50 p-3">
                        <svg id="chart" viewBox="0 0 700 240" class="h-full w-full"></svg>
                    </div>
                </section>

                <section class="rounded-2xl border border-teal-100 bg-white p-6 shadow-sm">
                    <h2 class="text-2xl font-semibold text-teal-700 md:text-3xl"><span class="chip-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.9 2.6 17.2A2 2 0 0 0 4.3 20h15.4a2 2 0 0 0 1.7-2.8L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg></span>Alert Feed</h2>
                    <p class="mb-3 mt-1 text-xs text-slate-500">Updated at <span id="updatedAt">{{ $updated_at }}</span></p>
                    <ul id="alertsList" class="space-y-3">
                        @foreach ($alerts as $alert)
                            <li class="rounded-2xl border px-4 py-3 text-sm font-medium leading-6 md:text-base {{ str_starts_with($alert, 'High:') ? 'border-rose-200 bg-rose-50 text-rose-900' : (str_starts_with($alert, 'Medium:') ? 'border-amber-200 bg-amber-50 text-amber-900' : 'border-emerald-200 bg-emerald-50 text-emerald-900') }}">{{ $alert }}</li>
                        @endforeach
                    </ul>
                </section>
            </div>
        </section>
    </main>
    <footer class="border-t border-slate-200 bg-white py-5 text-center text-sm text-slate-500">
        © 2026 Healora Demo - Illustrative data for presentation use.
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

        function buildChart(predictions) {
            const svg = document.getElementById('chart');
            const width = 700;
            const height = 240;
            const padding = 24;
            const minY = 40;
            const maxY = 100;

            const xFor = (index) => padding + (index * ((width - (padding * 2)) / 11));
            const yFor = (value) => height - padding - (((value - minY) / (maxY - minY)) * (height - (padding * 2)));

            const points = predictions.map((item, index) => `${xFor(index)},${yFor(item.occupancy)}`).join(' ');
            const dotMarkup = predictions.map((item, index) => {
                return `<circle cx="${xFor(index)}" cy="${yFor(item.occupancy)}" r="5" fill="#0f8b8d" opacity="0.95" />`;
            }).join('');
            const labels = predictions.map((item, index) => {
                return `<text x="${xFor(index) - 5}" y="${height - 6}" font-size="10" fill="#64748b">${item.hour}h</text>`;
            }).join('');

            svg.innerHTML = `
                <line x1="${padding}" y1="${height - padding}" x2="${width - padding}" y2="${height - padding}" stroke="#d1d5db" />
                <line x1="${padding}" y1="${padding}" x2="${padding}" y2="${height - padding}" stroke="#d1d5db" />
                <polyline points="${points}" fill="none" stroke="#8dd5d6" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                ${dotMarkup}
                ${labels}
            `;
        }

        function alertClass(alert) {
            if (alert.startsWith('High:')) {
                return 'rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm md:text-base font-medium text-rose-900';
            }
            if (alert.startsWith('Medium:')) {
                return 'rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm md:text-base font-medium text-amber-900';
            }
            return 'rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm md:text-base font-medium text-emerald-900';
        }

        function renderList(elementId, items, classes, listType = 'normal') {
            const list = document.getElementById(elementId);
            if (listType === 'alerts') {
                list.innerHTML = items.map((item) => {
                    const message = typeof item === 'string' ? item : item.message;
                    return `<li class="${alertClass(message)}">${message}</li>`;
                }).join('');
                return;
            }
            list.innerHTML = items.map((item) => `<li class="${classes}">${item}</li>`).join('');
        }

        function applyData(data) {
            const nowRiyadh = getRiyadhTime();
            document.getElementById('occupancy').textContent = data.ed_occupancy;
            document.getElementById('boarding').textContent = data.boarding_patients;
            document.getElementById('beds').textContent = data.available_beds;
            document.getElementById('wait').textContent = data.avg_wait_time;
            document.getElementById('updatedAt').textContent = nowRiyadh;
            currentPredictions = data.predictions;
            buildChart(currentPredictions);

            // Keep a running alert timeline so alerts stack over time.
            data.alerts.forEach((message) => {
                alertHistory.unshift({ message, time: nowRiyadh });
            });
            alertHistory = alertHistory.slice(0, 12);

            renderList(
                'recommendationsList',
                data.recommendations,
                'text-sm md:text-base leading-7'
            );
            renderList(
                'alertsList',
                alertHistory,
                '',
                'alerts'
            );
        }

        async function refreshData() {
            try {
                const response = await fetch(dataUrl, { headers: { 'Accept': 'application/json' } });
                if (!response.ok) return;
                const data = await response.json();
                applyData(data);
            } catch (error) {
                console.error('Unable to refresh dashboard data.', error);
            }
        }

        (function () {
            const toggle = document.getElementById('themeToggleDashboard');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const saved = localStorage.getItem(themeKey);
            const isDark = saved ? saved === 'dark' : prefersDark;
            if (isDark) document.body.classList.add('dark-mode');

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
            });
        })();

        document.getElementById('updatedAt').textContent = getRiyadhTime();
        buildChart(currentPredictions);
        renderList('alertsList', alertHistory, '', 'alerts');
        window.setInterval(refreshData, 8000);
    </script>
</body>
</html>
