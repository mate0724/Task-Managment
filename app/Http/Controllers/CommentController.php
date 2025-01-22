<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Task $task)
    {
        // Csak a csoport tagjai kommentelhetnek
        $group = $task->group;
        if (!$group->members->contains(auth()->id())) {
            abort(403, 'Nincs jogosultságod kommentet írni.');
        }

        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $task->comments()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'task_id' => $task->id,
        ]);

        /*
        return redirect()->route('tasks.show', $task)
            ->with('success', 'Hozzászólás sikeresen hozzáadva.');
        */
        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function destroy(Task $task, Comment $comment)
    {
        // Csak a komment tulajdonosa törölheti a kommentet
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Csak a saját hozzászólásaidat törölheted.');
        }

        $comment->delete();

        return redirect()->route('tasks.show', $task)
            ->with('success', 'Hozzászólás sikeresen törölve.');
    }
}
