@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1>Edit Service</h1>
    <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $service->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" required>{{ $service->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="temperature_range" class="form-label">Temperature Range</label>
            <input type="text" name="temperature_range" class="form-control" value="{{ $service->temperature_range }}">
        </div>
        <div class="mb-3">
            <label for="image_path" class="form-label">Image</label>
            <input type="file" name="image_path" class="form-control">
            @if($service->image_path)
                <img src="{{ asset('storage/' . $service->image_path) }}" class="img-fluid mt-2" style="max-width: 100px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
