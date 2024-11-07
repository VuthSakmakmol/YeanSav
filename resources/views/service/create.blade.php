@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h1>Add New Service</h1>
    <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="image_path" class="form-label">Image</label>
            <input type="file" name="image_path" id="image_path" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="temperature_range" class="form-label">Temperature Range</label>
            <input type="text" name="temperature_range" id="temperature_range" class="form-control">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Service</button>
    </form>
</div>
@endsection
