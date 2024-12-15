@extends('frontEnd.layouts.app')

@section('content')

<!-- Hero -->
<section class="hero_slider_wrapper">
	<div class="swiper heroSlider">
		<div class="swiper-wrapper">
			@foreach ($sliders as $slider)
			<div class="swiper-slide">
				<a href="#">
					<div class="product_img">
						<img
							draggable="false"
							src="{{ $slider->sliderPath }}"
							class="img-fluid"
							alt=""
							loading="lazy"
						/>
					</div>
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
						<i class="bi bi-chevron-left"></i>
                    </div>
                    <div class="navigation-item la-next d-flex align-items-center justify-content-center">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper latest-arrival">
            <div class="swiper-wrapper">
				@foreach($data['latest'] as $product)
                <div class="swiper-slide">
                    <div class="product-item">
                        <div class="product-img product_img">
							<a href="{{ route('sections.products.details', [
									'section' => 'latest',
									$product]) }}">
                                <img src="{{ $product->thumbnail }}" class="img-fluid" alt="{{ $product->title }}" draggable="false" loading="lazy" oncontextmenu="return false;"/>
                            </a>
							<a href="#" class="wishlist-icon" data-product-id="{{ $product->id }}">
								<i class="bi {{ session('wishlist') && in_array($product->id, session('wishlist')) ? 'bi-heart-fill' : 'bi-heart' }} fs-4"></i>
							</a>
                        </div>
                        <div class="product-content d-flex justify-content-between">
							<a href="{{ route('sections.products.details', [
									'section' => 'latest',
									'slug' => $product->slug, // Using the model method to get subcategory slug
								]) }}">
                                <h3>{{ $product->title }}</h3>
                            </a>
                            <div class="product-price">
								@if($product->sale)
                                    <h4>৳{{ $product->offerPrice }}</h4>
                                    <h5>৳{{ $product->price }}</h5>
                                @else
                                    <h4>৳{{ $product->price }}</h4>
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
					<div class="navigation-item tp-prev d-flex align-items-center justify-content-center">
						<i class="bi bi-chevron-left"></i>
                    </div>
                    <div class="navigation-item tp-next d-flex align-items-center justify-content-center">
                        <i class="bi bi-chevron-right"></i>
                    </div>
				</div>
			</div>
		</div>
		<div class="swiper top-picks">
			<div class="swiper-wrapper">
				@foreach($data['topPicks'] as $product)
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img product_img">
							<a href="{{ route('sections.products.details', [
									'section' => 'topPicks',
									$product]) }}">
                                <img src="{{ $product->thumbnail }}" class="img-fluid" alt="{{ $product->title }}" draggable="false" loading="lazy" oncontextmenu="return false;"/>
                            </a>
                            <a href="#" class="wishlist-icon" data-product-id="{{ $product->id }}">
								<i class="bi {{ session('wishlist') && in_array($product->id, session('wishlist')) ? 'bi-heart-fill' : 'bi-heart' }} fs-4"></i>
							</a>
                        </div>
                        <div class="product-content d-flex justify-content-between">
							<a href="{{ route('sections.products.details', [
									'section' => 'topPicks',
									$product]) }}">
                                <h3>{{ $product->title }}</h3>
                            </a>
                            <div class="product-price">
								@if($product->sale)
                                    <h4>৳{{ $product->offerPrice }}</h4>
                                    <h5>৳{{ $product->price }}</h5>
                                @else
                                    <h4>৳{{ $product->price }}</h4>
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
					<a href="{{ route('shop.page', ['section' => 'bulks']) }}">
						Explore More
						<i class="bi bi-arrow-right"></i>
					</a>
					<a href="{{ route('shop.page', ['section' => 'bulks']) }}">
					@if (!empty($bulksData->imagePath))
						<img
							src="{{ $bulksData->imagePath }}"
							draggable="false"
							class="img-fluid"
							alt="{{ $bulksData->title }}"
							loading="lazy"
						/>
					@else
						<img
							src="{{ asset('frontEnd/images/bulk-order.png') }}"
							draggable="false"
							class="img-fluid"
							alt="Default Bulk Order Image"
							loading="lazy"
						/>
					@endif
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
							<i class="bi bi-arrow-right"></i>
						</a>
					</div>
				</div>
				@foreach ($wingsEdited->products as $product)
				<div class="col-lg-3 col-md-6 col-6">
					<div class="wings-edited-item product_img">
						<a href="{{ route('products.details', [
								'category' => $product->categories->first()->slug, $product]) }}">
							<img src="{{ $product->thumbnail }}" class="img-fluid" alt="{{ $product->title }}" draggable="false" loading="lazy" oncontextmenu="return false;"/>
						</a>
						<a href="#" class="wishlist-icon" data-product-id="{{ $product->id }}">
							<i class="bi {{ session('wishlist') && in_array($product->id, session('wishlist')) ? 'bi-heart-fill' : 'bi-heart' }} fs-4"></i>
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
							alt="{{ $wingsEdited->title }}"
							loading="lazy"
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
					<div class="navigation-item ot-prev d-flex align-items-center justify-content-center">
						<i class="bi bi-chevron-left"></i>
                    </div>
                    <div class="navigation-item ot-next d-flex align-items-center justify-content-center">
                        <i class="bi bi-chevron-right"></i>
                    </div>
				</div>
			</div>
		</div>
		<div class="swiper on-trend">
			<div class="swiper-wrapper">
				@foreach($data['trending'] as $product)
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img product_img">
							<a href="{{ route('sections.products.details', [
									'section' => 'trending',
									$product]) }}">
                                <img src="{{ $product->thumbnail }}" class="img-fluid" alt="{{ $product->title }}" draggable="false" loading="lazy" oncontextmenu="return false;"/>
                            </a>
							<a href="#" class="wishlist-icon" data-product-id="{{ $product->id }}">
								<i class="bi {{ session('wishlist') && in_array($product->id, session('wishlist')) ? 'bi-heart-fill' : 'bi-heart' }} fs-4"></i>
							</a>
                        </div>
                        <div class="product-content d-flex justify-content-between">
							<a href="{{ route('sections.products.details', [
									'section' => 'trending',
									$product]) }}">
                                <h3>{{ $product->title }}</h3>
                            </a>
                            <div class="product-price">
								@if($product->sale)
                                    <h4>৳{{ $product->offerPrice }}</h4>
                                    <h5>৳{{ $product->price }}</h5>
                                @else
                                    <h4>৳{{ $product->price }}</h4>
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
								@if ($showcase1 = $showcases->where('order', 1)->first())
									<div class="wings-showcase-item showcase-1 product_img">
										<a href="{{ route('showcase.show', $showcase1->slug) }}">
											<img
												src="{{ $showcase1->thumbnailImagePath }}"
												draggable="false"
												class="img-fluid left-top-border-radius"
												alt="{{ $showcase1->title }}"
												loading="lazy"
											/>
										</a>
									</div>
								@else
									<div class="wings-showcase-item showcase-1 product_img">
										<img
											src="{{ asset('frontEnd/images/wing-showcase-1.png') }}"
											draggable="false"
											class="img-fluid left-top-border-radius"
											alt="Wings Showcase"
											loading="lazy"
										/>
									</div>
								@endif
								<!-- Showcase 1 End -->

								<!-- Showcase 2 -->
								@if ($showcase2 = $showcases->where('order', 2)->first())
									<div class="wings-showcase-item showcase-2 product_img">
										<a href="{{ route('showcase.show', $showcase2->slug) }}">
											<img
												src="{{ $showcase2->thumbnailImagePath }}"
												class="img-fluid"
												alt="Wings Showcase"
												loading="lazy"
											/>
										</a>
									</div>
								@else
									<div class="wings-showcase-item showcase-2 product_img">
										<img
											src="{{ asset('frontEnd/images/wing-showcase-2.png') }}"
											class="img-fluid"
											alt="Wings Showcase"
											loading="lazy"
										/>
									</div>
								@endif
								<!-- Showcase 2 End -->
							</div>

							<!-- Showcase 3 -->
							@if ($showcase3 = $showcases->where('order', 3)->first())
								<div class="wings-showcase-item showcase-3 product_img">
									<a href="{{ route('showcase.show', $showcase3->slug) }}">
										<img
											src="{{ $showcase3->thumbnailImagePath }}"
											class="img-fluid left-bottom-border-radius"
											alt="Wings Showcase"
											loading="lazy"
										/>
									</a>
								</div>
							@else
								<div class="wings-showcase-item showcase-3">
									<img
										src="{{ asset('frontEnd/images/wing-showcase-3.png') }}"
										class="img-fluid left-bottom-border-radius"
										alt="Wings Showcase"
										loading="lazy"
									/>
								</div>
							@endif
							<!-- Showcase 3 End -->
						</div>

						<div class="flex-column wings-showcase-gap">
							<!-- Showcase 4 -->
							@if ($showcase4 = $showcases->where('order', 4)->first())
								<div class="wings-showcase-item showcase-4 product_img">
									<a href="{{ route('showcase.show', $showcase4->slug) }}">
										<img
											src="{{ $showcase4->thumbnailImagePath }}"
											class="img-fluid right-top-border-radius"
											alt="Wings Showcase"
										/>
									</a>
								</div>
							@else
								<div class="wings-showcase-item showcase-4 product_img">
									<img
										src="{{ asset('frontEnd/images/wing-showcase-4.png') }}"
										class="img-fluid right-top-border-radius"
										alt="Wings Showcase"
										loading="lazy"
									/>
								</div>
							@endif
							<!-- Showcase 4 End -->

							<!-- Showcase 5 -->
							@if ($showcase5 = $showcases->where('order', 5)->first())
								<div class="wings-showcase-item showcase-5 product_img">
									<a href="{{ route('showcase.show', $showcase5->slug) }}">
										<img
											src="{{ $showcase5->thumbnailImagePath }}"
											class="img-fluid right-bottom-border-radius"
											alt="Wings Showcase"
											loading="lazy"
										/>
									</a>
								</div>
							@else
								<div class="wings-showcase-item showcase-5 product_img">
									<img
										src="{{ asset('frontEnd/images/wing-showcase-5.png') }}"
										class="img-fluid right-bottom-border-radius"
										alt="Wings Showcase"
										loading="lazy"
									/>
								</div>
							@endif
							<!-- Showcase 5 End -->
						</div>
					</div>
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
					<div class="navigation-item hd-prev d-flex align-items-center justify-content-center">
						<i class="bi bi-chevron-left"></i>
                    </div>
                    <div class="navigation-item hd-next d-flex align-items-center justify-content-center">
                        <i class="bi bi-chevron-right"></i>
                    </div>
				</div>
			</div>
		</div>
		<div class="swiper hot-deals">
			<div class="swiper-wrapper">
				@foreach($data['hotDeals'] as $product)
				<div class="swiper-slide">
					<div class="product-item">
						<div class="product-img product_img">
							<a href="{{ route('sections.products.details', [
									'section' => 'hotDeals',
									$product]) }}">
                                <img src="{{ $product->thumbnail }}" class="img-fluid" alt="{{ $product->title }}" draggable="false" loading="lazy" oncontextmenu="return false;"/>
                            </a>
                            <a href="#" class="wishlist-icon" data-product-id="{{ $product->id }}">
								<i class="bi {{ session('wishlist') && in_array($product->id, session('wishlist')) ? 'bi-heart-fill' : 'bi-heart' }} fs-4"></i>
							</a>
                        </div>
                        <div class="product-content d-flex justify-content-between">
							<a href="{{ route('sections.products.details', [
									'section' => 'hotDeals',
									$product]) }}">
                                <h3>{{ $product->title }}</h3>
                            </a>
                            <div class="product-price">
								@if($product->sale)
                                    <h4>৳{{ $product->offerPrice }}</h4>
                                    <h5>৳{{ $product->price }}</h5>
                                @else
                                    <h4>৳{{ $product->price }}</h4>
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
@if (!empty($customOrder))
<section class="bulk-order-area section-buttom-padding">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bulk-banner">
					<div
						class="custom-order-wrap"
						style="background-image: url('{{ $customOrder->imagePath }}');"
					>
						<div class="custom-order-content">
							<p>
								{!! $customOrder->content !!}
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
									<a href="{{ route('help.index') }}#get-idea"
										>Get Idea
										<i class="bi bi-arrow-up-right"></i>
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
@endif


