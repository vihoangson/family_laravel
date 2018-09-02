<?php

namespace App\Traits;

use App\Libraries\CloudinaryLib;
use Illuminate\Support\Facades\Log;

trait Cloudinary_trait
{
    public function CloudinaryUploadImg($path)
    {
        return CloudinaryLib::uploadImg($path,'img_family');
    }
}
