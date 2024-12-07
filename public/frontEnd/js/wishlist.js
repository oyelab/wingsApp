document.addEventListener('DOMContentLoaded', function () {
	document.addEventListener('click', function (e) {
		if (e.target.closest('.wishlist-icon')) {
			e.preventDefault();
			const button = e.target.closest('.wishlist-icon');
			const productId = button.getAttribute('data-product-id');

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
					// Toggle the heart icon class
					const icon = button.querySelector('i');
					if (data.action === 'added') {
						icon.classList.remove('bi-heart');
						icon.classList.add('bi-heart-fill');
					} else if (data.action === 'removed') {
						icon.classList.remove('bi-heart-fill');
						icon.classList.add('bi-heart');
					}

					// Update the wishlist count
					const countElement = document.getElementById('wishlist-count');
					if (data.wishlist_count > 0) {
						countElement.textContent = data.wishlist_count;
					} else {
						countElement.textContent = '';
					}

					// Show a toast notification
					const toast = new bootstrap.Toast(document.getElementById('wishlist-toast'));
					document.querySelector('.toast-body').textContent =
						data.action === 'added'
							? 'Product added to wishlist!'
							: 'Product removed from wishlist!';
					toast.show();
				}
			})
			.catch(error => console.error('Error:', error));
		}
	});
});