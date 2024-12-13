@extends('backEnd.layouts.master')
@section('title')
    Add Product
@endsection
@section('css')
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
	<style>
        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .preview-item {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            display: inline-block;
            width: 150px;
        }
        .preview-item img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }
        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-align: center;
            cursor: pointer;
        }
        .thumbnail-selected {
            border: 3px solid #1e1e1e; /* Matches your theme's primary color */
            border-radius: 5px;
            padding: 2px;
        }
        /* Styled drop area for images */
        #file-input-container {
            width: 100px;
			height: 100px;
            padding: 20px;
            border: 2px dashed #ddd;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            background-color: #f8f9fa;
        }
        #file-input-container:hover {
            border-color: #007bff;
        }
        #file-input-container i {
            font-size: 40px;
            color: #007bff;
        }
        #file-input-container p {
            color: #007bff;
        }
        #file-input-container.dragover {
            background-color: #e9ecef;
            border-color: #007bff;
        }
    </style>
@endsection
@section('page-title')
    Add Product
@endsection
@section('body')

    <body>
    @endsection
    @section('content')

		<div id="error-container"></div>


		<div class="row">
			<div class="col-lg-12">
				<div id="addproduct-accordion" class="custom-accordion">
					<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
						
						@csrf
						<div class="card">
							<a href="#addproduct-productinfo-collapse" class="text-body" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-productinfo-collapse">
								<div class="p-4">
									<div class="d-flex align-items-center">
										<div class="flex-shrink-0 me-3">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-subtle text-primary">
													<h5 class="text-primary font-size-17 mb-0">01</h5>
												</div>
											</div>
										</div>
										<div class="flex-grow-1 overflow-hidden">
											<h5 class="font-size-16 mb-1">Product Info</h5>
											<p class="text-muted text-truncate mb-0">Fill all information below</p>
										</div>
										<div class="flex-shrink-0">
											<i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
										</div>
									</div>
								</div>
							</a>
							<div id="addproduct-productinfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
								<div class="p-4 border-top">
									<div class="row">

										<div class="col-lg-8 d-flex gap-3">
											<!-- Main Category -->
											<div class="flex-grow-1">
												<label class="form-label" for="mainCategory">Select Category <span class="text-danger">*</span></label>
												<select id="mainCategory" name="category" class="form-control">
													<option value="">-- Select Main Category --</option>
													@foreach ($categories as $category)
														<option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
															{{ $category->title }}
														</option>
													@endforeach
												</select>
												@error('category') <div class="text-danger">{{ $message }}</div> @enderror
											</div>

											<!-- Subcategory -->
											<div class="flex-grow-1">
												<label class="form-label" for="subCategory">Select Subcategory <span class="text-danger">*</span></label>
												<select id="subCategory" name="subcategory" class="form-control">
													<option value="">-- Select Subcategory --</option>
													<!-- Options will be populated dynamically -->
												</select>
												@error('subcategory') <div class="text-danger">{{ $message }}</div> @enderror
											</div>
										</div>
										<div class="col-lg-4">
											<div class="mb-3">
												<label class="form-label" for="price">Price</label>
												<input 
													id="price" 
													name="price" 
													placeholder="Enter Price" 
													type="text" 
													class="form-control" 
													value="{{ old('price') }}" 			
												>
												<span class="text-danger error-message" style="display: none;" data-for="price">Please enter a valid price.</span>
											</div>
										</div>
									</div>

									<div class="mb-3">
										<label class="form-label" for="productname">Product Title <span class="text-danger">*</span></label>
										<input id="productname" name="title" placeholder="Enter Product Name" type="text" class="form-control" value="{{ old('title') }}">
									</div>
										

									<div class="mb-0">
										<div class="card">
											<div class="card-header">
												<h4 class="card-title">Enter quantity of each size</h4>
											</div>
											<div class="card-body">
												<div class="table-responsive">
													<table class="table mb-0 table-bordered text-center" style="table-layout: fixed; width: 100%;">
														<thead>
															<tr>
																@foreach ($sizes as $size)
																<th><label for="quantity_{{ $size->id }}">{{ $size->name }}</label></th>
																@endforeach
															</tr>
														</thead>
														<tbody>
															<tr>
																@foreach ($sizes as $size)
																<td>
																	<input type="number" class="form-control" 
																		name="quantities[{{ $size->id }}]" 
																		id="quantity_{{ $size->id }}" 
																		min="0" 
																		{{-- Use old() to retain the value after validation errors --}}
																		value="{{ old('quantities.' . $size->id) }}">
																</td>
																@endforeach
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<!-- Specifications Section -->
										<div class="form-group mt-3">
											<label class="form-label">Specifications</label>
											<div class="d-flex flex-wrap gap-3">
												@foreach($specifications as $specification)
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="specifications[]" id="spec-{{ $specification->id }}" value="{{ $specification->id }}" 
															{{ (is_array(old('specifications')) && in_array($specification->id, old('specifications'))) ? 'checked' : '' }}>
														<label class="form-check-label text-truncate" for="spec-{{ $specification->id }}">
															{{ $specification->item }}
														</label>
													</div>
												@endforeach
											</div>
										</div>


									</div>


									<!-- Product Description Field with Quill Editor and Hidden Input -->
									<div class="mb-0 mt-5">
										<label class="form-label" for="productdesc">Product Description <span class="text-danger">*</span></label>

										<!-- Textarea to store Summernote content -->
										<textarea id="summernote" name="description" class="form-control" rows="10">{{ old('description') }}</textarea>
										<span class="text-danger error-message" style="display: none;" data-for="productdesc">Please enter a description.</span>
									</div>
									
									<div class="form-group mt-4">
										<label for="images">Upload Photos <span class="text-danger">*</span></label>
										<div class="d-flex align-items-center gap-2">
											<!-- Preview Container for images -->
											<div class="preview-container" id="preview-container"></div>

											<!-- File input container with drop zone and icon -->
											<div id="file-input-container">
												<i class="fas fa-upload"></i>
												<input type="file" name="images[]" class="form-control mb-3" accept="image/*" multiple hidden id="file-input">
											</div>

										</div>
									</div>

								</div>
							</div>
						</div>


						<div class="card">
							<a href="#addproduct-metadata-collapse" class="text-body collbodyd" data-bs-toggle="collapse" aria-expanded="false" aria-controls="addproduct-metadata-collapse">
								<div class="p-4">
									<div class="d-flex align-items-center">
										<div class="flex-shrink-0 me-3">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-subtle text-primary">
													<h5 class="text-primary font-size-17 mb-0">02</h5>
												</div>
											</div>
										</div>
										<div class="flex-grow-1 overflow-hidden">
											<h5 class="font-size-16 mb-1">Meta Data</h5>
											<p class="text-muted text-truncate mb-0">Fill all information below</p>
										</div>
										<div class="flex-shrink-0">
											<i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
										</div>
									</div>
								</div>
							</a>

							<div id="addproduct-metadata-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
								<div class="p-4 border-top">
									<div class="row">
										<div class="col-sm-6">
											<div class="mb-3">
												<label class="form-label" for="metatitle">Meta Title</label>
												<input id="metatitle" name="meta_title" placeholder="Enter Title" type="text" class="form-control" value="{{ old('meta_title') }}">
											</div>
										</div>

										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label for="choices-text-remove-button" class="form-label">Keywords</label>
												
												<input class="form-control" name="keywords[]" value="{{ old('keywords.0') }}" id="choices-text-remove-button" type="text" placeholder="Enter something" />
											</div>
										</div>

									</div>

									<div class="mb-0">
										<label class="form-label" for="metadescription">Meta Description</label>
										<textarea class="form-control" id="metadescription" name="meta_desc" placeholder="Enter Description" rows="4">{{ old('meta_desc') }}</textarea>
									</div>
									<div class="mt-3">
										<label class="form-label" for="ogImage">Upload Open Graph Image</label>
										<input id="ogImage" name="og_image" type="file" class="form-control" accept="image/*">
									</div>
								</div>
							</div>
						</div>


						<div class="text-center mx-auto col-lg-12 sticky-container mb-4">
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-success mt-3">Submit</button>

								<a href="javascript:history.back()" class="btn btn-secondary btn-lg">
									<i class="bx bx-x me-1"></i> Cancel
								</a>

							</div>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	@endsection
	

    @section('scripts')

	<script>
		// Function to preview images
		function previewImages(event) {
			const imagePreviewContainer = document.getElementById('previewProductImage');
			imagePreviewContainer.innerHTML = ''; // Clear previous images
			const files = event.target.files;
			// Loop through each selected file
			for (let i = 0; i < files.length; i++) {
				const file = files[i];
				const reader = new FileReader();
				reader.onload = function (e) {
					// Create a div for each image
					const imgDiv = document.createElement('div');
					imgDiv.className = 'img-div';
					imgDiv.id = 'prev-img-div-' + i; // Assign an ID to the div
					imgDiv.innerHTML = `
						<img src="${e.target.result}" class="img-responsive image img-thumbnail" title="${file.name}">
						<input type="hidden" name="existing_images[]" value="${file.name}"> <!-- Hidden input for existing images -->
						<div class="middle">
							<button id="remove-prev-image" class="btn btn-danger" onclick="removeImage(this)">
								<i class="fa fa-trash"></i>
							</button>
						</div>
					`;
					imagePreviewContainer.appendChild(imgDiv);
				};
				reader.readAsDataURL(file); // Read the file as a data URL
			}
		}
		// Function to remove an image preview
		function removeImage(button) {
			const imgDiv = button.parentElement.parentElement; // Get the parent div
			imgDiv.remove(); // Remove the image div
		}
		
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const mainCategorySelect = document.getElementById('mainCategory');
			const subCategorySelect = document.getElementById('subCategory');

			// Preselect old subcategory value if it exists
			const oldSubcategory = '{{ old('subcategory') }}';
			if (oldSubcategory) {
				subCategorySelect.value = oldSubcategory;
			}

			// When a main category is selected, fetch subcategories
			mainCategorySelect.addEventListener('change', function () {
				const mainCategoryId = this.value;

				// Clear existing subcategory options
				subCategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';

				if (mainCategoryId) {
					// Fetch subcategories for the selected main category (adapt URL as needed)
					fetch(`/get-subcategories/${mainCategoryId}`)
						.then(response => response.json())
						.then(data => {
							if (data.length > 0) {
								data.forEach(subcategory => {
									const option = document.createElement('option');
									// Use subcategory.id directly instead of pivot.id
									option.value = subcategory.id;  // This should be subcategory.id, not pivot.id
									option.textContent = subcategory.title;
									subCategorySelect.appendChild(option);
								});
							} else {
								subCategorySelect.innerHTML = '<option value="">No subcategories available</option>';
							}
						});
				} else {
					subCategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
				}
			});
		});
	</script>

	<!-- Add JavaScript to handle the click event -->
	<script src="{{ asset('build/js/main.js') }}"></script>
			
	<!-- choices js -->
	<script src="{{ asset('build/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

	<!-- dropzone plugin -->
	<script src="{{ asset('build/libs/dropzone/dropzone-min.js') }}"></script>

	<!-- init js -->
	<script src="{{ asset('build/js/pages/ecommerce-choices.init.js') }}"></script>
	
	<!-- App js -->
	<script src="{{ asset('build/js/app.js') }}"></script>

	<script src="{{ asset('build/js/imageUploader.js') }}"></script>

    @endsection
