<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark">
            {{ __('Listado de habitaciones') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <x-alert-message />
            <div class="card shadow-sm">
                <div class="card-body text-dark">

                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('rooms.create') }}" class="btn btn-success btn-sm">Create</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-4">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Room Name</th>
                                    <th>Description</th>
                                    <th>Photo</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->name }}</td>
                                        <td class="w-50">{{ $room->description }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $room->photo_path) }}" alt="Image Preview" class="img-fluid rounded" style="width: 50px; height: auto;" />
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>                                                
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
