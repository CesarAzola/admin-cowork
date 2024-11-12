<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-light border fw-semibold text-uppercase shadow-sm']) }}>
    {{ $slot }}
</button>
