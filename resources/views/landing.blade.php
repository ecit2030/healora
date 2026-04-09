<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healora | AI Command Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root{
            --bg-soft:#e9f3f4;
            --teal:#157b84;
            --teal-dark:#0f5d68;
            --card:#f7fbfc;
        }
    </style>
</head>
<body class="bg-[var(--bg-soft)] text-slate-700 antialiased">
    <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 lg:px-8">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <img src="{{ asset('brand/healora-logo.png') }}" alt="Healora logo" class="h-11 w-36 rounded-lg object-cover ring-1 ring-slate-200">
            </a>
            <nav class="hidden items-center gap-6 text-sm font-semibold text-slate-600 md:flex">
                <a href="#why" class="transition hover:text-[var(--teal)]">Why Healora</a>
                <a href="#features" class="transition hover:text-[var(--teal)]">Features</a>
                <a href="#impact" class="transition hover:text-[var(--teal)]">Impact</a>
            </nav>
            <a href="{{ route('dashboard') }}" class="rounded-xl bg-[var(--teal)] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[var(--teal-dark)]">Open Demo</a>
        </div>
    </header>

    <main>
        <section class="bg-gradient-to-r from-[#1a8a90] via-[#147b84] to-[#0d4e68] py-16 text-white">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 lg:grid-cols-[1.3fr_1fr] lg:px-8">
                <div>
                    <span class="inline-block rounded-full border border-white/30 bg-white/15 px-4 py-1 text-xs font-semibold">AI Hospital Operations Platform</span>
                    <h1 class="mt-5 max-w-2xl text-5xl font-bold leading-tight">Predict Exit Block before it impacts patient care.</h1>
                    <p class="mt-4 max-w-2xl text-lg text-slate-100">Healora gives hospitals a real-time control tower that predicts congestion, prioritizes actions, and helps teams make faster and better operational decisions.</p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('dashboard') }}" class="rounded-xl bg-white px-6 py-3 text-sm font-semibold text-[var(--teal-dark)]">View Live Demo</a>
                        <a href="#features" class="rounded-xl border border-white/35 bg-white/10 px-6 py-3 text-sm font-semibold text-white">Explore Features</a>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur">
                        <p class="text-xs text-slate-200">Prediction Accuracy</p>
                        <p class="mt-1 text-3xl font-bold">95-98%</p>
                    </div>
                    <div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur">
                        <p class="text-xs text-slate-200">Forecast Horizon</p>
                        <p class="mt-1 text-3xl font-bold">12 Hours</p>
                    </div>
                    <div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur">
                        <p class="text-xs text-slate-200">Potential Cost Reduction</p>
                        <p class="mt-1 text-3xl font-bold">6.5% ED Spend</p>
                    </div>
                    <div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur">
                        <p class="text-xs text-slate-200">Value from 1h Wait Cut</p>
                        <p class="mt-1 text-3xl font-bold">$4.9M</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="why" class="mx-auto max-w-7xl px-4 py-14 lg:px-8">
            <h2 class="text-center text-4xl font-bold text-[var(--teal-dark)]">Why Healora</h2>
            <p class="mt-3 text-center text-xl text-slate-600">Hospitals do not fail from lack of data. They fail from delayed decisions.</p>
            <div class="mt-8 grid gap-4 md:grid-cols-3">
                <article class="rounded-2xl border border-slate-200 bg-[var(--card)] p-5 shadow-sm">
                    <h3 class="text-2xl font-semibold text-[var(--teal)]">Current Pain</h3>
                    <p class="mt-2 text-lg">Fragmented communication, siloed workflows, and reactive management.</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-[var(--card)] p-5 shadow-sm">
                    <h3 class="text-2xl font-semibold text-[var(--teal)]">Core Problem</h3>
                    <p class="mt-2 text-lg">Exit Block creates hidden bottlenecks between clinical readiness and discharge flow.</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-[var(--card)] p-5 shadow-sm">
                    <h3 class="text-2xl font-semibold text-[var(--teal)]">Healora Shift</h3>
                    <p class="mt-2 text-lg">From reactive crisis handling to predictive, AI-guided operational control.</p>
                </article>
            </div>
        </section>

        <section id="features" class="mx-auto max-w-7xl px-4 py-14 lg:px-8">
            <h2 class="text-center text-4xl font-bold text-[var(--teal-dark)]">Platform Features</h2>
            <p class="mt-3 text-center text-xl text-slate-600">Everything hospitals need to detect and resolve congestion early.</p>
            <div class="mt-8 grid gap-4 md:grid-cols-3">
                @foreach ([
                    ['FHIR Data Integration', 'Realtime integration with EHR/HIS, bed occupancy, staff, and OR schedules.'],
                    ['Predictive AI Engine', 'Forecast bottlenecks and ED congestion risk up to 12 hours ahead.'],
                    ['Action Recommendations', 'Suggests staff reallocation, discharge prioritization, and schedule adjustments.'],
                    ['Role-Based Dashboards', 'Views tailored for clinical teams, operations managers, and executives.'],
                    ['Alerting System', 'Critical notifications through dashboard, email, or SMS channels.'],
                    ['Compliance by Design', 'End-to-end encryption, RBAC, and Saudi data residency-ready architecture.'],
                ] as $feature)
                    <article class="rounded-2xl border border-slate-200 bg-[var(--card)] p-5 shadow-sm">
                        <h3 class="text-2xl font-semibold text-[var(--teal)]">{{ $feature[0] }}</h3>
                        <p class="mt-2 text-lg">{{ $feature[1] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <section id="impact" class="mx-auto max-w-7xl px-4 py-14 lg:px-8">
            <h2 class="text-center text-4xl font-bold text-[var(--teal-dark)]">Measurable Impact</h2>
            <p class="mt-3 text-center text-xl text-slate-600">Operational, financial, and patient-care impact in one platform.</p>
            <div class="mt-8 grid gap-4 md:grid-cols-4">
                @foreach ([
                    ['Patient Impact', 'Reduced waiting times and better patient flow to improve care outcomes.'],
                    ['Economic Impact', 'Unlocks hidden capacity without adding physical infrastructure.'],
                    ['Decision Culture', 'Operational teams move from reactive firefighting to proactive planning.'],
                    ['Vision 2030 Impact', 'Supports Saudi Health Sector Transformation with smarter public healthcare.'],
                ] as $impact)
                    <article class="rounded-2xl border border-slate-200 bg-[var(--card)] p-5 shadow-sm">
                        <h3 class="text-2xl font-semibold text-[var(--teal)]">{{ $impact[0] }}</h3>
                        <p class="mt-2 text-lg">{{ $impact[1] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-14 lg:px-8">
            <h2 class="text-center text-4xl font-bold text-[var(--teal-dark)]">Research That Informed Healora</h2>
            <p class="mt-3 text-center text-xl text-slate-600">The platform is grounded in recent evidence on health system transformation, predictive analytics, and population health operations.</p>
            <div class="mt-8 grid gap-4 md:grid-cols-3">
                <article class="rounded-2xl border border-slate-200 bg-[var(--card)] p-5 shadow-sm">
                    <p class="inline-block rounded-full bg-teal-100 px-2 py-1 text-xs font-semibold text-[var(--teal-dark)]">Arabic Reference (2026)</p>
                    <h3 class="mt-3 text-2xl font-semibold text-[var(--teal)]">Latest Updates in Health Systems and Solutions (2026)</h3>
                    <p class="mt-2 text-lg">This study highlights accelerating digital transformation, the importance of interoperability, cybersecurity readiness, and AI's role in improving operational efficiency while reducing administrative burden.</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-[var(--card)] p-5 shadow-sm">
                    <p class="inline-block rounded-full bg-teal-100 px-2 py-1 text-xs font-semibold text-[var(--teal-dark)]">Arabic Reference (2026)</p>
                    <h3 class="mt-3 text-2xl font-semibold text-[var(--teal)]">AI Systems in Healthcare (2026)</h3>
                    <p class="mt-2 text-lg">The report supports predictive-system trends, AI-enabled clinical decision support, and integration with EHRs and operational hospital systems.</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-[var(--card)] p-5 shadow-sm">
                    <p class="inline-block rounded-full bg-teal-100 px-2 py-1 text-xs font-semibold text-[var(--teal-dark)]">AJMC 2023</p>
                    <h3 class="mt-3 text-2xl font-semibold text-[var(--teal)]">Planning for the Future of Population Health</h3>
                    <p class="mt-2 text-lg">The Johns Hopkins experience shows that success depends on unified operating structures, analytics roadmaps, and cross-department care coordination to reduce avoidable utilization and improve outcomes.</p>
                </article>
            </div>
            <div class="mt-4 rounded-2xl border border-teal-200 bg-teal-50 p-4 text-lg">
                <span class="font-semibold text-[var(--teal-dark)]">How this shaped Healora:</span>
                Healora is designed as a real-time hospital control tower built on early prediction and actionable recommendations, aligned with modern health transformation requirements and Vision 2030 direction.
            </div>
        </section>

        <section id="contact" class="bg-gradient-to-r from-[#167b83] to-[#0d6570] py-14 text-white">
            <div class="mx-auto max-w-7xl px-4 text-center lg:px-8">
                <h2 class="text-4xl font-bold">Ready to see Healora in action?</h2>
                <p class="mx-auto mt-3 max-w-2xl text-xl text-teal-50">Open the live demo and explore a real control-tower workflow.</p>
                <div class="mt-7 flex justify-center gap-3">
                    <a href="{{ route('dashboard') }}" class="rounded-xl bg-white px-7 py-3 text-sm font-semibold text-[var(--teal-dark)]">Open Demo</a>
                    <a href="{{ route('dashboard') }}" class="rounded-xl border border-white/40 bg-white/10 px-7 py-3 text-sm font-semibold text-white">Request Pilot</a>
                </div>
            </div>
        </section>

        <footer class="border-t border-slate-200 bg-white py-5 text-center text-sm text-slate-500">
            © 2026 Healora Platform - AI-Powered Hospital Operations
        </footer>
    </main>
</body>
</html>
