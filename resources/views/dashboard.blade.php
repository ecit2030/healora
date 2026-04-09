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
        }
        .app-shell {
            background: var(--bg-soft);
        }
    </style>
</head>
<body class="app-shell min-h-screen text-slate-800 antialiased">
    <header class="border-b border-slate-200 bg-white/95">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 lg:px-8">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <img src="{{ asset('brand/healora-logo.png') }}" alt="Healora logo" class="h-11 w-36 rounded-lg object-cover ring-1 ring-slate-200">
            </a>
            <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 md:flex">
                <a href="{{ route('landing') }}" class="transition hover:text-teal-700">Landing</a>
                <a href="{{ route('dashboard') }}" class="text-teal-700">Live Board</a>
                <a href="{{ route('recommendations') }}" class="transition hover:text-teal-700">Recommendations</a>
            </nav>
            <a href="{{ route('landing') }}#contact" class="rounded-xl bg-teal-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-800">Contact</a>
        </div>
    </header>

    <section class="bg-gradient-to-r from-[#1a8a90] to-[#116b75]">
        <div class="mx-auto max-w-7xl px-4 py-10 lg:px-8">
            <div class="mb-3 flex gap-2">
                <span class="rounded-full border border-white/35 bg-white/15 px-3 py-1 text-xs font-medium text-white">Demo Environment</span>
                <span class="rounded-full border border-white/35 bg-white/15 px-3 py-1 text-xs font-medium text-white">Data-Driven Decisions</span>
            </div>
            <h1 class="text-5xl font-bold text-white">Healora Command Center</h1>
            <p class="mt-3 max-w-4xl text-xl text-teal-50">Example of how hospital operations teams monitor congestion, receive predictive alerts, and execute decisions in one control-tower dashboard.</p>
        </div>
    </section>

    <main class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        <section class="grid gap-5 lg:grid-cols-12">
            <div class="space-y-4 lg:col-span-3">
                <article class="rounded-2xl border border-teal-100 bg-white p-4 shadow-sm">
                    <p class="text-2xl font-semibold text-[var(--teal)]">Hospital Status</p>
                    <div class="mt-3 space-y-2">
                        <div class="rounded-xl border border-slate-100 bg-slate-50 px-3 py-2">
                            <p class="text-sm text-slate-500">ED Occupancy</p>
                            <p class="text-3xl font-bold text-teal-700"><span id="occupancy">{{ $ed_occupancy }}</span>%</p>
                        </div>
                        <div class="rounded-xl border border-slate-100 bg-slate-50 px-3 py-2">
                            <p class="text-sm text-slate-500">Boarding Patients</p>
                            <p class="text-3xl font-bold text-slate-800" id="boarding">{{ $boarding_patients }}</p>
                        </div>
                        <div class="rounded-xl border border-slate-100 bg-slate-50 px-3 py-2">
                            <p class="text-sm text-slate-500">Available Beds</p>
                            <p class="text-3xl font-bold text-slate-800" id="beds">{{ $available_beds }}</p>
                        </div>
                        <div class="rounded-xl border border-slate-100 bg-slate-50 px-3 py-2">
                            <p class="text-sm text-slate-500">Avg Wait Time</p>
                            <p class="text-3xl font-bold text-teal-700"><span id="wait">{{ $avg_wait_time }}</span>m</p>
                        </div>
                    </div>
                </article>

                <section class="rounded-2xl border border-teal-100 bg-white p-4 shadow-sm">
                    <h2 class="text-xl font-semibold text-teal-700">AI Recommendations</h2>
                    <ul id="recommendationsList" class="mt-3 list-disc space-y-2 pl-5 text-slate-700">
                        @foreach ($recommendations as $recommendation)
                            <li class="text-[1.05rem] leading-8">{{ $recommendation }}</li>
                        @endforeach
                    </ul>
                </section>
            </div>

            <div class="space-y-4 lg:col-span-9">
                <section class="rounded-2xl border border-teal-100 bg-white p-4 shadow-sm">
                    <div class="mb-2 flex items-center justify-between">
                        <h2 class="text-2xl font-semibold text-teal-700">Predicted ED Congestion (Next 12 Hours)</h2>
                        <span class="rounded-full bg-teal-50 px-3 py-1 text-xs font-semibold text-teal-700">AI Model Active</span>
                    </div>
                    <div class="h-56 rounded-xl bg-slate-50 p-2">
                        <svg id="chart" viewBox="0 0 700 240" class="h-full w-full"></svg>
                    </div>
                </section>

                <section class="rounded-2xl border border-teal-100 bg-white p-4 shadow-sm">
                    <h2 class="text-4xl font-semibold text-teal-700">Alert Feed</h2>
                    <p class="mb-3 mt-1 text-xs text-slate-500">Updated at <span id="updatedAt">{{ $updated_at }}</span></p>
                    <ul id="alertsList" class="space-y-3">
                        @foreach ($alerts as $alert)
                            <li class="rounded-2xl border px-5 py-4 text-lg font-medium leading-tight {{ str_starts_with($alert, 'High:') ? 'border-rose-200 bg-rose-50 text-rose-900' : (str_starts_with($alert, 'Medium:') ? 'border-amber-200 bg-amber-50 text-amber-900' : 'border-emerald-200 bg-emerald-50 text-emerald-900') }}">{{ $alert }}</li>
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
                return 'rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-lg font-medium text-rose-900';
            }
            if (alert.startsWith('Medium:')) {
                return 'rounded-2xl border border-amber-200 bg-amber-50 px-5 py-4 text-lg font-medium text-amber-900';
            }
            return 'rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-lg font-medium text-emerald-900';
        }

        function renderList(elementId, items, classes, listType = 'normal') {
            const list = document.getElementById(elementId);
            if (listType === 'alerts') {
                list.innerHTML = items.map((item) => `<li class="${alertClass(item)}">${item}</li>`).join('');
                return;
            }
            list.innerHTML = items.map((item) => `<li class="${classes}">${item}</li>`).join('');
        }

        function applyData(data) {
            document.getElementById('occupancy').textContent = data.ed_occupancy;
            document.getElementById('boarding').textContent = data.boarding_patients;
            document.getElementById('beds').textContent = data.available_beds;
            document.getElementById('wait').textContent = data.avg_wait_time;
            document.getElementById('updatedAt').textContent = data.updated_at;
            currentPredictions = data.predictions;
            buildChart(currentPredictions);

            renderList(
                'recommendationsList',
                data.recommendations,
                'text-[1.05rem]'
            );
            renderList(
                'alertsList',
                data.alerts,
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

        buildChart(currentPredictions);
        window.setInterval(refreshData, 8000);
    </script>
</body>
</html>
