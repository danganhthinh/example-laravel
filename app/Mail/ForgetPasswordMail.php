<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $title;
    protected $token;
    protected $email;


    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
        $this->title = env('APP_NAME', '[Upload CSV]') . "  Forgot Password";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('vendor.mails.password_reset')->with(['email' => $this->email, 'token' => $this->token])->subject($this->title);
    }
}
