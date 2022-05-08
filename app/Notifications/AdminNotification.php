<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminNotification extends Notification
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
            ->subject('Withdrawal Request')
            ->greeting('Dear ' . ucfirst(trans($this->emaildata['username'])) . ',')
            ->line('This is to inform you that user <strong>' . ucfirst($this->emaildata['username']) . '</strong> has raised a request for token withdrawal. Please process the transaction.')
            ->line('<strong>Transaction ID</strong> : ' . $this->emaildata['transactionID'])
            ->line('<strong> User E-Mail</strong> : ' . $this->emaildata['useremail'])
            ->line('<strong style="color:#007bff"> Wallet Address</strong> : <span style="color:#007bff">' . $this->emaildata['wallet_address'] . '</span>')
            ->line('<strong> Amount Requested</strong> : ' . $this->emaildata['Amount_requested'])
            ->line('<strong>Transaction Fee</strong> : ' . $this->emaildata['transaction_fee'])
            ->line('<strong style="color:#007bff">Amount Receivable</strong> : <span style="color:#007bff">' . $this->emaildata['amount_receivable'] . '</span>')
            ->line('<strong>Date</strong> : ' . $this->emaildata['carbondate'])
            ->line('<strong>Time</strong> : ' . $this->emaildata['carbontime'])
            ->from("Sprotco@sportswizzleauge.com", "Sportco");
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
