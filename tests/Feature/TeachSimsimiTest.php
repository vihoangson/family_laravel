<?php

namespace Tests\Feature;

use App\Libraries\CloudinaryLib;
use App\Libraries\SimsimiLib;
use App\Mail\ToMeEmail;
use Cloudinary\Api;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeachSimsimiTest extends TestCase
{

    public function test_teach_sim()
    {
        // hỏi anh chí xem có bật chưa
        $sim      = new SimsimiLib();
        $sim->teachSimsimi('son','deptrai');
    }
}
