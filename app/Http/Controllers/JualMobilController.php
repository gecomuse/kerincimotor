<?php

namespace App\Http\Controllers;

class JualMobilController extends Controller
{
    protected array $kota = [
        'jakarta' => [
            'nama'                 => 'Jakarta',
            'nama_lengkap'         => 'DKI Jakarta',
            'deskripsi_area'       => 'Kami melayani seluruh wilayah DKI Jakarta — Jakarta Timur, Jakarta Selatan, Jakarta Utara, Jakarta Barat, dan Jakarta Pusat.',
            'jarak_dari_showroom'  => 'Tim kami siap jemput ke lokasi Anda di Jakarta. Estimasi kedatangan 30–60 menit dari showroom kami di Bekasi.',
            'area_populer'         => 'Cakung, Pulogadung, Pasar Rebo, Tebet, Pancoran, Penjaringan, Tanjung Priok',
        ],
        'bogor' => [
            'nama'                 => 'Bogor',
            'nama_lengkap'         => 'Kota dan Kabupaten Bogor',
            'deskripsi_area'       => 'Kami melayani Kota dan Kabupaten Bogor termasuk Cibinong, Dramaga, Cileungsi, Gunung Putri, dan sekitarnya.',
            'jarak_dari_showroom'  => 'Tim kami siap jemput ke lokasi Anda di Bogor. Hubungi kami untuk konfirmasi jadwal.',
            'area_populer'         => 'Cibinong, Cileungsi, Gunung Putri, Dramaga, Bojong Gede, Citereup',
        ],
        'depok' => [
            'nama'                 => 'Depok',
            'nama_lengkap'         => 'Kota Depok',
            'deskripsi_area'       => 'Kami melayani seluruh wilayah Kota Depok termasuk Margonda, Cinere, Sawangan, Cilodong, dan sekitarnya.',
            'jarak_dari_showroom'  => 'Depok mudah dijangkau dari showroom kami di Mustikajaya, Bekasi. Tim kami siap datang ke lokasi Anda.',
            'area_populer'         => 'Margonda, Cinere, Sawangan, Cilodong, Sukmajaya, Beji, Pancoran Mas',
        ],
        'tangerang' => [
            'nama'                 => 'Tangerang',
            'nama_lengkap'         => 'Kota Tangerang dan Tangerang Selatan',
            'deskripsi_area'       => 'Kami melayani Kota Tangerang dan Tangerang Selatan termasuk Serpong, Bintaro, Ciledug, Alam Sutera, dan sekitarnya.',
            'jarak_dari_showroom'  => 'Tim kami melayani pickup ke seluruh area Tangerang dan Tangerang Selatan.',
            'area_populer'         => 'Serpong, Bintaro, Ciledug, Alam Sutera, Karawaci, Cikokol, BSD',
        ],
        'bekasi' => [
            'nama'                 => 'Bekasi',
            'nama_lengkap'         => 'Kota dan Kabupaten Bekasi',
            'deskripsi_area'       => 'Kami melayani seluruh wilayah Kota dan Kabupaten Bekasi termasuk Mustikajaya, Bekasi Timur, Bekasi Utara, Bekasi Selatan, dan Bekasi Barat.',
            'jarak_dari_showroom'  => 'Showroom kami berlokasi langsung di Mustikajaya, Bekasi Timur — kami adalah dealer terdekat untuk Anda.',
            'area_populer'         => 'Mustikajaya, Bekasi Timur, Bekasi Utara, Bekasi Selatan, Bekasi Barat, Jatiwarna, Pondok Gede',
        ],
    ];

    public function show(string $kota)
    {
        if (! array_key_exists($kota, $this->kota)) {
            abort(404);
        }

        return view('jual-mobil.show', [
            'kota' => $kota,
            'data' => $this->kota[$kota],
        ]);
    }
}
