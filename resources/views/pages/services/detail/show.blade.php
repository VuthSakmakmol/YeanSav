@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Service Detail: {{ $service->title }}</h1>
    
    <p>{{ $serviceDetail->description ?? 'No detail available' }}</p>

    <ul>
        <li>Client: {{ $serviceDetail->client ?? 'N/A' }}</li>
        <li>Location: {{ $serviceDetail->location ?? 'N/A' }}</li>
        <li>Year Completed: {{ $serviceDetail->year_completed ?? 'N/A' }}</li>
        <li>Surface Area: {{ $serviceDetail->surface_area ?? 'N/A' }}</li>
        <li>Value: {{ $serviceDetail->value ?? 'N/A' }}</li>
        <li>Architect: {{ $serviceDetail->architect ?? 'N/A' }}</li>
    </ul>

    <div class="image-gallery">
        @if($serviceDetail->image)
            <img src="{{ asset('storage/' . $serviceDetail->image) }}" alt="Service Image" style="width:200px; height:auto;">
        @else
            <p>No image available</p>
        @endif
    </div>

    {{-- Admin controls for editing and deleting --}}
    @if(auth()->check() && auth()->user()->is_admin)
        <div class="mt-4">
            <a href="{{ route('service.detail.edit', ['service' => $service->id, 'serviceDetail' => $serviceDetail->id]) }}" class="btn btn-primary btn-sm">
                Edit
            </a>

            <form action="{{ route('service.detail.destroy', ['service' => $service->id, 'serviceDetail' => $serviceDetail->id]) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    @endif
</div>
@endsection
