<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.group') }}{{ $group->name }} - {{ __('messages.tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                        @if (auth()->id() === $group->leader_id)
                        <x-primary-button class="mb-4 sm:mb-0 flex items-center justify-center h-10">
                            <a href="{{ route('groups.tasks.create', $group) }}" class="text-center">{{ __('messages.create_task') }}</a>
                        </x-primary-button>
                        @endif

                        <div class="flex flex-col sm:flex-row gap-3 items-center">
                            <div class="flex flex-wrap gap-3">
                                <button type="button" id="filter-low" class="filter-btn flex items-center px-4 py-2 border rounded-lg shadow-sm text-sm font-medium bg-white hover:bg-gray-50 transition-all duration-200 gap-3">
                                    <img src="{{ asset('images/low-priority.png') }}" alt="Alacsony" class="w-5 h-5 mr-2">
                                    {{ __('messages.low') }}
                                </button>
                                <button type="button" id="filter-medium" class="filter-btn flex items-center px-4 py-2 border rounded-lg shadow-sm text-sm font-medium bg-white hover:bg-gray-50 transition-all duration-200 gap-3">
                                    <img src="{{ asset('images/medium-priority.png') }}" alt="Közepes" class="w-5 h-5 mr-1">
                                    {{ __('messages.medium') }}
                                </button>
                                <button type="button" id="filter-high" class="filter-btn flex items-center px-4 py-2 border rounded-lg shadow-sm text-sm font-medium bg-white hover:bg-gray-50 transition-all duration-200 gap-3">
                                    <img src="{{ asset('images/high-priority.png') }}" alt="Magas" class="w-5 h-5 mr-1">
                                    {{ __('messages.high') }}
                                </button>
                                <button type="button" id="filter-all" class="filter-btn flex items-center px-4 py-2 border rounded-lg shadow-sm text-sm font-medium bg-white hover:bg-gray-50 transition-all duration-200 gap-3">
                                    <img src="{{ asset('images/all.png') }}" alt="Közepes" class="w-5 h-5 mr-1">
                                    {{ __('messages.all') }}
                                </button>
                            </div>

                            <!-- Lejárt feladatok megjelenítése/elrejtése gomb -->
                            <button type="button" id="toggle-overdue" class="ml-0 sm:ml-4 mt-2 sm:mt-0 px-4 py-2 border rounded-lg shadow-sm text-sm font-medium bg-white hover:bg-gray-50 transition-all duration-200 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform" id="toggle-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                                <span id="toggle-text">{{ __('messages.hide_expired_tasks') }}</span>
                                <span id="overdue-count" class="inline-flex items-center justify-center w-6 h-6 ml-1 text-xs font-medium text-white bg-red-500 rounded-full"></span>
                            </button>
                        </div>
                    </div>

                    @if ($tasks->isEmpty())
                    <div class="bg-gray-50 p-4 rounded-md text-center">
                        <p>{{ __('messages.no_tasks') }}</p>
                    </div>
                    @else
                    <div id="tasks-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($tasks as $task)
                        <div class="task-card border rounded-lg shadow-sm overflow-hidden {{ $task->due_date && strtotime($task->due_date) < strtotime(date('Y-m-d')) ? 'overdue-task' : '' }}"
                            data-priority="{{ $task->priority }}"
                            data-due-date="{{ $task->due_date ?? '9999-12-31' }}"
                            data-status="{{ $task->status }}"
                            data-is-overdue="{{ $task->due_date && strtotime($task->due_date) < strtotime(date('Y-m-d')) ? 'true' : 'false' }}">

                            <div class="bg-{{ $task->priority === 'high' ? 'red-100' : ($task->priority === 'medium' ? 'yellow-100' : 'green-100') }} px-4 py-2 flex justify-between items-center">
                                <h3 class="font-bold truncate flex-1">{{ $task->title }}</h3>
                                <span class="flex-shrink-0">
                                    <img src="{{ asset('images/' . $task->priority . '-priority.png') }}"
                                        alt="{{ ucfirst($task->priority) }}"
                                        class="w-6 h-6 inline-block">
                                </span>
                            </div>

                            <div class="p-4">
                                <p class="text-gray-600 mb-3 line-clamp-2">{{ $task->description }}</p>
                                <div class="space-y-2 text-sm">
                                    <p>
                                        <span class="font-medium">{{ __('messages.deadline') }}:</span>
                                        <span class="{{ $task->due_date && strtotime($task->due_date) < strtotime(date('Y-m-d')) ? 'text-red-600 font-semibold' : ($task->due_date && strtotime($task->due_date) == strtotime(date('Y-m-d')) ? 'text-orange-600 font-semibold' : '') }}">
                                            {{ $task->due_date ? date('Y.m.d', strtotime($task->due_date)) : __('Nincs megadva') }}
                                            @if($task->due_date && strtotime($task->due_date) < strtotime(date('Y-m-d')))
                                                <span class="ml-1 text-red-600">{{ __('messages.expired') }}</span>
                                            @elseif($task->due_date && strtotime($task->due_date) == strtotime(date('Y-m-d')))
                                                <span class="ml-1 text-orange-600">{{ __('messages.today') }}</span>
                                            @endif
                                        </span>
                                    </p>
                                    <p>
                                        <span class="font-medium">{{ __('messages.status') }}:</span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                          ($task->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </p>

                                    @if ($task->file_path)
                                    <p>
                                        <a href="{{ asset('storage/' . $task->file_path) }}" target="_blank" class="text-blue-500 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                            </svg>
                                            {{ __('messages.file') }}
                                        </a>
                                    </p>
                                    @endif
                                </div>


                                <div class="mt-4 flex flex-wrap gap-2">
                                    <a href="{{ route('groups.tasks.show', [$group->id, $task->id]) }}"
                                        class="action-btn px-4 py-2 bg-blue-600 text-black rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm shadow-md">
                                        {{ __('messages.comments') }}
                                    </a>

                                    @if (auth()->id() === $group->leader_id)
                                    <a href="{{ route('groups.tasks.edit', [$group, $task]) }}"
                                    class="action-btn px-4 py-2 bg-blue-600 text-black rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm shadow-md">
                                        {{ __('messages.edit') }}
                                    </a>
                                    <form action="{{ route('groups.tasks.destroy', [$group, $task]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-btn px-4 py-2 bg-blue-600 text-black rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm shadow-md" type="submit">
                                            {{ __('messages.delete') }}
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tasksContainer = document.getElementById('tasks-container');
            const filterLow = document.getElementById('filter-low');
            const filterMedium = document.getElementById('filter-medium');
            const filterHigh = document.getElementById('filter-high');
            const filterAll = document.getElementById('filter-all');
            const toggleOverdue = document.getElementById('toggle-overdue');
            const toggleIcon = document.getElementById('toggle-icon');
            const toggleText = document.getElementById('toggle-text');
            const overdueCount = document.getElementById('overdue-count');
            
            let currentFilter = 'all';
            let showOverdue = true;

            // Számoljuk meg a lejárt feladatokat
            function updateOverdueCount() {
                const overdueTasks = document.querySelectorAll('.task-card[data-is-overdue="true"]');
                overdueCount.textContent = overdueTasks.length;
                return overdueTasks.length;
            }

            
            const overdueTaskCount = updateOverdueCount();
            if (overdueTaskCount === 0) {
                toggleOverdue.style.display = 'none'; // Ha nincs lejárt feladat, ne jelenjen meg a gomb
            }

            function applyFiltersAndSort() {
                const taskCards = document.querySelectorAll('.task-card');

                taskCards.forEach(card => {
                    
                    let shouldDisplay = true;
                    
                    
                    const cardPriority = card.dataset.priority;
                    if (currentFilter !== 'all' && currentFilter !== cardPriority) {
                        shouldDisplay = false;
                    }
                    
                    
                    const isOverdue = card.dataset.isOverdue === 'true';
                    if (!showOverdue && isOverdue) {
                        shouldDisplay = false;
                    }
                    
                    
                    card.style.display = shouldDisplay ? '' : 'none';
                });
            }

            // Priority Filter eseményfigyelők
            filterLow.addEventListener('click', () => {
                currentFilter = 'low';
                updateFilterButtonStyles();
                applyFiltersAndSort();
            });

            filterMedium.addEventListener('click', () => {
                currentFilter = 'medium';
                updateFilterButtonStyles();
                applyFiltersAndSort();
            });

            filterHigh.addEventListener('click', () => {
                currentFilter = 'high';
                updateFilterButtonStyles();
                applyFiltersAndSort();
            });

            filterAll.addEventListener('click', () => {
                currentFilter = 'all';
                updateFilterButtonStyles();
                applyFiltersAndSort();
            });

            // Lejárt feladatok megjelenítése/elrejtése
            toggleOverdue.addEventListener('click', () => {
                showOverdue = !showOverdue;
                
                
                if (showOverdue) {
                    toggleIcon.classList.remove('rotate-180');
                    toggleText.textContent = '{{ __('messages.hide_expired_tasks') }}';
                } else {
                    toggleIcon.classList.add('rotate-180');
                    toggleText.textContent = '{{ __('messages.show_expired_tasks') }}';
                }
                
                applyFiltersAndSort();
            });

            function updateFilterButtonStyles() {
                // Minden gomb alaphelyzetbe állítása
                [filterLow, filterMedium, filterHigh, filterAll].forEach(btn => {
                    btn.classList.remove('bg-blue-100', 'border-blue-300');
                    btn.classList.add('bg-gray-50');
                });

                // Aktív szűrő kiemelése
                const activeBtn = {
                    'low': filterLow,
                    'medium': filterMedium,
                    'high': filterHigh,
                    'all': filterAll
                } [currentFilter];

                if (activeBtn) {
                    activeBtn.classList.remove('bg-gray-50');
                    activeBtn.classList.add('bg-blue-100', 'border-blue-300');
                }
            }

           
            updateFilterButtonStyles();
            applyFiltersAndSort();
        });
    </script>
</x-app-layout>