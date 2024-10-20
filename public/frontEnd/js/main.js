(function ($) {
	'use strict';

	var windowOn = $(window);

	// Password show hide
	document.querySelectorAll('.password-show-hide').forEach((button) => {
		button.addEventListener('click', function () {
			// Find the closest input field within the same container
			const passwordField =
				this.parentElement.querySelector('.password-field');

			// Toggle the password field type
			const type =
				passwordField.getAttribute('type') === 'password'
					? 'text'
					: 'password';
			passwordField.setAttribute('type', type);

			// Toggle the show and hide icons
			const showIcon = this.querySelector('.show-icon');
			const hideIcon = this.querySelector('.hide-icon');

			if (type === 'password') {
				showIcon.style.display = 'inline';
				hideIcon.style.display = 'none';
			} else {
				showIcon.style.display = 'none';
				hideIcon.style.display = 'inline';
			}
		});
	});

	// back-to-top
	var btn = $('#back-to-top');
	windowOn.scroll(function () {
		if (windowOn.scrollTop() > 300) {
			btn.addClass('show');
		} else {
			btn.removeClass('show');
		}
	});
	btn.on('click', function () {
		$('html, body').animate({ scrollTop: 0 }, '300');
	});

	// sticky header js
	windowOn.on('scroll', function () {
		var scroll = windowOn.scrollTop();
		if (scroll < 100) {
			$('#wings-header-sticky').removeClass('header-sticky');
		} else {
			$('#wings-header-sticky').addClass('header-sticky');
		}
	});

	/**
	 * Hero Image Slider
	 */
	let heroSlider = new Swiper('.heroSlider', {
		spaceBetween: 30,
		grabCursor: true,
		effect: 'fade',
		loop: true,
		autoplay: {
			delay: 4000,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
	});

	// Latest Arrival
	var swiper = new Swiper('.latest-arrival', {
		slidesPerView: 4,
		spaceBetween: 38,
		keyboard: {
			enabled: true,
		},
		navigation: {
			nextEl: '.la-next',
			prevEl: '.la-prev',
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

	// Top Picks
	var swiper = new Swiper('.top-picks', {
		slidesPerView: 3,
		spaceBetween: 38,
		keyboard: {
			enabled: true,
		},
		navigation: {
			nextEl: '.tp-next',
			prevEl: '.tp-prev',
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
				slidesPerView: 3,
			},
		},
	});

	// On Trend
	var swiper = new Swiper('.on-trend', {
		slidesPerView: 3,
		spaceBetween: 38,
		keyboard: {
			enabled: true,
		},
		navigation: {
			nextEl: '.ot-next',
			prevEl: '.ot-prev',
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
				slidesPerView: 3,
			},
		},
	});

	// Hot Deals
	var swiper = new Swiper('.hot-deals', {
		slidesPerView: 3,
		spaceBetween: 38,
		keyboard: {
			enabled: true,
		},
		navigation: {
			nextEl: '.hd-next',
			prevEl: '.hd-prev',
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
				slidesPerView: 3,
			},
		},
	});

	// venue-slider
	var swiper = new Swiper('.venue-slider-active', {
		slidesPerView: 4,
		spaceBetween: 24,
		keyboard: {
			enabled: true,
		},
		navigation: {
			nextEl: '.venue-next',
			prevEl: '.venue-prev',
		},
		scrollbar: {
			el: '.venue-scrollbar',
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
})(jQuery);
