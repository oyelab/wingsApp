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

	<form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data" class="container">
    @csrf
	@if ($errors->any())
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif

		<!-- Submit Button Row -->
		<div class="row g-3 mb-3 d-flex align-items-center">
			<div class="col-6">
				<h2 class="mb-2">Add a Slider</h2>
				<h5 class="text-body-tertiary fw-bold">Sliders will preview at the top</h5>
			</div>

			<div class="col-6 d-flex justify-content-end">
				<button type="button" class="btn btn-outline-secondary me-2 w-25" onclick="window.location.href='{{ route('sliders.index') }}'">Discard</button>
				<button type="submit" class="btn btn-outline-primary me-2 w-25" onclick="setStatus(0)">Save</button>
				<button type="submit" class="btn btn-primary w-25" onclick="setStatus(1)">Publish</button>
			</div>
		</div>

		<!-- Hidden Status Field -->
		<input type="hidden" name="status" id="status" value="0">

		<!-- Title and Display Order Row -->
		<div class="row mb-3">
			<div class="col-md-8">
				<label for="title" class="col-md-1 col-form-label text-start">Title:</label>
				<input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
				@error('title')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>

			<div class="col-md-4">
				<label for="order" class="col-form-label text-start">Display Order:</label>
				<select class="form-select" name="order" aria-label="Select Order">
					<option value="">Select Order</option>
					<option value="1" {{ old('order') == '1' ? 'selected' : '' }}>1</option>
					<option value="2" {{ old('order') == '2' ? 'selected' : '' }}>2</option>
					<option value="3" {{ old('order') == '3' ? 'selected' : '' }}>3</option>
					<option value="4" {{ old('order') == '4' ? 'selected' : '' }}>4</option>
					<option value="5" {{ old('order') == '5' ? 'selected' : '' }}>5</option>
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
		<div class="row mb-3" id="imagePreviewSection" style="display: none;">
			<div class="col-md-5 mx-auto">
				<img id="imagePreview" src="" alt="Image Preview" style="max-width: 100%; height: auto; border: 1px solid #ccc; margin-top: 10px;">
			</div>
		</div>
	</form>

	@endsection

	@section('scripts')

	<script>
		// Function to hold the status
		function setStatus(value) {
			document.getElementById('status').value = value;
		}
		// Function to preview the image
		function previewImage(event) {
			const imagePreviewSection = document.getElementById('imagePreviewSection');
			const imagePreview = document.getElementById('imagePreview');
			const file = event.target.files[0];

			if (file) {
				const reader = new FileReader();
				reader.onload = function (e) {
					imagePreview.src = e.target.result;
					imagePreviewSection.style.display = 'block'; // Show the preview section
				}
				reader.readAsDataURL(file);
			}
		}

	</script>
	
	@endsection