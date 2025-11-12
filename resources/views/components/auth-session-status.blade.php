
<!-- aqui empieza views/components/auth-session-status.blade-php-->
@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
@endif
<!-- aqui termina views/components/auth-session-status.blade-php-->