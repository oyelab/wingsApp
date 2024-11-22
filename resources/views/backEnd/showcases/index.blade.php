@extends('backEnd.layouts.master')
@section('page-title')
    Products
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
		@if (session('success'))
			<div class="alert alert-success">{{ session('success') }}</div>
		@endif
		@if (session('error'))
			<div class="alert alert-danger">{{ session('error') }}</div>
		@endif

		@foreach ($showcases as $showcase)
		<div class="container my-5">
			<!-- Showcase Title and Images -->
			<div class="row align-items-center mb-4">
				<div class="col-lg-8">
					<h2 class="fw-bold">{{ $showcase->title }}</h2>
					<p class="text-muted">{{ $showcase->short_description }}</p>
				</div>
				<div class="col-lg-4 text-end">
					<img src="{{ $showcase->banner_image_path }}" alt="Banner" class="img-fluid rounded shadow-sm mb-2">
					<img src="{{ $showcase->thumbnail_image_path }}" alt="Thumbnail" class="img-fluid rounded shadow-sm">
					
					<!-- Edit Button -->
					<form action="{{ route('showcases.destroy', $showcase) }}" method="POST" data-action="delete">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-outline-danger mt-3">Delete</button>
					</form>

				</div>
			</div>

			<!-- Showcase Details -->
			<div class="row">
				@foreach ($showcase->details as $detail)
				<div class="col-lg-6 mb-4">
					<div class="card h-100 shadow-sm">
						<div class="card-body">
							<h3 class="card-title">{{ $detail->heading }}</h3>
							<p class="card-text">{{ $detail->description }}</p>

							<!-- Detail Images -->
							<div class="row g-2">
								@foreach ($detail->image_paths as $imagePath)
								<div class="col-6">
									<img src="{{ $imagePath }}" alt="{{ $detail->heading }} Image" class="img-fluid rounded shadow-sm">
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		@endforeach
	@endsection
@section('scripts')
<script>
	document.addEventListener('DOMContentLoaded', () => {
    const deleteForms = document.querySelectorAll('form[data-action="delete"]');
    deleteForms.forEach(form => {
        form.addEventListener('submit', (event) => {
            const confirmation = confirm('Are you sure you want to delete this showcase?');
            if (!confirmation) {
                event.preventDefault();
            }
        });
    });
});

</script>

@endsection