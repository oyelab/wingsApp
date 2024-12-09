@extends('backEnd.layouts.master')
@section('title')
    Dashboard
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Dashboard
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
		@if(auth()->user()->role == 1)
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-4">Overview</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold">Sort By:</span>
                                        <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div id="overview"
                                data-colors='["#e6ecf9", "#e6ecf9", "#e6ecf9","#e6ecf9", "#e6ecf9", "#e6ecf9","#e6ecf9","#e6ecf9","#e6ecf9","#1f58c7","#1f58c7", "#1f58c7"]'
                                class="apex-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-primary-subtle">
                                                <i class="bx bx-check-shield font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 font-size-15">Total Sales</h6>
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="mt-4 pt-1 mb-0 font-size-22">{{ $totalSalesVolume }} <span
                                                class="text-success fw-medium font-size-13 align-middle"> <i
                                                    class="mdi mdi-arrow-up"></i> 8.34% </span> </h4>
                                        <div class="d-flex mt-1 align-items-end overflow-hidden">
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-0 text-truncate">This Year</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div id="mini-1" data-colors='["#1f58c7"]' class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-primary-subtle">
                                                <i class="bx bx-cart-alt font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 font-size-15">Total Orders</h6>
                                        </div>

                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal text-muted font-size-22"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Today</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="mt-4 pt-1 mb-0 font-size-22">{{ $totalOrdersCount }} <span
                                                class="text-danger fw-medium font-size-13 align-middle"> <i
                                                    class="mdi mdi-arrow-down"></i> 3.68% </span> </h4>
                                        <div class="d-flex mt-1 align-items-end overflow-hidden">
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-0 text-truncate">This year</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div id="mini-2" data-colors='["#1f58c7"]' class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-primary-subtle">
                                                <i class="bx bx-package font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 font-size-15">Total Visitor</h6>
                                        </div>

                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal text-muted font-size-22"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Today</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="mt-4 pt-1 mb-0 font-size-22">N/A <span
                                                class="text-danger fw-medium font-size-13 align-middle"> <i
                                                    class="mdi mdi-arrow-down"></i> 2.64% </span> </h4>
                                        <div class="d-flex mt-1 align-items-end overflow-hidden">
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-0 text-truncate">No Message</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div id="mini-3" data-colors='["#1f58c7"]' class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-primary-subtle">
                                                <i class="bx bx-rocket font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 font-size-15">Total Expense</h6>
                                        </div>

                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal text-muted font-size-22"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Today</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div>
                                        <h4 class="mt-4 pt-1 mb-0 font-size-22">N/A <span
                                                class="text-success fw-medium font-size-13 align-middle"> <i
                                                    class="mdi mdi-arrow-down"></i> 5.79% </span> </h4>
                                        <div class="d-flex mt-1 align-items-end overflow-hidden">
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-0 text-truncate">No message</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div id="mini-4" data-colors='["#1f58c7"]' class="apex-charts"></div>
                                            </div>
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

        <div class="row">
            <div class="col-xxl-8">
                <div class="row">
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start mb-2">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title">Popular Products</h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-muted" href="#"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Today<i class="mdi mdi-chevron-down ms-1"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Yearly</a>
                                                <a class="dropdown-item" href="#">Monthly</a>
                                                <a class="dropdown-item" href="#">Weekly</a>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center">
									@if($popularProducts->isNotEmpty())
									<div class="col-md-5">
										<div class="popular-product-img p-2">
											<img src="{{ $popularProducts->first()->image_paths[0] }}" alt="{{ $popularProducts->first()->title }}" class="img-fluid rounded">
										</div>										
									</div>
									<div class="col-md-7">
										<span class="badge bg-primary-subtle text-primary font-size-10 text-uppercase ls-05"> Popular Item </span>
										<h5 class="mt-2 font-size-16">
											<a href="" class="text-body">
												{{ $popularProducts->first()->title }}
											</a>
										</h5>

										<div class="row g-0 mt-3 pt-1 align-items-end">
											<div class="col-4">
												<div class="mt-1">
													<h4 class="font-size-16">{{ $popularProducts->first()->orders_count }}</h4>
													<p class="text-muted mb-1">Total Selling</p>
												</div>
											</div>
											<div class="col-4">
												<div class="mt-1">
													<h4 class="font-size-16">{{ $popularProducts->first()->totalStock }}</h4>
													<p class="text-muted mb-1">Total Stock</p>
												</div>
											</div>
											<div class="col-4">
												<div class="mt-1">
													<h4 class="font-size-16">{{ $popularProducts->first()->views }}</h4>
													<p class="text-muted mb-1">Total Clicks</p>
												</div>
											</div>
										</div>
									</div>
									@else
										"N/A"
									@endif
                                </div>
                                <div class="mx-n4" data-simplebar style="max-height: 205px;">
									@foreach ($popularProducts->skip(1) as $product)
									<div class="popular-product-box rounded my-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-md">
                                                    <div
                                                        class="product-img avatar-title bg-primary-subtle border-0">
                                                        <img src="{{ $product->thumbnail }}" class="img-fluid rounded"
                                                            alt="{{ $product->title }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3 overflow-hidden">
                                                <h5 class="mb-1 text-truncate"><a href=""
                                                        class="font-size-15 text-body">{{ $product->title }}</a></h5>
                                                <p class="text-muted fw-semibold mb-0 text-truncate">{{ $product->price }}</p>
                                            </div>
                                            <div class="flex-shrink-0 text-end ms-3">
                                                <h5 class="mb-1"><a href=""
                                                        class="font-size-15 text-body">{{ $product->orders_count }} Sales</a></h5>
                                                <p class="text-muted fw-semibold mb-0">{{ $product->views }} Views</p>
                                            </div>
                                        </div>
                                    </div>		
									@endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start mb-2">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title">Loyal Customers</h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-muted" href="#"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal font-size-22"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Yearly</a>
                                                <a class="dropdown-item" href="#">Monthly</a>
                                                <a class="dropdown-item" href="#">Weekly</a>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mx-n4" data-simplebar style="max-height: 421px;">
									@foreach ($loyalCustomers as $user)
									<div class="border-bottom loyal-customers-box pt-2">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->avatarPath }}"
                                                class="rounded-circle avatar img-thumbnail" alt="">
                                            <div class="flex-grow-1 ms-3 overflow-hidden">
                                                <h5 class="font-size-15 mb-1 text-truncate">{{ $user->name }}</h5>
                                                <p class="text-muted text-truncate mb-0">{{ $user->email }}</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h5
                                                    class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                                    {{ $user->reviews_avg_rating }} <i class="bx bxs-star font-size-14 text-primary ms-1"></i>
												</h5>
                                            </div>
                                        </div>
                                    </div>
									@endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="card-title mb-4 text-truncate">Not configured</h5>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold">Sort By:</span> <span class="text-muted">Weekly<i
                                                class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="saleing-categories" data-colors='["#1f58c7", "#4976cf","#6a92e1", "#e6ecf9"]'
                            class="apex-charts" dir="ltr"></div>

                        <div class="row mt-3 pt-1">
                            <div class="col-md-6">
                                <div class="px-2 mt-2">
                                    <div class="d-flex align-items-center mt-sm-0 mt-2">
                                        <i class="mdi mdi-circle font-size-10 text-primary"></i>
                                        <div class="flex-grow-1 ms-2 overflow-hidden">
                                            <p class="font-size-15 mb-1 text-truncate">Men Fashion</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <span class="fw-bold">34.3%</span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mt-2">
                                        <i class="mdi mdi-circle font-size-10 text-success"></i>
                                        <div class="flex-grow-1 ms-2 overflow-hidden">
                                            <p class="font-size-15 mb-0 text-truncate">Women Clothing</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <span class="fw-bold">25.7%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="px-2 mt-2">
                                    <div class="d-flex align-items-center mt-sm-0 mt-2">
                                        <i class="mdi mdi-circle font-size-10 text-info"></i>
                                        <div class="flex-grow-1 ms-2 overflow-hidden">
                                            <p class="font-size-15 mb-1 text-truncate">Beauty Products</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <span class="fw-bold">18.6%</span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mt-2">
                                        <i class="mdi mdi-circle font-size-10 text-secondary"></i>
                                        <div class="flex-grow-1 ms-2 overflow-hidden">
                                            <p class="font-size-15 mb-0 text-truncate">Others Products</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <span class="fw-bold">21.4%</span>
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

		@else
        <div class="row">
			<h1>Hi, {{ auth()->user()->name }}</h1>
        </div>			
		@endif
	
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Vector map-->
        <script src="{{ asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
        <script src="{{ asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script src="{{ asset('build/js/pages/dashboard.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
    @endsection
