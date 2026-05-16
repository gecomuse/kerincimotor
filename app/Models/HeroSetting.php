<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car;

class HeroSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'card_name',
        'card_sub',
        'card_price',
        'is_active',
        'car_id',
        'financing_car_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function financingCar()
    {
        return $this->belongsTo(Car::class, 'financing_car_id');
    }

    public static function current(): ?self
    {
        return static::where('is_active', true)->latest()->first();
    }
}
