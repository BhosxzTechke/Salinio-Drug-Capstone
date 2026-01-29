<?php

namespace App\Notifications;

use App\Models\PurchaseOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseOrderCreated extends Notification
{
    use Queueable;


    public PurchaseOrder $purchaseOrder;

    public function __construct(PurchaseOrder $purchaseOrder)
    {
        $this->purchaseOrder = $purchaseOrder;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject('New Purchase Order: ' . $this->purchaseOrder->po_number)
                ->greeting('Hello ' . $notifiable->name . ',')
                ->line('A new purchase order has been created for you.')
                ->line('Purchase Order Number: ' . $this->purchaseOrder->po_number)
                ->line('Expected Delivery Date: ' . $this->purchaseOrder->expected_delivery_date->format('Y-m-d'))
                ->action('View Purchase Order', url(route('purchase.order.show', $this->purchaseOrder->id)))
                ->line('Thank you for working with us!');
        }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
