<script src="{{ asset('frontEnd/js/jquery.min.js') }}"></script>

<!-- Place your kit's code here -->
<script src="https://kit.fontawesome.com/06f61db76e.js" crossorigin="anonymous"></script>

<script src="{{ asset('frontEnd/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontEnd/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontEnd/js/main.js') }}"></script>
<script>
    // Optional: This script is to ensure the badge is updated if necessary
    function updateCartCount() {
        $.ajax({
            url: '/cart/count',
            method: 'GET',
            success: function (response) {
                if (response.count > 0) {
                    $('#cart-count-badge').text(response.count).show();
                    $('#cart-button').removeClass('disabled'); // Enable click
                } else {
                    $('#cart-count-badge').hide(); // Hide badge
                    $('#cart-button').addClass('disabled'); // Disable click
                }
            },
            error: function () {
                console.log('Error fetching cart count.');
            }
        });
    }

    setInterval(updateCartCount, 1000);
	
    // Initial load of cart count
    updateCartCount();
</script>

@yield('scripts')