@extends('frontEnd.layouts.app')
@section('css')
<style>
    /* Style to make the label look clickable */
    .clickable {
        color: #007bff; /* Blue color to indicate it's clickable */
        cursor: pointer; /* Pointer cursor when hovering over the label */
        text-decoration: underline; /* Underline to make it look like a link */
    }

    /* Change color on hover */
    .clickable:hover {
        color: #0056b3; /* Darker blue when hovering */
    }
</style>

@endsection
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
		
		@if(session('message'))
			<div class="alert alert-info">
				{{ session('message') }}
			</div>
		@endif

        <div class="row">
            <div class="col-md-6">
				<div class="mb-3">
					<label for="name" class="form-label">Name</label>
					<input type="text" class="form-control" name="name" value="{{ old('name') }}" !required>
				</div>
				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input type="email" class="form-control" name="email" value="{{ old('email') }}" !required>
				</div>
				<div class="mb-3">
					<label for="phone" class="form-label">Phone</label>
					<input type="text" class="form-control" name="phone" value="{{ old('phone') }}" !required>
				</div>
				<div class="mb-3">
					<label for="address" class="form-label">Address</label>
					<input type="text" class="form-control" name="address" value="{{ old('address') }}" !equired>
				</div>
				<div class="row">
					<div class="col mb-3">
						<label for="recipient_city" class="form-label">City</label>
						<select class="form-control" id="recipient_city" name="recipient_city" !required onchange="fetchZones()">
							<option value="">Select City</option>
						</select>
					</div>
					<div class="col mb-3">
						<label for="recipient_zone" class="form-label">Zone</label>
						<select class="form-select" id="recipient_zone" name="recipient_zone" !required onchange="fetchAreas()">
							<option value="">Select Zone</option>
						</select>
					</div>
					<div class="col mb-3">
						<label for="recipient_area" class="form-label">Area</label>
						<select class="form-select" id="recipient_area" name="recipient_area" !required>
							<option value="">Select Area</option>
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
						<input type="radio" id="cod" name="payment_method" value="COD" required onclick="updatePayable()"
							{{ old('payment_method') == 'COD' ? 'checked' : '' }}>
						<label for="cod">Cash on Delivery</label>
					</div>
					<div class="mb-3">
						<input type="radio" id="online" name="payment_method" value="Full Payment" required onclick="updatePayable()"
							{{ old('payment_method') == 'Full Payment' ? 'checked' : '' }}>
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
							<th class="">Product</th>
							<th class="text-end">Size</th>
							<th class="text-end">Quantity</th>
							<th class="col-2 text-end">Price</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cartItems as $item)
							<tr>
								<td>{{ $item['title'] }}</td>
								<td class="text-end">{{ $item['size_name'] }}</td>
								<td class="text-end">{{ $item['quantity'] }}</td>
								<td class="text-end">
									@if($item['offerPrice'] < $item['price'])
										<span class="text-decoration-line-through text-muted">৳ {{ number_format($item['price'], 2) }}</span>
										<br>
										<span>৳ {{ number_format($item['offerPrice'], 2) }}</span>
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
									<strong>(-)Discount</strong>
								</td>
								<td class="text-end">
									<strong id="discount"></strong>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="text-end">
									<strong>(-)Voucher</strong>
								</td>
								<td class="text-end">
									<strong id="voucher"></strong>
									<input type="hidden" id="voucherInput" name="voucher">
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



<script>
    const oldCity = "{{ old('recipient_city') }}";
    const oldZone = "{{ old('recipient_zone') }}";
    const oldArea = "{{ old('recipient_area') }}";
</script>

