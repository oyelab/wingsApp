@extends('frontEnd.layouts.app')

@section('content')
    <div class="container section-padding wishlist-page" id="wishlist-page">
        @if($products->isEmpty())
            <p>Your wishlist is empty.</p>
        @else
            <div class="row">
                <div class="d-flex align-items-center justify-content-between mb-30">
                    <div class="section-title">
                        <h3>Your Wishlist</h3> <!-- Adjusted title -->
                    </div>
                    <div class="navigation-items d-flex align-items-center">
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
                    @foreach($products as $product)
                    <div class="swiper-slide wishlist-item" data-product-id="{{ $product->id }}">
                        <div class="product-item">
                            <div class="product-img">
                                <a href="{{ route('sections.products.details', [
                                        'section' => 'latest',
                                        'slug' => $product->slug, // Using the model method to get subcategory slug
                                    ]) }}">
                                    <img src="{{ $product->thumbnail }}" class="img-fluid" alt="{{ $product->title }}" draggable="false"/>
                                </a>
                                <a href="#" class="wishlist-icon" data-product-id="{{ $product->id }}">
                                    <i class="bi {{ session('wishlist') && in_array($product->id, session('wishlist')) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
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
        @endif
    </div>
@endsection
