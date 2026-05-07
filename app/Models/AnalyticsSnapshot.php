<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnalyticsSnapshot extends Model
{
    protected $fillable = [
        'social_account_id', 'date', 'followers_count', 'reach',
        'impressions', 'engagement_rate', 'data',
    ];

    protected $casts = [
        'date' => 'date',
        'data' => 'array',
    ];

    public function socialAccount(): BelongsTo
    {
        return $this->belongsTo(SocialAccount::class);
    }
}
