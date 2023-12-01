<x-mail::message>
# Introduction
The body of your message

Hola, {{ auth()->user()->name }}.

<x-mail::button :url="''">
Token Pa:  {{ $data['token'] }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
