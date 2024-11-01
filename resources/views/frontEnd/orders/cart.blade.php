@extends('frontEnd.layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Shopping Cart</h2>

    <div class="row">
        <!-- Cart Items -->
        <div class="table-responsive col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
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
						<tr>
							<td>{{ $item['title'] }}</td>
							<td>{{ $item['size_name'] }}</td>
							<td>{{ $item['categories'] }}</td>
							
							<!-- Price Column: Show both regular and sale price if discounted -->
							<td class="col-2">
								@if(isset($item['sale']))
									<span class="text-decoration-line-through text-muted">৳ {{ $item['price'] }}</span>

									<span>৳ {{ $item['salePrice'] }}</span>
								@else
									<span>৳ {{ $item['price'] }}</span>
								@endif
							</td>
							
							<!-- Quantity with Buttons -->
							<td class="col-2">
								<button onclick="updateQuantity({{ $index }}, -1)" class="btn btn-secondary btn-sm">-</button>
								<span class="mx-2">{{ $item['quantity'] }}</span>
								<button onclick="updateQuantity({{ $index }}, 1)" class="btn btn-secondary btn-sm">+</button>
							</td>

							<!-- Total Column: Show both regular and sale total if discounted -->
							<td class="col-2">
								@if($item['salePrice'] < $item['price'])
									<span class="text-decoration-line-through text-muted">৳ {{ number_format($regularPriceTotal, 2) }}</span>
									<br>
									<span>৳ {{ number_format(floor($discountedPriceTotal ), 2, '.') }}</span>
								@else
									৳ {{ number_format($regularPriceTotal, 2) }}
								@endif
							</td>

							<!-- Actions -->
							<td>
								<button onclick="removeFromCart({{ $index }})" class="btn btn-danger btn-sm">Remove</button>
							</td>
						</tr>
					@endforeach
				</tbody>

            </table>
        </div>

        <!-- Summary Section -->
        <div class="col-md-4">
            <h4>Summary</h4>
            <p>Subtotal: ৳ {{ number_format($subtotal, 2) }}</p>
            <p>Discount: {{ $totalDiscount ? '৳ ' . number_format($totalDiscount, 2) : 'N/A' }}</p>
            <p class="fw-bold">Total (without shipping): ৳ {{ number_format($subtotal - $totalDiscount, 2) }}</p>
            
			<!-- Button to Proceed to Checkout -->
    		<a href="{{ route('checkout.show') }}" class="btn btn-primary w-100 mt-4">Proceed to Checkout</a>
        </div>
    </div>
</div>

<script>
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
                location.reload(); // Reload the page to update cart
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
                location.reload(); // Reload the page to update cart
            }
        });
    }
</script>
@endsection