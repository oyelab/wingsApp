const fileInput = document.getElementById('file-input');
const previewContainer = document.getElementById('preview-container');
const fileInputContainer = document.getElementById('file-input-container');
const form = document.getElementById('product-form');
const errorContainer = document.getElementById('error-container');

let images = []; // Newly uploaded images
let existingImages = []; // Existing images from the server
let modified = false; // Tracks if there are changes (add/remove/reorder)

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
            createPreviewItem(id, e.target.result, true);
            modified = true; // Mark as modified
        };
        reader.readAsDataURL(file);
    });
    event.target.value = ''; // Reset input for new selections
});

// Add drag-and-drop functionality
function makeDraggable(previewItem) {
    previewItem.setAttribute('draggable', true);

    previewItem.addEventListener('dragstart', (e) => {
        previewItem.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
    });

    previewItem.addEventListener('dragover', (e) => {
        e.preventDefault();
        const dragging = document.querySelector('.dragging');
        if (dragging && dragging !== previewItem) {
            const bounding = previewItem.getBoundingClientRect();
            const offset = e.clientY - bounding.top + e.clientX - bounding.left;
            if (offset > previewItem.offsetWidth / 2) {
                previewItem.parentNode.insertBefore(dragging, previewItem.nextSibling);
            } else {
                previewItem.parentNode.insertBefore(dragging, previewItem);
            }
        }
    });

    previewItem.addEventListener('dragend', () => {
        previewItem.classList.remove('dragging');
        updateOrder();
        modified = true; // Mark as modified
    });
}

// Update arrays based on new order in the DOM
function updateOrder() {
    const items = Array.from(previewContainer.querySelectorAll('.preview-item'));
    const newOrder = items.map((item) => item.dataset.id);

    // Combine updated and existing images
    const allImages = [...existingImages, ...updatedImages];

    // Build the ordered array of images with their file-like properties
    const orderedImages = newOrder.map((id) => {
        // Find the image by ID (from either updated or existing arrays)
        const image = allImages.find((img) => img.id === id);
        if (image) {
            // If it's a new image (with a File object), use its lastModified timestamp
            if (image.file) {
                return {
                    type: 'new',
                    file: image.file,
                    lastModified: image.file.lastModified,
                    size: image.file.size,
                    name: image.file.name,
                };
            } else {
                // For existing images, ensure they have the file-like properties
                return {
                    type: 'existing',
                    url: image.url,
                    lastModified: image.file.lastModified, // Use lastModified from the file-like object
                    size: image.file.size, // Use size from the file-like object
                    name: image.url.split('/').pop(), // Get file name from URL
                };
            }
        }
    }).filter(Boolean); // Remove any undefined values (if image is not found)

    // Log ordered images for debugging
    console.log('Ordered Images:', orderedImages);

    // After processing the ordered images, rebuild the updatedImages and existingImages arrays
    updatedImages = orderedImages.filter((img) => img.type === 'new').map((img) => ({
        ...img, isNew: true
    }));
    existingImages = orderedImages.filter((img) => img.type === 'existing').map((img) => ({
        ...img, isNew: false
    }));

    // Now the updatedImages and existingImages arrays are correctly ordered and updated
    console.log('Updated Images Array:', updatedImages);
    console.log('Existing Images Array:', existingImages);
}

// Example usage: Call updateOrder after a drag-and-drop operation or after a preview update


// Create preview item dynamically
function createPreviewItem(id, src, isNew) {
    const previewItem = document.createElement('div');
    previewItem.classList.add('preview-item');
    previewItem.dataset.id = id;

    const img = document.createElement('img');
    img.src = src;
    img.classList.add('preview-image');

    const removeButton = document.createElement('button');
    removeButton.className = 'remove-btn';
    removeButton.innerHTML = '&times;';
    removeButton.addEventListener('click', (e) => {
        e.stopPropagation();
        removeImage(id, isNew);
    });

    previewItem.appendChild(img);
    previewItem.appendChild(removeButton);
    previewContainer.appendChild(previewItem);

    makeDraggable(previewItem);
}

// Remove image from the preview and array
function removeImage(id, isNew) {
    if (isNew) {
        images = images.filter((image) => image.id !== id);
    } else {
        existingImages = existingImages.filter((image) => image.id !== id);
    }

    const itemToRemove = document.querySelector(`.preview-item[data-id="${id}"]`);
    previewContainer.removeChild(itemToRemove);
    modified = true; // Mark as modified
}

// Display validation errors dynamically from server response
function displayErrors(errors) {
    const overallMessage = "There were errors with your form submission. Please check the fields below.";
    const errorTypes = new Set();

    for (const field in errors) {
        errors[field].forEach((error) => {
            errorTypes.add(`${field.charAt(0).toUpperCase() + field.slice(1)}: ${error}`);
        });
    }

    if (errorContainer) {
        errorContainer.innerHTML = '';

        const errorDiv = document.createElement('div');
        errorDiv.classList.add('alert', 'alert-danger');
        errorDiv.textContent = overallMessage;

        const ul = document.createElement('ul');
        errorTypes.forEach((error) => {
            const li = document.createElement('li');
            li.textContent = error;
            ul.appendChild(li);
        });

        errorDiv.appendChild(ul);
        errorContainer.appendChild(errorDiv);
    }
}

// Handle form submission
form.addEventListener('submit', (e) => {
    e.preventDefault();

    errorContainer.innerHTML = ''; // Clear previous errors


    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formData = new FormData(form);

    // Log the arrays before submitting
    console.log('Images:', images); // Newly uploaded images
    console.log('Existing Images:', existingImages); // Existing images from the server

    // Append new images to FormData
    images.forEach((image, index) => {
        const extension = image.file.name.split('.').pop();
        const filename = `${existingImages.length + index + 1}.${extension}`;
        formData.append('images[]', image.file, filename);
    });

    // Append existing images (those already stored in the database)
    existingImages.forEach((image) => {
        formData.append('existing_images[]', image);
    });

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
        body: formData,
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.success) {
            alert(data.message);
            window.location.href = data.redirect_url;
        } else {
            displayErrors(data.errors);
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('An unexpected error occurred.');
    });
});


// Prepopulate existing images when editing a product
function prepopulateExistingImages(existingImagesData) {
    existingImages = existingImagesData.map((data, index) => {
        const id = 'existing-' + index;
        
        // Create a mock "File-like" object for each existing image
        const file = {
            lastModified: data.lastModified || new Date().getTime(), // Fallback if no lastModified
            lastModifiedDate: new Date(data.lastModified * 1000), // Convert to JS Date object if timestamp is provided
            name: data.url.split('/').pop(), // Extract file name from URL
            size: data.size || 0, // Use size from the server, or fallback to 0
            type: 'image/' + data.url.split('.').pop(), // Guess the type based on file extension
            webkitRelativePath: '', // Not applicable for URL-based images
            isNew: false, // Mark as existing image
        };
        
        // Return the image with the same structure as the new images
        return { id, file, isNew: false, url: data.url };
    });

    existingImages.forEach((image) => {
        createPreviewItem(image.id, image.url, false);
    });

    // Merge existing images into the main images array
    images = [...existingImages];
}

if (window.existingImagesData) {
    prepopulateExistingImages(window.existingImagesData);
}

