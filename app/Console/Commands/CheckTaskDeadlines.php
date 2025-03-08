<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskDueNotification;
use Carbon\Carbon;

class CheckTaskDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:check-deadlines';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for tasks due today and notify users';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        $tasks = Task::whereDate('deadline', $today)->get();
        
        foreach ($tasks as $task) {
            $user = User::find($task->user_id);
            if ($user) {
                $user->notify(new TaskDueNotification($task));
            }
        }

        $this->info('Task deadline notifications sent.');
    }
}
