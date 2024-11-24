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
		<meta name="brand_name" content="{{ $siteSettings->title ?? 'Wings Sportswear' }}">

		{{-- Open Graph Tags --}}
		<meta property="og:type" content="website" />
		<!-- Open Graph Title -->

		<meta property="og:title" content="@yield('pageTitle'){{ isset($pageTitle) ? ' | ' . $pageTitle : '' }}{{ $siteSettings->title ?? 'Wings Sportswear' }}" />


		<meta property="og:description" content="@yield('pageDescription', isset($pageDescription) ? $pageDescription : $siteSettings->description)" />

		
		<meta property="og:image" content="@yield('pageOgImage', $siteSettings->getImagePath('og_image'))" />


		<meta property="og:image:width" content="1200">
		<meta property="og:url" content="{{ request()->url() }}">
		<meta property="og:site_name" content="{{ $siteSettings->title ?? 'Wings Sportswear' }}">

		{{-- Other Static Meta Tags --}}
		<meta property="fb:app_id" content="1081491186574205">
		<meta property="fb:pages" content="https://www.facebook.com/wingssportswear.shop">
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
			.nav-link {
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

			.nav-link:hover {
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
						<div class="menu-area">
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
									<a href="#">
										<i class="fa-solid fa-heart"></i>
									</a>
								</li>
								<!-- Cart Icon with Badge -->
								<li>
									<a href="{{ route('cart.show') }}" id="cart-button" class="{{ session('cart') ? '' : 'disabled' }}">
										<i class="fa-solid fa-cart-shopping"></i>
										<span id="cart-count-badge" class="badge bg-danger" style="display: {{ session('cart') ? 'inline' : 'none' }}">{{ session('cart') ? count(session('cart')) : '' }}</span>
									</a>
								</li>
								<li class="nav-item custom-dropdown">
									@if (Auth::check())
										<!-- User Avatar or First Letter -->
										<a class="nav-link" href="#" id="userDropdown" role="button">
											@if (Auth::user()->avatar)
												<!-- User's Avatar -->
												<img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="User Avatar" class="user-avatar">
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
							</ul>
						</div>
					</div>
				</div>
			</div>
		</header>

		@yield('content')
		
		<!-- Call to action -->
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
								<div class="newsletter-from">
									<form action="#">
										<input
											type="email"
											placeholder="Enter your email"
										/>
										<button type="submit">SUBSCRIBE</button>
									</form>
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
								<a href="https://oyelab.com" target="_blank">
									<img
										src="{{ asset('frontEnd/images/oyelab.png') }}"
										draggable="false"
										alt="Oyelab"
									/>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		
		@include('frontEnd.layouts.vendor-scripts')
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
				const userLink = dropdown.querySelector('.nav-link');
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
	</body>
</html>