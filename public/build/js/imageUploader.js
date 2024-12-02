const fileInput = document.getElementById('file-input');
const previewContainer = document.getElementById('preview-container');
const fileInputContainer = document.getElementById('file-input-container');
const form = document.getElementById('product-form');
const errorContainer = document.getElementById('error-container');

let updatedImages = []; // This will hold the newly uploaded images
let existingImages = []; // Images from the server that already exist
let modified = false; // Track if there are any changes

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
            updatedImages.push({ id, file });  // Push to updatedImages array
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

    const allImages = [...existingImages, ...updatedImages];
    existingImages = [];
    updatedImages = [];

    newOrder.forEach((id) => {
        const image = allImages.find((img) => img.id === id);
        if (image) {
            if (image.file) {
                updatedImages.push(image); // Newly uploaded images
            } else {
                existingImages.push(image); // Existing images
            }
        }
    });
}

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

// Remove image from preview and array
function removeImage(id, isNew) {
    if (isNew) {
        updatedImages = updatedImages.filter((image) => image.id !== id);
    } else {
        existingImages = existingImages.filter((image) => image.id !== id);
    }

    const itemToRemove = document.querySelector(`.preview-item[data-id="${id}"]`);
    previewContainer.removeChild(itemToRemove);
    modified = true; // Mark as modified
}

// Display validation errors dynamically
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

    // Combine both updated and existing images into a single array
    let combinedImages = [];

    // Append new images to the array (updatedImages)
    updatedImages.forEach((image, index) => {
        const extension = image.file.name.split('.').pop();
        const filename = `${existingImages.length + index + 1}.${extension}`;
        combinedImages.push(image.file); // Add newly uploaded image
    });

    // Append existing images (those already stored in the database)
    existingImages.forEach((image) => {
        combinedImages.push(image.url); // Add the URL or path of existing image
    });

    // If no images have been modified, don't send anything
    if (combinedImages.length === 0) {
        formData.delete('images[]'); // Remove images field if nothing to upload
    } else {
        // Append the combined array of images to FormData
        combinedImages.forEach((image) => {
            formData.append('images[]', image); // All images in one field
        });
    }

    // If no changes (i.e., no new or removed images), we don't need to send anything
    if (!modified) {
        formData.delete('images[]'); // Remove images array if no modification
    }

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
    existingImages = existingImagesData.map((url, index) => ({
        id: 'existing-' + index,
        url: url,
    }));

    existingImages.forEach((image) => {
        createPreviewItem(image.id, image.url, false);
    });
}

if (window.existingImagesData) {
    prepopulateExistingImages(window.existingImagesData);
}
