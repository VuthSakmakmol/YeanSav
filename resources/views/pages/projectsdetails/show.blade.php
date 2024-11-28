@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Project Details: {{ $project->title }}</h1>

    <div class="row">
        {{-- Main Content --}}
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Project Information</h5>
                    <ul class="list-unstyled">
                        <li><strong>Client:</strong> {{ $projectDetail->client }}</li>
                        <li><strong>Size:</strong> {{ $projectDetail->size }}</li>
                        <li><strong>Price:</strong> ${{ number_format($projectDetail->price, 2) }}</li>
                        <li><strong>Location:</strong> {{ $projectDetail->location }}</li>
                        <li><strong>Architect:</strong> {{ $projectDetail->architect }}</li>
                    </ul>

                    @if($projectDetail->link)
                        <a href="{{ $projectDetail->link }}" target="_blank" class="btn btn-outline-primary mt-3">More Information</a>
                    @endif
                </div>
            </div>

            {{-- Additional Project Images --}}
            @if($projectDetail->images && count($projectDetail->images) > 0)
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Project Images</h5>
                        <div class="d-flex flex-wrap">
                            @foreach($projectDetail->images as $image)
                                <div class="m-2">
                                    <img src="{{ asset('storage/project-details/' . $image->image_path) }}" alt="Project Detail Image" class="img-fluid rounded" style="width: 200px;">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Sidebar with Image --}}
        <div class="col-md-4">
            <div class="card shadow-sm">
                @if($projectDetail->instructor_image)
                    <img src="{{ asset('storage/' . $projectDetail->instructor_image) }}" alt="Instructor Image" class="card-img-top" style="height: 250px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/300x250" alt="No Image Available" class="card-img-top" style="height: 250px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <p class="text-muted">Instructor/Project Image</p>
                </div>
            </div>

            {{-- Admin Controls --}}
            @if(auth()->check() && auth()->user()->isAdmin())
                <div class="mt-4">
                    <a href="{{ route('project.details.edit', [$project->id, $projectDetail->id]) }}" class="btn btn-warning btn-block">Edit Detail</a>
                    <form action="{{ route('project.details.destroy', [$project->id, $projectDetail->id]) }}" method="POST" class="mt-2" onsubmit="return confirm('Are you sure you want to delete this detail?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block">Delete Detail</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
