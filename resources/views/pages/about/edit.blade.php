@extends('layouts.app')

@section('about')
<div class="container text-center my-5">
    <h1 class="mb-4">Edit About Item</h1>

    <form action="{{ route('about.update', $aboutItem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $aboutItem->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $aboutItem->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="temperature_range" class="form-label">Temperature Range (Optional)</label>
            <input type="text" name="temperature_range" id="temperature_range" class="form-control" value="{{ $aboutItem->temperature_range }}">
        </div>

        <div class="mb-3">
            <label for="image_path" class="form-label">Image (Optional)</label>
            @if($aboutItem->image_path)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $aboutItem->image_path) }}" alt="{{ $aboutItem->title }}" style="max-width: 200px;">
                </div>
            @endif
            <input type="file" name="image_path" id="image_path" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update About Item</button>
    </form>
</div>
@endsection