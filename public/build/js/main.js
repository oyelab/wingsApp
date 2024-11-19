window.addEventListener('scroll', function() {
    const stickyContainer = document.querySelector('.sticky-container');
    const stickyOffset = stickyContainer.getBoundingClientRect().top; // Get the element's position relative to the viewport

    if (stickyOffset <= 0) { // When the sticky element reaches its final position
        stickyContainer.classList.add('sticky-transparent');
    } else {
        stickyContainer.classList.remove('sticky-transparent');
    }
});

$('body').on('click', '#remove-prev-image', function(evt) {
    var divName = this.value;
    var imageName = $(this).attr('role');
    $(`#${divName}`).remove(); // Remove image preview

    // Remove the hidden input associated with this image
    $('input[name="existing_images[]"][value="' + imageName + '"]').remove();

    evt.preventDefault();
});

$(document).ready(function() {
    var fileArr = [];

    // When a user uploads new images
    $("#images").change(function() {
        // Clear previous images if new images are uploaded
        if (fileArr.length > 0) fileArr = [];
        $('#image_preview').html(""); // Clear previous preview

        var total_file = document.getElementById("images").files;
        if (!total_file.length) return;

        // Preview the new images
        for (var i = 0; i < total_file.length; i++) {
            if (total_file[i].size > 1048576) {
                return false;
            } else {
                fileArr.push(total_file[i]);
                $('#image_preview').append("<div class='img-div' id='img-div"+i+"'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive image img-thumbnail' title='"+total_file[i].name+"'><div class='middle'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger' role='"+total_file[i].name+"'><i class='fa fa-trash'></i></button></div></div>");
            }
        }
    });

    // Remove individual previous images
    $('body').on('click', '#remove-prev-image', function(evt) {
        var divName = this.value;
        var imageName = $(this).attr('role');
        $(`#${divName}`).remove();

        // Update the product's images in case you need to handle it on the backend
        // You can create a mechanism to track which previous images were removed if necessary

        evt.preventDefault();
    });

    // Remove new images on delete
    $('body').on('click', '#action-icon', function(evt) {
        var divName = this.value;
        var fileName = $(this).attr('role');
        $(`#${divName}`).remove();

        // Remove the file from fileArr
        for (var i = 0; i < fileArr.length; i++) {
            if (fileArr[i].name === fileName) {
                fileArr.splice(i, 1);
            }
        }

        // Update the FileList to exclude the deleted image
        document.getElementById('images').files = FileListItem(fileArr);
        evt.preventDefault();
    });

    // Helper function to rebuild the FileList object
    function FileListItem(file) {
        file = [].slice.call(Array.isArray(file) ? file : arguments);
        for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File;
        if (!d) throw new TypeError("expected argument to FileList is File or array of File objects");
        for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c]);
        return b.files;
    }
});


// Validate Input Function
function validateInput(input) {
    const errorMessage = document.querySelector(`.error-message[data-for="${input.name}"]`);

    // Check if the input value is empty
    if (input.value.trim() === "") {
        errorMessage.style.display = 'block'; // Show error message if empty
    } else {
        // Additional check for price input to ensure it's a valid number
        if (input.name === 'price' && isNaN(input.value.trim())) {
            errorMessage.style.display = 'block'; // Show error message for invalid number
        } else {
            errorMessage.style.display = 'none'; // Hide error message if valid
        }
    }
}

// Set Sale Function
function setSale() {
    const saleInput = document.getElementById('sale');
    const saleValue = saleInput.value;

    // Check if the sale input is empty or not a number
    if (saleValue === '' || isNaN(saleValue)) {
        alert('Please enter a valid offer percentage.'); // Alert user about invalid input
        saleInput.focus(); // Set focus back to the input
        return; // Prevent closing the modal
    }

    document.getElementById('hiddenSale').value = saleValue; // Set the value to the hidden input
    // Close the modal after saving
    const modal = bootstrap.Modal.getInstance(document.getElementById('offerModal'));
    modal.hide();
}

// Validate Form Function
function validateForm(event) {
    let isValid = true;
    const inputs = document.querySelectorAll('input[required]');

    inputs.forEach(input => {
        validateInput(input); // Validate each input
        const errorMessage = document.querySelector(`.error-message[data-for="${input.name}"]`);
        if (errorMessage.style.display === 'block') {
            isValid = false; // Set validity to false if any error message is shown
        }
    });

    if (!isValid) {
        event.preventDefault(); // Prevent form submission if validation fails
    }

    return isValid; // Return the validity state
}

// // Document Ready Function
// document.addEventListener('DOMContentLoaded', function () {
//     const categorySelector = document.getElementById('categorySelector');
//     const selectElement = document.getElementById('categories');

//     // Function to update the category selector with selected options
//     function updateCategorySelector() {
//         const selectedOptions = Array.from(selectElement.selectedOptions).map(option => option.text);
//         categorySelector.innerHTML = selectedOptions.length > 0 ? selectedOptions.join(', ') : 'Select one or more categories from here';
//     }

//     // Initialize on page load to show already selected categories
//     updateCategorySelector();

//     // Show the select dropdown when clicking on the custom selector
//     categorySelector.addEventListener('click', function () {
//         selectElement.style.display = 'block';
//         selectElement.focus();
//     });

//     // Update the category selector when categories are changed
//     selectElement.addEventListener('change', function () {
//         updateCategorySelector();
//     });

//     // Hide the select dropdown when clicking outside of it
//     document.addEventListener('click', function (event) {
//         if (!categorySelector.contains(event.target) && !selectElement.contains(event.target)) {
//             selectElement.style.display = 'none';
//         }
//     });
// });

// Choices.js Initialization
var textRemove = new Choices(
    document.getElementById('choices-text-remove-button'),
    {
        delimiter: ',',
        editItems: true,
        maxItemCount: 10,
        removeItemButton: true,
		allowHTML: true,
    }
);

const ogImageInput = document.getElementById('ogImage');
const imagePreview = document.getElementById('imagePreview');

ogImageInput.addEventListener('change', function () {
	const file = this.files[0];

	if (file) {
		const reader = new FileReader();
		reader.onload = function (e) {
			imagePreview.src = e.target.result; // Set the src of the preview
			imagePreview.classList.remove('d-none'); // Show the image
		}
		reader.readAsDataURL(file); // Read the file as a data URL
	} else {
		imagePreview.src = '';
		imagePreview.classList.add('d-none'); // Hide the image if no file is selected
	}
});

// Form Validation on Submission
$(document).ready(function () {
    // On form submission, validate the file input
    // $('form').on('submit', function (event) {
    //     // Get the file input element
    //     const fileInput = document.getElementById('images');
    //     const files = fileInput.files;

    //     // Check if no files are selected
    //     if (files.length === 0) {
    //         event.preventDefault(); // Prevent form submission
    //         const fileErrorMessage = document.querySelector(`.error-message[data-for="images"]`);
    //         fileErrorMessage.style.display = 'block'; // Show error message if no files selected
    //     } else {
    //         const fileErrorMessage = document.querySelector(`.error-message[data-for="images"]`);
    //         fileErrorMessage.style.display = 'none'; // Hide error message if files are selected
    //     }
    // });

    // Initialize Summernote
    $('#summernote').summernote({
        // height: 200,  // Set editor height
        placeholder: 'Enter Product Description',
        callbacks: {
            onChange: function (contents, $editable) {
                // Sync Summernote content to the textarea
                $('#productdesc').val(contents);
            }
        }
    });

    // Set initial content if available from old input
    if ($('#productdesc').val()) {
        $('#summernote').summernote('code', $('#productdesc').val());
    }
});
