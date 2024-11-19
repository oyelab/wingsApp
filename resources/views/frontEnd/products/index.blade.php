@extends('frontEnd.layouts.app')
@section('content')
<!-- breadcrumb section -->
<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb-content">
					<ul class="d-flex align-items-center">
						<li class="home-menu">
							<a href="/">Home</a>
						</li>
						<li>
							<a href="/">New Arrivals</a>
						</li>
						<li>
							<a href="/">Concept Jersey</a>
						</li>
						<li>
							HALA MADRID!! Real Madrid Concept Fan Jersey
							2024
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="product-details-top-block">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="product-image">
					<div class="product-thumb-slider">
						<div class="custom-navigation">
							<div class="prev-slider main-p-prev">
								<i class="bi bi-chevron-up"></i>
							</div>
						</div>
						<div class="swiper productGalleryThumb">
							<div class="swiper-wrapper">
								@foreach($product->imagePaths as $index => $imagePath)
								<div class="swiper-slide">
									<div class="thumb-image">
										<img
											src="{{ $imagePath }}"
											draggable="false"
											class="img-fluid"
											alt="Thumb Slider"
										/>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<div class="custom-navigation">
							<div class="next-slider main-p-next">
								<i class="bi bi-chevron-down"></i>
							</div>
						</div>
					</div>
					<div class="product-main-slider">
						<div class="swiper productMainImage">
							<div class="swiper-wrapper">
								@foreach($product->imagePaths as $index => $imagePath)
								<div class="swiper-slide">
									<div class="product-slider-img">
										<img
											src="{{ $imagePath }}"
											draggable="false"
											class="img-fluid"
											alt=""
										/>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<div class="navigation-area">
							<div class="navigation-item main-p-prev d-flex align-items-center justify-content-center">
								<i class="bi bi-chevron-left"></i>
							</div>
							<div class="navigation-item main-p-next d-flex align-items-center justify-content-center">
								<i class="bi bi-chevron-right"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="product-top-block-details">
					<h4>
						
							<span class="badge bg-success-subtle text-success mb-0">{{ $product->category_display }}</span>
						
					</h4>


					<h1>
						<span>{{ $product->title }}</span>
					</h1>
					<h5><strong>★ 5.0 Rating</strong> (10 Reviews)</h5>
					<div class="pricing-block">
					@if ($product->sale)
						<div class="discount-price">৳{{ $product->offerPrice }}</div>
						<div class="current-price text-muted text-decoration-line-through">৳{{ $product->price }}</div>
					@else
						<div class="current-price">৳{{ $product->price }}</div>
					@endif
						
					</div>
					<div class="availabel-size">
						<h2>Select Size</h2>
						<div class="form-group available_sizes">
							@foreach($product->availableSizes as $size)
							<div class="size_item">
								<input
									type="radio"
									name="size"
									id="size{{ $size->id }}"
									autocomplete="off"
									value="{{ $size->id }}"
								/>
								<label for="size{{ $size->id }}">{{ $size->name }}</label>
							</div>
							@endforeach
						</div>
					</div>
					<div class="action-button-wrap">
						<button id="addToCartBtn" class="add-to-cart" data-product-id="{{ $product->id }}">
							Add to Cart
						</button>
						<button id="checkoutBtn" class="buy-now">
							Checkout
						</button>
						<button class="favorite">
							Favorite
						</button>
					</div>
					<div class="size-guid-area">
						<div class="top-part d-flex align-items-center justify-content-between">
							<h2>Size Guide</h2>
							<ul
								class="nav nav-tabs"
								id="myTab"
								role="tablist"
							>
								<li
									class="nav-item"
									role="presentation"
								>
									<button
										class="nav-link active"
										id="in"
										data-bs-toggle="tab"
										data-bs-target="#in-pane"
										type="button"
										role="tab"
										aria-controls="in-pane"
										aria-selected="true"
									>
										in
									</button>
								</li>
								<li
									class="nav-item"
									role="presentation"
								>
									<button
										class="nav-link"
										id="cm"
										data-bs-toggle="tab"
										data-bs-target="#cm-pane"
										type="button"
										role="tab"
										aria-controls="cm-pane"
										aria-selected="false"
									>
										cm
									</button>
								</li>
							</ul>
						</div>
						<div class="size-chart-wrap">
							<div class="tab-content" id="myTabContent">
								<div
									class="tab-pane fade show active"
									id="in-pane"
									role="tabpanel"
									aria-labelledby="in"
									tabindex="0"
								>
									<table class="size-table">
										<tr>
											<th>SIZE</th>
											<th>CHEST</th>
											<th>LENGTH</th>
										</tr>
										<tr>
											<td>M</td>
											<td>38</td>
											<td>28</td>
										</tr>
										<tr>
											<td>L</td>
											<td>40</td>
											<td>29</td>
										</tr>
										<tr>
											<td>XL</td>
											<td>42</td>
											<td>30</td>
										</tr>
										<tr>
											<td>XXL</td>
											<td>44</td>
											<td>31</td>
										</tr>
									</table>
								</div>
								<div
									class="tab-pane fade"
									id="cm-pane"
									role="tabpanel"
									aria-labelledby="cm"
									tabindex="0"
								>
									<table class="size-table">
										<tr>
											<th>SIZE</th>
											<th>CHEST</th>
											<th>LENGTH</th>
										</tr>
										<tr>
											<td>M</td>
											<td>38</td>
											<td>28</td>
										</tr>
										<tr>
											<td>L</td>
											<td>40</td>
											<td>29</td>
										</tr>
										<tr>
											<td>XL</td>
											<td>42</td>
											<td>30</td>
										</tr>
										<tr>
											<td>XXL</td>
											<td>44</td>
											<td>31</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="social-share-wrap">
						<h2>Social Share:</h2>
						<div class="social-share-icon">
							<a href="#">
								<svg
									width="25"
									height="25"
									viewBox="0 0 25 25"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<path
										d="M11.9985 0.304551C5.73464 0.509373 0.46388 5.57531 0.0306499 11.828C-0.427408 18.4431 4.30337 24.0329 10.5585 24.9726V16.0014H8.55499C7.65377 16.0014 6.92386 15.2715 6.92386 14.3703C6.92386 13.469 7.65377 12.7391 8.55499 12.7391H10.5573V10.568C10.5573 6.97307 12.3088 5.39532 15.2967 5.39532C15.7399 5.39532 16.1185 5.40525 16.44 5.42139C17.2295 5.45987 17.8415 6.11778 17.8415 6.90852C17.8415 7.73153 17.1749 8.39814 16.3519 8.39814H15.8032C14.5346 8.39814 14.0914 9.60101 14.0914 10.9566V12.7404H16.4127C17.1464 12.7404 17.7074 13.3946 17.5957 14.1195L17.4617 14.9897C17.371 15.5731 16.8695 16.0039 16.2787 16.0039H14.0914V24.9999C20.1529 24.1769 24.8266 18.9955 24.8266 12.7118C24.8266 5.71807 19.0431 0.0761425 11.9985 0.304551Z"
										fill="currentColor"
									/>
								</svg>
							</a>
							<a href="#">
								<svg
									width="24"
									height="23"
									viewBox="0 0 24 23"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<path
										d="M7.0334 0.191406C3.60604 0.191406 0.82666 2.97078 0.82666 6.39815V16.3289C0.82666 19.7563 3.60604 22.5357 7.0334 22.5357H16.9642C20.3915 22.5357 23.1709 19.7563 23.1709 16.3289V6.39815C23.1709 2.97078 20.3915 0.191406 16.9642 0.191406H7.0334ZM19.4469 2.6741C20.1321 2.6741 20.6882 3.23023 20.6882 3.91545C20.6882 4.60067 20.1321 5.1568 19.4469 5.1568C18.7617 5.1568 18.2055 4.60067 18.2055 3.91545C18.2055 3.23023 18.7617 2.6741 19.4469 2.6741ZM11.9988 5.1568C15.4262 5.1568 18.2055 7.93618 18.2055 11.3635C18.2055 14.7909 15.4262 17.5703 11.9988 17.5703C8.57143 17.5703 5.79205 14.7909 5.79205 11.3635C5.79205 7.93618 8.57143 5.1568 11.9988 5.1568ZM11.9988 7.63949C11.0111 7.63949 10.0639 8.03185 9.36549 8.73024C8.6671 9.42863 8.27475 10.3759 8.27475 11.3635C8.27475 12.3512 8.6671 13.2984 9.36549 13.9968C10.0639 14.6952 11.0111 15.0876 11.9988 15.0876C12.9865 15.0876 13.9337 14.6952 14.6321 13.9968C15.3305 13.2984 15.7228 12.3512 15.7228 11.3635C15.7228 10.3759 15.3305 9.42863 14.6321 8.73024C13.9337 8.03185 12.9865 7.63949 11.9988 7.63949Z"
										fill="currentColor"
									/>
								</svg>
							</a>
							<a href="#">
								<svg
									width="22"
									height="23"
									viewBox="0 0 22 23"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<path
										d="M1.22544 0.191406C0.422285 0.191406 -0.0484959 1.09606 0.410803 1.75521L7.84434 12.3794L0.381709 21.1028C-0.101176 21.6664 0.298849 22.5357 1.04117 22.5357H1.86551C2.22922 22.5357 2.57521 22.3761 2.81106 22.0993L9.31359 14.4815L14.2087 21.4762C14.6742 22.139 15.4335 22.5357 16.2428 22.5357H20.3815C21.1846 22.5357 21.6554 21.6322 21.1961 20.9743L13.3528 9.74882L20.4615 1.42063C20.8736 0.936506 20.5297 0.191406 19.8941 0.191406H18.8443C18.4819 0.191406 18.1371 0.349814 17.9012 0.625393L11.8908 7.65162L7.42005 1.25334C6.95579 0.587978 6.19773 0.191406 5.38589 0.191406H1.22544Z"
										fill="currentColor"
									/>
								</svg>
							</a>
							<a href="#">
								<svg
									width="26"
									height="21"
									viewBox="0 0 26 21"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<path
										d="M24.6845 3.39474C24.399 2.32718 23.5574 1.48555 22.4898 1.20004C20.5533 0.681153 12.7899 0.681152 12.7899 0.681152C12.7899 0.681152 5.02655 0.681153 3.09005 1.20004C2.02249 1.48555 1.18086 2.32718 0.895348 3.39474C0.376465 5.33124 0.376465 10.6119 0.376465 10.6119C0.376465 10.6119 0.376465 15.8926 0.895348 17.8291C1.18086 18.8967 2.02249 19.7383 3.09005 20.0238C5.02655 20.5427 12.7899 20.5427 12.7899 20.5427C12.7899 20.5427 20.5533 20.5427 22.4898 20.0238C23.5586 19.7383 24.399 18.8967 24.6845 17.8291C25.2034 15.8926 25.2034 10.6119 25.2034 10.6119C25.2034 10.6119 25.2034 5.33124 24.6845 3.39474ZM10.3072 13.837V7.38691C10.3072 6.909 10.8249 6.61107 11.2383 6.84941L16.8243 10.0744C17.2377 10.3128 17.2377 10.9111 16.8243 11.1494L11.2383 14.3745C10.8249 14.614 10.3072 14.3149 10.3072 13.837Z"
										fill="currentColor"
									/>
								</svg>
							</a>
							<a href="#">
								<svg
									width="25"
									height="25"
									viewBox="0 0 25 25"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<path
										d="M21.3742 3.63426C18.7897 1.04853 15.2642 -0.256123 11.5625 0.0418004C6.58598 0.441514 2.22388 3.90239 0.764058 8.67662C-0.278674 12.0878 0.159522 15.6493 1.85769 18.5913L0.248899 23.9328C0.0949717 24.4455 0.56296 24.9283 1.0806 24.7906L6.67163 23.2922C8.48276 24.2804 10.5211 24.8005 12.5966 24.8017H12.6016C17.809 24.8017 22.6205 21.6164 24.2851 16.6821C25.9063 11.8706 24.7072 6.971 21.3742 3.63426ZM18.6693 16.8248C18.4111 17.5485 17.1461 18.2462 16.5776 18.2971C16.0091 18.3492 15.4765 18.554 12.8598 17.5225C9.71045 16.2811 7.72181 13.0524 7.56789 12.8463C7.41272 12.639 6.30295 11.1668 6.30295 9.64238C6.30295 8.11801 7.10362 7.36824 7.38789 7.05914C7.67216 6.7488 8.00732 6.67184 8.21463 6.67184C8.42069 6.67184 8.628 6.67184 8.80799 6.67929C9.02895 6.68798 9.2735 6.69915 9.50563 7.21431C9.78121 7.82753 10.3833 9.35936 10.4602 9.51453C10.5372 9.66969 10.5893 9.85093 10.4863 10.057C10.3833 10.2631 10.3311 10.3922 10.1772 10.5734C10.022 10.7546 9.85197 10.9768 9.71294 11.1159C9.55777 11.2698 9.39639 11.4386 9.57639 11.7477C9.75762 12.058 10.3783 13.0722 11.2994 13.8928C12.4836 14.9479 13.4804 15.2744 13.7908 15.4308C14.1011 15.586 14.2811 15.5599 14.4623 15.3526C14.6436 15.1465 15.2369 14.4489 15.443 14.1385C15.6491 13.8282 15.8564 13.8803 16.1406 13.9834C16.4249 14.0864 17.948 14.8362 18.2571 14.9914C18.5675 15.1465 18.7735 15.2235 18.8505 15.3526C18.9275 15.4804 18.9275 16.1011 18.6693 16.8248Z"
										fill="currentColor"
									/>
								</svg>
							</a>
							<a href="#">
								<svg
									width="32"
									height="25"
									viewBox="0 0 32 25"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<path
										d="M29.5153 12.9645C32.4826 9.99717 32.4826 5.19173 29.5153 2.22443C26.8894 -0.401495 22.7509 -0.742865 19.7311 1.41565L19.6471 1.47342C18.8908 2.01436 18.7175 3.06473 19.2584 3.81574C19.7994 4.56676 20.8498 4.74532 21.6008 4.20438L21.6848 4.14661C23.3706 2.94393 25.6762 3.133 27.1362 4.59827C28.7906 6.2526 28.7906 8.93104 27.1362 10.5854L21.2436 16.4885C19.5893 18.1428 16.9109 18.1428 15.2565 16.4885C13.7913 15.0232 13.6022 12.7176 14.8049 11.037L14.8626 10.953C15.4036 10.1967 15.225 9.14637 14.474 8.61068C13.723 8.07499 12.6674 8.2483 12.1317 8.99932L12.0739 9.08335C9.91015 12.0979 10.2515 16.2364 12.8774 18.8623C15.8447 21.8296 20.6502 21.8296 23.6175 18.8623L29.5153 12.9645ZM2.22669 11.7355C-0.740603 14.7028 -0.740603 19.5083 2.22669 22.4756C4.85262 25.1015 8.99108 25.4429 12.0109 23.2844L12.0949 23.2266C12.8512 22.6856 13.0245 21.6353 12.4836 20.8843C11.9426 20.1332 10.8922 19.9547 10.1412 20.4956L10.0572 20.5534C8.37136 21.7561 6.0658 21.567 4.60578 20.1017C2.95145 18.4421 2.95145 15.7637 4.60578 14.1094L10.4984 8.21154C12.1527 6.55721 14.8311 6.55721 16.4855 8.21154C17.9507 9.67681 18.1398 11.9824 16.9371 13.6682L16.8794 13.7522C16.3384 14.5085 16.517 15.5589 17.268 16.0946C18.019 16.6303 19.0746 16.4569 19.6103 15.7059L19.6681 15.6219C21.8319 12.6021 21.4905 8.46363 18.8646 5.8377C15.8973 2.87041 11.0918 2.87041 8.12452 5.8377L2.22669 11.7355Z"
										fill="currentColor"
									/>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="product-details-area">
					<div class="accordion" id="descriptionAccordion">
						<div class="accordion-item">
							<h2
								class="accordion-header"
								id="descriptionHeading"
							>
								<button
									class="accordion-button"
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#descriptioncollapse"
									aria-expanded="true"
									aria-controls="descriptioncollapse"
								>
									Description
									<svg
										xmlns="http://www.w3.org/2000/svg"
										viewBox="0 0 24 24"
										fill="rgba(30,30,30,1)"
									>
										<path
											d="M11.9999 10.8284L7.0502 15.7782L5.63599 14.364L11.9999 8L18.3639 14.364L16.9497 15.7782L11.9999 10.8284Z"
										></path>
									</svg>
								</button>
							</h2>
							<div
								id="descriptioncollapse"
								class="accordion-collapse collapse show"
								aria-labelledby="descriptionHeading"
								data-bs-parent="#descriptionAccordion"
							>
								<div class="accordion-body">
									<div class="product-description">
										{!! $product->description !!}
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion" id="productDetailsAccordion">
						<div class="accordion-item">
							<h2
								class="accordion-header"
								id="productDetailsHeading"
							>
								<button
									class="accordion-button"
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#productDetailsCollapse"
									aria-expanded="true"
									aria-controls="productDetailsCollapse"
								>
									Product Details
									<svg
										xmlns="http://www.w3.org/2000/svg"
										viewBox="0 0 24 24"
										fill="rgba(30,30,30,1)"
									>
										<path
											d="M11.9999 10.8284L7.0502 15.7782L5.63599 14.364L11.9999 8L18.3639 14.364L16.9497 15.7782L11.9999 10.8284Z"
										></path>
									</svg>
								</button>
							</h2>
							<div
								id="productDetailsCollapse"
								class="accordion-collapse collapse show"
								aria-labelledby="productDetailsHeading"
								data-bs-parent="#productDetailsAccordion"
							>
								<div class="accordion-body">
									<div class="product-description">
										<ul>
											@foreach($product->specifications() as $spec)
												<li>✔ {{ $spec->item }}</li> <!-- Adjust to the appropriate field of the Specification model -->
											@endforeach
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion" id="reviewAccordion">
						<div class="accordion-item">
							<h2
								class="accordion-header"
								id="reviewHeading"
							>
								<button
									class="accordion-button"
									type="button"
									data-bs-toggle="collapse"
									data-bs-target="#reviewCollapse"
									aria-expanded="true"
									aria-controls="reviewCollapse"
								>
									Review (10)
									<svg
										xmlns="http://www.w3.org/2000/svg"
										viewBox="0 0 24 24"
										fill="rgba(30,30,30,1)"
									>
										<path
											d="M11.9999 10.8284L7.0502 15.7782L5.63599 14.364L11.9999 8L18.3639 14.364L16.9497 15.7782L11.9999 10.8284Z"
										></path>
									</svg>
								</button>
							</h2>
							<div
								id="reviewCollapse"
								class="accordion-collapse collapse show"
								aria-labelledby="reviewHeading"
								data-bs-parent="#reviewAccordion"
							>
								<div class="accordion-body">
									<div class="product-description">
										<div class="review-analysis">
											<h2>4.7</h2>
											<div
												class="starts d-flex align-items-center"
											>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													viewBox="0 0 24 24"
													fill="rgba(30,30,30,1)"
												>
													<path
														d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
													></path>
												</svg>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													viewBox="0 0 24 24"
													fill="rgba(30,30,30,1)"
												>
													<path
														d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
													></path>
												</svg>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													viewBox="0 0 24 24"
													fill="rgba(30,30,30,1)"
												>
													<path
														d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
													></path>
												</svg>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													viewBox="0 0 24 24"
													fill="rgba(30,30,30,1)"
												>
													<path
														d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
													></path>
												</svg>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													viewBox="0 0 24 24"
													fill="rgba(30,30,30,1)"
												>
													<path
														d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
													></path>
												</svg>
											</div>
										</div>
										<div class="review-lists">
											<div class="list d-flex">
												<div class="user-wrap">
													<div
														class="starts d-flex align-items-center"
													>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
													</div>
													<h3>
														@faisalhasan
													</h3>
												</div>
												<div
													class="review-details"
												>
													<div
														class="review-details-top d-flex align-items-center justify-content-between"
													>
														<h3>
															Excellent
															Product
														</h3>
														<p>
															03 October,
															2024
														</p>
													</div>
													<p>
														Great brand very
														confortable. I
														will buy again i
														usually never
														order nothing
														online but this
														time i order
														this and looks
														great and feels
														good.
													</p>
												</div>
											</div>
											<div class="list d-flex">
												<div class="user-wrap">
													<div
														class="starts d-flex align-items-center"
													>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
													</div>
													<h3>
														@faisalhasan
													</h3>
												</div>
												<div
													class="review-details"
												>
													<div
														class="review-details-top d-flex align-items-center justify-content-between"
													>
														<h3>
															Excellent
															Product
														</h3>
														<p>
															03 October,
															2024
														</p>
													</div>
													<p>
														Great brand very
														confortable. I
														will buy again i
														usually never
														order nothing
														online but this
														time i order
														this and looks
														great and feels
														good.
													</p>
												</div>
											</div>
											<div class="list d-flex">
												<div class="user-wrap">
													<div
														class="starts d-flex align-items-center"
													>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
														<svg
															xmlns="http://www.w3.org/2000/svg"
															viewBox="0 0 24 24"
															fill="rgba(30,30,30,1)"
														>
															<path
																d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"
															></path>
														</svg>
													</div>
													<h3>
														@faisalhasan
													</h3>
												</div>
												<div
													class="review-details"
												>
													<div
														class="review-details-top d-flex align-items-center justify-content-between"
													>
														<h3>
															Excellent
															Product
														</h3>
														<p>
															03 October,
															2024
														</p>
													</div>
													<p>
														Great brand very
														confortable. I
														will buy again i
														usually never
														order nothing
														online but this
														time i order
														this and looks
														great and feels
														good.
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@if ($relatedProducts->isNotEmpty())
<section class="latest-arrivals-area section-buttom-padding">
	<div class="container">
		<div class="row">
			<div
				class="d-flex align-items-center justify-content-between mb-30"
			>
				<div class="section-title">
					<h2>You May Also Like</h2>
				</div>
				<div class="navigation-items d-flex align-items-center">
					<h3>Shop</h3>
					<div
						class="navigation-item tp-prev d-flex align-items-center justify-content-center"
					>
						<svg
							width="9"
							height="15"
							viewBox="0 0 9 15"
							fill="none"
							xmlns="http://www.w3.org/2000/svg"
						>
							<path
								d="M7.28125 15L0 7.5L7.28125 0L8.4375 1.17489L2.28125 7.5L8.4375 13.8251L7.28125 15Z"
								fill="currentColor"
							/>
						</svg>
					</div>
					<div
						class="navigation-item tp-next d-flex align-items-center justify-content-center"
					>
						<svg
							width="9"
							height="15"
							viewBox="0 0 9 15"
							fill="none"
							xmlns="http://www.w3.org/2000/svg"
						>
							<path
								d="M1.15625 15L8.4375 7.5L1.15625 0L0 1.17489L6.15625 7.5L0 13.8251L1.15625 15Z"
								fill="currentColor"
							/>
						</svg>
					</div>
				</div>
			</div>
		</div>
		<div class="swiper top-picks">
			<div class="swiper-wrapper">
				@foreach ($relatedProducts as $product)
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ $product->imagePaths[0] }}"
								class="img-fluid"
								alt="{{ $product->title }}"
								draggable="false"
							/>
							<a href="#" class="wishlist-icon">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="20"
									height="19"
									viewBox="0 0 20 19"
									fill="none"
								>
									<path
										d="M10 19L8.55 17.7C6.86667 16.1833 5.475 14.875 4.375 13.775C3.275 12.675 2.4 11.6917 1.75 10.825C1.1 9.94166 0.641667 9.13333 0.375 8.39999C0.125 7.66666 0 6.91666 0 6.14999C0 4.58333 0.525 3.27499 1.575 2.22499C2.625 1.17499 3.93333 0.649994 5.5 0.649994C6.36667 0.649994 7.19167 0.833327 7.975 1.19999C8.75833 1.56666 9.43333 2.08333 10 2.74999C10.5667 2.08333 11.2417 1.56666 12.025 1.19999C12.8083 0.833327 13.6333 0.649994 14.5 0.649994C16.0667 0.649994 17.375 1.17499 18.425 2.22499C19.475 3.27499 20 4.58333 20 6.14999C20 6.91666 19.8667 7.66666 19.6 8.39999C19.35 9.13333 18.9 9.94166 18.25 10.825C17.6 11.6917 16.725 12.675 15.625 13.775C14.525 14.875 13.1333 16.1833 11.45 17.7L10 19ZM10 16.3C11.6 14.8667 12.9167 13.6417 13.95 12.625C14.9833 11.5917 15.8 10.7 16.4 9.95C17 9.18333 17.4167 8.50833 17.65 7.92499C17.8833 7.325 18 6.73333 18 6.14999C18 5.14999 17.6667 4.31666 17 3.65C16.3333 2.98333 15.5 2.64999 14.5 2.64999C13.7167 2.64999 12.9917 2.87499 12.325 3.32499C11.6583 3.75833 11.2 4.31666 10.95 4.99999H9.05C8.8 4.31666 8.34167 3.75833 7.675 3.32499C7.00833 2.87499 6.28333 2.64999 5.5 2.64999C4.5 2.64999 3.66667 2.98333 3 3.65C2.33333 4.31666 2 5.14999 2 6.14999C2 6.73333 2.11667 7.325 2.35 7.92499C2.58333 8.50833 3 9.18333 3.6 9.95C4.2 10.7 5.01667 11.5917 6.05 12.625C7.08333 13.6417 8.4 14.8667 10 16.3Z"
										fill="currentColor"
									/>
								</svg>
							</a>
						</div>
						<div
							class="product-content d-flex justify-content-between"
						>
							<a href="{{ route('products.details', [
									'category' => $product->categories->first()->slug,
									'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
									'product' => $product->slug
								]) }}">
								<h3>
									{{ $product->title }}
								</h3>
							</a>
							<div class="product-price">
								@if($product->sale)
                                    <h4 >{{ $product->offerPrice }}</h4>
                                    <h5>{{ $product->price }}</h5>
                                @else
                                    <h4>{{ $product->price }}</h4>
                                @endif
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
@endif
@endsection

@section('scripts')
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

    document.getElementById('addToCartBtn').addEventListener('click', function () {
        const productId = this.getAttribute('data-product-id');
        const sizeId = document.querySelector('input[name="size"]:checked')?.value;

        if (!sizeId) {
            alert("Please select a size before adding to cart.");
            return;
        }

        // AJAX request to add the item to the cart
        addToCart(productId, sizeId)
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Show success message
            })
            .catch(error => console.error('Error:', error));
    });

    document.getElementById('checkoutBtn').addEventListener('click', function () {
        const productId = document.getElementById('addToCartBtn').getAttribute('data-product-id');
        const sizeId = document.querySelector('input[name="size"]:checked')?.value;

        if (!sizeId) {
            alert("Please select a size before proceeding to checkout.");
            return;
        }

        // Add product to cart before redirecting
        addToCart(productId, sizeId)
            .then(response => response.json())
            .then(data => {
                // Redirect to the checkout page after adding to cart
                window.location.href = "{{ route('checkout.show') }}";
            })
            .catch(error => console.error('Error:', error));
    });
</script>
@endsection