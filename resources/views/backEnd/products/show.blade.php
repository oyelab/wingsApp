<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote.min.css" rel="stylesheet">
    <style>
        .product-description {
            line-height: 1.5; /* Adjusts line height for better readability */
            margin: 20px; /* Adds margin for spacing */
            /* Add padding for the description */
            padding: 10px; 
            /* Set a maximum width to control line length */
            max-width: 800px; 
            /* Center align text */
            text-align: justify; 
        }

        /* Adjust line breaks to reduce excessive space */
        .product-description p {
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove padding */
        }

        .product-description p + p {
            margin-top: 1em; /* Add space only between paragraphs */
        }
    </style>
    <title>Product Details</title>
</head>
<body>
    <div class="container">
        <h1>{{ $product->title }}</h1>
        <div class="product-description">
            {!! $product->description !!} <!-- Displaying the Summernote output -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote.min.js"></script>
</body>
</html>
