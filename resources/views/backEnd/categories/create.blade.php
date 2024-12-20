@extends('backEnd.layouts.master')
@section('title')
Create Category
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
	crossorigin="anonymous"></script>

@endsection
@section('page-title')

@endsection
@section('body')

<body>
@endsection
	@section('content')

	<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="container">
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
			<div class="col-5">
				<h2 class="mb-2">Add a Category</h2>
				<h5 class="text-body-tertiary fw-bold">Your products will be displayed with categories!</h5>
			</div>

			<div class="col-7 d-flex justify-content-end">
				<button type="button" class="btn btn-outline-secondary me-2 w-25" onclick="window.location.href='{{ route('categories.index') }}'">Discard</button>
				<button type="submit" class="btn btn-outline-secondary me-2 w-25" onclick="setStatus(0)">Draft</button>
				<button type="submit" class="btn btn-primary w-25" onclick="setStatus(1)">Publish</button>
			</div>
		</div>

		<!-- Hidden Status Field -->
		<input type="hidden" name="status" id="status">

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
				<label for="choices-multiple-remove-button" class="col-form-label text-start">Select Parent:</label>
				<select name="parent_ids[]" class="form-select" id="choices-multiple-remove-button" multiple>
					<option value="">Choose one or more items!</option>
					@foreach ($categories as $category)
						@if ($category->parents->isEmpty()) <!-- Only display main categories -->
							<option value="{{ $category->id }}" 
								{{ in_array($category->id, old('parent_ids', [])) ? 'selected' : '' }}>
								{{ $category->title }}
							</option>
						@endif
					@endforeach
				</select>
			</div>
			
		</div>
		
		<!-- Description -->
		<div class="row mb-3">
			<div class="col-md-12">
				<label class="form-label" for="productdesc">Description:</label>

				<!-- Textarea to store Summernote content -->
				<textarea name="description" class="form-control">{{ old('description') }}</textarea>
				@error('description')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>


		</div>

		<!-- Category Image Upload Row -->
		<div class="row mb-3">
			<div class="col mb-2">
				<label for="image" class="col-md-3 col-form-label text-start">Category Image:</label>
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
	<!-- App js -->
	<script src="{{ asset('build/js/app.js') }}"></script>
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

		// multiple Remove CancelButton
		var multipleCancelButton = new Choices(
			'#choices-multiple-remove-button',
			{
			removeItemButton: true,
			allowHTML: true // Enable HTML rendering
			}
		);

	</script>
	
	@endsection