@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Project Details: {{ $project->title }}</h1>

    <div class="row">
        {{-- Main Content --}}
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Project Information</h5>

                    @if ($projectDetail)
                        <ul class="list-unstyled">
                            <li><strong>Client:</strong> {{ $projectDetail->client }}</li>
                            <li><strong>Size:</strong> {{ $projectDetail->size }}</li>
                            <li><strong>Price:</strong> ${{ number_format($projectDetail->price, 2) }}</li>
                            <li><strong>Location:</strong> {{ $projectDetail->location }}</li>
                            <li><strong>Architect:</strong> {{ $projectDetail->architect }}</li>
                        </ul>

                        @if($projectDetail->link)
                            <a href="{{ $projectDetail->link }}" target="_blank" class="btn btn-outline-primary mt-3">
                                More Information
                            </a>
                        @endif
                    @else
                        <p class="text-danger">The project detail information is not available.</p>
                    @endif
                </div>
            </div>

            {{-- Additional Project Images --}}
            @if ($projectDetail && $projectDetail->images && count($projectDetail->images) > 0)
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Project Images</h5>
                        <div class="row">
                            @foreach($projectDetail->images as $image)
                                <div class="col-md-4 col-6 mb-3">
                                    <img src="{{ asset('storage/images/' . $image->image_path) }}" 
                                         alt="Project Detail Image" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="width: 100%; height: auto;">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Sidebar with Main Image --}}
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                @if ($projectDetail && $projectDetail->instructor_image)
                    <img src="{{ asset('storage/' . $projectDetail->instructor_image) }}" 
                         alt="Instructor Image" 
                         class="card-img-top rounded-top" 
                         style="height: 350px; object-fit: cover; width: 100%;">
                @else
                    <img src="https://via.placeholder.com/350x350" 
                         alt="No Image Available" 
                         class="card-img-top rounded-top" 
                         style="height: 350px; object-fit: cover; width: 100%;">
                @endif
                <div class="card-body">
                    <p class="text-muted text-center">Instructor/Project Image</p>
                </div>
            </div>

            {{-- Admin Controls --}}
            @if(auth()->check() && auth()->user()->isAdmin() && $projectDetail)
                <div class="mt-4">
                    <a href="{{ route('project.details.edit', [$project->id, $projectDetail->id]) }}" 
                       class="btn btn-warning btn-block mb-2">
                       Edit Detail
                    </a>
                    <form action="{{ route('project.details.destroy', [$project->id, $projectDetail->id]) }}" 
                          method="POST" 
                          class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-danger btn-block" 
                                onclick="return confirm('Are you sure you want to delete this detail?')">
                            Delete Detail
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
