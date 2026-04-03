<?php

namespace App\Http\Controllers;

use App\Models\SellInquiry;
use App\Models\Setting;
use Illuminate\Http\Request;

class SellInquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'phone'        => 'required|string|max:20',
            'car_make'     => 'required|string|max:100',
            'car_model'    => 'required|string|max:150',
            'year'         => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'mileage'      => 'required|integer|min:0',
            'transmission' => 'nullable|in:manual,automatic',
            'color'        => 'nullable|string|max:100',
            'plate_number' => 'nullable|string|max:20',
            'condition'    => 'nullable|string|max:50',
            'asking_price' => 'required|string|max:100',
            'notes'        => 'nullable|string|max:1000',
        ]);

        $inquiry = SellInquiry::create($validated);

        // Build WhatsApp redirect message
        $waNumber = Setting::getValue('wa_number', '6287776700009');
        $message  = $this->buildWhatsAppMessage($inquiry);
        $waUrl    = "https://wa.me/{$waNumber}?text=" . urlencode($message);

        return redirect()->away($waUrl);
    }

    private function buildWhatsAppMessage(SellInquiry $inquiry): string
    {
        $lines = [
            "Halo Kerinci Motor, saya ingin menjual kendaraan saya:",
            "",
            "📋 *DATA PENJUAL*",
            "Nama: {$inquiry->name}",
            "No. HP: {$inquiry->phone}",
            "",
            "🚗 *DATA KENDARAAN*",
            "Merek: {$inquiry->car_make}",
            "Model/Tipe: {$inquiry->car_model}",
            "Tahun: {$inquiry->year}",
            "Kilometer: " . number_format($inquiry->mileage, 0, ',', '.') . " KM",
        ];

        if ($inquiry->transmission) {
            $lines[] = "Transmisi: " . ucfirst($inquiry->transmission);
        }
        if ($inquiry->color) {
            $lines[] = "Warna: {$inquiry->color}";
        }
        if ($inquiry->plate_number) {
            $lines[] = "No. Polisi: {$inquiry->plate_number}";
        }
        if ($inquiry->condition) {
            $lines[] = "Kondisi: {$inquiry->condition}";
        }

        $lines[] = "";
        $lines[] = "💰 *PENAWARAN*";
        $lines[] = "Harga yang Diinginkan: Rp {$inquiry->asking_price}";

        if ($inquiry->notes) {
            $lines[] = "";
            $lines[] = "📝 *CATATAN TAMBAHAN*";
            $lines[] = $inquiry->notes;
        }

        $lines[] = "";
        $lines[] = "Mohon informasi lebih lanjut. Terima kasih!";

        return implode("\n", $lines);
    }
}
