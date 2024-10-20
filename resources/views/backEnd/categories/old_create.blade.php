@extends('backEnd.layouts.master')
@section('title')
	Add Category
@endsection
@section('css')
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
@endsection
@section('page-title')
    Add Category
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
					<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
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
											<h5 class="font-size-16 mb-1">Category Info</h5>
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
									<div class="row d-flex">
										<div class="col-lg-6 mb-3">
											<label class="form-label" for="productname">Name <span class="text-danger">*</span></label>
											<input id="productname" name="name" placeholder="Enter Product Name" type="text" class="form-control" value="{{ old('name') }}">
										</div>
										
										<div class="col-lg-4 mb-3">
											<label class="form-label" for="categories">Parent <span class="text-danger">*</span></label>
											<select name="parent_id" class="form-select">
												<option value="" selected>Choose a parent category</option>
												@foreach ($categories as $category)
													<option value="{{ $category->id }}">{{ $category->name }}</option>
												@endforeach
											</select>
										</div>

									</div>
									<!-- Product Description Field with Quill Editor and Hidden Input -->
									<div class="mb-0 mt-5">
										<label class="form-label" for="productdesc">Description <span class="text-danger">*</span></label>

										<!-- Textarea to store Summernote content -->
										<textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
									</div>
									
									<div class="form-group mt-4">
										<label for="image">Upload Cover <span class="text-danger">*</span></label>
										<input type="file" name="cover" class="form-control" onchange="previewImage(event)">
									</div>
									<div class="form-group">
										<div id="catImgPreview">

										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="text-center mx-auto col-lg-12 sticky-container mb-4">
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-primary btn-lg">
									<i class="bx bx-file me-1"></i> Create Category
								</button>

								<a href="{{ route('categories.index') }}" class="btn btn-secondary btn-lg">
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
        <!-- <script src="{{ asset('build/js/main.js') }}"></script> -->
		<script>
			function previewImage(event) {
				const previewContainer = document.getElementById('catImgPreview');
				previewContainer.innerHTML = ''; // Clear previous images

				const file = event.target.files[0];
				if (file) {
					const reader = new FileReader();
					reader.onload = function(e) {
						const img = document.createElement('img');
						img.src = e.target.result; // Set the source of the image to the FileReader result
						img.alt = 'Cover Preview';
						img.style.maxWidth = '50%'; // Responsive width
						img.style.height = 'auto'; // Maintain aspect ratio
						img.style.marginTop = '10px'; // Add some margin
						previewContainer.appendChild(img); // Append the image to the preview container
					}
					reader.readAsDataURL(file); // Read the uploaded file as a data URL
				}
			}
			</script>
				
        <!-- choices js -->
        <script src="{{ asset('build/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

        <!-- dropzone plugin -->
        <script src="{{ asset('build/libs/dropzone/dropzone-min.js') }}"></script>

        <!-- init js -->
        <script src="{{ asset('build/js/pages/ecommerce-choices.init.js') }}"></script>
		
        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
    @endsection
