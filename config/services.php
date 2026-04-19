<?php

return [

    'groq' => [
        'key'   => env('GROQ_API_KEY', ''),
        'model' => env('GROQ_MODEL', 'llama3-8b-8192'),
    ],

    'meta' => [
        'access_token' => env('META_ACCESS_TOKEN', ''),
        'ig_user_id'   => env('META_IG_USER_ID', ''),
        'fb_page_id'   => env('META_FB_PAGE_ID', ''),
    ],

    'meta_pixel' => [
        'id' => env('META_PIXEL_ID', ''),
    ],

    'openclaw' => [
        'token' => env('OPENCLAW_API_TOKEN'),
    ],

];