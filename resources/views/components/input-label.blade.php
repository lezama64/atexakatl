<!-- aqui empieza views/components/input-label.blade-php-->
@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
<!-- aqui termina views/components/input-label.blade-php-->