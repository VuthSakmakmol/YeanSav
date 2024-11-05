@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Admin Panel</h1>
    <a href="{{ route('admin.createPage') }}" class="btn btn-success mb-3">Add New Page</a>
    @foreach($pages as $page)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $page->title }}</h5>
                <p class="card-text">{{ $page->description }}</p>
                <a href="{{ route('admin.editPage', $page->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('admin.deletePage', $page->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
