<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,maximum-scale=2.0,minimum-scale=1.0">


		{{-- Page-specific Title --}}
		<title>{{ isset($pageTitle) ? $pageTitle . ' | ' : '' }}{{ $siteSettings->title ?? 'Wings Sportswear' }}</title>

		{{-- Page-specific Description --}}
		<meta name="description" content="{{ isset($pageDescription) ? $pageDescription : ($siteSettings->description ?? 'Innovative sportswear that blends cutting-edge technology with sleek design. For athletes and active individuals who demand more. Discover high-performance apparel that supports your journey to greatness.') }}">

		{{-- Page-specific Keywords --}}
		<meta name="keywords" content="{{ isset($pageKeywords) ? $pageKeywords : ($siteSettings->keywords ?? 'Wings, Sportswear, Jersey, Shop, Sports Shop, Sports Market, Buy Jersey, Sell Jersey') }}" />

		{{-- Site-wide Brand Name --}}
		<meta name="brand_name" content="{{ $siteSettings->title ?? 'Wings Sportswear' }}">

		{{-- Open Graph Tags --}}
		<meta property="og:type" content="website" />
		<meta property="og:title" content="{{ isset($pageTitle) ? $pageTitle . ' | ' : '' }}{{ $siteSettings->title ?? 'Wings Sportswear' }}" />
		<meta property="og:description" content="{{ isset($pageDescription) ? $pageDescription : $siteSettings->description }}" />
		<meta property="og:image" content="{{ isset($pageOgImage) ? $siteSettings->getImagePath('og_image') : $siteSettings->getImagePath('og_image') }}">
		<meta property="og:image:width" content="1200">
		<meta property="og:url" content="{{ request()->url() }}">
		<meta property="og:site_name" content="{{ $siteSettings->title ?? 'Wings Sportswear' }}">

		{{-- Other Static Meta Tags --}}
		<meta property="fb:app_id" content="">
		<meta property="fb:pages" content="">
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

								<!-- <li>
									<a href="#">
										<i class="fa-solid fa-heart"></i>
									</a>
								</li> -->
								<!-- Cart Icon with Badge -->
								<li>
									<a href="{{ route('cart.show') }}" id="cart-button" class="{{ session('cart') ? '' : 'disabled' }}">
										<i class="fa-solid fa-cart-shopping"></i>
										<span id="cart-count-badge" class="badge bg-danger" style="display: {{ session('cart') ? 'inline' : 'none' }}">{{ session('cart') ? count(session('cart')) : '' }}</span>
									</a>
								</li>
								<li>
									@if (Auth::check())
										<!-- Display user icon when logged in -->
										<a href="{{ route('dashboard') }}"><i class="fa-solid fa-user"></i></a>
									@else
										<!-- Link to the login page (sign-in route) -->
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
											alt="Footer Logo"
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


		</script>
	</body>
</html>