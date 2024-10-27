<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Another Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Your Page Content -->
<div class="container mt-5">
    <h1>This is Another Page</h1>
    <p>Welcome to the content of this page.</p>
</div>

<!-- Modal HTML -->
<div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="welcomeModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="welcomeModalLabel">Hi @ {{ $order_details->name }}</h5>
				<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" id="closeModalButton">
				</button>
			</div>
			<div class="modal-body">
				<p>Your order was placed successfully.</p>
				<p>Would you like to manage a account with us for manage order, review, get refund & faster checkout?</p>
			</div>
			<div class="modal-body">
				<p>You're just 1 click away, enter a new password & submit.</p>
				<form method="POST" action="{{ route('register') }}" class="auth-input">
				@csrf
				<!-- Display Email Field and Validation Error -->
				<label for="inputEmail">Account for: <strong>{{ $order_details->email }}</strong></label>
					<div class="input-group mb-3">
						<input type="hidden" name="name" value="{{ $order_details->name }}">
						<input type="hidden" name="email" value="{{ $order_details->email }}">

						<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Enter a New Password" autocomplete="new-password">

  						<button class="btn btn-outline-secondary" type="submit" id="button-addon2">Submit</button>

						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
					</div>
				</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-link" id="closeModalButton">Not Interested</button>
			</div>
		</div>
	</div>
</div>

<!-- Optional JavaScript for Bootstrap Modal -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
	$(document).ready(function () {
		// Show modal on page load
		$('#welcomeModal').modal('show');

		// Close button click event
		$('#closeModalButton, .close').on('click', function () {
			$('#welcomeModal').modal('hide'); // Hide the modal
		});
	});
</script>

</body>
</html>
