@extends('frontEnd.layouts.app')
@section('content')
<div class="container my-5">
    <h2 class="mb-4">Checkout</h2>

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
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" !required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" !required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" !required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" !required>
                </div>
				<div class="row">
					<div class="col mb-3">
						<label for="recipient_city" class="form-label">City</label>
						<select class="form-control" id="recipient_city" name="recipient_city" !required onchange="fetchZones()">
							<option value="">Select City</option>
							<!-- Add your city options here -->
						</select>
					</div>
					<div class="col mb-3">
						<label for="recipient_zone" class="form-label">Zone</label>
						<select class="form-select" id="recipient_zone" name="recipient_zone" !required onchange="fetchAreas()">
							<option value="">Select Zone</option>
							<!-- Add your zone options here -->
						</select>
					</div>
					<div class="col mb-3">
						<label for="recipient_area" class="form-label">Area</label>
						<select class="form-select" id="recipient_area" name="recipient_area" !required>
							<option value="">Select Area</option>
							<!-- Add your area options here -->
						</select>
					</div>
				</div>


                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="terms" !required>
                    <label class="form-check-label">Accept Terms & Conditions</label>
                </div>
            </div>

			

			

            <!-- Cart Summary -->
            <div class="col-md-6">
				<!-- Payment Options -->
				<h5>Select Payment Method</h5>
				<div class="d-flex">
					<div class="mb-3 mx-4">
						<input type="radio" id="cod" name="payment_method" value="COD" !required onclick="updatePayable()">
						<label for="cod">Cash on Delivery</label>
					</div>
					<div class="mb-3">
						<input type="radio" id="online" name="payment_method" value="Full Payment" !required onclick="updatePayable()">
						<label for="online">Online Payment</label>
					</div>
				</div>

				<div class="d-flex justify-content-between align-items-center mb-3">
					<h5>Your Cart Items</h5>
					<a href="{{ route('cart.show') }}" class="btn btn-outline-secondary btn-sm">Edit Cart</a>
				</div>

				<table class="table">
					<thead>
						<tr>
							<th>Product</th>
							<th class="text-end">Size</th>
							<th class="text-end">Quantity</th>
							<th class="text-end">Price</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cartItems as $item)
							<tr>
								<td>{{ $item['title'] }}</td>
								<td class="text-end">{{ $item['size_name'] }}</td>
								<td class="text-end">{{ $item['quantity'] }}</td>
								<td class="text-end">
									@if($item['salePrice'] < $item['price'])
										<span class="text-decoration-line-through text-muted">৳ {{ number_format($item['price'], 2) }}</span>
										<br>
										<span>৳ {{ number_format($item['salePrice'], 2) }}</span>
									@else
										৳ {{ number_format($item['price'], 2) }}
									@endif
								</td>
								<!-- Hidden inputs to send data -->
								<input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $item['product_id'] }}"> <!-- Adjust key if necessary -->
								<input type="hidden" name="products[{{ $loop->index }}][size_id]" value="{{ $item['size_id'] }}">
								<input type="hidden" name="products[{{ $loop->index }}][quantity]" value="{{ $item['quantity'] }}">
							</tr>
						@endforeach
							<tr>
								<td colspan="3" class="text-end">
									<strong>Subtotal</strong>
								</td>
								<td class="text-end">
									<strong id="subtotal"></strong>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="text-end">
									<strong>Discount</strong>
								</td>
								<td class="text-end">
									<strong id="discount"></strong>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="text-end">
									<strong>Shipping</strong>
								</td>
								<td class="text-end">
									<strong id="shipping"></strong>
									<!-- Shipping Charge Field -->
									<input type="hidden" id="hidden_shipping_charge" name="shipping_charge" value="0">
								</td>
							</tr>
							<tr>
								<td colspan="3" class="text-end">
									<strong>Total</strong>
								</td>
								<td class="text-end">
									<strong id="total"></strong>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="text-end">
									<strong>Payable</strong>
								</td>
								<td class="text-end">
									<strong id="payable"></strong>
								</td>
							</tr>
					</tbody>
				</table>
				
				
                <button type="submit" class="btn btn-primary w-100">Pay Now</button>
            </div>
        </div>
    </form>
</div>

@endsection
@section('scripts')

