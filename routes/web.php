<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellInquiryController;
use App\Http\Controllers\AdminRegisterController;
use Illuminate\Support\Facades\Route;

// ── Public Frontend ────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// Catalog
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{car:slug}', [CatalogController::class, 'show'])->name('catalog.show');

// Sell Your Car form submission
Route::post('/sell-inquiry', [SellInquiryController::class, 'store'])
    ->middleware('throttle:5,60')
    ->name('sell-inquiry.store');

// Sitemap
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');

// ── Hidden Admin Registration (token-protected) ────────────────────────────
// The URL is: /admin-register/{token}
// Set ADMIN_REGISTER_TOKEN in .env to your secret token
Route::middleware('admin.register.token')->group(function () {
    Route::get('/admin-register/{token}',  [AdminRegisterController::class, 'show'])->name('admin.register.show');
    Route::post('/admin-register/{token}', [AdminRegisterController::class, 'store'])->name('admin.register.store');
});
