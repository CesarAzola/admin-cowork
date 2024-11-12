@props(['value'])

<label {{ $attributes->merge(['class' => 'form-label fw-medium small text-body-secondary']) }}>
    {{ $value ?? $slot }}
</label>
