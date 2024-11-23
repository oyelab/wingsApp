@extends('frontEnd.layouts.app')  <!-- Use your main layout -->

@section('content')
    <div class="container mt-5">
		
        <h2 class="text-center mb-4">{{ $sectionTitle }}</h2>  <!-- Display section title -->

		<div class="row g-4 mb-4"> <!-- Ensure margin-bottom for spacing between the product grid and pagination -->
			@foreach($products as $product)
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden wings-light">
						<!-- Product Image -->
						<a href="{{ route('sections.products.details', ['section' => $section, 'product' => $product->slug]) }}" class="href">
							<img src="{{ $product->imagePaths[0] }}" class="card-img-top rounded-0" alt="{{ $product->title }}">
						</a>
						<div class="card-body p-3">
							<div class="row mb-3">
								<!-- Rating (Left aligned) -->
								<div class="col-6 d-flex align-items-center" style="white-space: nowrap;">
									<h6 class="mb-0 me-2 fs-6">{{ number_format($product->averageRating, 1) }}</h6>
									<div class="text-warning">
										<!-- Star rating -->
										@for($i = 1; $i <= 5; $i++)
											<i class="bi bi-star{{ $i <= $product->averageRating ? '-fill' : '' }}"></i>
										@endfor
									</div>
								</div>

								<!-- Number of Reviews (Right aligned) -->
								<div class="col-6 text-end">
									<p class="card-text text-muted mb-0 fs-6" style="white-space: nowrap;">{{ $product->reviews->count() }} Reviews</p>
								</div>
							</div>

							<!-- Availability Status (With Quantities) -->
							<div class="row mb-2">
								<!-- Availability Status -->
								<div class="col-5">
									<p class="card-text fs-6 mb-0 {{ $product->isAvailable() ? 'text-success' : 'text-danger' }}">
										<i class="bi {{ $product->isAvailable() ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i>
										{{ $product->isAvailable() ? 'In Stock' : 'Out of Stock' }}
									</p>
								</div>

								<!-- Quantities Available -->
								<div class="col-7 text-end">
									<p class="card-text fs-6 mb-0">
										<i class="bi bi-box me-1"></i> {{ $product->getTotalStockAttribute() }} Available
									</p>
								</div>
							</div>

							<!-- Product Title -->
							<h5 class="card-title fs-5 fw-semibold text-dark">{{ $product->title }}</h5>
							<!-- Product Categories -->
							<p class="card-text text-muted fs-6 mb-3">
								@foreach ($product->categories as $category)
									<span class="badge bg-secondary">{{ $category->title }}</span>
								@endforeach
							</p>
							<!-- Product Description -->
							<!-- <p class="card-text text-muted mb-3">{!! Str::limit(strip_tags($product->description), 40) !!}</p> -->

							<!-- Product Price -->
							<p class="card-text d-flex justify-content-between align-items-center mb-0">
								@if($product->sale)
									<span class="text-muted text-decoration-line-through fs-6">{{ number_format($product->price, 2) }}</span>
									<strong class="text-danger fs-5">{{ number_format($product->offerPrice, 2) }}</strong>
								@else
									<strong class="text-primary fs-5">{{ number_format($product->price, 2) }}</strong>
								@endif
							</p>
						</div>

						<!-- Product Action Button -->
						<div class="card-footer bg-transparent border-0 text-center">
							<a href="{{ route('sections.products.details', ['section' => $section, 'product' => $product->slug]) }}" class="btn btn-outline-primary w-100 py-2 fs-6 rounded-2">
								<i class="bi bi-eye"></i> View Details
							</a>
						</div>
					</div>
				</div>
			@endforeach
		</div>

		<!-- Pagination Section -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<div class="d-flex justify-content-between align-items-center"> <!-- Ensure spacing is aligned -->
					<!-- Showing Results Text -->
					<div>
						<p class="mt-4">
							Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
						</p>
					</div>

					<!-- Pagination Links -->
					<div class="mb-2">
						{{ $products->links('pagination::bootstrap-4') }} <!-- Add pagination links -->
					</div>
				</div>
			</div>
		</div>


    </div>
@endsection
