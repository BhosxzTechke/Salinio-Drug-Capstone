<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
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

           // Generate PDF from Blade view
        $pdf = Pdf::loadView('pdf.purchaseReceipt', [
            'purchase' => $this->purchase
        ]);


        return $this->subject('Confirm Purchase Order'. $this->purchase->po_number)
                    ->view('emails.purchase_order')
                    ->attachData(
                $pdf->output(),
                'PO-' . $this->purchase->po_number . '.pdf',
                [
                    'mime' => 'application/pdf',
                ]
            );
    }
}
