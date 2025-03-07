@extends('frontEnd.layouts.app')

@section('pageTitle', $product->title . ' | ')
@section('pageDescription', $product->meta_desc)
@section('pageKeywords', $product->keywordsString)
@section('pageOgImage', $product->ogImagePath) <!-- Image specific to this page -->

@section('content')
<!-- breadcrumb section -->
<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb-content">
					<x-breadcrub
						:section="$section"
						:collection="$collection"
						:pagetitle="$product->slug" />
				</div>
			</div>
		</div>
	</div>
</div>
<div class="product-details-top-block">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="product-image">
					<div class="product-thumb-slider">
						<div class="custom-navigation">
							<div class="prev-slider main-p-prev">
								<i class="bi bi-chevron-up"></i>
							</div>
						</div>
						<div class="swiper productGalleryThumb">
							<div class="swiper-wrapper">
								@foreach($product->imagePaths as $index => $imagePath)
								<div class="swiper-slide">
									<div class="thumb-image">
										<img
											src="{{ $imagePath }}"
											draggable="false"
											class="img-fluid"
											alt="{{ $product->title . '-' .  $index + 1 }}"
											oncontextmenu="return false;" />
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<div class="custom-navigation">
							<div class="next-slider main-p-next">
								<i class="bi bi-chevron-down"></i>
							</div>
						</div>
					</div>
					<div class="product-main-slider">
						<div class="swiper productMainImage">
							<div class="swiper-wrapper">
								@foreach($product->imagePaths as $index => $imagePath)
								<div class="swiper-slide">
									<div class="product-slider-img">
										<img
											src="{{ $imagePath }}"
											draggable="false"
											class="img-fluid"
											alt="{{ $product->title . '-' .  $index + 1 }}"
											oncontextmenu="return false;" />
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<div class="navigation-area">
							<div class="navigation-item main-p-prev d-flex align-items-center justify-content-center">
								<i class="bi bi-chevron-left"></i>
							</div>
							<div class="navigation-item main-p-next d-flex align-items-center justify-content-center">
								<i class="bi bi-chevron-right"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="product-top-block-details">
					<div class="d-flex justify-content-between review-with-category">
						<!-- Left: Category and Subcategory -->
						<h4 class="mb-0 category-subcategory">
							<span>{{ $product->subcategory->category->title }} > {{ $product->subcategory->title }}</span>
						</h4>

						<!-- Right: Rating -->
						<div class="rating d-flex align-items-center review">
							@for ($i = 0; $i < 5; $i++)
								@if ($i < floor($product->averageRating))
								<i class="bi bi-star-fill text-warning"></i> <!-- Filled star -->
								@elseif ($i == floor($product->averageRating) && $product->averageRating - floor($product->averageRating) >= 0.5)
								<i class="bi bi-star-half text-warning"></i> <!-- Half-filled star -->
								@else
								<i class="bi bi-star text-warning"></i> <!-- Empty star -->
								@endif
								@endfor
								<strong class="ms-2">({{ $product->reviews->count() }} {{ $product->reviews->count() === 1 ? 'Review' : 'Reviews' }})</strong>
						</div>
					</div>

					<h1>
						<span>{!! nl2br(e($product->title)) !!}</span>
						<p class="card-text">
							<span class="badge {{ $product->isAvailable() ? 'bg-success' : 'bg-danger' }}">
								{{ $product->isAvailable() ? 'Available' : 'Stock Out' }}
							</span>
						</p>
					</h1>

					<div class="pricing-block">
						@if ($product->sale)
						<div class="discount-price">৳{{ $product->offerPrice }}</div>
						<div class="current-price text-muted text-decoration-line-through">৳{{ $product->price }}</div>
						@else
						<div class="current-price">৳{{ $product->price }}</div>
						@endif

					</div>
					<div class="availabel-size">
						<h2>Select Size</h2>
						<div class="form-group available_sizes" id="sizeSelection">
							@foreach($product->sizes as $size)
							<div class="size_item">
								<input
									type="radio"
									name="size"
									id="size{{ $size->id }}"
									autocomplete="off"
									value="{{ $size->id }}"
									class="bg-transparent"
									{{ $size->pivot->quantity <= 0 ? 'disabled' : '' }} />
								<label for="size{{ $size->id }}"
									class="form-check-label {{ $size->pivot->quantity <= 0 ? 'text-muted' : '' }}">
									{{ $size->name }}
								</label>
							</div>
							@endforeach
						</div>
						<p id="sizeError" class="error-message" style="display: none; color: red; ">
							Please select a size.
						</p>
					</div>

					<div class="action-button-wrap">
						<button id="addToCartBtn" class="add-to-cart" data-product-id="{{ $product->id }}">
							Add to Cart
						</button>
						<button id="checkoutBtn" class="buy-now">
							Checkout
						</button>
						<button class="favorite {{ session('wishlist') && in_array($product->id, session('wishlist')) ? 'selected' : '' }}"
							data-product-id="{{ $product->id }}">
							Favorite
						</button>

					</div>
					<x-size-guide />
					<div class="social-share-wrap">


						<div class="social-share-icon">
							<h2 class="mb-1">Share:</h2>
							<!-- Facebook Share -->
							<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" title="Share on Facebook">
								<i class="bi bi-facebook fs-4"></i>
							</a>

							<!-- Twitter Share -->
							<a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode('Check this out!') }}" target="_blank" title="Share on Twitter">
								<i class="bi bi-twitter fs-4"></i>
							</a>

							<!-- LinkedIn Share -->
							<a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" title="Share on LinkedIn">
								<i class="bi bi-linkedin fs-4"></i>
							</a>

							<!-- Messenger Share -->
							<a href="https://www.facebook.com/dialog/send?link={{ urlencode(request()->fullUrl()) }}&app_id=YOUR_APP_ID" target="_blank" title="Share on Messenger">
								<i class="bi bi-messenger fs-4"></i>
							</a>

							<!-- WhatsApp Share -->
							<a href="https://api.whatsapp.com/send?text={{ urlencode(request()->fullUrl()) }}" target="_blank" title="Share on WhatsApp">
								<i class="bi bi-whatsapp fs-4"></i>
							</a>

							<!-- Copy Link (with JavaScript functionality) -->
							<button id="clipboardButton" onclick="copyLink()" title="Copy Link" style="border: none; background: none; cursor: pointer;">
								<i id="clipboardIcon" class="bi bi-copy fs-4"></i>
							</button>
						</div>


					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="product-details-area">
					<div class="accordion" id="descriptionAccordion">
						<div class="accordion-item">
							<h2
								class="accordion-header"
								id="descriptionHeading">
								<button
									class="accordion-button"
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#descriptioncollapse"
									aria-expanded="true"
									aria-controls="descriptioncollapse">
									Description
									<i class="bi bi-chevron-down"></i>
								</button>
							</h2>
							<div
								id="descriptioncollapse"
								class="accordion-collapse collapse show"
								aria-labelledby="descriptionHeading"
								data-bs-parent="#descriptionAccordion">
								<div class="accordion-body">
									<div class="product-description">
										{!! $product->description !!}
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion" id="productDetailsAccordion">
						<div class="accordion-item">
							<h2
								class="accordion-header"
								id="productDetailsHeading">
								<button
									class="accordion-button"
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#productDetailsCollapse"
									aria-expanded="true"
									aria-controls="productDetailsCollapse">
									Product Details
									<i class="bi bi-chevron-down"></i>
								</button>
							</h2>
							<div
								id="productDetailsCollapse"
								class="accordion-collapse collapse show"
								aria-labelledby="productDetailsHeading"
								data-bs-parent="#productDetailsAccordion">
								<div class="accordion-body">
									<div class="product-description">
										<ul>
											@foreach($product->specifications() as $spec)
											<li>✔ {{ $spec->item }}</li> <!-- Adjust to the appropriate field of the Specification model -->
											@endforeach
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion" id="reviewAccordion">
						<div class="accordion-item">
							<h2
								class="accordion-header"
								id="reviewHeading">
								<button
									class="accordion-button"
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#reviewCollapse"
									aria-expanded="true"
									aria-controls="reviewCollapse">
									Review ({{ $product->reviewsCount }})
									<i class="bi bi-chevron-down"></i>
								</button>
							</h2>
							<div
								id="reviewCollapse"
								class="accordion-collapse collapse show"
								aria-labelledby="reviewHeading"
								data-bs-parent="#reviewAccordion">
								<div class="accordion-body">
									<div class="product-description">
										<div class="review-analysis">
											<h2>{{ number_format($product->averageRating, 1) }}</h2>

											<div class="rating">
												@for ($i = 0; $i < 5; $i++)
													@if ($i < floor($product->averageRating))
													<i class="bi bi-star-fill text-warning"></i> <!-- Filled star -->
													@elseif ($i == floor($product->averageRating) && $product->averageRating - floor($product->averageRating) >= 0.5)
													<i class="bi bi-star-half text-warning"></i> <!-- Half-filled star -->
													@else
													<i class="bi bi-star text-warning"></i> <!-- Empty star -->
													@endif
													@endfor
											</div>
										</div>

										<div class="review-lists">
											@foreach ($product->reviews as $review)
											<div class="list d-flex">
												<div class="user-wrap">
													<div class="starts d-flex align-items-center">
														{{-- Display the filled stars --}}
														@for ($i = 0; $i < $review->ratingStars['filled']; $i++)
															<i class="bi bi-star-fill text-warning"></i>
															@endfor

															{{-- Display the empty stars --}}
															@for ($i = 0; $i < $review->ratingStars['empty']; $i++)
																<i class="bi bi-star text-warning"></i>
																@endfor

													</div>
													<h3>
														{{ $review->user->name ?? $review->username }}
													</h3>
												</div>
												<div class="review-details">
													<div class="review-details-top d-flex align-items-center justify-content-between">

														<p>{{ $review->created_at->format('d F, Y') }}</p>
													</div>
													<p>{{ $review->content }}</p>
												</div>
											</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@include('frontEnd.components.related')
