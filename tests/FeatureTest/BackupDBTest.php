<?php

namespace Tests\Feature;

use App\Libraries\BackupDBLib;
use App\Libraries\CloudinaryLib;
use Cloudinary\Api;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BackupDBTest extends TestCase
{

    public function testbackup()
    {
        BackupDBLib::backupToCloud();
    }
}
