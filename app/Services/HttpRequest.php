<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class HttpRequest
{


    public  static function get($url)
    {
        $http =Http::get( $url);

        return $http->collect();
    }
}
