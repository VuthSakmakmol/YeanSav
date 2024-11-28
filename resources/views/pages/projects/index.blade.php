@extends('layouts.app')

@section('content')
    <div class="container text-center my-5">
        <h1 class="mb-4">All Projects</h1>

        @if(auth()->check() && auth()->user()->isAdmin())
            <div class="mb-3">
                <a href="{{ route('projects.create') }}" class="btn btn-success">Add New Project</a>
            </div>
        @endif

        @if($projects->isEmpty())
            <p>No projects available.</p>
        @else
            <div class="row justify-content-center mt-5">
                @foreach($projects as $project)
                    <div class="col-md-4 mb-5">
                        <div class="project-item">
                            {{-- Project Main Image --}}
                            @if($project->image)
                                <img src="{{ asset('storage/projects/' . $project->image) }}" alt="{{ $project->title }}" class="img-fluid main-image mb-3" style="width: 300px;">
                            @endif

                            {{-- Project Details --}}
                            <div class="item-details">
                                <h3 class="item-title">{{ $project->title }}</h3>
                                <p class="text-muted">{{ $project->description }}</p>
                                @if(auth()->check() && auth()->user()->isAdmin())
                                    <a href="{{ route('projectsdetails.show', ['project' => $project->id]) }}" class="btn btn-outline-primary">View Details</a>
                                @else
                                    <a href="{{ route('projects.show', ['project' => $project->id]) }}" class="btn btn-outline-primary">View Details</a>
                                @endif
                            </div>

                            {{-- Admin Controls --}}
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <div class="mt-3">
                                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <a href="{{ route('project.details.create', $project->id) }}" class="btn btn-info btn-sm mt-2">Add Detail</a> <!-- Add Detail Button -->
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
