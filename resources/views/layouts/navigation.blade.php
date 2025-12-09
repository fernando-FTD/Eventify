<nav x-data="{ open: false }" class="bg-indigo-700 border-b border-indigo-800 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center text-2xl font-bold text-white hover:text-indigo-100 transition">
                        @else
                            <a href="{{ route('dashboard') }}" class="flex items-center text-2xl font-bold text-white hover:text-indigo-100 transition">
                        @endif
                    @else
                        <a href="{{ url('/') }}" class="flex items-center text-2xl font-bold text-white hover:text-indigo-100 transition">
                    @endauth
                        <svg class="w-8 h-8 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zM9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm-8 4H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/>
                        </svg>
                        Eventify
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                        <!-- Dashboard - Redirect based on role -->
                        @if(auth()->user()->role === 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-white hover:text-indigo-100 border-indigo-500">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-indigo-100 border-indigo-500">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        @endif
                    @endauth

                    <!-- Browse Events - Available to all users -->
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index') || request()->routeIs('events.show')" class="text-white hover:text-indigo-100 border-indigo-500">
                        {{ __('Browse Events') }}
                    </x-nav-link>

                    @auth
                        <!-- My Tickets - Available to all authenticated users -->
                        <x-nav-link :href="route('registrations.my-tickets')" :active="request()->routeIs('registrations.my-tickets')" class="text-white hover:text-indigo-100 border-indigo-500">
                            {{ __('My Tickets') }}
                        </x-nav-link>
                        
                        <!-- My Events - Only for Organizers and Admins -->
                        @if(auth()->user()->role === 'organizer' || auth()->user()->role === 'admin')
                            <x-nav-link :href="route('organizer.events')" :active="request()->routeIs('organizer.events') || request()->routeIs('organizer.events.*')" class="text-white hover:text-indigo-100 border-indigo-500">
                                {{ __('My Events') }}
                            </x-nav-link>
                        @endif
                        
                        <!-- Admin Panel - Only for Admins (Verifikasi Event & Users) -->
                        @if(auth()->user()->role === 'admin')
                            <x-nav-link :href="route('admin.events')" :active="request()->routeIs('admin.events')" class="text-white hover:text-indigo-100 border-indigo-500">
                                {{ __('Verifikasi Event') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')" class="text-white hover:text-indigo-100 border-indigo-500">
                                {{ __('Kelola Users') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown / Login Buttons -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
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
                @else
                    <!-- Guest Links -->
                    <a href="{{ route('login') }}" class="text-white hover:text-indigo-100 font-medium mr-4">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-indigo-700 font-semibold rounded-lg hover:bg-indigo-50 transition">Daftar</a>
                @endauth
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
            @auth
                <!-- Dashboard - Redirect based on role -->
                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-white hover:text-indigo-100 border-indigo-500">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-indigo-100 border-indigo-500">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @endif
            @endauth

            <!-- Browse Events -->
            <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.index') || request()->routeIs('events.show')" class="text-white hover:text-indigo-100 border-indigo-500">
                {{ __('Browse Events') }}
            </x-responsive-nav-link>

            @auth
                <!-- My Tickets -->
                <x-responsive-nav-link :href="route('registrations.my-tickets')" :active="request()->routeIs('registrations.my-tickets')" class="text-white hover:text-indigo-100 border-indigo-500">
                    {{ __('My Tickets') }}
                </x-responsive-nav-link>
                
                <!-- My Events - Only for Organizers and Admins -->
                @if(auth()->user()->role === 'organizer' || auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="route('organizer.events')" :active="request()->routeIs('organizer.events') || request()->routeIs('organizer.events.*')" class="text-white hover:text-indigo-100 border-indigo-500">
                        {{ __('My Events') }}
                    </x-responsive-nav-link>
                @endif
                
                <!-- Admin Menu - Only for Admins -->
                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.events')" :active="request()->routeIs('admin.events')" class="text-white hover:text-indigo-100 border-indigo-500">
                        {{ __('Verifikasi Event') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')" class="text-white hover:text-indigo-100 border-indigo-500">
                        {{ __('Kelola Users') }}
                    </x-responsive-nav-link>
                @endif
                
                <!-- Notifications -->
                <x-responsive-nav-link :href="route('notifications.index')" :active="request()->routeIs('notifications.index')" class="text-white hover:text-indigo-100 border-indigo-500">
                    {{ __('Notifications') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-indigo-600">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->nama }}</div>
                    <div class="font-medium text-sm text-indigo-200">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Profile -->
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:text-indigo-100">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-white hover:text-indigo-100">
                            {{ __('Logout') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <!-- Guest Mobile Links -->
            <div class="pt-4 pb-3 border-t border-indigo-600 space-y-1">
                <x-responsive-nav-link :href="route('login')" class="text-white hover:text-indigo-100">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" class="text-white hover:text-indigo-100">
                    {{ __('Daftar') }}
                </x-responsive-nav-link>
            </div>
        @endauth
    </div>
</nav>

@auth
@push('scripts')
<script>
    // Poll for unread notifications
    function updateNotificationBadge() {
        fetch('{{ route('notifications.unread-count') }}')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('notifBadge');
                if (badge) {
                    if (data.count > 0) {
                        badge.textContent = data.count > 9 ? '9+' : data.count;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
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
@endauth
