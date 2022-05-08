<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TokenApproved extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Transaction Approved')
            ->line('This is to inform you that your SportCo token withdrawal transaction has been approved. Details of the transaction are as follows:')
            ->line('<strong> Transaction ID</strong> XXXXXXXX')
            ->line('<strong> Amount</strong> XXXXXXXX')
            ->line('<strong> Date</strong> 08-10-2017')
            ->line('<strong> Time</strong> 16:02:28')
            ->line('Once the request has been approved, please allow an additional 1 day for the funds to show in your Crypto wallet. We try and complete the withdrawal in 24 hours however please note that the  time taken for cryptocurrency withdrawals totally depends on the blockchain network congestion. 
');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
