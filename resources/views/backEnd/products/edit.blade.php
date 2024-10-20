@extends('backEnd.layouts.master')
@section('title')
    Edit Product
@endsection
@section('css')
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
@endsection
@section('page-title')

		Editing for <span class="text-white bg-dark">{{ $product->title }}</>

@endsection
@section('body')

    <body>
    @endsection
    @section('content')

		@if ($errors->any())
			<div class="alert alert-danger" role="alert">
				<ul>
					@foreach ($errors->all() as $error)
						<li>
							{{ $error }} <!-- This will display each error message -->
						</li>
					@endforeach
				</ul>
			</div>
		@endif

		<div class="row">
			<div class="col-lg-12">
				<div id="addproduct-accordion" class="custom-accordion">
					<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="product-form">
						@csrf
						@method('PUT')
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
									<div class="mb-3">
										<label class="form-label" for="productname">Product Title <span class="text-danger">*</span></label>
										<input id="productname" name="title" placeholder="Enter Product Name" type="text" class="form-control" value="{{ $product->title }}">
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="mb-3">
												<label class="form-label" for="price">Price <span class="text-danger">*</span></label>
												<input 
													id="price" 
													name="price" 
													placeholder="Enter Price" 
													type="text" 
													class="form-control" 
													value="{{ $product->price }}" 			
												>
												<span class="text-danger error-message" style="display: none;" data-for="price">Please enter a valid price.</span>
											</div>
										</div>

										<div class="col-lg-4">
											<div class="mb-3">
												<label class="form-label" for="categories">Categories <span class="text-danger">*</span></label>
												<div id="categorySelector" class="form-control">
													<span>Select Category</span>
												</div>
												<select id="categories" name="categories[]" class="form-control" multiple style="display: none;">
													@foreach ($categories as $category)
														<option value="{{ $category->id }}" 
															{{ $product->categories->contains('id', $category->id) ? 'selected' : '' }}>
															{{ $category->title }}
														</option>
													@endforeach
												</select>
											</div>
										</div>										
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
																	value="{{ old('quantities.' . $size->id, $quantities[$size->id] ?? 0) }}">
															</td>
															@endforeach
														</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<!-- Specifications Section -->
										<div class="mt-3 row">
											<label class="form-label">Specifications</label>
											<div class="d-flex small justify-content-center">
												@foreach($specifications as $specification)
													<div class="form-check ms-2">
														<input class="form-check-input" type="checkbox" name="specifications[]" 
															id="spec-{{ $specification->id }}" 
															value="{{ $specification->id }}" 
															{{ (is_array(old('specifications')) && in_array($specification->id, old('specifications'))) 
																|| in_array($specification->id, $selectedSpecifications) ? 'checked' : '' }}> 
														<label class="form-check-label" for="spec-{{ $specification->id }}">
															{{ $specification->item }} <!-- Assuming 'item' is the field you want to display -->
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
										<textarea id="summernote" name="description" class="form-control" rows="10">{{ $product->description }}</textarea>
									</div>
									
									<div class="form-group mt-4">
										<label for="images">Upload Product Photos <span class="text-danger">*</span></label>
										<input type="file" name="images[]" id="images" multiple class="form-control">
									</div>
									<div class="form-group">
										<div class="form-group">
											<div id="image_preview">
												@if(isset($product->images) && $product->images)
													@php
														// Decode the JSON string into an array
														$images = json_decode($product->images);
													@endphp

													@if(is_array($images) && count($images) > 0)
														@foreach($images as $image)
															<div class="img-div" id="prev-img-div-{{ $loop->index }}">
																<img src="{{ asset('images/products/' . $image) }}" class="img-responsive image img-thumbnail" title="{{ $image }}">
																<input type="hidden" name="existing_images[]" value="{{ $image }}"> <!-- Hidden input to keep track of existing images -->
																<div class="middle">
																	<button id="remove-prev-image" value="prev-img-div-{{ $loop->index }}" class="btn btn-danger" role="{{ $image }}">
																		<i class="fa fa-trash"></i>
																	</button>
																</div>
															</div>
														@endforeach
													@endif
												@endif
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

										<!-- Check if there's an existing OG image and set its source -->
										<img id="imagePreview" 
											src="{{ $product->og_image ? asset('images/products/' . $product->og_image) : '' }}" 
											alt="Image Preview" 
											class="{{ $product->og_image ? '' : 'd-none' }}">
									</div>

								</div>
							</div>
						</div>
						<div class="text-center mx-auto col-lg-12 sticky-container mb-4">
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-primary btn-lg">
									<i class="bx bx-file me-1"></i> Save Product
								</button>

								<a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg">
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
    @endsection
