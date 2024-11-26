@extends('backEnd.layouts.master')

@section('css')
<!-- Add your custom styles here if necessary -->
@endsection

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Vouchers</h1>
        <a href="{{ route('vouchers.create') }}" class="btn btn-success">Create New Voucher</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">All Vouchers</h5>
        </div>
        <div class="card-body">
            @if($vouchers->isNotEmpty())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Discount (%)</th>
                            <th>Max Products</th>
                            <th>Min Quantity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vouchers as $index => $voucher)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $voucher->code }}</td>
                                <td>{{ $voucher->discount }}</td>
                                <td>{{ $voucher->max_product }}</td>
                                <td>{{ $voucher->min_quantity }}</td>
                                <td>
                                    <span class="badge {{ $voucher->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $voucher->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this voucher?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No vouchers found. <a href="{{ route('vouchers.create') }}">Create one</a>.</p>
            @endif
        </div>
    </div>
</div>
@endsection
