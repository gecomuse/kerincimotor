<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'car_make',
        'car_model',
        'year',
        'mileage',
        'transmission',
        'color',
        'plate_number',
        'condition',
        'asking_price',
        'notes',
        'status',
    ];

    protected $casts = [
        'year'    => 'integer',
        'mileage' => 'integer',
    ];

    public function getWhatsappUrlAttribute(): string
    {
        $phone   = ltrim($this->phone, '0');
        if (! str_starts_with($phone, '62')) {
            $phone = '62' . ltrim($phone, '+');
        }
        $message = urlencode(
            "Halo {$this->name}, saya dari Kerinci Motor ingin menghubungi Anda mengenai penawaran jual kendaraan {$this->car_make} {$this->car_model} Tahun {$this->year}."
        );
        return "https://wa.me/{$phone}?text={$message}";
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}
