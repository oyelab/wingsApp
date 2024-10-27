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
                <div class="card">
                    <div class="card-body">
						<!-- DataTable -->
						<table id="orders-table" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Ref</th>
									<th>Date</th>
									<th>Customer Id</th>
									<th>Product Info</th>
									<th>Delivery Method</th>
									<th>Total Bill</th>
									<th>Payment Status</th>
									<th>Order Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>#WS2453</td>
									<td>12 Dec 24 12:00 AM</td>
									<td>
										<ul class="list-unstyled mb-0">
											<li>Faisal Hasan</li>
											<li>01710541719</li>
											<li>Rangpur</li>
										</ul>
									</td>
									<td>
										<ul class="list-unstyled mb-0">
											<li>Barcelona Concept Jersey</li>
											<li><strong>Sizes:</strong> L(2), XL(1)</li>										</ul>
									</td>
									<td>Pathao</td>
									<td>Tk. 1000</td>
									<td>Pending</td>
									<td>Pending</td>
									<td>
										<a href="">
											<i class="bi bi-eye"></i>
										</a>
										<a href="">
											<i class="bi bi-pencil-square"></i>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
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
					"paging": true,         // Enable pagination
					"lengthChange": true,    // Allow users to change how many records they want to see
					"searching": true,       // Enable search feature
					"order": [[0, 'asc']],  // Default ordering by first column (ID) in ascending order
					"columnDefs": [
						{ "orderable": false, "targets": [6] }, // Disable ordering on the 4th column (Phone)
						{ "orderable": true, "targets": [1, 2, 3, 4, 5] } // Enable ordering on Name and Email columns
					],
					"info": true,            // Show information about the table
					"autoWidth": false,      // Disable auto-width to better control table's width
					"pageLength": 5,         // Default number of rows to display
					"lengthMenu": [5, 10, 25, 50, 100], // Page length options
					"language": {
						"paginate": {
							"previous": "<", // Previous button icon
							"next": ">"      // Next button icon
						}
					}
				});
			});
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
