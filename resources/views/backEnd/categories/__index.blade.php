@extends('backEnd.layouts.master')
@section('title')
	Category List
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('build/libs/gridjs/theme/mermaid.min.css') }}">

    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
    Category List
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
		@if(session('message'))
			<div id="successMessage" class="alert alert-success">
				{{ session('message') }}
			</div>
		@endif
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">Total Products</p>
                                <h4 class="mb-0 mt-2">123</h4>
                            </div>
                            <div class="col-6">
                                <div class="overflow-hidden">
                                    <div id="mini-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">Published</p>
                                <h4 class="mb-0 mt-2">123</h4>
                            </div>
                            <div class="col-6">
                                <div class="overflow-hidden">
                                    <div id="mini-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">Discounted</p>
                                <h4 class="mb-0 mt-2">123</h4>
                            </div>
                            <div class="col-6">
                                <div class="overflow-hidden">
                                    <div id="mini-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">Quantities</p>
                                <h4 class="mb-0 mt-2">123</h4>
                            </div>
                            <div class="col-6">
                                <div class="overflow-hidden">
                                    <div id="mini-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
			<div class="m-4 mb-0">
						<button class="btn btn-outline-light btn-sm px-4" onclick="window.location='{{ route('categories.create') }}'">+ Add New</button>
					</div>
					<!--end col-->
                <div class="card-body">
					
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Availability</th>
                                    <th>Prices</th>
                                    <th>Status</th>
                                    <th>Sale %</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								@foreach($categories as $category)
                                <tr>
                                    <td>
        								<!-- Assuming 'images' is stored as a JSON array in the database -->
        								<img src="{{ asset('images/categories/' . $category->cover) }}" alt="{{ $category->name }}" height="40" />
										
                                        <p class="d-inline-block align-middle mb-0">
                                            <a href="{{ route('categories.show', $category->slug) }}" class="d-inline-block align-middle mb-0 product-name fw-semibold">{{ $category->name }}</a>
                                            <br>
                                            <!-- <span class="text-muted font-13 fw-semibold">Size-05 (Model 2021)</span> -->
                                        </p>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="mr-3"><i class="las la-pen text-secondary font-30"></i></a>
										<form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
											@csrf
											@method('DELETE')
											<a href="javascript:void(0);" class="mr-3" onclick="confirmDelete(this)">
												<i class="las la-trash-alt text-secondary font-30"></i>
											</a>
										</form>
                                    </td>
                                </tr>
								@endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col">
							<button class="btn btn-outline-light btn-sm px-4" onclick="window.location='{{ route('categories.create') }}'">+ Add New</button>
                        </div>
                        <!--end col-->
                        <div class="col-auto">
							<nav aria-label="...">
								<ul class="pagination pagination-sm mb-0">
									{{-- Previous Page Link --}}
									<li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
										<a class="page-link" href="{{ $categories->previousPageUrl() }}" tabindex="-1">Previous</a>
									</li>

									{{-- Pagination Elements --}}
									@for ($i = 1; $i <= $categories->lastPage(); $i++)
										<li class="page-item {{ $categories->currentPage() == $i ? 'active' : '' }}">
											<a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
										</li>
									@endfor

									{{-- Next Page Link --}}
									<li class="page-item {{ $categories->hasMorePages() ? '' : 'disabled' }}">
										<a class="page-link" href="{{ $categories->nextPageUrl() }}">Next</a>
									</li>
								</ul>
							</nav>

						</div>

                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->


    @endsection
    @section('scripts')
		<script>
			function confirmDelete(element) {
				const confirmation = confirm('Are you sure you want to delete this product?');
				if (confirmation) {
					// If confirmed, submit the closest form
					element.closest('form').submit();
				}
			}
		</script>
        <!-- apexcharts -->
        <script src="{{ asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- gridjs js -->
        <script src="{{ asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

        <!-- datepicker js -->
        <script src="{{ asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>


        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
    @endsection
