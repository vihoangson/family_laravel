<?php

namespace App\Traits;

use App\Libraries\CloudinaryLib;
use Illuminate\Support\Facades\Log;

trait Cloudinary_trait {

    public function CloudinaryUploadImg($path, $folder_cloud = 'img_family') {
        return CloudinaryLib::uploadImg($path, $folder_cloud);
    }
}
