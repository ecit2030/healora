@php
    $src = $src ?? '';
    $alt = $alt ?? '';
    $extraClass = trim($extraClass ?? '');
@endphp
@if ($src !== '')
    <img
        src="{{ $src }}"
        alt="{{ $alt }}"
        class="h-full w-full object-contain {{ $extraClass }}"
        decoding="async"
    >
@endif
