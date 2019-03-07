<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\View;

class ToMeEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
        $this->subject = 'Alert to me';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        View::share('body', $this->msg);
        return $this->view('email.sample');
    }
}
