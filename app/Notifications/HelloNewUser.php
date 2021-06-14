<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Auth;
use Session;
use App\Models\User;

class HelloNewUser extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $credential;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // public function __construct($user)
    // {
    //     $this->user = $user;
    //     $this->credential = null;
    // }
    public function __construct($user , $credential)
    {
        $this->user = $user;
        $this->credential = $credential;
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
        $inviter = User::where('id',$this->user->created_by)->first();
        if($this->credential == null){// if users register themselves
            return (new MailMessage)
                ->subject('Voltea IOT welcomes you')
                ->greeting('Hello! '.$this->user->name)
                ->line('Welcome to the Voltea neighbourhood.')
                ->line('We would like to thank you for choosing us for the purification of your water.')
                ->line('We request you to add your purchased device information so that you can view and control your device status remotely.')
                ->action('Let\'s Go', url('http://134.122.25.185/'))
                ->line('We will keep you updated with emails');
        }
        else{ // if users are invited

            return (new MailMessage)
                ->subject('Invitation from '.$inviter->name.', VolteaIOT')
                ->greeting('Hello! '.$this->user->name)
                ->line('We would like to inform you that your account has been created with the following details:')
                ->line('Email       : '.$this->user->email)
                ->line('Password    : '.$this->credential)
                ->line('')
                ->action('Let\'s Go', url('http://134.122.25.185/'))
                ->line('')
                ->line('Welcome to the Voltea neighbourhood.');
        }
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
