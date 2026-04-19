<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        // Token verification
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

        // Sesuaikan dengan model artikel kamu
        // Cek dulu: apakah model kamu namanya Post, Article, atau lainnya?
        $article = \App\Models\Post::create([
            'title'            => $validated['title'],
            'content'          => $validated['content'],
            'meta_description' => $validated['meta_description'] ?? null,
            'status'           => $validated['status'] ?? 'draft',
            'slug'             => Str::slug($validated['title']),
        ]);

        return response()->json([
            'success'     => true,
            'article_id'  => $article->id,
            'message'     => 'Article created successfully',
        ], 201);
    }
}