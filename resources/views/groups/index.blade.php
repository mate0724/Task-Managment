<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.groups') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-2">
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ __('messages.groups') }}
                        </div>
                        @if (auth()->user()->role === 'admin')
                        <div>
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
                                    {{ __('messages.add') }}
                                </button>
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="mt-1 mb-6 text-sm font-normal text-gray-500 dark:text-gray-400">
                        {{ __('messages.welcome_groups') }}
                    </div>

                    @if ($groups->isEmpty())
                    <p>{{ __('messages.no_groups') }}</p>
                    @else
                    <!-- Desktop view (table) -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 px-4 py-2">{{ __('messages.name') }}</th>
                                    <th class="border border-gray-300 px-4 py-2">{{ __('messages.description') }}</th>
                                    <th class="border border-gray-300 px-4 py-2">{{ __('messages.group_leader') }}</th>
                                    <th class="border border-gray-300 px-4 py-2">{{ __('messages.members') }}</th>
                                    @if (auth()->user()->role === 'admin')
                                    <th class="border border-gray-300 px-4 py-2">{{ __('messages.edit') }}</th>
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
                                        {{ $group->members->pluck('name')->join(', ') }}
                                    </td>
                                    @if (auth()->user()->role === 'admin')
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <a href="{{ route('groups.edit', $group) }}">
                                            <x-primary-button class="mt-2 bg-blue-500 hover:bg-blue-600">
                                                {{ __('messages.edit') }}
                                            </x-primary-button>
                                        </a>
                                        <form action="{{ route('groups.destroy', $group) }}" method="POST" class="inline-block" id="delete-form-{{ $group->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="delete_button" onclick="showDeleteConfirmation({{ $group->id }}, '{{ $group->name }}')">
                                                {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile view (cards) -->
                    <div class="md:hidden space-y-4">
                        @foreach ($groups as $group)
                        <div class="bg-white rounded-lg shadow-md p-4 border border-gray-200">
                            <div class="mb-2">
                                <a href="{{ route('tasks.index', ['group' => $group->id]) }}" class="text-blue-500 hover:underline text-lg font-semibold">
                                    {{ $group->name }}
                                </a>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <span class="font-medium">{{ __('messages.description') }}:</span>
                                    <p class="mt-1">{{ $group->description }}</p>
                                </div>
                                <div>
                                    <span class="font-medium">{{ __('messages.group_leader') }}:</span>
                                    <p class="mt-1">{{ $group->leader->name }}</p>
                                </div>
                                <div>
                                    <span class="font-medium">{{ __('messages.members') }}:</span>
                                    <p class="mt-1">{{ $group->members->pluck('name')->join(', ') }}</p>
                                </div>
                                @if (auth()->user()->role === 'admin')
                                <div class="flex space-x-2 mt-4">
                                    <a href="{{ route('groups.edit', $group) }}">
                                        <x-primary-button class="bg-blue-500 hover:bg-blue-600">
                                            {{ __('messages.edit') }}
                                        </x-primary-button>
                                    </a>
                                    <form action="{{ route('groups.destroy', $group) }}" method="POST" id="delete-form-mobile-{{ $group->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete_button" onclick="showDeleteConfirmation({{ $group->id }}, '{{ $group->name }}')">
                                            {{ __('messages.delete') }}
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Delete Confirmation Modal -->
    <div id="deleteConfirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full custom-modal-width  mx-4">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Csoport törlése</h3>
                <p class="mt-2 text-gray-600" id="deleteConfirmationText">Biztosan törölni szeretnéd a csoportot?</p>
            </div>
            <div class="flex justify-end custom-button-spacing">
                <button id="cancelDeleteButton" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                    MÉGSE
                </button>
                <button id="confirmDeleteButton" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    TÖRLÉS
                </button>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let currentFormId = null;

    function showDeleteConfirmation(groupId, groupName) {
        
        currentFormId = groupId;
        
        if (groupName) {
            document.getElementById('deleteConfirmationText').textContent = `Biztosan törölni szeretnéd a(z) "${groupName}" csoportot?`;
        } else {
            document.getElementById('deleteConfirmationText').textContent = 'Biztosan törölni szeretnéd a csoportot?';
        }
        
        // Show the modal
        document.getElementById('deleteConfirmationModal').classList.remove('hidden');
    }

    
    document.addEventListener('DOMContentLoaded', function() {
        //Ha a felhasználó a "MÉGSE" gombra kattint, a modal ablak bezárul anélkül, hogy bármi történne
        document.getElementById('cancelDeleteButton').addEventListener('click', function() {
            document.getElementById('deleteConfirmationModal').classList.add('hidden');
        });
        
        //Ha a felhasználó a "TÖRLÉS" gombra kattint, a rendszer megkeresi a megfelelő form-ot a currentFormId alapján
        document.getElementById('confirmDeleteButton').addEventListener('click', function() {
            if (currentFormId !== null) {
                // A form lehet desktop vagy mobil nézethez tartozó (ezért van két különböző ID)
                const form = document.getElementById(`delete-form-${currentFormId}`) || 
                             document.getElementById(`delete-form-mobile-${currentFormId}`);
                
                if (form) {
                    form.submit();
                }
            }
            //A megtalált form-ot a kód programozottan beküldi a form.submit() utasítással
            //A form elküldése után a modal ablak bezárul
            document.getElementById('deleteConfirmationModal').classList.add('hidden');
        });
    });
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

    .custom-modal-width {
        max-width: 1000px; 
    }

    .custom-button-spacing {
        gap: 20px; 
    }
</style>