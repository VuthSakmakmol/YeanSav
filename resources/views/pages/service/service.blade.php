@extends('layouts.app')
@section('content')
<div class="container text-center my-5" style="background-color: #f0a500; color: #333; padding: 50px 0;">
    <h1 class="mb-4">Latest Projects</h1>
    <p>Check out our latest construction projects around the world</p>

    <div class="row justify-content-center mt-5" style="gap: 10px;">
        @foreach($services as $index => $service)
            <div class="col-md-4 col-12 mb-5 service-item {{ $index >= 6 ? 'd-none' : '' }}" style="margin: 10px;" data-visible>
                <div class="card h-100" style="border: none; position: relative; overflow: hidden; border-radius: 10px;">
                    <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">

                    <div class="card-body text-start p-4" style="background: rgba(0, 0, 0, 0.6); color: white; position: absolute; bottom: 0; width: 100%;">
                        <h3 class="card-title">{{ $service->title }}</h3>
                        <p class="card-text text-muted">{{ $service->temperature_range }}</p>
                        <p class="card-text">{{ $service->description }}</p>
                        <a href="#" class="btn btn-outline-light">Learn more...</a>
                    </div>

                    {{-- Admin Controls --}}
                    @if(auth()->check() && auth()->user()->is_admin)
                        <div class="admin-controls mt-3 text-center" style="position: absolute; top: 10px; right: 10px;">
                            <a href="{{ route('service.edit', $service->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('service.delete', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Toggle buttons for showing/hiding extra items --}}
    <button id="toggleButton" class="btn btn-secondary mt-4" onclick="toggleItems()">See More</button>

    {{-- Button to Create New Service Item (Admin Only) --}}
    @if(auth()->check() && auth()->user()->is_admin)
        <a href="{{ route('service.create') }}" class="btn btn-success mt-4">Add New Service</a>
    @endif
</div>

{{-- JavaScript for toggling items and delete confirmation --}}
<script>
    function toggleItems() {
        const screenWidth = window.innerWidth;
        const hiddenItems = document.querySelectorAll('.service-item.d-none');
        const isExpanded = hiddenItems.length === 0;

        // Determine how many items to show based on screen width
        const itemsToShow = screenWidth < 768 ? 3 : 6;

        // Toggle visibility of hidden items
        document.querySelectorAll('.service-item').forEach((item, index) => {
            if (index >= itemsToShow) item.classList.toggle('d-none', isExpanded);
        });

        // Update button text
        document.getElementById('toggleButton').textContent = isExpanded ? 'See More' : 'See Less';
    }

    function confirmDelete() {
        return confirm("Are you sure you want to delete this item?");
    }

    // Automatically set initial visibility based on screen width
    window.addEventListener('DOMContentLoaded', () => {
        const screenWidth = window.innerWidth;
        const itemsToShow = screenWidth < 768 ? 3 : 6;
        document.querySelectorAll('.service-item').forEach((item, index) => {
            if (index >= itemsToShow) item.classList.add('d-none');
        });
    });

    // Update visibility on window resize
    window.addEventListener('resize', () => {
        toggleItems();
    });
</script>

@endsection
