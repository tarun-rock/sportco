<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TokenDeclined extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $emaildata;

    public function __construct($emaildata)
    {
        //
        $this->emaildata = $emaildata;
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
            ->greeting('Dear ' . ucfirst(trans($this->emaildata['username'])) . ',')
            ->subject('Transaction Declined')
            ->line('This is to inform you that your SportCo token withdrawal transaction has been declined. Details of the transaction are as follows:')
            ->line('<strong> Transaction ID</strong> : ' . $this->emaildata['transactionID'])
            ->line('<strong> Amount Requested</strong> : ' . $this->emaildata['Amount_requested'])
            ->line('<strong> Reason</strong> : ' . $this->emaildata['reason'])
            ->line('<strong> Date</strong> : ' . $this->emaildata['carbondate'])
            ->line('<strong> Time</strong> : ' . $this->emaildata['carbontime'])
            ->line('The tokens have been reversed to your account and the available balance in your account is <strong>' . $this->emaildata['balaceToken'] . ' Tokens</strong> .
                ')

            ->line('For more details please drop a mail to <a href="mailto:info@sportco.io">info@sportco.io</a> ');
            /*->line('For more details please drop a mail to <a href="mailto:accounts@sportco.io">accounts@sportco.io</a> ');*/
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
