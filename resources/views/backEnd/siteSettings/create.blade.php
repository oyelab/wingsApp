@extends('backEnd.layouts.master')
@section('title')
Update - Site Settings
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
	crossorigin="anonymous"></script>
<style>
	.input-group {
    display: flex;
    align-items: center; /* Align items in the center */
}

.input-group .form-select,
.input-group .form-control {
    margin-right: 5px; /* Space between inputs */
}

.input-group .btn {
    margin-left: 5px; /* Space between the input fields and button */
}

</style>
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
					<img src="{{ $settings->getImagePath('og_image') }}" id="ogImagePreview" alt="OG Image Preview" style="max-width: 100%; height: auto; border: 1px solid #ccc; margin-top: 10px;">
				@endif
				@error('og_image')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
		</div>

		<!-- Logo and Favicon Upload Row -->
		<div class="row mb-3">
			<!-- Logo v1 Column -->
			<div class="col-md-4">
				<label for="logo_v1" class="col-form-label text-start">Logo v1:</label>
				<input type="file" class="form-control" name="logo_v1" id="logo_v1" accept="image/*" onchange="previewImage(event, 'logoV1Preview')">
				@if($settings && $settings->logo_v1)
					<img src="{{ $settings->getImagePath('logo_v1') }}" id="logoV1Preview" alt="Logo v1 Preview" style="max-width: 100%; height: auto; border: 1px solid #ccc; margin-top: 10px;">
				@else
					<img id="logoV1Preview" alt="Logo v1 Preview" style="max-width: 100%; height: auto; border: 1px solid #ccc; margin-top: 10px;">
				@endif
				@error('logo_v1')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>

			<!-- Logo v2 Column -->
			<div class="col-md-4">
				<label for="logo_v2" class="col-form-label text-start">Logo v2:</label>
				<input type="file" class="form-control" name="logo_v2" id="logo_v2" accept="image/*" onchange="previewImage(event, 'logoV2Preview')">
				@if($settings && $settings->logo_v2)
					<img src="{{ $settings->getImagePath('logo_v2') }}" id="logoV2Preview" alt="Logo v2 Preview" style="max-width: 100%; height: auto; border: 1px solid #ccc; margin-top: 10px;">
				@else
					<img id="logoV2Preview" alt="Logo v2 Preview" style="max-width: 100%; height: auto; border: 1px solid #ccc; margin-top: 10px;">
				@endif
				@error('logo_v2')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>

			<!-- Favicon Column -->
			<div class="col-md-4">
				<label for="favicon" class="col-form-label text-start">Favicon:</label>
				<input type="file" class="form-control" name="favicon" id="favicon" accept="image/*" onchange="previewImage(event, 'faviconPreview')">
				@if($settings && $settings->favicon)
					<img src="{{ $settings->favicon }}" id="faviconPreview" alt="Favicon Preview" style="max-width: 100%; height: auto; border: 1px solid #ccc; margin-top: 10px;">
				@else
					<img id="faviconPreview" alt="Favicon Preview" style="max-width: 100%; height: auto; border: 1px solid #ccc; margin-top: 10px;">
				@endif
				@error('favicon')
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
				<label class="col-form-label text-start">Social Links:</label>
				<div id="socialLinksContainer">
					@foreach($socialLinks as $link)
						<div class="input-group mb-2">
							<select class="form-select" name="social_platforms[]" onchange="updatePlatformSelection(this)">
								<option value="">Select Platform</option>
								<option value="Facebook" {{ $link['platform'] == 'Facebook' ? 'selected' : '' }}>Facebook</option>
								<option value="Twitter" {{ $link['platform'] == 'Twitter' ? 'selected' : '' }}>Twitter</option>
								<option value="Instagram" {{ $link['platform'] == 'Instagram' ? 'selected' : '' }}>Instagram</option>
								<option value="LinkedIn" {{ $link['platform'] == 'LinkedIn' ? 'selected' : '' }}>LinkedIn</option>
								<option value="YouTube" {{ $link['platform'] == 'YouTube' ? 'selected' : '' }}>YouTube</option>
							</select>
							<input type="text" class="form-control" name="social_usernames[]" placeholder="Enter username"
								value="{{ $link['username'] }}">
							<button class="btn btn-outline-secondary" type="button" onclick="removeLink(this)">Remove</button>
						</div>
					@endforeach
				</div>
				<button class="btn btn-primary mt-3" type="button" onclick="addSocialLink()">Add Another Link</button>
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
            URL.revokeObjectURL(output.src); // free memory
        }
    }
