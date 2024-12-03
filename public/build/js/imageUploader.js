const fileInput = document.getElementById('file-input');
const previewContainer = document.getElementById('preview-container');
const fileInputContainer = document.getElementById('file-input-container');
const form = document.getElementById('product-form');
const errorContainer = document.getElementById('error-container');

let images = []; // Combined array of both updated and existing images
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
            // Get the filename with extension
            const filenameWithExtension = file.name;
            const extension = filenameWithExtension.split('.').pop(); // Get file extension
            const id = Date.now() + Math.floor(Math.random() * 1000) + '.' + extension; // Add extension to ID

            // Create a new image object with the unique ID
            images.push({ id, file, filename: filenameWithExtension, isNew: true });
            createPreviewItem(id, e.target.result, true, filenameWithExtension); // Pass the filename to preview
            modified = true; // Mark as modified

            // Log the images array to the console
            console.log('Images Array:', images);
        };
        reader.readAsDataURL(file); // Read file as data URL for preview
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

    // Create a new ordered array based on the DOM order
    const orderedImages = newOrder.map((id) => {
        const image = images.find((img) => img.id === id);
        if (image) {
            return image; // Keep the image object intact (whether new or existing)
        }
    }).filter(Boolean); // Remove any undefined values

    // Set the new order of images
    images = orderedImages;

    console.log('Ordered Images:', images); // Log ordered images to the console
}

// Update the createPreviewItem function to display the filename instead of the full path
function createPreviewItem(id, src, isNew, filename) {
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
    images = images.filter((image) => image.id !== id); // Remove from the single array

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

form.addEventListener('submit', (e) => {
    e.preventDefault();
    errorContainer.innerHTML = ''; // Clear previous errors

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formData = new FormData(form);

    // Arrays for separating file images and ordered image IDs
    const fileImages = [];
    const orderedImageData = [];

    // Check if it's an update or create
    const isUpdate = images.some(image => !image.isNew); // Check if there are existing images

    // First, handle the ordered image data (existing and new images in the correct order)
    images.forEach((image) => {
        if (image.isNew) {
            // Directly push the new image ID and file into the order
            orderedImageData.push(image.id); // Place the new image at its ordered position
            fileImages.push({ file: image.file, id: image.id });
        } else {
            // Add existing image IDs to the ordered list
            orderedImageData.push(image.id);
        }
    });

    // Add the new images to FormData (file uploads)
    fileImages.forEach((image) => {
        formData.append('images[]', image.file, image.id); // Use the existing unique id as filename
    });

    // Append ordered image data (for both new and existing images) to FormData
    orderedImageData.forEach((imageId) => {
        formData.append('images_order[]', imageId); // Append as array element for ordered images
    });

    // Submit form data
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
    existingImages = existingImagesData.map((url, index) => {

		const filename = url.substring(url.lastIndexOf('/') + 1);

        return {
            id: filename, // Use the filename without the extension as the ID
            filename: filename, // Store the full filename with the extension
            url: url,
            isNew: false // Mark as existing image
        };
    });

    existingImages.forEach((image) => {
        // Display the filename with extension in the preview
        createPreviewItem(image.id, image.url, false, image.filename);
    });

    // Merge existing images into the main images array
    images = [...existingImages];
}


if (window.existingImagesData) {
    prepopulateExistingImages(window.existingImagesData);
}

