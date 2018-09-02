<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Storage;

class CloudinaryLib
{

    /**
     * @param        $path
     * @param string $folderInCloud
     *
     * @return bool|mixed
     * @author hoang_son
     */
    public static function uploadImg($path, $folderInCloud = '')
    {
        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        if (preg_match('/(\.jpg|\.png)$/', $path)) {
            if (file_exists($path)) {
                $response = \Cloudinary\Uploader::upload($path, [
                    "folder"           => "my_folder/" . $folderInCloud . '/',
                    "public_id"        => basename($path),
                    "overwrite"        => true,
                    "notification_url" => "http://vihoangson.com",
                    "resource_type"    => "image"
                ]);

                return $response;
            }
        }

        return false;
    }

    public static function uploadAllImgInStorage()
    {
        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        $files              = Storage::allFiles();
        $random_name_folder = time();
        foreach ($files as $k => $v) {
            if ($k > env('limit_up_to_cloud', 3)) {
                continue;
            }
            if (preg_match('/(\.jpg|\.png)$/', $v)) {
                $path = storage_path('app/' . $v);
                if (file_exists($path)) {
                    \Cloudinary\Uploader::upload($path, [
                        "folder"           => $random_name_folder . "/",
                        "public_id"        => basename($path),
                        "overwrite"        => true,
                        "notification_url" => "https://requestb.in/12345abcd",
                        "resource_type"    => "image"
                    ]);

                }
            }
        }
    }
}