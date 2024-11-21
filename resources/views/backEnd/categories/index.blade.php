@extends('backEnd.layouts.master')
@section('title')
   Categories
@endsection
@section('css')
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
    Categories
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
									onclick="window.location.href='{{ route('categories.create') }}';">
									<i class="mdi mdi-plus me-1"></i> Create New Category
								</button>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table table-nowrap justify-between-end mb-0 table-striped table-bordered table-hover" id="categoryTable">
							<thead>
								<tr>
									<th>Title</th>
									<th>Type</th>
									<th>Status</th>
									<th>Image</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($parentCategories as $parent)
									<tr>
										<!-- Display Parent Category -->
										<td>
											<h5 class="text-truncate font-size-14 m-0">
												<a href="javascript: void(0);" class="text-body">{{ $parent->title }}</a>
											</h5>
										</td>
										<td>Main Category</td>
										<td class="text-center">
											<span class="badge rounded-pill {{ $parent->status == 1 ? 'bg-secondary-subtle text-secondary' : 'bg-danger-subtle text-danger' }}">
												{{ $parent->status == 1 ? 'Published' : 'Unpublished' }}
											</span>
										</td>
										<td class="text-center mx-auto">
											<img class="rounded w-50" src="{{ asset('storage/images/categories/' . $parent->image) }}"
												alt="{{ $parent->title }}" style="max-width: 100px; max-height: 100px;">
										</td>
										<td>
											<a href="{{ route('categories.edit', $parent->id) }}" class="mr-3"><i class="las la-pen text-secondary font-30"></i></a>
											<form action="{{ route('categories.destroy', $parent->id) }}" method="POST" style="display: inline;">
												@csrf
												@method('DELETE')
												<a href="javascript:void(0);" class="mr-3" onclick="confirmDelete(this)">
													<i class="las la-trash-alt text-secondary font-30"></i>
												</a>
											</form>
										</td>
									</tr>

									<!-- Display Child Categories (if any) -->
									@foreach ($parent->children as $child)
										<tr>
											<td>
												&nbsp;&nbsp;&nbsp;&nbsp;- {{ $child->title }}
											</td>
											<td>Sub Category</td>
											<td class="text-center">
												<span class="badge rounded-pill {{ $child->status == 1 ? 'bg-secondary-subtle text-secondary' : 'bg-danger-subtle text-danger' }}">
													{{ $child->status == 1 ? 'Published' : 'Unpublished' }}
												</span>
											</td>
											<td class="text-center mx-auto">
												<img class="rounded w-50" src="{{ asset('storage/images/categories/' . $child->image) }}"
													alt="{{ $child->title }}" style="max-width: 100px; max-height: 100px;">
											</td>
											<td>
												<a href="{{ route('categories.edit', $child->id) }}" class="mr-3"><i class="las la-pen text-secondary font-30"></i></a>
												<form action="{{ route('categories.destroy', $child->id) }}" method="POST" style="display: inline;">
													@csrf
													@method('DELETE')
													<a href="javascript:void(0);" class="mr-3" onclick="confirmDelete(this)">
														<i class="las la-trash-alt text-secondary font-30"></i>
													</a>
												</form>
											</td>
										</tr>
									@endforeach
								@endforeach
							</tbody>
						</table>


					</div>
				</div>
			</div>
		</div>
    @endsection
    @section('scripts')
	<!-- App js -->
	<script src="{{ asset('build/js/app.js') }}"></script>
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
				const table = document.getElementById('categoryTable');
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
    @endsection
