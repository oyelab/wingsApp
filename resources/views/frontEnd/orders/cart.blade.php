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
                                <input type="number" name="cart[{{ $key }}][quantity]" 
                                    value="{{ $cartItem['quantity'] }}" 
                                    min="1" 
                                    class="form-control quantity-input">
                            </td>
                            <td>Tk {{ number_format($cartItem['unitPrice'], 2) }}</td>
                            <td class="total-price">Tk {{ number_format($cartItem['totalPrice'], 2) }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $key) }}" class="btn btn-danger">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right"><strong>Grand Total:</strong></td>
                        <td colspan="2" id="grand-total">Tk {{ number_format($grandTotal, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Update Cart</button>
        </form>

        <a href="{{ route('checkout') }}" class="btn btn-success mt-3">Proceed to Checkout</a>

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
                const quantity = parseInt(input.value);
                const totalPrice = unitPrice * quantity;

                // Update the total price in the table for the specific row
                row.querySelector('.total-price').textContent = `Tk ${totalPrice.toFixed(2)}`;

                // Update grand total
                grandTotal += totalPrice;
            });

            // Update grand total in the table
            grandTotalElement.textContent = `Tk ${grandTotal.toFixed(2)}`;
        }

        // Attach change event to each quantity input
        quantityInputs.forEach(input => {
            input.addEventListener('change', updateTotalPrice);
        });

        // Initial calculation of total price
        updateTotalPrice();
    });
</script>
@endsection
