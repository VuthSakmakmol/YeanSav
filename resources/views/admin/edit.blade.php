@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit Page</h1>
    <form action="{{ route('admin.updatePage', $page->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Page Title:</label>
            <select name="title" id="title" class="form-control" required>
                <option value="Home">Home</option>
                <option value="Service">Service</option>
                <option value="Work">Our Work</option>
                <option value="Contact">Contact</option>
                <option value="About">About Us</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ $page->content }}</textarea>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Color:</label>
            <input type="color" name="color" id="color" class="form-control" value="{{ $page->color }}">
        </div>

        <div class="mb-3">
            <label for="font" class="form-label">Font:</label>
            <select name="font" id="font" class="form-control">
                <option value="Arial" {{ $page->font == 'Arial' ? 'selected' : '' }}>Arial</option>
                <option value="Helvetica" {{ $page->font == 'Helvetica' ? 'selected' : '' }}>Helvetica</option>
                <option value="Times New Roman" {{ $page->font == 'Times New Roman' ? 'selected' : '' }}>Times New Roman</option>
                <option value="Courier New" {{ $page->font == 'Courier New' ? 'selected' : '' }}>Courier New</option>
                <option value="Verdana" {{ $page->font == 'Verdana' ? 'selected' : '' }}>Verdana</option>
                <option value="Georgia" {{ $page->font == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                <option value="Palatino" {{ $page->font == 'Palatino' ? 'selected' : '' }}>Palatino</option>
                <option value="Garamond" {{ $page->font == 'Garamond' ? 'selected' : '' }}>Garamond</option>
                <option value="Comic Sans MS" {{ $page->font == 'Comic Sans MS' ? 'selected' : '' }}>Comic Sans MS</option>
                <option value="Trebuchet MS" {{ $page->font == 'Trebuchet MS' ? 'selected' : '' }}>Trebuchet MS</option>
            </select>
        </div>        

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ $page->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
