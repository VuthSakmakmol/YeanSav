@extends('layouts.app')

@section('content')
<div class="container text-center my-5">
    <h1 class="mb-4">Welcome to Our Home Page</h1>
    <p class="lead">Welcome text or introduction here...</p>

    {{-- Button to Create New Home Item (for Admins) --}}
    @if(auth()->check() && auth()->user()->isAdmin())
        <div class="mb-3">
            <a href="{{ route('home.create') }}" class="btn btn-success">Add New Home Item</a>
        </div>
    @endif

        {{-- Display Home Items --}}
    <h2 class="mt-5 mb-4">Home Items</h2>
    @if($homeItems->isEmpty())
        <p>No home items available.</p>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($homeItems as $homeItem)
                <div class="col">
                    <div class="card h-100">
                        {{-- Display Image --}}
                        @if($homeItem->image_path)
                            <img src="{{ asset('storage/' . $homeItem->image_path) }}" alt="{{ $homeItem->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/200" alt="No Image Available" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @endif
                        
                        {{-- Card Body --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $homeItem->title }}</h5>
                            <p class="card-text">{{ $homeItem->description }}</p>
                        </div>

                        {{-- Admin Controls --}}
                        @if(auth()->check() && auth()->user()->isAdmin())
                            <div class="card-footer text-end">
                                <a href="{{ route('home.edit', $homeItem->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('home.destroy', $homeItem->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this home item?')">
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
    @endif


    {{-- JavaScript for delete confirmation --}}
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this item?");
        }
    </script>
</div>
@endsection
