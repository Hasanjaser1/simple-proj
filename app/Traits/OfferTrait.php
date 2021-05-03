<?php

namespace App\Traits;


Trait OfferTrait
{
    protected function saveImage($photo ,$folder){
        //save image
        $file_extension = $photo ->getClientOriginalExtension();
        $file_name=time().'.'.$file_extension;
        $path=$folder;
        $photo -> move($path,$file_name);
        return $file_name;
   }
}