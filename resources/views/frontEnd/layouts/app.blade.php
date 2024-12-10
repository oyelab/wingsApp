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
		
		<link rel="icon" href="{{ $siteSettings->favicon ?? asset('favicon.ico') }}" type="image/x-icon">

		@include('frontEnd.layouts.head-css')
		<style>
			#searchForm {
				transition: all 0.3s ease;
			}

			#searchForm.show {
				display: block; /* or use a class like "d-block" */
			}

			#searchInput {
				padding: 5px 10px;
			}
			/* Dropdown Container */
			.custom-dropdown {
				position: relative;
			}

			/* User Icon (Avatar or Placeholder) */
			.usernav-link {
				padding: 0;
				border: none;
				background: none;
				display: flex;
				align-items: center;
				justify-content: center;
				width: 50px; /* Adjust for desired size */
				height: 50px;
				border-radius: 50%;
				overflow: hidden;
				transition: transform 0.2s ease;
			}

			.usernav-link:hover {
				transform: scale(1.1);
			}

			/* User Avatar */
			.user-avatar {
				width: 35px; /* Smaller size */
				height: 35px; /* Make it circular */
				border-radius: 50%; /* Round the edges */
				border: 2px solid var(--wings-off); /* Pretty border with theme color */
				object-fit: cover; /* Make sure the image fits well */
			}

			.user-placeholder {
				width: 35px;
				height: 35px;
				border-radius: 50%;
				background-color: var(--wings-primary); /* Use theme color for placeholder background */
				color: white;
				display: flex;
				justify-content: center;
				align-items: center;
				font-weight: bold;
				font-size: 16px; /* Adjust the font size as needed */
			}


			/* Dropdown Menu */
			.dropdown-menu-custom {
				display: none;
				position: absolute;
				top: 120%; /* Adjusts vertical spacing */
				right: -10%; /* Moves dropdown slightly to the right */
				background-color: var(--wings-primary);
				border-radius: 8px;
				box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
				z-index: 1000;
				width: 250px;
				overflow: hidden;
				opacity: 0;
				transform: translateY(10px);
				transition: opacity 0.3s ease, transform 0.3s ease;
			}

			/* Show Dropdown Menu (when active) */
			.custom-dropdown.active .dropdown-menu-custom {
				display: block;
				opacity: 1;
				transform: translateY(0);
			}

			/* Dropdown Item */
			.dropdown-item-custom {
				display: flex;
				align-items: center;
				gap: 8px;
				padding: 12px 15px;
				color: var(--wings-white);
				text-decoration: none;
				font-size: 1rem;
				transition: background-color 0.3s ease, color 0.3s ease;
			}

			.dropdown-item-custom i {
				font-size: 1.2rem;
				color: var(--wings-alternative);
			}

			.dropdown-item-custom:hover {
				background-color: var(--wings-alternative);
				color: var(--wings-white);
			}

			/* Divider */
			.dropdown-divider-custom {
				border: 0;
				height: 1px;
				background-color: var(--wings-light);
				margin: 10px 0;
			}

		</style>
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
							<!-- Search Button (Magnifying Glass Icon) -->
								<!-- Search Button (Magnifying Glass Icon) -->
								<li>
									<a href="#" id="searchIcon">
										<i class="fa-solid fa-magnifying-glass"></i>
									</a>
								</li>

								<!-- Search Form (Initially Hidden) -->
								<div id="searchForm" class="d-none">
									<form id="searchFormContent" action="{{ route('collections') }}" method="GET">
										<input type="text" id="searchInput" name="query" placeholder="Search..." />
										<!-- Submit Button (Replaces icon inside the field when it appears) -->
										<button type="submit" id="submitSearch" class="d-none">
											<i class="fa-solid fa-search"></i>
										</button>
									</form>
								</div>

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


								<!-- Cart Icon with Badge -->
								<li>
									<a href="{{ route('cart.show') }}" id="cart-button" class="{{ session('cart') ? '' : 'disabled' }} d-flex align-items-center">
										<i class="fa-solid fa-cart-shopping"></i>
										<small>
											<span id="cart-count-badge" class="text-dark" style="display: {{ session('cart') ? 'inline' : 'none' }}">{{ session('cart') ? count(session('cart')) : '' }}</span>
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
						</div>
					</div>
				</div>
			</div>
		</header>
		
		<div class="toast-container">
			<div class="toast position-fixed bottom-0 end-0 mb-3 bg-dark text-white" id="wishlist-toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
				<div class="toast-body"></div>
			</div>
		</div>


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
		@if(Route::currentRouteName() !== 'getInTouch')
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
				<div class="row">
					<div class="col-12">
						<div
							class="footer-wrapper d-flex align-items-end justify-content-between"
						>
							<div class="footer-left">
								<div class="social-logo">
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

								<div class="footer-logo">
									<a href="{{ route('index') }}">
										<img
											src="{{ $siteSettings->getImagePath('logo_v2') }}"
											draggable="false"
											alt="{{ $siteSettings->title }} Logo"
											height="50"
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
		

		@include('frontEnd.layouts.vendor-scripts')
		<script>
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

		function showToast(message) {
			const toastContainer = document.querySelector('.toast-container');
			const toastElement = document.getElementById('wishlist-toast');
			const toastBody = toastElement.querySelector('.toast-body');

			toastBody.textContent = message;

			// Show the toast using Bootstrap's toast API
			const toast = new bootstrap.Toast(toastElement);
			toast.show();
		}

		document.getElementById('addToCartBtn').addEventListener('click', function () {
			const productId = this.getAttribute('data-product-id');
			const sizeId = document.querySelector('input[name="size"]:checked')?.value;

			if (!sizeId) {
				handleSizeError(true);
				return;
			}

			handleSizeError(false);

			// AJAX request to add the item to the cart
			addToCart(productId, sizeId)
				.then(response => response.json())
				.then(data => {
					showToast(data.message); // Display the success message in the toast
				})
				.catch(error => console.error('Error:', error));
		});

		document.getElementById('checkoutBtn').addEventListener('click', function () {
			const productId = document.getElementById('addToCartBtn').getAttribute('data-product-id');
			const sizeId = document.querySelector('input[name="size"]:checked')?.value;

			if (!sizeId) {
				handleSizeError(true);
				return;
			}

			handleSizeError(false);

			// Add product to cart before redirecting
			addToCart(productId, sizeId)
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

		</script>
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				document.addEventListener('click', function (e) {
					if (e.target.closest('.wishlist-icon')) {
						e.preventDefault();

						const button = e.target.closest('.wishlist-icon');
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
								if (data.action === 'added') {
									icon.classList.remove('bi-heart');
									icon.classList.add('bi-heart-fill');
								} else if (data.action === 'removed') {
									icon.classList.remove('bi-heart-fill');
									icon.classList.add('bi-heart');

									// If we are on the wishlist page, remove the product item from the list
									if (wishlistItem && document.getElementById('wishlist-page')) {
										wishlistItem.remove();
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
		
		<!-- Start of LiveChat (www.livechat.com) code -->
		<!-- <script>
			window.__lc = window.__lc || {};
			window.__lc.license = 18888336;
			window.__lc.integration_name = "manual_onboarding";
			window.__lc.product_name = "livechat";
			;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
		</script>
		<noscript><a href="https://www.livechat.com/chat-with/18888336/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript> -->
		<!-- End of LiveChat code -->
	</body>
</html>