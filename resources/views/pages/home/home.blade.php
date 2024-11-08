@extends('layouts.app')
@section('content')
<div class="container text-center my-5">
    <h1 class="mb-4">WELCOME TO OUR HOME PAGE</h1>
    <p>Discover more about what we offer</p>

    <div class="row justify-content-center mt-5">
        @foreach($homeItems as $item)
            <div class="col-md-4 mb-5">
                <div class="home-item">
                    <span class="new-badge">new</span>
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="img-fluid main-image mb-3">
                    <div class="row">
                        <div class="col-3">
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="img-fluid secondary-image">
                        </div>
                    </div>
                    <div class="item-details">
                        <h3 class="item-title">{{ $item->title }}</h3>
                        <p class="text-muted">{{ $item->temperature_range }}</p>
                        <p>{{ $item->description }}</p>
                        <a href="#" class="btn btn-outline-primary">Learn more...</a>
                    </div>
                    
                    {{-- Admin Controls --}}
                    @if(auth()->check() && auth()->user()->is_admin)
                        <div class="mt-3">
                            <a href="{{ route('home.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('home.delete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
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

    {{-- Button to Create New Home Item (for Admins) --}}
    @if(auth()->check() && auth()->user()->is_admin)
        <a href="{{ route('home.create') }}" class="btn btn-success mt-4">Add New Home Item</a>
    @endif
</div>
@endsection
