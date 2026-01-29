<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $name;
    public $senderEmail;
    public $body;

    public function __construct($order, $customer)
    {
        $this->title = 'Order Delivered Successfully';
        $this->name  = $customer->name;
        $this->senderEmail = config('mail.from.address');
        $this->body  = "Your order {$order->invoice_no} has been delivered successfully.";
    }

    public function build()
    {
        return $this->subject($this->title)
                    ->view('emails.order-complete');
    }
}
