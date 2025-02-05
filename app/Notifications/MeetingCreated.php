<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingCreated extends Notification
{
    protected $meeting;

    public function __construct($meeting)
    {
        $this->meeting = $meeting;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Új értekezlet jött létre: ' . $this->meeting->title,
            'url' => route('meetings.index', $this->meeting->id),
        ];
    }
}
