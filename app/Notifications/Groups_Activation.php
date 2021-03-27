<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Groups_Activation extends Notification
{
    use Queueable;

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
        return ['database','mail'];
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
                    ->line('We have good news!')
                    ->line('Groups are active now; choose a suitable time for you.')
                    ->action('Here', url('My_Group'))
                    ->line('And please note that groups cannot be changed after they\'ve been chosen.')
                    ->line('')
                    ->line('Now gear up for your learning journey!');
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
            
            'Message'=> 'Groups are active, Choose your weekly discussion time from (My Group) section.',
            'link'   => 'My_Group',
            'icon'   => 'bullhorn',
            'label'  => 'info'
       
        ];
    }
}
