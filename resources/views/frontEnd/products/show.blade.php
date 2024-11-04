@extends('frontEnd.layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container my-5">
    <div class="row">
        <!-- Product Images Carousel -->
		<div class="col-md-6">
			<div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
				<div class="carousel-inner">
					@foreach($product->imagePaths as $index => $imagePath)
						<div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
							<img src="{{ $imagePath }}" class="d-block w-100" alt="Product Image {{ $index + 1 }}">
						</div>
					@endforeach
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>
		</div>


        <!-- Product Details -->
        <div class="col-md-6">
            <!-- Displaying product categories -->
			<p class="text-muted mb-1">Categories: 
				<span class="fw-bold">
					{{ $product->categories->pluck('title')->implode(', ') }}
				</span>
			</p>


            <!-- Title -->
            <h2 class="mb-3">{{ $product->title }}</h2>

            <!-- Price and Offer Price -->
            <div class="mb-3">
				@if ($product->salePrice)
					<span class="text-muted text-decoration-line-through">৳ {{ $product->price }}</span>
					<span class="fw-bold ms-2 text-success">৳ {{ $product->offer_price }}</span>
				@else
					<span class="fw-bold">৳ {{ $product->price }}</span>
				@endif
			</div>


            <!-- Select Sizes -->
			<div class="mb-4">
				<label class="form-label">Select Size:</label>
				<div class="btn-group" role="group" aria-label="Size options">
					@foreach($product->availableSizes as $size)
						<input type="radio" class="btn-check" name="size" id="size{{ $size->id }}" autocomplete="off" value="{{ $size->id }}">
						<label class="btn btn-outline-primary" for="size{{ $size->id }}">{{ $size->name }}</label>
					@endforeach
				</div>
			</div>


<!-- Buttons -->
<div class="d-flex gap-2 mb-4">
    <button id="addToCartBtn" class="btn btn-primary w-50" data-product-id="{{ $product->id }}">Add to Cart</button>
    <button id="checkoutBtn" class="btn btn-success w-50">Checkout</button>
</div>
            <!-- Description -->
            <div>
				<h5>Description</h5>
				<p class="">{!! $product->description !!}</p>
			</div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- Buttons -->
<div class="d-flex gap-2 mb-4">
    <button id="addToCartBtn" class="btn btn-primary w-50" data-product-id="{{ $product->id }}">Add to Cart</button>
    <button id="checkoutBtn" class="btn btn-success w-50">Checkout</button>
</div>

<script>
    // Function to add product to cart
    function addToCart(productId, sizeId) {
        return fetch("{{ route('cart.add') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ product_id: productId, size_id: sizeId })
        });
    }

    document.getElementById('addToCartBtn').addEventListener('click', function () {
        const productId = this.getAttribute('data-product-id');
        const sizeId = document.querySelector('input[name="size"]:checked')?.value;

        if (!sizeId) {
            alert("Please select a size before adding to cart.");
            return;
        }

        // AJAX request to add the item to the cart
        addToCart(productId, sizeId)
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Show success message
            })
            .catch(error => console.error('Error:', error));
    });

    document.getElementById('checkoutBtn').addEventListener('click', function () {
        const productId = document.getElementById('addToCartBtn').getAttribute('data-product-id');
        const sizeId = document.querySelector('input[name="size"]:checked')?.value;

        if (!sizeId) {
            alert("Please select a size before proceeding to checkout.");
            return;
        }

        // Add product to cart before redirecting
        addToCart(productId, sizeId)
            .then(response => response.json())
            .then(data => {
                // Redirect to the checkout page after adding to cart
                window.location.href = "{{ route('checkout.show') }}";
            })
            .catch(error => console.error('Error:', error));
    });
</script>


<!-- Bootstrap 5 JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection
