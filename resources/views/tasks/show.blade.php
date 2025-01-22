<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Feladat megtekintése
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold">{{ $task->title }}</h3>
                    <p class="mt-2">{{ $task->description }}</p>
                    <p class="mt-2"><strong>Határidő:</strong> {{ $task->due_date }}</p>
                    <p class="mt-2"><strong>Prioritás:</strong> {{ ucfirst($task->priority) }}</p>
                    <p class="mt-2"><strong>Státusz:</strong> {{ ucfirst($task->status) }}</p>

                    <div class="mt-4">
                        <h4 class="text-lg font-semibold">Kommentek</h4>
                        <ul class="mt-2">
                            @foreach ($task->comments as $comment)
                                <li class="border-t border-gray-300 py-2">
                                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Komment hozzáadása -->
                    <form method="POST" action="{{ route('tasks.comments.store', $task->id) }}" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <textarea name="content" rows="3" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Írj egy kommentet..."></textarea>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-black rounded-md shadow-md">
                            Hozzászólás
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
