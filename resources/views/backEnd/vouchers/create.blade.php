@extends('backEnd.layouts.master')
@section('title')
Create Voucher
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
	crossorigin="anonymous"></script>

@endsection
@section('page-title')
Create Voucher
@endsection
@section('body')

<body>
@endsection
	@section('content')

	<form action="{{ route('vouchers.store') }}" method="POST" enctype="multipart/form-data" class="container">
    @csrf
	@if ($errors->any())
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif

		<!-- Submit Button Row -->
		<div class="row g-3 mb-3 d-flex align-items-center">
			<div class="col-6">
				<h2 class="mb-2">Add a Voucher</h2>
				<h5 class="text-body-tertiary fw-bold">User can apply the vouchers in the checkout page!</h5>
			</div>

			<div class="col-6 d-flex justify-content-end">
				<button type="button" class="btn btn-outline-secondary me-2 w-25" onclick="window.location.href='{{ route('vouchers.index') }}'">Discard</button>
				<button type="submit" class="btn btn-outline-primary me-2 w-25" onclick="setStatus(0)">Save</button>
				<button type="submit" class="btn btn-primary w-25" onclick="setStatus(1)">Publish</button>
			</div>
		</div>

		<!-- Hidden Status Field -->
		<input type="hidden" name="status" id="status" value="0">

		<!-- Code -->
		<div class="row mb-3">
			<div class="col-md-8">
				<label for="title" class="col-form-label text-start">Code (Unique):</label>
				<input type="text" class="form-control" name="code" value="{{ old('code') }}" required>
			</div>
		</div>

		<!-- Discount Row -->
		<div class="row mb-3">
			<div class="col-md-8">
				<label for="discount" class="col-form-label text-start">Discount Percentage (1-100):</label>
				<input type="number" class="form-control" name="discount" value="{{ old('discount') }}" min="1" max="100" required>
			</div>
		</div>

		<!-- Criteria Row (for entering JSON data) -->
		<div class="row mb-3">
			<div class="col-md-8">
				<label for="criteria" class="col-form-label text-start">Voucher Criteria (JSON format):</label>
				<textarea class="form-control" name="criteria" rows="4" placeholder='{"min_qty": 15, "min_size": 4}' required>{{ old('criteria') }}</textarea>
				<small class="form-text text-muted">Enter JSON data like {"min_qty": 15, "min_size": 4}</small>
			</div>
		</div>

	</form>

	@endsection

	@section('scripts')
	<!-- App js -->
	<script src="{{ asset('build/js/app.js') }}"></script>
	<script>
		// Function to hold the status
		function setStatus(value) {
			document.getElementById('status').value = value;
		}
	</script>
	@endsection