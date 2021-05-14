<?php
namespace App\Services;

use Psr\Http\Message\MessageInterface;

interface IGIF{


    function trending()  ;
    function autoComplete();
    function search();



    function getData() ;
}
