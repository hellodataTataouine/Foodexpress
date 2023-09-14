<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Aleksa\LaravelFirebase\Notifications\FirebaseMessage;
use Illuminate\Support\Facades\Log;

class FirebaseNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(string $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(string $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(string $notifiable): array
    {
        return [
            //
        ];
    }


   
        public function toFirebase($notifiable)
{
    // Log that the notification is being sent
    Log::info('Sending Firebase Notification to: ' . $notifiable->fcm_token);

    return (new FirebaseMessage)
        ->title('Notification Title')
        ->body('Notification Body');

    }

}
