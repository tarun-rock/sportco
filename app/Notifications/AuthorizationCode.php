<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AuthorizationCode extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $rand;
    private $user;

    public function __construct($rand, $user)
    {
        //
        $this->rand = $rand;
        $this->user = $user;

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
            ->subject('SportCo Token Withdrawal - Authorization Code')
            ->greeting('Dear, ' . ucfirst(trans($this->user)) . ' !')
            ->line('To verify your identity for the withdrawal transaction, please use the following code:')
            ->line('<strong> Authorization Code : ' . $this->rand . '</strong><hr/>')
            ->line('If you did not request this code, it is possible that someone else is trying to withdraw SportCo tokens from your account. *Do not forward or give this code to anyone.*
')
            ->line('SportCo takes your account security very seriously. SportCo will never email you and ask you to disclose or verify your password,  Authorization Code, credit card, or banking account number. If you receive a suspicious email with a link to update your account information, do not click on the link - instead, report the email to SportCo for investigation.
')
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
            'rand' => $this->rand
        ];
    }
}
