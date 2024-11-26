<!-- resources/views/pages/create.blade.php -->

@extends('backEnd.layouts.master')
@section('css')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

@endsection
@section('content')
<div class="container mt-4">
    <h1>Create New Page</h1>

    <form action="{{ route('pages.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea id="summernote" name="content">{{ old('content') }}</textarea>
            @error('content')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Page</button>
    </form>
</div>
@endsection

@section('scripts')
<!-- Include Summernote Initialization -->
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300, // Set editor height
            placeholder: 'Enter content here...',
        });
    });
</script>
<script src="{{ asset('build/js/app.js') }}"></script>

@endsection
