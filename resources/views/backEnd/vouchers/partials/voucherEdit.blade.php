<form action="{{ route('vouchers.update', $voucher->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-3">
        <label for="code" class="form-label">Voucher Code</label>
        <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $voucher->code) }}" required>
    </div>

    <div class="mb-3">
        <label for="discount" class="form-label">Discount Percentage</label>
        <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount', $voucher->discount) }}" min="1" max="100" required>
    </div>

    <div class="mb-3">
        <label for="max_product" class="form-label">Max Products</label>
        <input type="number" class="form-control" id="max_product" name="max_product" value="{{ old('max_product', $voucher->max_product) }}" required>
    </div>

    <div class="mb-3">
        <label for="min_quantity" class="form-label">Min Quantity</label>
        <input type="number" class="form-control" id="min_quantity" name="min_quantity" value="{{ old('min_quantity', $voucher->min_quantity) }}" required>
    </div>

    <!-- Hidden Input for Status -->
    <input type="hidden" name="status" id="status" value="{{ old('status', $voucher->status) }}">

    <!-- Save & Publish Buttons -->
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-outline-primary me-2" onclick="setStatus(0)">Save</button>
        <button type="submit" class="btn btn-primary" onclick="setStatus(1)">Publish</button>
    </div>
</form>
