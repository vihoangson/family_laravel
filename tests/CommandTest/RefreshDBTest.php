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

class RefreshDBTest extends TestCase {

    public function testCommand() {
        try {
            Artisan::call('refresh_db');
            $this->assertTrue(true);
        } catch (\Exception $e) {
            $this->assertTrue(false,$e->getMessage());
        }
    }


}
