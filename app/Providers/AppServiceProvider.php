<?php

namespace App\Providers;

use App\Services\FormatGifUrl;
use App\Services\Giphy;
use App\Services\HttpRequest;
use App\Services\IFormatGifUrl;
use App\Services\IHttpRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Container\Container;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
 


    }
}
