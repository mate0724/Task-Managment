<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('messages.create_task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('groups.tasks.store', $group) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="title">{{ __('messages.title') }}</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="description">{{ __('messages.description') }}</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="status">{{ __('messages.status') }}</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="todo">{{ __('messages.to_do') }}</option>
                                <option value="in_progress">{{ __('messages.in_progress') }}</option>
                                <option value="completed">{{ __('messages.completed') }}</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="priority">{{ __('messages.priority') }}</label>
                            <select name="priority" id="priority" class="form-control" required>
                                <option value="low">{{ __('messages.low') }}</option>
                                <option value="medium">{{ __('messages.medium') }}</option>
                                <option value="high">{{ __('messages.high') }}</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="due_date">{{ __('messages.deadline') }}</label>
                            <input type="date" name="due_date" id="due_date" class="form-control">
                        </div>

                        <div class="form-group mb-4">
                            <label for="file">{{ __('messages.file') }} ({{ __('messages.optional') }})</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>

                        <x-primary-button>{{ __('messages.save') }}</x-primary-button>
                        <!-- <button type="submit" class="btn btn-success">{{ __('messages.save') }}</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
