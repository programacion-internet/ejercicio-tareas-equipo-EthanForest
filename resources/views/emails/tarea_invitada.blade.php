<x-mail::message>
# Has sido invitado a la tarea: {{ $tareaNombre }}

Hola,

{{ $invitadorNombre }} te ha invitado a colaborar en la tarea: **{{ $tareaNombre }}**.

@if ($tareaDescripcion)
**Descripción:**
{{ $tareaDescripcion }}
@endif

**Fecha de Vencimiento:** {{ $tareaFechaVencimiento }}

[Ver Tarea]({{ $tareaUrl }})

Gracias,
{{ config('app.name') }}
</x-mail::message>