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
                    <input type="text" name="title[]" class="form-control" placeholder="Service Title">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description[]" class="form-control" rows="3" placeholder="Service Description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="temperature_range" class="form-label">Temperature Range</label>
                    <input type="text" name="temperature_range[]" class="form-control" placeholder="Temperature Range">
                </div>
                <div class="mb-3">
                    <label for="image_path" class="form-label">Image</label>
                    <input type="file" name="image_path[]" class="form-control">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mt-3" id="add-service">Add Another Service</button>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>
<script>
    document.getElementById('add-service').addEventListener('click', function () {
        const serviceFields = document.querySelector('.service-field').cloneNode(true);
        document.getElementById('service-fields').appendChild(serviceFields);
    });
</script>
@endsection
