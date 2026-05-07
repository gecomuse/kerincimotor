<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostSchedule extends Model
{
    protected $fillable = [
        'content_post_id', 'social_account_id', 'scheduled_at',
        'published_at', 'status', 'error_message', 'platform_response',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'published_at' => 'datetime',
        'platform_response' => 'array',
    ];

    public function contentPost(): BelongsTo
    {
        return $this->belongsTo(ContentPost::class);
    }

    public function socialAccount(): BelongsTo
    {
        return $this->belongsTo(SocialAccount::class);
    }
}
