<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StudentRegistered extends Notification
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
        return ['mail','database'];
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
                    ->line('Welcome to Utopians!')
                    ->line('Thank you for registering.')
                    ->line('Please login here:')
                    ->action('Login link ', url('/login'))
                    ->line('To start your journey with us; take the placement test to assess your English language level.')
                    ->line('The placement test code is: ' . $this->notify_data["exam_code"] . ' ')
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
            'Message'=> 'The placement test code is: '.$this->notify_data["exam_code"],
            'link'   => 'Exam',
            'icon'   => 'bullseye',
            'label'  => 'warning'
        ];
    }
}
