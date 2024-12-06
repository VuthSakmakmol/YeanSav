@extends('layouts.app')
@section('home')
<div class="container text-center my-5">
    <h1 class="mb-4">Yean Architect that Will make you come!</h1>
    {{-- Button to Create New Home Item (for Admins) --}}
    @if(auth()->check() && auth()->user()->isAdmin())
        <div class="mb-3">
            <a href="{{ route('home.create') }}" class="btn btn-success">Add New Home Item</a>
        </div>
    @endif

    {{-- Display Home Items --}}
    @if($homeItems->isEmpty())
        <p>No home items available.</p>
    @else
    <div class="container-fluid px-0">
        <div class="row g-4">
            @foreach($homeItems as $homeItem)
                <div class="col-12">
                    <div class="card h-100 border-0 shadow-lg rounded-0">
                        {{-- Background Image with Overlay --}}
                        <div class="position-relative" style="height: 400px; overflow: hidden;">
                            @if($homeItem->image_path)
                                <img src="{{ asset('storage/' . $homeItem->image_path) }}" alt="{{ $homeItem->title }}" class="card-img" style="object-fit: cover; height: 100%; width: 100%;">
                            @else
                                <img src="https://via.placeholder.com/1920x400" alt="No Image Available" class="card-img" style="object-fit: cover; height: 100%; width: 100%;">
                            @endif
    
                            {{-- Overlay for Title and Description --}}
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-start px-4" style="background: rgba(0, 0, 0, 0.5);">
                                <h4 class="text-white fw-bold text-uppercase mb-2" style="font-size: 2rem;">{{ $homeItem->title }}</h4>
                                <div style= " padding-top: 10 rem; width: 360px">
                                    <p class="text-white-50  fs-6 mb-0" style="font-size: 1rem;">{{ $homeItem->description }}</p>
                                </div>
                            </div>
                        </div>
    
                        {{-- Admin Controls --}}
                        @if(auth()->check() && auth()->user()->isAdmin())
                            <div class="card-footer text-end bg-white">
                                <a href="{{ route('home.edit', $homeItem->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('home.destroy', $homeItem->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this home item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
     
    @endif
</div>


@endsection

{{-- Project Page --}}

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


{{-- Contact --}}
@section('contact')

<div  class="container py-5 ">
    <h1 class="text-center mb-4">Our Team</h1>
    <p class="text-center text-muted">Discover more about what we offer</p>

    <div class="row justify-content-center mt-4">
        @foreach($contactItems as $contactitem)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    {{-- Display Image --}}
                    @if($contactitem->image_path)
                        <img src="{{ asset('storage/' . $contactitem->image_path) }}" 
                             alt="{{ $contactitem->title }}" 
                             class="card-img-top" 
                             style="height: 350px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/200x360" 
                             alt="No Image Available" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    {{-- Card Body --}}
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold fs-3">{{ $contactitem->title }}</h5>
                        <p class="card-text text-muted">{{ $contactitem->temperature_range }}</p>
                        <p class="card-text">{{ $contactitem->description }}</p>
                    </div>

                    {{-- Admin Controls --}}
                    @if(auth()->check() && auth()->user()->is_admin)
                        <div class="card-footer text-center">
                            <a href="{{ route('contact.edit', $contactitem->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('contact.delete', $contactitem->id) }}" 
                                  method="POST" 
                                  class="d-inline" 
                                  onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Button to Create New Contact Item (for Admins) --}}
    @if(auth()->check() && auth()->user()->is_admin)
        <div class="text-center mt-4">
            <a href="{{ route('contact.create') }}" class="btn btn-success">Add New Contact Item</a>
        </div>
    @endif
</div>

{{-- JavaScript for delete confirmation --}}
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this item?");
    }
</script>
@endsection



{{-- About Content --}}
@section('about')
<div class="container py-5">
    <h1 class="text-center mb-4">About Us</h1>
    <p class="text-center text-muted">Discover more about what we offer</p>

    <div class="row justify-content-center mt-4">
        @foreach($aboutItems as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    {{-- Display Image --}}
                    @if($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" 
                             alt="{{ $item->title }}" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/200x150" 
                             alt="No Image Available" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    {{-- Card Body --}}
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text text-muted">{{ $item->temperature_range }}</p>
                        <p class="card-text">{{ $item->description }}</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Learn more...</a>
                    </div>

                    {{-- Admin Controls --}}
                    @if(auth()->check() && auth()->user()->is_admin)
                        <div class="card-footer text-center">
                            <a href="{{ route('about.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('about.delete', $item->id) }}" 
                                  method="POST" 
                                  class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Admin-only: Add New About Item --}}
    @if(auth()->check() && auth()->user()->is_admin)
        <div class="text-center mt-4">
            <a href="{{ route('about.create') }}" class="btn btn-success">Add New About Item</a>
        </div>
    @endif
</div>
@endsection

