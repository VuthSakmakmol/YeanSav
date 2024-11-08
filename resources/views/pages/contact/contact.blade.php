@extends('layouts.app')
@section('content')
<div class="container text-center my-5">
    <h1 class="mb-4">WELCOME TO OUR CONTACT PAGE</h1>
    <p>Discover more about what we offer</p>

    <div class="row justify-content-center mt-5">
        @foreach($contactItems as $contactitem)
            <div class="col-md-4 mb-5">
                <div class="contact-item">
                    <img src="{{ asset('storage/' . $contactitem->image_path) }}" alt="{{ $contactitem->title }}" class="img-fluid mb-3" style="max-width: 100px;">
                    <h3 class="mt-3">{{ $contactitem->title }}</h3>
                    <p class="text-muted">{{ $contactitem->temperature_range }}</p>
                    <p>{{ $contactitem->description }}</p>
                    <a href="#" class="btn btn-outline-primary">Learn more...</a>
                    
                    {{-- Admin Controls --}}
                    @if(auth()->check() && auth()->user()->is_admin)
                        <div class="mt-3">
                            <a href="{{ route('contact.edit', $contactitem->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('contact.delete', $contactitem->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
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
        <a href="{{ route('contact.create') }}" class="btn btn-success mt-4">Add New Contact Item</a>
    @endif
</div>

{{-- JavaScript for delete confirmation --}}
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this item?");
    }
</script>
@endsection
