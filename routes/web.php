<?php


use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::group(['middleware' =>  ['auth:sanctum']], function () {

    Route::get('/',"AcmeGifController@index")->name("dashboard");
    Route::get('/giphy',"AcmeGifController@giphy")->name("giphy");
    Route::get('/tenor',"AcmeGifController@tenor")->name("tenor");


});
