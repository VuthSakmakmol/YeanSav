@extends('layouts.app')
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
