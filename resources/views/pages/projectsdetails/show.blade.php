@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Details for Project: {{ $project->title }}</h1>

        {{-- Project Main Information --}}
        <p><strong>Client:</strong> {{ $projectDetail->client }}</p>
        <p><strong>Size:</strong> {{ $projectDetail->size }}</p>
        <p><strong>Price:</strong> ${{ number_format($projectDetail->price, 2) }}</p>
        <p><strong>Location:</strong> {{ $projectDetail->location }}</p>
        <p><strong>Architect:</strong> {{ $projectDetail->architect }}</p>

        @if($projectDetail->link)
            <p><a href="{{ $projectDetail->link }}" target="_blank">More Information</a></p>
        @endif

        {{-- Instructor Image --}}
        {{-- @if($projectDetail->instructor_image)
            <img src="{{ asset('storage/project-details/' . $projectDetail->instructor_image) }}" alt="Instructor Image" style="width: 300px;">
        @endif --}}
        @if($projectDetail->instructor_image)
    <img src="{{ asset('storage/' . $projectDetail->instructor_image) }}" alt="Instructor Image" style="width: 300px;">
@endif


        {{-- Project Detail Images --}}
        @if($projectDetail->images && count($projectDetail->images) > 0)
            <h3>Project Images:</h3>
            @foreach($projectDetail->images as $image)
                <p>Image Path: {{ $image->image_path }}</p> <!-- Debugging step to see each image path -->
                <img src="{{ asset('storage/project-details/' . $image->image_path) }}" alt="Project Detail Image" style="width: 200px; margin-right: 10px;">
            @endforeach
        @endif

        {{-- Admin Control Buttons --}}
        @if(auth()->check() && auth()->user()->isAdmin())
            <div class="mt-3">
                <a href="{{ route('project.details.edit', [$project->id, $projectDetail->id]) }}" class="btn btn-warning">Edit Detail</a>
                <form action="{{ route('project.details.destroy', [$project->id, $projectDetail->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this detail?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Detail</button>
                </form>
            </div>
        @endif
    </div>
@endsection