<!-- Add this script to handle the payment selection -->
<script>
    // Fetch and set cities with old selection, if available
    async function fetchCities() {
        const citySelect = document.getElementById("recipient_city");

        try {
            const response = await fetch('/cities');
            const result = await response.json();

            if (Array.isArray(result.data)) {
                result.data.forEach(city => {
                    const selected = city.city_id == oldCity ? 'selected' : '';
                    citySelect.innerHTML += `<option value="${city.city_id}" ${selected}>${city.city_name}</option>`;
                });

                // Fetch zones if an old city is set
                if (oldCity) fetchZones();
            }
        } catch (error) {
            console.error('Error fetching cities:', error);
        }
    }

    // Fetch and set zones with old selection, if available
    async function fetchZones() {
        const cityId = document.getElementById("recipient_city").value;
        const zoneSelect = document.getElementById("recipient_zone");
        const areaSelect = document.getElementById("recipient_area");

        zoneSelect.innerHTML = '<option value="">Select Zone</option>';
        areaSelect.innerHTML = '<option value="">Select Area</option>';

        if (!cityId) return;

        try {
            const response = await fetch(`/zones/${cityId}`);
            const data = await response.json();

            if (data && data.data) {
                data.data.forEach(zone => {
                    const selected = zone.zone_id == oldZone ? 'selected' : '';
                    zoneSelect.innerHTML += `<option value="${zone.zone_id}" ${selected}>${zone.zone_name}</option>`;
                });

                // Fetch areas if an old zone is set
                if (oldZone) fetchAreas();
            }
        } catch (error) {
            console.error('Error fetching zones:', error);
        }
    }

    // Fetch and set areas with old selection, if available
    async function fetchAreas() {
        const zoneId = document.getElementById("recipient_zone").value;
        const areaSelect = document.getElementById("recipient_area");

        areaSelect.innerHTML = '<option value="">Select Area</option>';

        if (!zoneId) return;

        try {
            const response = await fetch(`/areas/${zoneId}`);
            const data = await response.json();

            if (data && data.data) {
                data.data.forEach(area => {
                    const selected = area.area_id == oldArea ? 'selected' : '';
                    areaSelect.innerHTML += `<option value="${area.area_id}" ${selected}>${area.area_name}</option>`;
                });
            }
        } catch (error) {
            console.error('Error fetching areas:', error);
        }
    }

    // Call fetchCities when the page loads
    window.onload = fetchCities;
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
            const defaultShipping = 45;
            document.getElementById('shipping').textContent = `৳ ${defaultShipping.toFixed(2)}`;
            document.getElementById('hidden_shipping_charge').value = defaultShipping.toFixed(2);
            calculateCartSummary(defaultShipping);
        }
    }

	function calculateCartSummary(shipping) {
		let subtotal = 0;
		let discount = 0;
		const cartItems = @json($cartItems);
		const voucherDiscountPercentage = @json($voucherDiscount);
		let voucherDiscountAmount = 0;

		// Calculate subtotal and discount
		cartItems.forEach(item => {
			const quantity = item.quantity;
			const offerPrice = item.offerPrice ? item.offerPrice : item.price;
			const price = item.price;

			subtotal += price * quantity;
			discount += (price - offerPrice) * quantity;
		});

		// Calculate the total before applying the voucher
		const totalBeforeVoucher = subtotal - discount;

		// Calculate the voucher discount amount and format to two decimal places
		voucherDiscountAmount = (totalBeforeVoucher * voucherDiscountPercentage) / 100;
		voucherDiscountAmount = parseFloat(voucherDiscountAmount.toFixed(2));

		// Calculate the final total with the voucher discount applied
		const total = totalBeforeVoucher - voucherDiscountAmount + shipping;

		// Update the DOM elements with the calculated values
		document.getElementById('subtotal').textContent = `৳ ${subtotal.toFixed(2)}`;

		const discountElement = document.getElementById('discount');
		const discountRow = discountElement.closest('tr');
		if (discount > 0) {
			discountElement.textContent = `৳ ${discount.toFixed(2)}`;
			discountRow.style.display = ''; // Show the row if discount is present
		} else {
			discountElement.textContent = 'N/A';
			discountRow.style.display = 'none'; // Hide the row if no discount
		}

		const voucherElement = document.getElementById('voucher');
		const voucherInput = document.getElementById('voucherInput'); // Ensure your hidden input has an ID
		const voucherRow = voucherElement.closest('tr');
		if (voucherDiscountAmount > 0) {
			voucherElement.textContent = `৳ ${voucherDiscountAmount.toFixed(2)}`; // Ensure two decimal places
			voucherInput.value = voucherDiscountAmount; // Update hidden input value
			voucherRow.style.display = ''; // Show the row if voucher discount is present
		} else {
			voucherElement.textContent = 'N/A';
			voucherInput.value = ''; // Clear hidden input value
			voucherRow.style.display = 'none'; // Hide the row if no voucher discount
		}

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