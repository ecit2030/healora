<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healora | Design Options</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 antialiased">
    <main class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        <header class="mb-6 rounded-2xl border border-slate-200 bg-white p-5">
            <h1 class="text-2xl font-bold text-slate-900">Landing Design Options</h1>
            <p class="mt-1 text-sm text-slate-600">Same content, three different design directions. Pick A, B, or C.</p>
            <a href="{{ route('landing') }}" class="mt-3 inline-block rounded-lg bg-[#009785] px-4 py-2 text-sm font-semibold text-white hover:bg-[#006b60]">Back to Current Landing</a>
        </header>

        <section class="space-y-6">
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-[#f5f3ff] shadow-sm">
                <div class="border-b border-slate-200 bg-white px-6 py-4">
                    <h2 class="text-xl font-semibold text-[#004d45]">Option A — Clinical Premium</h2>
                </div>
                <div class="bg-gradient-to-r from-[#003d38] via-[#009785] to-[#b275ff] px-6 py-12 text-white">
                    <p class="inline-block rounded-full bg-white/20 px-3 py-1 text-xs">AI Hospital Operations Platform</p>
                    <h3 class="mt-4 text-4xl font-bold leading-tight">Predict Exit Block before it impacts patient care.</h3>
                    <p class="mt-3 max-w-2xl text-white/90">Clean, trustworthy, and clinical. Strong readability with calm structure.</p>
                    <div class="mt-5 flex gap-3">
                        <span class="rounded-xl bg-white px-4 py-2 text-sm font-semibold text-[#009785]">View Live Demo</span>
                        <span class="rounded-xl border border-white/40 px-4 py-2 text-sm">Explore Features</span>
                    </div>
                </div>
                <div class="grid gap-4 px-6 py-6 md:grid-cols-3">
                    <div class="rounded-xl border border-[#d57bfe]/40 bg-white p-4"><h4 class="font-semibold text-[#004d45]">Current Pain</h4><p class="mt-1 text-sm text-slate-600">Fragmented communication and reactive operations.</p></div>
                    <div class="rounded-xl border border-[#d57bfe]/40 bg-white p-4"><h4 class="font-semibold text-[#004d45]">Core Problem</h4><p class="mt-1 text-sm text-slate-600">Exit block creates hidden bottlenecks.</p></div>
                    <div class="rounded-xl border border-[#d57bfe]/40 bg-white p-4"><h4 class="font-semibold text-[#004d45]">Healora Shift</h4><p class="mt-1 text-sm text-slate-600">Predictive, AI-guided operational control.</p></div>
                </div>
            </article>

            <article class="overflow-hidden rounded-3xl border border-slate-700 bg-slate-950 shadow-sm">
                <div class="border-b border-slate-800 bg-slate-900 px-6 py-4">
                    <h2 class="text-xl font-semibold text-[#7ef0dc]">Option B — Executive Dark</h2>
                </div>
                <div class="bg-gradient-to-r from-[#003d38] via-[#009785] to-[#b275ff] px-6 py-12 text-white">
                    <p class="inline-block rounded-full border border-white/25 bg-white/10 px-3 py-1 text-xs">Command Center Mode</p>
                    <h3 class="mt-4 text-4xl font-bold leading-tight">AI Control Tower for Hospital Throughput</h3>
                    <p class="mt-3 max-w-2xl text-slate-200">Bolder visual authority, boardroom-ready, strong technology impression.</p>
                </div>
                <div class="grid gap-4 px-6 py-6 md:grid-cols-4">
                    <div class="rounded-xl border border-slate-700 bg-slate-900 p-4 text-slate-100"><p class="text-xs text-slate-400">Prediction Accuracy</p><p class="mt-1 text-2xl font-bold text-[#7ef0dc]">95-98%</p></div>
                    <div class="rounded-xl border border-slate-700 bg-slate-900 p-4 text-slate-100"><p class="text-xs text-slate-400">Forecast Horizon</p><p class="mt-1 text-2xl font-bold text-[#7ef0dc]">12h</p></div>
                    <div class="rounded-xl border border-slate-700 bg-slate-900 p-4 text-slate-100"><p class="text-xs text-slate-400">Potential Savings</p><p class="mt-1 text-2xl font-bold text-[#7ef0dc]">6.5%</p></div>
                    <div class="rounded-xl border border-slate-700 bg-slate-900 p-4 text-slate-100"><p class="text-xs text-slate-400">Action Latency</p><p class="mt-1 text-2xl font-bold text-[#7ef0dc]">-43%</p></div>
                </div>
            </article>

            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
                    <h2 class="text-xl font-semibold text-slate-800">Option C — Minimal Investor Deck</h2>
                </div>
                <div class="px-6 py-12">
                    <h3 class="text-4xl font-semibold tracking-tight text-slate-900">Predict. Prioritize. Prevent Congestion.</h3>
                    <p class="mt-3 max-w-2xl text-slate-600">Minimal layout, wider spacing, focused narrative with executive clarity.</p>
                    <div class="mt-8 grid gap-4 md:grid-cols-2">
                        <div class="rounded-xl border border-slate-200 p-4"><p class="text-xs uppercase text-slate-500">Problem</p><p class="mt-1 font-medium">Exit Block creates throughput collapse.</p></div>
                        <div class="rounded-xl border border-slate-200 p-4"><p class="text-xs uppercase text-slate-500">Outcome</p><p class="mt-1 font-medium">Faster decisions, safer flow, lower wait.</p></div>
                    </div>
                </div>
            </article>
        </section>
    </main>
</body>
</html>
