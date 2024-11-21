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
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">Active Orders</p>
                                <h4 class="mb-0 mt-2">5263</h4>
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
                                <p class="text-muted text-truncate mb-0 pb-1">UnFulfilled</p>
                                <h4 class="mb-0 mt-2">3265</h4>
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
                                <p class="text-muted text-truncate mb-0 pb-1">Pending Replace</p>
                                <h4 class="mb-0 mt-2">2452</h4>
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
                                <p class="text-muted text-truncate mb-0 pb-1">Fulfilled</p>
                                <h4 class="mb-0 mt-2">6534</h4>
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
									<th>Shipping (Pathao)</th>
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
										<a href="javascript:void(0);" onclick="openOrderStatusModal({{ $order->id }})">
											<i class="bi bi-eye-fill"></i>
										</a>
										<a href="{{ route('orders.edit', $order->id) }}">
											<i class="bi bi-box-seam"></i>
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

		<!-- Order Status Update Modal -->
		<div class="modal fade" id="orderStatusModal" tabindex="-1" role="dialog" aria-labelledby="orderStatusModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h5 class="modal-title" id="orderStatusModalLabel">Update Order Status</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					
					<!-- Modal Body: Order Status Update Form -->
					<form id="updateOrderStatusForm" method="POST"> 
						@csrf
						@method('PATCH')
						<div class="modal-body">
							<p><strong>Order Ref:</strong> <span id="orderRef"></span></p>
							<p><strong>Current Status:</strong> <span id="currentOrderStatus"></span></p>
							
							<hr>
							
							<!-- Update Order Status -->
							<label for="status">Order Status</label>
							<select name="status" id="orderStatus" class="form-control" required>
								<option value="0">Pending</option>
								<option value="1">Completed</option>
								<option value="2">Processing</option>
								<option value="3">Cancelled</option>
								<option value="4">Refunded</option>
							</select>
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
				$.get(`orders/${orderId}`, function(response) {
					const order = response.order;
					
					// Display the order reference and current status
					$('#orderRef').text(order.ref);
					$('#currentOrderStatus').text(order.status); // Display the current status
					$('#orderStatus').val(order.status); // Set the dropdown to the current status
					$('#updateOrderStatusForm').attr('action', `orders/${orderId}`);

					$('#orderStatusModal').modal('show');
				}).fail(function(xhr) {
					console.log('Error:', xhr.responseText);
				});
			}

			$('#updateOrderStatusForm').on('submit', function(event) {
				event.preventDefault();
				let formData = $(this).serialize();
				console.log('Form Data:', formData); // Log the serialized data

				$.ajax({
					url: $(this).attr('action'),
					type: 'PATCH',
					data: formData,
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF protection
					},
					success: function(response) {
						if (response.success) {
							$('#orderStatusModal').modal('hide');
							// Update the order status display on the page if needed
							$(`#order-status-${response.order.id}`).text($('#orderStatus option:selected').text());
						}
					},
					error: function(xhr) {
						console.log('Error:', xhr.responseText);
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

        <!-- apexcharts -->
        <script src="{{ asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- gridjs js -->

        <!-- datepicker js -->
        <script src="{{ asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

	
		<script src="{{ asset('build/js/pages/ecommerce-orders.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
    @endsection
