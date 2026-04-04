<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = Post::published()->paginate(9);
        $faqs  = Faq::active()->get();

        return view('artikel.index', compact('posts', 'faqs'));
    }

    public function show(string $slug): View
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        return view('artikel.show', compact('post'));
    }
}
