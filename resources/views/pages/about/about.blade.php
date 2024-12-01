@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">About Us</h1>
    <p class="text-center text-muted">Discover more about what we offer</p>

    <div class="row justify-content-center mt-4">
        @foreach($aboutItems as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    {{-- Display Image --}}
                    @if($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" 
                             alt="{{ $item->title }}" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/200x150" 
                             alt="No Image Available" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    {{-- Card Body --}}
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text text-muted">{{ $item->temperature_range }}</p>
                        <p class="card-text">{{ $item->description }}</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Learn more...</a>
                    </div>

                    {{-- Admin Controls --}}
                    @if(auth()->check() && auth()->user()->is_admin)
                        <div class="card-footer text-center">
                            <a href="{{ route('about.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('about.delete', $item->id) }}" 
                                  method="POST" 
                                  class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this item?')">
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

    {{-- Admin-only: Add New About Item --}}
    @if(auth()->check() && auth()->user()->is_admin)
        <div class="text-center mt-4">
            <a href="{{ route('about.create') }}" class="btn btn-success">Add New About Item</a>
        </div>
    @endif
</div>
@endsection
