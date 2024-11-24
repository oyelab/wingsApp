@extends('frontEnd.layouts.app')
@section('css')

@endsection
@section('content')
<!-- Checkout -->
<section class="checkout-wrap section-padding">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="checkout-heading text-center">
					<h1>Checkout</h1>
					<div class="item-and-price">
						<!-- Display Item or Items based on total quantity -->
						<p>
							@if($totalQuantity == 1)
								({{ $totalQuantity }} Item)
							@else
								({{ $totalQuantity }} Items)
							@endif
						</p>

						<!-- Display the order total value with commas as thousand separators and ensure 2 decimal places -->
						<p>৳ {{ number_format($orderTotal, 2, '.', '') }}</p>
					</div>
				</div>
			</div>
		</div>
		<form action="{{ route('checkout.process') }}" method="POST">
			@csrf
			<!-- Customer Information -->
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			
			@if(session('message'))
				<div class="alert alert-info">
					{{ session('message') }}
				</div>
			@endif

			<input type="hidden" name="totalQuantity" value="{{ $totalQuantity }}">

			<div class="row">
				
				<div class="col-md-8">
					<div class="checkout-form">
						<h2>Delivery Address</h2>



						<div class="form-group">
							<label for="full_name">Full name
								<span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
								value="{{ old('name') }}" !required />
						</div>
						<div class="form-group">
							<label for="phone">Phone Number
								<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone number"
								value="{{ old('phone') }}" !required />
						</div>
						<div class="form-group">
							<label for="email">Email Address
								<span class="text-danger">*</span></label>
							<input type="email" class="form-control" id="email" name="email"
								placeholder="Enter email address" value="{{ old('email') }}" !required />
						</div>
						<div class="form-group">
							<label for="address">House/Road/Post
								<span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="address" name="address"
								placeholder="5/A, 27, Dhanmondi" />
						</div>
						<div class="dristic-wrap">
							<div class="form-group">
								<label for="city">City </label>
								<select class="form-control" id="recipient_city" name="recipient_city" !required
									onchange="fetchZones()">
									<option value="">Select City</option>
								</select>
							</div>
							<div class="form-group">
								<label for="zone">Zone </label>
								<select class="form-select" id="recipient_zone" name="recipient_zone" !required
									onchange="fetchAreas()">
									<option value="">Select Zone</option>
								</select>
							</div>
							<div class="form-group">
								<label for="area">Area </label>
								<select class="form-select" id="recipient_area" name="recipient_area" !required>
									<option value="">Select Area</option>
								</select>
							</div>
						</div>
						<div class="form-check mt-2">
							<input type="checkbox" class="form-check-input" name="terms" !required>
							<label class="form-check-label" for="exampleCheck1">I have read and agree to the
								<a href="{{ route('help.index') }}#terms-conditions">Terms and Conditions.</a></label>
						</div>

					</div>
				</div>
				<div class="col-md-4">
					<div class="review-your-cart-wrap">
						<div class="review-your-cart-top">
							<h3>Review your cart</h3>
							<a href="{{ route('cart.show') }}">
								<i class="bi bi-pencil-square"></i> Update
							</a>
						</div>


						<div class="cart-products">
						@foreach($cartItems as $item)
							<a href="{{ route('products.details', [
									'category' => $item['categorySlug'], 
									'subcategory' => $item['subcategory'], 
									'product' => $item['slug'] 
								]) }}" class="cart-product">
								<div class="product-image">
									<img src="{{ $item['imagePath'] }}" alt="Product" draggable="false"
										class="img-fluid w-25 h-auto" />
									<div class="product-details">
										<h4>{{ $item['title'] }}</h4>
										<div class="d-flex">
											<h5>
												<span class="fw-bold text-muted">Size:</span> {{ $item['size_name'] }}
											</h5>
											<h5>
												<span class="fw-bold text-muted ms-2">Qty:</span> {{ $item['quantity'] }}x
											</h5>
										</div>

										<!-- Display Price and Sale Price conditionally -->
										<p>
											@if($item['offerPrice'] && $item['offerPrice'] > 0)
												<span class="text-decoration-line-through text-muted">{{ $item['price'] }}</span>
												<span class="text-success fw-bold">{{ $item['offerPrice'] }}</span>
											@else
												<span class="text-success fw-bold">{{ $item['price'] }}</span>
											@endif
										</p>

									</div>
								</div>
							</a>
							<input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $item['product_id'] }}"> <!-- Adjust key if necessary -->
							<input type="hidden" name="products[{{ $loop->index }}][size_id]" value="{{ $item['size_id'] }}">
							<input type="hidden" name="products[{{ $loop->index }}][quantity]" value="{{ $item['quantity'] }}">
						@endforeach


						</div>

						<div class="payment-methods">
							<label class="payment-option">
								<input type="radio" id="cod" name="payment_method" value="COD" !required
									onclick="updatePayable()" {{ old('payment_method') == 'COD' ? 'checked' : '' }}>
								<span>Cash on Delivery</span>
							</label>
							<label class="payment-option">
								<input type="radio" id="online" name="payment_method" value="Full Payment" !required
									onclick="updatePayable()" {{ old('payment_method') == 'Full Payment' ? 'checked' : '' }}>
								<span>Online Payment</span>
							</label>
						</div>

						<div class="total-product-pricing">
							<!-- Shipping Fee Display -->
							<div class="item">
								<h3>Shipping</h3>
								<p id="shipping">
									<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
									Calculating...
								</p>
								
								<input type="hidden" id="hidden_shipping_charge" name="shipping_charge" value="0.00">
							</div>

							<!-- Subtotal, Discount, Voucher, Total, and Payable Fields -->
							<div class="item">
								<h3>Subtotal</h3>
								<p id="subtotal">৳ 0.00</p>
							</div>

							<div class="item" id="discountRow">
								<h3>Order Discount</h3>
								<p id="discount">N/A</p>
							</div>

							<div class="item" id="voucherRow">
								<h3>Voucher</h3>
								<p id="voucher">N/A</p>
								<input type="hidden" id="voucherInput" name="voucher" value="">
							</div>

							<div class="item">
								<h3>Total</h3>
								<p id="total">৳ 0.00</p>
							</div>

							<div class="item">
								<h3>Payable</h3>
								<p id="payable">
									<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
									Calculating...
								</p>
							</div>
						</div>


						<div class="checkout-btn">
							<button type="submit" class="btn btn-primary w-100">Pay Now</button>
						</div>
						<div class="payment-accept text-center">
							<img src="{{ asset('images/payment.png') }}" draggable="false" class="img-fluid"
								alt="Payment accept" />
						</div>
						<div class="message-info">
							<div class="message-info-top">
								<div>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none">
										<path
											d="M17 10V8C17 5.23858 14.7614 3 12 3C9.23858 3 7 5.23858 7 8V10M12 14.5V16.5M8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C17.7202 10 16.8802 10 15.2 10H8.8C7.11984 10 6.27976 10 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21Z"
											stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round"
											stroke-linejoin="round" />
									</svg>
								</div>
								<h4>
									Ensuring your financial and personal
									details are secure during every
									transaction.
								</h4>
							</div>
							<p>
								Ensuring your financial and personal details
								are secure during every transaction.
							</p>
						</div>
					</div>
				</div>
				
			</div>
		</form>
	</div>
