@extends('backEnd.layouts.master')

@section('css')
<!-- Add your custom styles here if necessary -->
@endsection

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Vouchers</h1>
        <a href="{{ route('vouchers.create') }}" class="btn btn-success">Create New Voucher</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">All Vouchers</h5>
        </div>
        <div class="card-body">
            @if($vouchers->isNotEmpty())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Discount (%)</th>
                            <th>Max Products</th>
                            <th>Min Quantity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vouchers as $index => $voucher)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $voucher->code }}</td>
                                <td>{{ $voucher->discount }}</td>
                                <td>{{ $voucher->max_product }}</td>
                                <td>{{ $voucher->min_quantity }}</td>
                                <td>
                                    <span class="badge {{ $voucher->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $voucher->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
									<a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="loadEditModal('{{ route('vouchers.edit', $voucher->id) }}')">Edit</a>


                                    <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this voucher?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No vouchers found. <a href="{{ route('vouchers.create') }}">Create one</a>.</p>
            @endif
        </div>
    </div>

	<!-- Edit Voucher Modal -->
	<div class="modal fade" id="editVoucherModal" tabindex="-1" aria-labelledby="editVoucherModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editVoucherModalLabel">Edit Voucher</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div id="editVoucherFormContainer">
						<!-- Content will be dynamically loaded here -->
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
@section('scripts')
<script src="{{ asset('build/js/app.js') }}"></script>
<script>
    function loadEditModal(url) {
        const modalBody = document.getElementById('editVoucherFormContainer');
        
        if (!modalBody) {
            console.error('Modal container not found');
            return;
        }

        // Show a loading spinner while fetching the content
        modalBody.innerHTML = '<div class="text-center my-4"><div class="spinner-border text-primary" role="status"></div></div>';

        // Fetch the form via AJAX
        fetch(url)
            .then(response => response.text())
            .then(html => {
                modalBody.innerHTML = html; // Populate the modal with the fetched form
                const modal = new bootstrap.Modal(document.getElementById('editVoucherModal'));
                modal.show(); // Display the modal
            })
            .catch(error => {
                console.error('Error fetching form:', error);
                modalBody.innerHTML = '<div class="alert alert-danger">Failed to load form. Please try again.</div>';
            });
    }
</script>
<script>
    /**
     * Function to set the status value.
     * @param {number} value - Status value to set (0 for Save, 1 for Publish).
     */
    function setStatus(value) {
        document.getElementById('status').value = value;
    }
</script>


@endsection