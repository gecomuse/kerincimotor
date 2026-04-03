<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name'       => 'Budi Santoso',
                'location'   => 'Bekasi Timur',
                'content'    => 'Pelayanan sangat ramah dan profesional. Proses pembelian transparan, semua dokumen lengkap. Mobilnya sudah diinspeksi 150+ poin, kondisi memuaskan. Sangat recommended!',
                'rating'     => 5,
                'is_active'  => true,
                'sort_order' => 1,
            ],
            [
                'name'       => 'Siti Rahayu',
                'location'   => 'Bekasi Barat',
                'content'    => 'Cari mobil bekas yang terpercaya memang susah, tapi di Kerinci Motor beda. Kilometer jujur, harga sesuai kondisi. Tidak ada biaya tersembunyi sama sekali.',
                'rating'     => 5,
                'is_active'  => true,
                'sort_order' => 2,
            ],
            [
                'name'       => 'Ahmad Fauzi',
                'location'   => 'Tambun Selatan',
                'content'    => 'Sudah beli 2 unit di sini. Prosesnya cepat, staff sabar menjelaskan kondisi unit. Test drive bebas, tidak ada tekanan. Pasti balik lagi kalau butuh mobil!',
                'rating'     => 5,
                'is_active'  => true,
                'sort_order' => 3,
            ],
            [
                'name'       => 'Dewi Lestari',
                'location'   => 'Cibitung',
                'content'    => 'Awalnya ragu beli mobil bekas, tapi after lihat dokumentasi inspeksi yang lengkap jadi lebih yakin. Mobil sudah 6 bulan, tidak ada masalah sama sekali. Terima kasih Kerinci Motor!',
                'rating'     => 5,
                'is_active'  => true,
                'sort_order' => 4,
            ],
            [
                'name'       => 'Rudi Hermawan',
                'location'   => 'Cikarang',
                'content'    => 'Harga kompetitif, kondisi unit sesuai foto yang ditampilkan. WhatsApp direspon cepat. Dealer mobil bekas terbaik di Bekasi menurut saya.',
                'rating'     => 5,
                'is_active'  => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }
    }
}
