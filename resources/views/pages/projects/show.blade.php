@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $project->title }}</h1>
        <p>{{ $project->description }}</p>

        {{-- Project Main Image --}}
        @if($project->image)
            <p>Image Path: {{ $project->image }}</p> <!-- Debugging step to see the image path -->
            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" style="width: 300px;">
        @endif

        {{-- Project Details --}}
        @if($project->detail)
            <h2>Project Details:</h2>
            <p><strong>Client:</strong> {{ $project->detail->client }}</p>
            <p><strong>Size:</strong> {{ $project->detail->size }}</p>
            <p><strong>Price:</strong> ${{ number_format($project->detail->price, 2) }}</p>
            <p><strong>Location:</strong> {{ $project->detail->location }}</p>
            <p><strong>Architect:</strong> {{ $project->detail->architect }}</p>
            @if($project->detail->link)
                <p><a href="{{ $project->detail->link }}" target="_blank">More Information</a></p>
            @endif

            {{-- Project Images --}}
            @if($project->detail->images && count($project->detail->images) > 0)
                <h3>Project Images:</h3>
                @foreach($project->detail->images as $image)
                    <p>Image Path: {{ $image->image_path }}</p> <!-- Debugging step to see each image path -->
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Project Image" style="width: 200px; margin-right: 10px;">
                @endforeach
            @endif
        @endif
    </div>
@endsection
