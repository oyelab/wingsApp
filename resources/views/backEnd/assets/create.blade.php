<!-- resources/views/admin/assets/create.blade.php -->
@extends('backEnd.layouts.master')
@section('title')
Create Asset
@endsection
@section('content')
<div class="container">
    <h2>Create Asset</h2>
    <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
			<label for="type">Asset Type</label>
			<select name="type" class="form-control" required>
				<option value="" disabled selected>Select Asset Type</option>
				@foreach ($assetTypes as $value => $label)
					<option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>{{ $label }}</option>
				@endforeach
			</select>
		</div>



        <div class="form-group">
            <label for="title">Asset Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="file">Upload File</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Asset</button>
    </form>
</div>
@endsection
@section('scripts')
<script src="{{ asset('build/js/app.js') }}"></script>
@endsection
