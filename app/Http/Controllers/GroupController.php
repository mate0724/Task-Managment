<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Notifications\GroupCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use phpDocumentor\Reflection\Types\Nullable;

class GroupController extends Controller
{



    //Csoportok listázása.
    public function index()
    {
        // Ha a felhasználó admin, minden csoportot betöltünk
        if (auth()->user()->role === 'admin') {
            $groups = Group::with(['leader', 'members'])->get();
        }
        // Ha normál felhasználó, betöltjük azokat a csoportokat, amelyekben tag vagy csoportvezető
        else {
            $groups = Group::where(function ($query) {
                $query->whereHas('members', function ($query) {
                    $query->where('user_id', auth()->id());
                })->orWhere('leader_id', auth()->id());
            })->with(['leader', 'members'])->get();
        }

        return view('groups.index', compact('groups'));
    }




    //Csoport létrehozása.
    public function create()
    {
        $users = User::all();

        return view('groups.create', compact('users'));
    }

    //új csoport mentése
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'leader_id' => 'required|exists:users,id',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id',
        ]);

        $group = Group::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'leader_id' => $validated['leader_id'],
        ]);

        if (isset($validated['members'])) {
            $group->members()->sync($validated['members']);
        }

        $members = $group->members; 
        Notification::send($members, new GroupCreated($group));


        return redirect()->route('groups.index')->with('success', 'Group created successfully.');
    }

    //Csoport szerkesztése.
    public function edit(Group $group)
    {
        $users = User::all();

        return view('groups.edit', compact('group', 'users'));
    }

    //Csoport frissítése.
    public function update(Request $request, Group $group)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'leader_id' => 'required|exists:users,id',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id',
        ]);

        $group->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'leader_id' => $validated['leader_id'],
        ]);

        if (isset($validated['members'])) {
            $group->members()->sync($validated['members']);
        }

        return redirect()->route('groups.index')->with('success', 'Group updated successfully.');
    }

    //Csoport törlése.

    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Group deleted successfully.');
    }
}
