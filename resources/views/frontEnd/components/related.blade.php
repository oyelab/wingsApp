@if ($relatedProducts->isNotEmpty())
<section class="latest-arrivals-area section-buttom-padding">
	<div class="container">
		<div class="row">
			<div class="d-flex align-items-center justify-content-between mb-30">
				<div class="section-title">
					<h2>You May Also Like</h2>
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
								src="{{ $product->thumbnail }}"
								class="img-fluid"
								alt="{{ $product->title }}"
								draggable="false"
								oncontextmenu="return false;"
							/>
							<a href="#" class="wishlist-icon" data-product-id="{{ $product->id }}">
								<i class="bi {{ session('wishlist') && in_array($product->id, session('wishlist')) ? 'bi-heart-fill' : 'bi-heart' }} fs-4"></i>
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