<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle de Tarea') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">{{ $tarea->titulo }}</h3>
                    @if ($tarea->descripcion)
                        <p class="mb-4">{{ $tarea->descripcion }}</p>
                    @endif
                    <p class="mb-4">{{ __('Fecha de Vencimiento:') }} {{ $tarea->fecha_vencimiento ? : 'Sin fecha' }}</p>

                    <h4 class="font-semibold mt-6 mb-2">{{ __('Subir Archivo') }}</h4>
                    <form action="{{ route('tareas.archivos.subir', $tarea->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <div>
                            <x-input-label for="archivo" :value="__('Seleccionar Archivo')" />
                            <x-text-input id="archivo" class="block mt-1 w-full" type="file" name="archivo" required />
                            <x-input-error :messages="$errors->get('archivo')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-primary-button>{{ __('Subir') }}</x-primary-button>
                        </div>
                    </form>

                    <h4 class="font-semibold mt-6 mb-2">{{ __('Archivos Adjuntos') }}</h4>
                    @if (count($archivos) > 0)
                        <ul class="space-y-2">
                            @foreach ($archivos as $archivo)
                                <li class="flex items-center justify-between">
                                    <a href="{{ Storage::url($archivo->ruta_archivo) }}" target="_blank" class="text-blue-500 hover:underline">
                                        {{ $archivo->nombre_original }}
                                    </a>
                                    <form method="POST" action="{{ route('archivos.eliminar', $archivo->id) }}" onsubmit="return confirm('{{ __('¿Estás seguro de eliminar este archivo?') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="text-xs">{{ __('Eliminar') }}</x-danger-button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ __('No hay archivos adjuntos.') }}</p>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('tareas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-100 uppercase tracking-widest hover:bg-gray-600 dark:hover:bg-gray-800 focus:bg-gray-600 dark:focus:bg-gray-800 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-200 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Volver') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>