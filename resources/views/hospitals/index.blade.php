<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Charts · Healora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --bg-soft: #e9f3f4;
            --surface: #ffffff;
            --teal: #157b84;
            --line: #d7e2ea;
            --text: #1e293b;
            --muted: #5f7188;
        }
        body.dark-mode {
            --bg-soft: #0b1320;
            --surface: #0f1b2e;
            --teal: #2dd4bf;
            --line: #21324f;
            --text: #e6eefb;
            --muted: #9ab0cf;
        }
        .theme-icon { width: 1rem; height: 1rem; stroke: currentColor; }
        .hospital-logo-slot--sfh,
        body.dark-mode .hospital-logo-slot--sfh { background-color: #fff !important; }
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
    </style>
</head>
<body class="min-h-screen bg-[var(--bg-soft)] text-[var(--text)] antialiased">
    <header class="border-b border-slate-200 bg-white/95">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 lg:px-8">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <img src="{{ asset('brand/healora-wordmark.png') }}" alt="Healora wordmark" class="h-10 w-auto object-contain">
            </a>
            <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 md:flex">
                <a href="{{ route('landing') }}" class="transition hover:text-teal-700">Home</a>
                <a href="{{ route('dashboard') }}" class="transition hover:text-teal-700">Live Board</a>
                <a href="{{ route('recommendations') }}" class="transition hover:text-teal-700">Recommendations</a>
                <a href="{{ route('dashboard.hospitals') }}" class="text-teal-700" aria-current="page">Hospital Charts</a>
            </nav>
            <div class="flex items-center gap-2">
                <button id="themeToggleHospitalsIndex" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-300 bg-white text-slate-700 transition hover:bg-slate-50" aria-label="Toggle color theme">
                    <span id="themeIconHospitalsIndex" aria-hidden="true">
                        <svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"/>
                        </svg>
                    </span>
                </button>
                <a href="{{ route('dashboard') }}" class="rounded-xl bg-teal-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-800">Command Center</a>
            </div>
        </div>
    </header>

    <section class="border-b border-teal-800/20 bg-gradient-to-br from-[#115e63] via-[#157b84] to-[#0f766e]" aria-labelledby="hospitals-page-title">
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
                    <h1 id="hospitals-page-title" class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-4xl">Hospital Charts</h1>
                    <p class="mt-3 max-w-2xl text-base leading-relaxed text-teal-50 sm:text-lg">Choose a demo hospital for throughput charts and synthetic data.</p>
                </div>
                <div class="shrink-0 rounded-xl border border-white/15 bg-black/10 px-4 py-3 text-right backdrop-blur-sm sm:min-w-[10rem]">
                    <p class="text-[10px] font-semibold uppercase tracking-wider text-teal-200/90">Asia / Riyadh</p>
                    <p id="hospitalsBoardClock" class="mt-1 font-mono text-xl font-semibold tabular-nums text-white sm:text-2xl">--:--:--</p>
                    <p class="mt-2 text-[10px] text-teal-100/80">Per-site chart views</p>
                </div>
            </div>
        </div>
    </section>

    <main class="mx-auto max-w-[1560px] px-4 py-8 lg:px-8">
        <div class="flex flex-col gap-8 lg:grid lg:grid-cols-12 lg:items-start lg:gap-10">
            <aside class="order-2 lg:order-none lg:col-span-3 xl:col-span-3" aria-label="Navigation and demo hospitals">
                <div class="lg:sticky lg:top-20 lg:z-10 xl:top-24">
                    @include('partials.operations-console-nav', [
                        'hospitalNav' => $hospitalNav ?? [],
                        'activeHospitalSlug' => null,
                        'opsNetworkFlow' => $opsNetworkFlow ?? null,
                    ])
                </div>
            </aside>

            <div class="order-1 min-w-0 lg:order-none lg:col-span-9 xl:col-span-9">
                @if (empty($hospitals))
                    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-6 text-amber-950">
                        <h2 class="text-lg font-semibold">No demo hospitals configured</h2>
                        <p class="mt-2 text-sm">Add hospitals in <code class="rounded bg-white/80 px-1">config/demo_hospitals.php</code>, then run <code class="rounded bg-white/80 px-1">php artisan config:clear</code> if you cache config.</p>
                        <p class="mt-4">
                            <a href="{{ route('dashboard') }}" class="font-semibold text-teal-800 underline-offset-2 hover:underline">Back to Command Center</a>
                        </p>
                    </div>
                @else
                    <ul class="grid gap-4 sm:grid-cols-2" role="list">
                        @foreach ($hospitals as $h)
                            @php
                                $slug = $h['slug'] ?? '';
                                $hospitalLogo = $h['logo'] ?? null;
                                $isSfhLogo = $slug === 'security-forces-riyadh';
                            @endphp
                            <li>
                                <a
                                    href="{{ route('hospitals.show', $slug) }}"
                                    class="flex min-h-[5rem] items-center gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:border-teal-300 hover:shadow-md"
                                >
                                    @if (! empty($hospitalLogo))
                                        <span class="flex h-14 w-14 shrink-0 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm {{ $isSfhLogo ? 'hospital-logo-slot--sfh' : '' }}">
                                            @include('partials.hospital-logo-img', [
                                                'src' => asset($hospitalLogo),
                                                'alt' => $h['name'] ?? 'Hospital',
                                            ])
                                        </span>
                                    @else
                                        <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl border border-teal-200 bg-teal-50 text-sm font-bold text-teal-800">{{ $h['short'] ?? $slug }}</span>
                                    @endif
                                    <span class="min-w-0 flex-1">
                                        <span class="block text-base font-semibold text-slate-900">{{ $h['name'] ?? $slug }}</span>
                                        <span class="mt-1 block text-sm leading-relaxed text-slate-600">{{ $h['city'] ?? '' }} · Demo throughput charts (synthetic data).</span>
                                        <span class="mt-2 inline-flex text-xs font-semibold text-teal-700">Open charts →</span>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </main>

    <footer class="border-t border-slate-200 bg-white py-5 text-center text-sm text-slate-500">
        © 2026 Healora Demo · Illustrative data
    </footer>

    <script>
        (function () {
            var key = 'healora-theme';
            var toggle = document.getElementById('themeToggleHospitalsIndex');
            var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            var saved = localStorage.getItem(key);
            var isDark = saved ? saved === 'dark' : prefersDark;
            if (isDark) document.body.classList.add('dark-mode');
            else document.body.classList.remove('dark-mode');
            function icon() {
                return document.body.classList.contains('dark-mode')
                    ? '<svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8"><circle cx="12" cy="12" r="4"></circle><path stroke-linecap="round" d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"></path></svg>'
                    : '<svg class="theme-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"></path></svg>';
            }
            document.getElementById('themeIconHospitalsIndex').innerHTML = icon();
            toggle.addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem(key, document.body.classList.contains('dark-mode') ? 'dark' : 'light');
                document.getElementById('themeIconHospitalsIndex').innerHTML = icon();
            });
        })();
        (function () {
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
                var el = document.getElementById('hospitalsBoardClock');
                if (el) {
                    el.textContent = getRiyadhTime();
                }
            }
            tickClock();
            setInterval(tickClock, 1000);
        })();
    </script>
</body>
</html>
