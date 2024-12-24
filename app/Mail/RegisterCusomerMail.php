<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterCusomerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // Biến chứa thông tin người dùng

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        
        return $this->subject('Đăng ký tài khoản thành công')
                    ->view('pages.mail.register_Mail')
                    ->with([
                        'name' => $this->user->name,
                        'email' => $this->user->email,
                    ]);
    }
}
