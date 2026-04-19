<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    private const VALID_CATEGORIES = [
        'Panduan', 'Harga Pasar', 'Perbandingan', 'Kredit & DP',
        'Rekomendasi', 'Tips Merawat', 'Berita',
    ];

    public function store(Request $request)
    {
        $token = $request->bearerToken();
        if ($token !== config('services.openclaw.token')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'title'                => 'required|string|max:255',
            'content'              => 'required|string',
            'excerpt'              => 'nullable|string|max:300',
            'category'             => 'nullable|string|in:' . implode(',', self::VALID_CATEGORIES),
            'meta_title'           => 'nullable|string|max:100',
            'meta_description'     => 'nullable|string|max:160',
            'meta_keywords'        => 'nullable|string',
            'read_time'            => 'nullable|integer|min:1',
            'status'               => 'nullable|in:draft,published',
            'publish_to_instagram' => 'nullable|boolean',
            'publish_to_facebook'  => 'nullable|boolean',
            'social_caption'       => 'nullable|string',
            'social_format'        => 'nullable|in:feed,carousel,reel',
            'thumbnail'            => 'nullable|string',
        ]);

        $isPublished = ($validated['status'] ?? 'draft') === 'published';
        $content     = $validated['content'];
        $title       = $validated['title'];

        $slug = $this->uniqueSlug(Str::slug($title));

        $excerpt = $validated['excerpt']
            ?? Str::limit(strip_tags($content), 300);

        $readTime = $validated['read_time']
            ?? (int) ceil(str_word_count(strip_tags($content)) / 200) ?: 1;

        $thumbnailPath = null;
        if (!empty($validated['thumbnail'])) {
            $thumbnailPath = str_replace(asset('storage') . '/', '', $validated['thumbnail']);
        }

        $article = Post::create([
            'title'                => $title,
            'slug'                 => $slug,
            'content'              => $content,
            'excerpt'              => $excerpt,
            'category'             => $validated['category'] ?? 'Panduan',
            'meta_title'           => $validated['meta_title'] ?? $title,
            'meta_description'     => $validated['meta_description'] ?? null,
            'meta_keywords'        => $validated['meta_keywords'] ?? null,
            'read_time'            => $readTime,
            'is_published'         => $isPublished,
            'published_at'         => $isPublished ? now() : null,
            'publish_to_instagram' => $validated['publish_to_instagram'] ?? false,
            'publish_to_facebook'  => $validated['publish_to_facebook'] ?? false,
            'social_caption'       => $validated['social_caption'] ?? null,
            'social_format'        => $validated['social_format'] ?? 'feed',
            'thumbnail'            => $thumbnailPath,
        ]);

        return response()->json([
            'success'    => true,
            'article_id' => $article->id,
            'slug'       => $article->slug,
            'url'        => 'https://kerincimotor.com/artikel/' . $article->slug,
            'message'    => 'Article created successfully',
        ], 201);
    }

    public function uploadImage(Request $request)
    {
        $token = $request->bearerToken();
        if ($token !== config('services.openclaw.token')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'image'     => 'required_without:image_url|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image_url' => 'required_without:image|nullable|url',
            'type'      => 'nullable|in:thumbnail,meta_image',
        ]);

        $type      = $request->input('type', 'thumbnail');
        $directory = "posts/{$type}s";

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store($directory, 'public');
        } else {
            $imageUrl  = $request->input('image_url');
            $response  = Http::timeout(15)->get($imageUrl);

            if (!$response->successful()) {
                return response()->json(['success' => false, 'message' => 'Failed to download image from URL'], 422);
            }

            $mime      = $response->header('Content-Type');
            $extension = match (explode(';', $mime)[0]) {
                'image/jpeg' => 'jpg',
                'image/png'  => 'png',
                'image/webp' => 'webp',
                default      => 'jpg',
            };

            $filename = Str::uuid() . '.' . $extension;
            $path     = "{$directory}/{$filename}";
            Storage::disk('public')->put($path, $response->body());
        }

        $url = asset('storage/' . $path);

        return response()->json([
            'success' => true,
            'path'    => $path,
            'url'     => $url,
            'message' => 'Image uploaded successfully',
        ]);
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
