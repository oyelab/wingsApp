<!-- resources/views/pages/edit.blade.php -->

@extends('backEnd.layouts.master')
@section('css')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

@endsection
@section('title')
Update Page
@endsection
@section('content')
<div class="container">
    <h1>Edit Page</h1>

    <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		
		<div class="mb-3">
			<label for="title" class="form-label">Title</label>
			<input type="text" class="form-control" id="title" name="title" value="{{ old('title', $page->title) }}" required>
			@error('title')
			<div class="text-danger">{{ $message }}</div>
			@enderror
		</div>
		
		<div class="mb-3">
			<label for="second_title" class="form-label">Second Title</label>
			<input type="text" class="form-control" id="second_title" name="second_title" value="{{ old('second_title', $page->second_title) }}">
			@error('second_title')
			<div class="text-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}">
			@error('image')
			<div class="text-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="content" class="form-label">Content</label>
			<textarea id="summernote" name="content">{!! old('content', $page->content) !!}</textarea>
			@error('content')
			<div class="text-danger">{{ $message }}</div>
			@enderror
		</div>

		<button type="submit" class="btn btn-primary">Save</button>
	</form>

</div>
@endsection

@section('scripts')

<!-- Initialize Summernote -->
<script>

    // Initialize Summernote
    $('#summernote').summernote({
        // height: 200,  // Set editor height
        placeholder: 'Enter Product Description',
        callbacks: {
            onChange: function (contents, $editable) {
                // Sync Summernote content to the textarea
                $('#productdesc').val(contents);
            }
        }
    });
</script>
<script src="{{ asset('build/js/app.js') }}"></script>

@endsection
