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
							<x-breadcrub 
								:title="$title" 
								:pagetitle="$pagetitle" 
								:section="$section" 
								:collection="$collection" 
							/>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section-buttom-padding">
			<div class="col-12">
				<div class="section-banner">
					<img
						src="{{ $section->imagePath }}"
						draggable="false"
						class="img-fluid rounded"
						alt="{{ $section->title }}"
					/>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				@foreach ($products as $product)
				<div class="col-md-3 mb-4">
					<div class="product-item">
						<div class="product-img">
							<img
								src="{{ $product->thumbnail }}"
								class="img-fluid"
								alt="{{ $product->title }}"
								draggable="false"
								oncontextmenu="return false;"

							/>
							<a href="#" class="wishlist-icon">
								<i class="bi bi-heart-fill"></i>
							</a>
						</div>
						<div class="product-content d-flex justify-content-between">
							<a href="{{ route('sections.products.details', [
								'section' => $section,
								'slug' => $product->slug,
								'product' => $product->slug,
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
@endsection
