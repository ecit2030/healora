<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healora | Live Operations Board</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 30px -20px rgba(2, 132, 199, 0.4);
        }
    </style>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800 antialiased selection:bg-teal-100">
    <header class="sticky top-0 z-30 border-b border-teal-100 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-teal-700 text-lg font-bold text-white">H</span>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest text-teal-700">Healora</p>
                    <p class="text-xs text-slate-500">Live AI Command Center</p>
                </div>
            </a>
            <nav class="hidden items-center gap-7 text-sm font-medium text-slate-600 md:flex">
                <a href="{{ route('landing') }}" class="transition hover:text-teal-700">Landing</a>
                <a href="{{ route('dashboard') }}" class="text-teal-700">Live Board</a>
                <a href="{{ route('recommendations') }}" class="transition hover:text-teal-700">Recommendations</a>
                <a href="{{ route('landing') }}#contact" class="transition hover:text-teal-700">Contact</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-8 lg:px-8">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Hospital Operations Live Board</h1>
                <p class="text-sm text-slate-500">Real-time simulation refreshes every 8 seconds.</p>
            </div>
            <p class="rounded-full bg-teal-100 px-4 py-2 text-sm font-medium text-teal-800">Updated at <span id="updatedAt">{{ $updated_at }}</span></p>
        </div>

        <section class="grid gap-5 lg:grid-cols-12">
            <div class="grid gap-5 sm:grid-cols-2 lg:col-span-4 lg:grid-cols-1">
                <article class="card-lift rounded-2xl border border-teal-100 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">ED Occupancy</p>
                    <p class="mt-2 text-4xl font-bold text-teal-700"><span id="occupancy">{{ $ed_occupancy }}</span>%</p>
                    <p class="mt-2 text-xs text-slate-500">Target < 80%</p>
                </article>
                <article class="card-lift rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Boarding Patients</p>
                    <p class="mt-2 text-4xl font-bold text-slate-900" id="boarding">{{ $boarding_patients }}</p>
                    <p class="mt-2 text-xs text-slate-500">Exit block monitor</p>
                </article>
                <article class="card-lift rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Available Beds</p>
                    <p class="mt-2 text-4xl font-bold text-emerald-700" id="beds">{{ $available_beds }}</p>
                    <p class="mt-2 text-xs text-slate-500">Hospital-wide capacity</p>
                </article>
                <article class="card-lift rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Avg Wait Time</p>
                    <p class="mt-2 text-4xl font-bold text-slate-900"><span id="wait">{{ $avg_wait_time }}</span>m</p>
                    <p class="mt-2 text-xs text-slate-500">Door-to-provider benchmark</p>
                </article>
            </div>

            <div class="space-y-5 lg:col-span-8">
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <h2 class="text-lg font-semibold text-slate-900">Predicted ED Congestion (Next 12 Hours)</h2>
                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Forecasting Active</span>
                    </div>
                    <div class="mt-4 h-64 rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200/70">
                        <svg id="chart" viewBox="0 0 700 240" class="h-full w-full"></svg>
                    </div>
                </section>

                <div class="grid gap-5 md:grid-cols-2">
                    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between gap-4">
                            <h2 class="text-lg font-semibold text-slate-900">AI Recommendations</h2>
                            <span class="rounded-full bg-teal-100 px-3 py-1 text-xs font-semibold text-teal-700">Prioritized</span>
                        </div>
                        <ul id="recommendationsList" class="mt-4 space-y-3">
                            @foreach ($recommendations as $recommendation)
                                <li class="rounded-xl border border-teal-100 bg-teal-50 px-4 py-3 text-sm text-teal-900">{{ $recommendation }}</li>
                            @endforeach
                        </ul>
                    </section>

                    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between gap-4">
                            <h2 class="text-lg font-semibold text-slate-900">Alert Feed</h2>
                            <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">High Priority</span>
                        </div>
                        <ul id="alertsList" class="mt-4 space-y-3">
                            @foreach ($alerts as $alert)
                                <li class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">{{ $alert }}</li>
                            @endforeach
                        </ul>
                    </section>
                </div>
            </div>
        </section>
    </main>

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
                return `<circle cx="${xFor(index)}" cy="${yFor(item.occupancy)}" r="4" fill="#0f766e" />`;
            }).join('');
            const labels = predictions.map((item, index) => {
                return `<text x="${xFor(index) - 5}" y="${height - 6}" font-size="10" fill="#64748b">${item.hour}h</text>`;
            }).join('');
            const thresholdY = yFor(85);

            svg.innerHTML = `
                <line x1="${padding}" y1="${height - padding}" x2="${width - padding}" y2="${height - padding}" stroke="#cbd5e1" />
                <line x1="${padding}" y1="${padding}" x2="${padding}" y2="${height - padding}" stroke="#cbd5e1" />
                <line x1="${padding}" y1="${thresholdY}" x2="${width - padding}" y2="${thresholdY}" stroke="#fca5a5" stroke-dasharray="5 4" />
                <text x="${width - 105}" y="${thresholdY - 6}" font-size="10" fill="#be123c">Risk threshold</text>
                <polyline points="${points}" fill="none" stroke="#14b8a6" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                ${dotMarkup}
                ${labels}
            `;
        }

        function renderList(elementId, items, classes) {
            const list = document.getElementById(elementId);
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
                'rounded-xl border border-teal-100 bg-teal-50 px-4 py-3 text-sm text-teal-900'
            );
            renderList(
                'alertsList',
                data.alerts,
                'rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800'
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
