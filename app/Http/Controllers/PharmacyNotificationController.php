<?php

namespace App\Http\Controllers;

use App\Models\PharmacyNotification;
use App\Notifications\PharmacyTestAlert;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class PharmacyNotificationController extends Controller
{
    public function index(): View
    {
        return view('notifications.pharmacy', [
            'defaultRecipient' => config('mail.from.address', 'pharmacy@example.com'),
            'history' => PharmacyNotification::query()
                ->latest('id')
                ->limit(20)
                ->get(),
        ]);
    }

    public function send(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'recipient_email' => ['required', 'email', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:1500'],
            'severity' => ['required', 'in:low,medium,high'],
        ]);

        Notification::route('mail', $validated['recipient_email'])
            ->notify(new PharmacyTestAlert(
                $validated['title'],
                $validated['message'],
                $validated['severity'],
            ));

        PharmacyNotification::query()->create([
            'target_department' => 'Pharmacy',
            'recipient_email' => $validated['recipient_email'],
            'title' => $validated['title'],
            'message' => $validated['message'],
            'severity' => $validated['severity'],
            'sent_via_mail' => true,
            'sent_at' => now(),
        ]);

        return back()->with('status', 'Test pharmacy notification sent successfully.');
    }
}
