<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\User;

class UserFollowed extends Notification
{
    use Queueable;

    public $follower;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $follower)
    {
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
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
                    ->subject('You have a new follower')
                    ->greeting('Hello, '.$notifiable->name)
                    ->line('@'.$this->follower->username." has followed you.")
                    ->action('See profile', url('/@'.$this->follower->username))
                    ->salutation('Thanks for use laratter');
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
            'follower' => $this->follower,
            'message' => '@'.$this->follower->username.' has followed you',
            'link' => '/@'.$this->follower->username
        ];
    }

    public function toBroadcast($notifiable) {
        return new BroadcastMessage([
            'data' => $this->toArray($notifiable)
        ]);
    }
}
