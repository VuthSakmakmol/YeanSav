@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Details for {{ $project->title }}</h1>

        <form action="{{ route('project.details.update', [$project->id, $projectDetail->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="client">Client:</label>
                <input type="text" name="client" id="client" value="{{ $projectDetail->client }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="size">Size:</label>
                <input type="text" name="size" id="size" value="{{ $projectDetail->size }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" value="{{ $projectDetail->price }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" id="location" value="{{ $projectDetail->location }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="architect">Architect:</label>
                <input type="text" name="architect" id="architect" value="{{ $projectDetail->architect }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="link">Link:</label>
                <input type="url" name="link" id="link" value="{{ $projectDetail->link }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="instructor_image">Upload Instructor Image:</label>
                <input type="file" name="instructor_image" id="instructor_image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update Details</button>
        </form>
    </div>
@endsection
