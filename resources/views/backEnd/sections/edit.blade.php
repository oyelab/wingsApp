<!-- resources/views/pages/edit.blade.php -->

@extends('backEnd.layouts.master')

@section('content')
<div class="container">
    <form action="{{ route('sections.update', $section->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<input type="hidden" name="status" id="status">

		
		<!-- Submit Button Row -->
		<div class="row g-3 mb-3 d-flex align-items-center">
			<div class="col-5">
				<h2 class="mb-2">Edit Section</h2>
				<h5 class="text-body-tertiary fw-bold">Section will displayed across the website!</h5>
			</div>

			<div class="col-7 d-flex justify-content-end">
				<button type="button" class="btn btn-outline-secondary me-2 w-25" onclick="window.location.href='{{ route('sections.index') }}'">Discard</button>
				<button type="submit" class="btn btn-outline-secondary me-2 w-25" onclick="setStatus(0)">Draft</button>
				<button type="submit" class="btn btn-primary w-25" onclick="setStatus(1)">Publish</button>
			</div>
		</div>

		<div class="mb-3">
			<label for="title" class="form-label">Title</label>
			<input type="text" class="form-control" id="title" name="title" value="{{ old('title', $section->title) }}">
		</div>

		<div class="mb-3">
			<label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}">
		</div>

		<div class="mb-3">
			<label for="content" class="form-label">Description</label>
			<textarea id="description" class="form-control" name="description">{{ old('description', $section->description) }}</textarea>
		</div>
	</form>

</div>
@endsection

@section('scripts')
<script>
	function setStatus(status) {
    // Set the value of the hidden status input before submitting the form
    document.getElementById('status').value = status;
}

</script>
<script src="{{ asset('build/js/app.js') }}"></script>

@endsection
