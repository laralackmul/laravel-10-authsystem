<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistrationNotification extends Notification
{
    use Queueable;

    private $notificationDetails;
    public function __construct($notificationDetails)
    {
        $this->notificationDetails = $notificationDetails;
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

    public function toDatabase($notifiable)
    {
        $notificationDetails = $this->notificationDetails;
        return [
            'customer_name' => $notificationDetails['customer_name'],
            'customer_email'   => $notificationDetails['customer_email'],
        ];
    }
}
