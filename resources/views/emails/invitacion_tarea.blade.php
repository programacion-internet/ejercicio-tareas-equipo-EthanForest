@component('mail::message')
# Invitación a la tarea: {{ $tareaNombre }}

Hola,

Has sido invitado a colaborar en la tarea **{{ $tareaNombre }}**.

Puedes ver la tarea haciendo clic en el siguiente botón:

@component('mail::button', ['url' => $tareaLink])
Ver Tarea
@endcomponent

¡Esperamos tu colaboración!

Saludos,
{{ config('app.name') }}
@endcomponent