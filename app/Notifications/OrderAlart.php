<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderAlart extends Notification
{
    use Queueable;


    protected $order;


    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->order_id,
            'message' => 'A new order has been received. Order ID: ' . $this->order->order_id,
        ];
    }



    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        return (new MailMessage)
            ->line('Thank you for your order.')
            ->line('Your order number: ' . $this->order->order_id);
        }
    

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
