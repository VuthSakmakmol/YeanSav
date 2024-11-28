@extends('layouts.app')

@section('content')
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

    <form action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div id="home-items-container">
            <div class="home-item" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
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

                <button type="button" class="btn btn-danger remove-home-item">Remove Item</button>
            </div>
        </div>

        <button type="button" id="add-home-item" class="btn btn-secondary mt-3">Add Home Item</button>
        <button type="submit" class="btn btn-primary mt-3">Create Items</button>
    </form>
</div>

{{-- JavaScript to add and remove home items --}}
<script>
    document.getElementById('add-home-item').addEventListener('click', function () {
        // Clone the first home item
        let container = document.getElementById('home-items-container');
        let newItem = container.children[0].cloneNode(true);
        
        // Clear the input values in the new item
        newItem.querySelectorAll('input, textarea').forEach(function (input) {
            if (input.type !== 'file') {
                input.value = '';
            } else {
                input.value = null;
            }
        });

        container.appendChild(newItem);
    });

    // Event delegation for removing home items
    document.getElementById('home-items-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-home-item')) {
            let homeItems = document.querySelectorAll('.home-item');
            if (homeItems.length > 1) {
                e.target.closest('.home-item').remove();
            } else {
                alert('You must have at least one item.');
            }
        }
    });
</script>
@endsection
