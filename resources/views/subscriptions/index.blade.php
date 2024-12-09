<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscriptions</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Subscription List</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>IP Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscriptions as $subscription)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subscription->email }}</td>
                    <td>{{ $subscription->ip_address }}</td>
                    <td>
                        <button
                            class="btn btn-info btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#detailsModal"
                            onclick="fetchDetails({{ $subscription->id }})"
                        >
                            View Details
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $subscriptions->links() }}
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Subscription Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Details will be loaded dynamically -->
                    <ul id="subscriptionDetails" class="list-group">
                        <li class="list-group-item">Loading...</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
		function fetchDetails(id) {
			const detailsList = document.getElementById('subscriptionDetails');
			detailsList.innerHTML = '<li class="list-group-item">Loading...</li>';

			// Use Blade to generate the route URL and pass it to JavaScript
			const url = @json(route('subscriptions.show', ['id' => '__id__']));

			// Replace the placeholder '__id__' with the actual id
			const finalUrl = url.replace('__id__', id);

			axios.get(finalUrl)
				.then(response => {
					const subscription = response.data;
					detailsList.innerHTML = '';

					// Loop through all fields of the subscription
					for (const [key, value] of Object.entries(subscription)) {
						// Format the field key to a more readable format
						let formattedKey = key.replace(/_/g, ' ').replace(/\b\w/g, char => char.toUpperCase());
						detailsList.innerHTML += `
							<li class="list-group-item"><strong>${formattedKey}:</strong> ${value || 'N/A'}</li>
						`;
					}
				})
				.catch(error => {
					detailsList.innerHTML = '<li class="list-group-item text-danger">Unable to fetch details.</li>';
					console.error(error);
				});
		}
	</script>


</body>
</html>
