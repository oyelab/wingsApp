const fileInput = document.getElementById('file-input');
const previewContainer = document.getElementById('preview-container');
const fileInputContainer = document.getElementById('file-input-container');
const form = document.getElementById('upload-form');
const errorContainer = document.getElementById('error-container');

let images = [];
let thumbnailId = null;

// Trigger file input on container click
fileInputContainer.addEventListener('click', () => fileInput.click());

// Handle file input change
fileInput.addEventListener('change', async (event) => {
    const selectedFiles = Array.from(event.target.files);
    for (const file of selectedFiles) {
        const optimizedFile = await optimizeImage(file);
        if (optimizedFile) {
            addImageToPreview(optimizedFile);
        }
    }
    event.target.value = ''; // Reset input
});

// Optimize image by converting to WebP and resizing
async function optimizeImage(file) {
    return new Promise((resolve) => {
        const img = new Image();
        const reader = new FileReader();
        reader.onload = () => {
            img.src = reader.result;
            img.onload = () => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                
                // Resize to maintain aspect ratio (max width/height: 800px)
                const maxSize = 2500;
                const scale = Math.min(maxSize / img.width, maxSize / img.height, 1);
                canvas.width = img.width * scale;
                canvas.height = img.height * scale;

                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                canvas.toBlob(
                    (blob) => {
                        if (blob) {
                            const optimizedFile = new File([blob], file.name.replace(/\.[^/.]+$/, '.webp'), {
                                type: 'image/webp',
                            });
                            resolve(optimizedFile);
                        } else {
                            resolve(null);
                        }
                    },
                    'image/webp',
                    0.8 // Quality level
                );
            };
        };
        reader.readAsDataURL(file);
    });
}

// Add image to preview container
function addImageToPreview(file) {
    const id = Date.now() + Math.random().toString(36).substr(2, 9);
    images.push({ id, file });

    const previewItem = document.createElement('div');
    previewItem.classList.add('preview-item');
    previewItem.dataset.id = id;

    const reader = new FileReader();
    reader.onload = (e) => {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('preview-image');
        img.addEventListener('click', () => setThumbnail(id));
        
        const removeButton = document.createElement('button');
        removeButton.className = 'remove-btn';
        removeButton.innerHTML = '&times;';
        removeButton.addEventListener('click', (e) => {
            e.stopPropagation();
            removeImage(id);
        });

        previewItem.appendChild(img);
        previewItem.appendChild(removeButton);
        previewContainer.appendChild(previewItem);

        if (!thumbnailId) {
            setThumbnail(id);
        }
    };
    reader.readAsDataURL(file);
}

// Set selected image as thumbnail
function setThumbnail(id) {
    thumbnailId = id;
    document.querySelectorAll('.preview-image').forEach((img) => img.classList.remove('thumbnail-selected'));
    const selectedThumbnail = document.querySelector(`.preview-item[data-id="${id}"] img`);
    if (selectedThumbnail) selectedThumbnail.classList.add('thumbnail-selected');
}

// Remove image from the preview and list
function removeImage(id) {
    images = images.filter((image) => image.id !== id);
    const itemToRemove = document.querySelector(`.preview-item[data-id="${id}"]`);
    previewContainer.removeChild(itemToRemove);

    if (thumbnailId === id) {
        thumbnailId = images.length > 0 ? images[0].id : null;
        if (thumbnailId) setThumbnail(thumbnailId);
    }
}

// Handle form submission
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    errorContainer.innerHTML = ''; // Clear previous errors

    // Prepare form data
    const formData = new FormData();
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Check if thumbnail is selected and reorder images if necessary
    if (thumbnailId) {
        const thumbnailImage = images.find((image) => image.id === thumbnailId);
        images = [thumbnailImage, ...images.filter((image) => image.id !== thumbnailId)];
    }

    // Append images to FormData
    images.forEach((image, index) => {
        const filename = `image-${index + 1}.webp`;
        formData.append('images[]', image.file, filename);
    });

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            body: formData,
        });

        if (response.ok) { // Success
            const data = await response.json();
            if (data.success) {
                alert(data.message);
                resetForm();
            } else {
                displayErrors(data.errors); // Display validation errors
            }
        } else { // If response is not OK (i.e., validation error)
            const data = await response.json();
            displayErrors(data.errors || { general: ['An error occurred. Please try again.'] });
        }
    } catch (error) {
        console.error('Error:', error); // Optional: log for debugging
        alert('An unexpected error occurred.');
    }
});

// Display validation errors in the UI
function displayErrors(errors) {
    let errorMessage = '<div class="alert alert-danger"><strong>There were issues with your uploads:</strong><ul>';

    if (errors) {
        Object.values(errors).flat().forEach((msg) => {
            errorMessage += `<li>${msg}</li>`;
        });
    }

    errorMessage += '</ul></div>';
    errorContainer.innerHTML = errorMessage;
}

// Reset the form after successful submission
function resetForm() {
    previewContainer.innerHTML = '';
    images = [];
    thumbnailId = null;
}
