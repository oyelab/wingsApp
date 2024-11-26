@extends('frontEnd.layouts.app')

@section('pageTitle', $product->title . ' | ')
@section('pageDescription', $product->meta_desc)
@section('pageKeywords', $product->keywordsString)
@section('pageOgImage', $product->ogImagePath)  <!-- Image specific to this page -->

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
						:pagetitle="$product->slug"
					/>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="product-details-top-block">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
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
											alt="Thumb Slider"
										/>
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
											alt=""
										/>
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
			<div class="col-md-6">
				<div class="product-top-block-details">
					<h4>
						
							<span class="badge bg-success-subtle text-success mb-0">{{ $product->category_display }}</span>
						
					</h4>


					<h1>
						<span>{{ $product->title }}</span>
					</h1>
					<h6><strong class="text-warning">★ {{ number_format($product->averageRating, 1) }} Rating ({{ $product->reviews->count() }} Reviews)</strong></h6>

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
						<div class="form-group available_sizes">
							@foreach($product->availableSizes as $size)
							<div class="size_item">
								<input
									type="radio"
									name="size"
									id="size{{ $size->id }}"
									autocomplete="off"
									value="{{ $size->id }}"
								/>
								<label for="size{{ $size->id }}">{{ $size->name }}</label>
							</div>
							@endforeach
						</div>
					</div>
					<div class="action-button-wrap">
						<button id="addToCartBtn" class="add-to-cart" data-product-id="{{ $product->id }}">
							Add to Cart
						</button>
						<button id="checkoutBtn" class="buy-now">
							Checkout
						</button>
						<button class="favorite">
							Favorite
						</button>
					</div>
					<div class="size-guid-area">
						<div class="top-part d-flex align-items-center justify-content-between">
							<h2>Size Guide</h2>
							<ul
								class="nav nav-tabs"
								id="myTab"
								role="tablist"
							>
								<li
									class="nav-item"
									role="presentation"
								>
									<button
										class="nav-link active"
										id="in"
										data-bs-toggle="tab"
										data-bs-target="#in-pane"
										type="button"
										role="tab"
										aria-controls="in-pane"
										aria-selected="true"
									>
										in
									</button>
								</li>
								<li
									class="nav-item"
									role="presentation"
								>
									<button
										class="nav-link"
										id="cm"
										data-bs-toggle="tab"
										data-bs-target="#cm-pane"
										type="button"
										role="tab"
										aria-controls="cm-pane"
										aria-selected="false"
									>
										cm
									</button>
								</li>
							</ul>
						</div>
						<div class="size-chart-wrap">
							<div class="tab-content" id="myTabContent">
								<div
									class="tab-pane fade show active"
									id="in-pane"
									role="tabpanel"
									aria-labelledby="in"
									tabindex="0"
								>
									<table class="size-table">
										<tr>
											<th>SIZE</th>
											<th>CHEST</th>
											<th>LENGTH</th>
										</tr>
										<tr>
											<td>M</td>
											<td>38</td>
											<td>28</td>
										</tr>
										<tr>
											<td>L</td>
											<td>40</td>
											<td>29</td>
										</tr>
										<tr>
											<td>XL</td>
											<td>42</td>
											<td>30</td>
										</tr>
										<tr>
											<td>XXL</td>
											<td>44</td>
											<td>31</td>
										</tr>
									</table>
								</div>
								<div
									class="tab-pane fade"
									id="cm-pane"
									role="tabpanel"
									aria-labelledby="cm"
									tabindex="0"
								>
									<table class="size-table">
										<tr>
											<th>SIZE</th>
											<th>CHEST</th>
											<th>LENGTH</th>
										</tr>
										<tr>
											<td>M</td>
											<td>38</td>
											<td>28</td>
										</tr>
										<tr>
											<td>L</td>
											<td>40</td>
											<td>29</td>
										</tr>
										<tr>
											<td>XL</td>
											<td>42</td>
											<td>30</td>
										</tr>
										<tr>
											<td>XXL</td>
											<td>44</td>
											<td>31</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="social-share-wrap">
						
						<h2>Social Share:</h2>
						
						<div class="social-share-icon">
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
			<div class="col-md-6">
				<div class="product-details-area">
					<div class="accordion" id="descriptionAccordion">
						<div class="accordion-item">
							<h2
								class="accordion-header"
								id="descriptionHeading"
							>
								<button
									class="accordion-button"
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#descriptioncollapse"
									aria-expanded="true"
									aria-controls="descriptioncollapse"
								>
									Description
									<svg
										xmlns="http://www.w3.org/2000/svg"
										viewBox="0 0 24 24"
										fill="rgba(30,30,30,1)"
									>
										<path
											d="M11.9999 10.8284L7.0502 15.7782L5.63599 14.364L11.9999 8L18.3639 14.364L16.9497 15.7782L11.9999 10.8284Z"
										></path>
									</svg>
								</button>
							</h2>
							<div
								id="descriptioncollapse"
								class="accordion-collapse collapse show"
								aria-labelledby="descriptionHeading"
								data-bs-parent="#descriptionAccordion"
							>
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
								id="productDetailsHeading"
							>
								<button
									class="accordion-button"
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#productDetailsCollapse"
									aria-expanded="true"
									aria-controls="productDetailsCollapse"
								>
									Product Details
									<svg
										xmlns="http://www.w3.org/2000/svg"
										viewBox="0 0 24 24"
										fill="rgba(30,30,30,1)"
									>
										<path
											d="M11.9999 10.8284L7.0502 15.7782L5.63599 14.364L11.9999 8L18.3639 14.364L16.9497 15.7782L11.9999 10.8284Z"
										></path>
									</svg>
								</button>
							</h2>
							<div
								id="productDetailsCollapse"
								class="accordion-collapse collapse show"
								aria-labelledby="productDetailsHeading"
								data-bs-parent="#productDetailsAccordion"
							>
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
								id="reviewHeading"
							>
								<button
									class="accordion-button"
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#reviewCollapse"
									aria-expanded="true"
									aria-controls="reviewCollapse"
								>
									Review ({{ $product->reviewsCount }})
									<i class="bi bi-chevron-down"></i>
								</button>
							</h2>
							<div
								id="reviewCollapse"
								class="accordion-collapse collapse show"
								aria-labelledby="reviewHeading"
								data-bs-parent="#reviewAccordion"
							>
								<div class="accordion-body">
									<div class="product-description">
										<div class="review-analysis">
											<h2>{{ number_format($product->averageRating, 1) }}</h2>
											
											<div class="rating">
												@for ($i = 0; $i < 5; $i++)
													@if ($i < floor($product->averageRating))
														<i class="bi bi-star-fill text-warning"></i>  <!-- Filled star -->
													@elseif ($i == floor($product->averageRating) && $product->averageRating - floor($product->averageRating) >= 0.5)
														<i class="bi bi-star-half text-warning"></i>  <!-- Half-filled star -->
													@else
														<i class="bi bi-star text-warning"></i>  <!-- Empty star -->
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
														{{ $review->user->name }}
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

