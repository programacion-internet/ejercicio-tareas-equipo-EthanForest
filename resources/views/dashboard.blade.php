<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">{{ __('Mis Tareas Creadas') }}</h3>
                        @if ($tareasPropias->count() > 0)
                            <ul class="list-disc list-inside">
                                @foreach ($tareasPropias as $tarea)
                                    <li>
                                        <a href="{{ route('tareas.show', $tarea) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                            {{ $tarea->titulo }}
                                        </a>
                                        <span class="text-gray-500 dark:text-gray-400">({{ __('Vencimiento') }}: @if($tarea->fecha_vencimiento) {{ $tarea->fecha_vencimiento }} @else {{ __('Sin fecha') }} @endif)</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ __('No has creado ninguna tarea aún.') }}</p>
                        @endif
                        <div class="mt-4">
                            <a href="{{ route('tareas.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 dark:bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-200 uppercase tracking-widest hover:bg-green-600 dark:hover:bg-green-800 focus:bg-green-600 dark:focus:bg-green-800 focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Crear Nueva Tarea') }}
                            </a>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">{{ __('Tareas Asignadas a Mí') }}</h3>
                        @if ($tareasInvitado->count() > 0)
                            <ul class="list-disc list-inside">
                                @foreach ($tareasInvitado as $tarea)
                                    <li>
                                        <a href="{{ route('tareas.show', $tarea) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                            {{ $tarea->titulo }}
                                        </a>
                                        <span class="text-gray-500 dark:text-gray-400">({{ __('Vencimiento') }}: @if($tarea->fecha_vencimiento) {{ $tarea->fecha_vencimiento }} @else {{ __('Sin fecha') }} @endif)</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ __('No has sido invitado a ninguna tarea aún.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
