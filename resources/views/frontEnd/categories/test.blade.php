<div class="products">
    <h2>Products in {{ $subcategory->title }} ({{ $category->title }})</h2>

    @foreach($products as $product)
        <div class="product-item">
            <h4>{{ $product->title }}</h4>
            <p>{{ $product->description }}</p>
            <p>Price: ৳{{ $product->price }}</p>
        </div>
    @endforeach
</div>
