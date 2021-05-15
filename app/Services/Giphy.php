<?php

namespace App\Services;

use App\Http\Resources\GIFResponseResource;

//use App\Http\Resources\GiphyResponseCollection;
use App\Http\Resources\GiphyResponseResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Giphy implements IGIF
{

    /**
     * @var IFormatGifUrl
     */
    private $formaGiftUrl;


    public function __construct()
    {


        $this->formaGiftUrl=new FormatGifUrl($this);
    }



    public   function trending($options = [])
    {


        $this->formaGiftUrl->bulidUrl("trending", $options);
        $giphy = $this->getData();

        $data = $giphy["data"];

 
        $data = array_map(fn ($value) => (new  GiphyResponseResource($value))->resolve(), $data);

        $next=$giphy["pagination"]["count"]+$giphy["pagination"]["offset"];
        $next=$next < $giphy["pagination"]["total_count"]?$next:null;

        return ["data" => $data, "next" => $next];


     


        $data=$this->getData()["data"];

        $data= array_map(fn($value)=>(new  GiphyResponseResource($value))->resolve()  ,$data);


      return  $data;
    }
    public  function search($options = [])
    {
        $this->formaGiftUrl->bulidUrl("search", $options);
        $data=$this->getData()["data"];

        $data= array_map(fn($value)=>(new  GiphyResponseResource($value))->resolve()  ,$data);




        return $data;
    }
    function autoComplete($options = [])
    {
        $this->formaGiftUrl->bulidUrl("search/tags", $options);
        $data=$this->getData()["data"];


        $data= array_map(fn($value)=>$value["name"],$data);




        return $data;
    }

    function getData()
    {

        $res= HttpRequest::get($this->formaGiftUrl->getUrl());


       return $res ;

    }


}
