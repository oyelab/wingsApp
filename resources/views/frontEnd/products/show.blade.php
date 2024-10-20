@extends('backEnd.layouts.master-without-nav')
@section('title')
Product Detail
@endsection
@section('css')
<!-- swiper css -->
<link rel="stylesheet" href="{{ asset('build/libs/swiper/swiper-bundle.min.css') }}">
@endsection
@section('page-title')
Product Detail
@endsection
@section('body')

<body>
	@endsection
	@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-xl-4">
							<div class="product-detail mt-3" dir="ltr">

								<div
									class="swiper product-thumbnail-slider rounded border overflow-hidden position-relative">
									<div class="swiper-wrapper">
										@foreach (json_decode($product->images) as $image)
											<div class="swiper-slide rounded">
												<div class="p-3">
													<div class="product-img bg-light rounded p-3">
														<img src="{{ asset('images/products/' . $image) }}"
															class="img-fluid d-block" />
													</div>
												</div>
											</div>
										@endforeach
									</div>
									<div class="d-none d-md-block">
										<div class="swiper-button-next"></div>
										<div class="swiper-button-prev"></div>
									</div>
								</div>

								<div class="mt-4">
									<div thumbsSlider="" class="swiper product-nav-slider mt-2 overflow-hidden">
										<div class="swiper-wrapper">
											@foreach (json_decode($product->images) as $image)
												<div class="swiper-slide rounded">
													<div class="nav-slide-item"><img
															src="{{ asset('images/products/' . $image) }}"
															class="img-fluid p-1 d-block rounded" /></div>
												</div>
											@endforeach
										</div>
									</div>
								</div>

							</div>
						</div>
						<div class="col-xl-8">
							<div class="mt-3 mt-xl-3 ps-xl-5">
								<h4 class="font-size-20 mb-3"><a href="" class="text-body">{{ $product->title }}</a>
								</h4>

								<p class="text-muted mb-0">
									<i class="bx bxs-star text-warning"></i>
									<i class="bx bxs-star text-warning"></i>
									<i class="bx bxs-star text-warning"></i>
									<i class="bx bxs-star text-warning"></i>
									<i class="bx bxs-star-half text-warning"></i>
								</p>

								<div class="text-muted mt-2">
									<span class="badge bg-success font-size-14 me-1"><i class="mdi mdi-star"></i>
										4.5</span> 234 Reviews
								</div>

								<h2 class="text-primary mt-4 py-2 mb-0">{{ $product->price }} <del
										class="text-muted font-size-18 fw-medium ps-1">$520</del>

									<span class="badge bg-danger font-size-10 ms-1">20 % Off</span>
								</h2>


								<div>
									<div class="row">
										<div class="col-md-6">
											<div class="mt-3">
												<h5 class="font-size-14">Specification :</h5>
												<div>
													<!-- Display the Summernote description -->
													{!! $product->description !!}
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-6 col-sm-8">
											<div class="product-desc-color mt-3">
												<h5 class="font-size-14">Colors :</h5>
												<ul class="list-inline mt-3">
													<li class="list-inline-item">
														<i class="mdi mdi-circle font-size-18 text-body"></i>
													</li>
													<li class="list-inline-item">
														<i class="mdi mdi-circle font-size-18 text-success"></i>
													</li>
													<li class="list-inline-item">
														<i class="mdi mdi-circle font-size-18 text-primary"></i>
													</li>

													<li class="list-inline-item">
														<a href="#" class="text-primary border-0 p-1">
															2 + Colors
														</a>
													</li>
												</ul>

											</div>


											<div class="row text-center mt-4 pt-1">
												<div class="col-sm-6">
													<form action="{{ route('cart.add') }}" method="POST">
														@csrf
														<input type="hidden" name="product" value="{{ $product->id }}">
														<div class="d-grid">
															<button type="submit" class="btn btn-primary waves-effect waves-light mt-2 me-1">
																<i class="bx bx-cart me-2"></i> Add to cart
															</button>
														</div>
													</form>
												</div>

												<div class="col-sm-6">
													<div class="d-grid">
														<button type="button"
															class="btn btn-light waves-effect  mt-2 waves-light">
															<i class="bx bx-shopping-bag me-2"></i>Buy now
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end row -->
				</div>
			</div>
		</div>
	</div>
	<!-- end row -->
	@endsection
	@section('scripts')
	<!-- swiper js -->
	<script src="{{ asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

	<script src="{{ asset('build/js/pages/ecommerce-product-detail.init.js') }}"></script>
	<!-- App js -->
	<script src="{{ asset('build/js/app.js') }}"></script>
	@endsection