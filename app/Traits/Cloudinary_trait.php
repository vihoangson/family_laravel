<?php

namespace App\Traits;

use App\Libraries\CloudinaryLib;
use Illuminate\Support\Facades\Log;

trait Cloudinary_trait {

    public function CloudinaryUploadImg($path, $folder_cloud = null) {
        if($folder_cloud==null){
            $folder_cloud = config('configfamily.folder_in_cloud');
        }
        return CloudinaryLib::uploadImg($path, $folder_cloud);
    }
}
