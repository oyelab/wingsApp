(function ($) {
    "use strict";

    var windowOn = $(window);

    // Password show hide
    document.querySelectorAll(".password-show-hide").forEach((button) => {
        button.addEventListener("click", function () {
            // Find the closest input field within the same container
            const passwordField =
                this.parentElement.querySelector(".password-field");

            // Toggle the password field type
            const type =
                passwordField.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            passwordField.setAttribute("type", type);

            // Toggle the show and hide icons
            const showIcon = this.querySelector(".show-icon");
            const hideIcon = this.querySelector(".hide-icon");

            if (type === "password") {
                showIcon.style.display = "inline";
                hideIcon.style.display = "none";
            } else {
                showIcon.style.display = "none";
                hideIcon.style.display = "inline";
            }
        });
    });

    var buttonPlus = $(".qty-btn-plus");
    var buttonMinus = $(".qty-btn-minus");

    var incrementPlus = buttonPlus.click(function () {
        var $n = $(this).parent(".qty-container").find(".input-qty");
        $n.val(Number($n.val()) + 1);
    });

    var incrementMinus = buttonMinus.click(function () {
        var $n = $(this).parent(".qty-container").find(".input-qty");
        var amount = Number($n.val());
        if (amount > 0) {
            $n.val(amount - 1);
        }
    });

    // back-to-top
    var btn = $("#back-to-top");
    windowOn.scroll(function () {
        if (windowOn.scrollTop() > 300) {
            btn.addClass("show");
        } else {
            btn.removeClass("show");
        }
    });
    btn.on("click", function () {
        $("html, body").animate({ scrollTop: 0 }, "300");
    });

    // sticky header js
    windowOn.on("scroll", function () {
        var scroll = windowOn.scrollTop();
        if (scroll < 100) {
            $("#wings-header-sticky").removeClass("header-sticky");
        } else {
            $("#wings-header-sticky").addClass("header-sticky");
        }
    });

    /**
     * Hero Image Slider
     */
    let heroSlider = new Swiper(".heroSlider", {
        spaceBetween: 30,
        grabCursor: true,
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

	// Generate a random delay function
	function getRandomDelay(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}

    // Latest Arrival
    var swiper = new Swiper(".latest-arrival", {
        slidesPerView: 4,
        spaceBetween: 38,
        autoplay: {
			delay: getRandomDelay(2000, 5000), // Random delay between 2s and 5s
            disableOnInteraction: false,
        },
        loop: true,
        keyboard: {
            enabled: true,
        },
        navigation: {
            nextEl: ".la-next",
            prevEl: ".la-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 4,
            },
        },
    });

    // Top Picks
    var swiper = new Swiper(".top-picks", {
        slidesPerView: 4,
        spaceBetween: 38,
        autoplay: {
			delay: getRandomDelay(2000, 5000), // Random delay between 2s and 5s
            disableOnInteraction: false,
        },
        loop: true,
        keyboard: {
            enabled: true,
        },
        navigation: {
            nextEl: ".tp-next",
            prevEl: ".tp-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 4,
            },
        },
    });

    // On Trend
    var swiper = new Swiper(".on-trend", {
        slidesPerView: 4,
        spaceBetween: 38,
        autoplay: {
			delay: getRandomDelay(2000, 5000), // Random delay between 2s and 5s
            disableOnInteraction: false,
        },
        loop: true,
        keyboard: {
            enabled: true,
        },
        navigation: {
            nextEl: ".ot-next",
            prevEl: ".ot-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 4,
            },
        },
    });

    // Hot Deals
    var swiper = new Swiper(".hot-deals", {
        slidesPerView: 4,
        spaceBetween: 38,
        autoplay: {
			delay: getRandomDelay(2000, 5000), // Random delay between 2s and 5s
            disableOnInteraction: false,
        },
        loop: true,
        keyboard: {
            enabled: true,
        },
        navigation: {
            nextEl: ".hd-next",
            prevEl: ".hd-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 4,
            },
        },
    });

    // Customer stories
    var swiper = new Swiper(".customer-stories", {
        slidesPerView: 3,
        spaceBetween: 36,
		autoplay: {
			delay: getRandomDelay(3000, 5000), // Random delay between 2s and 5s
            disableOnInteraction: false,
        },
        loop: true,
        keyboard: {
            enabled: true,
        },
        navigation: false,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
        },
    });

    // venue-slider
    var swiper = new Swiper(".venue-slider-active", {
        slidesPerView: 4,
        spaceBetween: 24,
        keyboard: {
            enabled: true,
        },
        navigation: {
            nextEl: ".venue-next",
            prevEl: ".venue-prev",
        },
        scrollbar: {
            el: ".venue-scrollbar",
            hide: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 4,
            },
        },
    });

    /**
     * Proud Kit Partner Logo Slider
     */
    let proudKitPartner = new Swiper(".proudKitPartner", {
        cssMode: true,
        slidesPerView: 3,
        spaceBetween: 10,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        mousewheel: true,
        keyboard: true,
        breakpoints: {
            640: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 5,
                spaceBetween: 24,
            },
            1024: {
                slidesPerView: 6,
                spaceBetween: 24,
            },
        },
    });

    /**
     * Product Details page slider
     */
    var productImage = new Swiper(".productGalleryThumb", {
        loop: true,
        spaceBetween: 20,
        slidesPerView: 4,
        freeMode: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        watchSlidesProgress: true,
        direction: "vertical",
    });
    var productImageThumb = new Swiper(".productMainImage", {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        spaceBetween: 10,
        navigation: {
            nextEl: ".main-p-next",
            prevEl: ".main-p-prev",
        },
        thumbs: {
            swiper: productImage,
        },
    });

	document.addEventListener('DOMContentLoaded', function () {
		// Get the cookie alert element
		const cookieAlert = document.getElementById('cookieAlert');
	
		// Check if cookies are accepted by looking for the "cookiesAccepted" cookie
		const cookiesAccepted = document.cookie.split(';').some((item) => item.trim().startsWith('cookiesAccepted='));
	
		// If cookies are accepted, hide the alert immediately without any flicker
		if (cookiesAccepted) {
			cookieAlert.style.display = 'none'; // Hide the alert if already accepted
			return; // No need to show the alert or add any listeners if accepted
		}
	
		// If cookies are not accepted, show the cookie alert immediately after the page loads
		cookieAlert.style.display = 'flex';
	
		// Get the Accept and Dismiss buttons
		const acceptButton = document.getElementById('acceptCookies');
		const dismissButton = document.getElementById('dismissCookies');
	
		// Accept button action - Store in cookies and hide the alert
		acceptButton.addEventListener('click', function () {
			// Set a cookie to indicate cookies are accepted
			document.cookie = "cookiesAccepted=true; path=/; max-age=" + 60*60*24*365; // Set cookie for 1 year
			cookieAlert.style.display = 'none'; // Hide the alert immediately after accepting
		});
	
		// Dismiss button action - Hide the alert without storing acceptance
		dismissButton.addEventListener('click', function () {
			cookieAlert.style.display = 'none';
		});
	});
	
			
	
})(jQuery);
