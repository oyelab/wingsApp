@extends('frontEnd.layouts.app')

@section('pageTitle', $product->title . ' | ')
@section('pageDescription', $product->meta_desc)
@section('pageKeywords', $product->keywordsString)
@section('pageOgImage', $product->ogImagePath)  <!-- Image specific to this page -->

@section('page')

@section('content')

<div class="collection-new-section-area">
	<div>
		<div class="collection-image-area collage">
			@foreach($product->imagePaths as $key => $imagePath)
				<div class="collection-image-item {{ $key >= 4 ? 'd-none' : '' }}">
					<img src="{{ $imagePath }}" alt="{{ $product->title }} Gallery Image {{ $key }} ">
				</div>
			@endforeach
		</div>
		<div class="see-more-btn">
			<!-- see more button -->
			<div class="collection-image-see-more">
				<button id="seeMoreButton">
					See More
					<svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M6 0C6.22729 0 6.44527 0.085593 6.60598 0.237949C6.7667 0.390306 6.85699 0.596945 6.85699 0.812409V10.225L10.5352 6.7365C10.6149 6.66096 10.7095 6.60105 10.8136 6.56017C10.9177 6.51929 11.0292 6.49825 11.1419 6.49825C11.2546 6.49825 11.3662 6.51929 11.4703 6.56017C11.5744 6.60105 11.669 6.66096 11.7487 6.7365C11.8284 6.81203 11.8916 6.9017 11.9347 7.00039C11.9778 7.09909 12 7.20486 12 7.31168C12 7.41851 11.9778 7.52428 11.9347 7.62297C11.8916 7.72166 11.8284 7.81134 11.7487 7.88687L6.60675 12.7613C6.52714 12.837 6.43257 12.897 6.32845 12.938C6.22434 12.9789 6.11272 13 6 13C5.88728 13 5.77566 12.9789 5.67154 12.938C5.56743 12.897 5.47286 12.837 5.39325 12.7613L0.251323 7.88687C0.171644 7.81134 0.108439 7.72166 0.0653168 7.62297C0.0221947 7.52428 0 7.41851 0 7.31168C0 7.20486 0.0221947 7.09909 0.0653168 7.00039C0.108439 6.9017 0.171644 6.81203 0.251323 6.7365C0.412243 6.58395 0.630497 6.49825 0.858071 6.49825C0.970755 6.49825 1.08233 6.51929 1.18644 6.56017C1.29055 6.60105 1.38514 6.66096 1.46482 6.7365L5.14301 10.225V0.812409C5.14301 0.596945 5.2333 0.390306 5.39402 0.237949C5.55473 0.085593 5.77271 0 6 0Z" fill="currentColor"/>
					</svg>
				</button>
			</div>
		</div>

		<div class="container">
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
	<div class="collection-content-area">
		<div class="category-breadcrumb">
			<ul class='d-flex align-items-center'>
				<li>Official Jersey</li>
				<li>Football</li>
			</ul>
		</div>
		<div class="collection-product-rating d-flex align-items-center">
			<div class="rating">
				<i class="bi bi-star-fill text-warning"></i>
				<i class="bi bi-star-fill text-warning"></i>
				<i class="bi bi-star-fill text-warning"></i>
				<i class="bi bi-star-fill text-warning"></i>
				<i class="bi bi-star-fill text-warning"></i>
			</div>
			<h3>10</h3>
		</div>
		<h2>ELMHURST FC’s third kit</h2>
		<div class="product-details-area">
			<h2>Specifications</h2>
			<div class="product-description">
				<ul>
					<li>✔ Fully Digital Sublimation Printed</li> 
					<li>✔ High-Grade Double Knit Fabric</li>
					<li>✔ 145-150 GSM.</li>
					<li>✔ Twin Needle Topstitch Sewing</li>
					<li>✔ Drop Shoulder Sleeve</li>
					<li>✔ Crew Neck</li>
				</ul>
			</div>
		</div>
		<div class="">
			<img class="img-fluid" draggable='false' src="{{ $wingsPower->filePath }}" alt="{{ $wingsPower->title }}">
		</div>
		<div class="social-share-wrap">
			<h3>Social Share:</h3>
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
<div class="collection-product-desc">
	<div class="container">
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
@endsection