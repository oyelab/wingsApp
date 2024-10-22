@extends('backEnd.layouts.master')
@section('title')
Update - Site Settings
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
	crossorigin="anonymous"></script>

@endsection
@section('page-title')
Update your site settings
@endsection
@section('body')

<body>
@endsection
	@section('content')

	<form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

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
				<h2 class="mb-2">Add Site Settings</h2>
			</div>

			<div class="col-6 d-flex justify-content-end">
				<button type="button" class="btn btn-outline-secondary me-2 w-25" onclick="window.location.href='{{ route('settings.index') }}'">Discard</button>
				<button type="submit" class="btn btn-primary w-25">Publish</button>
			</div>
		</div>

		<!-- Title Row -->
		<div class="row mb-3">
			<div class="col-md-12">
				<label for="title" class="col-md-1 col-form-label text-start">Site Title:</label>
				<input type="text" class="form-control" name="title" id="title" value="{{ old('title', $settings->title ?? '') }}">
				@error('title')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<!-- Description Row -->
		<div class="row mb-3">
			<div class="col-md-12">
				<label for="description" class="col-form-label text-start">Description:</label>
				<textarea class="form-control" name="description" id="description">{{ old('description', $settings->description ?? '') }}</textarea>
				@error('description')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<!-- Keywords Row -->
		<div class="row mb-3">
			<div class="col-md-12">
				<label for="keywords" class="col-form-label text-start">Keywords:</label>
				<textarea class="form-control" name="keywords" id="keywords">{{ old('keywords', $settings->keywords ?? '') }}</textarea>
				@error('keywords')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<!-- OG Image Upload Row -->
		<div class="row mb-3">
			<div class="col-md-12">
				<label for="og_image" class="col-form-label text-start">OG Image:</label>
				<input type="file" class="form-control" name="og_image" id="og_image" accept="image/*" onchange="previewImage(event, 'ogImagePreview')">
				@if($settings && $settings->og_image)
					<img src="{{ asset('storage/' . $settings->og_image) }}" id="ogImagePreview" alt="OG Image Preview" style="max-width: 100%; height: auto; border: 1px solid #ccc; margin-top: 10px;">
				@endif
				@error('og_image')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<!-- Logo v1 Upload Row -->
		<div class="row mb-3">
			<div class="col-md-12">
				<label for="logo_v1" class="col-form-label text-start">Logo v1:</label>
				<input type="file" class="form-control" name="logo_v1" id="logo_v1" accept="image/*" onchange="previewImage(event, 'logoV1Preview')">
				@if($settings && $settings->logo_v1)
					<img src="{{ asset('storage/' . $settings->logo_v1) }}" id="logoV1Preview" alt="Logo v1 Preview" style="max-width: 100%; height: auto; border: 1px solid #ccc; margin-top: 10px;">
				@endif
				@error('logo_v1')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<!-- Logo v2 Upload Row -->
		<div class="row mb-3">
			<div class="col-md-12">
				<label for="logo_v2" class="col-form-label text-start">Logo v2:</label>
				<input type="file" class="form-control" name="logo_v2" id="logo_v2" accept="image/*" onchange="previewImage(event, 'logoV2Preview')">
				@if($settings && $settings->logo_v2)
					<img src="{{ asset('storage/' . $settings->logo_v2) }}" id="logoV2Preview" alt="Logo v2 Preview" style="max-width: 100%; height: auto; border: 1px solid #ccc; margin-top: 10px;">
				@endif
				@error('logo_v2')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<!-- Email Row -->
		<div class="row mb-3">
			<div class="col-md-12">
				<label for="email" class="col-form-label text-start">Email:</label>
				<input type="email" class="form-control" name="email" id="email" value="{{ old('email', $settings->email ?? '') }}">
				@error('email')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<!-- Phone Row -->
		<div class="row mb-3">
			<div class="col-md-12">
				<label for="phone" class="col-form-label text-start">Phone:</label>
				<input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $settings->phone ?? '') }}">
				@error('phone')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<!-- Address Row -->
		<div class="row mb-3">
			<div class="col-md-12">
				<label for="address" class="col-form-label text-start">Address:</label>
				<input type="text" class="form-control" name="address" id="address" value="{{ old('address', $settings->address ?? '') }}">
				@error('address')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<!-- Social Links Row -->
		<div class="row mb-3">
			<div class="col-md-12">
				<label for="social_links" class="col-form-label text-start">Social Links:</label>
				<div id="socialLinksContainer">
					<div class="input-group mb-2">
						<input type="url" class="form-control" name="social_links[]" placeholder="Enter social link" value="{{ old('social_links.0', $settings->social_links[0] ?? '') }}">
						<button class="btn btn-outline-secondary" type="button" onclick="removeLink(this)">Remove</button>
					</div>
					<div class="input-group mb-2">
						<input type="url" class="form-control" name="social_links[]" placeholder="Enter social link" value="{{ old('social_links.1', $settings->social_links[1] ?? '') }}">
						<button class="btn btn-outline-secondary" type="button" onclick="removeLink(this)">Remove</button>
					</div>
					<!-- Add more input fields as needed -->
				</div>
				<button type="button" class="btn btn-primary" onclick="addSocialLink()">Add Another Link</button>
				@error('social_links')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</form>

	@endsection

	@section('scripts')
	<script>
		function previewImage(event, previewId) {
			const output = document.getElementById(previewId);
			output.src = URL.createObjectURL(event.target.files[0]);
			output.onload = function() {
				URL.revokeObjectURL(output.src) // free memory
			}
		}
	</script>
	<script>
		function addSocialLink() {
			const container = document.getElementById('socialLinksContainer');
			const inputGroup = document.createElement('div');
			inputGroup.className = 'input-group mb-2';
			inputGroup.innerHTML = `
				<input type="url" class="form-control" name="social_links[]" placeholder="Enter social link">
				<button class="btn btn-outline-secondary" type="button" onclick="removeLink(this)">Remove</button>
			`;
			container.appendChild(inputGroup);
		}

		function removeLink(button) {
			const inputGroup = button.parentElement;
			inputGroup.remove();
		}
	</script>

	@endsection