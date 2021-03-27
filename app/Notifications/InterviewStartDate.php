<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InterviewStartDate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $notify_data;
    public function __construct(array $notify_data)
    {
        //
        $this->notify_data = $notify_data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('It\'s time to meet your tutor in an interview. ')
                    ->line('The interviews start date is: '.date('d-M-Y', strtotime($this->notify_data["date"])))
                    ->line('Please contact your group\'s tutor to set your interview date.')
                    ->line('Enjoy!');
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
            'Message'=> 'The interviews start date is: '.date('d-M-Y', strtotime($this->notify_data["date"])).'. Contact your group\'s tutor to fix your interview date',
            'link'   => '',
            'icon'   => 'comments',
            'label'  => 'warning'
        ];
    }
}
