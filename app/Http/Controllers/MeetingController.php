<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\MeetingCreated;
use Illuminate\Support\Facades\Notification;

class MeetingController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $meetings = Meeting::orderBy('scheduled_at', 'asc')->get();
        } else {
            $meetings = Meeting::with('attendees')
                ->whereHas('attendees', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->orderBy('scheduled_at')
                ->get();
        }

        return view('meetings.index', compact('meetings'));
    }

    public function create()
    {
        $users = User::all();
        return view('meetings.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'scheduled_at' => 'required|date',
            'location' => 'required|string|max:255',
            'attendees' => 'required|array',
            'attendees.*' => 'exists:users,id',
        ]);

        $meeting = Meeting::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'scheduled_at' => $validated['scheduled_at'],
            'location' => $validated['location'] ?? null,
            'created_by' => auth()->id(),
        ]);

        if (!empty($validated['attendees'])) {
            //$meeting->attendees()->sync($validated['attendees']);
            $meeting->attendees()->attach($validated['attendees']);
        }

        $attendees = $meeting->attendees;
        Notification::send($attendees, new MeetingCreated($meeting));

        return redirect()->route('meetings.index')->with('success', 'Meeting created successfully.');
    }
}
