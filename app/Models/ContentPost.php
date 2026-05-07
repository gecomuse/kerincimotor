<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContentPost extends Model
{
    protected $fillable = [
        'workspace_id', 'product_id', 'title', 'caption', 'media_url', 'media_type',
        'target_platforms', 'status', 'ai_metadata',
    ];

    protected $casts = [
        'target_platforms' => 'array',
        'ai_metadata' => 'array',
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function postSchedules(): HasMany
    {
        return $this->hasMany(PostSchedule::class);
    }
}
