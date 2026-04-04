<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Testimonial;
use Artesaos\SEOTools\Facades\SEOTools;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');

        SEOTools::setTitle($settings['meta_title']->value ?? 'Kerinci Motor — Trusted Used-Car Showroom in Bekasi');
        SEOTools::setDescription($settings['meta_description']->value ?? '');
        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addProperty('site_name', 'Kerinci Motor');

        $featuredCars  = Car::available()->ordered()->with('media')->take(8)->get();
        $testimonials  = Testimonial::active()->ordered()->get();
        $totalCars     = Car::available()->count();
        $latestPosts   = Post::published()->take(3)->get();

        return view('home', compact('settings', 'featuredCars', 'testimonials', 'totalCars', 'latestPosts'));
    }

    public function sitemap(): Response
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('weekly'))
            ->add(Url::create('/catalog')->setPriority(0.9)->setChangeFrequency('daily'))
            ->add(Url::create('/artikel')->setPriority(0.9)->setChangeFrequency('weekly'));

        Car::available()->get()->each(function (Car $car) use ($sitemap) {
            $sitemap->add(
                Url::create("/catalog/{$car->slug}")
                    ->setPriority(0.8)
                    ->setChangeFrequency('weekly')
                    ->setLastModificationDate($car->updated_at)
            );
        });

        Post::published()->get()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(
                Url::create("/artikel/{$post->slug}")
                    ->setPriority(0.8)
                    ->setChangeFrequency('monthly')
                    ->setLastModificationDate($post->updated_at)
            );
        });

        return response($sitemap->render(), 200, ['Content-Type' => 'application/xml']);
    }
}
