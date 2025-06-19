<!-- resources/views/admin/assets/edit.blade.php -->
@extends('backEnd.layouts.master')
@section('title')
Update Asset
@endsection
@section('content')
<div class="container">
    <h2>Edit Asset</h2>
    <form action="{{ route('assets.update', $asset->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
		<div class="form-group">
			<label for="type">Asset Type</label>
			<select name="type" class="form-control" required>
				<option value="" disabled>Select Asset Type</option>
				@foreach ($assetTypes as $value => $label)
					<option value="{{ $value }}" {{ old('type', $asset->type) == $value ? 'selected' : '' }}>{{ $label }}</option>
				@endforeach
			</select>
		</div>


        <div class="form-group">
            <label for="title">Asset Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $asset->title) }}" required>
        </div>

        <div class="form-group">
            <label for="url">URL</label>
            <input type="url" name="url" class="form-control" value="{{ old('url', $asset->url) }}" placeholder="https://example.com">
        </div>

        <div class="form-group">
            <label for="file">Upload File</label>
            <input type="file" name="file" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $asset->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Asset</button>
    </form>
</div>
@endsection
@section('scripts')
<script src="{{ asset('build/js/app.js') }}"></script>
@endsection