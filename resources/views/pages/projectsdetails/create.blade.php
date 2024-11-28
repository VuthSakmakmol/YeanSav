@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Add Detail for Project: {{ $project->title }}</h1>

        {{-- Blade template for adding project details --}}
        <form action="{{ route('project.details.store', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="client">Client Name:</label>
                <input type="text" id="client" name="client" class="form-control" required value="{{ old('client') }}">
                @error('client')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="size">Size:</label>
                <input type="text" id="size" name="size" class="form-control" required value="{{ old('size') }}">
                @error('size')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" class="form-control" required value="{{ old('price') }}">
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" class="form-control" required value="{{ old('location') }}">
                @error('location')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="architect">Architect:</label>
                <input type="text" id="architect" name="architect" class="form-control" value="{{ old('architect') }}">
                @error('architect')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="link">Project Link:</label>
                <input type="url" id="link" name="link" class="form-control" value="{{ old('link') }}">
                @error('link')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="instructor_image">Instructor Image:</label>
                <input type="file" id="instructor_image" name="instructor_image" class="form-control">
                @error('instructor_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Details</button>
        </form>
    </div>
@endsection
