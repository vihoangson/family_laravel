<?php

namespace Tests\Feature;

use App\Libraries\CloudinaryLib;
use Cloudinary\Api;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImportContentTest extends TestCase {

    public function testCommand() {
        Artisan::call('import_content');
    }


}
