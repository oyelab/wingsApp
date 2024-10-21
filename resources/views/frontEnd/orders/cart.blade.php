<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Your Shopping Cart</h2>

    @if(empty($cart))
        <p>Your cart is empty. Please add items to your cart.</p>
    @else
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            <table class="table">
				<thead>
					<tr>
						<th>Product</th>
						<th>Size</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cart as $item)
						<tr>
							<td>{{ htmlspecialchars($item['product_title']) }}</td>
							<td>{{ htmlspecialchars($item['size_name']) }}</td>
							<td>{{ number_format($item['price'], 2) }} USD</td>
							<td>
								<input type="number" name="quantities[{{ $itemId }}]" value="{{ $item['quantity'] }}" min="0" class="form-control" style="width: 70px;">
							</td>
							<td>{{ number_format($item['total'], 2) }} USD</td>
							<td>
								<a href="{{ route('cart.remove', $itemId) }}" class="btn btn-danger btn-sm">Remove</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

            <div class="d-flex justify-content-between align-items-center">
               
                <button type="submit" class="btn btn-primary">Update Cart</button>
            </div>
        </form>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
