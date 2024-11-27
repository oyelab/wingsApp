@extends('backEnd.layouts.master')
@section('title')
    Showcases
@endsection
@section('page-title')
    All Showcases
@endsection
@section('body')
<body>
@endsection
@section('content')
    <div class="container">
        <h1 class="mb-4">Showcase List</h1>
        
        <!-- Add New Showcase Button -->
        <a href="{{ route('showcases.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Add New Showcase
        </a>

        <!-- Showcase Table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Short Description</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($showcases as $showcase)
                    <tr>
                        <td>{{ $showcase->title }}</td>
                        <td>{{ $showcase->short_description }}</td>
                        <td>
							<span class="badge text-dark {{ $showcase->status == 1 ? 'badge-success' : 'badge-danger' }}">
								{{ $showcase->status == 1 ? 'Active' : 'Inactive' }}
							</span>
						</td>

                        <td>{{ $showcase->order }}</td>
                        <td class="text-center">

                            <!-- Edit Button -->
                            <a href="{{ route('showcases.edit', $showcase) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('showcases.destroy', $showcase) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this showcase?');" data-action="delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    </div>
@endsection
@section('scripts')
<!-- App js -->
<script src="{{ asset('build/js/app.js') }}"></script>
@endsection