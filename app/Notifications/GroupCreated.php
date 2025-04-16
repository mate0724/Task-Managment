<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GroupCreated extends Notification
{
    protected $group;

    public function __construct($group)
    {
        $this->group = $group;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => __('messages.group_created', ['name' => $this->group->name]),
            'url' => route('groups.index', $this->group->id),
        ];
    }
}
