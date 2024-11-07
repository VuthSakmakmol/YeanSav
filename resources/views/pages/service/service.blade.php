@extends('layouts.app')
@section('content')
<div class="container text-center my-5">
    <h1 class="mb-4">Our Services</h1>
    <p>Discover what we offer</p>

    <div class="row justify-content-center mt-5">
        @foreach($services as $service)
            <div class="col-md-4 mb-5">
                <div class="service-item">
                    <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="img-fluid mb-3" style="max-width: 100px;">
                    <h3 class="mt-3">{{ $service->title }}</h3>
                    <p class="text-muted">{{ $service->temperature_range }}</p>
                    <p>{{ $service->description }}</p>
                    <a href="#" class="btn btn-outline-danger">Learn more...</a>

                    {{-- Admin Controls, only visible to authenticated admin users --}}
                    @if(auth()->check() && auth()->user()->is_admin)
                        <div class="mt-3">
                            <a href="{{ route('service.edit', $service->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('service.delete', $service->id) }}" method="POST" class="d-inline">
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

    {{-- Button to Create New Service Item, only visible to authenticated admin users --}}
    @if(auth()->check() && auth()->user()->is_admin)
        <a href="{{ route('service.create') }}" class="btn btn-success mt-4">Add New Service</a>
    @endif
</div>
@endsection
