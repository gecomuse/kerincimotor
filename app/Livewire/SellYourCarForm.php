<?php

namespace App\Livewire;

use App\Models\SellInquiry;
use App\Models\Setting;
use Livewire\Component;

class SellYourCarForm extends Component
{
    public int    $step         = 1;

    // Step 1
    public string $name         = '';
    public string $phone        = '';

    // Step 2
    public string $car_make     = '';
    public string $car_model    = '';
    public string $year         = '';
    public string $mileage      = '';
    public string $transmission = '';
    public string $color        = '';
    public string $plate_number = '';
    public string $condition    = '';

    // Step 3
    public string $asking_price = '';
    public string $notes        = '';

    public bool   $submitted    = false;

    protected function rulesForStep(int $step): array
    {
        return match ($step) {
            1 => [
                'name'  => 'required|string|max:100',
                'phone' => 'required|string|max:20',
            ],
            2 => [
                'car_make'  => 'required|string|max:100',
                'car_model' => 'required|string|max:150',
                'year'      => 'required|integer|min:1990|max:' . (date('Y') + 1),
                'mileage'   => 'required|integer|min:0',
            ],
            3 => [
                'asking_price' => 'required|string|max:100',
            ],
            default => [],
        };
    }

    public function nextStep(): void
    {
        $this->validate($this->rulesForStep($this->step));
        $this->step++;
    }

    public function prevStep(): void
    {
        $this->step = max(1, $this->step - 1);
    }

    public function submit()
    {
        $this->validate($this->rulesForStep(3));

        $inquiry = SellInquiry::create([
            'name'         => $this->name,
            'phone'        => $this->phone,
            'car_make'     => $this->car_make,
            'car_model'    => $this->car_model,
            'year'         => (int) $this->year,
            'mileage'      => (int) $this->mileage,
            'transmission' => $this->transmission ?: null,
            'color'        => $this->color ?: null,
            'plate_number' => $this->plate_number ?: null,
            'condition'    => $this->condition ?: null,
            'asking_price' => $this->asking_price,
            'notes'        => $this->notes ?: null,
        ]);

        $waNumber = Setting::getValue('wa_number', '6287776700009');
        $message  = $this->buildMessage();
        $waUrl    = "https://wa.me/{$waNumber}?text=" . urlencode($message);

        $this->submitted = true;

        $this->dispatch('redirect-to-wa', url: $waUrl);
    }

    private function buildMessage(): string
    {
        $lines = [
            "Halo Kerinci Motor, saya ingin menjual kendaraan saya:",
            "",
            "📋 *DATA PENJUAL*",
            "Nama: {$this->name}",
            "No. HP: {$this->phone}",
            "",
            "🚗 *DATA KENDARAAN*",
            "Merek: {$this->car_make}",
            "Model/Tipe: {$this->car_model}",
            "Tahun: {$this->year}",
            "Kilometer: " . number_format((int) $this->mileage, 0, ',', '.') . " KM",
        ];

        if ($this->transmission) {
            $lines[] = "Transmisi: " . ucfirst($this->transmission);
        }
        if ($this->color) {
            $lines[] = "Warna: {$this->color}";
        }
        if ($this->plate_number) {
            $lines[] = "No. Polisi: {$this->plate_number}";
        }
        if ($this->condition) {
            $lines[] = "Kondisi: {$this->condition}";
        }

        $lines[] = "";
        $lines[] = "💰 *PENAWARAN*";
        $lines[] = "Harga yang Diinginkan: Rp {$this->asking_price}";

        if ($this->notes) {
            $lines[] = "";
            $lines[] = "📝 Catatan: {$this->notes}";
        }

        return implode("\n", $lines);
    }

    public function render()
    {
        return view('livewire.sell-your-car-form');
    }
}
