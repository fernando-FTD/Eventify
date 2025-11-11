<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Eventify') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-indigo-50 to-blue-100 dark:from-gray-900 dark:to-gray-800">
    <!-- 🌟 Fullscreen layout tanpa batas lebar -->
    <div class="min-h-screen">
        <!-- slot menampilkan isi halaman seperti hero & kategori -->
        {{ $slot }}
    </div>
</body>
</html>
