@extends('layouts.app')
@section('content')
@if($page)
<div class="text-center" style="color: {{ $page->color }}; font-family: {{ $page->font }};">
    <h1>{{ $page->title }}</h1>
    <img src="{{ asset('storage/' . $page->image_path) }}" alt="Home Image" class="img-fluid my-3">

    <p>{{ $page->description }}</p>
    <p>{{ $page->content }}</p>

    {{-- Admin Controls --}} 
    @if(auth()->check() && auth()->user()->is_admin)
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('admin.createPage') }}" class="btn btn-success mx-2">Insert New Page</a>
            <a href="{{ route('admin.editPage', $page->id) }}" class="btn btn-primary mx-2">Edit Page</a>
            <form action="{{ route('admin.updatePage', $page->id) }}" method="POST" class="d-inline mx-2">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-info">Update Page</button>
            </form>
            <form action="{{ route('admin.deletePage', $page->id) }}" method="POST" class="d-inline mx-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Page</button>
            </form>
        </div>
    @endif
</div>
@else
<div class="text-center" style="color: #000000; font-family: Arial;">
    <h1>Default Title</h1>
    <img src="{{ asset('images/default.webp') }}" alt="Default Home Image" class="img-fluid my-3 w-50">
    <p>Default Description </p>
    <p>Default Content</p>
</div>
@endif
@endsection
