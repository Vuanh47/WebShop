<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class OrderPlacedMail extends Mailable
{
    public $orderDetails;

    public function __construct($orderDetails)
    {
        $this->orderDetails = $orderDetails;
    }

    public function build()
    {
        return $this->view('mail')
                    ->with([
                        'orderDetails' => $this->orderDetails,
                    ]);
    }
}

