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

/* @keyframes fadeOut {
    0% {
        opacity: 1;
    }
    100% {
        opacity: 0;
        display: none;
    }
} */

#error-message-container {
    opacity: 1;
    transition: opacity 0.5s ease;
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
							// Initialize default values for price and salePrice if not set
							$regularPrice = $item['price'] ?? 0;
							$salePrice = $item['salePrice'] ?? $regularPrice;
							$regularPriceTotal = $regularPrice * $item['quantity']; // Regular price without discount
							$discountedPriceTotal = $salePrice * $item['quantity']; // Discounted price, if any
							
							// Update subtotal and total discount
							$subtotal += $regularPriceTotal;
							$totalDiscount += ($regularPriceTotal - $discountedPriceTotal);
						@endphp
						<div class="bag-product-item d-flex">
							<div class="image-part">
								<img src="{{ $item['imagePath'] }}" draggable="false" class="img-fluid" alt="" />
							</div>
							<div class="bag-product-right d-flex">
								<div class="product-info">
									<h2>{{ $item['title'] }}</h2>
									<h4>Size: {{ $item['size_name'] }}</h4>
									<div class="qty-container d-flex align-items-center">
										<button
											id="decrease-{{ $index }}"
											onclick="updateQuantity({{ $index }}, -1)"
											class="qty-btn-minus btn-light"
											type="button"
										>
											<i class="bi bi-dash size-6"></i>
										</button>

										<input
											type="text"
											name="qty"
											value="{{ $item['quantity'] }}"
											class="input-qty text-center border-0"
											readonly
											id="quantity-{{ $index }}"
										/>

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
									@if($salePrice < $regularPrice)
										<p class="text-decoration-line-through text-muted">৳ {{ number_format($regularPrice, 2) }}</p>
										<h2>৳ {{ number_format($salePrice, 2) }}</h2>
									@else
										<h2>৳ {{ number_format($regularPrice, 2) }}</h2>
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
					<div class="row mb-3">
						<div class="item total-pricing">
							<h3>Subtotal <span>(2 items)</span></h3>
							<p id="subtotal">৳ {{ number_format($subtotal, 2) }}</p>
						</div>
						<div class="item total-pricing">
							<h3>Product Discount</h3>
							<p id="totalDiscount">{{ $totalDiscount ? '৳ ' . number_format($totalDiscount, 2) : 'N/A' }}</p>
						</div>
						<div class="item total-pricing">
							<h3>Total (without shipping)</h3>
							<p id="total">৳ {{ number_format($subtotal - $totalDiscount, 2) }}</p>
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
									placeholder="Enter voucher code"
									class="discount-input form-control me-2 w-100"
								/>
								<button type="submit" class="apply-btn">Apply</button>
							</div>
						</form>
					@endif

					@if (session('voucher_success') && !session()->has('voucher_message_displayed'))
						<div class="d-flex align-items-center text-success mt-2 ms-2">
							Voucher applied successfully! Voucher Discount: {{ session('voucher') }}%
						</div>
						@php
							session(['voucher_message_displayed' => true]);
						@endphp
					@endif

					@if ($errors->any())
						<div id="error-message-container" class="d-flex align-items-center text-danger mt-2 ms-2" role="alert">
							<i class="bi bi-exclamation-triangle-fill me-2"></i>
							<ul class="mb-0">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<div class="item mt-2">
						<strong><small><i class="bi bi-truck me-2"></i> Delivery fee & voucher discount will be calculated at checkout.</small></strong>
					</div>

					<!-- button -->
					<div class="button-wrap mt-3">
						<a href="{{ route('checkout.show') }}" class="guest-checkout"
							>CHECKOUT</a
						>
						<a href="{{ route('collections') }}" class="continue-shopping"
							>MORE SHOPPING
							<i class="bi bi-arrow-right"></i>
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

				// Update the summary section (Subtotal, Discount, Total)
				$('#subtotal').text('৳ ' + response.subtotal); // Assuming you're returning the updated subtotal
				$('#totalDiscount').text('৳ ' + response.totalDiscount); // Assuming you're returning the updated discount
				$('#total').text('৳ ' + response.total); // Assuming you're returning the updated total after discount

			},
			error: function(xhr) {
				alert(xhr.responseJSON.message); // Show an error message
			}
		});
	}


// Function to update the cart summary in the DOM
function updateCartSummary(cartSummary) {
    // Update subtotal, total discount, and total amount
    $('#subtotal').text('৳ ' + cartSummary.subtotal.toFixed(2));
    $('#totalDiscount').text(cartSummary.totalDiscount ? '৳ ' + cartSummary.totalDiscount.toFixed(2) : 'N/A');
    $('#totalAmount').text('৳ ' + (cartSummary.subtotal - cartSummary.totalDiscount).toFixed(2));

    // Optionally, update item count in the summary (if needed)
    $('#itemCount').text(cartSummary.itemCount);
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

<script>
	document.addEventListener("DOMContentLoaded", function() {
    const errorMessage = document.getElementById('error-message-container');

    if (errorMessage) {
        setTimeout(function() {
            errorMessage.style.opacity = '0'; // Fade out the error message
        }, 2500); // After 2.5 seconds, start fading the message

        // After the fade out is complete, hide the element from the DOM
        setTimeout(function() {
            errorMessage.style.display = 'none'; // Remove from DOM after fade-out
        }, 2500); // Wait a little longer (500ms after fade)
    }
});

</script>
@endsection