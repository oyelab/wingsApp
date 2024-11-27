<!-- resources/views/pages/index.blade.php -->

@extends('backEnd.layouts.master')
@section('css')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<style>

/* Glowing effect for dragging */
@keyframes dragging-effect {
    0% {
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.3), 0 0 15px rgba(255, 255, 255, 0.3);
    }
    50% {
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.5), 0 0 20px rgba(255, 255, 255, 0.5);
    }
    100% {
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.3), 0 0 15px rgba(255, 255, 255, 0.3);
    }
}

/* Applied when an item is dragged */
.dragging {
    animation: dragging-effect 2s ease-out infinite;
    z-index: 10; /* Ensure it stays on top of others */
    transition: none;
}

</style>
@endsection
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Pages</h1>
        <a href="{{ route('pages.create') }}" class="btn btn-success">Create New Page</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

	@if($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif


    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">All Pages</h5>
        </div>
        <div class="card-body">
            @if($pages->isNotEmpty())
            <table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Slug</th>
						<th>Updated At</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="sortable" class="sortable">
					@foreach($pages as $index => $page)
						<tr data-id="{{ $page->id }}">
							<td>{{ $index + 1 }}</td>
							<td>{{ $page->title }}</td>
							<td>
								<div class="rounded-circle avatar-sm d-flex justify-content-center align-items-center text-uppercase bg-secondary text-white" style="width: 25; height: 25; object-fit: cover; overflow: hidden;">
									@if($page->imagePath)
										<img class="img-fluid rounded-circle" src="{{ $page->imagePath }}" alt="{{ $page->title }}" style="width: 100%; height: 100%; object-fit: cover;">
									@else
										{{ substr($page->title, 0, 1) }}
									@endif
								</div>
							</td>
							<td>{{ $page->updated_at->format('d M Y, h:i A') }}</td>
							<td>
								<form action="{{ route('pages.update-type', $page->id) }}" method="POST" style="display: inline-block;">
									@csrf
									@method('PUT')
									<select name="type" class="form-select form-select-sm" onchange="this.form.submit()">
										@foreach($menuTypes as $value => $label)
											<option value="{{ $value }}" {{ $page->type == $value ? 'selected' : '' }}>{{ $label }}</option>
										@endforeach
									</select>
								</form>
							</td>
							<td>
								<a href="{{ route('pages.edit', $page->id) }}" class="btn btn-primary btn-sm">Edit</a>
								<form action="{{ route('pages.destroy', $page->id) }}" method="POST" style="display: inline-block;">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this page?')">Delete</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>


			</table>


            @else
            <p class="text-muted">No pages found. <a href="{{ route('pages.create') }}">Create one</a>.</p>
            @endif
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const sortable = new Sortable(document.getElementById('sortable'), {
        onStart: function(evt) {
            // Add the "dragging" class when the drag starts
            evt.item.classList.add('dragging');
        },
        onEnd: function(evt) {
            // Delay the removal of the "dragging" class to ensure the effect stays after the drag ends
            setTimeout(function() {
                evt.item.classList.remove('dragging');
            }, 300); // Delay in milliseconds (adjust if needed for smoother transition)

            // Update the order after the drag ends
            let order = [];
            const rows = document.querySelectorAll('#sortable tr');

            rows.forEach((row, index) => {
                order.push({
                    id: row.getAttribute('data-id'),
                    order: index + 1
                });
            });

            // Send the updated order to the backend
            updateOrder(order);
        }
    });

    function updateOrder(order) {
        fetch("{{ route('pages.update-order') }}", {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ order: order })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Order updated successfully!");
            } else {
                console.error("Failed to update the order.");
            }
        });
    }
});

</script>
<script src="{{ asset('build/js/app.js') }}"></script>

@endsection
