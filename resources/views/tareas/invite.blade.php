<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invitar Usuarios a Tarea') }} "{{ $tarea->titulo }}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('tareas.inviteUser', $tarea->id) }}" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="usuarios" :value="__('Seleccionar Usuarios a Invitar')" />
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                                @foreach ($usuarios as $usuario)
                                    <div class="flex items-center">
                                        <input id="usuario_{{ $usuario->id }}" type="checkbox" name="usuarios[]" value="{{ $usuario->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-indigo-600 dark:focus:ring-indigo-600">
                                        <label for="usuario_{{ $usuario->id }}" class="ms-2 block text-sm text-gray-700 dark:text-gray-300">{{ $usuario->name }} ({{ $usuario->email }})</label>
                                    </div>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('usuarios')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                {{ __('Invitar Usuarios') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>