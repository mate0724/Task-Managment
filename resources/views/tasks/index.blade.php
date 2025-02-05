<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('messages.group') }}{{ $group->name }} - {{ __('messages.tasks') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (auth()->id() === $group->leader_id)
                    <x-primary-button class="mt-2 flex items-center justify-center h-10">
                        <a href="{{ route('groups.tasks.create', $group) }}" class="text-center">{{ __('messages.create_task') }}</a>
                    </x-primary-button>
                    
                    @endif
                    
                    @if ($tasks->isEmpty())
                    <p>{{ __('messages.no_tasks') }}</p>
                    @endif

                    <ul class="list-group">
                        @foreach ($tasks as $task)
                        <li class="list-group-item mb-3">
                            <h5>{{ $task->title }}</h5>
                            <p>{{ $task->description }}</p>
                            <p><strong>{{ __('messages.priority') }}:</strong> {{ ucfirst($task->priority) }}</p>
                            <p><strong>{{ __('messages.deadline') }}:</strong> {{ $task->due_date ?? 'Nincs megadva' }}</p>
                            <p><strong>{{ __('messages.status') }}:</strong> {{ ucfirst($task->status) }}</p>

                            @if ($task->file_path)
                            <a href="{{ asset('storage/' . $task->file_path) }}" target="_blank" class="text-blue-500">{{ __('messages.file') }}</a>
                            @endif

                            <div class="mt-2">

                                <!-- 
                                <a href="{{ route('tasks.comments.store', $task) }}" class="btn btn-info btn-sm">Megtekintés</a>
                                -->

                                <a href="{{ route('groups.tasks.show', [$group->id, $task->id]) }}" class="px-4 py-2 bg-blue-500 text-black rounded-md shadow-md">
                                {{ __('messages.comments') }}
                                </a>


                                @if (auth()->id() === $group->leader_id)
                                <a href="{{ route('groups.tasks.edit', [$group, $task]) }}" class="px-4 py-2 bg-black-500 text-black rounded-md shadow-md">{{ __('messages.edit') }}</a>
                                <form action="{{ route('groups.tasks.destroy', [$group, $task]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-4 py-2 bg-blue-500 text-black rounded-md shadow-md" type="submit">{{ __('messages.delete') }}</button>
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