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
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('groups.create') }}"
                        >
                            {{ __('Új csoport létrehozása') }}
                        </a>
                    </div>

                    @if ($groups->isEmpty())
                    <p>{{ __('Nincsenek csoportok.') }}</p>
                    @else
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Név') }}</th>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Leírás') }}</th>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Csoportvezető') }}</th>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Tagok száma') }}</th>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Műveletek') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $group->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $group->description }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $group->leader->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $group->members->count() }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('groups.edit', $group) }}"
                                        class="">
                                        {{ __('Szerkesztés') }}
                                    </a>
                                    <form action="{{ route('groups.destroy', $group) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class=""
                                            onclick="return confirmDelete()">
                                            {{ __('Törlés') }}
                                        </button>

                                    </form>

                                </td>
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
