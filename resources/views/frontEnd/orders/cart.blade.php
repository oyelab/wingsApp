<h2>Your Cart</h2>

@if(session('cart') && count(session('cart')) > 0)
    <table>
        <thead>
            <tr>
                <th>Product Title</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach(session('cart') as $id => $details)
                <tr>
                    <td>{{ $details['title'] }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>${{ $details['price'] }}</td>
                    <td>${{ $details['price'] * $details['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('checkout.store') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
@else
    <p>Your cart is empty!</p>
@endif
