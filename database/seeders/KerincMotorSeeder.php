<?php

namespace Database\Seeders;

use App\Models\HeroSetting;
use App\Models\Video;
use Illuminate\Database\Seeder;

class KerincMotorSeeder extends Seeder
{
    public function run(): void
    {
        // Videos
        $videos = [
            [
                'title'       => 'Review Unit Honda Brio Satya E CVT 2022',
                'youtube_id'  => '-A3QvyQ9sP8',
                'price_label' => '175',
                'description' => 'Cek lengkap eksterior, interior, mesin, dan test drive. Unit mulus, km rendah.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Review Unit Toyota Avanza Veloz 2021',
                'youtube_id'  => 's9KAaHeKOu8',
                'price_label' => '220',
                'description' => 'Review jujur kondisi unit. Eksterior, interior, mesin, dan test drive di showroom.',
                'is_featured' => false,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
        ];

        foreach ($videos as $v) {
            Video::firstOrCreate(['youtube_id' => $v['youtube_id']], $v);
        }

        // Hero Setting
        HeroSetting::firstOrCreate(
            ['is_active' => true],
            [
                'image_url'  => null,
                'card_name'  => 'Honda Brio Satya E CVT',
                'card_sub'   => '2022 · Automatic · 18.500 KM',
                'card_price' => '175',
                'is_active'  => true,
            ]
        );
    }
}
