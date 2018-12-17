<?php

namespace Tests\Feature;

use App\Libraries\CloudinaryLib;
use Cloudinary\Api;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FamilyTreeControllerTest extends TestCase {

    public function test_family_tree() {
        $response = $this->get(route('family-tree-index'));
        $response->assertStatus(302);
    }

    public function test_upload_file(){
        CloudinaryLib::uploadFileRaw(base_path('readme.md'),'testing_upload');
    }
    public function test_get_all_file_storage(){
        dd(Storage::allFiles());
    }
}
