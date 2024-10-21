@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h1 class="text-center">Your Cart</h1>

    @if($cartItems->isNotEmpty())
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            <table class="table table-bordered">
				<thead>
					<tr>
						<th>Product</th>
						<th>Size</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Total Price</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cartItems as $key => $cartItem)
						<tr>
							<td>{{ $cartItem['product']->title }}</td>
							<td>{{ $cartItem['size']->name }}</td>
							<td>
								<input type="hidden" name="cart[{{ $key }}][product_id]" value="{{ $cartItem['product']->id }}">
								<input type="hidden" name="cart[{{ $key }}][size_id]" value="{{ $cartItem['size']->id }}">
								<input type="hidden" name="cart[{{ $key }}][size]" value="{{ $cartItem['size']->name }}">
								<input type="number" name="cart[{{ $key }}][quantity]" 
									value="{{ $cartItem['quantity'] }}" 
									min="1" 
									max="{{ $cartItem['availableQuantity'] }}" 
									class="form-control quantity-input" 
									data-available-quantity="{{ $cartItem['availableQuantity'] }}" 
									required>
							</td>
							<td>Tk {{ number_format($cartItem['unitPrice'], 2) }}</td>
							<td class="total-price">Tk {{ number_format($cartItem['totalPrice'], 2) }}</td>
							<td>
								<a href="{{ route('cart.remove', $key) }}" class="btn btn-danger">Remove</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>


            <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
        </form>

    @else
        <p class="text-center">Your cart is empty.</p>
    @endif
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const grandTotalElement = document.getElementById('grand-total');

        function updateTotalPrice() {
            let grandTotal = 0;
            quantityInputs.forEach(input => {
                const row = input.closest('tr');
                const unitPrice = parseFloat(row.querySelector('td:nth-child(4)').textContent.replace('Tk', '').trim());
                const quantity = parseInt(input.value) || 0; // Default to 0 if not a number
                const totalPrice = unitPrice * quantity;

                // Update the total price in the table for the specific row
                row.querySelector('.total-price').textContent = `Tk ${totalPrice.toFixed(2)}`;

                // Update grand total
                grandTotal += totalPrice;
            });

            // Check if grandTotalElement exists before setting textContent
            if (grandTotalElement) {
                grandTotalElement.textContent = `Tk ${grandTotal.toFixed(2)}`;
            }
        }

        // Attach change event to each quantity input
        quantityInputs.forEach(input => {
            const availableQuantity = parseInt(input.dataset.availableQuantity);
            input.setAttribute('max', availableQuantity); // Set max attribute based on available quantity

            input.addEventListener('input', function () {
                let quantity = parseInt(this.value);

                // Validate quantity input
                if (quantity < 1) {
                    this.value = 1; // Minimum quantity should be 1
                    alert(`Quantity cannot be less than 1.`);
                } else if (quantity > availableQuantity) {
                    this.value = availableQuantity; // Cannot exceed available quantity
                    alert(`You can only select up to ${availableQuantity} for this size.`);
                } else if (quantity > 10) {
                    this.value = 10; // Cannot exceed max limit of 10
                    alert(`You can only select up to 10 for this item.`);
                }

                updateTotalPrice();
            });
        });

        // Initial calculation of total price
        updateTotalPrice();
    });
</script>
@endsection
