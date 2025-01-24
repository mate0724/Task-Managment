<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Csoportok') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (auth()->user()->role === 'admin')
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('groups.create') }}">
                            {{ __('Add Group') }}
                        </a>
                    </div>
                    @endif
                    @if ($groups->isEmpty())
                    <p>{{ __('There are no groups.') }}</p>
                    @else
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Név') }}</th>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Leírás') }}</th>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Csoportvezető') }}</th>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Tagok') }}</th>
                                @if (auth()->user()->role === 'admin')
                                <th class="border border-gray-300 px-4 py-2">{{ __('Műveletek') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                            <tr>
                                <td>
                                    <a href="{{ route('tasks.index', ['group' => $group->id]) }}" class="text-blue-500 hover:underline">
                                        {{ $group->name }}
                                    </a>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{ $group->description }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $group->leader->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <!-- Tagok neveinek felsorolása, vesszővel elválasztva -->
                                    {{ $group->members->pluck('name')->join(', ') }}
                                </td>
                                @if (auth()->user()->role === 'admin')
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('groups.edit', $group) }}" class="text-blue-500 hover:underline">
                                        {{ __('Szerkesztés') }}
                                    </a>
                                    <form action="{{ route('groups.destroy', $group) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirmDelete()">
                                            {{ __('Törlés') }}
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete() {
        return confirm('Biztosan törölni szeretnéd a csoportot?');
    }
</script>