<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOTools;

class CatalogController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');

        SEOTools::setTitle('Katalog Mobil Bekas — Kerinci Motor Bekasi');
        SEOTools::setDescription('Temukan mobil bekas berkualitas di Kerinci Motor. Filter berdasarkan merek, harga, tahun, dan banyak parameter lainnya.');
        SEOTools::opengraph()->setUrl(url('/catalog'));

        return view('catalog.index', compact('settings'));
    }

    public function show(Car $car)
    {
        $car->load('media');

        $title       = "{$car->make_model} {$car->year} — Kerinci Motor";
        $description = "Beli {$car->make_model} tahun {$car->year}, {$car->formatted_mileage}, transmisi {$car->transmission}. Harga {$car->formatted_price}. Hubungi Kerinci Motor via WhatsApp sekarang.";

        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::opengraph()->setUrl(url("/catalog/{$car->slug}"));
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

        return view('catalog.show', compact('car', 'relatedCars', 'settings'));
    }
}
