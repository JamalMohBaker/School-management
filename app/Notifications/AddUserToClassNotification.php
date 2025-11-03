<?php

namespace App\Notifications;

use Dflydev\DotAccessData\Data;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Attributes\Database;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddUserToClassNotification extends Notification
{
    use Queueable;
    public $classroom;
    public $user;
 

    /**
     * Create a new notification instance.
     */
    public function __construct($classroom, $user)
    {
        $this->classroom = $classroom;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->subject('You have been added to a new class')
    //         ->line('Hello ' . $this->user->First_name . ' ' . $this->user->Last_name)
    //         ->line('You have been added to the class: ' . $this->classroom->name)
    //         ->action('View Class', route('students.index'))
    //         ->line('Thank you!');
    // }

    public function toDatabase(object $notifiable):DatabaseMessage
    {
        return new DatabaseMessage([
            // {{$classroom->grade->name}} {{$classroom->name }}
            'body' => "You have been added to the class: {$this->classroom->grade->name} {$this->classroom->name} ",
            'icon' => "bi bi-house-add-fill", 
            'link' => route('students.index'),
        ]); 
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
