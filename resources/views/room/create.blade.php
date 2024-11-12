<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark">
            {{ __('Crear Habitacion') }}
        </h2>
    </x-slot>
    
    <div class="py-5">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body text-dark">
                    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="mb-3">
                            <label for="name" class="form-label">Room Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                            
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="photo" class="form-label">Upload Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                            
                            @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="mb-3">
                            <img id="preview" src="#" alt="Image Preview" style="display: none; width: 150px; height: auto; border-radius: 5px;" />
                        </div>
                    >
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Create Room</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>
