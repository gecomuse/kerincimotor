<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key'   => 'wa_number',
                'label' => 'WhatsApp Business Number',
                'value' => '6287776700009',
                'type'  => 'text',
            ],
            [
                'key'   => 'hero_tagline',
                'label' => 'Hero Section Tagline',
                'value' => 'Fully Inspected Cars at the Best Price',
                'type'  => 'text',
            ],
            [
                'key'   => 'hero_subtagline',
                'label' => 'Hero Sub-tagline',
                'value' => 'Quality used cars, rigorous inspection, and honest mileage.',
                'type'  => 'text',
            ],
            [
                'key'   => 'address',
                'label' => 'Showroom Address',
                'value' => 'Bekasi, Jawa Barat, Indonesia',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'operating_hours',
                'label' => 'Operating Hours',
                'value' => 'Every Day, 08:00 – 20:00 WIB',
                'type'  => 'text',
            ],
            [
                'key'   => 'google_maps_url',
                'label' => 'Google Maps URL',
                'value' => 'https://share.google/m3cM30hHhvpWeGb5U',
                'type'  => 'text',
            ],
            [
                'key'   => 'google_maps_embed',
                'label' => 'Google Maps Embed URL',
                'value' => 'https://maps.google.com/maps?q=Kerinci+Motor+Bekasi&output=embed',
                'type'  => 'text',
            ],
            [
                'key'   => 'instagram_handle',
                'label' => 'Instagram Handle',
                'value' => '@kerincimotor',
                'type'  => 'text',
            ],
            [
                'key'   => 'meta_title',
                'label' => 'Default Meta Title',
                'value' => 'Kerinci Motor — Trusted Used-Car Showroom in Bekasi',
                'type'  => 'text',
            ],
            [
                'key'   => 'meta_description',
                'label' => 'Default Meta Description',
                'value' => 'Buy quality used cars at Kerinci Motor Bekasi. Transparent pricing, honest mileage, rigorous inspection. Contact us on WhatsApp now.',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'ga4_measurement_id',
                'label' => 'Google Analytics 4 Measurement ID',
                'value' => '',
                'type'  => 'text',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
