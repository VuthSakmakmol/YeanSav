@extends('layouts.app')

@section('projects')
    <div class="container my-5">
        <h1 class="mb-4">Edit Details for {{ $project->title }}</h1>

        <form action="{{ route('project.details.update', [$project->id, $projectDetail->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Basic Details --}}
            <div class="form-group mb-3">
                <label for="client">Client:</label>
                <input type="text" name="client" id="client" value="{{ $projectDetail->client }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="size">Size:</label>
                <input type="text" name="size" id="size" value="{{ $projectDetail->size }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" value="{{ $projectDetail->price }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="location">Location:</label>
                <input type="text" name="location" id="location" value="{{ $projectDetail->location }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="architect">Architect:</label>
                <input type="text" name="architect" id="architect" value="{{ $projectDetail->architect }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="link">Link:</label>
                <input type="url" name="link" id="link" value="{{ $projectDetail->link }}" class="form-control">
            </div>

            {{-- Instructor Image --}}
            <div class="form-group mb-3">
                <label for="instructor_image">Upload Instructor Image:</label>
                <input type="file" name="instructor_image" id="instructor_image" class="form-control">
                @if($projectDetail->instructor_image)
                    <p class="mt-2">
                        Current Image:
                        <img src="{{ asset('storage/' . $projectDetail->instructor_image) }}" alt="Instructor Image" class="img-thumbnail" style="width: 150px;">
                    </p>
                @endif
            </div>

            {{-- Dynamic Multiple Images --}}
            <div class="form-group mb-4">
                <label>Project Images:</label>
                <div id="image-fields">
                    @if($projectDetail->images && count($projectDetail->images) > 0)
                        @foreach($projectDetail->images as $image)
                            <div class="input-group mb-2">
                                <input type="file" name="images[]" class="form-control">
                                <p class="ms-3">Current Image:
                                    <img src="{{ asset('storage/project-details/' . $image->image_path) }}" alt="Project Image" class="img-thumbnail" style="width: 100px;">
                                </p>
                                <button type="button" class="btn btn-danger remove-image-field">-</button>
                            </div>
                        @endforeach
                    @else
                        {{-- Initial Image Input Field --}}
                        <div class="input-group mb-2">
                            <input type="file" name="images[]" class="form-control">
                            <button type="button" class="btn btn-success add-image-field">+</button>
                        </div>
                    @endif
                </div>
                <small class="form-text text-muted">Click "+" to add more images.</small>
            </div>

            <button type="submit" class="btn btn-primary">Update Details</button>
        </form>
    </div>

    {{-- JavaScript for adding/removing image fields --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const imageFieldsContainer = document.getElementById('image-fields');

            // Add a new image input field
            imageFieldsContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('add-image-field')) {
                    const newField = document.createElement('div');
                    newField.classList.add('input-group', 'mb-2');
                    newField.innerHTML = `
                        <input type="file" name="images[]" class="form-control">
                        <button type="button" class="btn btn-danger remove-image-field">-</button>
                    `;
                    imageFieldsContainer.appendChild(newField);
                }

                // Remove an image input field
                if (e.target.classList.contains('remove-image-field')) {
                    e.target.parentElement.remove();
                }
            });
        });
    </script>
@endsection
