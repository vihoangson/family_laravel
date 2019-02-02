<?php

namespace Tests\Feature;

use App\Mail\ToMeEmail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;


class SendEmailTest extends TestCase
{
    public function test_send_email()
    {
        Mail::to('vihoangson@gmail.com')->send(new ToMeEmail());
    }
}
