<?php

namespace Tests\Feature;

use App\Libraries\CloudinaryLib;
use Cloudinary\Api;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CloudinaryTest extends TestCase {

    public function setUp() {
        parent::setUp();
        \Cloudinary::config([
            'api_key'    => env('api_key'),
            'api_secret' => env('api_secret'),
            'cloud_name' => env('cloud_name'),
        ]);
    }

    /**
     * @author hoang_son
     */
    public function test_moveallimgtocloud() {
        return;
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

    public function test_uploadimg() {
        \Cloudinary\Uploader::upload(base_path("/public/tempates/porto/img/benefits/benefits-2.jpg"), [
            "folder"           => "my_folder/",
            "public_id"        => "my_dog" . time(),
            "overwrite"        => true,
            "notification_url" => "https://requestb.in/12345abcd",
            "resource_type"    => "image"
        ]);
    }

    public function test_uploadraw() {
        \Cloudinary\Uploader::upload(base_path("/sqlite/data_family"), [
            "folder"           => "backup_db/",
            "public_id"        => "data_family" . time(),
            "overwrite"        => true,
            "notification_url" => "https://requestb.in/12345abcd",
            "resource_type"    => "raw"
        ]);
    }

    public function test_searchallImageinCloud() {
        $this->assertGreaterThan(0, count(CloudinaryLib::getAllImage()), 'Không có img trong cloud');
    }

    public function test_searchraw() {
        $searching = new \Cloudinary\Search;
        $result    = $searching->expression('resource_type:raw')
                               ->sort_by('public_id', 'desc')
                               ->max_results(30)
                               ->execute();

        $this->assertGreaterThan(0, count($result->getArrayCopy()['resources']), 'Không có file raw trên cloud');


    }

    public function test_searchimg() {
        $searching = new \Cloudinary\Search;
        $result    = $searching->expression('resource_type:image')
                               ->sort_by('public_id', 'desc')
                               ->max_results(30)
                               ->execute();

        $this->assertGreaterThan(0, count($result->getArrayCopy()['resources']), 'Không có hình trên cloud');


    }

    public function test_ListInFolder() {
        $api    = new Api;
        $result = $api->resources(["type" => "upload", "prefix" => ""]);


    }

    public function test_CloudinaryLib_upload_img_ok() {
        $path   = base_path("/public/tempates/porto/img/benefits/benefits-2.jpg");
        $result = CloudinaryLib::uploadImg($path, 'testing');

        $this->assertArrayHasKey('url', $result);
    }

    /**
     * @author hoang_son
     */
    public function test_CloudinaryLib_upload_img_false() {
        $path   = base_path("");
        $result = CloudinaryLib::uploadImg($path, 'testing');
        $this->assertFalse($result);
    }

    public function test_searchFileInCloud()
    {
        $result = CloudinaryLib::searchFileInCloud('foo.jpg');
        $this->assertFalse($result,'Không up được file');
    }

    public function test_searchFileInCloud_Ok()
    {
        $result = CloudinaryLib::searchFileInCloud('20180908_030955_27913085_2069100933101884_8597121477202297546_o.jpg');
        $this->assertGreaterThan(0,count($result),'Không up được file');
    }
}
