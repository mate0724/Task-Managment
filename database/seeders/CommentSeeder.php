<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
            'content' => 'This task needs more details.',
            'user_id' => 2, // John Doe
            'task_id' => 1, // Design Homepage
        ]);

        Comment::create([
            'content' => 'Please prioritize this bug fix.',
            'user_id' => 2, // Jane Smith
            'task_id' => 2, // Fix Login Bug
        ]);
    }


}
