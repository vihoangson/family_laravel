<?php

namespace Tests\Feature;

use Cloudinary\Api;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CloudinaryTest extends TestCase
{

    public function test_uploadimg()
    {
        \Cloudinary::config([
                'api_key'    => env('api_key'),
                'api_secret' => env('api_secret'),
                'cloud_name' => env('cloud_name'),
            ]);
        \Cloudinary\Uploader::upload("D:/xampp7/htdocs/vhosts/family/public/tempates/porto/img/benefits/benefits-2.jpg",
            [
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
}
