@extends('frontEnd.layouts.app')
@section('css')
<style>
/* Applied Voucher Section */
.voucher-applied-container {
    background-color: var(--wings-secondary);
    padding: 10px 15px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 15px;
}

.applied-voucher-info {
    font-size: 16px;
    color: var(--wings-alternative);
}

.applied-voucher-icon {
    font-size: 20px;
    color: var(--wings-success);
}

.btn-remove-voucher {
    background-color: transparent;
    color: var(--wings-off); /* Default text color */
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    padding: 6px 15px; /* Same padding as Apply */
    border: none;
    cursor: pointer;
    transition: color 0.3s ease, font-weight 0.3s ease; /* Smooth animation */
}

.btn-remove-voucher:hover {
    color: var(--wings-primary); /* Changes to primary color on hover */
    font-weight: 700; /* Slightly bolder text */
}


/* Main Input Field */
.discount-input-container {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    background-color: transparent;
    width: 100%;
    border: 1px solid var(--wings-primary);
    border-radius: 5px;
}

.input-container {
    display: flex;
    align-items: center;
    position: relative;
    width: 100%;
}

.icon {
    font-size: 20px;
    color: var(--wings-primary);
    position: absolute;
    left: 10px;
    z-index: 1;
}

.discount-input {
    width: 100%;
    padding: 8px 15px;
    padding-left: 40px;
    font-size: 16px;
    color: var(--wings-primary);
    background-color: transparent;
    border: none;
}

.discount-input:focus {
    outline: none;
}

.apply-btn {
    background-color: transparent;
    color: var(--wings-success);
    border: none;
    padding: 6px 15px;
    font-size: 16px;
    cursor: pointer;
    transition: color 0.3s ease, font-weight 0.3s ease;
}

.apply-btn:hover {
    color: var(--wings-primary);
    font-weight: 700;
}

/* Success Message Fade-Out */
.fade-out {
    animation: fadeOut 3s ease-in forwards;
}

@keyframes fadeOut {
    0% {
        opacity: 1;
    }
    100% {
        opacity: 0;
        display: none;
    }
}

