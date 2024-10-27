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
									<a href="#">NEW ARRIVALS</a>
								</li>
								<li>
									<a href="#">COLLECTIONS</a>
								</li>
								<li>
									<a href="#">WINGS EDITED</a>
								</li>
								<li>
									<a href="#">TRENDING</a>
								</li>
							</ul>
						</div>
						<div class="right-area">
							<ul class="d-flex align-items-center">
								<li>
									<a href="#"
										><i class="fa-solid fa-magnifying-glass"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa-solid fa-heart"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa-solid fa-cart-shopping"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa-solid fa-user"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</header>

		@yield('content')

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
										<li><a href="#">About Us</a></li>
										<li><a href="#">Contact Us</a></li>
										<li><a href="#">Privacy Policy</a></li>
										<li>
											<a href="#">Terms & Conditions</a>
										</li>
										<li>
											<a href="#"
												>Refund & Return Policy</a
											>
										</li>
									</ul>
								</div>
								<div class="footer-menu">
									<h2>Quick Links</h2>
									<ul>
										<li>
											<a href="#">Submit Your Idea</a>
										</li>
										<li>
											<a href="#">Affiliate Program</a>
										</li>
										<li><a href="#">Career</a></li>
										<li>
											<a href="#">Blog</a>
										</li>
										<li>
											<a href="#">Help</a>
										</li>
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
								<a href="#" target="_blank">
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
	</body>
</html>