@props([
    'variant' => session('status') ? 'success' : (session('error') ? 'danger' : 'info'),
    'title' => session('status') ? 'Operación Exitosa!' : (session('error') ? 'Error!' : ''),
    'content' => session('status') ?? session('error') ?? '',
    'show' => session('status') || session('error')
])

@if ($show)
    <div class="alert alert-{{ $variant }} d-flex align-items-center alert-dismissible fade show" role="alert">
        <div>
            @if ($variant === 'success')
                <i class="bi bi-check-circle-fill me-2"></i>
            @elseif ($variant === 'danger')
                <i class="bi bi-x-circle-fill me-2"></i>
            @elseif ($variant === 'warning')
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
            @elseif ($variant === 'info')
                <i class="bi bi-info-circle-fill me-2"></i>
            @endif

            <strong>{{ $title }}</strong>
            <div>{{ $content }}</div>
        </div>
        
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
