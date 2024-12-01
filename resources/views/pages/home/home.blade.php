@extends('layouts.app')

@section('content')
<div class="container text-center my-5">
    <h1 class="mb-4">Welcome to Our Home Page</h1>
    {{-- Button to Create New Home Item (for Admins) --}}
    @if(auth()->check() && auth()->user()->isAdmin())
        <div class="mb-3">
            <a href="{{ route('home.create') }}" class="btn btn-success">Add New Home Item</a>
        </div>
    @endif

    {{-- Display Home Items --}}
    @if($homeItems->isEmpty())
        <p>No home items available.</p>
    @else
    <div class="container-fluid px-0">
        <div class="row g-4">
            @foreach($homeItems as $homeItem)
                <div class="col-12">
                    <div class="card h-100 border-0 shadow-lg rounded-0">
                        {{-- Background Image with Overlay --}}
                        <div class="position-relative" style="height: 400px; overflow: hidden;">
                            @if($homeItem->image_path)
                                <img src="{{ asset('storage/' . $homeItem->image_path) }}" alt="{{ $homeItem->title }}" class="card-img" style="object-fit: cover; height: 100%; width: 100%; transition: transform 0.3s ease;">
                            @else
                                <img src="https://via.placeholder.com/1920x400" alt="No Image Available" class="card-img" style="object-fit: cover; height: 100%; width: 100%; transition: transform 0.3s ease;">
                            @endif
    
                            {{-- Overlay for Title and Description --}}
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center" style="background: rgba(0, 0, 0, 0.5);">
                                <h4 class="text-white fw-bold text-uppercase mb-2" style="font-size: 1.5rem;">{{ $homeItem->title }}</h4>
                                <p class="text-white-50 fs-6 mb-0" style="font-size: 1rem;">{{ $homeItem->description }}</p>
                            </div>
                        </div>
    
                        {{-- Hover Effect for Image Zoom --}}
                        <style>
                            .card:hover .card-img {
                                transform: scale(1.1);
                            }
                        </style>
    
                        {{-- Admin Controls --}}
                        @if(auth()->check() && auth()->user()->isAdmin())
                            <div class="card-footer text-end bg-white">
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
    </div>    
    @endif
</div>
@endsection
