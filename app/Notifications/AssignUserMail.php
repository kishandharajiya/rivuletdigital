<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignUserMail extends Notification implements ShouldQueue
{
    use Queueable;
    public $userName;
    public $taskName;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($taskName,$userName)
    {
        $this->userName = $userName;
        $this->taskName = $taskName;
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
                    ->subject('New Task Assigned')
                    ->view('emails.assign-task', ['userName' => $this->userName,'taskName' => $this->taskName]);
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
