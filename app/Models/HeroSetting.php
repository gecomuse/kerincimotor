<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'card_name',
        'card_sub',
        'card_price',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function current(): ?self
    {
        return static::where('is_active', true)->latest()->first();
    }
}
