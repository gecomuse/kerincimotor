<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellInquiryController;
use App\Http\Controllers\SellCarController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AdminRegisterController;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;

// ── Public Frontend ────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// Catalog (primary URLs)
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{car:slug}', [CatalogController::class, 'show'])->name('catalog.show');

// Catalog aliases (SEO-friendly URLs)
Route::get('/inventory', [CatalogController::class, 'index'])->name('inventory.index');
Route::get('/mobil/{car:slug}', [CatalogController::class, 'show'])->name('car.detail');

// Sell Your Car — existing Livewire form submission
Route::post('/sell-inquiry', [SellInquiryController::class, 'store'])
    ->middleware('throttle:5,60')
    ->name('sell-inquiry.store');

// Sell Your Car — dedicated page + JSON endpoint
Route::get('/jual-mobil', [SellCarController::class, 'index'])->name('sell.index');
Route::post('/lead', [SellCarController::class, 'store'])
    ->middleware('throttle:5,60')
    ->name('lead.store');

// WhatsApp redirect
Route::get('/whatsapp', function () {
    $waNumber = Setting::getValue('wa_number', '6287776700009');
    $msg = urlencode('Halo Kerinci Motor, saya ingin mengetahui unit yang tersedia.');
    return redirect()->away("https://wa.me/{$waNumber}?text={$msg}");
})->name('whatsapp');

// Artikel (Blog)
Route::get('/artikel', [BlogController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [BlogController::class, 'show'])->name('artikel.show');

// Tips alias for artikel
Route::get('/tips-trick', [BlogController::class, 'index'])->name('tips.index');

// Video
Route::get('/video', [VideoController::class, 'index'])->name('video');
Route::get('/video-review', [VideoController::class, 'index'])->name('video.index');

// Sitemap
Route::get('/sitemap.xml', function () {
    $posts = collect([]);
    $vehicles = collect([]);
    try {
        $posts = \App\Models\Post::published()->latest('published_at')->get();
    } catch (\Exception $e) {}
    try {
        if (class_exists(\App\Models\Vehicle::class)) {
            $vehicles = \App\Models\Vehicle::all();
        }
    } catch (\Exception $e) {}

    $content = view('sitemap', compact('posts', 'vehicles'))->render();
    return response($content, 200, [
        'Content-Type'  => 'text/xml; charset=utf-8',
        'Cache-Control' => 'public, max-age=3600',
    ]);
});

// ── Hidden Admin Registration (token-protected) ────────────────────────────
// The URL is: /admin-register/{token}
// Set ADMIN_REGISTER_TOKEN in .env to your secret token
Route::middleware('admin.register.token')->group(function () {
    Route::get('/admin-register/{token}',  [AdminRegisterController::class, 'show'])->name('admin.register.show');
    Route::post('/admin-register/{token}', [AdminRegisterController::class, 'store'])->name('admin.register.store');
});
