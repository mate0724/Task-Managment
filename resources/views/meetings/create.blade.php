<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Meeting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('meetings.store') }}">
                        @csrf

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" class="block mt-1 w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-gray-100" name="description" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Scheduled Date and Time -->
                        <div class="mt-4">
                            <x-input-label for="scheduled_at" :value="__('Scheduled At')" />
                            <x-text-input id="scheduled_at" class="block mt-1 w-full" type="datetime-local" name="scheduled_at" :value="old('scheduled_at')" required />
                            <x-input-error :messages="$errors->get('scheduled_at')" class="mt-2" />
                        </div>

                        <!-- Location -->
                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- Attendees -->
                        <div class="mt-4">
                            <x-input-label for="attendees" :value="__('Attendees')" />
                            <select id="attendees" class="block mt-1 w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-gray-100" name="attendees[]" multiple>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('attendees')" class="mt-2" />
                            <small class="text-gray-500 dark:text-gray-400">Hold down the Ctrl (Windows) or Command (Mac) button to select multiple attendees.</small>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Create Meeting') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