<!-- Behind Wings -->
<section class="behind-wings-area bg-black section-padding">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="wings-edited-heading wings-showcase-heading behind-wings-heading">
					<h2>Behind Wings</h2>
					<p>
						Every brand has a story, but Wings Sportswear is
						a journey of passion, precision, and purpose.
						It’s more than just apparel; it’s about
						elevating athletes and teams around the world.
						Dive into the story behind Wings and discover
						what fuels our drive to ‘Keep Flying’.
					</p>
				</div>
			</div>
			<div class="col-12">
				<div class="behind-wings-tabs">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<!-- Loop through the tabs -->
						@foreach ($behindWings as $index => $item)
							<li class="nav-item" role="presentation">
								<button
									class="nav-link {{ $index == 0 ? 'active' : '' }}"
									id="{{ $item['slug'] }}-tab"
									data-bs-toggle="tab"
									data-bs-target="#{{ $item['slug'] }}-tab-pane"
									type="button"
									role="tab"
									aria-controls="{{ $item['slug'] }}-tab-pane"
									aria-selected="{{ $index == 0 ? 'true' : 'false' }}"
								>
									{{ $item['title'] }}
								</button>
							</li>
						@endforeach
					</ul>

					<div class="tab-content" id="myTabContent">
						<!-- Loop through the content panes -->
						@foreach ($behindWings as $index => $item)
							<div
								class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
								id="{{ $item['slug'] }}-tab-pane"
								role="tabpanel"
								aria-labelledby="{{ $item['slug'] }}-tab"
								tabindex="0"
							>
								<div class="wings-behind-tab-content-wrap">
									<div class="wings-behind-tab-content">
										<h2>{{ $item['title'] }}</h2>
										<p>{!! $item['content'] !!}</p>
									</div>
									<div class="wings-behind-tab-image">
										<img
											src="{{ $item['imagePath'] }}"
											class="img-fluid"
											alt="{{ $item['title'] }}"
											loading="lazy"
										/>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Customer Stories -->
