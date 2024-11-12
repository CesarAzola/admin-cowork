@props(['active'])

@php
$classes = ($active ?? false)
            ? 'd-block w-100 ps-3 pe-4 py-2 border-start border-3 border-primary text-start text-primary bg-light fw-medium text-decoration-none'
            : 'd-block w-100 ps-3 pe-4 py-2 border-start border-3 border-transparent text-start text-body fw-medium text-decoration-none hover-text-dark hover-bg-light';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
