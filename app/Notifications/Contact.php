<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Contact extends Notification
{
    use Queueable;
    public $subject ="", $message ="";
    public $sender = null;
    public $receiver = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($receiver, $subject, $message , $sender)
    {
        $this->receiver = $receiver;
        $this->subject = $subject;
        $this->message = $message;
        $this->sender = $sender;
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
        return (new MailMessage)->view('emailTemplates.contact');
                    // ->subject($this->subject)
                    // ->greeting('Hello! '.$this->receiver->name)
                    // ->line('You have received a query from :'.$this->sender->name."(".$this->sender->email.")")
                    // ->line('Message is as below:')
                    // ->line($this->message);
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
