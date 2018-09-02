<?php

namespace Tests\Feature;

use App\Libraries\CloudinaryLib;
use Cloudinary\Api;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CloudinaryTest extends TestCase
{

    /**
     * @author hoang_son
     */
    public function test_movetocloud()
    {
        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);

        $files              = Storage::allFiles();
        $random_name_folder = time();
        foreach ($files as $k => $v) {
            if ($k > env('limit_up_to_cloud',3)) {
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

    public function test_uploadimg()
    {
        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);
        \Cloudinary\Uploader::upload(base_path("/public/tempates/porto/img/benefits/benefits-2.jpg"), [
            "folder"           => "my_folder/",
            "public_id"        => "my_dog" . time(),
            "overwrite"        => true,
            "notification_url" => "https://requestb.in/12345abcd",
            "resource_type"    => "image"
        ]);

    }

    public function test_searchimg()
    {
        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);
        $searching = new \Cloudinary\Search;
        $result    = $searching->expression('resource_type:image  AND uploaded_at>1d AND bytes>1m')
                               ->sort_by('public_id', 'desc')
                               ->max_results(30)
                               ->execute();


    }

    public function test_ListInFolder()
    {
        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);
        $api    = new Api;
        $result = $api->resources(["type" => "upload", "prefix" => ""]);


    }

    public function test_CloudinaryLib_upload_img_ok(){
        $path = base_path("/public/tempates/porto/img/benefits/benefits-2.jpg");
        $result = CloudinaryLib::uploadImg($path,'testing');
        echo (json_encode($result));


    }

    /**
     * @author hoang_son
     */
    public function test_CloudinaryLib_upload_img_false(){
        $path = base_path("");
        $result = CloudinaryLib::uploadImg($path,'testing');
        $this->assertFalse($result);
    }
}
