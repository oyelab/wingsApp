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
										><svg
											width="24"
											height="24"
											viewBox="0 0 24 24"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
										>
											<path
												d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
												stroke="currentColor"
												stroke-width="2.5"
												stroke-linecap="round"
												stroke-linejoin="round"
											/>
										</svg>
									</a>
								</li>
								<li>
									<a href="#">
										<svg
											width="24"
											height="24"
											viewBox="0 0 24 24"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
										>
											<path
												d="M12 21L10.55 19.7C8.86667 18.1833 7.475 16.875 6.375 15.775C5.275 14.675 4.4 13.6917 3.75 12.825C3.1 11.9417 2.64167 11.1333 2.375 10.4C2.125 9.66666 2 8.91666 2 8.14999C2 6.58333 2.525 5.27499 3.575 4.22499C4.625 3.17499 5.93333 2.64999 7.5 2.64999C8.36667 2.64999 9.19167 2.83333 9.975 3.19999C10.7583 3.56666 11.4333 4.08333 12 4.74999C12.5667 4.08333 13.2417 3.56666 14.025 3.19999C14.8083 2.83333 15.6333 2.64999 16.5 2.64999C18.0667 2.64999 19.375 3.17499 20.425 4.22499C21.475 5.27499 22 6.58333 22 8.14999C22 8.91666 21.8667 9.66666 21.6 10.4C21.35 11.1333 20.9 11.9417 20.25 12.825C19.6 13.6917 18.725 14.675 17.625 15.775C16.525 16.875 15.1333 18.1833 13.45 19.7L12 21ZM12 18.3C13.6 16.8667 14.9167 15.6417 15.95 14.625C16.9833 13.5917 17.8 12.7 18.4 11.95C19 11.1833 19.4167 10.5083 19.65 9.92499C19.8833 9.325 20 8.73333 20 8.14999C20 7.14999 19.6667 6.31666 19 5.65C18.3333 4.98333 17.5 4.64999 16.5 4.64999C15.7167 4.64999 14.9917 4.87499 14.325 5.32499C13.6583 5.75833 13.2 6.31666 12.95 6.99999H11.05C10.8 6.31666 10.3417 5.75833 9.675 5.32499C9.00833 4.87499 8.28333 4.64999 7.5 4.64999C6.5 4.64999 5.66667 4.98333 5 5.65C4.33333 6.31666 4 7.14999 4 8.14999C4 8.73333 4.11667 9.325 4.35 9.92499C4.58333 10.5083 5 11.1833 5.6 11.95C6.2 12.7 7.01667 13.5917 8.05 14.625C9.08333 15.6417 10.4 16.8667 12 18.3Z"
												fill="currentColor"
											/>
										</svg>
									</a>
								</li>
								<li>
									<a href="#">
										<svg
											width="24"
											height="24"
											viewBox="0 0 24 24"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
										>
											<g
												clip-path="url(#clip0_2010_1059)"
											>
												<path
													d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6M10 21C10 21.5523 9.55228 22 9 22C8.44772 22 8 21.5523 8 21C8 20.4477 8.44772 20 9 20C9.55228 20 10 20.4477 10 21ZM21 21C21 21.5523 20.5523 22 20 22C19.4477 22 19 21.5523 19 21C19 20.4477 19.4477 20 20 20C20.5523 20 21 20.4477 21 21Z"
													stroke="currentColor"
													stroke-width="2.5"
													stroke-linecap="round"
													stroke-linejoin="round"
												/>
											</g>
											<defs>
												<clipPath id="clip0_2010_1059">
													<rect
														width="24"
														height="24"
														fill="white"
													/>
												</clipPath>
											</defs>
										</svg>
									</a>
								</li>
								<li>
									<a href="#">
										<svg
											width="24"
											height="24"
											viewBox="0 0 24 24"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
										>
											<path
												d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
												stroke="currentColor"
												stroke-width="2.5"
												stroke-linecap="round"
												stroke-linejoin="round"
											/>
										</svg>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</header>

		@yield('content')
		
		@include('frontEnd.layouts.vendor-scripts')
		
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
												<a href="{{ 'https://www.' . strtolower($link['platform']) . '.com/' . $link['username'] }}" target="_blank">
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
	</body>
</html>