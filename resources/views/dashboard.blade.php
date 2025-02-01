<x-app-layout>


    <div class="relative min-h-screen bg-cover bg-center bg-no-repeat "
        style="background-image: url('{{ asset('images/team-task-management.png') }}')">
        <div class="py-12 bg-gray-900 bg-opacity-50 min-h-screen flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="relative py-12 min-h-screen flex justify-center items-center px-4 sm:px-6 lg:px-8">
                    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                            <h2 class="font-semibold text-xl text-black leading-tight text-center">
                                {{ $greeting }}
                            </h2>
                            <br>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ __('Üdvözlünk az alkamazásban!') }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        @media (max-width: 640px) {
            .bg-cover {
                background-size: contain;
            }
        }
    </style>


</x-app-layout>