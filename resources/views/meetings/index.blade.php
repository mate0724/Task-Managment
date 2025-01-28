<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Meetings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 flex items-center justify-between">

                    <h3 class="text-lg font-medium text-gray-900 mb-4">Upcoming Meetings</h3>
                    <a href="{{ route('meetings.create') }}" class="">
                        Create Meeting
                    </a>
                </div>
                <ul>
                    @forelse ($meetings as $meeting)
                    <li class="mb-4">
                        <strong>{{ $meeting->title }}</strong> <br>
                        <span>{{ $meeting->scheduled_at->format('Y-m-d H:i') }}</span> <br>
                        <span>{{ $meeting->location }}</span> <br>
                        <span>Attendees: {{ $meeting->attendees->pluck('name')->join(', ') }}</span>
                    </li>
                    @empty
                    <p>No meetings found.</p>
                    @endforelse
                </ul>

            </div>
        </div>
    </div>
</x-app-layout>