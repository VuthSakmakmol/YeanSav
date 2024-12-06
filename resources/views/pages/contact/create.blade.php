@extends('layouts.app')

@section('contact')
<div class="container my-5">
    <h2>Create Multiple Home Items</h2>

    {{-- Display errors, if any --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div id="contact-items-container">
            <div class="contact-item" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <h4>Home Item</h4>
                <div class="mb-3">
                    <label for="title[]" class="form-label">Title</label>
                    <input type="text" name="title[]" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="description[]" class="form-label">Description</label>
                    <textarea name="description[]" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="temperature_range[]" class="form-label">Temperature Range (Optional)</label>
                    <input type="text" name="temperature_range[]" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="image_path[]" class="form-label">Image (Optional)</label>
                    <input type="file" name="image_path[]" class="form-control" accept="image/*">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Items</button>
    </form>
</div>

@endsection
