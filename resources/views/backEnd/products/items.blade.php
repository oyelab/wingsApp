@extends('backEnd.layouts.master')
@section('title')
    Items
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('build/libs/gridjs/theme/mermaid.min.css') }}">
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
    Items
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
		@if(session('success'))
			<div id="successMessage" class="alert alert-success">
				{{ session('success') }}
			</div>
		@endif
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="text-muted text-truncate mb-0 pb-1">Total Collections</p>
                                <h4 class="mb-0 mt-2">{{ $counts['total'] }}</h4>
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
                                <h4 class="mb-0 mt-2">{{ $counts['published'] }}</h4>
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

            
        </div>

		<div class="row">
        <div class="col-12">
            <div class="card-body mb-4">
				<div class="row mb-2">
					<div class="col-xl-3 col-md-12">
						<div class="pb-3 pb-xl-0">
						<form method="GET" action="{{ route('collections.item') }}" id="searchForm">
							<div class="form-group">
								<input type="text" class="form-control" name="search" id="searchInput" value="{{ request()->search }}" placeholder="Search items...">
							</div>
						</form>

						</div>
					</div>
					<div class="col-xl-9 col-md-12">
						<div class="text-sm-end">
							<button type="button"
								class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
								onclick="window.location.href='{{ route('products.create') }}';">
								<i class="mdi mdi-plus me-1"></i> Create New
							</button>
						</div>
					</div>
				</div>
				
					<!--end col-->
                <div class="card-body">
					
                    <div class="table-responsive">
                        <table class="table table-bordered" id="productTable">
                            <thead>
                                <tr class="text-center">
                                    <th>Thumb</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								@foreach($items as $item)
                                <tr>
									<td class="text-center">
										<div class="avatar-group d-flex justify-content-center align-items-center">
											<div class="avatar-group-item">
												<a href="javascript: void(0);" class="d-inline-block">
													<img src="{{ $item->thumbnail }}" alt="{{ $item->title }}" class="rounded-circle avatar-sm">
												</a>
											</div>
										</div>
									</td>


                                    <td>
                                        <p class="d-inline-block align-middle mb-0">                
											<a href="{{ route('products.details', [
												'category' => $item->categories->first()->slug, $item]) }}" class="d-inline-block align-middle mb-0 product-name fw-semibold">{{ $item->title }}</a>
                                            <br>
                                            <!-- <span class="text-muted font-13 fw-semibold">Size-05 (Model 2021)</span> -->
                                        </p>
                                    </td>
                                    <td class="col">
										@if ($item->category_display)
											<span class="badge bg-success-subtle text-success mb-0">{{ $item->category_display }}</span>
										@else
											<span class="badge bg-danger-subtle text-danger mb-0">Category not found</span>
										@endif
									</td>
									<td>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" id="switch-{{ $item->id }}" name="status" onchange="confirmStatusChange(event, {{ $item->id }})" {{ $item->status ? 'checked' : '' }} />
											<label for="switch-{{ $item->id }}" data-on-label="Yes" data-off-label="No"></label>
										</div>
									</td>

                                    <td>
                                        <a href="{{ route('products.edit', $item->id) }}" class="mr-3"><i class="las la-pen text-secondary font-30"></i></a>
										<form action="{{ route('products.destroy', $item->id) }}" method="POST" style="display: inline;" id="delete-form-{{ $item->id }}">
											@csrf
											@method('DELETE')
											<a href="javascript:void(0);" class="mr-3" onclick="confirmDelete({{ $item->id }})">
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
							<button class="btn btn-outline-light btn-sm px-4" onclick="window.location='{{ route('products.create') }}'">+ Add New</button>
                        </div>
                        <!--end col-->
                        <div class="col-auto">
							<nav aria-label="...">
								<ul class="pagination pagination-sm mb-0">
									{{-- Previous Page Link --}}
									<li class="page-item {{ $items->onFirstPage() ? 'disabled' : '' }}">
										<a class="page-link" href="{{ $items->previousPageUrl() }}" tabindex="-1">Previous</a>
									</li>

									{{-- Pagination Elements --}}
									@for ($i = 1; $i <= $items->lastPage(); $i++)
										<li class="page-item {{ $items->currentPage() == $i ? 'active' : '' }}">
											<a class="page-link" href="{{ $items->url($i) }}">{{ $i }}</a>
										</li>
									@endfor

									{{-- Next Page Link --}}
									<li class="page-item {{ $items->hasMorePages() ? '' : 'disabled' }}">
										<a class="page-link" href="{{ $items->nextPageUrl() }}">Next</a>
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
			// Function to filter the table as the user types
			function filterTable() {
				const searchInput = document.getElementById('searchInput').value.toLowerCase();
				const table = document.getElementById('productTable');
				const rows = table.getElementsByTagName('tr');

				// Loop through all table rows and hide those that don't match the search query
				for (let i = 0; i < rows.length; i++) {
					const cells = rows[i].getElementsByTagName('td');
					let match = false;

					// Check each cell in the row for a match
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

			// Automatically submit the form when the user types in the search input
			document.getElementById('searchInput').addEventListener('keyup', function() {
				filterTable(); // Call the filterTable function on each keystroke
			});
		</script>

		<script>
			// Set Sale Function
			function setSale() {
				const saleInput = document.getElementById('sale');
				const saleValue = saleInput.value;

				// Check if the sale input is empty or not a number
				if (saleValue === '' || isNaN(saleValue)) {
					alert('Please enter a valid offer percentage.'); // Alert user about invalid input
					saleInput.focus(); // Set focus back to the input
					return; // Prevent closing the modal
				}

				document.getElementById('hiddenSale').value = saleValue; // Set the value to the hidden input
				// Close the modal after saving
				const modal = bootstrap.Modal.getInstance(document.getElementById('offerModal'));
				modal.hide();
			}

			// Validate Form Function
			function validateForm(event) {
				let isValid = true;
				const inputs = document.querySelectorAll('input[required]');

				inputs.forEach(input => {
					validateInput(input); // Validate each input
					const errorMessage = document.querySelector(`.error-message[data-for="${input.name}"]`);
					if (errorMessage.style.display === 'block') {
						isValid = false; // Set validity to false if any error message is shown
					}
				});

				if (!isValid) {
					event.preventDefault(); // Prevent form submission if validation fails
				}

				return isValid; // Return the validity state
			}
		</script>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				// Check if the success message exists
				const successMessage = document.getElementById('successMessage');
				if (successMessage) {
					// Set a timer to hide the message after 5 seconds (5000 milliseconds)
					setTimeout(function() {
						successMessage.style.display = 'none'; // Hide the message
					}, 2500);
				}
			});
		</script>

		<script>
			function confirmDelete(productId) {
				const confirmation = confirm('Are you sure you want to delete this item?');
				if (confirmation) {
					deleteProduct(productId);
				}
			}

			function deleteProduct(productId) {
				const form = document.getElementById(`delete-form-${productId}`);

				// Send the AJAX request to delete the product
				fetch(form.action, {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
					},
					body: JSON.stringify({
						_method: 'DELETE'  // Explicitly state the DELETE method
					})
				})
				.then(response => {
					if (!response.ok) {
						throw new Error('Network response was not ok');
					}
					return response.json();
				})
				.then(data => {
					// Check for success in the response
					if (data.success) {
						// Reload the page after successful deletion
						window.location.reload();
					} else {
						throw new Error('Failed to delete the product');
					}
				})
				.catch(error => {
					console.error('Error:', error);
					alert('Error deleting the product');
				});
			}
		</script>

		<script>
			function confirmStatusChange(event, productId) {
				event.preventDefault();

				const switchInput = document.getElementById(`switch-${productId}`);
				const newStatus = switchInput.checked ? 1 : 0;

				const confirmation = confirm("Are you sure you want to change the status?");
				
				if (confirmation) {
					updateStatus(productId, newStatus);
				} else {
					switchInput.checked = !switchInput.checked;
				}
			}

			function updateStatus(productId, status) {
				// Use Laravel route() helper to generate the correct URL
				const url = `{{ route('products.updateStatus', ':id') }}`.replace(':id', productId);

				fetch(url, {
					method: 'PUT',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
					},
					body: JSON.stringify({ status: status })
				})
				.then(response => {
					if (!response.ok) {
						throw new Error('Network response was not ok');
					}
					return response.json();
				})
				.then(data => {
					// If status update is successful, reload the page
					window.location.reload();
				})
				.catch(error => {
					console.error('There was a problem with the fetch operation:', error);
				});
			}
		</script>



        <!-- apexcharts -->

        <!-- gridjs js -->
        <script src="{{ asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

        <!-- datepicker js -->
        <script src="{{ asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>


        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
    @endsection
