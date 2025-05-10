<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tareas en Equipo</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 flex justify-center items-center min-h-screen m-0 text-gray-900 dark:text-gray-300">
    <div class="bg-white dark:bg-gray-800 text-center p-10 rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-5">Bienvenido a Tareas en Equipo</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">Una plataforma para la gestión colaborativa de tareas.</p>
        <div class="flex justify-center space-x-4">
            @auth
                <a href="{{ route('tareas.index') }}" class="inline-block px-5 py-3 border border-gray-300 dark:border-gray-700 rounded-md text-gray-800 dark:text-gray-400 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">Mis Tareas</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                   class="inline-block px-5 py-3 border border-gray-300 dark:border-gray-700 rounded-md text-gray-800 dark:text-gray-400 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">
                    {{ __('Logout') }}
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-block px-5 py-3 border border-gray-300 dark:border-gray-700 rounded-md text-gray-800 dark:text-gray-400 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="inline-block px-5 py-3 border border-gray-300 dark:border-gray-700 rounded-md text-gray-800 dark:text-gray-400 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">Registrarse</a>
            @endauth
        </div>
    </div>
</body>
</html>