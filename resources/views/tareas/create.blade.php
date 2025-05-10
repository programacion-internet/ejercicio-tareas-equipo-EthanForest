<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nueva Tarea') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('tareas.store') }}" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="titulo" :value="__('Título')" />
                            <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" required autofocus />
                            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="descripcion" :value="__('Descripción (Opcional)')" />
                            <x-textarea id="descripcion" class="block mt-1 w-full" name="descripcion"></x-textarea>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="fecha_vencimiento" :value="__('Fecha de Vencimiento (Opcional)')" />
                            <x-text-input id="fecha_vencimiento" class="block mt-1 w-full" type="date" name="fecha_vencimiento" />
                            <x-input-error :messages="$errors->get('fecha_vencimiento')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                {{ __('Crear Tarea') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>