@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1>Create New Service</h1>
    <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="service-fields">
            <div class="service-field">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Service Title" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Service Description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="temperature_range" class="form-label">Temperature Range</label>
                    <input type="text" name="temperature_range" class="form-control" placeholder="Temperature Range">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>
@endsection
