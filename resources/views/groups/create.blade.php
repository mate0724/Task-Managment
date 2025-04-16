<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.create_group') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('groups.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">{{ __('messages.group_name') }}</label>
                            <input type="text" name="name" id="name" 
                                   class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">{{ __('messages.description') }}</label>
                            <textarea name="description" id="description" rows="3" 
                                      class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="leader_id" class="block text-gray-700">{{ __('messages.group_leader') }}</label>
                            <select name="leader_id" id="leader_id" 
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="members" class="block text-gray-700">{{ __('messages.members') }}</label>
                            <select name="members[]" id="members" multiple 
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button class="mt-2">{{ __('messages.create') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
