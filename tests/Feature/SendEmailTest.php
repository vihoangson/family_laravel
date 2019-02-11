<?php

namespace Tests\Feature;

use App\Mail\ToMeEmail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;


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
