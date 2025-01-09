@extends('backEnd.layouts.master')
@section('title')
    Update Order
@endsection
@section('css')
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endsection
@section('page-title')
    Update Order
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
	<form action="{{ route('order.update', $order) }}" method="POST" class="container my-5">
		@csrf

		<!-- Show Errors in One Div -->
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
	
		<!-- Order Fields -->
		<h3 class="mb-4">Order Details</h3>
		<div class="mb-3">
			<label for="name" class="form-label">Name:</label>
			<input type="text" id="name" name="name" value="{{ $order->name }}" class="form-control">
		</div>
	
		<div class="mb-3">
			<label for="email" class="form-label">Email:</label>
			<input type="email" id="email" name="email" value="{{ $order->email }}" class="form-control">
		</div>
	
		<div class="mb-3">
			<label for="phone" class="form-label">Phone:</label>
			<input type="text" id="phone" name="phone" value="{{ $order->phone }}" class="form-control">
		</div>
	
		<div class="mb-3">
			<label for="address" class="form-label">Address:</label>
			<textarea id="address" name="address" class="form-control" rows="3">{{ $order->address }}</textarea>
		</div>
	
		<h3 class="mt-5 mb-4">Products</h3>
		@foreach ($order->products as $product)
			<div class="mb-4 border rounded p-3">
				<h4>{{ $product->title }}</h4>
	
				<div class="mb-3">
					<label for="size-{{ $product->pivot->product_id }}" class="form-label">Size:</label>
					<select id="size-{{ $product->pivot->product_id }}" name="products[{{ $product->pivot->product_id }}][size_id]" class="form-select">
						<option value="1" {{ $product->pivot->size_id == 1 ? 'selected' : '' }}>S</option>
						<option value="2" {{ $product->pivot->size_id == 2 ? 'selected' : '' }}>M</option>
						<option value="3" {{ $product->pivot->size_id == 3 ? 'selected' : '' }}>L</option>
						<option value="4" {{ $product->pivot->size_id == 4 ? 'selected' : '' }}>XL</option>
						<option value="5" {{ $product->pivot->size_id == 5 ? 'selected' : '' }}>XXL</option>
						<option value="6" {{ $product->pivot->size_id == 6 ? 'selected' : '' }}>XXXL</option>
					</select>
				</div>
	
				<div class="mb-3">
					<label for="quantity-{{ $product->pivot->product_id }}" class="form-label">Quantity:</label>
					<input type="number" id="quantity-{{ $product->pivot->product_id }}" name="products[{{ $product->pivot->product_id }}][quantity]" value="{{ $product->pivot->quantity }}" class="form-control">
				</div>
			</div>
		@endforeach
	
		<button type="submit" class="btn btn-primary mt-3">Update Order</button>
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
