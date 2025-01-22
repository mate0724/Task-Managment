<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Csoport: {{ $group->name }} - Feladatok
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (auth()->id() === $group->leader_id)
                    <a href="{{ route('groups.tasks.create', $group) }}" class="btn btn-primary mb-4">Új feladat létrehozása</a>
                    @endif

                    <ul class="list-group">
                        @foreach ($tasks as $task)
                        <li class="list-group-item mb-3">
                            <h5>{{ $task->title }}</h5>
                            <p>{{ $task->description }}</p>
                            <p><strong>Prioritás:</strong> {{ ucfirst($task->priority) }}</p>
                            <p><strong>Határidő:</strong> {{ $task->due_date ?? 'Nincs megadva' }}</p>
                            <p><strong>Státusz:</strong> {{ ucfirst($task->status) }}</p>

                            @if ($task->file_path)
                            <a href="{{ asset('storage/' . $task->file_path) }}" target="_blank" class="text-blue-500">Csatolt fájl</a>
                            @endif

                            <div class="mt-2">

                                <!-- 
                                <a href="{{ route('tasks.comments.store', $task) }}" class="btn btn-info btn-sm">Megtekintés</a>
                                -->

                                <a href="{{ route('groups.tasks.show', [$group->id, $task->id]) }}" class="px-4 py-2 bg-blue-500 text-black rounded-md shadow-md">
                                    Kommentek
                                </a>


                                @if (auth()->id() === $group->leader_id)
                                <a href="{{ route('groups.tasks.edit', [$group, $task]) }}" class="btn btn-warning btn-sm">Szerkesztés</a>
                                <form action="{{ route('groups.tasks.destroy', [$group, $task]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Törlés</button>
                                </form>
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>