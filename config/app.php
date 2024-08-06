<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

    'url' => env('APP_URL', 'http://localhost/CPESD-MIS'),
    'asset_url' => env('ASSET_URL', 'http://localhost/CPESD-MIS/public'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    '_database' =>[
        'users'         => 'mysql_USERS',
        'lls_whip'      => 'mysql_LLS',
        'dts'           => 'mysql_DTS'
    ],

    '_systems' => [
        ['pmas','PMAS'],
        ['rfa','RFA'],
        ['watchlisted','Watchlisted'],
        ['dts','Document Tracking System'],
        ['lls','Labor Localization'],
        ['whip','WHIP']
    ],

    'level_of_employment' => [
        ['rank_and_file','Rank And File'],
        ['managerial','Managerial'],
        ['proprietor','Proprietor/Owner'],
    ],

    'lls_nature_of_employment' => [
        ['permanent','Permanent'],
        ['probationary','Probationary'],
        ['contractuals','Contractuals'],
        ['project_based','Project Based'],
        ['seasonal','Seasonal'],
        ['job_order','Job order'],
        ['mgt','Mgt'],        
    ],


    'lls_nature_of_employment2' => array(
        'permanent' => 'Permanent',
        'probationary' =>'Probationary',
        'contractuals' =>'Contractuals',
        'project_based' =>'Project Based',
        'seasonal' =>'Seasonal',
        'job_order' =>'Job order',
        'mgt' =>'Mgt',        
    ),

    'whip_nature_of_employment' => [
        ['skilled','Skilled'],
        ['unskilled','Unskilled'],
    ],
    

    'default_city' => '1004209000-City of Oroquieta',


    'barangay' => [
        "Apil",
        "Binuangan",
        "Bolibol",
        "Buenavista",
        "Bunga",
        "Buntawan",
        "Burgos",
        "Canubay",
        "Clarin Settlement",
        "Dolipos Bajo",
        "Dolipos Alto",
        "Dulapo",
        "Dullan Norte",
        "Dullan Sur",
        "Lower Lamac",
        "Layawan",
        "Lower Langcangan",
        "Lower Loboc",
        "Lower Rizal",
        "Malindang",
        "Mialen",
        "Mobod",
        "Ciriaco Pastrano",
        "Paypayan",
        "Pines",
        "Poblacion 1",
        "Poblacion 2",
        "Proper Langcangan",
        "San Vicente Alto",
        "San Vicente Bajo",
        "Sebucal",
        "Senote",
        "Taboc Norte",
        "Taboc Sur",
        "Talairon",
        "Talic",
        "Toliyok",
        "Tipan",
        "Transville",
        "Tuyabang Alto",
        "Tuyabang Bajo",
        "Tuyabang Proper",
        "Upper Langcangan",
        "Upper Lamac",
        "Upper Loboc",
        "Upper Rizal",
        "Victoria",
        "Villaflor" 
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
