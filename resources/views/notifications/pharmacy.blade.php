<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healora | Notification Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <header class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Notifications</p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight">General Test Notification Center</h1>
            <p class="mt-2 text-sm text-slate-600">Send test alerts to any department and keep delivery history in your Laravel app.</p>
        </header>

        @if (session('status'))
            <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-base font-semibold">Send test alert</h2>
            <form method="POST" action="{{ route('notifications.send') }}" class="mt-4 grid gap-4">
                @csrf
                <div>
                    <label for="target_department" class="text-sm font-medium text-slate-700">Department</label>
                    <input id="target_department" name="target_department" type="text" value="{{ old('target_department', $defaultDepartment ?? 'Pharmacy') }}" required class="mt-1 w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none ring-emerald-500 focus:ring">
                </div>
                <div>
                    <label for="recipient_email" class="text-sm font-medium text-slate-700">Recipient email</label>
                    <input id="recipient_email" name="recipient_email" type="email" value="{{ old('recipient_email', $defaultRecipient) }}" required class="mt-1 w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none ring-emerald-500 focus:ring">
                </div>
                <div>
                    <label for="title" class="text-sm font-medium text-slate-700">Alert title</label>
                    <input id="title" name="title" type="text" value="{{ old('title', 'Medication verification delay in ED') }}" required class="mt-1 w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none ring-emerald-500 focus:ring">
                </div>
                <div>
                    <label for="severity" class="text-sm font-medium text-slate-700">Severity</label>
                    <select id="severity" name="severity" class="mt-1 w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none ring-emerald-500 focus:ring">
                        @foreach (['low', 'medium', 'high'] as $level)
                            <option value="{{ $level }}" @selected(old('severity', 'medium') === $level)>{{ strtoupper($level) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="message" class="text-sm font-medium text-slate-700">Message</label>
                    <textarea id="message" name="message" rows="4" required class="mt-1 w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none ring-emerald-500 focus:ring">{{ old('message', 'Please prioritize discharge-medication reconciliation for boarding patients in the ED within 30 minutes.') }}</textarea>
                </div>
                <div>
                    <button type="submit" class="rounded-xl bg-emerald-700 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-800">
                        Send Test Notification
                    </button>
                </div>
            </form>
        </section>

        <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-base font-semibold">Recent notifications</h2>
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-3 py-2">Sent at</th>
                            <th class="px-3 py-2">Department</th>
                            <th class="px-3 py-2">Recipient</th>
                            <th class="px-3 py-2">Severity</th>
                            <th class="px-3 py-2">Title</th>
                            <th class="px-3 py-2">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($history as $item)
                            <tr class="border-t border-slate-200">
                                <td class="px-3 py-2 text-slate-600">{{ optional($item->sent_at)->format('Y-m-d H:i') ?? '-' }}</td>
                                <td class="px-3 py-2">{{ $item->target_department }}</td>
                                <td class="px-3 py-2">{{ $item->recipient_email }}</td>
                                <td class="px-3 py-2">
                                    <span class="rounded-full px-2 py-1 text-xs {{ $item->severity === 'high' ? 'bg-rose-100 text-rose-700' : ($item->severity === 'low' ? 'bg-slate-100 text-slate-700' : 'bg-amber-100 text-amber-700') }}">
                                        {{ strtoupper($item->severity) }}
                                    </span>
                                </td>
                                <td class="px-3 py-2">{{ $item->title }}</td>
                                <td class="px-3 py-2 text-slate-600">{{ $item->message }}</td>
                            </tr>
                        @empty
                            <tr class="border-t border-slate-200">
                                <td colspan="6" class="px-3 py-4 text-center text-slate-500">No notifications yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
