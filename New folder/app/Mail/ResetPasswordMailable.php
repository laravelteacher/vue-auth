<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $token;
    public $email;
    
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }
   
    
    public function build()
    {
        return $this->markdown('Email.passwordReset')->with([
            'token' => $this->token,
            'email' => $this->email
        ]);
    }
}
