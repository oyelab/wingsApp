@extends('backEnd.layouts.master')

@section('title')
    Customers List
@endsection

@section('css')
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
@section('body')
    <body>
    @endsection
    @section('content')
		<div class="container">
			<h1 class="my-4">Customers List</h1>

			@if(session('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
			@endif

			<table id="customersTable" class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Phone</th>
						<th>City</th>
						<th>Zone</th>
						<th>Area</th>
						<th>Country</th>
						<th>Zip</th>
						<th>Email</th>
						<th>Orders</th>
						<th>Reviews</th>
					</tr>
				</thead>
				<tbody>
					<!-- DataTable will dynamically fill this part -->
				</tbody>
			</table>
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
				$('#customersTable').DataTable({
					processing: true,  // Show processing indicator
					serverSide: true,  // Enable server-side processing
					ajax: {
						url: '{{ route('customer.list') }}',  // URL to fetch data from
						type: 'GET',
						dataSrc: function (json) {
							// Modify data structure if needed
							return json.data;
						}
					},
					columns: [
						{ data: 'name', name: 'name' },
						{ data: 'phone', name: 'phone' },
						{ data: 'city', name: 'city' },
						{ data: 'zone', name: 'zone' },
						{ data: 'area', name: 'area' },
						{ data: 'country', name: 'country' },
						{ data: 'zip', name: 'zip' },
						{ data: 'email', name: 'email' },
						{ data: 'ordersCount', name: 'ordersCount' }, // Add the new column for order count
						{ data: 'reviewsCount', name: 'reviewsCount' }, // Add the new column for reviews count
					],
					paging: true,
					searching: true,
				});
			});

		</script>

		<script src="{{ asset('build/js/app.js') }}"></script>
	@endsection