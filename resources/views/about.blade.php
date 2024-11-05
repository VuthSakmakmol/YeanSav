@extends('layouts.app')
   @section('content')
   @if($page)
   <div class="text-center" style="color: {{ $page->color }}; font-family: {{ $page->font }};">
       <h1>{{ $page->title }}</h1>
       <img src="{{ asset('storage/' . $page->image_path) }}" alt="Home Image" class="img-fluid my-3">
       <p>{{ $page->description }}</p>
       <p>{{ $page->content }}</p>
   </div>
   @else
   <div class="text-center" style="color: #000000; font-family: Arial;">
       <h1>Default Title</h1>
       <img src="{{ asset('images/default.jpg') }}" alt="Default Home Image" class="img-fluid my-3">
       <p>Default Description</p>
       <p>Default Content</p>
   </div>
   @endif
   @endsection