<!-- Add this script to handle the payment selection -->
<script>
	async function fetchCities() {
	const citySelect = document.getElementById("recipient_city");

		try {
			const response = await fetch('/cities');
			const result = await response.json();

			// Check if 'data' is an array before looping through it
			if (Array.isArray(result.data)) {
				result.data.forEach(city => {
					citySelect.innerHTML += `<option value="${city.city_id}">${city.city_name}</option>`;
				});
			} else {
				console.error('Data format is unexpected:', result);
			}
		} catch (error) {
			console.error('Error fetching cities:', error);
		}
	}

	// Call fetchCities when the page loads
	window.onload = fetchCities;

	// Fetch zones based on selected city
	async function fetchZones() {
		const cityId = document.getElementById("recipient_city").value;
		const zoneSelect = document.getElementById("recipient_zone");
		const areaSelect = document.getElementById("recipient_area");

		// Reset zone and area dropdowns
		zoneSelect.innerHTML = '<option value="">Select Zone</option>';
		areaSelect.innerHTML = '<option value="">Select Area</option>';

		if (!cityId) return;

		try {
			const response = await fetch(`/zones/${cityId}`);
			const data = await response.json();

			if (data && data.data) {
				data.data.forEach(zone => {
					zoneSelect.innerHTML += `<option value="${zone.zone_id}">${zone.zone_name}</option>`;
				});
			}
		} catch (error) {
			console.error('Error fetching zones:', error);
		}
	}

	// Fetch areas based on selected zone
	async function fetchAreas() {
		const zoneId = document.getElementById("recipient_zone").value;
		const areaSelect = document.getElementById("recipient_area");

		// Reset area dropdown
		areaSelect.innerHTML = '<option value="">Select Area</option>';

		if (!zoneId) return;

		try {
			const response = await fetch(`/areas/${zoneId}`);
			const data = await response.json();

			if (data && data.data) {
				data.data.forEach(area => {
					areaSelect.innerHTML += `<option value="${area.area_id}">${area.area_name}</option>`;
				});
			}
		} catch (error) {
			console.error('Error fetching areas:', error);
		}
	}


</script>

<script>
    // Function to calculate shipping price
    async function calculateShippingPrice() {
        const recipientCity = document.getElementById('recipient_city').value;
        const recipientZone = document.getElementById('recipient_zone').value;

        if (recipientCity && recipientZone) {
            try {
                const response = await fetch('/calculate-shipping', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ recipient_city: recipientCity, recipient_zone: recipientZone })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                const shipping = data.data.final_price || 0;
                document.getElementById('shipping').textContent = `৳ ${shipping.toFixed(2)}`;
                document.getElementById('hidden_shipping_charge').value = shipping.toFixed(2);

                // Calculate totals with the new shipping value
                calculateCartSummary(shipping);

            } catch (error) {
                console.error("Error calculating shipping price:", error);
            }
        } else {
            // If city/zone not selected, set default shipping and recalculate
            const defaultShipping = 120;
            document.getElementById('shipping').textContent = `৳ ${defaultShipping.toFixed(2)}`;
            document.getElementById('hidden_shipping_charge').value = defaultShipping.toFixed(2);
            calculateCartSummary(defaultShipping);
        }
    }

    // Function to calculate subtotal, discount, total, and update payable
    function calculateCartSummary(shipping) {
        let subtotal = 0;
        let discount = 0;
        const cartItems = @json($cartItems);

        cartItems.forEach(item => {
            const quantity = item.quantity;
            const salePrice = item.salePrice;
            const price = item.price;

            subtotal += price * quantity;
            discount += (price - salePrice) * quantity;
        });

        const total = subtotal - discount + shipping;

        document.getElementById('subtotal').textContent = `৳ ${subtotal.toFixed(2)}`;
		document.getElementById('discount').textContent = discount ? `৳ ${discount.toFixed(2)}` : 'N/A';
        document.getElementById('total').textContent = `৳ ${total.toFixed(2)}`;

        // Update payable based on payment method
        updatePayable(total, shipping);
    }

    // Function to update the payable amount based on payment method
    function updatePayable(total, shipping) {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
        let payable;

        if (paymentMethod === 'COD') {
            // Cash on Delivery: Only shipping charge is paid online
            payable = shipping;
        } else {
            // Full Payment: Total amount is paid online
            payable = total;
        }

        document.getElementById('payable').textContent = `৳ ${payable.toFixed(2)}`;
    }

    // Event listeners
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