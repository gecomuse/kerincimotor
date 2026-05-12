<?php

namespace App\Http\Controllers;

use App\Models\SellInquiry;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class SellCarController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');

        SEOTools::setTitle('Jual Mobil Anda — Kerinci Motor Bekasi');
        SEOTools::setDescription('Jual mobil Anda ke Kerinci Motor. Proses cepat, harga terbaik, pembayaran langsung. Isi formulir dan kami akan menghubungi Anda via WhatsApp.');

        return view('sell-car', compact('settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'phone'        => 'required|string|max:20',
            'car_make'     => 'required|string|max:100',
            'car_model'    => 'nullable|string|max:150',
            'year'         => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'mileage'      => 'required|integer|min:0',
            'transmission' => 'nullable|in:manual,automatic',
            'asking_price' => 'required|string|max:100',
            'notes'        => 'nullable|string|max:1000',
        ]);

        $inquiry = SellInquiry::create([
            'name'         => $validated['name'],
            'phone'        => $validated['phone'],
            'car_make'     => $validated['car_make'],
            'car_model'    => $validated['car_model'] ?? '',
            'year'         => $validated['year'],
            'mileage'      => $validated['mileage'],
            'transmission' => $validated['transmission'] ?? null,
            'asking_price' => $validated['asking_price'],
            'notes'        => $validated['notes'] ?? null,
        ]);

        $waNumber = Setting::getValue('wa_number', '6287776700009');
        $message  = $this->buildWhatsAppMessage($inquiry);
        $waUrl    = "https://wa.me/{$waNumber}?text=" . urlencode($message);

        return response()->json([
            'success' => true,
            'wa_url'  => $waUrl,
        ]);
    }

    private function buildWhatsAppMessage(SellInquiry $inquiry): string
    {
        return implode("\n", array_filter([
            "Halo Kerinci Motor, saya ingin menjual kendaraan saya:",
            "",
            "📋 *DATA PENJUAL*",
            "Nama: {$inquiry->name}",
            "No. HP: {$inquiry->phone}",
            "",
            "🚗 *DATA KENDARAAN*",
            "Merek: {$inquiry->car_make}",
            $inquiry->car_model ? "Model: {$inquiry->car_model}" : null,
            "Tahun: {$inquiry->year}",
            "Kilometer: " . number_format($inquiry->mileage, 0, ',', '.') . " KM",
            $inquiry->transmission ? "Transmisi: " . ucfirst($inquiry->transmission) : null,
            "",
            "💰 *PENAWARAN*",
            "Harga: Rp {$inquiry->asking_price}",
            $inquiry->notes ? "\n📝 *CATATAN*\n{$inquiry->notes}" : null,
            "",
            "Mohon informasi lebih lanjut. Terima kasih!",
        ]));
    }
}
