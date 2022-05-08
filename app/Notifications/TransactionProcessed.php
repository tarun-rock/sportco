<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TransactionProcessed extends Notification
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
            ->subject('Transaction Processed')
            ->line('This is to inform you that your SportCo token withdrawal transaction has been processed. Details of the transaction are as follows:')
            ->line('<strong> Transaction ID</strong> : ' . $this->emaildata['transactionID'])
            ->line('<strong> Amount Requested</strong> : ' . $this->emaildata['Amount_requested'])
            ->line('<strong>Transaction Fee</strong> : ' . $this->emaildata['transaction_fee'])
            ->line('<strong>Amount Receivable</strong> : ' . $this->emaildata['amount_receivable'])
            ->line('<strong> Date</strong> : ' . $this->emaildata['carbondate'])
            ->line('<strong> Time</strong> : ' . $this->emaildata['carbontime'])
            /*->line('Once the request has been processed, please allow an additional 1 day for the funds to show in your Crypto wallet.
<br/><br/>We try and complete the withdrawal in 24 hours, however please note that the  time taken for cryptocurrency withdrawals totally depends on the blockchain network congestion. 
')*/
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
