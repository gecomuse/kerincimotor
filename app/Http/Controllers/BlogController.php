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
    public function index(): View
    {
        // Ambil pengaturan global
        $settings = Setting::all()->keyBy('key');

        // Setup SEO
        SEOTools::setTitle('Tips & Trick Beli Mobil Bekas — Kerinci Motor');
        SEOTools::setDescription('Tips dan panduan beli mobil bekas dari praktisi Kerinci Motor. Cara cek kondisi mesin, bodi, dokumen, dan negosiasi harga terbaik.');
        SEOTools::opengraph()->setUrl(url('/tips-trick'));

        // 1. Ambil artikel utama (post terbaru)
        $featuredPost = Post::published()->latest('published_at')->first();

        // 2. Ambil artikel sisanya untuk grid
        $posts = Post::published()
            ->when($featuredPost, function ($query) use ($featuredPost) {
                return $query->where('id', '!=', $featuredPost->id);
            })
            ->latest('published_at')
            ->paginate(8);

        // 3. Ambil mobil untuk sidebar "Hot Stock"
        $hotStock = Car::available()
            ->orderByDesc('is_featured')
            ->latest()
            ->take(4)
            ->get();

        // (Opsional) Tetap panggil FAQ jika suatu saat dipakai lagi
        $faqs = Faq::active()->get();

        // RETURN KE VIEW FRONTEND BARU
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