<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healora | AI Command Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
    <header class="sticky top-0 z-30 border-b border-teal-100/80 bg-white/90 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-teal-700 text-lg font-bold text-white">H</span>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest text-teal-700">Healora</p>
                    <p class="text-xs text-slate-500">Hospital AI Operations</p>
                </div>
            </a>
            <nav class="hidden items-center gap-7 text-sm font-medium text-slate-600 md:flex">
                <a href="{{ route('landing') }}" class="transition hover:text-teal-700">Landing</a>
                <a href="{{ route('dashboard') }}" class="transition hover:text-teal-700">Live Board</a>
                <a href="{{ route('recommendations') }}" class="transition hover:text-teal-700">Recommendations</a>
                <a href="#contact" class="transition hover:text-teal-700">Contact</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="relative overflow-hidden bg-gradient-to-br from-teal-950 via-teal-800 to-emerald-700">
            <div class="absolute -left-10 top-12 h-56 w-56 rounded-full bg-teal-300/30 blur-3xl"></div>
            <div class="absolute -right-10 bottom-0 h-72 w-72 rounded-full bg-emerald-200/20 blur-3xl"></div>
            <div class="mx-auto grid max-w-7xl gap-10 px-6 py-24 lg:grid-cols-2 lg:px-8">
                <div class="space-y-8 text-white">
                    <span class="inline-block rounded-full bg-teal-100/20 px-4 py-1 text-xs font-semibold uppercase tracking-widest text-teal-50">AI for Hospital Throughput</span>
                    <h1 class="text-4xl font-bold leading-tight md:text-5xl">AI Command Center for Hospital Operations</h1>
                    <p class="max-w-xl text-lg text-teal-50">Predict bottlenecks. Optimize resources. Save lives.</p>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-teal-700 shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl">
                        View Live Demo
                    </a>
                </div>
                <div class="rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur">
                    <div class="grid grid-cols-2 gap-4 text-white">
                        <div class="rounded-2xl bg-white/15 p-4">
                            <p class="text-xs uppercase tracking-widest text-teal-100">ED Occupancy</p>
                            <p class="mt-2 text-3xl font-semibold">91%</p>
                        </div>
                        <div class="rounded-2xl bg-white/15 p-4">
                            <p class="text-xs uppercase tracking-widest text-teal-100">Boarding</p>
                            <p class="mt-2 text-3xl font-semibold">22</p>
                        </div>
                        <div class="rounded-2xl bg-white/15 p-4">
                            <p class="text-xs uppercase tracking-widest text-teal-100">AI Alerts</p>
                            <p class="mt-2 text-3xl font-semibold">3</p>
                        </div>
                        <div class="rounded-2xl bg-white/15 p-4">
                            <p class="text-xs uppercase tracking-widest text-teal-100">Wait Time</p>
                            <p class="mt-2 text-3xl font-semibold">74m</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
            <h2 class="text-3xl font-semibold text-slate-900">The Exit Block Problem</h2>
            <p class="mt-3 max-w-3xl text-slate-600">Exit Block occurs when admitted patients remain in the Emergency Department because inpatient beds are unavailable. This creates a system-wide throughput failure that impacts safety, staff burnout, and outcomes.</p>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <article class="rounded-2xl border border-teal-100 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-teal-800">ED Overcrowding</h3>
                    <p class="mt-2 text-sm text-slate-600">High occupancy drives longer triage and treatment times, worsening patient flow.</p>
                </article>
                <article class="rounded-2xl border border-teal-100 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-teal-800">Delayed Discharges</h3>
                    <p class="mt-2 text-sm text-slate-600">Slow discharge processes block beds needed for incoming patients from ED.</p>
                </article>
                <article class="rounded-2xl border border-teal-100 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-teal-800">Resource Inefficiency</h3>
                    <p class="mt-2 text-sm text-slate-600">Staff and bed allocation become reactive instead of proactive, increasing cost.</p>
                </article>
            </div>
        </section>

        <section class="bg-[#ccfbf1]/40 py-20">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <h2 class="text-3xl font-semibold text-slate-900">Healora: AI-powered control tower for hospitals</h2>
                <div class="mt-10 grid gap-6 md:grid-cols-3">
                    <div class="rounded-2xl bg-white p-6 shadow-sm">
                        <h3 class="font-semibold text-teal-800">Real-time dashboard</h3>
                        <p class="mt-2 text-sm text-slate-600">Unified operational view of occupancy, waits, boarding, and bed status.</p>
                    </div>
                    <div class="rounded-2xl bg-white p-6 shadow-sm">
                        <h3 class="font-semibold text-teal-800">Predictive alerts</h3>
                        <p class="mt-2 text-sm text-slate-600">Forecast congestion risk before thresholds are breached.</p>
                    </div>
                    <div class="rounded-2xl bg-white p-6 shadow-sm">
                        <h3 class="font-semibold text-teal-800">Smart recommendations</h3>
                        <p class="mt-2 text-sm text-slate-600">Clear actions for staffing, discharge sequencing, and elective load balancing.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
            <h2 class="text-3xl font-semibold text-slate-900">Platform Features</h2>
            <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach (['Patient Flow Dashboard', 'AI Predictions', 'Staff Optimization', 'FHIR Integration'] as $feature)
                    <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <h3 class="font-semibold text-teal-800">{{ $feature }}</h3>
                        <p class="mt-2 text-sm text-slate-600">Investor-ready workflows designed for executive and operational teams.</p>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="bg-slate-900 py-20">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <h2 class="text-3xl font-semibold text-white">How It Works</h2>
                <div class="mt-10 grid gap-4 md:grid-cols-4">
                    @foreach (['Hospital Data', 'AI Engine', 'Recommendations', 'Dashboard'] as $step)
                        <div class="rounded-2xl border border-white/15 bg-white/5 p-6 text-center text-white">
                            <p class="text-sm font-semibold uppercase tracking-widest text-teal-200">{{ $loop->iteration }}</p>
                            <p class="mt-2 font-medium">{{ $step }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="contact" class="bg-gradient-to-r from-teal-700 to-emerald-700 py-20 text-white">
            <div class="mx-auto max-w-7xl px-6 text-center lg:px-8">
                <h2 class="text-3xl font-semibold">Start with a Pilot Hospital</h2>
                <p class="mx-auto mt-3 max-w-2xl text-teal-50">See how Healora turns operational data into real-time decisions that reduce congestion and improve care delivery.</p>
                <a href="{{ route('dashboard') }}" class="mt-8 inline-flex items-center rounded-xl bg-white px-7 py-3 text-sm font-semibold text-teal-700 shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl">
                    Request Demo
                </a>
            </div>
        </section>
    </main>
</body>
</html>
