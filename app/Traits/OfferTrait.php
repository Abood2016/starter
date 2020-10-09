<?php

namespace App\Traits;


 trait OfferTrait
 {

    protected function saveImages($photo, $folder)
    {
        //save image in folder  written by abed
        $file_extension = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);

        return $file_name;
    }
     
 }

