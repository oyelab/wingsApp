@extends('layouts.app')

@section('content')
    <div class="section-container">
        <h1>{{ $sectionTitle }}</h1>
        <div class="products-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <img src="{{ asset('images/products/' . json_decode($product->images)[0]) }}" alt="{{ $product->title }}">
                    <div class="product-details">
                        <h3>{{ $product->title }}</h3>
                        <p>{!! $product->description !!}</p>
                        <div class="product-categories">
                            @foreach ($product->categories as $category)
                                <span class="category">{{ $category->title }}</span>
                            @endforeach
                        </div>
                        <div class="product-price">
                            @if ($product->sale)
                                <span class="original-price">{{ $product->price }}</span>
                                <span class="sale-price">{{ $product->price * (1 - $product->sale / 100) }}</span>
                            @else
                                <span class="price">{{ $product->price }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            @if ($products->currentPage() > 1)
                <a href="{{ $products->previousPageUrl() }}">« Previous</a>
            @endif

            @foreach (range(1, $products->lastPage()) as $page)
                <a href="{{ $products->url($page) }}" class="{{ $page == $products->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach

            @if ($products->currentPage() < $products->lastPage())
                <a href="{{ $products->nextPageUrl() }}">Next »</a>
            @endif
        </div>
    </div>
@endsection
