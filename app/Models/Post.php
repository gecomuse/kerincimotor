<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'thumbnail',
        'meta_image',
        'read_time',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        // Social media distribution
        'publish_to_instagram',
        'publish_to_facebook',
        'social_format',
        'social_caption',
        'carousel_images',
        'reel_video_path',
        'social_scheduled_at',
        'ig_status',
        'fb_status',
        'social_error_message',
    ];

    protected $casts = [
        'is_published'         => 'boolean',
        'published_at'         => 'datetime',
        'read_time'            => 'integer',
        'publish_to_instagram' => 'boolean',
        'publish_to_facebook'  => 'boolean',
        'carousel_images'      => 'array',
        'social_scheduled_at'  => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
            if ($post->is_published && empty($post->published_at)) {
                $post->published_at = now();
            }
        });

        static::updating(function (Post $post) {
            if ($post->isDirty('is_published') && $post->is_published && empty($post->published_at)) {
                $post->published_at = now();
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderByDesc('published_at');
    }

    public function getSeoTitle(): string
    {
        return $this->meta_title ?: $this->title . ' | Kerinci Motor Bekasi';
    }

    public function getSeoDescription(): string
    {
        return $this->meta_description ?: $this->excerpt;
    }

    public function getSeoKeywords(): string
    {
        return $this->meta_keywords ?: '';
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnail ? Storage::url($this->thumbnail) : null;
    }

    public function getMetaImageUrl(): ?string
    {
        if ($this->meta_image) {
            return Storage::url($this->meta_image);
        }
        return $this->getThumbnailUrl();
    }

    public function getThumbnailUrlAttribute(): string
    {
        return $this->thumbnail
            ? Storage::url($this->thumbnail)
            : asset('images/blog-placeholder.jpg');
    }
}
