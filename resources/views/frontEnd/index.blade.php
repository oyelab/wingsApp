@extends('frontEnd.layouts.app')
@section('css')
    
@endsection
@section('content')
<!-- Hero -->
<section class="hero_slider_wrapper">
	<div class="swiper heroSlider">
		<div class="swiper-wrapper">
			@foreach ($sliders as $slider)
			<div class="swiper-slide">
				<a href="#">
					<img
						draggable="false"
						src="{{ asset( $slider->url ) }}"
						class="img-fluid"
						alt="{{ $slider->title }}"
					/>
				</a>
			</div>
			@endforeach
		</div>

		<div class="swiper-pagination"></div>
	</div>
</section>
<!-- Latest Arrivals -->
@if ($category = $categories->firstWhere('order', 1))
<section class="latest-arrivals-area section-padding">
	<div class="container">
		<div class="row">
			<div
				class="d-flex align-items-center justify-content-between mb-30"
			>
				<div class="section-title">
					<h3>{{ $category->title }}, Ready to Fly</h3>
				</div>
				<div class="navigation-items d-flex align-items-center">
					<h3><a href="{{ route('category.products', ['category' => $category->slug]) }}">Shop</a></h3>
					<div
						class="navigation-item la-prev d-flex align-items-center justify-content-center"
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
						class="navigation-item la-next d-flex align-items-center justify-content-center"
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
		<div class="swiper latest-arrival">
			<div class="swiper-wrapper">
				@foreach ($category->productMatrix as $product)
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<a href="{{ route('products.details', ['category' => $category->slug, 'product' => $product['slug']]) }}">
								<img
									src="{{ asset($product['imagePath']) }}"
									class="img-fluid"
									alt="{{ $product['title'] }}"
									draggable="false"
								/>
							</a>
							<a href="#" class="wishlist-icon">
								<i class="bi bi-heart-fill"></i>
							</a>
						</div>
						<div
							class="product-content d-flex justify-content-between"
						>
							<a href="{{ route('products.details', ['category' => $category->slug, 'product' => $product['slug']]) }}">
								<h3>
									{{ $product['title'] }}
								</h3>
							</a>
							<div class="product-price">
								@if (isset($product['sale']))
									<h4>{{ $product['sale'] }}</h4>
									<h5>{{ $product['price'] }}</h5>
								@else
									<h4>{{ $product['price'] }}</h4>
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

<!-- Top Picks -->
<section class="latest-arrivals-area section-buttom-padding">
	<div class="container">
		<div class="row">
			<div
				class="d-flex align-items-center justify-content-between mb-30"
			>
				<div class="section-title">
					<h2>Top Picks, Always in Style</h2>
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
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ asset('frontEnd/images/product-image.png') }}"
								class="img-fluid"
								alt="Product"
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
							<a href="#">
								<h3>
									Hala Madrid - Real Madrid Concept
									Fan Jersey
								</h3>
							</a>
							<div class="product-price">
								<h4>Tk. 599</h4>
								<h5>Tk. 599</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ asset('frontEnd/images/product-image.png') }}"
								class="img-fluid"
								alt="Product"
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
							<a href="#">
								<h3>
									Hala Madrid - Real Madrid Concept
									Fan Jersey
								</h3>
							</a>
							<div class="product-price">
								<h4>Tk. 599</h4>
								<h5>Tk. 599</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ asset('frontEnd/images/product-image.png') }}"
								class="img-fluid"
								alt="Product"
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
							<a href="#">
								<h3>
									Hala Madrid - Real Madrid Concept
									Fan Jersey
								</h3>
							</a>
							<div class="product-price">
								<h4>Tk. 599</h4>
								<h5>Tk. 599</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ asset('frontEnd/images/product-image.png') }}"
								class="img-fluid"
								alt="Product"
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
							<a href="#">
								<h3>
									Hala Madrid - Real Madrid Concept
									Fan Jersey
								</h3>
							</a>
							<div class="product-price">
								<h4>Tk. 599</h4>
								<h5>Tk. 599</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Bulk Order -->
