<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark">
            {{ __('Listado de Salas de Coworking') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row">
                @foreach ($rooms as $room)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-img-top text-center p-4">
                                <img src="{{ asset('storage/' . $room->photo_path) }}" alt="Foto de la sala" class="img-fluid" style="max-width: 100%; max-height: 200px;">
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $room->name }}</h5>
                                <p class="card-text">{{ Str::limit($room->description, 50) }}</p>

                                <a href="{{ route('rooms.reservations', $room->id) }}" class="btn btn-outline-primary mt-2">Ver Reservas</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
