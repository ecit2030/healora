@php
    $hospitalNav = $hospitalNav ?? [];
    $activeHospitalSlug = $activeHospitalSlug ?? null;
    $onLive = request()->routeIs('dashboard');
    $onRec = request()->routeIs('recommendations');
    $onHospitalsIndex = request()->routeIs('hospitals.index', 'dashboard.hospitals');
    $opsNetworkFlow = $opsNetworkFlow ?? null;
@endphp
@if (! empty($hospitalNav))
    <nav class="operations-console-nav dash-sidebar mb-6 overflow-hidden rounded-2xl border border-teal-100 bg-white shadow-sm lg:mb-0" aria-labelledby="ops-console-label">
        <div class="border-b border-slate-100/80 bg-gradient-to-br from-slate-50/90 to-white px-4 py-4 sm:px-5">
            <p id="ops-console-label" class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-500">Operations console</p>
            <div class="mt-3 flex flex-row gap-2 lg:flex-col lg:gap-2">
                <a
                    href="{{ route('dashboard') }}"
                    class="dash-focus flex min-h-[2.75rem] flex-1 items-center gap-2.5 rounded-xl px-3 py-2 text-sm font-semibold transition lg:flex-none {{ $onLive ? 'bg-teal-700 text-white shadow-sm shadow-teal-900/15' : 'border border-slate-200/90 bg-white text-slate-700 hover:border-teal-200 hover:bg-teal-50/50' }}"
                    @if ($onLive) aria-current="page" @endif
                >
                    <svg class="h-4 w-4 shrink-0 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 13h6V5H4v8Zm10 6h6v-8h-6v8ZM4 21h6v-6H4v6Zm10-8h6V5h-6v8Z"/></svg>
                    Command Center
                </a>
                <a
                    href="{{ route('recommendations') }}"
                    class="dash-focus flex min-h-[2.75rem] flex-1 items-center gap-2.5 rounded-xl px-3 py-2 text-sm font-semibold transition lg:flex-none {{ $onRec ? 'bg-teal-700 text-white shadow-sm shadow-teal-900/15' : 'border border-slate-200/90 bg-white text-slate-700 hover:border-teal-200 hover:bg-teal-50/50' }}"
                    @if ($onRec) aria-current="page" @endif
                >
                    <svg class="h-4 w-4 shrink-0 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 3h6M10 3v3l-3 9v6a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-6l-3-9V3"/><path stroke-linecap="round" d="M7 15h10"/></svg>
                    Recommendations
                </a>
                <a
                    href="{{ route('dashboard.hospitals') }}"
                    class="dash-focus flex min-h-[2.75rem] flex-1 items-center gap-2.5 rounded-xl px-3 py-2 text-sm font-semibold transition lg:flex-none {{ $onHospitalsIndex ? 'bg-teal-700 text-white shadow-sm shadow-teal-900/15' : 'border border-slate-200/90 bg-white text-slate-700 hover:border-teal-200 hover:bg-teal-50/50' }}"
                    @if ($onHospitalsIndex) aria-current="page" @endif
                >
                    <svg class="h-4 w-4 shrink-0 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9.5 12 3l9 6.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V9.5Z"/></svg>
                    Hospital Charts
                </a>
            </div>

            @if (! empty($opsNetworkFlow) && ($opsNetworkFlow['hospital_count'] ?? 0) > 0)
                <div class="ops-network-flow-summary mt-4 rounded-xl border border-slate-200/90 bg-slate-50/80 px-3 py-3 sm:px-3.5">
                    <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-500">Network patient flow</p>
                    <p class="mt-1 text-[11px] leading-snug text-slate-500">Demo average per site ({{ $opsNetworkFlow['hospital_count'] }} hospitals)</p>
                    <dl class="mt-2.5 grid grid-cols-3 gap-2 text-center">
                        <div class="rounded-lg bg-white/90 px-1.5 py-2 ring-1 ring-slate-200/60">
                            <dt class="text-[10px] font-semibold uppercase tracking-wide text-slate-500">Stuck</dt>
                            <dd class="mt-0.5 text-lg font-bold tabular-nums text-amber-800">{{ $opsNetworkFlow['avg_stuck'] }}</dd>
                        </div>
                        <div class="rounded-lg bg-white/90 px-1.5 py-2 ring-1 ring-slate-200/60">
                            <dt class="text-[10px] font-semibold uppercase tracking-wide text-slate-500">Near DC</dt>
                            <dd class="mt-0.5 text-lg font-bold tabular-nums text-emerald-800">{{ $opsNetworkFlow['avg_near_discharge'] }}</dd>
                        </div>
                        <div class="rounded-lg bg-white/90 px-1.5 py-2 ring-1 ring-teal-200/50">
                            <dt class="text-[10px] font-semibold uppercase tracking-wide text-slate-500">Combined</dt>
                            <dd class="mt-0.5 text-lg font-bold tabular-nums text-teal-800">{{ $opsNetworkFlow['avg_combined'] }}</dd>
                        </div>
                    </dl>
                    <p class="mt-2.5 border-t border-slate-200/80 pt-2.5 text-[11px] leading-relaxed text-slate-600">
                        <span class="font-semibold text-slate-700">Suggested action:</span>
                        {{ $opsNetworkFlow['solution'] }}
                    </p>
                </div>
            @endif
        </div>

        <div class="px-4 py-4 sm:px-5 sm:py-5">
            <div class="flex flex-wrap items-start justify-between gap-2 gap-y-1">
                <div class="min-w-0">
                    <h2 class="text-sm font-semibold text-[var(--teal)]">Hospital Charts</h2>
                    <p class="mt-0.5 text-xs leading-snug text-slate-500">Demo sites · sample data</p>
                </div>
                <span class="inline-flex shrink-0 items-center rounded-md border border-slate-200/80 bg-slate-50 px-2 py-1 text-[10px] font-semibold uppercase tracking-wide text-slate-500" title="Synthetic metrics for demos">Illustrative only</span>
            </div>

            <p class="mt-3 text-[11px] text-slate-400 lg:hidden">Swipe to explore demo hospitals</p>

            <ul class="mt-2 flex gap-2 overflow-x-auto pb-1 [-ms-overflow-style:none] [scrollbar-width:none] lg:mt-4 lg:flex-col lg:gap-1.5 lg:overflow-visible lg:pb-0 [&::-webkit-scrollbar]:hidden" role="list" aria-label="Demo hospital sites">
                @foreach ($hospitalNav as $h)
                    @php
                        $isH = $activeHospitalSlug === ($h['slug'] ?? null);
                        $hospitalLogo = $h['logo'] ?? null;
                        $isSfhLogo = ($h['slug'] ?? '') === 'security-forces-riyadh';
                    @endphp
                    <li class="w-[min(100%,17.5rem)] shrink-0 lg:w-auto">
                        <a
                            href="{{ route('hospitals.show', $h['slug']) }}"
                            class="dash-focus group flex w-full items-start gap-3 rounded-xl border px-3 py-2.5 text-left transition {{ $isH ? 'border-teal-400/80 bg-teal-50 ring-2 ring-teal-200/60' : 'border-slate-100 bg-slate-50/80 hover:border-teal-200 hover:bg-white' }}"
                            @if ($isH) aria-current="page" @endif
                        >
                            @if (! empty($hospitalLogo))
                                <span class="flex h-10 w-10 shrink-0 overflow-hidden rounded-lg border shadow-sm {{ $isSfhLogo ? 'hospital-logo-slot--sfh border-slate-200/90' : 'border-teal-200/60 bg-white group-hover:border-teal-300' }}">
                                    @include('partials.hospital-logo-img', [
                                        'src' => asset($hospitalLogo),
                                        'alt' => $h['name'] ?? 'Hospital',
                                    ])
                                </span>
                            @else
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-teal-200/60 bg-white text-[11px] font-bold tabular-nums text-teal-800 shadow-sm group-hover:border-teal-300">{{ $h['short'] ?? $h['slug'] }}</span>
                            @endif
                            <span class="min-w-0 flex-1">
                                <span class="block text-[13px] font-semibold leading-snug text-slate-800 group-hover:text-slate-900">{{ $h['name'] }}</span>
                                <span class="mt-0.5 block text-[11px] font-medium text-slate-500">{{ $h['city'] ?? '' }}</span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
@endif