<section class="bulk-order-area section-buttom-padding">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bulk-banner">
					<a href="#">
						Explore More
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="24"
							height="24"
							viewBox="0 0 24 24"
							fill="none"
						>
							<mask
								id="mask0_397_3859"
								style="mask-type: alpha"
								maskUnits="userSpaceOnUse"
								x="0"
								y="0"
								width="24"
								height="24"
							>
								<rect
									width="24"
									height="24"
									fill="#D9D9D9"
								/>
							</mask>
							<g mask="url(#mask0_397_3859)">
								<path
									d="M15.3256 13H4V11H15.3256L10.1163 5.4L11.4419 4L18.8837 12L11.4419 20L10.1163 18.6L15.3256 13Z"
									fill="currentColor"
								/>
							</g>
						</svg>
					</a>
					<a href="#">
						<img
							src="{{ asset('frontEnd/images/bulk-order.png') }}"
							draggable="false"
							class="img-fluid"
							alt="Bulk Order"
						/>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Wings Edited -->
<section class="wings-edited-area section-padding bg-black">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="wings-edited-heading">
					<h2>Wings Edited</h2>
					<p>
						Discover our exclusive selection of meticulously
						crafted products, refined to reflect the essence
						of Wings. Every piece in this collection is
						carefully edited to offer you the finest quality
						and unique style that stands out.
					</p>
				</div>
			</div>
		</div>
		<div class="wings-edited-item-wrap">
			<div class="row">
				<div class="col-12">
					<div class="explore-btn">
						<a href="#">
							Explore All
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="24"
								height="24"
								viewBox="0 0 24 24"
								fill="none"
							>
								<mask
									id="mask0_397_3859"
									style="mask-type: alpha"
									maskUnits="userSpaceOnUse"
									x="0"
									y="0"
									width="24"
									height="24"
								>
									<rect
										width="24"
										height="24"
										fill="#D9D9D9"
									/>
								</mask>
								<g mask="url(#mask0_397_3859)">
									<path
										d="M15.3256 13H4V11H15.3256L10.1163 5.4L11.4419 4L18.8837 12L11.4419 20L10.1163 18.6L15.3256 13Z"
										fill="currentColor"
									/>
								</g>
							</svg>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="wings-edited-item">
						<img
							src="{{ asset('frontEnd/images/wings-edited.png') }}"
							draggable="false"
							class="img-fluid"
							alt="Wings Edited"
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
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="wings-edited-item">
						<img
							src="{{ asset('frontEnd/images/wings-edited.png') }}"
							draggable="false"
							class="img-fluid"
							alt="Wings Edited"
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
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="wings-edited-item">
						<img
							src="{{ asset('frontEnd/images/wings-edited.png') }}"
							draggable="false"
							class="img-fluid"
							alt="Wings Edited"
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
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="wings-edited-item">
						<img
							src="{{ asset('frontEnd/images/wings-edited.png') }}"
							draggable="false"
							class="img-fluid"
							alt="Wings Edited"
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
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="comfort-royalty">
					<a href="#">
						Explore More
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="24"
							height="24"
							viewBox="0 0 24 24"
							fill="none"
						>
							<mask
								id="mask0_397_3859"
								style="mask-type: alpha"
								maskUnits="userSpaceOnUse"
								x="0"
								y="0"
								width="24"
								height="24"
							>
								<rect
									width="24"
									height="24"
									fill="#D9D9D9"
								/>
							</mask>
							<g mask="url(#mask0_397_3859)">
								<path
									d="M15.3256 13H4V11H15.3256L10.1163 5.4L11.4419 4L18.8837 12L11.4419 20L10.1163 18.6L15.3256 13Z"
									fill="currentColor"
								/>
							</g>
						</svg>
					</a>
					<a href="#">
						<img
							src="{{ asset('frontEnd/images/comfort-royalty.png') }}"
							draggable="false"
							class="img-fluid"
							alt="Bulk Order"
						/>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- On Trend -->
