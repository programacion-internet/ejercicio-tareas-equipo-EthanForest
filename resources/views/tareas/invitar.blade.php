
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight bg-gray-800 py-2 px-4 rounded-md">
            Invitar Usuario a Tarea: {{ $tarea->titulo }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700 text-white">
                    <form method="POST" action="{{ route('tareas.invitar.enviar', $tarea->id) }}">
                        @csrf

                        <div>
                            <x-label for="email" :value="__('Correo Electrónico del Usuario a Invitar')" class="text-gray-300" />
                            <x-input id="email" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4 bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Invitar Usuario') }}
                            </x-button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('tareas.show', $tarea->id) }}" class="text-gray-400 hover:text-gray-300">Volver a la Tarea</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    body {
        background-color: #121212; /* Un fondo oscuro para toda la página (opcional, si x-app-layout no lo define) */
        color: #fff; /* Texto blanco por defecto (si x-app-layout no lo define) */
    }
</style>