</style>
@endsection
@section('content')
<!-- Checkout -->
<section class="checkout-wrap section-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="bag-products">
					<h2>BAG</h2>
					<div class="bag-product-wrap d-flex flex-column">
						@php
							$subtotal = 0; // Sum of regular prices (without sale)
							$totalDiscount = 0; // Total discount amount
						@endphp
						@foreach($cartItems as $index => $item)
							@php
								// Calculate line totals
								$regularPriceTotal = $item['price'] * $item['quantity'];
								$discountedPriceTotal = $item['salePrice'] * $item['quantity'];

								// Update subtotal and total discount
								$subtotal += $regularPriceTotal;
								$totalDiscount += $regularPriceTotal - $discountedPriceTotal;
							@endphp
						<div class="bag-product-item d-flex">
							<div class="image-part">
								<img
									src="{{ $item['imagePath'] }}"
									draggable="false"
									class="img-fluid"
									alt=""
								/>
							</div>
							<div class="bag-product-right d-flex">
								<div class="product-info">
									<h2>
										{{ $item['title'] }}
									</h2>
									<!-- <h5>Category: {{ $item['categories'] }}</h5> -->
									<h4>Size: {{ $item['size_name'] }}</h4>
									<div class="qty-container d-flex align-items-center">
										<!-- Decrease Quantity Button -->
										<button
											id="decrease-{{ $index }}"
											onclick="updateQuantity({{ $index }}, -1)"
											class="qty-btn-minus btn-light"
											type="button"
										>
											<i class="bi bi-dash size-6"></i>
										</button>

										<!-- Quantity Input Field -->
										<input
											type="text"
											name="qty"
											value="{{ $item['quantity'] }}"
											class="input-qty text-center border-0"
											readonly
											id="quantity-{{ $index }}"
										/>

										<!-- Increase Quantity Button -->
										<button
											id="increase-{{ $index }}"
											onclick="updateQuantity({{ $index }}, 1)"
											class="qty-btn-plus btn-light"
											type="button"
										>
											<i class="bi bi-plus size-6"></i>
										</button>
									</div>

								</div>
								<div class="pricing-wrap position-relative">
									@if(isset($item['sale']))
										<p class="text-decoration-line-through text-muted">৳ {{ $item['price'] }}</p>
										<h2>৳ {{ $item['salePrice'] }}</h2>
									@else
										<h2>৳ {{ $item['price'] }}</h2>
									@endif

									<div class="product-action d-flex position-absolute bottom-0 end-0">
										<div class="delete-wrap">
											
											<button onclick="removeFromCart({{ $index }})" class="border-0"><i class="bi bi-trash fs-4"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="bag-summary-wrap">
					<h2>Summary</h2>
					<div class="total-product-pricing">
						<div class="item total-pricing">
							<h3>Subtotal <span>(2 items)</span></h3>
							<p>৳ {{ number_format($subtotal, 2) }}</p>
						</div>
						<div class="item total-pricing">
							<h3>Estimate Shipping</h3>
							<p>৳ 60.00 - 120.00</p>
						</div>
						<div class="item total-pricing">
							<h3>Discount</h3>
							<p>{{ $totalDiscount ? '৳ ' . number_format($totalDiscount, 2) : 'N/A' }}</p>
						</div>
						<div class="item total-pricing">
							<h3>Total (without shipping)</h3>
							<p>৳ {{ number_format($subtotal - $totalDiscount, 2) }}</p>
						</div>
					</div>
					@if (session('voucher_success'))
						<!-- Display the applied voucher with the updated style -->
						<div class="voucher-applied-container d-flex align-items-center justify-content-between w-100">
							<div class="applied-voucher-info d-flex align-items-center">
								<i class="bi bi-ticket-fill me-2 applied-voucher-icon"></i>
								<span class="applied-voucher-text">
									Voucher Applied: <strong>{{ session('applied_voucher') }}</strong>
								</span>
							</div>
							<form action="{{ route('voucher.remove') }}" method="POST" class="d-inline">
								@csrf
								<button type="submit" class="btn btn-sm btn-remove-voucher">Remove</button>
							</form>
						</div>
					@else
						<!-- Show the voucher input field if no voucher is applied -->
						<form action="{{ route('voucher.apply') }}" method="POST" class="discount-input-container d-flex align-items-center w-100">
							@csrf
							<div class="input-container d-flex align-items-center w-100">
								<i class="bi bi-ticket-fill icon"></i>
								<input
									type="text"
									name="voucher"
									value="{{ old('voucher') }}"
									placeholder="Enter discount code"
									class="discount-input form-control me-2 w-100"
								/>
								<button type="submit" class="apply-btn">Apply</button>
							</div>
						</form>
					@endif

					@if (session('voucher_success') && !session()->has('voucher_message_displayed'))
						<div class="alert alert-success mt-2" id="voucher-success-message">
							Voucher applied successfully! Voucher Discount: {{ session('voucher') }}%
						</div>
						@php
							session(['voucher_message_displayed' => true]);
						@endphp
					@endif

					@if (session('error'))
						<div class="alert alert-danger mt-2">
							{{ session('error') }}
						</div>
					@endif
					<!-- button -->
					<div class="button-wrap mt-3">
						<a href="{{ route('checkout.show') }}" class="guest-checkout"
							>CHECKOUT</a
						>
						<a href="{{ route('collections') }}" class="continue-shopping"
							>MORE SHOPPING
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="24"
								height="24"
								viewBox="0 0 24 24"
								fill="none"
							>
								<mask
									id="mask0_721_341"
									style="mask-type: alpha"
									maskUnits="userSpaceOnUse"
									x="0"
									y="0"
									width="24"
									height="24"
								>
									<rect
										width="24"
										height="24"
										fill="#D9D9D9"
									/>
								</mask>
								<g mask="url(#mask0_721_341)">
									<path
										d="M15.3256 13H4V11H15.3256L10.1163 5.4L11.4419 4L18.8837 12L11.4419 20L10.1163 18.6L15.3256 13Z"
										fill="#1E1E1E"
									/>
								</g>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = document.getElementById('voucher-success-message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 3000);
        }
    });
    // Update Quantity AJAX
    function updateQuantity(index, amount) {
		$.ajax({
			url: `/cart/update/${index}`,
			method: 'POST',
			data: {
				_token: '{{ csrf_token() }}',
				amount: amount
			},
			success: function(response) {
				// Update the quantity input after successful update
				const quantityInput = $('#quantity-' + index);
				const increaseButton = $('#increase-' + index);
				const decreaseButton = $('#decrease-' + index);

				quantityInput.val(response.newQuantity);

				// Enable/disable buttons based on quantity
				if (response.newQuantity >= response.availableQuantity) {
					increaseButton.prop('disabled', true); // Disable if at max
				} else {
					increaseButton.prop('disabled', false); // Enable otherwise
				}

				if (response.newQuantity <= 1) {
					decreaseButton.prop('disabled', true); // Disable if at min
				} else {
					decreaseButton.prop('disabled', false); // Enable otherwise
				}
			},
			error: function(xhr) {
				alert(xhr.responseJSON.message); // Show an error message
			}
		});
	}


    // Remove Item AJAX
    function removeFromCart(index) {
        $.ajax({
            url: `/cart/remove/${index}`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Reload the page after item removal to reflect changes
                location.reload();
            }
        });
    }
</script>
@endsection