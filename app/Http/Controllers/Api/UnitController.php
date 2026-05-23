<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'tahun'      => 'required|integer|min:1990|max:2099',
            'transmisi'  => 'required|string',
            'harga'      => 'required|integer|min:0',
            'kilometer'  => 'required|integer|min:0',
            'pajak'      => 'required|string|max:100',
            'keterangan' => 'nullable|string',
            'foto_utama' => 'nullable|url',
            'foto_urls'  => 'nullable|array',
            'foto_urls.*'=> 'url',
        ]);

        $transmisiMap = [
            'Manual'    => 'manual',
            'Automatic' => 'automatic',
        ];
        $transmisi = $transmisiMap[$validated['transmisi']] ?? strtolower($validated['transmisi']);

        $car = Car::create([
            'make_model'      => $validated['nama'],
            'year'            => $validated['tahun'],
            'transmission'    => $transmisi,
            'price'           => $validated['harga'],
            'mileage'         => $validated['kilometer'],
            'tax_status'      => $validated['pajak'],
            'condition_notes' => $validated['keterangan'] ?? null,
            'is_available'    => true,
            'is_featured'     => false,
        ]);

        $fotoUrls = $validated['foto_urls'] ?? [];
        if (! empty($validated['foto_utama']) && ! in_array($validated['foto_utama'], $fotoUrls)) {
            array_unshift($fotoUrls, $validated['foto_utama']);
        }

        foreach ($fotoUrls as $url) {
            try {
                $car->addMediaFromUrl($url)->toMediaCollection('car_images');
            } catch (\Throwable $e) {
                // skip failed URL, continue
            }
        }

        return response()->json([
            'success' => true,
            'car_id'  => $car->id,
            'slug'    => $car->slug,
            'message' => 'Unit berhasil ditambahkan',
        ], 201);
    }
}
