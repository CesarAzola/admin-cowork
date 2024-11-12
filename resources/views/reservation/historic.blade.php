<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark">
            {{ __('Listado de Reservas') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <x-alert-message />
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('reservations.historic') }}" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="state" class="form-label">Filtrar por Estado</label>
                                <select name="state" id="state" class="form-select">
                                    <option value="">Todos los Estados</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            {{ request('state') == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="room" class="form-label">Filtrar por Sala</label>
                                <select name="room" id="room" class="form-select">
                                    <option value="">Todas las Salas</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}"
                                            {{ request('room') == $room->id ? 'selected' : '' }}>
                                            {{ $room->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Sala</th>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                    @unless (auth()->user()->hasRole('client'))
                                        <th>Acciones</th>
                                    @endunless
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->id }}</td>
                                        <td>{{ $reservation->room->name }}</td>
                                        <td>{{ $reservation->user->name }}</td>
                                        <td>{{ $reservation->reservation_date }}</td>
                                        <td>{{ $reservation->reservation_time }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($reservation->state->name === 'Aceptada') bg-success
                                                @elseif($reservation->state->name === 'Pendiente') bg-warning
                                                @elseif($reservation->state->name === 'Rechazada') bg-danger
                                                @endif
                                            ">
                                                {{ $reservation->state->name }}
                                            </span>
                                        </td>
                                        @unless (auth()->user()->hasRole('client'))
                                            <td>
                                                @if ($reservation->state->name === 'Pendiente')
                                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                        data-bs-target="#updateStatusModal"
                                                        data-id="{{ $reservation->id }}">
                                                        Cambiar Estado
                                                    </button>
                                                @endif
                                            </td>
                                        @endunless

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No hay reservas que coincidan con los
                                            filtros.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $reservations->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para actualizar estado -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('reservations.updateStatus') }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStatusModalLabel">Actualizar Estado de la Reserva</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="reservation_id" id="reservation-id">
                        <div class="mb-3">
                            <label for="new_state" class="form-label">Nuevo Estado</label>
                            <select name="new_state" id="new_state" class="form-select" required>
                                <option value="accepted">Aceptado</option>
                                <option value="rejected">Rechazado</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Estado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const updateStatusModal = document.getElementById('updateStatusModal');
        updateStatusModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const reservationId = button.getAttribute('data-id');
            document.getElementById('reservation-id').value = reservationId;
        });
    </script>
</x-app-layout>
