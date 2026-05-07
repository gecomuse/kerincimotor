<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'workspace_id', 'name', 'description', 'specifications', 'price',
        'category', 'target_audience', 'tone', 'original_images',
        'ai_analyzed_data', 'status',
    ];

    protected $casts = [
        'specifications' => 'array',
        'original_images' => 'array',
        'ai_analyzed_data' => 'array',
        'price' => 'decimal:2',
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    public function contentPosts(): HasMany
    {
        return $this->hasMany(ContentPost::class);
    }
}
