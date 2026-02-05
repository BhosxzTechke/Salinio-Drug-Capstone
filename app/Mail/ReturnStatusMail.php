<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReturnStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $returnData;
    public $status;

    public function __construct($returnData, $status)
    {
        $this->returnData = $returnData;
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject('Your Return Request Update')
                    ->view('emails.return_status');
    }
}
