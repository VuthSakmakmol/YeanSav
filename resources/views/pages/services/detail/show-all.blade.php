@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Service Details for "{{ $service->title }}"</h1>

        @if($serviceDetails->isEmpty())
            <div class="alert alert-warning">
                No details available for this service.
            </div>
        @else
            <div class="row">
                @foreach($serviceDetails as $detail)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Detail #{{ $detail->id }}</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Client:</strong> {{ $detail->client ?? 'N/A' }}</p>
                                <p><strong>Location:</strong> {{ $detail->location ?? 'N/A' }}</p>
                                <p><strong>Year Completed:</strong> {{ $detail->year_completed ?? 'N/A' }}</p>
                                <p><strong>Surface Area:</strong> {{ $detail->surface_area ?? 'N/A' }}</p>
                                <p><strong>Value:</strong> ${{ $detail->value ?? 'N/A' }}</p>
                                <p><strong>Architect:</strong> {{ $detail->architect ?? 'N/A' }}</p>
                                <p><strong>Description:</strong> {{ $detail->description ?? 'N/A' }}</p>

                                @if($detail->image)
                                    <div class="text-center mb-3">
                                        <img src="{{ asset('storage/' . $detail->image) }}" 
                                             alt="Service Detail Image" 
                                             class="img-fluid rounded" style="max-height: 200px;">
                                    </div>
                                @else
                                    <p><strong>Image:</strong> No image available</p>
                                @endif
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('service.detail.show', ['service' => $service->id, 'serviceDetail' => $detail->id]) }}"
                                   class="btn btn-info btn-sm">View</a>
                                @auth
                                    @if(auth()->user()->is_admin)
                                        <a href="{{ route('service.detail.edit', ['service' => $service->id, 'serviceDetail' => $detail->id]) }}"
                                           class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('service.detail.destroy', ['service' => $service->id, 'serviceDetail' => $detail->id]) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('Are you sure you want to delete this detail?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('service.detail.create', $service->id) }}" class="btn btn-primary">
            Add New Detail
        </a>
    </div>
@endsection
