<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .cart-icon {
            position: fixed;
            top: 20px;
            right: 30px;
            font-size: 1.5rem;
        }

        .cart-icon .badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<!-- Cart Icon with Notification Badge -->
<a href="{{ route('cart.index') }}" class="cart-icon">
    <i class="fas fa-shopping-cart"></i>
    <span class="badge badge-pill" id="cart-badge">{{ session('cart') ? count(session('cart')) : 0 }}</span>
</a>

<div class="container mt-5">
    <h2 class="text-primary">{{ $product->title }}</h2>

    @if($product->sale)
        <h3>
            {{ $product->salePrice }}
            <del class="text-muted">{{ $product->price }}</del>
            <span class="badge bg-danger">{{ $product->sale }}% off</span>
        </h3>
    @else
        <h3>{{ $product->price }}</h3>
    @endif

    <div class="available-sizes mt-3">
        <h5>Select Size:</h5>
        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach($product->availableSizes as $size)
                <label class="btn btn-outline-primary size-label">
                    <input type="radio" name="size" value="{{ $size->id }}" autocomplete="off">
                    {{ $size->name }} ({{ $size->pivot->quantity }})
                </label>
            @endforeach
        </div>
    </div>

    <div class="row text-center mt-4">
        <div class="col-sm-6">
            <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="size" id="selected-size" value="">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary mt-2" id="add-to-cart-btn" disabled>
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                </div>
            </form>
        </div>

        <div class="col-sm-6">
            <div class="d-grid">
                <a href="{{ route('checkout') }}" class="btn btn-success mt-2" id="buy-now-btn">
                    <i class="fas fa-bag-shopping me-2"></i> Buy Now
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    const sizeLabels = document.querySelectorAll('.size-label');
    const addToCartBtn = document.getElementById('add-to-cart-btn');
    const selectedSizeInput = document.getElementById('selected-size');
    const cartBadge = document.getElementById('cart-badge');
    
    // Fetch existing cart items from the session (both product_id and size_id)
    let cartItems = @json(session('cart') ?? []);

    // Enable the Add to Cart button when a size is selected
    sizeLabels.forEach(function(label) {
        label.addEventListener('click', function() {
            const radioInput = this.querySelector('input[type="radio"]');
            const selectedSizeId = radioInput.value; // Get selected size ID
            selectedSizeInput.value = selectedSizeId; // Set the selected size

            addToCartBtn.disabled = false; // Enable the button when a valid size is selected
        });
    });

    // Ensure the form doesn't submit without selecting a size
    document.getElementById('add-to-cart-form').addEventListener('submit', function(event) {
        if (!selectedSizeInput.value) {
            event.preventDefault(); // Prevent form submission if no size is selected
            alert('Please select a size before adding to the cart.');
        } else {
            // Check if the selected size for this product is already in the cart
            const productId = {{ $product->id }};
            const selectedSizeId = selectedSizeInput.value;

            if (cartItems.some(item => item.product_id == productId && item.size_id == selectedSizeId)) {
                event.preventDefault(); // Prevent adding the same size for the same product
                alert('This size is already in the cart. Please select a different size.');
            }
        }
    });
</script>

<!-- Include Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
