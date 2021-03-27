<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StudentExamResult extends Notification
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
                    ->line('Your '.$this->info->exam_name.' result is: '.$this->info->result)
                    //->action('Check Your Sessions Times', url('My_Group'))
                    ->line('Keep up the good work and remember; there is always room for improvement.');
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
            'Message'=> 'Your '.$this->info->exam_name.' result is: '.$this->info->result,
            'link'   => '',
            'icon'   => 'bullseye',
            'label'  => 'warning'
        ];
    }
}
