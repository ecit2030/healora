<?php

namespace App\Http\Controllers;

use App\Models\DepartmentNotification;
use App\Notifications\DepartmentTestAlert;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class NotificationCenterController extends Controller
{
    public function index(): View
    {
        return view('notifications.pharmacy', [
            'defaultRecipient' => config('mail.from.address', 'ops@example.com'),
            'defaultDepartment' => 'Pharmacy',
            'history' => DepartmentNotification::query()
                ->latest('id')
                ->limit(20)
                ->get(),
        ]);
    }

    public function send(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'target_department' => ['required', 'string', 'max:120'],
            'recipient_email' => ['required', 'email', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:1500'],
            'severity' => ['required', 'in:low,medium,high'],
        ]);

        Notification::route('mail', $validated['recipient_email'])
            ->notify(new DepartmentTestAlert(
                $validated['target_department'],
                $validated['title'],
                $validated['message'],
                $validated['severity'],
            ));

        DepartmentNotification::query()->create([
            'target_department' => $validated['target_department'],
            'recipient_email' => $validated['recipient_email'],
            'title' => $validated['title'],
            'message' => $validated['message'],
            'severity' => $validated['severity'],
            'sent_via_mail' => true,
            'sent_at' => now(),
        ]);

        return back()->with('status', 'Test notification sent successfully.');
    }
}
