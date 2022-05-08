<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostApproved extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $postdata;
    public function __construct($postdata)
    {
        //
        $this->postdata = $postdata;
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
        $mailMessage = new MailMessage();
        $mailMessage
                ->subject('Sportco Post Approved!')
                ->line('Congratulations! Your post <strong>'. $this->postdata['title']. '</strong> has been approved by our editorial team.')
                ->from("Sprotco@sportswizzleauge.com", "Sportco");
        if(!empty($this->postdata['feedback'])) {
            $mailMessage->line('Feedback from the editorial team is shared below:');
            $mailMessage->line('<strong>'.$this->postdata['feedback'].'</strong>');
        }

        return $mailMessage;

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
