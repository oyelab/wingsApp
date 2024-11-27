@extends('backEnd.layouts.master')

@section('body')

    <body>
    @endsection
		@section('content')
		<div class="container">
			<form action="{{ route('showcases.update', $showcase->id) }}" method="POST" enctype="multipart/form-data">
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
						<h2 class="mb-2">Edit Showcase</h2>
					</div>

					<div class="col-6 d-flex justify-content-end">
						<button type="button" class="btn btn-outline-secondary me-2 w-25" onclick="window.location.href='{{ route('showcases.index') }}'">Discard</button>
						<button type="submit" class="btn btn-outline-primary me-2 w-25" onclick="setStatus(0)">Save</button>
						<button type="submit" class="btn btn-primary w-25" onclick="setStatus(1)">Publish</button>
					</div>
				</div>

				<!-- Hidden Status Field -->
				<input type="hidden" name="status" id="status" value="{{ old('status', $showcase->status) }}">

				<!-- Title and Order -->
				<div class="row mb-3">
					<!-- Title -->
					<div class="col-md-6">
						<label for="title" class="form-label">Title</label>
						<input type="text" name="title" id="title" class="form-control" value="{{ old('title', $showcase->title) }}">
					</div>

					<!-- Order -->
					<div class="col-md-6">
						<label for="order" class="form-label">Order</label>
						<select name="order" id="order" class="form-select">
							@for ($i = 1; $i <= 5; $i++)
								<option value="{{ $i }}" {{ old('order', $showcase->order) == $i ? 'selected' : '' }}>{{ $i }}</option>
							@endfor
						</select>
					</div>
				</div>

				<!-- Description -->
				<div class="mb-3">
					<label for="short_description" class="form-label">Short Description</label>
					<textarea name="short_description" id="short_description" class="form-control" rows="3">{{ old('short_description', $showcase->short_description) }}</textarea>
				</div>

				<!-- Banner -->
				<div class="mb-3">
					<label for="banner" class="form-label">Banner Image</label>
					@if ($showcase->banner)
						<div class="image-preview">
							<img src="{{  $showcase->bannerImagePath }}" alt="Banner Image" style="width: 100px; height: 100px; object-fit: cover;">
							<button type="button" class="btn btn-danger btn-sm remove-image" data-image="banner">&times;</button>
							<input type="hidden" name="banner_old" value="{{ $showcase->banner }}">
						</div>
					@endif
					<input type="file" name="banner" id="banner" class="form-control">
				</div>

				<!-- Thumbnail Image -->
				<div class="mb-3">
					<label for="thumbnail" class="form-label">Thumbnail Image</label>
					@if ($showcase->thumbnail)
						<div class="image-preview">
							<img src="{{  $showcase->thumbnailImagePath }}" alt="Thumbnail Image" style="width: 100px; height: 100px; object-fit: cover;">
							<button type="button" class="btn btn-danger btn-sm remove-image" data-image="thumbnail">&times;</button>
							<input type="hidden" name="thumbnail_old" value="{{ $showcase->thumbnail }}">
						</div>
					@endif
					<input type="file" name="thumbnail" id="thumbnail" class="form-control">
				</div>

				<!-- Showcase Details -->
				<div id="details-container">
					<h3>Showcase Details</h3>

					<!-- Loop through details if there are any old values -->
					@foreach ($showcase->details as $index => $detail)
						<div class="detail-item mb-3">
							<label for="details[{{ $index }}][heading]" class="form-label">Heading</label>
							<input type="text" name="details[{{ $index }}][heading]" class="form-control" value="{{ old('details.' . $index . '.heading', $detail->heading) }}">

							<label for="details[{{ $index }}][description]" class="form-label">Description</label>
							<textarea name="details[{{ $index }}][description]" class="form-control" rows="3">{{ old('details.' . $index . '.description', $detail->description) }}</textarea>

							<!-- Image Upload -->
							<label for="details[{{ $index }}][images]" class="form-label">Images</label>
							@if ($detail->images)
								@foreach ($detail->image_paths as $image)
									<div class="image-preview">
										<img src="{{ $image }}" alt="Detail Image" style="width: 100px; height: 100px; object-fit: cover;">
										<button type="button" class="btn btn-danger btn-sm remove-image" data-image="detail_{{ $index }}_{{ $loop->index }}">&times;</button>
										<input type="hidden" name="details[{{ $index }}][images_old][]" value="{{ $image }}">
									</div>
								@endforeach

							@endif
							<input type="file" name="details[{{ $index }}][images][]" class="form-control images-input" multiple>

							<!-- Add and Remove Buttons -->
							<div class="mt-2">
								<button type="button" class="btn btn-secondary btn-sm add-detail">Add More</button>
								<button type="button" class="btn btn-danger btn-sm remove-detail">Remove</button>
							</div>
						</div>
					@endforeach

					<!-- Add New Detail (if no old details exist) -->
					@if (count($showcase->details) === 0)
						<div class="detail-item mb-3">
							<label for="details[0][heading]" class="form-label">Heading</label>
							<input type="text" name="details[0][heading]" class="form-control" value="{{ old('details.0.heading') }}">

							<label for="details[0][description]" class="form-label">Description</label>
							<textarea name="details[0][description]" class="form-control" rows="3">{{ old('details.0.description') }}</textarea>

							<!-- Image Upload -->
							<label for="details[0][images]" class="form-label">Images</label>
							<input type="file" name="details[0][images][]" class="form-control images-input" multiple>

							<!-- Image Preview Section -->
							<div class="image-preview-container mt-3 d-flex flex-wrap gap-2"></div>

							<!-- Add and Remove Buttons -->
							<div class="mt-2">
								<button type="button" class="btn btn-secondary btn-sm add-detail">Add More</button>
							</div>
						</div>
					@endif
				</div>
			</form>
		</div>
	@endsection

	@section('scripts')
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			let detailCount = {{ count($showcase->details) ?: 1 }};

			// Add More Details Button
			document.getElementById('details-container').addEventListener('click', function (e) {
				if (e.target.classList.contains('add-detail')) {
					const currentDetail = e.target.closest('.detail-item');
					const newDetailHtml = `
						<div class="detail-item mb-3">
							<label for="details[${detailCount}][heading]" class="form-label">Heading</label>
							<input type="text" name="details[${detailCount}][heading]" class="form-control">

							<label for="details[${detailCount}][description]" class="form-label">Description</label>
							<textarea name="details[${detailCount}][description]" class="form-control" rows="3"></textarea>

							<!-- Image Upload -->
							<label for="details[${detailCount}][images]" class="form-label">Images</label>
							<input type="file" name="details[${detailCount}][images][]" class="form-control images-input" multiple>

							<!-- Image Preview Section -->
							<div class="image-preview-container mt-3 d-flex flex-wrap gap-2"></div>

							<!-- Add and Remove Buttons -->
							<div class="mt-2">
								<button type="button" class="btn btn-secondary btn-sm add-detail">Add More</button>
								<button type="button" class="btn btn-danger btn-sm remove-detail">Remove</button>
							</div>
						</div>
					`;

					// Insert new detail after the current one
					currentDetail.insertAdjacentHTML('afterend', newDetailHtml);
					detailCount++;
				}
			});

			// Remove Detail Button
			document.getElementById('details-container').addEventListener('click', function (e) {
				if (e.target.classList.contains('remove-detail')) {
					e.target.closest('.detail-item').remove();
				}
			});

			// Handle Image Upload and Preview
			document.getElementById('details-container').addEventListener('change', function (e) {
				if (e.target.classList.contains('images-input')) {
					const input = e.target;
					const previewContainer = input.closest('.detail-item').querySelector('.image-preview-container');
					previewContainer.innerHTML = ""; // Clear previous previews

					if (input.files) {
						Array.from(input.files).forEach((file) => {
							const reader = new FileReader();
							reader.onload = function (event) {
								const previewHtml = `
									<div class="image-preview" style="position: relative; display: inline-block;">
										<img src="${event.target.result}" alt="Preview" style="width: 100px; height: 100px; object-fit: cover;">
										<button type="button" class="btn btn-danger btn-sm remove-image" style="position: absolute; top: 5px; right: 5px;">&times;</button>
									</div>
								`;
								previewContainer.insertAdjacentHTML('beforeend', previewHtml);
							};
							reader.readAsDataURL(file);
						});
					}
				}
			});

			// Remove Individual Image Preview
			document.getElementById('details-container').addEventListener('click', function (e) {
				if (e.target.classList.contains('remove-image')) {
					e.target.closest('.image-preview').remove();
				}
			});
		});
	</script>
	@endsection
