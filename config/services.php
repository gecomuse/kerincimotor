<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Groq AI — Caption Generation
    |--------------------------------------------------------------------------
    | Set GROQ_API_KEY in .env
    | Get key at: https://console.groq.com
    */
    'groq' => [
        'key'   => env('GROQ_API_KEY', ''),
        'model' => env('GROQ_MODEL', 'llama3-8b-8192'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Meta Graph API — Instagram & Facebook Publishing
    |--------------------------------------------------------------------------
    | Set META_* values in .env
    | Docs: https://developers.facebook.com/docs/instagram-api
    */
    'meta' => [
        'access_token' => env('META_ACCESS_TOKEN', ''),
        'ig_user_id'   => env('META_IG_USER_ID', ''),
        'fb_page_id'   => env('META_FB_PAGE_ID', ''),
    ],

];
