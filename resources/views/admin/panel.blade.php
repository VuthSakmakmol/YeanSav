@extends('layouts.app')
   @section('content')
   <h1>Admin Panel</h1>
   <form action="{{ route('admin.updatePage') }}" method="POST">
       @csrf
       <label for="title">Page Title:</label>
       <input type="text" name="title" id="title" value="{{ $page->title }}">
       <label for="content">Content:</label>
       <textarea name="content" id="content">{{ $page->content }}</textarea>
       <button type="submit">Update Page</button>
   </form>
   @endsection