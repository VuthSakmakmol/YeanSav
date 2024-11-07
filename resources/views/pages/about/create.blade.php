@extends('layouts.app')

@section('content')
<div class="container text-center my-5">
    <h1>Create Multiple About Items</h1>

    <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Start of Item Block -->
        <div class="item-block">
            <input type="text" name="title[]" placeholder="Enter title" class="form-control my-2">
            <textarea name="description[]" placeholder="Enter description" class="form-control my-2"></textarea>
            <input type="text" name="temperature_range[]" placeholder="Enter temperature range" class="form-control my-2">
            <input type="file" name="image_path[]" class="form-control my-2">
        </div>
        <!-- End of Item Block -->

        <!-- Button to add more item blocks -->
        <button type="button" id="add-item" class="btn btn-secondary my-3">Add Another Item</button>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    // JavaScript to clone the item block when "Add Another Item" is clicked
    document.getElementById('add-item').addEventListener('click', function() {
        let itemBlock = document.querySelector('.item-block');
        let newItemBlock = itemBlock.cloneNode(true);
        document.querySelector('form').insertBefore(newItemBlock, document.getElementById('add-item'));
    });
</script>
@endsection
