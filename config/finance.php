
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Truncgil Finance API URL
    |--------------------------------------------------------------------------
    */
    'api_url' => env('FINANCE_API_URL', 'https://finance.truncgil.com/api/today.json'),

    /*
    |--------------------------------------------------------------------------
    | Cache Duration
    |--------------------------------------------------------------------------
    | Verilerin önbellekte tutulma süresi (saniye)
    */
    'cache_duration' => env('FINANCE_CACHE_DURATION', 300),

    /*
    |--------------------------------------------------------------------------
    | Cache Key
    |--------------------------------------------------------------------------
    | Önbellekte kullanılacak anahtar
    */
    'cache_key' => env('FINANCE_CACHE_KEY', 'truncgil.finance'),

    /*
    |--------------------------------------------------------------------------
    | Timeout
    |--------------------------------------------------------------------------
    | API istekleri için zaman aşımı süresi (saniye)
    */
    'timeout' => env('FINANCE_TIMEOUT', 30),

    /*
    |--------------------------------------------------------------------------
    | Error Handling
    |--------------------------------------------------------------------------
    | API hatalarında nasıl davranılacağı
    */
    'throw_exceptions' => env('FINANCE_THROW_EXCEPTIONS', true),
];