<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public $user = [];
    public $old_email = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $old_email)
    {
        $this->user = $user;
        $this->old_email = $old_email;
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
        if($this->old_email == null){// user has not changed the email
            return (new MailMessage)
            ->subject('Your details have been updated')
            ->greeting('Hello! '.$this->user->name)
            ->line('This email is to notify you that your details have been updated.')
            ->line('If you haven\'t done this you can report to us for review.')
            ->action('Report', url('/'))
            ->line('We are here for help!');
        }
        return (new MailMessage)
            ->subject('Your Email has been updated')
            ->greeting('Hello! '.$this->user->name)
            ->line('This email is to notify you that your details have been updated and your email as well.')
            ->line('You cannot sign in to our app with your old email:'.$this->old_email)
            ->line('Use your new email:'.$this->user->email.'  and your old password to sign in.')
            ->line('If you haven\'t done this you can report to us for review')
            ->action('Report', url('/'))
            ->line('We are here for help!');
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
