<?php

namespace App\Services;

use App\Http\Resources\TenorResponseResource;
use Illuminate\Support\Facades\Http;

class Tenor implements IGIF
{
    /**
     * @var IFormatGifUrl
     */
    private $formaGiftUrl;

    public function __construct()
    {

        $this->formaGiftUrl = new FormatGifUrl($this);
    }


    public   function trending($options = [])
    {

        $this->formaGiftUrl->bulidUrl("trending", $options);
        $tenor = $this->getData();

        $data = $tenor["results"];

        $data = array_map(fn ($value) => (new  TenorResponseResource($value))->resolve(), $data);




        return ["data" => $data, "next" => $tenor["next"]];
    }
    public  function search($options = [])
    {
        $this->formaGiftUrl->bulidUrl("search", $options);
        $data = $this->getData()["results"];

        $data = array_map(fn ($value) => (new  TenorResponseResource($value))->resolve(), $data);



        return $data;
    }

    function autoComplete($options = [])
    {
        $this->formaGiftUrl->bulidUrl("autocomplete", $options);


        $data = $this->getData()["results"];


        return  $data;
    }

    function getData()
    {
        $res = HttpRequest::get($this->formaGiftUrl->getUrl());


        return $res;
    }
}
