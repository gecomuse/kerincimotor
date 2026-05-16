<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(\Illuminate\Http\Request $request): View
    {
        $settings = Setting::all()->keyBy('key');

        SEOTools::setTitle('Tips & Trick Beli Mobil Bekas — Kerinci Motor');
        SEOTools::setDescription('Tips dan panduan beli mobil bekas dari praktisi Kerinci Motor. Cara cek kondisi mesin, bodi, dokumen, dan negosiasi harga terbaik.');
        SEOTools::opengraph()->setUrl(url('/tips-trick'));

        $query = Post::published()
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->category))
            ->when($request->filled('search'), fn ($q) => $q->where('title', 'like', '%' . $request->search . '%'));

        $featuredPost = (clone $query)->latest('published_at')->first();

        $posts = (clone $query)
            ->when($featuredPost, fn ($q) => $q->where('id', '!=', $featuredPost->id))
            ->paginate(12)
            ->withQueryString();

        $hotStock = Car::available()
            ->orderByDesc('is_featured')
            ->latest()
            ->take(4)
            ->get();

        $faqs = Faq::active()->get();

        return view('frontend.tips', compact('settings', 'featuredPost', 'posts', 'hotStock', 'faqs'));
    }

    public function show(string $slug): View
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        // Catatan: Karena belum ada view 'frontend.article-detail',
        // kita arahkan sementara ke view lama. Jika nanti view barunya
        // sudah ada, tinggal ubah menjadi 'frontend.article-detail'.
        return view('artikel.show', compact('post'));
    }
}