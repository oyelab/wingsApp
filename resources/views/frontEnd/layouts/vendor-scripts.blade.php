<script src="{{ asset('frontEnd/js/jquery.min.js') }}"></script>

<!-- Place your kit's code here -->
<!-- <script src="https://kit.fontawesome.com/06f61db76e.js" crossorigin="anonymous"></script> -->

<script src="{{ asset('frontEnd/js/bootstrap.bundle.min.js') }}"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

<script src="{{ asset('frontEnd/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontEnd/js/main.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
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

    // Update the cart count every 5 seconds
    setInterval(updateCartCount, 1000);

    // Initial load of cart count
    updateCartCount();
</script>
@yield('scripts')