<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyNotification extends Model
{
    protected $fillable = [
        'target_department',
        'recipient_email',
        'title',
        'message',
        'severity',
        'sent_via_mail',
        'sent_at',
    ];

    protected function casts(): array
    {
        return [
            'sent_via_mail' => 'boolean',
            'sent_at' => 'datetime',
        ];
    }
}
