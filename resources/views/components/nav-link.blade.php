@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link active fw-medium text-body text-decoration-none border-bottom border-primary'
            : 'nav-link fw-medium text-muted text-decoration-none border-bottom-0 hover-text-dark';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
