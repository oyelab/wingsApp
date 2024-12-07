document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('click', function (e) {
        if (e.target.closest('.wishlist-icon')) {
            e.preventDefault();

            const button = e.target.closest('.wishlist-icon');
            const productId = button.getAttribute('data-product-id');
            const wishlistItem = button.closest('.wishlist-item');

            // Send the request to toggle the wishlist (for add/remove action)
            fetch("{{ route('wishlist.toggle') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ product_id: productId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const icon = button.querySelector('i');
                    if (data.action === 'added') {
                        icon.classList.remove('bi-heart');
                        icon.classList.add('bi-heart-fill');
                    } else if (data.action === 'removed') {
                        icon.classList.remove('bi-heart-fill');
                        icon.classList.add('bi-heart');

                        // If we are on the wishlist page, remove the product item from the list
                        if (wishlistItem && document.getElementById('wishlist-page')) {
                            wishlistItem.remove();
                        }
                    }

                    // Update the wishlist count
                    const countElement = document.getElementById('wishlist-count');
                    if (data.wishlist_count > 0) {
                        countElement.textContent = data.wishlist_count;
                        countElement.style.display = 'inline-block'; // Show the count
                    } else {
                        countElement.textContent = '';
                        countElement.style.display = 'none'; // Hide if wishlist is empty
                    }

                    // Show and automatically hide the toast notification
                    const toastElement = document.getElementById('wishlist-toast');
                    const toast = new bootstrap.Toast(toastElement);
                    document.querySelector('.toast-body').textContent =
                        data.action === 'added'
                            ? 'Product added to wishlist!'
                            : 'Product removed from wishlist!';
                    toast.show();
                } else {
                    console.error('Error:', data.message || 'Unknown error occurred');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
});
