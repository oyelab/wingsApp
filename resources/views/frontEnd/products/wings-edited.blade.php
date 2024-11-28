@extends('frontEnd.layouts.app')

@section('pageTitle', $product->title . ' | ')
@section('pageDescription', $product->meta_desc)
@section('pageKeywords', $product->keywordsString)
@section('pageOgImage', $product->ogImagePath)  <!-- Image specific to this page -->

@section('page')
@section('css')
<style>
	    .no-gap {
            margin: 0;
            padding: 0;
        }
     .collage img {
      width: 100%;
      height: auto;
      object-fit: cover;
    }
	.toggle-container {
        border-top: 1px solid var(--Wings-Secondary, #F9F9F9);
        border-bottom: 1px solid var(--Wings-Secondary, #F9F9F9);
        padding: 10px 0;
        position: relative;
        cursor: pointer; /* Make the whole container clickable */
    }
    .toggle-container h4 {
        margin: 0;
    }
    .toggle-section {
        overflow: hidden;
        max-height: 0;
        transition: max-height 0.3s ease-in-out;
    }
    .toggle-section.expanded {
        max-height: 300px; /* Adjust based on content */
    }
    .toggle-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.25rem;
        transition: transform 0.3s ease;
    }
    .toggle-icon.rotate {
        transform: translateY(-50%) rotate(180deg);
    }
</style>
@endsection
@section('content')
<!-- breadcrumb section -->
<!-- <div class="breadcrumb-section">
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
</div> -->
<div class="container-fluid no-gap">
	<div class="row">
		<!-- Left Column -->
		<div class="col-8">
			<!-- Row 1: Collage of 4 Photos -->
			<div class="row g-1 collage">
				<div class="col-6">
					<img src="{{ asset('images/wings-collage.jpg') }}" alt="Photo 1">
				</div>
				<div class="col-6">
					<img src="{{ asset('images/wings-collage.jpg') }}" alt="Photo 2">
				</div>
				<div class="col-6">
					<img src="{{ asset('images/wings-collage.jpg') }}" alt="Photo 3">
				</div>
				<div class="col-6">
					<img src="{{ asset('images/wings-collage.jpg') }}" alt="Photo 4">
				</div>
			</div>

			<!-- Row 2: Context -->
			<div class="mt-4 ps-5">
				<div class="toggle-container" onclick="toggleSection('descriptionSection', this)">
					<h4>Description</h4>
					<i class="bi bi-arrow-down-short toggle-icon"></i>
					<div class="description toggle-section" id="descriptionSection">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
					</div>
				</div>

				<div class="toggle-container" onclick="toggleSection('reviewsSection', this)">
					<h4>Reviews</h4>
					<i class="bi bi-down-arrow-short toggle-icon"></i>
					<div class="reviews toggle-section" id="reviewsSection">
						<p>⭐⭐⭐⭐⭐ (10 reviews)</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Right Column -->
		<div class="col-4">
			<div class="mb-3">
				<!-- Row 1: Title -->
				<h2>Official <span class="text-primary">•</span> Football</h2>
			</div>
			<div class="mb-3">
				<!-- Row 2: Rating -->
				<p>⭐⭐⭐⭐⭐ (10)</p>
			</div>
			<div>
				<!-- Row 3: Specifications List -->
				<h5>Specifications</h5>
				<ul>
					<li>Material: Synthetic Leather</li>
					<li>Weight: 450g</li>
					<li>Size: Standard</li>
					<li>Color: Black & White</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="get-in-touct-btn-wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
			<div class="get-in-touch-btn text-center">
				<p>If you want to get this design for your team</p>
				<a 
					href="https://wa.me/{{ config('app.whatsapp_number') }}?text={{ urlencode('Hello, I am interested in this product: ' . route('products.details', [
	'category' => $product->categories->first()->slug,
	'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
	'product' => $product->slug
])) }}" 
					target="_blank" 
					rel="noopener noreferrer"
					class="btn btn-success"
					>
					GET IN TOUCH
				</a>
			</div>

			</div>
		</div>
	</div>
</div>

<!-- social media -->
<div class="container section-buttom-padding">
	<div class="row">
		<div class="col-12">
			<div class="social-share-wrap">
				<h2>Social Share:</h2>
				<div class="social-share-wrap">						
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
</div>
@endsection
@section('scripts')
<script>
	function toggleSection(sectionId, container) {
        const section = document.getElementById(sectionId);
        const icon = container.querySelector('.toggle-icon');

        // Toggle expanded class for section and rotate the icon
        section.classList.toggle('expanded');
        icon.classList.toggle('rotate');
    }
</script>
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