<section class="latest-arrivals-area section-padding">
	<div class="container">
		<div class="row">
			<div
				class="d-flex align-items-center justify-content-between mb-30"
			>
				<div class="section-title">
					<h2>On Trend, On Point</h2>
				</div>
				<div class="navigation-items d-flex align-items-center">
					<h3>Shop</h3>
					<div
						class="navigation-item ot-prev d-flex align-items-center justify-content-center"
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
						class="navigation-item ot-next d-flex align-items-center justify-content-center"
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
		<div class="swiper on-trend">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ asset('frontEnd/images/product-image.png') }}"
								class="img-fluid"
								alt="Product"
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
							<a href="#">
								<h3>
									Hala Madrid - Real Madrid Concept
									Fan Jersey
								</h3>
							</a>
							<div class="product-price">
								<h4>Tk. 599</h4>
								<h5>Tk. 599</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ asset('frontEnd/images/product-image.png') }}"
								class="img-fluid"
								alt="Product"
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
							<a href="#">
								<h3>
									Hala Madrid - Real Madrid Concept
									Fan Jersey
								</h3>
							</a>
							<div class="product-price">
								<h4>Tk. 599</h4>
								<h5>Tk. 599</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ asset('frontEnd/images/product-image.png') }}"
								class="img-fluid"
								alt="Product"
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
							<a href="#">
								<h3>
									Hala Madrid - Real Madrid Concept
									Fan Jersey
								</h3>
							</a>
							<div class="product-price">
								<h4>Tk. 599</h4>
								<h5>Tk. 599</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ asset('frontEnd/images/product-image.png') }}"
								class="img-fluid"
								alt="Product"
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
							<a href="#">
								<h3>
									Hala Madrid - Real Madrid Concept
									Fan Jersey
								</h3>
							</a>
							<div class="product-price">
								<h4>Tk. 599</h4>
								<h5>Tk. 599</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Wings Showcase -->
<section class="wings-showcase-area section-buttom-padding">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div
					class="wings-edited-heading wings-showcase-heading"
				>
					<h2>Wings Showcase</h2>
					<p>
						Step into the world of Wings creations. From
						concept to reality, this is where our passion
						for design comes to life. Explore our curated
						showcase of past projects, each crafted with
						precision and innovation. Let our journey
						inspire your next big idea!
					</p>
				</div>
			</div>
		</div>
		<div class="wings-showcase-wrappers">
			<div class="row">
				<div class="col-12">
					<div class="wings-showcase-items">
						<div>
							<div class="wings-showcase-gap">
								<div class="wings-showcase-item">
									<img
										src="{{ asset('frontEnd/images/wing-showcase-1.png') }}"
										draggable="false"
										class="img-fluid"
										alt="Wings Showcase"
									/>
								</div>
								<div class="wings-showcase-item">
									<img
										src="{{ asset('frontEnd/images/wing-showcase-2.png') }}"
										draggable="false"
										class="img-fluid"
										alt="Wings Showcase"
									/>
								</div>
							</div>
							<div class="wings-showcase-item">
								<img
									src="{{ asset('frontEnd/images/wing-showcase-3.png') }}"
									draggable="false"
									class="img-fluid"
									alt="Wings Showcase"
								/>
							</div>
						</div>
						<div class="flex-column wings-showcase-gap">
							<div class="wings-showcase-item">
								<img
									src="{{ asset('frontEnd/images/wing-showcase-4.png') }}"
									draggable="false"
									class="img-fluid"
									alt="Wings Showcase"
								/>
							</div>
							<div class="wings-showcase-item">
								<img
									src="{{ asset('frontEnd/images/wing-showcase-5.png') }}"
									draggable="false"
									class="img-fluid"
									alt="Wings Showcase"
								/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="bulk-banner">
					<a href="#">
						Explore More
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="24"
							height="24"
							viewBox="0 0 24 24"
							fill="none"
						>
							<mask
								id="mask0_397_3859"
								style="mask-type: alpha"
								maskUnits="userSpaceOnUse"
								x="0"
								y="0"
								width="24"
								height="24"
							>
								<rect
									width="24"
									height="24"
									fill="#D9D9D9"
								/>
							</mask>
							<g mask="url(#mask0_397_3859)">
								<path
									d="M15.3256 13H4V11H15.3256L10.1163 5.4L11.4419 4L18.8837 12L11.4419 20L10.1163 18.6L15.3256 13Z"
									fill="currentColor"
								/>
							</g>
						</svg>
					</a>
					<a href="#">
						<img
							src="{{ asset('frontEnd/images/showcase-banner.png') }}"
							draggable="false"
							class="img-fluid"
							alt="Showcase banner"
						/>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Hot Deals -->
