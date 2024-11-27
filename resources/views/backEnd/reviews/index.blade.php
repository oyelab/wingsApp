@extends('backEnd.layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Reviews</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Reviews Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Content</th>
					<th>Status</th>
                    <th>Rating</th>
                    <th>Where</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
					
                    <td>{{ $review->user->name ?? 'Anonymous' }}</td>
                    <td>{{ Str::limit($review->content, 50) }}</td>
					<td>
                        <span class="badge {{ $review->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $review->status ? 'Approved' : 'Rejected' }}
                        </span>
                    </td>
					<td>
						{{ $review->rating }}
					</td>

                    <td>
                        @if ($review->products->isNotEmpty())
                            <ul class="list-unstyled">
                                @foreach ($review->products as $product)
                                    <li>{{ $product->title }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">Site Review</span>
                        @endif
                    </td>
                    
                    <td>
                        <div class="d-flex gap-2">
							<button id="approveRejectBtn-{{ $review->id }}" class="btn btn-sm {{ $review->status == 0 ? 'btn-success' : 'btn-danger' }}" onclick="updateReviewStatus({{ $review->id }}, {{ $review->status == 0 ? 1 : 0 }})">
								{{ $review->status == 0 ? 'Approve' : 'Reject' }}
							</button>

                            <button class="btn btn-sm btn-primary" onclick="loadEditModal('{{ route('reviews.edit', $review->id) }}')">Edit</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    {{ $reviews->links() }}
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-content">
                    <!-- Dynamic content will load here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('build/js/app.js') }}"></script>

<script>
    // Approve/Reject Review and Toggle Button
    function updateReviewStatus(reviewId, status) {
        // Fetch the button element
        const button = document.getElementById('approveRejectBtn-' + reviewId);
        
        // Update the button's text and class based on the new status
        if (status === 1) {
            button.innerHTML = 'Reject';
            button.classList.remove('btn-success');
            button.classList.add('btn-danger');
        } else {
            button.innerHTML = 'Approve';
            button.classList.remove('btn-danger');
            button.classList.add('btn-success');
        }

        // Make the POST request to update the review status
        fetch(`/backEnd/reviews/${reviewId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Reload the page to reflect the updated status
                location.reload(); // This will reload the page after a successful status update
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }

    // Load Edit Modal
    function loadEditModal(url) {
        fetch(url)
        .then(response => response.text())
        .then(html => {
            document.getElementById('modal-content').innerHTML = html;
            new bootstrap.Modal(document.getElementById('editModal')).show();
        })
        .catch(error => console.error('Error loading the edit modal:', error));
    }
</script>


@endsection
