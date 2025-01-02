<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Design Homepage',
            'description' => 'Create a responsive homepage design.',
            'status' => 'todo',
            'priority' => 'high',
            'dua_date' => now()->addDays(7),
            'assigned_to' => 2, // John Doe
        ]);

        Task::create([
            'title' => 'Fix Login Bug',
            'description' => 'Resolve the issue with the login functionality.',
            'status' => 'in_progress',
            'priority' => 'medium',
            'due_date' => now()->addDays(3),
            'assigned_to' => 3, // Jane Smith
        ]);
    }
}
