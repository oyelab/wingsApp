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
	<form action="{{ route('orders.update', $order) }}" method="POST">
		@csrf
		@method('PUT')

		<!-- Order Fields -->
		<h3>Order Details</h3>
		<label>Name:</label>
		<input type="text" name="name" value="{{ $order->name }}">

		<label>Email:</label>
		<input type="email" name="email" value="{{ $order->email }}">

		<label>Phone:</label>
		<input type="text" name="phone" value="{{ $order->phone }}">

		<label>Address:</label>
		<textarea name="address">{{ $order->address }}</textarea>

		<h3>Products</h3>
		@foreach ($order->products as $product)
			<div>
				<h4>{{ $product->title }}</h4>
				<label>Size:</label>
				<select name="products[{{ $product->pivot->product_id }}][size_id]">
					<option value="1" {{ $product->pivot->size_id == 1 ? 'selected' : '' }}>Size 1</option>
					<option value="2" {{ $product->pivot->size_id == 2 ? 'selected' : '' }}>Size 2</option>
					<option value="3" {{ $product->pivot->size_id == 3 ? 'selected' : '' }}>Size 3</option>
					<option value="4" {{ $product->pivot->size_id == 4 ? 'selected' : '' }}>Size 4</option>
				</select>

				<label>Quantity:</label>
				<input type="number" name="products[{{ $product->pivot->product_id }}][quantity]" value="{{ $product->pivot->quantity }}">
			</div>
		@endforeach

		<button type="submit">Update Order</button>
	</form>

    @endsection
    @section('scripts')
		<!-- jQuery (required for DataTables) -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<!-- DataTables JS -->
		<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

        <!-- apexcharts -->
        <script src="{{ asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- gridjs js -->
        <script src="{{ asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

        <!-- datepicker js -->
        <script src="{{ asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
    @endsection
