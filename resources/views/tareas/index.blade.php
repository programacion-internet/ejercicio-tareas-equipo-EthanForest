<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Tareas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('tareas.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 dark:bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-100 uppercase tracking-widest hover:bg-green-600 dark:hover:bg-green-800 focus:bg-green-600 dark:focus:bg-green-800 focus:ring-2 focus:ring-green-500 dark:focus:ring-green-200 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Crear Nueva Tarea') }}
                        </a>
                    </div>

                    <h3>{{ __('Mis Tareas Creadas') }}</h3>
                    @if (count($tareasPropias) > 0)
                        <ul class="space-y-2">
                            @foreach ($tareasPropias as $tarea)
                                <li>
                                    <a href="{{ route('tareas.show', $tarea->id) }}" class="text-blue-500 hover:underline">{{ $tarea->titulo }}</a>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('tareas.invitar', $tarea->id) }}" class="text-indigo-500 hover:underline text-xs">{{ __('Invitar') }}</a>
                                        <form method="POST" action="{{ route('tareas.destroy', $tarea->id) }}" onsubmit="return confirm('{{ __('¿Estás seguro de que deseas eliminar esta tarea?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="text-xs">{{ __('Eliminar') }}</x-danger-button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ __('No has creado ninguna tarea aún.') }}</p>
                    @endif

                    <h3 class="mt-6">{{ __('Tareas Invitado') }}</h3>
                    @if (count($tareasInvitado) > 0)
                        <ul class="space-y-2">
                            @foreach ($tareasInvitado as $tarea)
                                <li>
                                    <a href="{{ route('tareas.show', $tarea->id) }}" class="text-blue-500 hover:underline">{{ $tarea->titulo }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ __('No has sido invitado a ninguna tarea.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>