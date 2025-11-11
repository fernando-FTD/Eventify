<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Eventify') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-indigo-600 text-white shadow">
            <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
                <a href="/" class="text-2xl font-bold">Eventify</a>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="hover:text-yellow-300">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-yellow-300">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow p-6">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-indigo-700 text-center text-white py-4">
            <p>&copy; {{ date('Y') }} Eventify. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
