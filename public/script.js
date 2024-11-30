const imageInput = document.getElementById('imageInput');
const uploadForm = document.getElementById('uploadForm');
const gallery = document.getElementById('gallery');
const submitThumbnail = document.getElementById('submitThumbnail');

let uploadedImages = []; // Stores URLs of uploaded images
let selectedThumbnail = null;

// Listen for file input changes to show previews
imageInput.addEventListener('change', () => {
    const files = Array.from(imageInput.files);
    if (files.length > 0) {
        previewImages(files);
    }
});

// Handle form submission for image upload
uploadForm.addEventListener('submit', async (event) => {
    event.preventDefault();

    const files = imageInput.files;

    if (files.length === 0) {
        alert('Please select at least one image.');
        return;
    }

    const formData = new FormData();
    for (const file of files) {
        formData.append('images[]', file);
    }

    try {
        const response = await fetch('/upload', { // Replace '/upload' with your server endpoint
            method: 'POST',
            body: formData,
        });

        if (!response.ok) {
            throw new Error('Upload failed.');
        }

        const data = await response.json();
        uploadedImages = data.uploadedImages; // Assuming server sends URLs of uploaded images
        alert('Images uploaded successfully!');
    } catch (error) {
        console.error('Error uploading images:', error);
        alert('Failed to upload images.');
    }
});

// Display previews of selected images
function previewImages(files) {
    gallery.innerHTML = ''; // Clear previous previews
    files.forEach((file) => {
        const reader = new FileReader();
        reader.onload = (event) => {
            const img = document.createElement('img');
            img.src = event.target.result; // Local preview
            img.alt = 'Preview Image';
            img.addEventListener('click', () => selectThumbnail(file.name, img));
            gallery.appendChild(img);
        };
        reader.readAsDataURL(file); // Convert file to data URL
    });

    submitThumbnail.style.display = 'block';
}

// Select an image as the thumbnail
function selectThumbnail(fileName, imgElement) {
    selectedThumbnail = fileName;

    // Remove selection from other images
    const images = gallery.querySelectorAll('img');
    images.forEach((img) => img.classList.remove('selected'));

    // Highlight the selected image
    imgElement.classList.add('selected');
}

// Submit the selected thumbnail
submitThumbnail.addEventListener('click', async () => {
    if (!selectedThumbnail) {
        alert('Please select a thumbnail.');
        return;
    }

    try {
        const response = await fetch('/set-thumbnail', { // Replace '/set-thumbnail' with your server endpoint
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ thumbnail: selectedThumbnail }),
        });

        if (!response.ok) {
            throw new Error('Failed to set thumbnail.');
        }

        alert('Thumbnail set successfully!');
    } catch (error) {
        console.error('Error setting thumbnail:', error);
        alert('Failed to set thumbnail.');
    }
});
