@extends('backEnd.layouts.master')
@section('title')
    Orders
@endsection
@section('css')
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
@section('page-title')
    Orders
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
		@if (session('success'))
			<div class="alert alert-success mt-3">
				{{ session('success') }}
			</div>
		@endif



        <div class="row">
            <div class="col-12">
				@if(session('response'))
					<div class="alert alert-{{ session('response')['type'] ?? 'info' }} alert-dismissible fade show" role="alert">
						{{-- Display the main message --}}
						<strong>{{ session('response')['message'] }}</strong><br>

						{{-- Display additional data from the response --}}
						<ul>
							@foreach(session('response')['data'] as $key => $value)
								<li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</li>
							@endforeach
						</ul>

						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

                <div class="card">
                    <div class="card-body">
						<!-- DataTable -->
						<table id="orders-table" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Ref</th>
									<th>Date</th>
									<th>Shipping Info</th>
									<th>Product</th>
									<th>Shipping</th>
									<th>Payments</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($orders as $order)
								<tr>
									
									<td>{{ $order->ref }}</td>
									<td>
										@foreach ($order->transactions as $transaction)
											{{ $transaction->tran_date }}
										@endforeach
									</td>
									<td>
										<ul class="list-unstyled mb-0">
											<li>{{ $order->name }}</li>
											<li>{{ $order->phone }}</li>
											<li>{{ $order->address }}</li>
										</ul>
									</td>
									<td>
										<ul class="list-unstyled mb-0">
										@foreach ($order->products as $product) <!-- Access products for each order -->
											<li><b>{{ $product->title }}</b> (Size: {{ $product->pivot->size_id }}, Quantity: {{ $product->pivot->quantity }})</li>
										@endforeach
										</ul>
									</td>
									<td>{{ $order->delivery ? $order->delivery->consignment_id : 'Not Shipped Yet' }}</td>
									<td>
										<ul class="list-unstyled mb-0">
										@foreach ($order->transactions as $transaction)
											<li> Status:
											@switch($transaction->payment_status)
												@case(0) Pending @break
												@case(1) Completed @break
												@default Unknown Status
											@endswitch
											</li>
											<li>Total: {{ $transaction->order_total }}</li>
											<li>Shipping: {{ $transaction->shipping_charge }}</li>
											<li>Paid: {{ $transaction->amount }}</li>
											<li>Unpaid: {{ $transaction->unpaid }}</li>
										@endforeach
										</ul>
									</td>
									<td id="order-status-{{ $order->id }}">
									
										@switch($order->status)
											@case(0)
												Pending
												@break
											@case(1)
												Completed
												@break
											@case(2)
												Processing
												@break
											@case(3)
												Shipped
												@break
											@case(4)
												Refunded
												@break
											@case(5)
												Cancelled
												@break
											@case(6)
												Failed
												@break
										@endswitch

									</td>
									<td>
										<a href="javascript:void(0);" onclick="openOrderReviewModal({{ $order->id }})">
											<i class="bi bi-chat-fill"></i>
										</a>

										<a href="{{ route('order.invoice', $order) }}">
											<i class="bi bi-download"></i>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

		<!-- Order Review Modal -->
		<div class="modal fade {{ $errors->any() && old('order_id') ? 'show' : '' }}" 
			id="orderReviewModal" tabindex="-1" role="dialog" aria-labelledby="orderReviewModalLabel" 
			style="{{ $errors->any() && old('order_id') ? 'display:block;' : '' }}" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h5 class="modal-title" id="orderReviewModalLabel">Add Your Review!</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<!-- Modal Body -->
					<div class="modal-body">
						<form id="reviewForm" action="{{ route('reviews.store') }}" method="POST">
							@csrf
							<!-- Hidden Order ID -->
							<input type="hidden" name="order_id" id="orderId" value="{{ old('order_id') }}">

							<!-- Star Rating -->
							<div class="border rounded p-3 bg-light">
								<div class="d-flex align-items-center mb-3" role="group">
									<div id="basic-rater" class="me-2"></div> <!-- Star Rating Element -->
									<span><strong>Rate from 1 to 5 stars to share your opinion.</strong></span>
								</div>

								<!-- Hidden input to store the star rating -->
								<input type="hidden" name="rating" id="ratingValue" value="{{ old('rating') }}">

								<!-- Review Content -->
								<textarea rows="3" class="form-control border-0 resize-none" placeholder="Write Your Review..." name="content">{{ old('content') }}</textarea>
							</div>

							<!-- Error Messages -->
							@if ($errors->any())
								<div class="mt-2 text-danger">
									@foreach ($errors->all() as $error)
										<p class="mb-0">{{ $error }}</p>
									@endforeach
								</div>
							@endif

							<!-- Submit Button -->
							<div class="text-end mt-3">
								<button type="submit" class="btn btn-success w-100">Submit Review <i class="bx bx-send ms-2 align-middle"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>



    @endsection
    @section('scripts')
		<!-- jQuery (required for DataTables) -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<!-- DataTables JS -->
		<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

		

		<script>
			$(document).ready(function() {
				$('#orders-table').DataTable({
					"paging": true,
					"lengthChange": true,
					"searching": true,
					"order": [[1, 'desc']],
					"columnDefs": [
						{ "orderable": false, "targets": [7] }, // Disable ordering on the 'Action' column
						{ "width": "5%", "targets": 0 }, // Ref column
						{ "width": "15%", "targets": 1 }, // Date column
						{ "width": "15%", "targets": 2 }, // Customer column
						{ "width": "30%", "targets": 3 }, // Product column
						{ "width": "5%", "targets": 4 }, // Courier column
						{ "width": "15%", "targets": 5 }, // Payments column
						{ "width": "10%", "targets": 6 }, // Status column
						{ "width": "5%", "targets": 7 }  // Action column
					],
					"info": true,
					"autoWidth": false,
					"stateSave": true, // Enable state saving
					"pageLength": 10,
					"lengthMenu": [10, 25, 50, 100],
					"language": {
						"paginate": {
							"previous": "<",
							"next": ">"
						}
					}
				});
			});
		</script>

        <!-- apexcharts -->
        <script src="{{ asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- gridjs js -->

        <!-- datepicker js -->
        <script src="{{ asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

	
		<script src="{{ asset('build/js/pages/ecommerce-orders.init.js') }}"></script>

		<script src="{{ asset('build/libs/rater-js/index.js') }}"></script>
		<script>
			document.addEventListener("DOMContentLoaded", function () {
				// Initialize raterJs
				var initialRating = 4; // Default initial rating

				// Basic RaterJS initialization
				var basicRating = raterJs({
					starSize: 22,
					rating: initialRating, // Default displayed rating
					element: document.querySelector("#basic-rater"),
					rateCallback: function rateCallback(rating, done) {
						// Set the rating in the hidden input field when user interacts
						document.getElementById("ratingValue").value = rating;
						this.setRating(rating); // Update the star widget to reflect the selected rating
						done(); // Finish the callback
					}
				});

				// Set the initial hidden input value
				document.getElementById("ratingValue").value = initialRating;

				// Handle resetting and opening the modal
				function openOrderReviewModal(orderId) {
					// Set the order ID in the hidden input
					document.getElementById("orderId").value = orderId;

					// Reset the form (clear previous inputs and errors)
					document.getElementById("reviewForm").reset();
					document.getElementById("ratingValue").value = initialRating;

					// Reset the star rating display
					basicRating.setRating(initialRating);

					// Show the modal using Bootstrap's JavaScript API
					const modal = new bootstrap.Modal(document.getElementById("orderReviewModal"));
					modal.show();
				}

				// Expose the function globally (if required)
				window.openOrderReviewModal = openOrderReviewModal;

				// If using rateYo or any other star-rating library:
				const starRatingElement = document.getElementById("basic-rater");
				if (starRatingElement) {
					$(starRatingElement).rateYo({
						starWidth: "22px",
						fullStar: true,
						rating: initialRating, // Default displayed rating
						onSet: function (rating) {
							// Update the hidden input when a new rating is set
							document.getElementById("ratingValue").value = rating;
						}
					});
				}
			});
		</script>

        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
    @endsection
