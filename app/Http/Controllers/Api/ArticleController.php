<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $token = $request->bearerToken();
        if ($token !== config('services.openclaw.token')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'content'          => 'required|string',
            'meta_description' => 'nullable|string|max:160',
            'category'         => 'nullable|string',
            'status'           => 'nullable|in:draft,published',
        ]);

        $isPublished = ($validated['status'] ?? 'draft') === 'published';

        $article = Post::create([
            'title'            => $validated['title'],
            'slug'             => Str::slug($validated['title']),
            'content'          => $validated['content'],
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_title'       => $validated['title'],
            'category'         => $validated['category'] ?? 'Stok Mobil',
            'is_published'     => $isPublished,
            'published_at'     => $isPublished ? now() : null,
            'excerpt'          => Str::limit(strip_tags($validated['content']), 150),
        ]);

        return response()->json([
            'success'    => true,
            'article_id' => $article->id,
            'slug'       => $article->slug,
            'message'    => 'Article created successfully',
        ], 201);
    }
}