<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Wings</title>
		@include('frontEnd.layouts.head-css')
	</head>
	<body>
		<!-- Header -->
		<header class="header-area" id="wings-header-sticky">
			<div class="container">
				<div class="row">
					<div
						class="d-flex align-items-center justify-content-between"
					>
						<div class="wings-logo">
							<a href="/">
								<img
									src="{{ asset('frontEnd/images/logo.svg') }}"
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
									<span>hello@wingsapparels.com</span>
								</ul>
								<ul class="d-flex align-items-center">
									<li>Phone Number:</li>
									<span>01886424141</span>
								</ul>
								<ul class="d-flex align-items-center">
									<li>Address:</li>
									<span
										>South Mugda, Mugdapara,
										Dhaka-1214</span
									>
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
										<li>
											<a href="#">
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="25"
													height="25"
													viewBox="0 0 25 25"
													fill="none"
												>
													<path
														d="M11.9985 0.304551C5.73464 0.509373 0.46388 5.57531 0.0306499 11.828C-0.427408 18.4431 4.30337 24.0329 10.5585 24.9726V16.0014H8.55499C7.65377 16.0014 6.92386 15.2715 6.92386 14.3703C6.92386 13.469 7.65377 12.7391 8.55499 12.7391H10.5573V10.568C10.5573 6.97307 12.3088 5.39532 15.2967 5.39532C15.7399 5.39532 16.1185 5.40525 16.44 5.42139C17.2295 5.45987 17.8415 6.11778 17.8415 6.90852C17.8415 7.73153 17.1749 8.39814 16.3519 8.39814H15.8032C14.5346 8.39814 14.0914 9.60101 14.0914 10.9566V12.7404H16.4127C17.1464 12.7404 17.7074 13.3946 17.5957 14.1195L17.4617 14.9897C17.371 15.5731 16.8695 16.0039 16.2787 16.0039H14.0914V24.9999C20.1529 24.1769 24.8266 18.9955 24.8266 12.7118C24.8266 5.71807 19.0431 0.0761425 11.9985 0.304551Z"
														fill="currentColor"
													/>
												</svg>
											</a>
										</li>
										<li>
											<a href="#">
												<svg
													width="23"
													height="23"
													viewBox="0 0 23 23"
													fill="none"
													xmlns="http://www.w3.org/2000/svg"
												>
													<path
														d="M6.48115 0.19165C3.05379 0.19165 0.274414 2.97103 0.274414 6.39839V16.3292C0.274414 19.7565 3.05379 22.5359 6.48115 22.5359H16.4119C19.8393 22.5359 22.6187 19.7565 22.6187 16.3292V6.39839C22.6187 2.97103 19.8393 0.19165 16.4119 0.19165H6.48115ZM18.8946 2.67435C19.5799 2.67435 20.136 3.23047 20.136 3.91569C20.136 4.60092 19.5799 5.15704 18.8946 5.15704C18.2094 5.15704 17.6533 4.60092 17.6533 3.91569C17.6533 3.23047 18.2094 2.67435 18.8946 2.67435ZM11.4465 5.15704C14.8739 5.15704 17.6533 7.93642 17.6533 11.3638C17.6533 14.7911 14.8739 17.5705 11.4465 17.5705C8.01918 17.5705 5.23981 14.7911 5.23981 11.3638C5.23981 7.93642 8.01918 5.15704 11.4465 5.15704ZM11.4465 7.63974C10.4589 7.63974 9.51164 8.03209 8.81325 8.73048C8.11485 9.42888 7.7225 10.3761 7.7225 11.3638C7.7225 12.3515 8.11485 13.2987 8.81325 13.9971C9.51164 14.6955 10.4589 15.0878 11.4465 15.0878C12.4342 15.0878 13.3814 14.6955 14.0798 13.9971C14.7782 13.2987 15.1706 12.3515 15.1706 11.3638C15.1706 10.3761 14.7782 9.42888 14.0798 8.73048C13.3814 8.03209 12.4342 7.63974 11.4465 7.63974Z"
														fill="currentColor"
													/>
												</svg>
											</a>
										</li>
										<li>
											<a href="#">
												<svg
													width="22"
													height="23"
													viewBox="0 0 22 23"
													fill="none"
													xmlns="http://www.w3.org/2000/svg"
												>
													<path
														d="M1.12192 0.19165C0.31877 0.19165 -0.152012 1.0963 0.307287 1.75546L7.74083 12.3797L0.278193 21.103C-0.204691 21.6666 0.195333 22.5359 0.937659 22.5359H1.76199C2.12571 22.5359 2.47169 22.3763 2.70755 22.0995L9.21008 14.4817L14.1052 21.4764C14.5707 22.1393 15.33 22.5359 16.1393 22.5359H20.278C21.0811 22.5359 21.5519 21.6324 21.0926 20.9745L13.2493 9.74906L20.358 1.42088C20.7701 0.93675 20.4262 0.19165 19.7906 0.19165H18.7408C18.3783 0.19165 18.0335 0.350058 17.7977 0.625637L11.7873 7.65186L7.31654 1.25358C6.85227 0.588222 6.09422 0.19165 5.28238 0.19165H1.12192Z"
														fill="currentColor"
													/>
												</svg>
											</a>
										</li>
										<li>
											<a href="#">
												<svg
													width="26"
													height="21"
													viewBox="0 0 26 21"
													fill="none"
													xmlns="http://www.w3.org/2000/svg"
												>
													<path
														d="M25.0288 3.39486C24.7433 2.3273 23.9016 1.48567 22.8341 1.20016C20.8976 0.681275 13.1342 0.681274 13.1342 0.681274C13.1342 0.681274 5.37079 0.681275 3.43429 1.20016C2.36673 1.48567 1.5251 2.3273 1.23959 3.39486C0.720703 5.33136 0.720703 10.6121 0.720703 10.6121C0.720703 10.6121 0.720703 15.8928 1.23959 17.8293C1.5251 18.8968 2.36673 19.7384 3.43429 20.024C5.37079 20.5428 13.1342 20.5428 13.1342 20.5428C13.1342 20.5428 20.8976 20.5428 22.8341 20.024C23.9029 19.7384 24.7433 18.8968 25.0288 17.8293C25.5477 15.8928 25.5477 10.6121 25.5477 10.6121C25.5477 10.6121 25.5477 5.33136 25.0288 3.39486ZM10.6515 13.8371V7.38704C10.6515 6.90912 11.1691 6.61119 11.5825 6.84953L17.1686 10.0746C17.5819 10.3129 17.5819 10.9112 17.1686 11.1496L11.5825 14.3746C11.1691 14.6142 10.6515 14.315 10.6515 13.8371Z"
														fill="currentColor"
													/>
												</svg>
											</a>
										</li>
										<li>
											<a href="#">
												<svg
													width="25"
													height="25"
													viewBox="0 0 25 25"
													fill="none"
													xmlns="http://www.w3.org/2000/svg"
												>
													<path
														d="M21.1669 3.63426C18.5824 1.04853 15.057 -0.256123 11.3553 0.0418004C6.37871 0.441514 2.01661 3.90239 0.556783 8.67662C-0.485949 12.0878 -0.0477537 15.6493 1.65041 18.5913L0.0416234 23.9328C-0.112304 24.4455 0.355685 24.9283 0.873327 24.7906L6.46436 23.2922C8.27548 24.2804 10.3138 24.8005 12.3893 24.8017H12.3943C17.6017 24.8017 22.4132 21.6164 24.0778 16.6821C25.699 11.8706 24.4999 6.971 21.1669 3.63426ZM18.462 16.8248C18.2038 17.5485 16.9389 18.2462 16.3703 18.2971C15.8018 18.3492 15.2692 18.554 12.6525 17.5225C9.50318 16.2811 7.51454 13.0524 7.36061 12.8463C7.20544 12.639 6.09568 11.1668 6.09568 9.64238C6.09568 8.11801 6.89635 7.36824 7.18062 7.05914C7.46488 6.7488 7.80005 6.67184 8.00735 6.67184C8.21342 6.67184 8.42072 6.67184 8.60072 6.67929C8.82168 6.68798 9.06622 6.69915 9.29836 7.21431C9.57393 7.82753 10.176 9.35936 10.253 9.51453C10.3299 9.66969 10.3821 9.85093 10.279 10.057C10.176 10.2631 10.1239 10.3922 9.96992 10.5734C9.81476 10.7546 9.64469 10.9768 9.50566 11.1159C9.35049 11.2698 9.18912 11.4386 9.36911 11.7477C9.55035 12.058 10.171 13.0722 11.0921 13.8928C12.2763 14.9479 13.2732 15.2744 13.5835 15.4308C13.8938 15.586 14.0738 15.5599 14.2551 15.3526C14.4363 15.1465 15.0297 14.4489 15.2357 14.1385C15.4418 13.8282 15.6491 13.8803 15.9334 13.9834C16.2176 14.0864 17.7408 14.8362 18.0499 14.9914C18.3602 15.1465 18.5663 15.2235 18.6432 15.3526C18.7202 15.4804 18.7202 16.1011 18.462 16.8248Z"
														fill="currentColor"
													/>
												</svg>
											</a>
										</li>
									</ul>
								</div>
								<div class="footer-logo">
									<a href="/">
										<img
											src="{{ asset('frontEnd/images/footer-logo.png') }}"
											draggable="false"
											alt="Footer Logo"
										/>
									</a>
								</div>
								<p>
									Innovative sportswear that blends
									cutting-edge technology with sleek design.
									For athletes and active individuals who
									demand more. Discover high-performance
									apparel that supports your journey to
									greatness.
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