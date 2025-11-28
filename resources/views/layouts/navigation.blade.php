<nav x-data="{ open: false }" class="bg-indigo-700 border-b border-indigo-800 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('events.index') }}" class="text-2xl font-bold text-white hover:text-indigo-100 transition">
                        Eventify
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ml-10 sm:flex">
                    <!-- Dashboard - Available to all authenticated users -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-indigo-100 border-indigo-500">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Browse Events - Available to all authenticated users -->
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index') || request()->routeIs('events.show')" class="text-white hover:text-indigo-100 border-indigo-500">
                        {{ __('Browse Events') }}
                    </x-nav-link>

                    <!-- My Tickets - Available to all authenticated users -->
                    <x-nav-link :href="route('registrations.my-tickets')" :active="request()->routeIs('registrations.my-tickets')">
                        {{ __('My Tickets') }}
                    </x-nav-link>
                    
                    <!-- My Events - Only for Organizers and Admins -->
                    @if(auth()->user()->role === 'organizer' || auth()->user()->role === 'admin')
                        <x-nav-link :href="route('events.my-events')" :active="request()->routeIs('events.my-events') || request()->routeIs('events.create') || request()->routeIs('events.edit')">
                            {{ __('My Events') }}
                        </x-nav-link>
                    @endif
                    
                    <!-- Admin Panel - Only for Admins -->
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                            {{ __('Admin Panel') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Notifications -->
                <a href="{{ route('notifications.index') }}" class="relative mr-4 text-white hover:text-indigo-100 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span id="notifBadge" class="hidden absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold"></span>
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-indigo-100 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->nama }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Profile Link -->
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-indigo-100 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600 transition duration-150 ease-in-out">
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
            <!-- Dashboard -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-indigo-100 border-indigo-500">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Browse Events -->
            <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.index') || request()->routeIs('events.show')" class="text-white hover:text-indigo-100 border-indigo-500">
                {{ __('Browse Events') }}
            </x-responsive-nav-link>

            <!-- My Tickets -->
            <x-responsive-nav-link :href="route('registrations.my-tickets')" :active="request()->routeIs('registrations.my-tickets')">
                {{ __('My Tickets') }}
            </x-responsive-nav-link>
            
            <!-- My Events - Only for Organizers and Admins -->
            @if(auth()->user()->role === 'organizer' || auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('events.my-events')" :active="request()->routeIs('events.my-events') || request()->routeIs('events.create') || request()->routeIs('events.edit')">
                    {{ __('My Events') }}
                </x-responsive-nav-link>
            @endif
            
            <!-- Admin Panel - Only for Admins -->
            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                    {{ __('Admin Panel') }}
                </x-responsive-nav-link>
            @endif
            
            <!-- Notifications -->
            <x-responsive-nav-link :href="route('notifications.index')" :active="request()->routeIs('notifications.index')">
                {{ __('Notifications') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->nama }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Profile -->
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    // Poll for unread notifications
    function updateNotificationBadge() {
        fetch('{{ route('notifications.unread-count') }}')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('notifBadge');
                if (data.count > 0) {
                    badge.textContent = data.count > 9 ? '9+' : data.count;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error fetching notification count:', error);
            });
    }

    // Update badge on page load
    updateNotificationBadge();

    // Poll every 30 seconds
    setInterval(updateNotificationBadge, 30000);
</script>
@endpush
