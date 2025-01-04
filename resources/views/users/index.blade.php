<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users List') }}
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

                    <!-- Keresés -->
                    <form method="GET" action="{{ route('users.index') }}" class="mb-4">
                        <x-text-input name="search" class="block mt-1 w-full" type="text" value="{{ old('search', $search) }}" placeholder="Search by name or email" />
                        <x-primary-button class="mt-2">{{ __('Search') }}</x-primary-button>
                    </form>

                    <!-- Tagok listázása -->
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">{{ __('Name') }}</th>
                                <th class="px-4 py-2">{{ __('Email') }}</th>
                                <th class="px-4 py-2">{{ __('Job Title') }}</th>
                                <th class="px-4 py-2">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2">{{ $user->job_title }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700">{{ __('Edit') }}</a>
                                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Lapozás -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
