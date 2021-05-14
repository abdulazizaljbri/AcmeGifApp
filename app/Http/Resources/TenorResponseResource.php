<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TenorResponseResource extends JsonResource
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
            "title"=>$this->resource["title"]??"",
            "short_url"=>$this->resource["url"],

            "media"=>[
                "thumbnail_url"=>$this->resource["media"][0]["mediumgif"]["preview"],
                "image_url"=>$this->resource["media"][0]["mediumgif"]["url"],
                "height"=>$this->resource["media"][0]["mediumgif"]["dims"][0],
                "width"=>$this->resource["media"][0]["mediumgif"]["dims"][1],
            ],

        ];
    }
}
