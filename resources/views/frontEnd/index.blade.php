@extends('frontEnd.layouts.app')

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
						src="{{ $slider->sliderPath }}"
						class="img-fluid"
						alt=""
						loading="lazy"
					/>
				</a>
			</div>
			@endforeach
		</div>
		<div class="swiper-pagination"></div>
	</div>
</section>

<!-- Latest Arrivals -->
<section class="latest-arrivals-area section-padding">
    <div class="container">
        <div class="row">
            <div class="d-flex align-items-center justify-content-between mb-30">
                <div class="section-title">
                    <h3>{{ $titles['latest'] }}</h3> <!-- Adjusted title -->
                </div>
                <div class="navigation-items d-flex align-items-center">
                    <h3><a href="{{ route('shop.page', ['section' => 'latest']) }}">Shop</a></h3> <!-- Update this route if necessary -->
                    <div class="navigation-item la-prev d-flex align-items-center justify-content-center">
                        <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.28125 15L0 7.5L7.28125 0L8.4375 1.17489L2.28125 7.5L8.4375 13.8251L7.28125 15Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="navigation-item la-next d-flex align-items-center justify-content-center">
                        <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.15625 15L8.4375 7.5L1.15625 0L0 1.17489L6.15625 7.5L0 13.8251L1.15625 15Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper latest-arrival">
            <div class="swiper-wrapper">
				@foreach($data['latest'] as $product)
                <div class="swiper-slide">
                    <div class="product-item">
                        <div class="product-img">
							<a href="{{ route('products.details', [
									'category' => $product->categories->first()->slug,
									'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
									'product' => $product->slug
								]) }}">
                                <img src="{{ $product->imagePaths[0] }}" class="img-fluid" alt="{{ $product->title }}" draggable="false"/>
                            </a>
                            <a href="#" class="wishlist-icon">
                                <i class="bi bi-heart-fill"></i>
                            </a>
                        </div>
                        <div class="product-content d-flex justify-content-between">
							<a href="{{ route('products.details', [
									'category' => $product->categories->first()->slug,
									'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
									'product' => $product->slug
								]) }}">
                                <h3>{{ $product->title }}</h3>
                            </a>
                            <div class="product-price">
								@if($product->sale)
                                    <h4>{{ $product->offerPrice }}</h4>
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

<!-- Top Picks -->
<section class="latest-arrivals-area section-buttom-padding">
	<div class="container">
		<div class="row">
			<div
				class="d-flex align-items-center justify-content-between mb-30"
			>
				<div class="section-title">
					<h2>{{ $titles['topPicks'] }}</h2>
				</div>
				<div class="navigation-items d-flex align-items-center">
					<h3><a href="{{ route('shop.page', ['section' => 'topPicks']) }}">Shop</a></h3>
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
				@foreach($data['topPicks'] as $product)
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<a href="{{ route('products.details', [
									'category' => $product->categories->first()->slug,
									'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
									'product' => $product->slug
								]) }}">
                                <img src="{{ $product->imagePaths[0] }}" class="img-fluid" alt="{{ $product->title }}" draggable="false"/>
                            </a>
                            <a href="#" class="wishlist-icon">
                                <i class="bi bi-heart-fill"></i>
                            </a>
                        </div>
                        <div class="product-content d-flex justify-content-between">
							<a href="{{ route('products.details', [
									'category' => $product->categories->first()->slug,
									'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
									'product' => $product->slug
								]) }}">
                                <h3>{{ $product->title }}</h3>
                            </a>
                            <div class="product-price">
								@if($product->sale)
                                    <h4>{{ $product->offerPrice }}</h4>
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


