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
        // ── Posts ──────────────────────────────────────────────────────────────
        $posts = [
            [
                'title'        => 'Cara Membeli Mobil Bekas yang Aman dan Tidak Tertipu',
                'category'     => 'Panduan',
                'excerpt'      => 'Membeli mobil bekas bisa jadi keputusan cerdas jika Anda tahu caranya. Simak panduan lengkap kami agar tidak terjebak membeli mobil bermasalah.',
                'content'      => '<h2>Mengapa Membeli Mobil Bekas?</h2><p>Mobil bekas menawarkan nilai yang jauh lebih baik dibandingkan mobil baru. Penyusutan nilai terbesar terjadi pada 1-2 tahun pertama, sehingga dengan membeli mobil bekas berusia 2-3 tahun, Anda bisa mendapatkan kendaraan berkualitas dengan harga yang jauh lebih terjangkau.</p><h2>Langkah-Langkah Pembelian yang Aman</h2><p>Berikut adalah checklist yang perlu Anda lakukan sebelum memutuskan membeli:</p><ul><li>Cek riwayat servis kendaraan</li><li>Periksa fisik body dan interior secara teliti</li><li>Lakukan test drive minimal 15 menit</li><li>Cek kelengkapan dan keaslian dokumen (STNK, BPKB)</li><li>Verifikasi nomor rangka dan nomor mesin</li></ul><h2>Tanda-Tanda Mobil Bermasalah</h2><p>Waspadai tanda-tanda berikut: cat body yang tidak merata (indikasi bekas tabrakan), odometer yang tidak sesuai kondisi mesin, dokumen yang tidak lengkap atau terlihat palsu, dan harga yang jauh di bawah pasaran tanpa alasan jelas.</p><h2>Beli di Dealer Terpercaya</h2><p>Membeli di dealer resmi seperti Kerinci Motor memberikan ketenangan pikiran. Setiap unit telah melalui inspeksi menyeluruh dan dilengkapi dengan garansi purna jual.</p>',
                'read_time'    => 6,
                'is_published' => true,
                'published_at' => now()->subDays(30),
            ],
            [
                'title'        => '5 Tips Merawat Mobil Bekas agar Tetap Prima',
                'category'     => 'Perawatan',
                'excerpt'      => 'Merawat mobil bekas tidak harus mahal. Dengan perawatan rutin yang tepat, mobil Anda bisa tetap handal dan tahan lama.',
                'content'      => '<h2>Rutin Ganti Oli Mesin</h2><p>Penggantian oli mesin secara rutin adalah fondasi perawatan mobil yang baik. Untuk mobil harian, ganti oli setiap 5.000–7.500 km atau setiap 6 bulan sekali, mana yang lebih dulu tercapai.</p><h2>Periksa Tekanan Ban Secara Berkala</h2><p>Tekanan ban yang tidak sesuai mempengaruhi keamanan berkendara, konsumsi bahan bakar, dan usia pakai ban. Periksa setiap 2 minggu sekali dalam kondisi ban dingin.</p><h2>Jaga Kebersihan Filter Udara</h2><p>Filter udara yang kotor membuat mesin bekerja lebih keras dan meningkatkan konsumsi BBM. Bersihkan setiap 10.000 km dan ganti setiap 20.000 km.</p><h2>Perhatikan Kondisi Aki</h2><p>Aki mobil umumnya berumur 2-3 tahun. Jika mesin sulit dihidupkan di pagi hari, segera cek kondisi aki Anda ke bengkel terdekat.</p><h2>Servis Berkala di Bengkel Terpercaya</h2><p>Jangan skip jadwal servis berkala. Selain menjaga performa, servis rutin juga membantu mendeteksi masalah sebelum berkembang menjadi kerusakan serius yang mahal.</p>',
                'read_time'    => 5,
                'is_published' => true,
                'published_at' => now()->subDays(20),
            ],
            [
                'title'        => 'Toyota Avanza vs Honda Mobilio: Mana yang Lebih Worth It?',
                'category'     => 'Tips',
                'excerpt'      => 'Dua MPV terlaris di Indonesia. Kami bandingkan performa, kenyamanan, dan nilai investasi Toyota Avanza dan Honda Mobilio bekas.',
                'content'      => '<h2>Toyota Avanza</h2><p>Avanza adalah raja MPV Indonesia dengan jaringan bengkel terluas dan spare part yang mudah ditemukan di seluruh pelosok negeri. Keunggulan utamanya adalah kemudahan servis dan biaya perawatan yang terjangkau.</p><h2>Honda Mobilio</h2><p>Mobilio hadir dengan desain yang lebih modern dan kabin yang terasa lebih lega. Konsumsi BBM-nya juga sedikit lebih efisien berkat mesin VTEC-nya.</p><h2>Perbandingan Harga Bekas</h2><p>Avanza keluaran 2018 berkisar Rp 155–175 juta, sementara Mobilio tahun yang sama di kisaran Rp 145–165 juta. Selisihnya tidak terlalu jauh namun Avanza cenderung lebih stabil nilai jualnya.</p><h2>Kesimpulan</h2><p>Jika Anda sering bepergian jauh ke daerah yang bengkelnya terbatas, Avanza adalah pilihan lebih aman. Jika mengutamakan kenyamanan kabin dan efisiensi BBM untuk perkotaan, Mobilio layak dipertimbangkan.</p>',
                'read_time'    => 7,
                'is_published' => true,
                'published_at' => now()->subDays(15),
            ],
            [
                'title'        => 'Kapan Waktu Terbaik Menjual Mobil Bekas Anda?',
                'category'     => 'Tips',
                'excerpt'      => 'Timing adalah segalanya dalam jual beli mobil. Ketahui kapan harga mobil bekas Anda sedang di puncaknya agar bisa mendapatkan penawaran terbaik.',
                'content'      => '<h2>Pengaruh Musim terhadap Harga Mobil</h2><p>Harga mobil bekas cenderung naik menjelang hari raya, tahun ajaran baru, dan akhir tahun. Ini adalah saat-saat permintaan meningkat dan pembeli lebih bersedia membayar harga premium.</p><h2>Umur dan Kilometer Ideal untuk Dijual</h2><p>Jual sebelum mobil memasuki tahun ke-5 atau kilometer ke-80.000. Setelah batas ini, nilai jual mulai turun lebih drastis karena pembeli mulai mengkhawatirkan biaya perawatan.</p><h2>Perhatikan Kompetitor di Pasaran</h2><p>Sebelum memasang harga, survei pasar terlebih dahulu. Cek platform jual beli online dan bandingkan dengan kondisi mobil Anda untuk menentukan harga yang kompetitif.</p><h2>Jual ke Dealer untuk Proses Cepat</h2><p>Menjual ke dealer seperti Kerinci Motor menawarkan proses yang cepat dan bebas repot. Anda akan mendapatkan penawaran langsung hari itu juga tanpa perlu menunggu pembeli yang tepat.</p>',
                'read_time'    => 4,
                'is_published' => true,
                'published_at' => now()->subDays(8),
            ],
            [
                'title'        => 'Dokumen Wajib yang Harus Dicek Sebelum Beli Mobil Bekas',
                'category'     => 'Panduan',
                'excerpt'      => 'Jangan biarkan dokumen yang bermasalah menjadi mimpi buruk setelah transaksi. Ini daftar lengkap dokumen yang wajib Anda verifikasi.',
                'content'      => '<h2>STNK (Surat Tanda Nomor Kendaraan)</h2><p>Pastikan data di STNK sesuai dengan kondisi fisik kendaraan: nama pemilik, nomor polisi, nomor rangka, dan nomor mesin. STNK yang sudah mati pajak lebih dari 1 tahun bisa menjadi masalah saat balik nama.</p><h2>BPKB (Buku Pemilik Kendaraan Bermotor)</h2><p>BPKB adalah dokumen kepemilikan yang paling penting. Periksa keasliannya — BPKB palsu memiliki kertas yang berbeda dan nomor seri yang tidak terdaftar di Samsat.</p><h2>Faktur Pembelian</h2><p>Faktur asli dari dealer pertama sangat berguna untuk memverifikasi riwayat kendaraan. Tidak semua transaksi bekas dilengkapi faktur, namun keberadaannya meningkatkan kepercayaan.</p><h2>Kir (Jika Diperlukan)</h2><p>Untuk kendaraan niaga, pastikan buku kir masih berlaku. Kir yang mati bisa menjadi masalah hukum saat kendaraan beroperasi.</h2><h2>Tips Verifikasi Cepat</h2><p>Anda bisa mengecek keabsahan nomor rangka dan nomor mesin melalui aplikasi STNK Online milik Samsat atau mengunjungi kantor Samsat terdekat secara langsung.</p>',
                'read_time'    => 5,
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
        ];

        foreach ($posts as $post) {
            Post::create(array_merge($post, [
                'slug' => Str::slug($post['title']),
            ]));
        }

        // ── FAQs ──────────────────────────────────────────────────────────────
        $faqs = [
            [
                'question'   => 'Apakah semua mobil di Kerinci Motor sudah melalui inspeksi?',
                'answer'     => 'Ya, setiap kendaraan yang kami jual wajib melewati proses inspeksi menyeluruh yang mencakup pemeriksaan mesin, transmisi, kaki-kaki, eksterior, interior, dan kelengkapan dokumen. Kami tidak menjual kendaraan yang tidak lolos standar kualitas kami.',
                'sort_order' => 1,
            ],
            [
                'question'   => 'Apakah ada garansi untuk mobil bekas yang dibeli?',
                'answer'     => 'Kami memberikan jaminan kepuasan pelanggan. Jika dalam 7 hari setelah pembelian ditemukan masalah yang tidak diinformasikan sebelumnya, kami siap menanganinya. Hubungi kami langsung untuk detail kebijakan garansi.',
                'sort_order' => 2,
            ],
            [
                'question'   => 'Bagaimana cara menjual mobil saya ke Kerinci Motor?',
                'answer'     => 'Sangat mudah! Isi formulir "Jual Mobil Anda" di halaman utama kami, atau hubungi kami via WhatsApp. Tim kami akan melakukan penilaian dan memberikan penawaran harga terbaik dalam waktu 24 jam.',
                'sort_order' => 3,
            ],
            [
                'question'   => 'Apakah tersedia fasilitas tukar tambah (trade-in)?',
                'answer'     => 'Ya, kami melayani tukar tambah. Bawa kendaraan lama Anda ke showroom kami untuk dievaluasi, dan kami akan menghitung selisih harga dengan kendaraan pilihan Anda. Prosesnya cepat dan transparan.',
                'sort_order' => 4,
            ],
            [
                'question'   => 'Apakah bisa kredit/cicilan?',
                'answer'     => 'Kami bekerja sama dengan beberapa lembaga pembiayaan terpercaya. Uang muka (DP) dimulai dari 20% dengan tenor hingga 5 tahun. Hubungi kami untuk simulasi cicilan sesuai kemampuan Anda.',
                'sort_order' => 5,
            ],
            [
                'question'   => 'Berapa lama proses balik nama kendaraan?',
                'answer'     => 'Proses balik nama umumnya memakan waktu 14–30 hari kerja tergantung wilayah dan kelengkapan dokumen. Kami dapat membantu mengurus proses balik nama sebagai layanan tambahan.',
                'sort_order' => 6,
            ],
            [
                'question'   => 'Di mana lokasi showroom Kerinci Motor?',
                'answer'     => 'Showroom kami berlokasi di Kerinci, Jambi. Detail alamat lengkap dan peta lokasi tersedia di bagian bawah halaman utama website kami, atau Anda bisa menghubungi kami via WhatsApp untuk panduan arah.',
                'sort_order' => 7,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
