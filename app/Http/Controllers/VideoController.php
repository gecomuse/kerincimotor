<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOTools;

class VideoController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');

        SEOTools::setTitle('Video Review Unit — Kerinci Motor');
        SEOTools::setDescription('Tonton video review lengkap unit mobil bekas di Kerinci Motor. Cek eksterior, interior, mesin, dan test drive — jujur tanpa filter.');

        $featuredVideo = Video::active()->featured()->ordered()->first();
        $videos        = Video::active()->ordered()->get();

        // UPDATE DI SINI: Tambahkan prefix 'frontend.'
        return view('frontend.video', compact('settings', 'featuredVideo', 'videos'));
    }
}