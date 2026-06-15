<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotificationPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_alerts_enabled',
        'daily_alerts',
        'weekly_alerts',
        'preferred_job_types',
        'preferred_locations',
        'preferred_job_functions',
    ];

    protected $casts = [
        'job_alerts_enabled' => 'boolean',
        'daily_alerts' => 'boolean',
        'weekly_alerts' => 'boolean',
        'preferred_job_types' => 'array',
        'preferred_locations' => 'array',
        'preferred_job_functions' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}