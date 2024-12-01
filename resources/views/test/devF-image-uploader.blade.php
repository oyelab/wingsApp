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
	<form action="{{ route('test.store') }}" method="POST" enctype="multipart/form-data" id="upload-form">
	@csrf
		<div class="d-flex justify-content-center align-items-center gap-2">
            <!-- Preview Container for images -->
            <div class="preview-container align-items-center" id="preview-container"></div>

            <!-- File input container with drop zone and icon -->
            <div id="file-input-container" class="align-items-center">
                <i class="fas fa-upload"></i>
                <input type="file" name="images[]" class="form-control mb-3" accept="image/*" multiple hidden id="file-input">
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success mt-3">Submit</button>
    </form>
</div>

<script>
    const fileInput = document.getElementById('file-input');
    const previewContainer = document.getElementById('preview-container');
    const fileInputContainer = document.getElementById('file-input-container');
    const form = document.getElementById('upload-form');

    let images = [];
    let thumbnailId = null; // Store the ID of the selected thumbnail

    // Trigger file input when "file-input-container" is clicked
    fileInputContainer.addEventListener('click', () => {
        fileInput.click();
    });

    // Handle file input change
    fileInput.addEventListener('change', (event) => {
        const selectedFiles = Array.from(event.target.files);
        selectedFiles.forEach((file) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const id = Date.now() + Math.random().toString(36).substr(2, 9);
                images.push({ id, file });

                // Create preview item
                const previewItem = document.createElement('div');
                previewItem.classList.add('preview-item');
                previewItem.dataset.id = id;

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('preview-image');
                img.addEventListener('click', () => setThumbnail(id)); // Set thumbnail on click

                const removeButton = document.createElement('button');
                removeButton.className = 'remove-btn';
                removeButton.innerHTML = '&times;';
                removeButton.addEventListener('click', () => removeImage(id));

                previewItem.appendChild(img);
                previewItem.appendChild(removeButton);

                previewContainer.appendChild(previewItem);

                // If no thumbnail is set, default the first image as thumbnail
                if (!thumbnailId) {
                    setThumbnail(id);
                }
            };
            reader.readAsDataURL(file);
        });

        event.target.value = ''; // Reset input for new selections

        // Show the upload field again after image previews
        fileInputContainer.style.display = 'block';
    });

    // Set thumbnail and visually indicate it
    function setThumbnail(id) {
        thumbnailId = id;

        // Highlight the selected thumbnail
        document.querySelectorAll('.preview-image').forEach((img) => {
            img.classList.remove('thumbnail-selected');
        });

        const selectedThumbnail = document.querySelector(`.preview-item[data-id="${id}"] img`);
        if (selectedThumbnail) {
            selectedThumbnail.classList.add('thumbnail-selected');
        }
    }

    // Remove image from the preview and images array
    function removeImage(id) {
        images = images.filter((image) => image.id !== id);
        const itemToRemove = document.querySelector(`.preview-item[data-id="${id}"]`);
        previewContainer.removeChild(itemToRemove);

        // If the removed image was the thumbnail, reset thumbnail to the first image
        if (thumbnailId === id) {
            thumbnailId = images.length > 0 ? images[0].id : null;
            if (thumbnailId) {
                setThumbnail(thumbnailId);
            }
        }

        // If no images are left, show the upload drop zone again
        if (images.length === 0) {
            fileInputContainer.style.display = 'block';
        }
    }

    // Drag and drop event listeners
    fileInputContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileInputContainer.classList.add('dragover');
    });

    fileInputContainer.addEventListener('dragleave', () => {
        fileInputContainer.classList.remove('dragover');
    });

    fileInputContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        fileInputContainer.classList.remove('dragover');
        const droppedFiles = Array.from(e.dataTransfer.files);
        fileInput.files = e.dataTransfer.files; // Simulate file input change
        fileInput.dispatchEvent(new Event('change'));
    });

    form.addEventListener('submit', (e) => {
		e.preventDefault();

		const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		const formData = new FormData();

		// Reorder images array to put the thumbnail first
		if (thumbnailId) {
			const thumbnailImage = images.find((image) => image.id === thumbnailId);
			images = [thumbnailImage, ...images.filter((image) => image.id !== thumbnailId)];
		}

		// Rename files serially and append to FormData
		images.forEach((image, index) => {
			const extension = image.file.name.split('.').pop(); // Extract file extension
			const filename = `${index + 1}.${extension}`; // Rename file as 1.ext, 2.ext, etc.
			formData.append('images[]', image.file, filename);
		});

		fetch(form.action, {
			method: 'POST',
			headers: {
				'X-CSRF-TOKEN': csrfToken,
			},
			body: formData,
		})
		.then((response) => {
			if (!response.ok) {
				throw new Error('Network response was not ok');
			}
			return response.json();
		})
		.then((data) => {
			if (data.success) {
				console.log('Success:', data);
				alert(data.message);
			} else {
				alert('Validation failed: ' + JSON.stringify(data.errors));
				console.log('Errors:', data.errors);
			}
		})
		.catch((error) => {
			console.error('Error:', error);
			alert('An error occurred. Please check the console for details.');
		});
	});

</script>
</body>
</html>
