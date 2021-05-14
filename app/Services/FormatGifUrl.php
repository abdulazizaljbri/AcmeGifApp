<?php

namespace App\Services;



class FormatGifUrl
{

    protected $base_url ;
    protected $url=null ;
    private $options;

    /**
     * @var  string
     */
    private $class_name="App\Services\Giphy";

    public function __construct(IGIF $gif)
    {

        $this->class_name=$gif;
        $this->setUrl();
        $this->setUrlOptions(config("services.gif." . $this->getClassName(). ".options"));
    }


    public function setUrl()
    {

        $this->base_url = $this->checkUrl(config("services.gif." .  $this->getClassName() . ".url"));
    }
    public function setUrlOptions($options)
    {
        $this->options =  $options;
    }
    public function bulidUrl($to = "trending", $options = [])
    {


        if (!empty($options)) {

            foreach ($options as $key => $value) {
                $this->options[$key] = $value;
            }
        }

        $this->url = $this->base_url . "{$to}?" . http_build_query($this->options);
    }


    public function checkUrl($url)
    {
        return  str_ends_with($url, '/') ? $url  : $url . "/";
    }


    public function getUrl()
    {

        return $this->url;
    }


    private function getClassName()
    {
 
         return  strtolower((new \ReflectionClass($this->class_name))->getShortName());
    }
}
