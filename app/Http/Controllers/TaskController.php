<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Group;
use Illuminate\Support\Facades\Storage;


class TaskController extends Controller
{
    public function index(Group $group)
    {
        if (!$group->members->contains(auth()->id()) && $group->leader_id !== auth()->id()) {
            abort(403, 'Nincs jogosultságod a csoporthoz!');
        }

        $tasks = $group->tasks()
            ->with('comments.user')
            ->orderByRaw("CASE WHEN due_date IS NULL THEN 1 ELSE 0 END, due_date ASC")
            ->get();
        return view('tasks.index', compact('group', 'tasks'));
    }

    public function create(Group $group)
    {
        if ($group->leader_id !== auth()->id()) {
            abort(403, 'Csak a csoportvezető hozhat létre feladatokat.');
        }

        return view('tasks.create', compact('group'));
    }


    public function store(Request $request, Group $group)
    {
        // Csak a csoportvezető hozhat létre feladatokat
        if ($group->leader_id !== auth()->id()) {
            abort(403, 'Csak a csoportvezető hozhat létre feladatokat.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:todo,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docs|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tasks', 'public');
        }

        $group->tasks()->create(array_merge($validated, [
            'file_path' => $filePath,
        ]));

        return redirect()->route('groups.tasks.index', $group)
            ->with('success', 'Feladat sikeresen létrehozva!');
    }

    public function edit(Group $group, Task $task)
    {
        // Csak a csoportvezető szerkesztheti a feladatot
        if ($group->leader_id !== auth()->id()) {
            abort(403, 'Csak a csoportvezető szerkesztheti a feladatokat.');
        }

        return view('tasks.edit', compact('group', 'task'));
    }

    public function update(Request $request, Group $group, Task $task)
    {
        // Csak a csoportvezető szerkesztheti a feladatot
        if ($group->leader_id !== auth()->id()) {
            abort(403, 'Csak a csoportvezető szerkesztheti a feladatokat.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:todo,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docs|max:2048',
        ]);

        if ($request->hasFile('file')) {
            if ($task->file_path) {
                Storage::disk('public')->delete($task->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('tasks', 'public');
        }

        $task->update($validated);

        return redirect()->route('tasks.index', $group)
            ->with('success', 'Feladat sikeresen frissítve!');
    }

    public function destroy(Group $group, Task $task)
    {
        // Csak a csoportvezető törölheti a feladatot
        if ($group->leader_id !== auth()->id()) {
            abort(403, 'Csak a csoportvezető törölheti a feladatokat.');
        }

        if ($task->file_path) {
            Storage::disk('public')->delete($task->file_path);
        }

        $task->delete();

        return redirect()->route('groups.tasks.index', $group)
            ->with('success', 'Feladat sikeresen törölve.');
    }

    public function show(Group $group, Task $task)
    {
        // Ellenőrizzük, hogy a felhasználó jogosult-e a feladathoz
        if ($task->group_id !== $group->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.show', compact('group', 'task'));
    }
}
