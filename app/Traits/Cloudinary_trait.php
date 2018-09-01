<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Cloudinary_trait
{
    public function CloudinaryUploadImg($path)
    {
        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);
        // base_path("/public/tempates/porto/img/benefits/benefits-2.jpg"
        \Cloudinary\Uploader::upload( $path,
            [
                "folder"           => "my_folder/",
                "public_id"        => "my_dog" . time(),
                "overwrite"        => true,
                "notification_url" => "https://requestb.in/12345abcd",
                "resource_type"    => "image"
            ]);

    }
}
