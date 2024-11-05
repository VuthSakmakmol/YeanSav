@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Create New Page</h1>
    <form action="{{ route('admin.storePage') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Text Color:</label>
            <input type="color" name="color" id="color" class="form-control">
        </div>

        <div class="mb-3">
            <label for="font" class="form-label">Font:</label>
            <select name="font" id="font" class="form-control">
                <option value="Arial">Arial</option>
                <option value="Helvetica">Helvetica</option>
                <option value="Times New Roman">Times New Roman</option>
                <option value="Courier New">Courier New</option>
                <option value="Verdana">Verdana</option>
                <option value="Georgia">Georgia</option>
                <option value="Palatino">Palatino</option>
                <option value="Garamond">Garamond</option>
                <option value="Comic Sans MS">Comic Sans MS</option>
                <option value="Trebuchet MS">Trebuchet MS</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Page</button>
    </form>
</div>
@endsection
