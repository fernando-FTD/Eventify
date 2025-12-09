<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Eventify') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-indigo-50 to-blue-100 dark:from-gray-900 dark:to-gray-800">
    <div class="min-h-screen flex flex-col justify-center items-center p-6">
        <div class="w-full max-w-md bg-white dark:bg-gray-900 shadow-2xl rounded-2xl p-8">
            <div class="mb-6 text-center">
                <a href="/" class="text-3xl font-extrabold text-indigo-600">Eventify</a>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    Temukan & ikuti event kampus dan kota dengan mudah.
                </p>
            </div>
            {{ $slot }}
        </div>
    </div>
</body>
</html>
