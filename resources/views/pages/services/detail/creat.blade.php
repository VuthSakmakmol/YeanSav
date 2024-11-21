@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Create Service Detail for {{ $service->title }}</h1>

    <form action="{{ route('service.detail.store', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="client" class="form-label">Client</label>
            <input type="text" name="client" class="form-control" value="{{ old('client') }}" placeholder="Client Name" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location') }}" placeholder="Project Location" required>
        </div>

        <div class="mb-3">
            <label for="year_completed" class="form-label">Year Completed</label>
            <input type="date" name="year_completed" class="form-control" value="{{ old('year_completed') }}">
        </div>

        <div class="mb-3">
            <label for="surface_area" class="form-label">Surface Area (e.g., sq. meters)</label>
            <input type="number" step="0.01" name="surface_area" class="form-control" value="{{ old('surface_area') }}" placeholder="Surface Area">
        </div>

        <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <input type="number" step="0.01" name="value" class="form-control" value="{{ old('value') }}" placeholder="Project Value">
        </div>

        <div class="mb-3">
            <label for="architect" class="form-label">Architect</label>
            <input type="text" name="architect" class="form-control" value="{{ old('architect') }}" placeholder="Architect Name">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Write a brief project description...">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Save Detail</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('service.details.show-all', $service->id) }}" class="btn btn-secondary mt-3">Back to All Service Details</a>
</div>
@endsection