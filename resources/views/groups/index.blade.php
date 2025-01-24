<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Groups') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (auth()->user()->role === 'admin')






                    <div class="flex justify-end mb-4">
                        <a href="{{ route('groups.create') }}">
                            <button class="add_group_button">
                                <svg
                                    aria-hidden="true"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        stroke-width="2"
                                        stroke="#fffffff"
                                        d="M13.5 3H12H8C6.34315 3 5 4.34315 5 6V18C5 19.6569 6.34315 21 8 21H11M13.5 3L19 8.625M13.5 3V7.625C13.5 8.17728 13.9477 8.625 14.5 8.625H19M19 8.625V11.8125"
                                        stroke-linejoin="round"
                                        stroke-linecap="round"></path>
                                    <path
                                        stroke-linejoin="round"
                                        stroke-linecap="round"
                                        stroke-width="2"
                                        stroke="#fffffff"
                                        d="M17 15V18M17 21V18M17 18H14M17 18H20"></path>
                                </svg>
                                {{ __('Add Group') }}
                            </button>
                        </a>
                    </div>
                    @endif
                    @if ($groups->isEmpty())
                    <p>{{ __('There are no groups.') }}</p>
                    @else
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Name') }}</th>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Description') }}</th>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Group Leader') }}</th>
                                <th class="border border-gray-300 px-4 py-2">{{ __('Members') }}</th>
                                @if (auth()->user()->role === 'admin')
                                <th class="border border-gray-300 px-4 py-2">{{ __('Edit') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <a href="{{ route('tasks.index', ['group' => $group->id]) }}" class="text-blue-500 hover:underline">
                                        {{ $group->name }}
                                    </a>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $group->description }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $group->leader->name }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <!-- Tagok neveinek felsorolása, vesszővel elválasztva -->
                                    {{ $group->members->pluck('name')->join(', ') }}
                                </td>
                                @if (auth()->user()->role === 'admin')
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <a href="{{ route('groups.edit', $group) }}" <x-primary-button class="mt-2 bg-blue-500 hover:bg-blue-600">
                                        {{ __('Edit') }}</x-primary-button>
                                    </a>
                                    <form action="{{ route('groups.destroy', $group) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete_button" onclick="return confirmDelete()">
                                            {{ __('Delete') }}
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

<style>
    .delete_button {
        background: linear-gradient(140.14deg, rgb(194, 63, 3) 15.05%, #d6361f 114.99%) padding-box,
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

    .delete-button:hover {
        box-shadow: none;
        opacity: 80%;
    }


    .add_group_button {
        border: none;
        display: flex;
        padding: 0.65rem 1.25rem;
        background-color: rgb(116, 26, 201);
        color: #ffffff;
        font-size: 0.75rem;
        line-height: 1rem;
        font-weight: 700;
        text-align: center;
        cursor: pointer;
        text-transform: uppercase;
        vertical-align: middle;
        align-items: center;
        border-radius: 0.5rem;
        user-select: none;
        gap: 0.75rem;
        box-shadow:
            0 4px 6px -1px #488aec31,
            0 2px 4px -1px #488aec17;
        transition: all 0.6s ease;
    }

    .add_group_button:hover {
        box-shadow:
            0 10px 15px -3px #488aec4f,
            0 4px 6px -2px #488aec17;
    }

    .add_group_button:focus,
    .add_group_button:active {
        opacity: 0.85;
        box-shadow: none;
    }

    .add_group_button svg {
        width: 1.25rem;
        height: 1.25rem;
    }
</style>