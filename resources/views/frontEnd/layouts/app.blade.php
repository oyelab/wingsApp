<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,maximum-scale=2.0,minimum-scale=1.0">

		{{-- Page-specific Title --}}
		<!-- <title>{{ isset($pageTitle) ? $pageTitle . ' | ' : '' }}{{ $siteSettings->title ?? 'Wings Sportswear' }}</title> -->
		<title>@yield('pageTitle'){{ $siteSettings->title ?? 'Wings Sportswear' }}</title>

		{{-- Page-specific Description --}}
		<meta name="description" content="@yield('pageDescription', $siteSettings->description ?? 'Innovative sportswear that blends cutting-edge technology with sleek design. For athletes and active individuals who demand more. Discover high-performance apparel that supports your journey to greatness.')">


		{{-- Page-specific Keywords --}}
		<meta name="keywords" content="@yield('pageKeywords', isset($pageKeywords) ? $pageKeywords : ($siteSettings->keywords ?? 'Wings, Sportswear, Jersey, Shop, Sports Shop, Sports Market, Buy Jersey, Sell Jersey'))" />


		{{-- Site-wide Brand Name --}}
		<meta name="brand_name" content="{{ $siteSettings->title ?? 'Wings Sportswear' }}" />

		{{-- Open Graph Tags --}}
		<meta property="og:type" content="website" />
		<!-- Open Graph Title -->

		<meta property="og:title" content="@yield('pageTitle'){{ isset($pageTitle) ? ' | ' . $pageTitle : '' }}{{ $siteSettings->title ?? 'Wings Sportswear' }}" />


		<meta property="og:description" content="@yield('pageDescription', isset($pageDescription) ? $pageDescription : $siteSettings->description)" />

		
		<meta property="og:image" content="@yield('pageOgImage', $siteSettings->getImagePath('og_image'))" >


		<meta property="og:image:width" content="1200" />
		<meta property="og:image:height" content="630" />

		<meta property="og:url" content="{{ request()->url() }}">
		<meta property="og:site_name" content="{{ $siteSettings->title ?? 'Wings Sportswear' }}">

		{{-- Other Static Meta Tags --}}
		<meta property="fb:app_id" content="1081491186574205">
		<meta name="theme-color" content="#000000">
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZSCBQ6N4C0"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-ZSCBQ6N4C0');
		</script>

		<!-- Meta Pixel Code -->
		<script>
			!function (f, b, e, v, n, t, s) {
				if (f.fbq) return; n = f.fbq = function () {
					n.callMethod ?
						n.callMethod.apply(n, arguments) : n.queue.push(arguments)
				};
				if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
				n.queue = []; t = b.createElement(e); t.async = !0;
				t.src = v; s = b.getElementsByTagName(e)[0];
				s.parentNode.insertBefore(t, s)
			}(window, document, 'script',
				'https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '3367246996738509');
			fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
				src="https://www.facebook.com/tr?id=3367246996738509&ev=PageView&noscript=1" />
		</noscript>
		<!-- End Meta Pixel Code -->
		
		<link rel="icon" href="{{ $siteSettings->favicon ?? asset('favicon.ico') }}" type="image/x-icon">

		
		@include('frontEnd.layouts.head-css')
	</head>
	<body>
		<!-- Header -->
		<header class="header-area" id="wings-header-sticky">
			<div class="container">
				<div class="row">
					<div class="d-flex align-items-center justify-content-between">
						<div class="wings-logo">
							<a href="{{ route('index') }}">
								<img
									src="{{ $siteSettings->getImagePath('logo_v1') }}"
									class="img-fluid"
									alt="Logo"
									draggable="false"
								/>
							</a>
						</div>
						<div class="menu-area d-none d-lg-block">
							<ul class="d-flex align-items-center">
								<li>
									<a href="{{ route('shop.page', ['section' => 'latest']) }}">NEW ARRIVALS</a>
								</li>
								<li>
									<a href="{{ route('collections') }}">COLLECTIONS</a>
								</li>
								<li>
									<a href="{{ route('wings.edited') }}">WINGS EDITED</a>
								</li>
								<li>
									<a href="{{ route('shop.page', parameters: ['section' => 'trending']) }}">TRENDING</a>
								</li>
							</ul>
						</div>
						<div class="right-area">
							<ul class="d-flex align-items-center">
								<li class="search-product d-flex align-items-center">
									<i class="fa-solid fa-magnifying-glass search-icon" id="searchIcon"></i>
								</li>
								<li>
									<a href="{{ route('wishlist') }}" class="d-flex align-items-center">
										<i class="fa-solid fa-heart"></i>
										<small>
											<span id="wishlist-count" class=" text-dark" 
												style="{{ session('wishlist') && count(session('wishlist')) > 0 ? 'display: inline-block;' : 'display: none;' }}">
												{{ session('wishlist') ? count(session('wishlist')) : '' }}
											</span>
										</small>
									</a>
								</li>

								<li>
									<a href="{{ route('cart.show') }}" class="{{ session('cart') ? '' : 'disabled' }} d-flex align-items-center">
										<i class="fa-solid fa-cart-shopping"></i>
										<small>
											<span id="cart-count-badge" class=" text-dark" 
												style="{{ session('cart') && count(session('cart')) > 0 ? 'display: inline-block;' : 'display: none;' }}">
												{{ session('cart') ? count(session('cart')) : '' }}
											</span>
										</small>
									</a>
								</li>


								<li class="nav-item custom-dropdown">
									@if (Auth::check())
										<!-- User Avatar or First Letter -->
										<a class="usernav-link" href="#" id="userDropdown" role="button">
											@if (Auth::user()->avatar)
												<!-- User's Avatar -->
												<img src="{{ Auth::user()->avatarPath }}" alt="User Avatar" class="user-avatar">
											@else
												<!-- First Letter of Name -->
												<div class="user-placeholder">
													{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
												</div>
											@endif
										</a>


										<!-- Dropdown Menu -->
										<div class="dropdown-menu-custom">
											<a href="{{ route('profile') }}" class="dropdown-item-custom">
												<i class="fa-solid fa-user-circle"></i> My Profile
											</a>
											<a href="{{ route('dashboard') }}" class="dropdown-item-custom">
												<i class="fa-solid fa-chart-line"></i> Dashboard
											</a>
											<hr class="dropdown-divider-custom">
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
											<a href="#" class="dropdown-item-custom" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
												<i class="fa-solid fa-sign-out-alt"></i> Logout
											</a>
										</div>
									@else
										<a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i></a>
									@endif
								</li>
								<li class='d-block d-lg-none'>
								<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" 		data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
									<i class="fa-solid fa-bars"></i>
								</button>
								</li>
							</ul>
							<div class="search-box" id="searchBox">
								<form action="{{ route('collections') }}" method="GET">
									<input type="text" name="query" placeholder="Search..." />
								</form>
								<i class="fa-solid fa-xmark search-icon"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>


		<div class="offcanvas offcanvas-end mobile-device-offcanvas" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
			<div class="offcanvas-header">
				<div class="wings-logo">
					<a href="{{ route('index') }}">
						<img src="{{ $siteSettings->getImagePath('logo_v1') }}" class="img-fluid" alt="Logo" draggable="false" />
					</a>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<div class="menu-area">
					<ul class="">
						<li>
							<a href="{{ route('shop.page', ['section' => 'latest']) }}">NEW ARRIVALS</a>
						</li>
						<li>
							<a href="{{ route('collections') }}">COLLECTIONS</a>
						</li>
						<li>
							<a href="{{ route('wings.edited') }}">WINGS EDITED</a>
						</li>
						<li>
							<a href="{{ route('shop.page', parameters: ['section' => 'trending']) }}">TRENDING</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		@yield('content')
		
		<!-- Call to action -->
		@if(!in_array(Route::currentRouteName(), ['getInTouch', 'showcase.show']))
			<div class="call-to-action-area text-center">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div
								class="call-to-action-content d-flex align-items-center justify-content-center"
							>
								<p>
									We’d love to hear from you >
								</p>
								<a href="{{ route('getInTouch') }}">Get In Touch</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif

		<!-- Need Assistance -->
		<div class="need-assistance-area text-center">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div
							class="need-assistance-content d-flex align-items-center justify-content-between"
						>
							<p>Need Assistance?</p>
							<div class="contact-info d-flex flex-column">
								<ul class="d-flex align-items-center">
									<li>Email:</li>
									<span>{{ $siteSettings->email ?? 'hello@wingssportswear.shop' }}</span>
								</ul>
								<ul class="d-flex align-items-center">
									<li>Phone Number:</li>
									<span>{{ $siteSettings->phone ?? '+880-1886-424141' }}</span>
								</ul>
								<ul class="d-flex align-items-center">
									<li>Address:</li>
									<span>{{ $siteSettings->address ?? 'South Mugda, Mugdapara, Dhaka-1214' }}</span>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<footer class="footer-area">
			<div class="container">
				<div class="row justify-content-center mb-5">
					<div class="d-flex justify-content-center social-logo">
						<ul class="d-flex align-items-center">
							@foreach ($socialLinks as $link)
								<li>
									<a href="{{ 'https://' . strtolower($link['platform']) . '.com/' . $link['username'] }}" target="_blank">
										<i class="social-icon {{ $iconMapping[strtolower($link['platform'])] }}"></i>
									</a>
								</li>
							@endforeach
						</ul>
					</div>
    			</div>
				<div class="row">
					<div class="col-12">
						<div
							class="footer-wrapper d-flex align-items-end justify-content-between"
						>
							<div class="footer-left">
								<div class="footer-logo">
									<a href="{{ route('index') }}">
										<img
											src="{{ $siteSettings->getImagePath('logo_v2') }}"
											draggable="false"
											alt="{{ $siteSettings->title }} Logo"
											height="75"
										/>
									</a>
								</div>
								
								<p>
									{{ $siteSettings->description ?? 'Innovative sportswear that blends
									cutting-edge technology with sleek design.
									For athletes and active individuals who
									demand more. Discover high-performance
									apparel that supports your journey to
									greatness.' }}
								</p>
								<div id="subscription" class="newsletter-form d-flex flex-column align-items-start pb-2">
									<!-- Success or Error Message -->
									@if(session('success'))
										<!-- Thank You Message -->
										<div class="alert alert-success d-flex" role="alert">
											<i class="bi bi-check-circle me-2"></i> {{ session('success') }}
										</div>
									@else
										<!-- Show form only if there's no success -->
										@if(session('error'))
											<div class="alert alert-danger" role="alert">
												<i class="bi bi-x-circle"></i> {{ session('error') }}
											</div>
										@endif

										<form
											action="{{ route('subscribe') }}"
											method="POST"
											class="d-flex flex-column w-100"
											onsubmit="saveScrollPosition()"
										>
											@csrf
											<!-- Input and Button in a single row -->
											<div class="form-group d-flex justify-content-start align-items-center">
												<input
													type="email"
													name="email"
													placeholder="Enter your email"
													required
													value="{{ old('email') }}"
													class="form-control @error('email') is-invalid @enderror w-auto"
												/>
												<button type="submit" class="btn btn-outline-success ms-2">Subscribe</button>
											</div>

											<!-- Error message on a new row -->
											@error('email')
												<div class="mt-2 text-danger">
													<i class="bi bi-exclamation-circle"></i> {{ $message }}
												</div>
											@enderror
										</form>
									@endif
								</div>

								

							</div>
							<div class="footer-right d-flex">
								<div class="footer-menu">
									<h2>About</h2>
									<ul>
									@foreach ($footerLinks as $link)
										<li>
											<a href="{{ route('help.index') }}#{{ $link->slug }}" class="footer-link">{{ $link->title }}</a>
										</li>
									@endforeach
									</ul>
								</div>
								<div class="footer-menu">
									<h2>Quick Links</h2>
									<ul>
									@foreach ($quickLinks as $link)
										<li>
											<a href="{{ route('help.index') }}#{{ $link->slug }}" class="footer-link">{{ $link->title }}</a>
										</li>
									@endforeach
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div
							class="footer-bottom d-flex align-items-center justify-content-between"
						>
							<p>
								&copy;
								<script>
									document.write(new Date().getFullYear());
								</script>
								, Wings Sportswear, All Rights Reserved
							</p>
							<div class="design-by d-flex align-items-center">
								<p>Design & Developed by-</p>
								@foreach($assets->filter(fn($asset) => $asset->type === 0) as $asset)
									<a href="{{ $asset->url }}" target="_blank">
										<img src="{{ $asset->filePath }}" draggable="false" class="img-fluid"
										alt="{{ $asset->title }}" />
									</a>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		
		<div class="notification-container position-fixed bottom-0 w-100">
			<!-- Row 1 -->
			<div class="d-flex justify-content-between align-items-center mb-2">
				<!-- Toast Notification (aligned to the left) -->
				<div class="toast-container mb-2 d-flex align-items-center">
					<div
						class="toast bg-dark text-white ms-2"
						id="wishlist-toast"
						role="alert"
						aria-live="assertive"
						aria-atomic="true"
						data-bs-autohide="true"
						data-bs-delay="4000"
					>
						<div class="toast-header bg-dark text-white">
							<strong class="ms-3 me-3 toast-body">Wishlist updated!</strong>
							<button
								type="button"
								class="btn-close btn-close-white"
								data-bs-dismiss="toast"
								aria-label="Close"
							></button>
						</div>
					</div>
				</div>

				<!-- WhatsApp Button (aligned to the right) -->
				<a
					href="https://wa.me/{{ config('app.whatsapp_number') }}?text={{ 'Lets Discuss About Wings Sportswear!' }}"
					target="_blank" 
					id="whatsappButton" 
					class="whatsapp-button me-3 mb-2 ms-auto"
				>
					<i class="bi bi-whatsapp"></i>
				</a>
			</div>

			<div id="cookieAlert" class="cookie-alert" style="display: none;">
				<span class="cookie-message">
					We use cookies to enhance your experience. By clicking "Accept," you agree to our
					<a href="{{ route('help.index')}}#privacy-policy" target="_blank">Privacy Policy</a> and
					<a href="{{ route('help.index')}}#terms-conditions" target="_blank">Terms & Conditions</a>.
				</span>
				<div class="cookie-buttons">
					<button id="acceptCookies" class="btn btn-outline-light">Accept</button>
					<button id="dismissCookies" class="btn btn-outline-secondary">Dismiss</button>
				</div>
			</div>
		</div>


		@include('frontEnd.layouts.vendor-scripts')
		<script>
			// Show the search box when the search icon is clicked
			document.getElementById('searchIcon').addEventListener('click', () => {
				const searchBox = document.getElementById('searchBox');
				const closeIcon = searchBox.querySelector('.fa-xmark');
			
				// Add classes
				searchBox.classList.add('search-box', 'show');
				// remove show class
				closeIcon.addEventListener('click', () => {
					searchBox.classList.remove('show');
				});
			});

			// Optional: This script is to ensure the badge is updated if necessary
			// Function to update the cart count
			function updateCartCount() {
				$.ajax({
					url: '/cart/count',
					method: 'GET',
					success: function (response) {
						if (response.count > 0) {
							$('#cart-count-badge').text(response.count).show();
							$('#cart-button').removeClass('disabled'); // Enable click
						} else {
							$('#cart-count-badge').hide(); // Hide badge
							$('#cart-button').addClass('disabled'); // Disable click
						}
					},
					error: function () {
						console.log('Error fetching cart count.');
					}
				});
			}

			// Call updateCartCount only when needed (e.g., after adding/removing a product)
			document.addEventListener('DOMContentLoaded', function () {
				// Example: Call updateCartCount after adding to cart
				$('#addToCartBtn').on('click', function() {
					// Assume an add-to-cart action is performed here (e.g., sending the request to backend)

					// After the action, update the cart count
					updateCartCount();
				});
			});

			// Initial load of cart count on page load
			updateCartCount();

		</script>
		<script>
			$(document).ready(function() {
				// Show the search field when the magnifying glass is clicked
				$('#searchIcon').on('click', function(event) {
					event.preventDefault(); // Prevent the default anchor behavior

					// Toggle visibility of the search form
					$('#searchForm').toggleClass('d-none'); 
					$('#searchInput').focus(); // Focus on the search input for the user to type

					// Change the icon from magnifying glass to search
					$('#searchIcon i').toggleClass('fa-magnifying-glass fa-search');
				});

				// When the form is submitted (via the search icon inside the form)
				$('#searchFormContent').on('submit', function(event) {
					// Check if there's text inside the input field to search for
					if ($('#searchInput').val().trim() === '') {
						event.preventDefault(); // Prevent form submission if the field is empty
					}
				});

				// Close the search form when clicking outside of it
				$(document).on('click', function(event) {
					if (!$(event.target).closest('#searchForm').length && !$(event.target).closest('#searchIcon').length) {
						$('#searchForm').addClass('d-none'); // Hide search form
						$('#searchIcon i').toggleClass('fa-search fa-magnifying-glass'); // Revert icon to magnifying glass
					}
				});
			});

			document.querySelectorAll('.footer-link').forEach(link => {
				link.addEventListener('click', function (event) {
					// Check if the link is pointing to the current page hash
					if (window.location.hash === `#${this.hash.substring(1)}`) {
						event.preventDefault(); // Prevent the default behavior of the link
						window.location.reload(); // Reload the page to jump to the section
					}
				});
			});
			
			document.addEventListener('DOMContentLoaded', () => {
				// Check if the user is signed in (you can modify this logic based on your app's user state)
				const isUserSignedIn = {{ auth()->check() ? 'true' : 'false' }};
				
				if (!isUserSignedIn) {
					// If the user is not signed in, do not activate the dropdown functionality
					return; // Exit early
				}

				const dropdown = document.querySelector('.custom-dropdown');
				const userLink = dropdown.querySelector('.usernav-link');
				const menu = dropdown.querySelector('.dropdown-menu-custom');

				userLink.addEventListener('click', (e) => {
					e.preventDefault();
					dropdown.classList.toggle('active');
				});

				document.addEventListener('click', (e) => {
					if (!dropdown.contains(e.target)) {
						dropdown.classList.remove('active');
					}
				});
			});
		</script>
		
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				document.addEventListener('click', function (e) {
					if (e.target.closest('.wishlist-icon') || e.target.closest('.favorite')) {
						e.preventDefault();

						const button = e.target.closest('.wishlist-icon') || e.target.closest('.favorite');
						const productId = button.getAttribute('data-product-id');
						const wishlistItem = button.closest('.wishlist-item');

						// Send the request to toggle the wishlist (for add/remove action)
						fetch("{{ route('wishlist.toggle') }}", {
							method: 'POST',
							headers: {
								'X-CSRF-TOKEN': '{{ csrf_token() }}',
								'Content-Type': 'application/json',
							},
							body: JSON.stringify({ product_id: productId }),
						})
							.then(response => response.json())
							.then(data => {
								if (data.success) {
									const icon = button.querySelector('i');

									// Handle wishlist icon toggle
									if (button.classList.contains('wishlist-icon')) {
										if (data.action === 'added') {
											icon.classList.remove('bi-heart');
											icon.classList.add('bi-heart-fill');
										} else if (data.action === 'removed') {
											icon.classList.remove('bi-heart-fill');
											icon.classList.add('bi-heart');
											if (wishlistItem && document.getElementById('wishlist-page')) {
												wishlistItem.remove();
											}
										}
									}

									// Handle favorite button toggle
									if (button.classList.contains('favorite')) {
										if (data.action === 'added') {
											button.classList.add('selected');
										} else if (data.action === 'removed') {
											button.classList.remove('selected');
											if (wishlistItem && document.getElementById('wishlist-page')) {
												wishlistItem.remove();
											}
										}
									}

									// Update the wishlist count
									const countElement = document.getElementById('wishlist-count');
									if (data.wishlist_count > 0) {
										countElement.textContent = data.wishlist_count;
										countElement.style.display = 'inline-block'; // Show the count
									} else {
										countElement.textContent = '';
										countElement.style.display = 'none'; // Hide if wishlist is empty
									}

									// Show and automatically hide the toast notification
									const toastElement = document.getElementById('wishlist-toast');
									const toast = new bootstrap.Toast(toastElement);
									document.querySelector('.toast-body').textContent =
										data.action === 'added'
											? 'Product added to wishlist!'
											: 'Product removed from wishlist!';
									toast.show();
								} else {
									console.error('Error:', data.message || 'Unknown error occurred');
								}
							})
							.catch(error => console.error('Error:', error));
					}
				});
			});

		</script>
		<script>
			// Save the current scroll position before form submission
			function saveScrollPosition() {
				sessionStorage.setItem('scrollPosition', window.scrollY);
			}

			// Restore scroll position on page load
			window.addEventListener('load', function () {
				const scrollPosition = sessionStorage.getItem('scrollPosition');
				if (scrollPosition) {
					window.scrollTo(0, parseInt(scrollPosition));
					sessionStorage.removeItem('scrollPosition'); // Clean up after restoring
				}
			});
		</script>
	</body>
</html>