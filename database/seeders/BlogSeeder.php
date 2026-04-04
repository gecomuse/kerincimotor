<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Skip if already seeded
        if (Post::count() > 0) {
            $this->command->info('BlogSeeder: posts already exist, skipping.');
            return;
        }

        $placeholder = '<p>Artikel ini sedang dalam proses penulisan. Silakan edit melalui dashboard admin di <a href="/admin">kerincimotor.com/admin</a>.</p>';

        // ── Posts ──────────────────────────────────────────────────────────────
        $posts = [
            [
                'title'            => '7 Hal Wajib Dicek Sebelum Beli Mobil Bekas Pertama Kamu',
                'category'         => 'Panduan',
                'read_time'        => 8,
                'excerpt'          => 'Jangan sampai menyesal! Dari cek nomor rangka, kondisi mesin, bodi, hingga kelengkapan dokumen — panduan lengkap agar kamu tidak tertipu unit bermasalah.',
                'meta_title'       => '7 Tips Cek Mobil Bekas Sebelum Beli | Kerinci Motor',
                'meta_description' => 'Panduan lengkap 7 hal wajib dicek sebelum membeli mobil bekas pertama kamu. Dari nomor rangka, mesin, bodi, hingga dokumen.',
                'meta_keywords'    => 'tips beli mobil bekas, cek mobil bekas, mobil bekas pertama',
            ],
            [
                'title'            => 'Harga Honda Jazz Bekas 2024: Dari GE8 Hingga GK5',
                'category'         => 'Harga Pasar',
                'read_time'        => 5,
                'excerpt'          => 'Update harga pasar Honda Jazz bekas per tahun ini. Generasi mana yang paling worth it untuk dibeli sekarang?',
                'meta_title'       => 'Harga Honda Jazz Bekas 2024 Semua Generasi | Kerinci Motor',
                'meta_description' => 'Daftar harga Honda Jazz bekas 2024: GE8, GE6, GK5. Update harga pasar terkini dan tips memilih generasi terbaik.',
                'meta_keywords'    => 'harga honda jazz bekas, honda jazz bekas 2024, jazz GK5 bekas',
            ],
            [
                'title'            => 'Avanza vs Xenia Bekas: Mana yang Lebih Worth It di 2024?',
                'category'         => 'Perbandingan',
                'read_time'        => 6,
                'excerpt'          => 'Dua MPV sejuta umat ini selalu bersaing ketat. Kami bedah dari segi harga, ketersediaan suku cadang, dan biaya perawatan jangka panjang.',
                'meta_title'       => 'Avanza vs Xenia Bekas 2024: Perbandingan Lengkap | Kerinci Motor',
                'meta_description' => 'Perbandingan Toyota Avanza vs Daihatsu Xenia bekas: harga, suku cadang, biaya servis, dan mana yang lebih recommended.',
                'meta_keywords'    => 'avanza vs xenia bekas, perbandingan avanza xenia, mpv bekas terbaik',
            ],
            [
                'title'            => 'Cara Kredit Mobil Bekas 2024: Syarat, DP, dan Tips Lolos ACC',
                'category'         => 'Kredit & DP',
                'read_time'        => 7,
                'excerpt'          => 'Panduan lengkap pengajuan kredit mobil bekas — mulai syarat dokumen, simulasi cicilan, hingga tips agar pengajuan tidak ditolak leasing.',
                'meta_title'       => 'Cara Kredit Mobil Bekas 2024: Syarat & Tips ACC | Kerinci Motor',
                'meta_description' => 'Panduan kredit mobil bekas 2024: syarat dokumen, DP minimal, simulasi cicilan, dan tips agar pengajuan leasing disetujui.',
                'meta_keywords'    => 'kredit mobil bekas, dp mobil bekas, cicilan mobil bekas, leasing mobil bekas',
            ],
            [
                'title'            => '5 Mobil Bekas Terbaik di Bawah 100 Juta Tahun 2024',
                'category'         => 'Rekomendasi',
                'read_time'        => 5,
                'excerpt'          => 'Budget 100 juta masih bisa dapat mobil kondisi bagus dan legal. Inilah 5 pilihan terbaik berdasarkan data harga pasar dan keandalan mesin.',
                'meta_title'       => '5 Rekomendasi Mobil Bekas di Bawah 100 Juta 2024 | Kerinci Motor',
                'meta_description' => 'Rekomendasi 5 mobil bekas terbaik harga di bawah 100 juta. Unit berkualitas dengan kondisi terawat dan dokumen lengkap.',
                'meta_keywords'    => 'mobil bekas 100 juta, mobil bekas murah bekasi, rekomendasi mobil bekas',
            ],
        ];

        foreach ($posts as $i => $data) {
            Post::create(array_merge($data, [
                'slug'         => Str::slug($data['title']),
                'content'      => $placeholder,
                'is_published' => true,
                'published_at' => now()->subDays(count($posts) - $i),
            ]));
        }

        // Skip FAQs if already seeded
        if (Faq::count() > 0) {
            $this->command->info('BlogSeeder: FAQs already exist, skipping.');
            return;
        }

        // ── FAQs ──────────────────────────────────────────────────────────────
        $faqs = [
            [
                'question'   => 'Bagaimana cara membeli mobil di Kerinci Motor?',
                'answer'     => 'Cukup hubungi kami via WhatsApp atau kunjungi showroom langsung. Tim kami akan membantu Anda memilih unit yang sesuai kebutuhan dan budget. Proses pembelian cepat, dokumen lengkap.',
                'sort_order' => 1,
            ],
            [
                'question'   => 'Bagaimana cara mengecek kondisi unit sebelum beli?',
                'answer'     => 'Setiap unit di Kerinci Motor sudah melalui inspeksi 150+ poin. Anda tetap bisa melakukan test drive dan pemeriksaan mandiri. Kami juga menyediakan riwayat servis kendaraan jika tersedia.',
                'sort_order' => 2,
            ],
            [
                'question'   => 'Merek apa saja yang tersedia di Kerinci Motor?',
                'answer'     => 'Kami menyediakan berbagai merek populer: Toyota, Honda, Daihatsu, Suzuki, Mitsubishi, Nissan, dan lainnya. Stok kami diperbarui secara rutin — cek katalog online kami untuk unit terbaru.',
                'sort_order' => 3,
            ],
            [
                'question'   => 'Apakah tersedia fasilitas kredit atau cicilan?',
                'answer'     => 'Ya, kami bekerja sama dengan beberapa lembaga pembiayaan terpercaya. DP mulai dari 20% dengan tenor hingga 5 tahun. Hubungi kami untuk simulasi cicilan sesuai kemampuan Anda.',
                'sort_order' => 4,
            ],
            [
                'question'   => 'Di mana lokasi showroom Kerinci Motor?',
                'answer'     => 'Showroom kami berlokasi di Jl. Mustika Jaya RT.006/RW.012, Mustikajaya, Kota Bekasi, Jawa Barat. Buka setiap hari pukul 08:00–20:00 WIB. Lihat peta di bagian bawah halaman utama.',
                'sort_order' => 5,
            ],
            [
                'question'   => 'Apakah bisa tukar tambah (trade-in)?',
                'answer'     => 'Tentu bisa! Bawa kendaraan lama Anda ke showroom untuk evaluasi kondisi dan harga. Tim kami akan memberikan penawaran harga terbaik dan menghitung selisih dengan unit pilihan Anda.',
                'sort_order' => 6,
            ],
            [
                'question'   => 'Apa saja yang perlu saya cek saat membeli mobil bekas?',
                'answer'     => 'Hal-hal penting: (1) Cek nomor rangka & mesin sesuai STNK/BPKB, (2) Periksa kondisi bodi dari karat dan bekas tabrakan, (3) Test drive minimal 15 menit, (4) Cek kelengkapan dokumen, (5) Verifikasi status pajak kendaraan.',
                'sort_order' => 7,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
