<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.create_task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="p-8 sm:p-12">  <!-- Növelt padding -->
                    <form action="{{ route('groups.tasks.store', $group) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                {{ __('messages.title') }}
                            </label>
                            <input type="text" name="title" id="title" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required>
                        </div>

                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                {{ __('messages.description') }}
                            </label>
                            <textarea name="description" id="description" rows="4"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required></textarea>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label for="status" class="block text-sm font-medium text-gray-700">
                                    {{ __('messages.status') }}
                                </label>
                                <select name="status" id="status" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    required>
                                    <option value="todo">{{ __('messages.to_do') }}</option>
                                    <option value="in_progress">{{ __('messages.in_progress') }}</option>
                                    <option value="completed">{{ __('messages.completed') }}</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label for="priority" class="block text-sm font-medium text-gray-700">
                                    {{ __('messages.priority') }}
                                </label>
                                <select name="priority" id="priority"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    required>
                                    <option value="low">{{ __('messages.low') }}</option>
                                    <option value="medium">{{ __('messages.medium') }}</option>
                                    <option value="high">{{ __('messages.high') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="due_date" class="block text-sm font-medium text-gray-700">
                                {{ __('messages.deadline') }}
                            </label>
                            <input type="date" name="due_date" id="due_date"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div class="space-y-2">
                            <label for="file" class="block text-sm font-medium text-gray-700">
                                {{ __('messages.file') }} <span class="text-gray-500">({{ __('messages.optional') }})</span>
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>{{ __('messages.file') }}</span>
                                            <input id="file" name="file" type="file" class="sr-only">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end pt-6">
                            <x-primary-button class="ml-3">
                                {{ __('messages.save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>