<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Update_Student_Session extends Notification
{
    use Queueable;
    public $info;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    

    public function __construct($inf)
    {
        //
        $this->info=$inf;
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
                    ->line('We would like to inform you that you were transferred to another session for Discussion '.$this->info->name)
                    ->line('The session will be held on '.$this->info->day.' at '.date('h:i a', strtotime($this->info->time)))
                    ->action('Check session times', url('My_Group'))
                    ->line('Thank you for using the Utopians app!');
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
            
            'Message'=> 'You were moved to another session for Discussion '.$this->info->name.' on '.$this->info->day.' at '.date('h:i a', strtotime($this->info->time)),
            'link'   => 'My_Group',
            'icon'   => 'calendar-times-o',
            'label'  => 'success'
       
        ];
    }
}