</script>
<script>
	// Array to keep track of selected platforms
	let selectedPlatforms = [];

	// Function to add a new social link input
	function addSocialLink() {
		const socialLinksContainer = document.getElementById('socialLinksContainer');

		// Create a new input group for the social link
		const inputGroup = document.createElement('div');
		inputGroup.className = 'input-group mb-2';

		// Create the select input for the platform
		const platformSelect = document.createElement('select');
		platformSelect.className = 'form-select';
		platformSelect.name = 'social_platforms[]';
		platformSelect.onchange = function() { updatePlatformSelection(this); };

		// Add options to the select input
		platformSelect.innerHTML = `
			<option value="">Select Platform</option>
			<option value="Facebook">Facebook</option>
			<option value="Twitter">Twitter</option>
			<option value="Instagram">Instagram</option>
			<option value="LinkedIn">LinkedIn</option>
			<option value="YouTube">YouTube</option>
		`;

		// Create the input for the username
		const usernameInput = document.createElement('input');
		usernameInput.type = 'text';
		usernameInput.className = 'form-control';
		usernameInput.placeholder = 'Enter username';
		usernameInput.name = 'social_usernames[]';

		// Create the remove button
		const removeButton = document.createElement('button');
		removeButton.className = 'btn btn-outline-secondary';
		removeButton.type = 'button';
		removeButton.onclick = function() { removeLink(this); };
		removeButton.innerText = 'Remove';

		// Append the elements to the input group
		inputGroup.appendChild(platformSelect);
		inputGroup.appendChild(usernameInput);
		inputGroup.appendChild(removeButton);

		// Append the input group to the container
		socialLinksContainer.appendChild(inputGroup);

		// Call update to hide selected platforms
		updateAvailablePlatforms();
	}

	// Function to update the platform selection and remove it from future selections
	function updatePlatformSelection(select) {
		const selectedPlatform = select.value;

		// Add selected platform to the array if it's a new selection
		if (selectedPlatform && !selectedPlatforms.includes(selectedPlatform)) {
			selectedPlatforms.push(selectedPlatform);
		}

		// Update the available platforms in all select boxes
		updateAvailablePlatforms();
	}

	// Function to remove a link input
	function removeLink(button) {
		const inputGroup = button.parentElement;
		const platformSelect = inputGroup.querySelector('select');

		// Remove the platform from selectedPlatforms array
		const platformValue = platformSelect.value;
		if (platformValue) {
			selectedPlatforms = selectedPlatforms.filter(platform => platform !== platformValue);
		}

		// Remove the input group from the DOM
		inputGroup.remove();
		
		// Update available platforms after removal
		updateAvailablePlatforms();
	}

	// Function to update the available platforms in the select inputs
	function updateAvailablePlatforms() {
		const selects = document.querySelectorAll('select[name="social_platforms[]"]');

		// Loop through each select input to update options
		selects.forEach(select => {
			const currentPlatform = select.value; // Store the currently selected platform
			const options = select.querySelectorAll('option');

			// Loop through options, hiding already selected platforms, but keeping the current one visible
			options.forEach(option => {
				if (selectedPlatforms.includes(option.value) && option.value !== currentPlatform) {
					option.style.display = 'none'; // Hide selected options that aren't the current one
				} else {
					option.style.display = ''; // Show available options
				}
			});
		});
	}

	// Initial call to set up the platforms based on existing entries (if any)
	document.addEventListener('DOMContentLoaded', () => {
		const existingSelects = document.querySelectorAll('select[name="social_platforms[]"]');
		existingSelects.forEach(select => {
			const selectedPlatform = select.value;
			if (selectedPlatform) {
				selectedPlatforms.push(selectedPlatform);
			}
		});
		updateAvailablePlatforms();
	});


</script>
@endsection