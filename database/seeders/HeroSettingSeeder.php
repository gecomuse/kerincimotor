<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\HeroSetting::updateOrCreate(
            ['id' => 1],
            [
                'image_url'   => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1400&auto=format&fit=crop',
                'card_name'   => 'Unit Featured',
                'card_sub'    => 'Pilih unit di Admin → Hero Banner',
                'card_price'  => 'Hubungi Kami',
                'is_active'   => true,
                'car_id'      => null,
            ]
        );
    }
}
