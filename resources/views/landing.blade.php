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
            --surface:#ffffff;
            --teal:#157b84;
            --teal-dark:#0f5d68;
            --card:#f7fbfc;
            --line:#d7e2ea;
            --text:#1e293b;
            --muted:#5f7188;
            --hero-start:#0b2530;
            --hero-mid:#0f3d4e;
            --hero-end:#0f766e;
            --hero-body:#d9f8f4;
            --hero-pill:#ffffff26;
        }
        body.dark-mode{
            --bg-soft:#0b1320;
            --surface:#0f1b2e;
            --teal:#2dd4bf;
            --teal-dark:#14b8a6;
            --card:#111e33;
            --line:#21324f;
            --text:#e6eefb;
            --muted:#9ab0cf;
            --hero-start:#0b2530;
            --hero-mid:#0f3d4e;
            --hero-end:#0f766e;
            --hero-body:#d9f8f4;
            --hero-pill:#ffffff26;
        }
        .glass{
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.15);
            backdrop-filter: blur(8px);
        }
        .icon-pill{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            width:1.25em;
            height:1.25em;
            margin-right:.4rem;
            vertical-align:-0.18em;
            color:var(--teal);
        }
        .icon-pill svg{
            width:1em;
            height:1em;
            stroke:currentColor;
        }
        .theme-icon{
            width:1rem;
            height:1rem;
            stroke:currentColor;
        }
    </style>
