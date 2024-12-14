@extends('backEnd.layouts.master')
@section('title')
    Add Showcase
@endsection
@section('page-title')
    Add Showcase
@endsection
@section('body')
<body>
@endsection

@section('content')
<div class="container">
<form action="{{ route('showcases.store') }}" method="POST" enctype="multipart/form-data">
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
            <h2 class="mb-2">Create Showcase</h2>
        </div>

        <div class="col-6 d-flex justify-content-end">
            <button type="button" class="btn btn-outline-secondary me-2 w-25" onclick="window.location.href='{{ route('showcases.index') }}'">Discard</button>
            <button type="submit" class="btn btn-outline-primary me-2 w-25" onclick="setStatus(0)">Save</button>
            <button type="submit" class="btn btn-primary w-25" onclick="setStatus(1)">Publish</button>
        </div>
    </div>

    <!-- Hidden Status Field -->
    <input type="hidden" name="status" id="status">

    <!-- Title and Order -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="col-md-6">
            <label for="order" class="form-label">Order</label>
            <select name="order" id="order" class="form-select">
                @for ($i = null; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('order') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
			<small class="form-text text-muted">New order will be replace by existing order!</small>

        </div>
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label for="short_description" class="form-label">Short Description</label>
        <textarea name="short_description" id="short_description" class="form-control" rows="3">{{ old('short_description') }}</textarea>
    </div>

    <!-- Banner -->
    <div class="mb-3">
        <label for="banners" class="form-label">Banner Image</label>
        <input type="file" name="banners[]" id="banners" class="form-control" multiple>
    </div>

    <!-- Thumbnail Image -->
    <div class="mb-3">
        <label for="thumbnail" class="form-label">Thumbnail Image</label>
        <input type="file" name="thumbnail" id="thumbnail" class="form-control">
		<small class="form-text text-muted d-block ms-2">

			<div class="mt-1 mb-0">
			Ratio Guide:
				@php
					$ratios = [
						1 => [3.76, 5],
						2 => [3.76, 5],
						3 => [7.82, 4.7],
						4 => [5, 6.2],
						5 => [5, 3.5],
					];
				@endphp
				@foreach ($ratios as $order => $ratio)
					<span class="me-3">Order {{ $order }} => {{ $ratio[0] }} : {{ $ratio[1] }}</span>
				@endforeach
			</div>
		</small>
    </div>
    <!-- OgImage Image -->
    <div class="mb-3">
        <label for="og_image" class="form-label">Og Image</label>
        <input type="file" name="og_image" id="og_image" class="form-control">
		<small class="form-text text-muted d-block ms-2">
			<div class="mt-1 mb-0">Ratio Guide: 1:1.91</div>
		</small>
    </div>

</form>


</div>
@endsection

@section('scripts')
<script>
	// Function to hold the status as a boolean (1 for true, 0 for false)
	function setStatus(value) {
		// Set the status value to 1 (true) or 0 (false)
		document.getElementById('status').value = (value === 1) ? 1 : 0;
	}

</script>
<!-- App js -->
<script src="{{ asset('build/js/app.js') }}"></script>
@endsection
