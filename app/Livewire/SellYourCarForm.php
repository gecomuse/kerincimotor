<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SellInquiry;
use App\Models\Setting;

class SellYourCarForm extends Component
{
    public int $step = 1;
    public int $totalSteps = 3;

    // Step 1 - Personal Info
    public string $name = '';
    public string $phone = '';

    // Step 2 - Vehicle Info
    public string $car_make = '';
    public string $car_year = '';
    public string $car_mileage = '';
    public string $car_condition = '';

    // Step 3 - Offer Details
    public string $expected_price = '';
    public string $additional_notes = '';

    protected function rulesForStep(): array
    {
        return match ($this->step) {
            1 => [
                'name'  => 'required|min:2',
                'phone' => 'required|min:8',
            ],
            2 => [
                'car_make'     => 'required|min:2',
                'car_year'     => 'required|digits:4',
                'car_mileage'  => 'required',
                'car_condition'=> 'required',
            ],
            3 => [
                'expected_price' => 'required',
            ],
            default => [],
        };
    }

    public function nextStep(): void
    {
        $this->validate($this->rulesForStep());

        if ($this->step < $this->totalSteps) {
            $this->step++;
        }
    }

    public function prevStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function submit(): void
    {
        $this->validate($this->rulesForStep());

        // Save to database using existing columns
        SellInquiry::create([
            'name'         => $this->name,
            'phone'        => $this->phone,
            'car_make'     => $this->car_make,
            'car_model'    => '',
            'year'         => (int) $this->car_year,
            'mileage'      => (int) str_replace(['.', ','], '', $this->car_mileage),
            'condition'    => $this->car_condition,
            'asking_price' => $this->expected_price,
            'notes'        => $this->additional_notes ?: null,
            'status'       => 'new',
        ]);

        // Build WhatsApp message
        $waNumber = Setting::getValue('wa_number', '6287776700009');
        $message  = "Halo Kerinci Motor, saya ingin menjual kendaraan saya:\n\n";
        $message .= "📋 *DATA PENJUAL*\n";
        $message .= "Nama: {$this->name}\n";
        $message .= "No. HP: {$this->phone}\n\n";
        $message .= "🚗 *DATA KENDARAAN*\n";
        $message .= "Merek/Model: {$this->car_make}\n";
        $message .= "Tahun: {$this->car_year}\n";
        $message .= "Kilometer: {$this->car_mileage} KM\n";
        $message .= "Kondisi: {$this->car_condition}\n\n";
        $message .= "💰 *PENAWARAN*\n";
        $message .= "Harga yang Diinginkan: Rp {$this->expected_price}\n";

        if ($this->additional_notes) {
            $message .= "\n📝 Catatan: {$this->additional_notes}\n";
        }

        $waUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode($message);

        $this->redirect($waUrl, navigate: false);
    }

    public function render()
    {
        return view('livewire.sell-your-car-form');
    }
}
