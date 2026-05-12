<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::all()->keyBy('key');

        SEOTools::setTitle('Katalog Mobil Bekas — Kerinci Motor Bekasi');
        SEOTools::setDescription('Temukan mobil bekas berkualitas di Kerinci Motor. Filter berdasarkan merek, harga, tahun, dan banyak parameter lainnya.');
        SEOTools::opengraph()->setUrl(url('/inventory'));

        // Query dasar untuk mobil yang tersedia
        $query = Car::available()->with('media');

        // Filter berdasarkan form pencarian
        if ($request->filled('make')) {
            $query->where('name', 'like', '%' . $request->make . '%');
        }
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Sorting
        $sort = $request->input('sort', 'featured');
        if ($sort === 'newest') {
            $query->latest();
        } elseif ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            // Default sort: Unggulan (featured) di atas, lalu urutan standar
            $query->orderByDesc('is_featured')->ordered();
        }

        // Paginate hasil pencarian
        $cars = $query->paginate(12)->withQueryString();

        // RETURN KE VIEW FRONTEND BARU
        return view('frontend.inventory', compact('settings', 'cars'));
    }

    public function show(Car $car)
    {
        $car->load('media');

        $title       = "{$car->make_model} {$car->year} — Kerinci Motor";
        $description = "Beli {$car->make_model} tahun {$car->year}, {$car->formatted_mileage}, transmisi {$car->transmission}. Harga {$car->formatted_price}. Hubungi Kerinci Motor via WhatsApp sekarang.";

        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::opengraph()->setUrl(url("/mobil/{$car->slug}"));
        SEOTools::opengraph()->addProperty('type', 'product');

        $firstImage = $car->getFirstMediaUrl('car_images', 'medium');
        if ($firstImage) {
            SEOTools::opengraph()->addImage($firstImage);
            SEOTools::twitter()->addValue('image', $firstImage);
        }

        SEOTools::metatags()->addMeta('og:price:amount', $car->price, 'property');
        SEOTools::metatags()->addMeta('og:price:currency', 'IDR', 'property');

        $relatedCars = Car::available()
            ->where('id', '!=', $car->id)
            ->where('body_type', $car->body_type)
            ->ordered()
            ->with('media')
            ->take(4)
            ->get();

        $settings = Setting::all()->keyBy('key');

        // RETURN KE VIEW FRONTEND BARU
        return view('frontend.car-detail', compact('car', 'relatedCars', 'settings'));
    }
}