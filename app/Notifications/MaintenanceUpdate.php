<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MaintenanceUpdate extends Notification implements ShouldQueue
{
    use Queueable;
    public $maintenance_type;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($maintenance_type, $user)
    {
        $this->maintenance_type = $maintenance_type;
        $this->user = $user;
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
        return (new MailMessage)
                    ->subject('Voltea IOT Maintenance Alert')
                    ->greeting('Hello! '.$this->user->name)
                    ->line('You have reset the maintenance: '.$this->maintenance_type)
                    ->line('Thank you');
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
