<?php

namespace Tests\Feature;

use App\Libraries\CloudinaryLib;
use App\Libraries\CommonLib;
use App\Libraries\SimsimiLib;
use App\Mail\ToMeEmail;
use Cloudinary\Api;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SendEmailTest extends TestCase
{
    public function test_send_email()
    {
        try {
            Mail::to(config('mail.my_email'))
                ->send(new ToMeEmail('Content for test'));
            $this->assertTrue(true);
        } catch (\Exception $e) {
            $this->assertTrue(false);
        }
    }
}
