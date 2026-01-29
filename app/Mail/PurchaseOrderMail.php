<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $purchase;
    public $confirmationUrl;


    public function __construct($purchase, $confirmationUrl)
    {
        $this->purchase = $purchase;
        $this->confirmationUrl = $confirmationUrl;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Confirm Purchase Order')
                    ->view('emails.purchase_order');
    }
}
