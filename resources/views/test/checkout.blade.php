@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Create Order</h1>
    
    <form action="{{ route('process.Checkout') }}" method="POST">
        @csrf <!-- CSRF protection -->
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

		<label>
			<input type="radio" name="payment_method" value="COD" checked> Cash on Delivery
		</label>

		<label>
			<input type="radio" name="payment_method" value="Full Payment"> Full Payment
		</label>

		<label for="location">Delivery Location</label>
		
		<select id="location" name="location">
			<option value="inside">Inside Dhaka</option>
			<option value="outside">Outside Dhaka</option>
		</select>


        <button type="submit" class="btn btn-primary">Submit Order</button>
    </form>
</div>
@endsection
