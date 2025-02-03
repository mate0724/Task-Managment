<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.my_meetings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('messages.upcoming_meetings') }}</h3>
                    
                    <x-primary-button class="mt-2">
                        <a href="{{ route('meetings.create') }}" class="">
                        {{ __('messages.create_meeting') }}
                    </a></x-primary-button>
                    
                </div>
                <ul>
                    @forelse ($meetings as $meeting)
                        <li class="mb-4 p-4 bg-gray-100 rounded-md shadow-sm">
                            <strong class="text-lg text-gray-700">{{ $meeting->title }}</strong> <br>
                            <span class="text-sm text-gray-500">{{ $meeting->scheduled_at->format('Y-m-d H:i') }}</span> <br>
                            <span class="text-sm text-gray-500">{{ $meeting->location }}</span> <br>
                            <span class="text-sm text-gray-500">Attendees: {{ $meeting->attendees->pluck('name')->join(', ') }}</span> <br>
                            <span class="text-sm text-gray-500">{{ $meeting->description }}</span> <br>
                        </li>
                    @empty
                        <p class="p-4 text-gray-500">No meetings found.</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
