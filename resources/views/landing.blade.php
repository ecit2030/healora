<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healora | AI Command Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --bg-soft: #d8e1ec;
            --surface: #eaf0f7;
            --ink: #0b1324;
            --muted: #4f5d75;
            --line: #cfd7e3;
            --card: #edf3fa;
            --brand: #1c5f86;
            --brand-dark: #0f3f63;
        }
    </style>
</head>
<body class="min-h-screen bg-[var(--bg-soft)] text-[var(--ink)] antialiased">
    <main class="mx-auto max-w-[1240px] px-5 py-8 lg:px-8">
        <section class="rounded-[2rem] border border-[var(--line)] bg-[var(--surface)] p-7 shadow-[0_30px_70px_-40px_rgba(15,35,65,.5)] lg:p-10">
            <header class="flex items-center justify-between">
                <a href="{{ route('landing') }}" class="flex items-center gap-3">
                    <img src="{{ asset('brand/healora-wordmark.png') }}" alt="Healora wordmark" class="h-10 w-auto object-contain">
                </a>
                <nav class="hidden items-center gap-7 text-sm font-medium text-[var(--muted)] md:flex">
                    <a href="#about" class="transition hover:text-[var(--brand)]">Home</a>
                    <a href="#about" class="transition hover:text-[var(--brand)]">About</a>
                    <a href="#technology" class="transition hover:text-[var(--brand)]">Technology</a>
                    <a href="#services" class="transition hover:text-[var(--brand)]">Services</a>
                </nav>
                <a href="{{ route('dashboard') }}" class="rounded-full bg-black px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">Book a call</a>
            </header>

            <div class="mt-10 grid gap-8 lg:grid-cols-[1.05fr_.95fr]">
                <div class="space-y-6">
                    <span class="inline-block rounded-full border border-slate-200 bg-white px-4 py-1 text-xs font-medium text-slate-600">World's Most Adopted Healthcare AI</span>
                    <h1 class="max-w-xl text-5xl font-semibold leading-[1.05] tracking-tight md:text-7xl">Revolutionizing Healthcare with AI</h1>
                    <p class="max-w-xl text-lg leading-8 text-[var(--muted)]">Redefine healthcare with AI. Experience the power of faster diagnostics and precisely tailored treatments, designed by Healora. Bridge the gap between intelligent technology and clinical excellence.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('dashboard') }}" class="rounded-full bg-black px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Book a call</a>
                        <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-300 bg-[var(--surface)] px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-white">Appointment</a>
                    </div>
                    <div class="flex items-center gap-3 pt-3">
                        <div class="flex -space-x-2">
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white bg-slate-300 text-xs font-semibold text-slate-700">A</span>
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white bg-slate-300 text-xs font-semibold text-slate-700">M</span>
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white bg-slate-300 text-xs font-semibold text-slate-700">S</span>
                        </div>
                        <p class="text-sm text-[var(--muted)]"><span class="font-semibold text-slate-700">Rated 5/5</span> and trusted by <span class="font-semibold text-slate-700">1000+ patients</span></p>
                    </div>
                </div>

                <div class="relative min-h-[460px] rounded-[1.6rem] border border-slate-200 bg-gradient-to-br from-[#dfe8f2] via-[#d4dfed] to-[#cad7e9] p-6 overflow-hidden">
                    <div class="absolute -top-8 left-10 h-44 w-44 rounded-full bg-cyan-200/70 blur-2xl"></div>
                    <div class="absolute top-10 right-6 h-52 w-52 rounded-full bg-indigo-200/70 blur-3xl"></div>
                    <div class="absolute bottom-6 left-8 right-8 h-64 rounded-[1.8rem] bg-gradient-to-br from-[#b4c4d9] to-[#8aa0be]"></div>
                    <div class="absolute bottom-14 left-16 right-16 h-56 rounded-[1.6rem] border border-white/40 bg-white/20 backdrop-blur-md"></div>
                    <div class="absolute right-2 top-1/2 flex -translate-y-1/2 flex-col gap-2">
                        <span class="h-8 w-8 rounded-full bg-white/80 shadow"></span>
                        <span class="h-8 w-8 rounded-full bg-white/80 shadow"></span>
                        <span class="h-8 w-8 rounded-full bg-white/80 shadow"></span>
                    </div>
                    <div class="absolute right-6 top-8 rounded-2xl border border-white/40 bg-white/55 px-4 py-3 backdrop-blur">
                        <p class="text-3xl font-semibold text-slate-800">300+</p>
                        <p class="text-xs text-slate-600">Expert doctors</p>
                    </div>
                    <div class="absolute left-8 top-8 rounded-2xl border border-white/40 bg-white/55 px-4 py-3 backdrop-blur">
                        <p class="text-3xl font-semibold text-slate-800">12h</p>
                        <p class="text-xs text-slate-600">Forecast horizon</p>
                    </div>
                    <div class="absolute bottom-5 right-10 rounded-2xl border border-white/40 bg-white/70 px-4 py-3 backdrop-blur">
                        <p class="text-3xl font-semibold text-slate-800">5,000+</p>
                        <p class="text-xs text-slate-600">Successful treatment</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="py-14">
            <h2 class="text-center text-4xl font-bold text-[var(--brand-dark)]">Why Healora</h2>
            <p class="mt-3 text-center text-lg text-[var(--muted)]">Hospitals do not fail from lack of data. They fail from delayed decisions.</p>
            <div class="mt-8 grid gap-4 md:grid-cols-3">
                <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-6 shadow-sm">
                    <h3 class="text-2xl font-semibold text-[var(--brand)]">Current Pain</h3>
                    <p class="mt-2 text-base text-slate-700">Fragmented communication, siloed workflows, and reactive management.</p>
                </article>
                <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-6 shadow-sm">
                    <h3 class="text-2xl font-semibold text-[var(--brand)]">Core Problem</h3>
                    <p class="mt-2 text-base text-slate-700">Exit Block creates hidden bottlenecks between clinical readiness and discharge flow.</p>
                </article>
                <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-6 shadow-sm">
                    <h3 class="text-2xl font-semibold text-[var(--brand)]">Healora Shift</h3>
                    <p class="mt-2 text-base text-slate-700">From reactive crisis handling to predictive, AI-guided operational control.</p>
                </article>
            </div>
        </section>

        <section id="technology" class="py-14">
            <h2 class="text-center text-4xl font-bold text-[var(--brand-dark)]">Platform Features</h2>
            <p class="mt-3 text-center text-lg text-[var(--muted)]">Everything hospitals need to detect and resolve congestion early.</p>
            <div class="mt-8 grid gap-4 md:grid-cols-3">
                @foreach ([
                    ['FHIR Data Integration', 'Realtime integration with EHR/HIS, bed occupancy, staff, and OR schedules.'],
                    ['Predictive AI Engine', 'Forecast bottlenecks and ED congestion risk up to 12 hours ahead.'],
                    ['Action Recommendations', 'Suggests staff reallocation, discharge prioritization, and schedule adjustments.'],
                    ['Role-Based Dashboards', 'Views tailored for clinical teams, operations managers, and executives.'],
                    ['Alerting System', 'Critical notifications through dashboard, email, or SMS channels.'],
                    ['Compliance by Design', 'End-to-end encryption, RBAC, and Saudi data residency-ready architecture.'],
                ] as $feature)
                    <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-6 shadow-sm">
                        <h3 class="text-2xl font-semibold text-[var(--brand)]">{{ $feature[0] }}</h3>
                        <p class="mt-2 text-base text-slate-700">{{ $feature[1] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <section id="services" class="py-14">
            <h2 class="text-center text-4xl font-bold text-[var(--brand-dark)]">Measurable Impact</h2>
            <p class="mt-3 text-center text-lg text-[var(--muted)]">Operational, financial, and patient-care impact in one platform.</p>
            <div class="mt-8 grid gap-4 md:grid-cols-4">
                @foreach ([
                    ['Patient Impact', 'Reduced waiting times and better patient flow to improve care outcomes.'],
                    ['Economic Impact', 'Unlocks hidden capacity without adding physical infrastructure.'],
                    ['Decision Culture', 'Operational teams move from reactive firefighting to proactive planning.'],
                    ['Vision 2030 Impact', 'Supports Saudi Health Sector Transformation with smarter public healthcare.'],
                ] as $impact)
                    <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-6 shadow-sm">
                        <h3 class="text-2xl font-semibold text-[var(--brand)]">{{ $impact[0] }}</h3>
                        <p class="mt-2 text-base text-slate-700">{{ $impact[1] }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    </main>
</body>
</html>
