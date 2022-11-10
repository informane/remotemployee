@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '']) !!}>
    {{ $slot }}
</select>
