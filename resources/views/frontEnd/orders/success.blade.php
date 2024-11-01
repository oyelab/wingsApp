@extends('frontEnd.layouts.app')
@section('css')
<link href="{{ asset('frontEnd/css/test.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@if ($showModal)
<!-- Modal HTML -->
<div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="welcomeModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="welcomeModalLabel">Hi {{ $order_details->name }}</h5>
				<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" id="closeModalButton"></button>
			</div>
			<div class="modal-body">
				<p>Your order was placed successfully.</p>
				<p>Would you like to manage an account with us for managing orders, reviews, refunds, and faster checkout?</p>
			</div>
			<div class="modal-body">
				<p>You're just 1 click away; enter a new password & submit.</p>
				<form method="POST" action="{{ route('register') }}" class="auth-input">
				@csrf
				<label for="inputEmail">Account for: <strong>{{ $order_details->email }}</strong></label>
					<div class="input-group mb-3">
						<input type="hidden" name="name" value="{{ $order_details->name }}">
						<input type="hidden" name="email" value="{{ $order_details->email }}">
						<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Enter a New Password" autocomplete="new-password">
  						<button class="btn btn-outline-secondary" type="submit" id="button-addon2">Submit</button>
					</div>
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link" id="closeModalButton">Not Interested</button>
			</div>
		</div>
	</div>
</div>
@endif

<section class="order-confirmation">
	<h1 class="confirmation-title">Thank You!</h1>

	<div class="confirmation-content">
		<article class="order-details">
			<section class="message-container">
				<h2 class="section-heading">Your Order Was Placed Successfully.</h2>
				<div class="section-content">
					<p>Note the order ref for tracking order.</p>
					<ul class="info-list">
						<li class="info-item badge-item">Order Ref: {{ $order_details->ref }}</li>
						<li class="info-item">Ordered At: {{ $order_details->tran_date }}</li>
						<li class="info-item">We have sent the order confirmation details to {{ $order_details->email }}
						</li>
					</ul>
				</div>
			</section>

			<section class="delivery-section">
				<h2 class="section-heading">Delivery</h2>
				<div class="section-content">
					<p class="tracking-note">Shipping Address:</p>
					<div class="info-list">
						<ul class="info-list">
							<li class="info-item">{{ $order_details->name }}</li>
							<li class="info-item">{{ $order_details->address }}</li>
							<li class="info-item">{{ $order_details->email }}</li>
							<li class="info-item">{{ $order_details->phone }}</li>
						</ul>
					</div>
				</div>
			</section>
		</article>

		<aside class="summary-section">
			<h2 class="section-heading">Summary</h2>
			<p>Order information:</p>

			@foreach ($order_items as $item)
				<article class="product-items">
					<img src="{{ asset($item['imagePath']) }}" alt="{{ $item['title'] }}" class="product-image" />

					<div class="product-details">
						<h4>{{ $item['title'] }}</h4>
						<p class="info-item">
							Regular Price: Tk. {{ $item['price'] }}
						</p>

						@if ($item['sale'] < $item['price'])
							<p class="info-item">
								Offer Price: Tk. {{ $item['sale'] }}
							</p>
						@endif
						<p class="info-item">Categories: {{ $item['categories'] }}</p>
						<p class="info-item">Size: {{ $item['size'] }}</p>
						<p class="info-item">Quantity: {{ $item['quantity'] }}</p>
					</div>
				</article>
			@endforeach

			<div class="cost-summary">
				<div class="subtotal-labels">
					<p>Subtotal</p>
					<p>Discount</p>
					<p>Delivery Charge</p>
				</div>
				<div class="subtotal-values">
					<p>Tk. {{ $order_details->subtotal }}</p>
					<p>{{ $order_details->discount ? '৳' . $order_details->discount : 'N/A' }}</p>
					<p>Tk. {{ $order_details->shipping_charge }}</p>
				</div>
			</div>

			<hr class="divider" />

			<div class="total-summary">
				<div class="cost-labels">
					<p>Order Total</p>
					<p>Paid</p>
					@if ($order_details->unpaid_amount > 0)
						<p>Unpaid</p>
					@endif
				</div>
				<div class="cost-values">
					<p>Tk. {{ $order_details->order_total }}</p>
					<p>Tk. {{ $order_details->paid }}</p>
					@if ($order_details->unpaid_amount > 0)
						<p>Tk. {{ $order_details->unpaid_amount }}</p>
					@endif
				</div>
			</div>
		</aside>
	</div>

	<button class="print-button">
		<span class="print-content">
			<span>Print Invoice</span>
		</span>
	</button>
</section>

@section('scripts')
<script>
	$(document).ready(function () {
		// Check localStorage for modal display status
		if (!localStorage.getItem('modalClosed')) {
			// Only show modal if $showModal is true
			@if ($showModal)
				$('#welcomeModal').modal('show');
			@endif
		}

		// Close button click event
		$('#closeModalButton, .close').on('click', function () {
			$('#welcomeModal').modal('hide'); // Hide the modal
			localStorage.setItem('modalClosed', 'true'); // Set flag in localStorage
		});
	});
</script>

@endsection

@endsection