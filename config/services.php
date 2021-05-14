<?php
$GIFLimit = 9;

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],


    "gif" => [
        "giphy" => [
            "url" => env('GIPHY_URL', "https://api.giphy.com/v1/gifs/"),
            "options"=>[
                "api_key" => env('GIPHY_KEY', "IQK4SYDXXA5ol5Is0z3KtSFKpvEBVGwO"),
                "limit" =>  $GIFLimit,
                "lang" => "en",
                "offset" => 0
            ]



        ],
        "tenor" => [
            "url" => env('TENOR_URL', "https://g.tenor.com/v1/"),
            "options"=>[
                "key" => env('TENOR_KEY', "GEFRHHMG93B1"),
                "limit" =>  $GIFLimit,

                "locale" => "en_US",
                "contentfilter" => "medium",
                "mediafilter" => "minimal",
                "pos" => ""
            ]


        ],
    ],

];
