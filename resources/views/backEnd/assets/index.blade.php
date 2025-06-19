@extends('backEnd.layouts.master')
@section('title')
Assets
@endsection
@section('content')
<div class="container">
    <h1 class="my-4">Asset Management</h1>

    <div class="mb-3">
        <a href="{{ route('assets.create') }}" class="btn btn-primary">Add New Asset</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assets as $asset)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $asset->type }}</td>
                        <td>
                            @if($asset->url)
                                <a href="{{ $asset->url }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                    {{ $asset->title }}
                                    <i class="fas fa-external-link-alt ms-1" style="font-size: 12px;"></i>
                                </a>
                            @else
                                {{ $asset->title }}
                            @endif
                        </td>
                        <td>
                            @if($asset->filePath)
                                <img src="{{ $asset->filePath }}" alt="{{ $asset->title }}" class="img-thumbnail" style="max-width: 100px;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $asset->description }}</td>
                        <td>
                            <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this asset?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No assets found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('build/js/app.js') }}"></script>
@endsection