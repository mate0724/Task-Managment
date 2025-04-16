<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Értesítések') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Értesítések listája') }}</h3>

                    @if ($notifications->isEmpty())
                    <p class="text-gray-500">{{ __('Nincsenek új értesítések.') }}</p>
                    @else
                    <ul class="divide-y divide-gray-200">
                        @foreach ($notifications as $notification)
                        <li class="py-2">
                            <div class="flex justify-between items-center">
                                <span>{{ $notification->data['message'] ?? __('Új értesítés') }}</span>
                                <small class="text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <div class="mt-4">
                        {{ $notifications->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>