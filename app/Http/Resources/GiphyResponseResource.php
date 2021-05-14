<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GiphyResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


        return [
            "id"=>$this->resource["id"],
            "title"=>$this->resource["title"],
            "short_url"=>$this->resource["url"],

            "media"=>[
                "thumbnail_url"=>$this->resource["images"]["original_still"]["url"],
                "image_url"=>$this->resource["images"]["original"]["url"],
                "height"=>$this->resource["images"]["original"]["height"],
                "width"=>$this->resource["images"]["original"]["width"],
            ],

        ];
    }

}
