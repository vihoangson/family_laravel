<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Storage;

class CloudinaryLib
{

    public function __construct()
    {
    }

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

    public static function uploadFileRaw($path, $folder_name = 'folder_file_raw')
    {

        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        $random_name_folder = $folder_name;
        \Cloudinary\Uploader::upload($path, [
            "folder"           => $random_name_folder . "/",
            "public_id"        => basename($path),
            "overwrite"        => true,
            "notification_url" => "https://requestb.in/12345abcd",
            "resource_type"    => "raw"
        ]);
    }

    public static function getAllImage()
    {

        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        $searching = new \Cloudinary\Search;
        $result    = $searching->expression('resource_type:image')
                               ->sort_by('public_id', 'desc')
                               ->max_results(100)
                               ->execute();
        $links     = $result->getArrayCopy()['resources'];

        return $links;
    }

    public static function getAllRaw()
    {

        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        $searching = new \Cloudinary\Search;
        $result    = $searching->expression('resource_type:raw')
                               ->sort_by('public_id', 'desc')
                               ->max_results(100)
                               ->execute();
        $links     = $result->getArrayCopy()['resources'];

        return $links;
    }

    public static function searchFileInCloud($file_name)
    {

        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        $searching = new \Cloudinary\Search;
        $result    = $searching->expression('filename="' . $file_name . '"')
                               ->sort_by('public_id', 'desc')
                               ->max_results(100)
                               ->execute();
        $links     = $result->getArrayCopy()['resources'];
        if (isset($links[0])) {
            return $links[0];
        }

        return false;


    }
}