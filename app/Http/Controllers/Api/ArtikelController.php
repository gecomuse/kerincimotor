<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'                  => 'required|string|max:255',
            'isi'                    => 'required|string',
            'meta_title'             => 'nullable|string|max:60',
            'meta_description'       => 'nullable|string|max:160',
            'meta_keywords'          => 'nullable|string',
            'caption_ig'             => 'nullable|string',
            'caption_fb'             => 'nullable|string',
            'caption_marketplace'    => 'nullable|string',
        ]);

        $slug = $this->uniqueSlug(Str::slug($validated['judul']));

        $post = Post::create([
            'title'            => $validated['judul'],
            'slug'             => $slug,
            'category'         => 'Stok Unit',
            'excerpt'          => Str::limit(strip_tags($validated['isi']), 300),
            'content'          => $validated['isi'],
            'meta_title'       => $validated['meta_title'] ?? $validated['judul'],
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords'    => $validated['meta_keywords'] ?? null,
            'is_published'     => true,
            'published_at'     => now(),
        ]);

        return response()->json([
            'success' => true,
            'post_id' => $post->id,
            'slug'    => $post->slug,
            'url'     => 'https://kerincimotor.com/artikel/' . $post->slug,
            'message' => 'Artikel berhasil dipublikasikan',
        ], 201);
    }

    private function uniqueSlug(string $base): string
    {
        $slug    = $base;
        $counter = 2;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }
}
