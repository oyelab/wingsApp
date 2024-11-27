@extends('backEnd.layouts.master')
@section('title')
    Add Showcase
@endsection
@section('page-title')
    Add Showcase
@endsection
@section('body')
<body>
@endsection

@section('content')
<div class="container">
	<form action="{{ route('showcases.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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

        <!-- Submit Button Row -->
        <div class="row g-3 mb-3 d-flex align-items-center">
            <div class="col-6">
                <h2 class="mb-2">Edit Showcase</h2>
            </div>

            <div class="col-6 d-flex justify-content-end">
                <button type="button" class="btn btn-outline-secondary me-2 w-25" onclick="window.location.href='{{ route('showcases.index') }}'">Discard</button>
                <button type="submit" class="btn btn-outline-primary me-2 w-25" onclick="setStatus(0)">Save</button>
                <button type="submit" class="btn btn-primary w-25" onclick="setStatus(1)">Publish</button>
            </div>
        </div>

        <!-- Hidden Status Field -->
        <input type="hidden" name="status" id="status">

        <!-- Title and Order -->
        <div class="row mb-3">
            <!-- Title -->
            <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $showcase->title) }}">
            </div>

            <!-- Order -->
            <div class="col-md-6">
                <label for="order" class="form-label">Order</label>
                <select name="order" id="order" class="form-select">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('order', $showcase->order) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="short_description" class="form-label">Short Description</label>
            <textarea name="short_description" id="short_description" class="form-control" rows="3">{{ old('short_description', $showcase->short_description) }}</textarea>
        </div>

        <!-- Banner -->
        <div class="mb-3">
            <label for="banner" class="form-label">Banner Image</label>
            <input type="file" name="banner" id="banner" class="form-control">
            <small class="form-text text-muted">Leave blank to keep the existing banner image.</small>
        </div>

        <!-- Thumbnail Image -->
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail Image</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
            <small class="form-text text-muted">Leave blank to keep the existing thumbnail image.</small>
        </div>

        <!-- Showcase Details -->
        <div id="details-container">
            <h3>Showcase Details</h3>

            <!-- Loop through existing details -->
            @foreach ($showcase->details as $index => $detail)
                <div class="detail-item mb-3">
                    <!-- Detail ID (hidden) -->
                    <input type="hidden" name="details[{{ $index }}][id]" value="{{ $detail->id }}">

                    <label for="details[{{ $index }}][heading]" class="form-label">Heading</label>
                    <input type="text" name="details[{{ $index }}][heading]" class="form-control" value="{{ old("details.$index.heading", $detail->heading) }}">

                    <label for="details[{{ $index }}][description]" class="form-label">Description</label>
                    <textarea name="details[{{ $index }}][description]" class="form-control" rows="3">{{ old("details.$index.description", $detail->description) }}</textarea>

                    <!-- Image Upload -->
                    <label for="details[{{ $index }}][images]" class="form-label">Images</label>
                    <input type="file" name="details[{{ $index }}][images][]" class="form-control" multiple>
                    <small class="form-text text-muted">Leave blank to keep the existing images.</small>

                    <!-- Add and Remove Buttons -->
                    <div class="mt-2">
                        <button type="button" class="btn btn-secondary btn-sm add-detail">Add More</button>
                        <button type="button" class="btn btn-danger btn-sm remove-detail">Remove</button>
                    </div>
                </div>
            @endforeach

            <!-- Add New Detail -->
            <div class="detail-item mb-3">
                <label for="details[new][heading]" class="form-label">Heading</label>
                <input type="text" name="details[new][heading]" class="form-control">

                <label for="details[new][description]" class="form-label">Description</label>
                <textarea name="details[new][description]" class="form-control" rows="3"></textarea>

                <!-- Image Upload -->
                <label for="details[new][images]" class="form-label">Images</label>
                <input type="file" name="details[new][images][]" class="form-control" multiple>

                <!-- Add and Remove Buttons -->
                <div class="mt-2">
                    <button type="button" class="btn btn-secondary btn-sm add-detail">Add More</button>
                </div>
            </div>
        </div>
    </for>
</div>
@endsection

@section('scripts')
<script>
    // Set status value
    function setStatus(value) {
        document.getElementById('status').value = value;
    }

    document.addEventListener('DOMContentLoaded', () => {
        let detailCount = {{ $showcase->details->count() }};

        // Add More Details Button
        document.getElementById('details-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('add-detail')) {
                const currentDetail = e.target.closest('.detail-item');
                const newDetailHtml = `
                    <div class="detail-item mb-3">
                        <label for="details[${detailCount}][heading]" class="form-label">Heading</label>
                        <input type="text" name="details[${detailCount}][heading]" class="form-control">

                        <label for="details[${detailCount}][description]" class="form-label">Description</label>
                        <textarea name="details[${detailCount}][description]" class="form-control" rows="3"></textarea>

                        <label for="details[${detailCount}][images]" class="form-label">Images</label>
                        <input type="file" name="details[${detailCount}][images][]" class="form-control" multiple>

                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary btn-sm add-detail">Add More</button>
                            <button type="button" class="btn btn-danger btn-sm remove-detail">Remove</button>
                        </div>
                    </div>
                `;

                // Insert new detail after the current one
                currentDetail.insertAdjacentHTML('afterend', newDetailHtml);
                detailCount++;
            }
        });

        // Remove Detail Button
        document.getElementById('details-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-detail')) {
                e.target.closest('.detail-item').remove();
            }
        });
    });
</script>
<!-- App js -->
<script src="{{ asset('build/js/app.js') }}"></script>
@endsection
