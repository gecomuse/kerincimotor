<?php

return [
    'meta' => [
        'defaults' => [
            'title'        => 'Kerinci Motor — Showroom Mobil Bekas Terpercaya di Bekasi',
            'titleBefore'  => false,
            'description'  => 'Beli mobil bekas berkualitas di Kerinci Motor Bekasi. Harga transparan, kilometer jujur, inspeksi ketat. Hubungi kami via WhatsApp sekarang.',
            'separator'    => ' — ',
            'keywords'     => ['mobil bekas', 'showroom mobil bekasi', 'jual beli mobil', 'kerinci motor'],
            'canonical'    => null,
            'robots'       => 'index,follow',
        ],
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
        ],
        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        'defaults' => [
            'title'       => 'Kerinci Motor — Showroom Mobil Bekas Terpercaya di Bekasi',
            'description' => 'Beli mobil bekas berkualitas di Kerinci Motor Bekasi.',
            'url'         => null,
            'type'        => 'website',
            'site_name'   => 'Kerinci Motor',
            'images'      => [],
        ],
    ],
    'twitter' => [
        'defaults' => [
            'card'        => 'summary_large_image',
            'site'        => '@kerincimotor',
        ],
    ],
    'json-ld' => [
        'defaults' => [
            'title'       => 'Kerinci Motor',
            'description' => 'Showroom Mobil Bekas Terpercaya di Bekasi',
            'url'         => null,
            'type'        => 'LocalBusiness',
            'images'      => [],
        ],
    ],
];
