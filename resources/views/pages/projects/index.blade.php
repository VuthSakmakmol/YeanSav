
@extends('layouts.app')

@section('projects')
<div class="container py-5 project-section">
    <h1 class="text-center mb-4">Our Projects</h1>
    <p class="text-center text-muted">Explore our latest projects and designs</p>

    {{-- Admin-only: Add New Project Button --}}
    @if(auth()->check() && auth()->user()->isAdmin())
        <div class="text-center mb-4">
            <a href="{{ route('projects.create') }}" class="btn btn-success">Add New Project</a>
        </div>
    @endif

    {{-- Check if projects are available --}}
    @if($projects->isEmpty())
        <p class="text-center text-muted">No projects available at the moment. Please check back later.</p>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($projects as $project)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        {{-- Project Image --}}
                        @if($project->image)
                            <img src="{{ asset('storage/projects/' . $project->image) }}" alt="{{ $project->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/400x200" alt="No Image Available" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @endif

                        {{-- Card Body --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($project->description, 100) }}</p>
                            <a href="{{ route('projectsdetails.show', ['projectDetail' => $project->id]) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                        </div>

                        {{-- Admin Controls --}}
                        @if(auth()->check() && auth()->user()->isAdmin())
                            <div class="card-footer bg-light">
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="{{ route('project.details.create', $project->id) }}" class="btn btn-info btn-sm mt-2">Add Detail</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
