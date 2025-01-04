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

                   

                    <!-- Kereső és Export gomb -->
                    <div class="flex justify-between items-center mb-4">
                        <form method="GET" action="{{ route('users.index') }}">
                            <x-text-input name="search" type="text" value="{{ old('search', $search) }}" placeholder="Search" />
                            <x-primary-button class="mt-2">{{ __('Search') }}</x-primary-button>
                        </form>
                        <a href="{{ route('users.export') }}" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <x-primary-button class="mt-2">{{ __('Export') }}</x-primary-button>
                        </a>


                    </div>



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
                                    <a href="{{ route('users.edit', $user->id) }}" <x-primary-button class="mt-2 bg-blue-500 hover:bg-blue-600">{{ __('Edit') }}</x-primary-button></a>
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete_button">{{ __('Delete') }}</button>
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

    <style>
        /* From Uiverse.io by virus231 */
        .delete_button {
            background: linear-gradient(140.14deg, #ec540e 15.05%, #d6361f 114.99%) padding-box,
                linear-gradient(142.51deg, #ff9465 8.65%, #af1905 88.82%) border-box;
            border-radius: 7px;
            border: 2px solid transparent;

            text-shadow: 1px 1px 1px #00000040;
            /*box-shadow: 8px 8px 20px 0px #45090059;*/
            height: 35px;
            padding: 10px 15px;
            line-height: 10px;
            cursor: pointer;
            transition: all 0.3s;
            color: white;
            font-size: 18px;
            font-weight: 500;
        }

        .button:hover {
            box-shadow: none;
            opacity: 80%;
        }

        
    </style>
</x-app-layout>