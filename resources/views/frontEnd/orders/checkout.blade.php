@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h1 class="text-center">Checkout</h1>

    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label>Delivery Type</label><br>
            <label>
                <input type="radio" name="delivery_type" value="inside" checked> Inside Dhaka
            </label><br>
            <label>
                <input type="radio" name="delivery_type" value="outside"> Outside Dhaka
            </label>
        </div>

        <h4 class="text-center">Cart Summary</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product['title'] }}</td>
                    <td>{{ $product['size'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>Tk {{ number_format($product['price'], 2) }}</td>
                    <td>Tk {{ number_format($product['price'] * $product['quantity'], 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right"><strong>Grand Total:</strong></td>
                    <td colspan="2" id="grand-total">Tk {{ number_format($grandTotal, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Delivery Fee:</strong></td>
                    <td colspan="2" id="delivery-fee">Tk 0.00</td> <!-- Delivery fee placeholder -->
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total Amount:</strong></td>
                    <td colspan="2" id="total-amount">Tk {{ number_format($grandTotal, 2) }}</td> <!-- Total amount placeholder -->
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-primary" onclick="window.location='{{ route('cart.view') }}'">Edit Cart</button>

        <h3 class="text-center mt-4">Payment Options</h3>
        <button type="submit" class="btn btn-success" name="payment_option" value="delivery_fee">Pay Only Delivery Fee</button>
        <button type="submit" class="btn btn-success" name="payment_option" value="full">Pay Full</button>
    </form>
</div>


@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const grandTotalElement = document.getElementById('grand-total');

        // Check if grandTotalElement exists
        if (!grandTotalElement) {
            console.error('Grand total element not found in the DOM.');
            return; // Exit if the element is not found
        }

        const deliveryTypeButtons = document.querySelectorAll('input[name="delivery_type"]');
        const deliveryFeeElement = document.getElementById('delivery-fee');
        const totalAmountElement = document.getElementById('total-amount');

        // Check if deliveryFeeElement exists
        if (!deliveryFeeElement) {
            console.error('Delivery fee element not found in the DOM.');
            return; // Exit if the element is not found
        }

        const baseDeliveryFee = {
            inside: 0, // Set the delivery fee for Inside Dhaka
            outside: 100 // Set the delivery fee for Outside Dhaka
        };

        function calculateTotalAmount() {
            const grandTotal = parseFloat(grandTotalElement.textContent.replace('Tk', '').replace(',', '')) || 0;
            const selectedDeliveryType = document.querySelector('input[name="delivery_type"]:checked');
            
            // Ensure the delivery type is selected
            if (!selectedDeliveryType) {
                console.error('No delivery type selected.');
                return;
            }

            const deliveryFee = baseDeliveryFee[selectedDeliveryType.value];
            deliveryFeeElement.textContent = `Tk ${deliveryFee.toFixed(2)}`;
            totalAmountElement.textContent = `Tk ${(grandTotal + deliveryFee).toFixed(2)}`;
        }

        // Attach change event to delivery type buttons
        deliveryTypeButtons.forEach(button => {
            button.addEventListener('change', calculateTotalAmount);
        });

        // Initial calculation of total amount
        calculateTotalAmount();
    });
</script>


@endsection