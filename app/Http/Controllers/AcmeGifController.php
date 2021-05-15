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


        if (request()->wantsJson()) {

            return  $giphy->trending(request()->query);
        }
        return Inertia::render("Giphy", ["giphy" =>  $giphy->trending()]);
    }
    public function giphySearch()
    {
        $giphy = new Giphy();


        if (request()->wantsJson()) {

            return  $giphy->search(request()->query);
        }
        return Inertia::render("Giphy", ["giphy" =>  $giphy->trending()]);
    }
    public function tenor()
    {
        $tenor = new Tenor();

        if (request()->wantsJson()) {

            return  $tenor->trending(request()->query);
        }
        return Inertia::render("Tenor", ["tenor" => $tenor->trending()]);
    }
    public function tenorSearch()
    {
        $tenor = new Tenor();

        if (request()->wantsJson()) {

            return  $tenor->search(request()->query);
        }
        return Inertia::render("Tenor", ["tenor" => $tenor->trending()]);
    }
}
