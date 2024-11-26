@extends('frontEnd.layouts.app')

@section('pageTitle', $product->title . ' | ')
@section('pageDescription', $product->meta_desc)
@section('pageKeywords', $product->keywordsString)
@section('pageOgImage', $product->ogImagePath)  <!-- Image specific to this page -->

@section('page')
@section('content')
<!-- breadcrumb section -->
<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb-content">
					<x-breadcrub
						:collection="$collection"
						:pagetitle="$product->slug"
					/>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Collection Product -->
<div class="collection-product-gallery">
	<div class="container">
		<div class="row">
			<!-- First Image Display -->
			<div class="col-md-6">
				<div class="collection-product-image-big text-center">
					<img
						src="{{ $product->imagePaths[0] ?? 'default-image.jpg' }}"
						alt="{{ $product->title }}"
						draggable="false"
						class="img-fluid"
					/>
				</div>
			</div>

			<!-- Remaining Images Display -->
			<div class="col-md-6">
				<div class="collection-product-gallery-inner custom-scrollbar-style">
					@foreach($product->imagePaths as $key => $imagePath)
						@if($key > 0) <!-- Skip the first image -->
						<div class="item">
							<img
								src="{{ $imagePath }}"
								draggable="false"
								class="img-fluid"
								alt="{{ $product->title }} Gallery Image {{ $key }}"
							/>
						</div>
						@endif
					@endforeach
				</div>
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

			</div>
		</div>
	</div>
</div>
<div class="collection-product-details-wrap">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="collection-product-details-left">
					<h4><span class="badge bg-success-subtle text-success mb-0">{{ $product->category_display }}</span></h4>
					<h2><span>{{ $product->title }}</span></h2>
					
					<h3>Our Product Specifications are:</h3>
					<ul>
					@foreach($product->specifications() as $spec)
						<li>✔ {{ $spec->item }}</li> <!-- Adjust to the appropriate field of the Specification model -->
					@endforeach
					</ul>
				</div>
			</div>
			<div class="col-md-7">
				<div class="collection-product-details-right">
					<h2>Description</h2>
					<div class="product-description">
						{!! $product->description !!}
					</div>
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