</section>
@endsection
@section('scripts')

<!-- Add this script to handle the payment selection -->
<script src="{{ asset('frontEnd/js/pathaoApi.js') }}"></script>

<script>
	// Pass Blade data to JavaScript
	const cartItems = @json($cartItems);
	const voucherDiscount = @json($voucherDiscount);
</script>

<script>
// Get totalQuantity from PHP into JavaScript
const totalQuantity = @json($totalQuantity);

async function calculateShippingPrice() {
    const recipientCity = document.getElementById('recipient_city').value;
    const recipientZone = document.getElementById('recipient_zone').value;

    const shippingElement = document.getElementById('shipping');
    const shippingChargeElement = document.getElementById('hidden_shipping_charge');
    
    // Show calculating effect (loading spinner or text)
    shippingElement.textContent = "Calculating...";
    shippingChargeElement.value = 0; // Optional: Set the shipping charge to 0 during calculation

    if (recipientCity && recipientZone) {
        try {
            const response = await fetch('/calculate-shipping', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    recipient_city: recipientCity,
                    recipient_zone: recipientZone,
                    quantity: totalQuantity // Add totalQuantity to the request payload
                })
            });

            const data = await response.json();

            if (response.ok) {
                const shipping = data.data.final_price || 0;

                // Update UI with calculated shipping price
                shippingElement.textContent = `৳ ${shipping.toFixed(2)}`;
                shippingChargeElement.value = shipping.toFixed(2);
                calculateCartSummary(shipping); // Calculate cart summary after shipping is updated
            } else {
                console.error('Shipping calculation error:', data.message);
                shippingElement.textContent = "Error calculating shipping.";
            }
        } catch (error) {
            console.error("Error calculating shipping price:", error);
            shippingElement.textContent = "Error calculating shipping.";
        }
    } else {
        const defaultShipping = 60;

        // Display default shipping if cities/zones are not selected
        shippingElement.textContent = `৳ ${defaultShipping.toFixed(2)}`;
        shippingChargeElement.value = defaultShipping.toFixed(2);
        calculateCartSummary(defaultShipping); // Calculate cart summary after shipping is updated
    }
}


