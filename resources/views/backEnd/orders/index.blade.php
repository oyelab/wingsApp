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
									<th>Customer</th>
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
											<li><b>{{ $product->title }}</b> (Size: {{ $product->sizes->firstWhere('id', $product->pivot->size_id)->name ?? 'N/A' }}, Quantity: {{ $product->pivot->quantity }})</li>
										@endforeach
										</ul>
									</td>
									<td>
										@if ($order->status == 2)
											<a href="{{ route('orders.delivery', $order->id) }}" class="badge bg-dark">
												<i class="bi bi-box-seam me-1"></i> Create Delivery
											</a>
										@elseif ($order->status == 3)
											{{$order->delivery->consignment_id }}
										@else
											<x-order-status :status="$order->status" />
										@endif
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
													<li>Paid: {{ $order->paid }}</li>
													<li>Unpaid: {{ $order->unpaid_amount }}</li>
												@endif
											@endforeach
										</ul>
									</td>
									<td id="order-status-{{ $order->id }}">
										<x-order-status :status="$order->status" />
									</td>
									<td class="text-center">
										{{-- @if ($order->status == 2)
											<!-- Invoice Link -->
											<a href="{{ route('orders.edit', $order) }}" class="badge bg-success text-white">
												<i class="bi bi-pencil-square"></i> Edit
											</a>
										@endif --}}
										<a href="javascript:void(0);" onclick="openOrderStatusModal({{ $order->id }})" class="badge bg-primary text-white">
											<i class="bi bi-eye-fill me-1"></i> View Status
										</a>
										@if ($order->status == 1 || $order->status == 2 || $order->status == 3)
											<!-- Invoice Link -->
											<a href="{{ route('order.invoice', $order) }}" class="badge bg-success text-white">
												<i class="bi bi-download"></i> Invoice
											</a>
										@endif
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

		<!-- Order Status Update Modal -->
		<div class="modal fade" id="orderStatusModal" tabindex="-1" role="dialog" aria-labelledby="orderStatusModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="orderStatusModalLabel">Update Order Status</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form id="updateOrderStatusForm" method="POST">
						@csrf
						@method('PATCH')
						<div class="modal-body">
							<p><strong>Order Ref:</strong> <span id="orderRef"></span></p>
							<p><strong>Current Status:</strong> <span id="currentOrderStatus"></span></p>
							<label for="status">Order Status</label>
							<select name="status" id="orderStatus" class="form-control" required></select>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary mt-3">Update Status</button>
						</div>
					</form>
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
			function openOrderStatusModal(orderId) {
				// Use the correct route for fetching the order by orderId
				$.get("{{ route('orders.show', ':orderId') }}".replace(':orderId', orderId), function(response) {
					const order = response.order;
					
					// Set order reference and current status
					$('#orderRef').text(order.ref);
					$('#currentOrderStatus').text(order.status);

					// Populate the order status dropdown dynamically based on the current status
					let statusOptions = '';
					switch(order.status) {
						case 0: // Pending
							statusOptions = `
								<option value="0">Pending</option>
								<option value="2">Processing</option>
								<option value="5">Cancelled</option>
							`;
							break;
						case 1: // Completed
							statusOptions = `
								<option value="2">Processing</option>
								<option value="5">Cancelled</option>
							`;
							break;
						case 2: // Processing
							statusOptions = `
								<option value="1">Completed</option>
								<option value="3">Shipped</option>
								<option value="5">Cancelled</option>
							`;
							break;
						case 3: // Shipped
							statusOptions = `
								<option value="1">Completed</option>
							`;
							break;
						case 4: // Refunded
							statusOptions = ''
							break;
						case 5: // Cancelled
							statusOptions = ''
							break;
						case 6: // Failed
							statusOptions = ''
							break;
						case 7: // Request Refund
							statusOptions = `
								<option value="4">Refunded</option>
								<option value="5">Cancelled</option>
							`;
							break;
						default:
							statusOptions = ''; // Default case
					}
					
					// Update the dropdown with the dynamically created options
					$('#orderStatus').html(statusOptions);

					// Set the current status value
					$('#orderStatus').val(order.status);

					// Update form action with the correct orderId for PATCH request
					$('#updateOrderStatusForm').attr('action', `{{ route('orders.update', ':orderId') }}`.replace(':orderId', orderId));

					// Show the modal
					$('#orderStatusModal').modal('show');
				}).fail(function(xhr) {
					console.log('Error:', xhr.responseText);
				});
			}

			// Handle form submission for updating the status
			$('#updateOrderStatusForm').on('submit', function(event) {
				event.preventDefault(); // Prevent default form submission
				let formData = $(this).serialize(); // Serialize form data

				$.ajax({
					url: $(this).attr('action'), // Use the form's action attribute as the URL
					type: 'PATCH', // HTTP method
					data: formData, // Serialized form data
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
					},
					success: function(response) {
						console.log('Response:', response); // Debugging: Log the entire response

						if (response.success) {
							if (response.order && response.order.id) {
								// Update the DOM with the new order status
								$(`#order-status-${response.order.id}`).text($('#orderStatus option:selected').text());
								$('#orderStatusModal').modal('hide');
							} else {
								console.error('Order ID is missing in the response.');
								alert('Order ID is missing in the response. Please check the backend response.');
							}
						} else {
							console.error('Update failed:', response.message);
							alert('Failed to update the order status: ' + response.message);
						}
					},
					error: function(xhr) {
						console.error('Error:', xhr.responseText);
						alert('An error occurred while updating the order status. Please try again.');
					}
				});
			});



		</script>



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

        <!-- datepicker js -->
        <script src="{{ asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>


        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
    @endsection
