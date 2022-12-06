<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class SMSnotificationLaravel extends Notification
{
    use Queueable,Notification;

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
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }
    public function toNexmo($notifiable){
        // return (new NexmoMessage)
        //         ->content('This msg Sent By Abid');
    }
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
