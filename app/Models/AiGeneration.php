<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiGeneration extends Model
{
    protected $fillable = [
        'workspace_id', 'type', 'prompt', 'result', 'model', 'tokens_used',
    ];

    protected $casts = [
        'tokens_used' => 'integer',
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }
}
