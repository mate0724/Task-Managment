<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Feladat szerkesztése
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('groups.tasks.update', [$group->id, $task->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Cím -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700">Cím</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Leírás -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Leírás</label>
                            <textarea name="description" id="description" rows="5" 
                                class="w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $task->description) }}</textarea>
                        </div>

                        <!-- Határidő -->
                        <div class="mb-4">
                            <label for="due_date" class="block text-gray-700">Határidő</label>
                            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Prioritás -->
                        <div class="mb-4">
                            <label for="priority" class="block text-gray-700">Prioritás</label>
                            <select name="priority" id="priority" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Alacsony</option>
                                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Közepes</option>
                                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Magas</option>
                            </select>
                        </div>

                        <!-- Státusz -->
                        <div class="mb-4">
                            <label for="status" class="block text-gray-700">Státusz</label>
                            <select name="status" id="status" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="todo" {{ old('status', $task->status) == 'todo' ? 'selected' : '' }}>Tennivaló</option>
                                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>Folyamatban</option>
                                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Kész</option>
                            </select>
                        </div>

                        <!-- Fájl feltöltése -->
                        <div class="mb-4">
                            <label for="file" class="block text-gray-700">Fájl feltöltése (opcionális)</label>
                            <input type="file" name="file" id="file" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Mentés -->
                        <div>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-black rounded-md shadow-md">
                                Mentés
                            </button>
                            <a href="{{ route('groups.tasks.index', $group->id) }}" class="px-4 py-2 bg-gray-500 text-white rounded-md shadow-md">
                                Mégse
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
