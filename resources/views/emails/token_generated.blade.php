<x-mail::message>
# Actualización de Perfil
A continuación se le proporcionará un token para completar la actualización.

Hola, {{ auth()->user()->name }}.

<x-mail::button :url="''">
Token:  {{ $data['token'] }}
</x-mail::button>

Desde,<br>
{{ config('app.name') }}
</x-mail::message>
