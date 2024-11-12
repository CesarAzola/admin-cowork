<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark">
            {{ __('Disponibilidad de la Sala') }}
        </h2>
    </x-slot>
    <a href="{{ url()->previous() }}" class="btn btn-secondary-outline">
        <i class="fas fa-arrow-left"></i> Atrás
    </a>
    <div class="py-5">
        <x-alert-message />
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-top text-center p-4">
                            <img src="{{ asset('storage/' . $room->photo_path) }}" alt="Foto de la sala" class="img-fluid"
                                 style="max-width: 100%; max-height: 200px;">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $room->name }}</h5>
                            <p class="card-text">{{ Str::limit($room->description, 50) }}</p>
                        </div>
                        <div class="card-footer text-center">
                            <form method="GET" action="{{ route('rooms.reservations', $room->id) }}">
                                <input type="date" name="calendar" id="calendar"
                                       class="form-control @error('calendar') is-invalid @enderror"
                                       value="{{ $selectedDate }}">
                                <button type="submit" class="btn btn-primary mt-2">Ver Disponibilidad</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4"> 
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Horas Disponibles</h5>
                            <ul class="list-group">
                                @foreach ($timeSlots as $time)
                                    @if (in_array($time, $reservedTimes))
                                        <li class="list-group-item list-group-item-danger">
                                            {{ $time }} - <strong>Ocupado</strong>
                                        </li>
                                    @else
                                        <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">
                                            {{ $time }} - Disponible
                                            
                                            <form method="POST" action="{{ route('reservations.store') }}">
                                                @csrf
                                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                                <input type="hidden" name="reservation_date" value="{{ $selectedDate }}">
                                                <input type="hidden" name="reservation_time" value="{{ $time }}">
                                                <button type="submit" class="btn btn-sm btn-outline-primary">Reservar</button>
                                            </form>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const calendarInput = document.getElementById('calendar');
        if (calendarInput && !calendarInput.value) {
            calendarInput.value = new Date().toISOString().split('T')[0];
        }
    });
</script>
