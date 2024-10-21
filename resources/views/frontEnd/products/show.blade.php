@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container mt-5">
    <h1 class="text-center">{{ $product->title }}</h1>
    <p class="lead text-center">Price: ${{ $product->price }}</p>
    <div class="">
        {!! $product->description !!}
    </div>

    <div class="mt-4">
        <label>Select Size:</label>
        <div class="btn-group-toggle d-flex flex-wrap" data-toggle="buttons">
            @foreach($product->availableSizes as $size)
                <label class="btn btn-outline-primary m-1">
                    <input type="radio" name="size" value="{{ $size->pivot->size_id }}" id="size_{{ $size->pivot->size_id }}" autocomplete="off" required>
                    {{ $size->name }}
                </label>
            @endforeach
        </div>
    </div>

    <form action="{{ route('cart.add') }}" method="POST" class="text-center mt-3">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="size_id" id="selected_size" required>

        <button type="submit" class="btn btn-primary">Add to Cart</button>
    </form>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        const selectedSize = document.querySelector('input[name="size"]:checked');
        if (!selectedSize) {
            event.preventDefault(); // Prevent form submission if no size is selected
            alert('Please select a size before adding to the cart.');
            return;
        }
        document.getElementById('selected_size').value = selectedSize.value;
    });
</script>

@endsection
