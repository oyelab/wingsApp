const fileInput = document.getElementById('file-input');
const previewContainer = document.getElementById('preview-container');
const fileInputContainer = document.getElementById('file-input-container');
const form = document.getElementById('upload-form');
const errorContainer = document.getElementById('error-container');

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
            removeButton.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent triggering thumbnail selection
                removeImage(id);
            });

            previewItem.appendChild(img);
            previewItem.appendChild(removeButton);
            previewContainer.appendChild(previewItem);

            if (!thumbnailId) {
                setThumbnail(id); // Default the first image as thumbnail
            }
        };
        reader.readAsDataURL(file);
    });
    event.target.value = ''; // Reset input for new selections
});

// Set thumbnail and visually indicate it
function setThumbnail(id) {
    thumbnailId = id;

    document.querySelectorAll('.preview-image').forEach((img) => {
        img.classList.remove('thumbnail-selected');
    });

    const selectedThumbnail = document.querySelector(`.preview-item[data-id="${id}"] img`);
    if (selectedThumbnail) {
        selectedThumbnail.classList.add('thumbnail-selected');
    }
}

// Remove image from the preview and array
function removeImage(id) {
    images = images.filter((image) => image.id !== id);
    const itemToRemove = document.querySelector(`.preview-item[data-id="${id}"]`);
    previewContainer.removeChild(itemToRemove);

    if (thumbnailId === id) {
        thumbnailId = images.length > 0 ? images[0].id : null;
        if (thumbnailId) {
            setThumbnail(thumbnailId);
        }
    }
}

// Handle form submission
form.addEventListener('submit', (e) => {
    e.preventDefault();

    errorContainer.innerHTML = ''; // Clear previous errors

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formData = new FormData();

    if (thumbnailId) {
        const thumbnailImage = images.find((image) => image.id === thumbnailId);
        images = [thumbnailImage, ...images.filter((image) => image.id !== thumbnailId)];
    }

    images.forEach((image, index) => {
        const extension = image.file.name.split('.').pop();
        const filename = `${index + 1}.${extension}`;
        formData.append('images[]', image.file, filename);
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
                previewContainer.innerHTML = ''; // Clear previews
                images = [];
                thumbnailId = null;
            } else {
                displayErrors(data.errors);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('An unexpected error occurred.');
        });
});

// Display validation errors with user-friendly field names
function displayErrors(errors) {
    const overallMessage = "There were errors with your uploaded images. Please ensure all files meet the requirements.";
    const errorTypes = new Set();

    // Map index to user-friendly field names
    const friendlyFieldNames = (field) => {
        const match = field.match(/images\.(\d+)/); // Match "images.0", "images.1", etc.
        if (match) {
            const index = parseInt(match[1], 10) + 1; // Convert to 1-based index
            return `Image-${index.toString().padStart(2, '0')}`; // e.g., Image-01
        }
        return field; // Fallback to original field name
    };

    // Iterate through errors and transform messages
    for (const field in errors) {
        errors[field].forEach((error) => {
            const friendlyField = friendlyFieldNames(field);
            errorTypes.add(error.replace(field, friendlyField)); // Replace field name
        });
    }

    errorContainer.innerHTML = ''; // Clear previous errors
    const errorDiv = document.createElement('div');
    errorDiv.classList.add('alert', 'alert-danger');
    errorDiv.textContent = overallMessage;

    const ul = document.createElement('ul');
    errorTypes.forEach((error) => {
        const li = document.createElement('li');
        li.textContent = error; // Add transformed error message
        ul.appendChild(li);
    });

    errorDiv.appendChild(ul);
    errorContainer.appendChild(errorDiv);
}