<!-- Bulk Order -->
<section class="bulk-order-area section-buttom-padding">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bulk-banner">
					<a href="{{ route('collections') }}">
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
					<a href="{{ route('collections') }}">
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
					<h2>{{ $wingsEdited->title }}</h2>
					<p>
						{{ $wingsEdited->description }}
					</p>
				</div>
			</div>
		</div>
		<div class="wings-edited-item-wrap">
			<div class="row">
				<div class="col-12">
					<div class="explore-btn">
						<a href="{{ route('wings.edited') }}">
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
				@foreach ($wingsEdited->products as $product)
				<div class="col-lg-3 col-md-6">
					<div class="wings-edited-item">
						<a href="{{ route('products.details', [
								'category' => $product->categories->first()->slug,
								'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
								'product' => $product->slug
							]) }}">
							<img src="{{ $product->imagePaths[0] }}" class="img-fluid" alt="{{ $product->title }}" draggable="false"/>
						</a>
						<a href="#" class="wishlist-icon">
							<i class="bi bi-heart-fill"></i>
						</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="comfort-royalty">
					
					<a href="{{ route('wings.edited') }}">
						<img
							src="{{ $wingsEdited->imagePath }}"
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
					<h2>{{ $titles['trending'] }}</h2>
				</div>
				<div class="navigation-items d-flex align-items-center">
					<h3><a href="{{ route('shop.page', ['section' => 'trending']) }}">Shop</a></h3>
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
				@foreach($data['trending'] as $product)
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<a href="{{ route('products.details', [
									'category' => $product->categories->first()->slug,
									'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
									'product' => $product->slug
								]) }}">
                                <img src="{{ $product->imagePaths[0] }}" class="img-fluid" alt="{{ $product->title }}" draggable="false"/>
                            </a>
                            <a href="#" class="wishlist-icon">
                                <i class="bi bi-heart-fill"></i>
                            </a>
                        </div>
                        <div class="product-content d-flex justify-content-between">
							<a href="{{ route('products.details', [
									'category' => $product->categories->first()->slug,
									'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
									'product' => $product->slug
								]) }}">
                                <h3>{{ $product->title }}</h3>
                            </a>
                            <div class="product-price">
								@if($product->sale)
                                    <h4>{{ $product->offerPrice }}</h4>
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
								<!-- Showcase 1 -->
								<div class="wings-showcase-item">
									<a href="{{ route('showcase.show', $showcases->where('order', 1)->first()?->slug) }}">
										<img
											src="{{ $showcases->where('order', 1)->first()?->thumbnailImagePath }}"
											draggable="false"
											class="img-fluid"
											alt="Wings Showcase"
										/>
									</a>
								</div>
								<!-- Showcase 1 End -->

								<!-- Showcase 2 -->
								<div class="wings-showcase-item">
									<a href="{{ route('showcase.show', $showcases->where('order', 2)->first()?->slug) }}">
										<img
											src="{{ $showcases->where('order', 2)->first()?->thumbnailImagePath }}"
											draggable="false"
											class="img-fluid"
											alt="Wings Showcase"
										/>
									</a>
								</div>
								<!-- Showcase 2 End -->
							</div>

							<!-- Showcase 3 -->
							<div class="wings-showcase-item">
								<a href="{{ route('showcase.show', $showcases->where('order', 3)->first()?->slug) }}">
									<img
										src="{{ $showcases->where('order', 3)->first()?->thumbnailImagePath }}"
										draggable="false"
										class="img-fluid"
										alt="Wings Showcase"
									/>
								</a>
							</div>
							<!-- Showcase 3 End -->

						</div>

						<div class="flex-column wings-showcase-gap">
							<!-- Showcase 4 -->
							<div class="wings-showcase-item">
								<a href="{{ route('showcase.show', $showcases->where('order', 4)->first()?->slug) }}">
									<img
										src="{{ $showcases->where('order', 4)->first()?->thumbnailImagePath }}"
										draggable="false"
										class="img-fluid"
										alt="Wings Showcase"
									/>
								</a>
							</div>
							<!-- Showcase 4 End -->

							<!-- Showcase 5 -->
							<div class="wings-showcase-item">
								<a href="{{ route('showcase.show', $showcases->where('order', 5)->first()?->slug) }}">
									<img
										src="{{ $showcases->where('order', 5)->first()?->thumbnailImagePath }}"
										draggable="false"
										class="img-fluid"
										alt="Wings Showcase"
									/>
								</a>
							</div>
							<!-- Showcase 5 End -->
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="bulk-banner">
					<!-- <a href="#">
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
					</a> -->
					<a href="{{ route('showcases') }}">
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
					<h2>{{ $titles['hotDeals'] }}</h2>
				</div>
				<div class="navigation-items d-flex align-items-center">
					<h3><a href="{{ route('shop.page', ['section' => 'hotDeals']) }}">Shop</a></h3>
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
				@foreach($data['hotDeals'] as $product)
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img">
							<a href="{{ route('products.details', [
									'category' => $product->categories->first()->slug,
									'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
									'product' => $product->slug
								]) }}">
                                <img src="{{ $product->imagePaths[0] }}" class="img-fluid" alt="{{ $product->title }}" draggable="false"/>
                            </a>
                            <a href="#" class="wishlist-icon">
                                <i class="bi bi-heart-fill"></i>
                            </a>
                        </div>
                        <div class="product-content d-flex justify-content-between">
							<a href="{{ route('products.details', [
									'category' => $product->categories->first()->slug,
									'subcategory' => $product->subcategory->slug, // Using the model method to get subcategory slug
									'product' => $product->slug
								]) }}">
                                <h3>{{ $product->title }}</h3>
                            </a>
                            <div class="product-price">
								@if($product->sale)
                                    <h4>{{ $product->offerPrice }}</h4>
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
									<a 
										href="https://wa.me/{{ config('app.whatsapp_number') }}?text={{ 'Hello, Help me to get custom order!' }}" 
										target="_blank" 
										rel="noopener noreferrer"
										class="btn btn-success"
										>
										GET IN TOUCH
									</a>
								</div>
								<div class="get-idea">
									<a href="{{ route('help.index') }}#getIdea"
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
<!-- Official Manufacturer / Proud Kit Partners -->
<div class="official-manufacture">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="official-manufacture-content">
					<h3>Official Manufacturer</h3>
					@if($manufactureLogo && $manufactureLogo->filePath)
						<img
							src="{{ $manufactureLogo->filePath }}"
							class="img-fluid w-50"
							alt="Manufacture Logo"
							draggable="{{ $manufactureLogo->title }}"
						/>
					@endif
				</div>
			</div>

			<div class="col-md-8">
				<div class="proud-kit-partner-content">
					<h3>Proud Kit Partners</h3>
					<div
						class="partner_logo_wrap swiper proudKitPartner"
					>
						<div class="swiper-wrapper">
							@foreach ($partnerLogos as $partner)
							<div class="logo_item swiper-slide">
								<img
									draggable="false"
									src="{{ $partner->filePath }}"
									class="img-fluid"
									alt="{{ $partner->title }}"
								/>
							</div>
							@endforeach
							
						</div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Payment banner -->
<div class="we-accept-payments-wrap">
	<div class="container">
		<div class="row">
			<div class="col-12 d-flex align-items-center gap-style">
				<h2>
					We Accept <br />
					Payments
				</h2>
				@if($paymentBanner && $paymentBanner->filePath)
				<div class="payment-banner">
					<img
						src="{{ $paymentBanner->filePath }}"
						draggable="false"
						class="img-fluid"
						alt="{{ $paymentBanner }}"
					/>
				@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
@endsection