// Function to calculate cart summary including shipping
function calculateCartSummary(shipping) {
    let subtotal = 0;
    let discount = 0;
    const voucherDiscountPercentage = @json($voucherDiscount);
    let voucherDiscountAmount = 0;

    const cartItems = @json($cartItems); // Ensure cartItems is a valid array of cart items

    cartItems.forEach(item => {
        const quantity = item.quantity;
        const price = item.price;
        const offerPrice = item.offerPrice || price;

        subtotal += price * quantity;
        discount += (price - offerPrice) * quantity;
    });

    const totalBeforeVoucher = subtotal - discount;
    voucherDiscountAmount = (totalBeforeVoucher * voucherDiscountPercentage) / 100;
    voucherDiscountAmount = parseFloat(voucherDiscountAmount.toFixed(2));

    const total = totalBeforeVoucher - voucherDiscountAmount + shipping;

    // Update the DOM
    document.getElementById('subtotal').textContent = `৳ ${subtotal.toFixed(2)}`;
    document.getElementById('total').textContent = `৳ ${total.toFixed(2)}`;

    // Update discount field visibility
    const discountRow = document.getElementById('discountRow');
    const discountElement = document.getElementById('discount');
    if (discount > 0) {
        discountElement.textContent = `৳ ${discount.toFixed(2)}`;
        discountRow.style.display = ''; // Show discount row if there's a discount
    } else {
        discountElement.textContent = 'N/A';
        discountRow.style.display = 'none'; // Hide discount row if no discount
    }

    // Update voucher field visibility
    const voucherRow = document.getElementById('voucherRow');
    const voucherElement = document.getElementById('voucher');
    if (voucherDiscountAmount > 0) {
        voucherElement.textContent = `৳ ${voucherDiscountAmount.toFixed(2)}`;
        document.getElementById('voucherInput').value = voucherDiscountAmount; // Update hidden input value
        voucherRow.style.display = ''; // Show voucher row if there's a voucher discount
    } else {
        voucherElement.textContent = 'N/A';
        document.getElementById('voucherInput').value = ''; // Clear hidden input value
        voucherRow.style.display = 'none'; // Hide voucher row if no voucher
    }

    // Update payable
    updatePayable(total, shipping);
}

function updatePayable(total = 0, shipping = 0) {
    // Get the payable element
    const payableElement = document.getElementById('payable');

    // Show calculating effect (loading spinner or text)
    payableElement.textContent = "Calculating..."; // Show calculating text
    payableElement.classList.add('loading'); // Optional: Add a loading class for styling (you can add CSS for animation/spinner)

    // Ensure total and shipping are valid numbers before attempting to call toFixed
    if (isNaN(total) || isNaN(shipping)) {
        total = 0;
        shipping = 0;
    }

    // Simulate a delay (e.g., if calculation is async, like fetching data)
    setTimeout(() => {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
        let payable;

        if (paymentMethod === 'COD') {
            payable = shipping; // Only shipping for COD
        } else {
            payable = total; // Total for other payment methods
        }

        // Update payable amount
        payableElement.textContent = `৳ ${payable.toFixed(2)}`;
        payableElement.classList.remove('loading'); // Remove the loading class once done
    }, 500); // Optional: Add a small delay for a smoother transition (500ms)
}


// Event listeners for dynamic updates
document.getElementById('recipient_zone').addEventListener('change', calculateShippingPrice);
document.querySelectorAll('input[name="payment_method"]').forEach(el =>
    el.addEventListener('click', () => {
        const total = parseFloat(document.getElementById('total').textContent.replace('৳ ', ''));
        const shipping = parseFloat(document.getElementById('hidden_shipping_charge').value);
        updatePayable(total, shipping);
    })
);

// Initial calculation on page load
document.addEventListener("DOMContentLoaded", () => calculateShippingPrice());

</script>
@endsection