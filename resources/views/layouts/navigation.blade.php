<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">

                        <img src="{{ asset('/images/logo3.png') }}" class="block h-9 w-auto fill-current" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <img src="{{ asset('images/home.png') }}" alt="Icon" style="margin-right: 10px;" class="inline-block w-5 h-5">

                        {{ __('messages.home') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('groups.index') " :active="request()->routeIs('dashboard')">
                        <img src="{{ asset('images/group.png') }}" alt="Icon" style="margin-right: 10px;" class="inline-block w-5 h-5">
                        {{ __('messages.groups') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('users.index') " :active="request()->routeIs('dashboard')">
                        <img src="{{ asset('images/user.png') }}" alt="Icon" style="margin-right: 10px;" class="inline-block w-5 h-5"> {{ __('messages.users') }}
                    </x-nav-link>
                </div>


                <!-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('tasks.index', ['group' => Auth::user()->group_id ?? 1])"
                        :active="request()->routeIs('tasks.index')">
                        {{ __('My Tasks') }}
                    </x-nav-link>
                </div> -->

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('meetings.index') " :active="request()->routeIs('dashboard')">
                        <img src="{{ asset('images/meeting.png') }}" alt="Icon" style="margin-right: 10px;" class="inline-block w-5 h-5">
                        {{ __('messages.meetings') }}
                    </x-nav-link>
                </div>



            </div>







            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">



                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <i class="fa fa-bell"></i>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                            <span id="unread-count" class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                            @endif
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if (auth()->user()->unreadNotifications->count())
                        <div class="px-4 py-2 text-right">
                            <a href="{{ route('notifications.markAsRead') }}" class="btn btn-primary btn-sm">{{ __('Mindet olvasottnak jelöl') }}</a>
                        </div>
                        @endif

                        <div class="max-h-60 overflow-y-auto">
                            @php
                            $latestNotifications = auth()->user()->notifications()->latest()->take(3)->get();
                            @endphp

                            @foreach($latestNotifications as $notification)
                            @if($notification->read_at === null)
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="notification-item w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    {{ $notification->data['message'] }}
                                </button>
                            </form>
                            @else
                            <x-dropdown-link :href="$notification->data['url'] ?? '#'" class="text-secondary">
                                {{ $notification->data['message'] }}
                            </x-dropdown-link>
                            @endif
                            @endforeach

                            <!-- Ha van több értesítés, mutassunk egy "Összes megtekintése" gombot -->
                            @if(auth()->user()->notifications()->count() > 3)
                            <div class="px-4 py-2 text-center border-t">
                                <a href="{{ route('notifications.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                                    {{ __('messages.view_all') }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </x-slot>
                </x-dropdown>


                <!-- Nyelvválasztó dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <img src="{{ asset('images/languages.png') }}" alt="Icon" style="margin-right: 10px;" class="inline-block w-6 h-6">
                            <div>{{ __('messages.language') }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="url('locale/en')" class="flex items-center space-x-2">
                            <img src="{{ asset('images/flags/en.png') }}" alt="English" style="margin-right: 10px;" class="inline w-5 h-5 rounded-full">

                            {{ __('messages.english') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="url('locale/es')" class="flex items-center space-x-2">
                            <img src="{{ asset('images/flags/es.png') }}" alt="English" style="margin-right: 10px;" class="inline w-5 h-5 rounded-full">
                            {{ __('messages.spanish') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="url('locale/fr')" class="flex items-center space-x-2">
                            <img src="{{ asset('images/flags/fr.png') }}" alt="English" style="margin-right: 10px;" class="inline w-5 h-5 rounded-full">
                            {{ __('messages.french') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="url('locale/de')" class="flex items-center space-x-2">
                            <img src="{{ asset('images/flags/de.png') }}" alt="English" style="margin-right: 10px;" class="inline w-5 h-5 rounded-full">
                            {{ __('messages.german') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="url('locale/hu')" class="flex items-center space-x-2">
                            <img src="{{ asset('images/flags/hu.png') }}" alt="English" style="margin-right: 10px;" class="inline w-5 h-5 rounded-full">
                            {{ __('messages.hungarian') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>




                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <img src="{{ asset('images/home.png') }}" alt="Icon" style="margin-right: 10px;" class="inline-block w-5 h-5">
                {{ __('messages.home') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('groups.index')" :active="request()->routeIs('dashboard')">
                <img src="{{ asset('images/group.png') }}" alt="Icon" style="margin-right: 10px;" class="inline-block w-5 h-5">
                {{ __('messages.groups') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('dashboard')">
                <img src="{{ asset('images/user.png') }}" alt="Icon" style="margin-right: 10px;" class="inline-block w-5 h-5">
                {{ __('messages.users') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('meetings.index')" :active="request()->routeIs('dashboard')">
                <img src="{{ asset('images/meeting.png') }}" alt="Icon" style="margin-right: 10px;" class="inline-block w-5 h-5">
                {{ __('messages.meetings') }}
            </x-responsive-nav-link>
        </div>

        <!-- Reszponzív Nyelvválasztó dropdown -->
        <div class="pt-2 pb-3 space-y-1">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <x-responsive-nav-link href="#" class="flex items-center w-full">
                        <img src="{{ asset('images/languages.png') }}" alt="Icon" style="margin-right: 10px;" class="inline-block w-5 h-5">
                        {{ __('messages.language') }}
                        <svg class="fill-current h-4 w-4 ml-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </x-responsive-nav-link>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="url('locale/en')" class="flex items-center space-x-2">
                        <img src="{{ asset('images/flags/en.png') }}" alt="English" style="margin-right: 10px;" class="inline w-5 h-5 rounded-full">
                        {{ __('messages.english') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="url('locale/es')" class="flex items-center space-x-2">
                        <img src="{{ asset('images/flags/es.png') }}" alt="English" style="margin-right: 10px;" class="inline w-5 h-5 rounded-full">
                        {{ __('messages.spanish') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="url('locale/fr')" class="flex items-center space-x-2">
                        <img src="{{ asset('images/flags/fr.png') }}" alt="English" style="margin-right: 10px;" class="inline w-5 h-5 rounded-full">
                        {{ __('messages.french') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="url('locale/de')" class="flex items-center space-x-2">
                        <img src="{{ asset('images/flags/de.png') }}" alt="English" style="margin-right: 10px;" class="inline w-5 h-5 rounded-full">
                        {{ __('messages.german') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="url('locale/hu')" class="flex items-center space-x-2">
                        <img src="{{ asset('images/flags/hu.png') }}" alt="English" style="margin-right: 10px;" class="inline w-5 h-5 rounded-full">
                        {{ __('messages.hungarian') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>



        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>