@if ($relatedProducts->isNotEmpty())
<section class="latest-arrivals-area section-buttom-padding">
	<div class="container">
		<div class="row">
			<div
				class="d-flex align-items-center justify-content-between mb-30"
			>
				<div class="section-title">
					<h2>You May Also Like</h2>
				</div>
				<div class="navigation-items d-flex align-items-center">
					<h3>Shop</h3>
					<div
						class="navigation-item tp-prev d-flex align-items-center justify-content-center"
					>
						<svg
							width="9"
							height="15"
							viewBox="0 0 9 15"
							fill="none"
							xmlns="http://www.w3.org/2000/svg"
						>
							<path
								d="M7.28125 15L0 7.5L7.28125 0L8.4375 1.17489L2.28125 7.5L8.4375 13.8251L7.28125 15Z"
								fill="currentColor"
							/>
						</svg>
					</div>
					<div
						class="navigation-item tp-next d-flex align-items-center justify-content-center"
					>
						<svg
							width="9"
							height="15"
							viewBox="0 0 9 15"
							fill="none"
							xmlns="http://www.w3.org/2000/svg"
						>
							<path
								d="M1.15625 15L8.4375 7.5L1.15625 0L0 1.17489L6.15625 7.5L0 13.8251L1.15625 15Z"
								fill="currentColor"
							/>
						</svg>
					</div>
				</div>
			</div>
		</div>
		<div class="swiper top-picks">
			<div class="swiper-wrapper">
				@foreach ($relatedProducts as $product)
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ $product->imagePaths[0] }}"
								class="img-fluid"
								alt="{{ $product->title }}"
								draggable="false"
							/>
							<a href="#" class="wishlist-icon">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="20"
									height="19"
									viewBox="0 0 20 19"
									fill="none"
								>
									<path
										d="M10 19L8.55 17.7C6.86667 16.1833 5.475 14.875 4.375 13.775C3.275 12.675 2.4 11.6917 1.75 10.825C1.1 9.94166 0.641667 9.13333 0.375 8.39999C0.125 7.66666 0 6.91666 0 6.14999C0 4.58333 0.525 3.27499 1.575 2.22499C2.625 1.17499 3.93333 0.649994 5.5 0.649994C6.36667 0.649994 7.19167 0.833327 7.975 1.19999C8.75833 1.56666 9.43333 2.08333 10 2.74999C10.5667 2.08333 11.2417 1.56666 12.025 1.19999C12.8083 0.833327 13.6333 0.649994 14.5 0.649994C16.0667 0.649994 17.375 1.17499 18.425 2.22499C19.475 3.27499 20 4.58333 20 6.14999C20 6.91666 19.8667 7.66666 19.6 8.39999C19.35 9.13333 18.9 9.94166 18.25 10.825C17.6 11.6917 16.725 12.675 15.625 13.775C14.525 14.875 13.1333 16.1833 11.45 17.7L10 19ZM10 16.3C11.6 14.8667 12.9167 13.6417 13.95 12.625C14.9833 11.5917 15.8 10.7 16.4 9.95C17 9.18333 17.4167 8.50833 17.65 7.92499C17.8833 7.325 18 6.73333 18 6.14999C18 5.14999 17.6667 4.31666 17 3.65C16.3333 2.98333 15.5 2.64999 14.5 2.64999C13.7167 2.64999 12.9917 2.87499 12.325 3.32499C11.6583 3.75833 11.2 4.31666 10.95 4.99999H9.05C8.8 4.31666 8.34167 3.75833 7.675 3.32499C7.00833 2.87499 6.28333 2.64999 5.5 2.64999C4.5 2.64999 3.66667 2.98333 3 3.65C2.33333 4.31666 2 5.14999 2 6.14999C2 6.73333 2.11667 7.325 2.35 7.92499C2.58333 8.50833 3 9.18333 3.6 9.95C4.2 10.7 5.01667 11.5917 6.05 12.625C7.08333 13.6417 8.4 14.8667 10 16.3Z"
										fill="currentColor"
									/>
								</svg>
							</a>
						</div>
						<div
							class="product-content d-flex justify-content-between"
						>
							<a href="{{ route('products.details', [
								'category' => $product->categories->first()->slug,
								'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
								'product' => $product->slug
							]) }}">
								<h3>
									{{ $product->title }}
								</h3>
							</a>
							<div class="product-price">
								@if($product->sale)
                                    <h4 >{{ $product->offerPrice }}</h4>
                                    <h5>{{ $product->price }}</h5>
                                @else
                                    <h4>{{ $product->price }}</h4>
                                @endif
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
@endif
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
@endsection