<section class="latest-arrivals-area section-buttom-padding">
	<div class="container">
		<div class="row">
			<div
				class="d-flex align-items-center justify-content-between mb-30"
			>
				<div class="section-title">
					<h2>Hot Deals, Just for You</h2>
				</div>
				<div class="navigation-items d-flex align-items-center">
					<h3>Shop</h3>
					<div
						class="navigation-item hd-prev d-flex align-items-center justify-content-center"
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
						class="navigation-item hd-next d-flex align-items-center justify-content-center"
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
		<div class="swiper hot-deals">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ asset('frontEnd/images/product-image.png') }}"
								class="img-fluid"
								alt="Product"
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
							<a href="#">
								<h3>
									Hala Madrid - Real Madrid Concept
									Fan Jersey
								</h3>
							</a>
							<div class="product-price">
								<h4>Tk. 599</h4>
								<h5>Tk. 599</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ asset('frontEnd/images/product-image.png') }}"
								class="img-fluid"
								alt="Product"
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
							<a href="#">
								<h3>
									Hala Madrid - Real Madrid Concept
									Fan Jersey
								</h3>
							</a>
							<div class="product-price">
								<h4>Tk. 599</h4>
								<h5>Tk. 599</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ asset('frontEnd/images/product-image.png') }}"
								class="img-fluid"
								alt="Product"
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
							<a href="#">
								<h3>
									Hala Madrid - Real Madrid Concept
									Fan Jersey
								</h3>
							</a>
							<div class="product-price">
								<h4>Tk. 599</h4>
								<h5>Tk. 599</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ asset('frontEnd/images/product-image.png') }}"
								class="img-fluid"
								alt="Product"
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
							<a href="#">
								<h3>
									Hala Madrid - Real Madrid Concept
									Fan Jersey
								</h3>
							</a>
							<div class="product-price">
								<h4>Tk. 599</h4>
								<h5>Tk. 599</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Custom Order -->
<section class="bulk-order-area section-buttom-padding">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bulk-banner">
					<a href="#">
						Explore More
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="24"
							height="24"
							viewBox="0 0 24 24"
							fill="none"
						>
							<mask
								id="mask0_397_3859"
								style="mask-type: alpha"
								maskUnits="userSpaceOnUse"
								x="0"
								y="0"
								width="24"
								height="24"
							>
								<rect
									width="24"
									height="24"
									fill="#D9D9D9"
								/>
							</mask>
							<g mask="url(#mask0_397_3859)">
								<path
									d="M15.3256 13H4V11H15.3256L10.1163 5.4L11.4419 4L18.8837 12L11.4419 20L10.1163 18.6L15.3256 13Z"
									fill="currentColor"
								/>
							</g>
						</svg>
					</a>
					<div
						class="custom-order-wrap"
						style="
							background-image: url('{{ asset('frontEnd/images/custom-order.png') }}');
						"
					>
						<div class="custom-order-content">
							<h3>Make it truly yours</h3>
							<h2>Custom Order</h2>
							<p>
								Bring your unique vision to life with
								Wings Custom. Whether it's a special
								design or personalized touch, our team
								is here to turn your ideas into reality.
							</p>
							<div class="custom-order-button-group">
								<div class="get-in-touch">
									<a href="#">GET IN TOUCH</a>
								</div>
								<div class="get-idea">
									<a href="#"
										>Get Idea
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="17"
											height="19"
											viewBox="0 0 17 19"
											fill="none"
										>
											<path
												d="M2.10841 3.48506H12.7134L0 16.4779L1.74651 18.2628L14.46 5.26995V16.1081H16.9303V0.960449H2.10841V3.48506Z"
												fill="currentColor"
											/>
										</svg>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('scripts')
@endsection