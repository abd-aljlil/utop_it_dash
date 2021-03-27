<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Exam_Info extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $info;
    public function __construct($info)
    {
        //
        $this->info=$info;
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
                    ->line('Time to check your knowledge; be prepared.')
                    ->line('Your next exam starts at '.date('h:i a', strtotime($this->info->date)).' on '.date('M d,Y', strtotime($this->info->date)))
                    ->line(' Your exam code is: '.$this->info->code)
                    ->action('Exam Page', url('ExamPage'))
                    ->line('Best of luck!');
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

            'Message'=> 'Your exam starts '.date('h:i a', strtotime($this->info->date)).' on '.date('d-M-Y', strtotime($this->info->date)).' Code: '.$this->info->code,
            'link'   => 'ExamPage',
            'icon'   => 'exclamation-triangle',
            'label'  => 'danger'
        
        ];
    }
}
