@extends('frontEnd.layouts.app')  <!-- Use your main layout -->

@section('content')

<section class="latest-arrivals-area section-buttom-padding">
	<div class="container">
		<!-- breadcrumb section -->
		<div class="breadcrumb-section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="breadcrumb-content">
							<x-breadcrub :title="$title" :pagetitle="$pagetitle" :collection="$collection" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section-buttom-padding">
			<div class="col-12">
				<div class="section-banner">
					<img src="{{ $category->imagePath }}" draggable="false" class="img-fluid rounded"
						alt="{{ $category->title }}" />
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				@foreach ($products as $product)
					<div class="col-md-3 col-sm-6 col-6 mb-4">
						<div class="product-item">
							<div class="product-img">
								<a href="{{ route('products.details', ['category' => $category->slug, $product]) }}">
									<img src="{{ $product->thumbnail }}" class="img-fluid" alt="{{ $product->title }}"
										draggable="false" oncontextmenu="return false;" />
								</a>
								<a href="#" class="wishlist-icon" data-product-id="{{ $product->id }}">
									<i
										class="bi {{ session('wishlist') && in_array($product->id, session('wishlist')) ? 'bi-heart-fill' : 'bi-heart' }} fs-4"></i>
								</a>
							</div>
							<div class="product-content d-flex justify-content-between">
								<a href="{{ route('products.details', ['category' => $category->slug, $product]) }}">
									<h3>{!! nl2br(e($product->title)) !!}</h3>
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
		<div class="pagination-wrapper d-flex align-items-center justify-content-between">
			<!-- Previous Button -->
			<a href="{{ $products->previousPageUrl() }}" class="previous" @if ($products->onFirstPage())
			style="pointer-events: none; opacity: 0.5;" @endif>
				<i class="bi bi-arrow-left"></i> Previous
			</a>

			<!-- Page Numbers -->
			<ul class="d-flex align-items-center">
				@foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
					<li>
						<a href="{{ $url }}" class="{{ $page == $products->currentPage() ? 'active' : '' }}"
							@if($products->lastPage() === 1) style="pointer-events: none; opacity: 0.5;" @endif>
							{{ $page }}
						</a>
					</li>
				@endforeach
			</ul>

			<!-- Next Button -->
			<a href="{{ $products->nextPageUrl() }}" class="next" @if ($products->hasMorePages() === false)
			style="pointer-events: none; opacity: 0.5;" @endif>
				Next <i class="bi bi-arrow-right"></i>
			</a>
		</div>
	</div>
</section>
@endsection