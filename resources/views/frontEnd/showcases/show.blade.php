@extends('frontEnd.layouts.app')
@section('pageTitle', $showcase->title . ' | ')
@section('pageDescription', $showcase->description)
@section('pageOgImage', $showcase->ogImagePath)  <!-- Image specific to this page -->

@section('content')
<div class="container-fluid ">
	<div class="row no-gutters m-0 d-flex">
		@foreach($showcase->bannersImagePath as $imagePath)
			<div class="col-12 p-0">
				<img src="{{ $imagePath }}" alt="Showcase Banner" class="w-100" loading="lazy">
			</div>
		@endforeach
	</div>


</div>

<!-- Social Share Section (Centered at the bottom) -->
<div class="row justify-content-center pt-5 section-buttom-padding">
	<div class="col-auto text-center">
		<div class=" justify-content-center">
			<div class="d-flex justify-content-center align-items-center social-share-wrap">

				<h2 class="me-2">Social Share: </h2>

				<div class="social-share-icon">
					<!-- Facebook Share -->
					<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
						target="_blank" title="Share on Facebook">
						<i class="bi bi-facebook fs-4"></i>
					</a>

					<!-- Twitter Share -->
					<a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode('Check this out!') }}"
						target="_blank" title="Share on Twitter">
						<i class="bi bi-twitter fs-4"></i>
					</a>

					<!-- LinkedIn Share -->
					<a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
						target="_blank" title="Share on LinkedIn">
						<i class="bi bi-linkedin fs-4"></i>
					</a>

					<!-- Messenger Share -->
					<a href="https://www.facebook.com/dialog/send?link={{ urlencode(request()->fullUrl()) }}&app_id=YOUR_APP_ID"
						target="_blank" title="Share on Messenger">
						<i class="bi bi-messenger fs-4"></i>
					</a>

					<!-- WhatsApp Share -->
					<a href="https://api.whatsapp.com/send?text={{ urlencode(request()->fullUrl()) }}"
						target="_blank" title="Share on WhatsApp">
						<i class="bi bi-whatsapp fs-4"></i>
					</a>

					<!-- Copy Link (with JavaScript functionality) -->
					<button id="clipboardButton" onclick="copyLink()" title="Copy Link"
						style="border: none; background: none; cursor: pointer;">
						<i id="clipboardIcon" class="bi bi-copy fs-4"></i>
					</button>
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