</head>
<body class="bg-[var(--bg-soft)] text-[var(--text)] antialiased">
    <header class="sticky top-0 z-30 border-b border-[var(--line)] bg-[var(--surface)]/95">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 lg:px-8">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <img src="{{ asset('brand/healora-wordmark.png') }}" alt="Healora wordmark" class="h-10 w-auto object-contain">
            </a>
            <nav class="hidden items-center gap-6 text-sm font-semibold text-[var(--muted)] md:flex">
                <a href="#why" class="transition hover:text-[var(--teal)]">Why Healora</a>
                <a href="#features" class="transition hover:text-[var(--teal)]">Features</a>
                <a href="#impact" class="transition hover:text-[var(--teal)]">Impact</a>
            </nav>
            <div class="flex items-center gap-2">
                <button id="themeToggleLanding" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-[var(--line)] bg-[var(--surface)] text-[var(--text)] transition hover:opacity-90" aria-label="Toggle color theme" title="Toggle color theme">
                    <span id="themeIconLanding" aria-hidden="true">
                        <svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"/>
                        </svg>
                    </span>
                </button>
                <a href="{{ route('dashboard') }}" class="rounded-xl bg-[var(--teal)] px-5 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-[var(--teal-dark)]">Open Demo</a>
            </div>
        </div>
    </header>

    <main>
        <section class="relative overflow-hidden pt-14 text-white" style="background-image: linear-gradient(to right, var(--hero-start), var(--hero-mid), var(--hero-end));">
            <div class="pointer-events-none absolute -top-10 left-16 h-56 w-56 rounded-full bg-teal-300/20 blur-3xl"></div>
            <div class="pointer-events-none absolute top-16 right-10 h-48 w-48 rounded-full bg-cyan-300/20 blur-3xl"></div>
            <div class="pointer-events-none absolute inset-x-0 bottom-0 h-24 bg-gradient-to-b from-transparent via-[#071631]/70 to-[#06132b]"></div>
            <div class="mx-auto max-w-7xl px-4 lg:px-8">
                <div>
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/30 px-4 py-1 text-xs font-semibold tracking-wide" style="background-color: var(--hero-pill);">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Command Center Mode
                    </span>
                    <h1 class="mt-5 max-w-4xl text-5xl font-bold leading-tight md:text-6xl">AI Control Tower for Hospital Throughput</h1>
                    <p class="mt-4 max-w-3xl text-xl" style="color: var(--hero-body);">Bolder visual authority, boardroom-ready, strong technology impression.</p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('dashboard') }}" class="rounded-xl bg-white px-6 py-3 text-sm font-semibold text-[#0b2530]">View Live Demo</a>
                        <a href="#features" class="rounded-xl border border-white/35 bg-white/10 px-6 py-3 text-sm font-semibold text-white">Explore Features</a>
                    </div>
                </div>
            </div>
            <div class="relative mt-12 py-5">
                <div class="absolute inset-0 bg-gradient-to-r from-[#061127]/94 via-[#081830]/92 to-[#072038]/92"></div>
                <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                <div class="relative z-10 mx-auto grid max-w-7xl gap-4 px-4 sm:grid-cols-2 lg:grid-cols-4 lg:px-8">
                    <div class="rounded-2xl border border-[#203353] bg-[#0b1a36] p-5">
                        <p class="text-sm text-slate-400">Prediction Accuracy</p>
                        <p class="mt-1 text-4xl font-bold text-[#56d5cc]">95-98%</p>
                    </div>
                    <div class="rounded-2xl border border-[#203353] bg-[#0b1a36] p-5">
                        <p class="text-sm text-slate-400">Forecast Horizon</p>
                        <p class="mt-1 text-4xl font-bold text-[#56d5cc]">12h</p>
                    </div>
                    <div class="rounded-2xl border border-[#203353] bg-[#0b1a36] p-5">
                        <p class="text-sm text-slate-400">Potential Savings</p>
                        <p class="mt-1 text-4xl font-bold text-[#56d5cc]">6.5%</p>
                    </div>
                    <div class="rounded-2xl border border-[#203353] bg-[#0b1a36] p-5">
                        <p class="text-sm text-slate-400">Action Latency</p>
                        <p class="mt-1 text-4xl font-bold text-[#56d5cc]">-43%</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="why" class="mx-auto max-w-7xl px-4 py-14 lg:px-8">
            <h2 class="text-center text-4xl font-bold text-[var(--teal)]">Why Healora</h2>
            <p class="mt-3 text-center text-xl text-[var(--muted)]">Hospitals do not fail from lack of data. They fail from delayed decisions.</p>
            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-6 shadow-sm">
                    <h3 class="text-2xl font-semibold text-[var(--teal)]"><span class="icon-pill"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.9 2.6 17.2A2 2 0 0 0 4.3 20h15.4a2 2 0 0 0 1.7-2.8L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg></span>Current Pain</h3>
                    <p class="mt-3 text-xl text-[var(--muted)]">Fragmented communication, siloed workflows, and reactive management.</p>
                </article>
                <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-6 shadow-sm">
                    <h3 class="text-2xl font-semibold text-[var(--teal)]"><span class="icon-pill"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M8.5 8.5 15.5 15.5"/></svg></span>Core Problem</h3>
                    <p class="mt-3 text-xl text-[var(--muted)]">Exit Block creates hidden bottlenecks between clinical readiness and discharge flow.</p>
                </article>
                <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-6 shadow-sm">
                    <h3 class="text-2xl font-semibold text-[var(--teal)]"><span class="icon-pill"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><rect x="7" y="8" width="10" height="9" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v3M9.5 12h.01M14.5 12h.01"/></svg></span>Healora Shift</h3>
                    <p class="mt-3 text-xl text-[var(--muted)]">From reactive crisis handling to predictive, AI-guided operational control.</p>
                </article>
            </div>
        </section>

        <section id="features" class="mx-auto max-w-7xl px-4 py-14 lg:px-8">
            <h2 class="text-center text-4xl font-bold text-[var(--teal)]">Platform Features</h2>
            <p class="mt-3 text-center text-xl text-[var(--muted)]">Everything hospitals need to detect and resolve congestion early.</p>
            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ([
                    ['FHIR Data Integration', 'Realtime integration with EHR/HIS, bed occupancy, staff, and OR schedules.', 'integration'],
                    ['Predictive AI Engine', 'Forecast bottlenecks and ED congestion risk up to 12 hours ahead.', 'predictive'],
                    ['Action Recommendations', 'Suggests staff reallocation, discharge prioritization, and schedule adjustments.', 'action'],
                    ['Role-Based Dashboards', 'Views tailored for clinical teams, operations managers, and executives.', 'dashboard'],
                    ['Alerting System', 'Critical notifications through dashboard, email, or SMS channels.', 'alert'],
                    ['Compliance by Design', 'End-to-end encryption, RBAC, and Saudi data residency-ready architecture.', 'compliance'],
                ] as $feature)
                    <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-6 shadow-sm">
                        <h3 class="text-2xl font-semibold text-[var(--teal)]">
                            <span class="icon-pill">
                                @switch($feature[2])
                                    @case('integration')
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h10v10H7z"/><path stroke-linecap="round" stroke-linejoin="round" d="M3 12h4m10 0h4M12 3v4m0 10v4"/></svg>
                                        @break
                                    @case('predictive')
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19h16M7 15l3-3 3 2 4-5"/></svg>
                                        @break
                                    @case('action')
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/></svg>
                                        @break
                                    @case('dashboard')
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><rect x="4" y="4" width="16" height="16" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 8h3v3H8zm5 0h3m-8 5h8m-8 3h4"/></svg>
                                        @break
                                    @case('alert')
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.9 2.6 17.2A2 2 0 0 0 4.3 20h15.4a2 2 0 0 0 1.7-2.8L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
                                        @break
                                    @default
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 4v5c0 5-3.5 8-7 9-3.5-1-7-4-7-9V7l7-4Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4"/></svg>
                                @endswitch
                            </span>
                            {{ $feature[0] }}
                        </h3>
                        <p class="mt-3 text-xl text-[var(--muted)]">{{ $feature[1] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <section id="impact" class="mx-auto max-w-7xl px-4 py-14 lg:px-8">
            <h2 class="text-center text-4xl font-bold text-[var(--teal)]">Measurable Impact</h2>
            <p class="mt-3 text-center text-xl text-[var(--muted)]">Operational, financial, and patient-care impact in one platform.</p>
            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach ([
                    ['Patient Impact', 'Reduced waiting times and better patient flow to improve care outcomes.', 'patient'],
                    ['Economic Impact', 'Unlocks hidden capacity without adding physical infrastructure.', 'economic'],
                    ['Decision Culture', 'Operational teams move from reactive firefighting to proactive planning.', 'decision'],
                    ['Vision 2030 Impact', 'Supports Saudi Health Sector Transformation with smarter public healthcare.', 'vision'],
                ] as $impact)
                    <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-6 shadow-sm">
                        <h3 class="text-2xl font-semibold text-[var(--teal)]">
                            <span class="icon-pill">
                                @switch($impact[2])
                                    @case('patient')
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.6-7 10-7 10Z"/></svg>
                                        @break
                                    @case('economic')
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 9.5c0-1.4-1.3-2.5-3-2.5s-3 1.1-3 2.5 1.3 2.5 3 2.5 3 1.1 3 2.5-1.3 2.5-3 2.5-3-1.1-3-2.5"/></svg>
                                        @break
                                    @case('decision')
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M6 7h6a3 3 0 1 1 0 6H6V7Zm12 10h-6a3 3 0 1 1 0-6h6v6Z"/></svg>
                                        @break
                                    @default
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2 4 6v6c0 5 3.5 8 8 10 4.5-2 8-5 8-10V6l-8-4Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M12 9v6"/></svg>
                                @endswitch
                            </span>
                            {{ $impact[0] }}
                        </h3>
                        <p class="mt-3 text-xl text-[var(--muted)]">{{ $impact[1] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-14 lg:px-8">
            <h2 class="text-center text-4xl font-bold text-[var(--teal)]">Research That Informed Healora</h2>
            <p class="mt-3 text-center text-xl text-[var(--muted)]">The platform is grounded in recent evidence on health system transformation, predictive analytics, and population health operations.</p>
            <div class="mt-8 grid gap-4 md:grid-cols-3">
                <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-5 shadow-sm">
                    <p class="inline-block rounded-full bg-teal-400/20 px-2 py-1 text-xs font-semibold text-[var(--teal)]">Arabic Reference (2026)</p>
                    <h3 class="mt-3 flex items-center gap-2 text-2xl font-semibold text-[var(--teal)]"><span class="icon-pill !mr-0"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M7 4h10a2 2 0 0 1 2 2v12l-3-2-3 2-3-2-3 2V6a2 2 0 0 1 2-2Z"/></svg></span>Latest Updates in Health Systems and Solutions (2026)</h3>
                    <p class="mt-2 text-lg text-[var(--muted)]">This study highlights accelerating digital transformation, the importance of interoperability, cybersecurity readiness, and AI's role in improving operational efficiency while reducing administrative burden.</p>
                </article>
                <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-5 shadow-sm">
                    <p class="inline-block rounded-full bg-teal-400/20 px-2 py-1 text-xs font-semibold text-[var(--teal)]">Arabic Reference (2026)</p>
                    <h3 class="mt-3 flex items-center gap-2 text-2xl font-semibold text-[var(--teal)]"><span class="icon-pill !mr-0"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7a3 3 0 1 1 6 0v1a3 3 0 0 1 2 2.8V13a2 2 0 0 1-2 2v2a3 3 0 1 1-6 0v-2a2 2 0 0 1-2-2v-2.2A3 3 0 0 1 9 8V7Z"/></svg></span>AI Systems in Healthcare (2026)</h3>
                    <p class="mt-2 text-lg text-[var(--muted)]">The report supports predictive-system trends, AI-enabled clinical decision support, and integration with EHRs and operational hospital systems.</p>
                </article>
                <article class="rounded-2xl border border-[var(--line)] bg-[var(--card)] p-5 shadow-sm">
                    <p class="inline-block rounded-full bg-teal-400/20 px-2 py-1 text-xs font-semibold text-[var(--teal)]">AJMC 2023</p>
                    <h3 class="mt-3 flex items-center gap-2 text-2xl font-semibold text-[var(--teal)]"><span class="icon-pill !mr-0"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 20V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14M9 20v-4h6v4M9 8h.01M15 8h.01M9 12h.01M15 12h.01"/></svg></span>Planning for the Future of Population Health</h3>
                    <p class="mt-2 text-lg text-[var(--muted)]">The Johns Hopkins experience shows that success depends on unified operating structures, analytics roadmaps, and cross-department care coordination to reduce avoidable utilization and improve outcomes.</p>
                </article>
            </div>
            <div class="mt-4 rounded-2xl border border-[var(--line)] bg-[var(--surface)] p-4 text-lg text-[var(--muted)]">
                <span class="font-semibold text-[var(--teal)]">How this shaped Healora:</span>
                Healora is designed as a real-time hospital control tower built on early prediction and actionable recommendations, aligned with modern health transformation requirements and Vision 2030 direction.
            </div>
        </section>

        <section id="contact" class="bg-gradient-to-r from-[#0d2f3c] to-[#0f5d68] py-14 text-white">
            <div class="mx-auto max-w-7xl px-4 text-center lg:px-8">
                <h2 class="text-4xl font-bold">Ready to see Healora in action?</h2>
                <p class="mx-auto mt-3 max-w-2xl text-xl text-teal-50">Open the live demo and explore a real control-tower workflow.</p>
                <div class="mt-7 flex justify-center gap-3">
                    <a href="{{ route('dashboard') }}" class="rounded-xl bg-[var(--teal)] px-7 py-3 text-sm font-semibold text-slate-900">Open Demo</a>
                    <a href="{{ route('dashboard') }}" class="rounded-xl border border-white/40 bg-white/10 px-7 py-3 text-sm font-semibold text-white">Request Pilot</a>
                </div>
            </div>
        </section>

        <footer class="border-t border-[var(--line)] bg-[var(--surface)] py-5 text-center text-sm text-[var(--muted)]">
            © 2026 Healora Platform - AI-Powered Hospital Operations
        </footer>
    </main>
    <script>
        (function () {
            const key = 'healora-theme';
            const toggle = document.getElementById('themeToggleLanding');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const saved = localStorage.getItem(key);
            const isDark = saved ? saved === 'dark' : prefersDark;

            if (isDark) {
                document.body.classList.add('dark-mode');
            }

            function updateButton() {
                const icon = document.getElementById('themeIconLanding');
                icon.innerHTML = document.body.classList.contains('dark-mode')
                    ? '<svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8"><circle cx="12" cy="12" r="4"></circle><path stroke-linecap="round" d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"></path></svg>'
                    : '<svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"></path></svg>';
            }

            updateButton();

            toggle.addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem(key, document.body.classList.contains('dark-mode') ? 'dark' : 'light');
                updateButton();
            });
        })();
    </script>
</body>
</html>