@endsection

@section('scripts')
<script>
	function copyLink() {
		// Get the current page URL
		const url = window.location.href;

		// Create a temporary input element to copy the URL to the clipboard
		const tempInput = document.createElement("input");
		tempInput.value = url;
		document.body.appendChild(tempInput);
		tempInput.select();
		document.execCommand("copy");
		document.body.removeChild(tempInput);

		// Change the icon and show the "Copied!" text
		const clipboardButton = document.getElementById("clipboardButton");
		const clipboardIcon = document.getElementById("clipboardIcon");
		clipboardIcon.className = "bi bi-check-lg fs-5"; // Change to tick mark icon
		clipboardButton.innerHTML += " <span style='font-size: 1rem;'>Copied!</span>";

		// Revert back to the original icon after a delay
		setTimeout(() => {
			clipboardIcon.className = "bi bi-copy fs-4"; // Change back to clipboard icon
			clipboardButton.innerHTML = ''; // Clear the "Copied!" text
			clipboardButton.appendChild(clipboardIcon); // Re-attach the icon
		}, 1500); // 1.5 seconds delay
	}
</script>

<script>
	// Function to add product to cart
	function addToCart(productId, sizeId, quantityToAdd) {
		return fetch("{{ route('cart.add') }}", {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
			body: JSON.stringify({
				product_id: productId,
				size_id: sizeId,
				quantity: quantityToAdd
			})
		});
	}

	// Function to update the cart count in the UI from session data
	function updateCartCount() {
		const cart = @json(session('cart', [])); // Access cart data from the session in PHP

		let totalQuantity = 0;
		cart.forEach(item => {
			totalQuantity += item.quantity; // Sum up the quantities of each item
		});

		const cartCountBadge = document.getElementById('cart-count-badge');
		if (totalQuantity > 0) {
			cartCountBadge.textContent = totalQuantity;
			cartCountBadge.style.display = 'inline-block';
		} else {
			cartCountBadge.style.display = 'none';
		}
	}

	// Function to handle size selection and quantity addition
	document.getElementById('addToCartBtn').addEventListener('click', function() {
		const productId = this.getAttribute('data-product-id');
		const sizeId = document.querySelector('input[name="size"]:checked')?.value;
		const quantityToAdd = 1; // Default quantity is 1. Adjust as needed.

		if (!sizeId) {
			handleSizeError(true);
			return;
		}

		handleSizeError(false);

		// AJAX request to add the item to the cart
		addToCart(productId, sizeId, quantityToAdd)
			.then(response => response.json())
			.then(data => {
				showToast(data.message); // Display the success message in the toast
				updateCartCount(); // Update the cart count after adding the product
			})
			.catch(error => console.error('Error:', error));
	});

	// Function to handle checkout
	document.getElementById('checkoutBtn').addEventListener('click', function() {
		const productId = document.getElementById('addToCartBtn').getAttribute('data-product-id');
		const sizeId = document.querySelector('input[name="size"]:checked')?.value;
		const quantityToAdd = 1; // Default quantity is 1.

		if (!sizeId) {
			handleSizeError(true);
			return;
		}

		handleSizeError(false);

		// Add product to cart before redirecting
		addToCart(productId, sizeId, quantityToAdd)
			.then(response => response.json())
			.then(data => {
				showToast(data.message); // Display the success message in the toast
				// Redirect to the checkout page after showing the toast
				setTimeout(() => {
					window.location.href = "{{ route('checkout.show') }}";
				}, 3000); // Wait for the toast to auto-hide before redirecting
			})
			.catch(error => console.error('Error:', error));
	});

	// Function to handle size error
	function handleSizeError(showError) {
		const sizeSelectionDiv = document.getElementById('sizeSelection');
		const errorMessage = document.getElementById('sizeError');
		if (showError) {
			sizeSelectionDiv.classList.add('error');
			errorMessage.style.display = 'block';
		} else {
			sizeSelectionDiv.classList.remove('error');
			errorMessage.style.display = 'none';
		}
	}

	// Function to show toast
	function showToast(message) {
		const toastContainer = document.querySelector('.toast-container');
		const toastElement = document.getElementById('wishlist-toast');
		const toastBody = toastElement.querySelector('.toast-body');

		toastBody.textContent = message;

		// Show the toast using Bootstrap's toast API
		const toast = new bootstrap.Toast(toastElement);
		toast.show();
	}
</script>

@endsection