<section class="customer-stories-area section-padding bg-black">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div
					class="wings-edited-heading wings-showcase-heading behind-wings-heading"
				>
					<h2>Customer Stories</h2>
					<p>
						Real stories, real satisfaction. Hear why our
						customers choose Wings and what makes them keep
						coming back!
					</p>
				</div>
			</div>
		</div>
		<div class="swiper customer-stories">
			<div class="swiper-wrapper">
				@foreach ($siteReviews as $review)
				<div class="swiper-slide">
					<div class="customer-stories-content">
						<p>
							{{ $review->content }}
						</p>
						<div class="author-part">
							<h4>{{ '@' . str_replace(' ', '', strtolower($review->user->name ?? $review->username )) }}</h4>
							<div>
								@for ($i = 0; $i < $review->ratingStars['filled']; $i++)
									<i class="bi bi-star-fill text-light"></i>
								@endfor
								
								@for ($i = 0; $i < $review->ratingStars['empty']; $i++)
									<i class="bi bi-star text-light"></i>
								@endfor
							</div>
						</div>
					</div>
				</div>				
				@endforeach
			</div>
			<!-- custom pagination -->
			<div class="swiper-pagination"></div>
		</div>
	</div>
</section>

<!-- Official Manufacturer / Proud Kit Partners -->
<div class="official-manufacture section-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="official-manufacture-content">
					<h3>Official Manufacturer</h3>
					@if($manufactureLogo && $manufactureLogo->filePath)
						<img
							src="{{ $manufactureLogo->filePath }}"
							class="img-fluid"
							alt="{{ $manufactureLogo->title }}"
							loading="lazy"
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
									src="{{ $partner->filePath }}"
									class="img-fluid"
									alt="{{ $partner->title }}"
									loading="lazy"
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
        <div class="row justify-content-center align-items-center">
            <div class="col-12 d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
                <h2 class="mb-0 payment-title">
                    We Accept
                    Payments
                </h2>
                @if($paymentBanner && $paymentBanner->filePath)
                    <div class="payment-banner">
                        <img
                            src="{{ $paymentBanner->filePath }}"
                            class="img-fluid"
                            alt="{{ $paymentBanner->title }}"
							loading="lazy"
                        />
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
