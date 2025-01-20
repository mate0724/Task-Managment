<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Csoport szerkesztése') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('groups.update', $group) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">{{ __('Csoport neve') }}</label>
                            <input type="text" name="name" id="name" value="{{ $group->name }}" 
                                   class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">{{ __('Leírás') }}</label>
                            <textarea name="description" id="description" rows="3" 
                                      class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ $group->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="leader_id" class="block text-gray-700">{{ __('Csoportvezető') }}</label>
                            <select name="leader_id" id="leader_id" 
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" 
                                            @if ($group->leader_id == $user->id) selected @endif>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="members" class="block text-gray-700">{{ __('Csoporttagok') }}</label>
                            <select name="members[]" id="members" multiple 
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" 
                                            @if ($group->members->contains($user->id)) selected @endif>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                {{ __('Mentés') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
