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
        @keyframes hero-hand-drift{
            0%,100%{ transform: translateY(0) rotate(-1deg); }
            50%{ transform: translateY(-8px) rotate(1deg); }
        }
        .hero-ai-hand-wrap{
            animation: hero-hand-drift 8s ease-in-out infinite;
        }
        .hero-float-card{
            animation: hero-float-card 6s ease-in-out infinite;
        }
        .hero-float-card-delay{
            animation: hero-float-card 7s ease-in-out infinite 0.8s;
        }
        @keyframes hero-float-card{
            0%,100%{ transform: translateY(0); }
            50%{ transform: translateY(-6px); }
        }
        .hero-landing{
            --h-fg:#0f172a;
            --h-muted:#475569;
            --h-soft:#64748b;
            background:linear-gradient(152deg,#f1f5f9 0%,#eef6f9 38%,#e2e8f0 72%,#dbeafe 100%);
            color:var(--h-fg);
            transition:background .55s ease,color .35s ease;
        }
        body.dark-mode .hero-landing{
            --h-fg:#ffffff;
            --h-muted:#d1fae5;
            --h-soft:rgba(255,255,255,0.72);
            background:linear-gradient(to right,var(--hero-start),var(--hero-mid),var(--hero-end));
            color:var(--h-fg);
        }
        .hero-landing .hero-kpi-strip{
            position:relative;
            margin-top:0;
            padding-top:2.75rem;
            padding-bottom:2.25rem;
            background:linear-gradient(
                180deg,
                rgba(255,255,255,0) 0%,
                rgba(241,245,249,0.28) 18%,
                rgba(233,243,244,0.75) 55%,
                rgba(233,243,244,0.97) 82%,
                var(--bg-soft) 100%
            );
            border-top:none;
            box-shadow:inset 0 1px 0 rgba(255,255,255,0.55);
            transition:background .55s ease,box-shadow .4s ease;
        }
        .hero-landing .hero-kpi-strip::before{
            content:'';
            position:absolute;
            left:0;
            right:0;
            top:0;
            height:5rem;
            pointer-events:none;
            background:linear-gradient(180deg,rgba(15,23,42,0.04) 0%,transparent 100%);
            opacity:0.45;
        }
        body.dark-mode .hero-landing .hero-kpi-strip{
            background:linear-gradient(
                180deg,
                rgba(255,255,255,0) 0%,
                rgba(6,17,39,0.42) 22%,
                rgba(11,19,32,0.82) 58%,
                rgba(11,19,46,0.94) 85%,
                var(--bg-soft) 100%
            );
            border-top:none;
            box-shadow:inset 0 1px 0 rgba(255,255,255,0.06);
            transition:background .55s ease,box-shadow .4s ease;
        }
        body.dark-mode .hero-landing .hero-kpi-strip::before{
            background:linear-gradient(180deg,rgba(0,0,0,0.35) 0%,transparent 100%);
            opacity:0.5;
        }
        .hero-landing .hero-kpi-card{
            transition:background-color .35s ease,border-color .35s ease,box-shadow .35s ease,transform .25s ease;
        }
        .hero-kpi-bridge{
            min-height:2.25rem;
            margin-top:2.5rem;
            margin-bottom:0;
            background:linear-gradient(180deg,transparent 0%,rgba(219,234,254,0.14) 55%,rgba(226,232,240,0.28) 100%);
            pointer-events:none;
        }
        @media (min-width:1024px){
            .hero-kpi-bridge{ min-height:2.75rem; margin-top:3rem; }
        }
        body.dark-mode .hero-kpi-bridge{
            background:linear-gradient(180deg,transparent 0%,rgba(20,184,166,0.07) 45%,rgba(11,37,48,0.25) 100%);
        }
        .hero-brain{
            filter:drop-shadow(0 8px 24px rgba(14,165,233,0.25));
        }
        body.dark-mode .hero-brain{
            filter:drop-shadow(0 8px 28px rgba(45,212,191,0.35));
        }
        .hero-hand-img{
            filter:drop-shadow(0 28px 48px rgba(15,23,42,0.14));
        }
        body.dark-mode .hero-hand-img{
            filter:drop-shadow(0 24px 56px rgba(0,0,0,0.45));
        }
        body.dark-mode .hero-pill{
            border-color:rgba(255,255,255,0.2)!important;
            background:rgba(255,255,255,0.1)!important;
            color:rgba(255,255,255,0.95)!important;
        }
        body.dark-mode .hero-btn-primary{
            background:#fff!important;
            color:#0f172a!important;
        }
        body.dark-mode .hero-btn-primary:hover{
            background:#f1f5f9!important;
        }
        body.dark-mode .hero-btn-secondary{
            border-color:rgba(255,255,255,0.28)!important;
            background:rgba(255,255,255,0.06)!important;
            color:#fff!important;
        }
        body.dark-mode .hero-float-surface{
            border-color:rgba(255,255,255,0.15)!important;
            background:rgba(15,27,46,0.88)!important;
        }
        body.dark-mode .hero-float-badge{
            background:rgba(20,184,166,0.22)!important;
            color:#99f6e4!important;
        }
        body.dark-mode .hero-float-muted{
            color:#94a3b8!important;
        }
        body.dark-mode .hero-float-strong{
            color:#fff!important;
        }
        body.dark-mode .hero-kpi-card{
            border-color:#203353!important;
            background:#0b1a36!important;
        }
        body.dark-mode .hero-kpi-label{
            color:#94a3b8!important;
        }
        .hero-landing .hero-kpi-label,
        .hero-landing .hero-kpi-card p.mt-1{
            transition:color .35s ease;
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
                <a href="#contact" class="transition hover:text-[var(--teal)]">Contact</a>
                <a href="{{ route('dashboard') }}" class="transition hover:text-[var(--teal)]">Demo</a>
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
        <section class="hero-landing relative overflow-hidden pt-12 pb-0">
            <div class="pointer-events-none absolute -left-20 top-10 h-72 w-72 rounded-full bg-sky-200/35 blur-3xl"></div>
            <div class="pointer-events-none absolute -right-16 top-24 h-64 w-64 rounded-full bg-cyan-200/30 blur-3xl"></div>
            <div class="pointer-events-none absolute bottom-32 left-1/2 h-40 w-64 -translate-x-1/2 rounded-full bg-teal-200/20 blur-3xl"></div>
            <div class="relative z-[1] mx-auto max-w-7xl px-4 lg:px-8">
                <div class="grid items-center gap-12 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.05fr)] lg:gap-8 lg:py-4">
                    <div>
                        <span class="hero-pill inline-flex items-center gap-2 rounded-full border border-slate-200/90 bg-white/90 px-4 py-1.5 text-xs font-semibold tracking-wide text-slate-700 shadow-sm backdrop-blur-sm">
                            <svg class="h-3.5 w-3.5 text-[var(--teal)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Command Center Mode
                        </span>
                        <h1 class="mt-5 max-w-4xl text-5xl font-bold leading-tight md:text-6xl" style="color:var(--h-fg)">AI Control Tower for Hospital Throughput</h1>
                        <p class="mt-4 max-w-3xl text-xl" style="color:var(--h-muted)">Bolder visual authority, boardroom-ready, strong technology impression.</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('dashboard') }}" class="hero-btn-primary inline-flex items-center justify-center rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-md shadow-slate-900/15 transition hover:bg-slate-800">View Live Demo</a>
                            <a href="#features" class="hero-btn-secondary inline-flex items-center justify-center rounded-xl border border-slate-300/90 bg-white/80 px-6 py-3 text-sm font-semibold text-slate-800 backdrop-blur-sm transition hover:bg-white">Explore Features</a>
                        </div>
                    </div>
                    <div class="hero-ai-hand-wrap relative mx-auto w-full max-w-xl lg:mx-0 lg:max-w-none lg:justify-self-end" aria-hidden="true">
                        <div class="hero-float-card hero-float-surface absolute left-4 top-2 z-20 max-w-[168px] rounded-2xl border border-slate-200/80 bg-white/95 px-3 py-2.5 shadow-xl shadow-slate-900/10 backdrop-blur-md">
                            <div class="flex items-center gap-2">
                                <span class="hero-float-badge flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-sky-100 text-[10px] font-bold text-sky-800">ED</span>
                                <div class="min-w-0">
                                    <p class="hero-float-muted text-[10px] font-semibold uppercase tracking-wide text-slate-500">Live board</p>
                                    <p class="hero-float-strong truncate text-xs font-semibold text-slate-900">Flow stabilizing</p>
                                </div>
                            </div>
                        </div>
                        <div class="hero-float-card-delay hero-float-surface absolute bottom-[22%] left-0 z-20 max-w-[180px] rounded-2xl border border-slate-200/80 bg-white/95 px-3 py-2.5 shadow-xl shadow-slate-900/10 backdrop-blur-md sm:left-4">
                            <p class="hero-float-muted text-[10px] font-semibold uppercase tracking-wide text-slate-500">12-hour horizon</p>
                            <p class="hero-float-strong text-xs font-semibold text-slate-900">Congestion risk surfaced early</p>
                        </div>
                        <div class="relative flex min-h-[280px] items-end justify-end overflow-visible sm:min-h-[320px] lg:min-h-[360px]">
                            <div class="hero-brain pointer-events-none absolute left-1/2 top-6 z-[5] w-[min(42%,180px)] -translate-x-[20%] sm:top-4 sm:w-[min(46%,200px)]">
                                <svg viewBox="0 0 120 100" class="w-full drop-shadow-lg" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <ellipse cx="60" cy="50" rx="44" ry="36" fill="url(#brainFill)" fill-opacity="0.35"/>
                                    <ellipse cx="60" cy="48" rx="36" ry="30" stroke="#38bdf8" stroke-width="0.9" stroke-opacity="0.85"/>
                                    <path d="M38 44c6-8 18-10 28-4m16 4c-4 10-16 14-26 10" stroke="#7dd3fc" stroke-width="0.7" stroke-linecap="round" stroke-opacity="0.7"/>
                                    <circle cx="48" cy="42" r="2" fill="#38bdf8" fill-opacity="0.9"/>
                                    <circle cx="68" cy="38" r="1.8" fill="#67e8f9"/>
                                    <circle cx="76" cy="52" r="1.6" fill="#22d3ee" fill-opacity="0.8"/>
                                    <defs>
                                        <radialGradient id="brainFill" cx="50%" cy="40%" r="65%">
                                            <stop offset="0%" stop-color="#38bdf8" stop-opacity="0.55"/>
                                            <stop offset="100%" stop-color="#0ea5e9" stop-opacity="0"/>
                                        </radialGradient>
                                    </defs>
                                </svg>
                            </div>
                            <img
                                src="{{ asset('brand/hero-ai-hand.png') }}"
                                alt="Robotic palm-up hand with transparent background representing AI-guided hospital operations"
                                class="hero-hand-img relative z-10 h-auto w-full max-w-[640px] origin-bottom-right scale-[1.02] object-contain object-right select-none sm:scale-105 lg:max-w-none lg:w-[115%] lg:translate-x-4 xl:w-[122%]"
                                width="707"
                                height="353"
                                decoding="async"
                                fetchpriority="high"
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-kpi-bridge relative z-[1]" aria-hidden="true"></div>
            <div class="hero-kpi-strip relative z-[1]">
                <div class="relative mx-auto grid max-w-7xl gap-4 px-4 sm:grid-cols-2 lg:grid-cols-4 lg:px-8">
                    <div class="hero-kpi-card rounded-2xl border border-slate-200/90 bg-white/90 p-5 shadow-sm backdrop-blur-sm">
                        <p class="hero-kpi-label text-sm text-slate-500">Prediction accuracy</p>
                        <p class="mt-1 text-3xl font-bold text-[var(--teal)] md:text-4xl">95–98%</p>
                    </div>
                    <div class="hero-kpi-card rounded-2xl border border-slate-200/90 bg-white/90 p-5 shadow-sm backdrop-blur-sm">
                        <p class="hero-kpi-label text-sm text-slate-500">Forecast horizon</p>
                        <p class="mt-1 text-3xl font-bold text-[var(--teal)] md:text-4xl">12h</p>
                    </div>
                    <div class="hero-kpi-card rounded-2xl border border-slate-200/90 bg-white/90 p-5 shadow-sm backdrop-blur-sm">
                        <p class="hero-kpi-label text-sm text-slate-500">Potential savings</p>
                        <p class="mt-1 text-3xl font-bold text-[var(--teal)] md:text-4xl">6.5%</p>
                    </div>
                    <div class="hero-kpi-card rounded-2xl border border-slate-200/90 bg-white/90 p-5 shadow-sm backdrop-blur-sm">
                        <p class="hero-kpi-label text-sm text-slate-500">Action latency</p>
                        <p class="mt-1 text-3xl font-bold text-[var(--teal)] md:text-4xl">−43%</p>
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
                <div class="mt-7 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('dashboard') }}" class="rounded-xl bg-[var(--teal)] px-7 py-3 text-sm font-semibold text-slate-900">Open Demo</a>
                    <a href="{{ route('dashboard') }}" class="rounded-xl border border-white/40 bg-white/10 px-7 py-3 text-sm font-semibold text-white">Request Pilot</a>
                </div>
            </div>
        </section>

        <footer class="border-t border-[var(--line)] bg-[var(--surface)] px-4 py-8 text-center text-sm text-[var(--muted)]">
            <p class="font-medium text-[var(--text)]">Contact</p>
            <p class="mt-2 flex flex-wrap items-center justify-center gap-x-3 gap-y-1">
                <span>Alanoud Khouj</span>
                <span class="hidden sm:inline" aria-hidden="true">·</span>
                <a href="tel:+966532005645" class="text-[var(--teal)] underline-offset-2 transition hover:underline">+966 53 200 5645</a>
                <span class="hidden sm:inline" aria-hidden="true">·</span>
                <a href="mailto:alanoud.khouj@gmail.com" class="text-[var(--teal)] underline-offset-2 transition hover:underline">alanoud.khouj@gmail.com</a>
            </p>
            <p class="mt-6">© 2026 Healora Platform - AI-Powered Hospital Operations</p>
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
