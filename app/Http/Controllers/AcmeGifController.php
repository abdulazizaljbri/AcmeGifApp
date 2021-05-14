<?php

namespace App\Http\Controllers;

use App\Services\Giphy;
use App\Services\Tenor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AcmeGifController extends Controller
{
    public function index()
    {

        $giphy = new Giphy();
        $giphyData = $giphy->trending(["limit" => 3]);
        $tenor = new Tenor();
        $tenorData = $tenor->trending(["limit" => 3]);



        return Inertia::render("Index", ["giphy" => $giphyData, "tenor" => $tenorData]);
    }

    public function giphy()
    {
        $giphy = new Giphy();
        $giphyData = $giphy->trending();
        return Inertia::render("Index", ["giphy" => $giphyData]);
    }
    public function tenor()
    {
        $tenor = new Tenor();
        $tenorData = $tenor->trending();
         
        return Inertia::render("Index", ["tenor" => $tenorData]);
    }
}
