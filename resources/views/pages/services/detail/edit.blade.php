@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Service Detail for: {{ $service->title }}</h1>

    <form action="{{ route('service.detail.update', ['service' => $service->id, 'serviceDetail' => $serviceDetail->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="client" class="form-label">Client</label>
            <input type="text" name="client" class="form-control" value="{{ $serviceDetail->client ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ $serviceDetail->location ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="year_completed" class="form-label">Year Completed</label>
            <input type="date" name="year_completed" class="form-control" value="{{ $serviceDetail->year_completed ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="surface_area" class="form-label">Surface Area</label>
            <input type="text" name="surface_area" class="form-control" value="{{ $serviceDetail->surface_area ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <input type="text" name="value" class="form-control" value="{{ $serviceDetail->value ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="architect" class="form-label">Architect</label>
            <input type="text" name="architect" class="form-control" value="{{ $serviceDetail->architect ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $serviceDetail->description ?? '' }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            @if($serviceDetail->image)
                <img src="{{ asset('storage/' . $serviceDetail->image) }}" alt="Current Image" style="max-width: 100px; margin-top: 10px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Service Detail</button>
    </form>

    {{-- Back Button --}}
    <a href="{{ route('service.detail.show', ['service' => $service->id, 'serviceDetail' => $serviceDetail->id]) }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
