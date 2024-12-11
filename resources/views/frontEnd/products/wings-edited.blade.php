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
				<div class="collection-image-item d-none" data-index="{{ $key }}">
					<img src="{{ $imagePath }}" alt="{{ $product->title }} Gallery Image {{ $key }} ">
				</div>
			@endforeach
		</div>
		<div class="see-more-btn">
			<div class="collection-image-see-more">
				<button id="seeMoreButton">
					See More
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
								<i class="bi bi-chevron-down"></i>
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
						<h2 class="accordion-header" id="reviewHeading">
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
									<div class="mt-3">
										<h3>Write your review</h3>
										<form action="{{ route('reviews.store') }}" method="POST">
											@csrf
											<div class="border shadow-sm rounded mt-4 p-3">
												<div class="ms-1 d-flex align-items-center justify-content-between" role="group">
													<div id="basic-rater" class="ms-2"></div> <!-- Add margin to separate the stars and text -->
													<strong class="me-2 mb-0">Rate from 1 to 5 stars.</strong> 

													<!-- Display the username input field if the user is not authenticated -->
													@guest
														<input type="text" class="form-control bg-transparent me-2 w-50" name="username" placeholder="Your Name" aria-label="Username" value="{{ old('username') }}">
													@endguest

													<!-- Display the authenticated user's name if they are logged in -->
													@auth
														<label class="form-control bg-transparent me-2 w-50">{{ auth()->user()->name }}</label>
														<input type="hidden" name="username" value="{{ auth()->user()->name }}"> <!-- Include the authenticated username in the form -->
													@endauth

													<!-- Submit button -->
													<button type="submit" class="btn btn-success me-2">Submit</button>
												</div>

												<!-- Hidden input to store the star rating -->
												<input type="hidden" name="rating" id="ratingValue" value="{{ old('rating') }}">
												<input type="hidden" name="item" value="{{ $product->id }}">

												<textarea rows="3" class="form-control bg-transparent border mt-2" placeholder="Write Your Review..." name="content">{{ old('content') }}</textarea>
											</div>

											<!-- Error message display -->
											@if ($errors->any())
												<div class="mt-2 ms-3 text-danger">
													@foreach ($errors->all() as $error)
														<p class="mb-0">{{ $error }}</p>
													@endforeach
												</div>
											@endif
										</form>

										<!-- Success message display -->
										@if(session('success'))
											<div class="mt-3 alert alert-success">
												{{ session('success') }}
											</div>
										@endif
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
			<h4>
				<span class="badge bg-success-subtle text-success mb-0">{{ $product->category_display }}</span>
			</h4>
		</div>

		<h2>
			<span>{{ $product->title }}</span>
		</h2>
		<h6>
			<strong>
				★ {{ number_format($product->averageRating, 1) }} Rating ({{ $product->reviews->count() }} Reviews)
			</strong>
		</h6>
		<div class="product-details-area">
			<h2>Specifications</h2>
			<div class="product-description">
				<ul>
					@foreach($product->specifications() as $spec)
						<li>✔ {{ $spec->item }}</li> <!-- Adjust to the appropriate field of the Specification model -->
					@endforeach
				</ul>
			</div>
		</div>
		<div class="">
			<img class="img-fluid" draggable='false' src="{{ $wingsPower->filePath }}" alt="{{ $wingsPower->title }}">
		</div>
		<div class="get-in-touch-btn text-center">
			<p>If you want to get this design for your team</p>
			<a 
				href="https://wa.me/{{ config('app.whatsapp_number') }}?text={{ urlencode('Hello, I am interested in this product: ' . route('products.details', ['category' => $product->categories->first()->slug,
							'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
							'product' => $product->slug])) }}" 
				target="_blank" 
				rel="noopener noreferrer"
				class="btn btn-success"
				>
				GET IN TOUCH
			</a>
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
	document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.collection-image-item');
    const seeMoreButton = document.getElementById('seeMoreButton');
    const loadBatchSize = 4; // Number of items to show per click
    let currentlyVisible = 0; // Tracks how many items are visible

    const toggleImages = () => {
        const totalItems = items.length;

        if (seeMoreButton.textContent.trim() === 'See More') {
            // Show next batch of items
            let nextVisible = currentlyVisible + loadBatchSize;

            for (let i = currentlyVisible; i < nextVisible && i < totalItems; i++) {
                items[i].classList.remove('d-none');
            }

            currentlyVisible = nextVisible;

            if (currentlyVisible >= totalItems) {
                seeMoreButton.textContent = 'See Less';
            }
        } else {
            // Hide all except the first batch
            for (let i = loadBatchSize; i < totalItems; i++) {
                items[i].classList.add('d-none');
            }

            currentlyVisible = loadBatchSize;
            seeMoreButton.textContent = 'See More';
        }
    };

    seeMoreButton.addEventListener('click', toggleImages);

    // Initially show the first batch of items
    toggleImages();
});

</script>
<script src="{{ asset('build/libs/rater-js/index.js') }}"></script>
<script>
	// Define the initial rating value
	var initialRating = 4; // You can change this to 5 if needed

	// Initialize raterJs
	var basicRating = raterJs({
		starSize: 22,
		rating: initialRating, // Use the variable for initial display
		element: document.querySelector("#basic-rater"),
		rateCallback: function rateCallback(rating, done) {
			// Set the rating value to the hidden input field when a user interacts
			document.getElementById("ratingValue").value = rating;
			this.setRating(rating); // Reflects the selected rating in the widget
			done();
		}
	});

	// Set the initial value of the hidden input field using the variable
	document.getElementById("ratingValue").value = initialRating;
</script>
@endsection