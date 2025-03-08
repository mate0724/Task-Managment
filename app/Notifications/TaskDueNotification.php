<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskDueNotification extends Notification
{
    use Queueable;
    protected $task;

    /**
     * Create a new notification instance.
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toArray(object $notifiable): array
    {
        return [
            'message' => "A(z) '{$this->task->title}' feladat határideje ma van!",
            'task_id' => $this->task->id,
            // 'url' => route('tasks.index', $this->task->id),
            'url' => route('tasks.index', ['group' => $this->task->group_id]),
        ];
    }
}
