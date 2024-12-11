@extends('backEnd.layouts.master')
@section('title')
    Orders
@endsection
@section('css')
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
	@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }
}

</style>
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
                    <div class="card-body table-responsive">
						<!-- DataTable -->
						<table id="orders-table" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Ref</th>
									<th>Date</th>
									<th>Shipping Info</th>
									<th>Product</th>
									<th>Shipping Status</th>
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
									<td>
										{{ $order->delivery && $order->delivery->consignment_id 
											? $order->delivery->consignment_id 
											: ($order->delivery ? $order->delivery->status : 'Not Shipped Yet') }}
									</td>
									<td>
										<ul class="list-unstyled mb-0">
											@foreach ($order->transactions as $transaction)
												@if ($transaction->payment_status == 0 || $transaction->payment_status == 1)
													<li>Status:
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
												@endif
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
											@case(7)
												Refund Requested
												@break
										@endswitch

									</td>
									<td>
										<!-- Check if the order status is 0 (Pending) or 2 (Shipped) -->
										@if ($order->status == 0 || $order->status == 2)
											<!-- Trigger Review Modal -->
											<a href="javascript:void(0);" onclick="openOrderReviewModal({{ $order->id }})" class="badge bg-primary text-white mb-2 p-2">
												<i class="bi bi-chat-fill"></i> Review
											</a>

											<!-- Trigger Refund Modal -->
											<a href="javascript:void(0);" onclick="openOrderRefundModal({{ $order->id }})" class="badge bg-warning text-dark mb-2 p-2">
												<i class="bi bi-arrow-return-left"></i> Refund
											</a>
										@endif

										<!-- Invoice Link -->
										<a href="{{ route('order.invoice', $order) }}" class="badge bg-success text-white mb-2 p-2">
											<i class="bi bi-download"></i> Invoice
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

		<div class="modal fade" id="orderReviewModal" tabindex="-1" role="dialog" aria-labelledby="orderReviewModalLabel" aria-hidden="true">
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
							<input type="hidden" name="order_id" id="reviewOrderId" value="{{ old('order_id') }}">

							<div class="border rounded p-3 bg-light">
								<div class="d-flex align-items-center mb-3" role="group">
									<div id="basic-rater" class="me-2"></div>
									<span><strong>Rate from 1 to 5 stars to share your opinion.</strong></span>
								</div>
								<input type="hidden" name="rating" id="ratingValue" value="{{ old('rating') }}">
								<textarea rows="3" class="form-control border-0 resize-none" placeholder="Write Your Review..." name="content">{{ old('content') }}</textarea>
							</div>

							@if ($errors->any())
								<div class="mt-2 text-danger">
									@foreach ($errors->all() as $error)
										<p class="mb-0">{{ $error }}</p>
									@endforeach
								</div>
							@endif

							<div class="text-end mt-3">
								<button type="submit" class="btn btn-success w-100">Submit Review <i class="bx bx-send ms-2 align-middle"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="orderRefundModal" tabindex="-1" role="dialog" aria-labelledby="orderRefundModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h5 class="modal-title" id="orderRefundModalLabel">Submit Your Refund Request!</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<!-- Modal Body -->
					<div class="modal-body">
						<form id="refundForm" action="{{ route('refund.store', $order->id ) }}" method="POST">
							@csrf
							<input type="hidden" name="order_id" id="refundOrderId" value="{{ old('order_id') }}">

							<!-- Validation Errors -->
							@if ($errors->any())
								<div class="mt-2 text-danger">
									@foreach ($errors->all() as $error)
										<p class="mb-0">{{ $error }}</p>
									@endforeach
								</div>
							@endif

							<textarea rows="3" class="form-control border-0 resize-none" placeholder="Describe your refund reason..." name="content">{{ old('content') }}</textarea>

							<div class="text-end mt-3">
								<button type="submit" class="btn btn-success w-100">Submit Refund <i class="bx bx-send ms-2 align-middle"></i></button>
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
					"autoWidth": false,  // Disable auto width to allow responsive design
					"stateSave": true,   // Enable state saving
					"pageLength": 10,
					"lengthMenu": [10, 25, 50, 100],
					"language": {
						"paginate": {
							"previous": "<",
							"next": ">"
						}
					},
					"responsive": true // Enable responsive DataTable
				});
			});

		</script>


        <!-- gridjs js -->

        <!-- datepicker js -->
        <script src="{{ asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

	

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

				// Handle resetting and opening the review modal
				function openOrderReviewModal(orderId) {
					const reviewForm = document.getElementById("reviewForm");
					const reviewOrderIdInput = document.getElementById("reviewOrderId");

					reviewForm.reset(); // Clear previous inputs and errors
					reviewOrderIdInput.value = orderId; // Set order ID for review

					const reviewModal = new bootstrap.Modal(document.getElementById("orderReviewModal"));
					reviewModal.show();
				}

				// Handle resetting and opening the refund modal
				function openOrderRefundModal(orderId) {
					const refundForm = document.getElementById("refundForm");
					const refundOrderIdInput = document.getElementById("refundOrderId");

					refundOrderIdInput.value = orderId; // Set order ID for refund
					refundForm.action = `/backEnd/order/${orderId}/refund`; // Update action dynamically

					const refundModal = new bootstrap.Modal(document.getElementById("orderRefundModal"));
					refundModal.show();
				}

				// Expose the functions globally
				window.openOrderReviewModal = openOrderReviewModal;
				window.openOrderRefundModal = openOrderRefundModal;

				// Automatically open the correct modal based on validation errors
				const errorsExist = {{ $errors->any() ? 'true' : 'false' }};
				const orderIdFromErrors = "{{ old('order_id') }}";
				const contentHasErrors = "{{ $errors->has('content') ? 'true' : 'false' }}";
				const errorHasMessage = "{{ $errors->has('error') ? 'true' : 'false' }}"; // Check for the custom error message

				if (errorsExist && orderIdFromErrors) {
					if (contentHasErrors || errorHasMessage) {
						// If there's a refund error message, show the refund modal
						const refundModal = new bootstrap.Modal(document.getElementById("orderRefundModal"));
						refundModal.show();
					} else if ("{{ old('rating') }}" !== "") {
						// Show the review modal if there's a rating field error
						const reviewModal = new bootstrap.Modal(document.getElementById("orderReviewModal"));
						reviewModal.show();
					}
				}


			});

		</script>
		
        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
    @endsection
