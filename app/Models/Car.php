<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Car extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'slug',
        'make_model',
        'body_type',
        'year',
        'price',
        'mileage',
        'transmission',
        'fuel_type',
        'color',
        'description',
        'tax_status',
        'condition_notes',
        'whatsapp_message',
        'is_available',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_featured'  => 'boolean',
        'price'        => 'integer',
        'mileage'      => 'integer',
        'year'         => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('make_model')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(80);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        // Menentukan disk 'public' secara eksplisit agar sinkron dengan symlink
        $this->addMediaCollection('car_images')
            ->useDisk('public')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->onlyKeepLatest(16);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(300)
            ->format('webp')
            ->quality(80)
            ->nonQueued(); // Menjalankan langsung tanpa antrean agar cepat muncul

        $this->addMediaConversion('medium')
            ->width(800)
            ->height(600)
            ->format('webp')
            ->quality(85)
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(900)
            ->format('webp')
            ->quality(90)
            ->nonQueued();
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedMileageAttribute(): string
    {
        return number_format($this->mileage, 0, ',', '.') . ' KM';
    }

    /**
     * Mengambil URL Gambar untuk Detail
     * Jika versi 'large' belum di-generate, ambil versi asli.
     */
    public function getLargeImageAttribute(): ?string
    {
        $media = $this->getFirstMedia('car_images');
        if (! $media) return null;
        
        // Cek apakah konversi 'large' sudah ada, jika tidak pakai asli
        return $media->hasGeneratedConversion('large') 
            ? $media->getUrl('large') 
            : $media->getUrl();
    }

    public function getThumbnailAttribute(): ?string
    {
        $media = $this->getFirstMedia('car_images');
        if (! $media) return null;

        return $media->hasGeneratedConversion('thumb') 
            ? $media->getUrl('thumb') 
            : $media->getUrl();
    }

    public function getWhatsappMessageAttribute($value): string
    {
        if ($value) return $value;

        return "Halo Kerinci Motor, saya tertarik dengan {$this->make_model} Tahun {$this->year} — {$this->formatted_price}. Apakah masih tersedia?";
    }

    public function getWhatsappUrlAttribute(): string
    {
        // Fallback jika class Setting belum ada/error
        $waNumber = '6287776700009'; 
        if (class_exists('\App\Models\Setting')) {
            $waNumber = \App\Models\Setting::getValue('wa_number', '6287776700009');
        }
        
        $message = urlencode($this->whatsapp_message);
        return "https://wa.me/{$waNumber}?text={$message}";
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('is_featured', 'desc')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc');
    }
}