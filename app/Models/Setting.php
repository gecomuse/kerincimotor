<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'label', 'value', 'type'];

    public static function getValue(string $key, string $default = ''): string
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? ($setting->value ?? $default) : $default;
        });
    }

    public static function setValue(string $key, string $value): void
    {
        static::where('key', $key)->update(['value' => $value]);
        Cache::forget("setting_{$key}");
    }

    public static function all($columns = ['*'])
    {
        return Cache::remember('settings_all', 3600, function () use ($columns) {
            return parent::all($columns);
        });
    }

    protected static function booted(): void
    {
        static::saved(function (Setting $setting) {
            Cache::forget("setting_{$setting->key}");
            Cache::forget('settings_all');
        });
    }
}
