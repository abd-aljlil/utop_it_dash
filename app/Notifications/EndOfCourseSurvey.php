<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EndOfCourseSurvey extends Notification
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
                    ->line('The end of our course is drawing near, we hope you had an unforgettable journey with  UTOPIANS.')
                    ->line('Before sending the final Certificate, please fill out this survey to measure your overall satisfaction with the course and then develop our curriculum and approach accordingly.')
                    ->action('End of Course Survey', url('http://google.com'))
                    ->line('Thanks in advance!');
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
