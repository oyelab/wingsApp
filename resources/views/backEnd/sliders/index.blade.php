@extends('backEnd.layouts.master')
@section('title')
	Sliders
@endsection
@section('css')
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
    Sliders
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<!-- Alert Section -->
					@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Success!</strong> {{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif


					@if ($errors->any())
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>There were some errors with your submission:</strong>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif

					<div class="row mb-2">
						<div class="col-xl-3 col-md-12">
							<div class="pb-3 pb-xl-0">
								<form class="">
									<div class="position-relative">
										<input type="text" class="form-control bg-light" id="searchInput" placeholder="Search..." onkeyup="filterTable()">
									</div>
								</form>
							</div>
						</div>
						<div class="col-xl-9 col-md-12">
							<div class="text-sm-end">
								<button type="button"
									class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
									onclick="window.location.href='{{ route('sliders.create') }}';">
									<i class="mdi mdi-plus me-1"></i> Create New Slider
								</button>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table table-nowrap justify-between-end mb-0 table-striped table-bordered table-hover" id="sliderTable">
							<tbody>
								<tr>
									<td>Checkbox</td>
									<td>Title</td>
									<td>Order</td>
									<td>Status</td>
									<td>Image</td>
									<td>Action</td>
								</tr>
								@foreach ($sliders as $slider)
								<tr>
									<td style="width: 40px;">
										<div class="form-check font-size-16">
											<input class="form-check-input" type="checkbox" id="upcomingtaskCheck01">
											<label class="form-check-label" for="upcomingtaskCheck01"></label>
										</div>
									</td>
									<td>
										<h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
												class="text-body">{{ $slider->title }}</a></h5>
									</td>

									<td>
										<p class="mb-0">{{ $slider->order }}</p>
									</td>

									<td class="text-center">
										<div class="text-center">
											<span
												class="badge rounded-pill 
												{{ $slider->status == 1 ? 'bg-secondary-subtle text-secondary' : 'bg-danger-subtle text-danger' }}">
												{{ $slider->status == 1 ? 'Published' : 'Unpublished' }}
											</span>
										</div>
									</td>
									<td class="text-center mx-auto">
										<img class="rounded w-50" src="{{ $sliderPath . $slider->image }}" alt="{{ $slider->title }}" style="max-width: 100px; max-height: 100px;">
									</td>
									<td>
										<a href="{{ route('sliders.edit', $slider->id) }}" class="mr-3"><i class="las la-pen text-secondary font-30"></i></a>
										
										<form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" style="display: inline;">
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
				</div>
			</div>
		</div>
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
		<script>
			function filterTable() {
				const searchInput = document.getElementById('searchInput').value.toLowerCase();
				const table = document.getElementById('sliderTable');
				const rows = table.getElementsByTagName('tr');

				// Loop through all table rows and hide those that don't match the search query
				for (let i = 0; i < rows.length; i++) {
					const cells = rows[i].getElementsByTagName('td');
					let match = false;

					// Check each cell in the row
					for (let j = 0; j < cells.length; j++) {
						if (cells[j]) {
							const cellText = cells[j].textContent || cells[j].innerText;
							if (cellText.toLowerCase().indexOf(searchInput) > -1) {
								match = true;
								break;
							}
						}
					}

					// Show or hide the row based on the match
					if (match) {
						rows[i].style.display = "";
					} else {
						rows[i].style.display = "none";
					}
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
