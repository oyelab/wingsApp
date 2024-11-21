@extends('backEnd.layouts.master')
@section('title')
Create Slider
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
	crossorigin="anonymous"></script>

@endsection
@section('page-title')
Create Slider
@endsection
@section('body')

<body>
@endsection
	@section('content')

	<form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="container">
		@csrf
		@method('PUT')
		
		<!-- Submit Button Row -->
		<div class="row g-3 mb-3 d-flex align-items-center">
			<div class="col-6">
				<h2 class="mb-2">Edit Slider</h2>
				<h5 class="text-body-tertiary fw-bold">Update the slider details below</h5>
			</div>

			<div class="col-6 d-flex justify-content-end">
				<button type="button" class="btn btn-outline-secondary me-2 w-25" onclick="window.location.href='{{ route('sliders.index') }}'">Discard</button>
				<button type="submit" class="btn btn-outline-primary me-2 w-25" onclick="setStatus(0)">Save</button>
				<button type="submit" class="btn btn-primary w-25" onclick="setStatus(1)">Publish</button>
			</div>
		</div>

		<!-- Hidden Status Field -->
		<input type="hidden" name="status" id="status" value="{{ $slider->status }}">

		<!-- Title and Display Order Row -->
		<div class="row mb-3">
			<div class="col-md-8">
				<label for="title" class="col-md-1 col-form-label text-start">Title:</label>
				<input type="text" class="form-control" name="title" id="title" value="{{ old('title', $slider->title) }}">
				@error('title')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="col-md-4">
				<label for="order" class="col-form-label text-start">Display Order:</label>
				<select class="form-select" name="order" aria-label="Select Order">
					<option value="">Select Order</option>
					@for ($i = 1; $i <= 5; $i++)
						<option value="{{ $i }}" {{ old('order', $slider->order) == $i ? 'selected' : '' }}>{{ $i }}</option>
					@endfor
				</select>
				@error('order')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<!-- Slider Image Upload Row -->
		<div class="row mb-3">
			<div class="col mb-2">
				<label for="image" class="col-md-3 col-form-label text-start">Slider Image:</label>
				<input type="file" class="form-control" name="image" id="image" accept="image/*" onchange="previewImage(event)">
				@error('image')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>
		
		<!-- Image Preview Section -->
		<div class="row mb-3" id="imagePreviewSection" style="{{ $slider->image ? '' : 'display: none;' }}">
			<div class="col-md-5 mx-auto">
				<img class="rounded" id="imagePreview" src="{{ $sliderPath . $slider->image }}" alt="{{ $slider->title }}" style="max-width: 100%; height: auto;">
			</div>
		</div>
	</form>

	@endsection

	@section('scripts')

	<script>
		// Set status value dynamically
		function setStatus(status) {
			document.getElementById('status').value = status;
		}

		// Image preview functionality
		function previewImage(event) {
			const imagePreview = document.getElementById('imagePreview');
			imagePreview.src = URL.createObjectURL(event.target.files[0]);
			document.getElementById('imagePreviewSection').style.display = 'block';
		}

		// Remove image functionality (optional)
		function removeImage() {
			const imageInput = document.getElementById('image');
			const imagePreview = document.getElementById('imagePreview');
			imageInput.value = '';  // Clear input
			imagePreview.src = '';  // Remove preview
			document.getElementById('imagePreviewSection').style.display = 'none';
		}
	</script>

	<!-- App js -->
	<script src="{{ asset('build/js/app.js') }}"></script>
	@endsection