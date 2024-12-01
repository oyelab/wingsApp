<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Advanced File Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <!-- FontAwesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <style>
        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .preview-item {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            display: inline-block;
            width: 150px;
        }
        .preview-item img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }
        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-align: center;
            cursor: pointer;
        }
        .thumbnail-selected {
            border: 3px solid #1e1e1e; /* Matches your theme's primary color */
            border-radius: 5px;
            padding: 2px;
        }
        /* Styled drop area for images */
        #file-input-container {
            width: 100px;
            height: 100px;
            padding: 20px;
            border: 2px dashed #ddd;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            background-color: #f8f9fa;
        }
        #file-input-container:hover {
            border-color: #007bff;
        }
        #file-input-container i {
            font-size: 40px;
            color: #007bff;
        }
        #file-input-container p {
            color: #007bff;
        }
        #file-input-container.dragover {
            background-color: #e9ecef;
            border-color: #007bff;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Advanced File Upload</h2>
    <div id="error-container"></div> <!-- Errors will be displayed here -->

    <form action="{{ route('test.store') }}" method="POST" enctype="multipart/form-data" id="upload-form">
        @csrf
        <div class="d-flex justify-content-center align-items-center gap-2">
            <!-- Preview Container for images -->
            <div class="preview-container align-items-center" id="preview-container"></div>

            <!-- File input container with drop zone and icon -->
            <div id="file-input-container" class="align-items-center">
                <i class="fas fa-upload"></i>
                <input type="file" name="images[]" class="form-control mb-3" multiple hidden id="file-input">
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success mt-3">Submit</button>
    </form>
</div>

<!-- Corrected script tag source -->
<script src="{{ asset('build/js/devF.js') }}"></script>
</body>
</html>
