(function ($) {
"use strict";

//preloader activation
var win =  $(window);
win.on('load', function () {
    $('#preloader').delay(350).fadeOut('slow');
    $('body').delay(350).css({
        'overflow': 'visible'
    });
})


    
// meanmenu
$('#mobile-menu').meanmenu({
	meanMenuContainer: '.mobile-menu',
	meanScreenWidth: "991"
});

//mobile side menu
$('.side-toggle').on('click', function () {
	$('.side-info').addClass('info-open');
	$('.offcanvas-overlay').addClass('overlay-open');
})

$('.side-info-close,.offcanvas-overlay').on('click', function () {
	$('.side-info').removeClass('info-open');
	$('.offcanvas-overlay').removeClass('overlay-open');
})

//sticky menu activation
win.on('scroll', function () {
	var scroll = win.scrollTop();
	if (scroll < 60) {
		$(".header-sticky").removeClass("sticky-menu");
	} else {
		$(".header-sticky").addClass("sticky-menu");
	}
});
    
// data - background
    $("[data-background]").each(function () {
        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
    })

    $("[data-bg-color]").each(function () {
        $(this).css("background-color", $(this).attr("data-bg-color"))
    })


//venobox activation
$('.venobox').venobox(); 

    
// Scroll To Top Js
	function smoothSctollTop() {
		$('.smooth-scroll a').on('click', function (event) {
			var target = $(this.getAttribute('href'));
			if (target.length) {
				event.preventDefault();
				$('html, body').stop().animate({
					scrollTop: target.offset().top - 0
				}, 1500);
			}
		});
	}
	smoothSctollTop();

	// Show or hide the sticky footer button
	win.on('scroll', function(event) {
		if($(this).scrollTop() > 600){
			$('#scroll').fadeIn(200)
		} else{
			$('#scroll').fadeOut(200)
		}
	});

	//Animate the scroll to yop
	$('#scroll').on('click', function(event) {
		event.preventDefault();

		$('html, body').animate({
			scrollTop: 0,
		}, 1500);
	});
    
    
	// WOW active
	var wow = new WOW(
		{
			mobile: false,       // trigger animations on mobile devices (default is true)
		}
	);
	wow.init();

// search bar
	
var $searchWrap = $('.search-wrap');
var $navSearch = $('.nav-search');
var $searchClose = $('#search-close');

$('.search-trigger').on('click', function (e) {
	e.preventDefault();
	$searchWrap.animate({ opacity: 'toggle' }, 500);
	$navSearch.add($searchClose).addClass("open");
});

$('.search-close').on('click', function (e) {
	e.preventDefault();
	$searchWrap.animate({ opacity: 'toggle' }, 500);
	$navSearch.add($searchClose).removeClass("open");
});

function closeSearch() {
	$searchWrap.fadeOut(200);
	$navSearch.add($searchClose).removeClass("open");
}

$(document.body).on('click', function (e) {
	closeSearch();
});

$(".search-trigger, .main-search-input").on('click', function (e) {
	e.stopPropagation();
});



	/*------------------------------------
        Slider
	--------------------------------------*/
	if (jQuery(".slider-active").length > 0) {
		let sliderActive1 = '.slider-active';
		let sliderInit1 = new Swiper(sliderActive1, {
			// Optional parameters
			slidesPerView: 1,
			slidesPerColumn: 1,
			paginationClickable: true,
			loop: false,
			effect: 'fade',

			autoplay: {
				delay: 5000,
			},

			// If we need pagination
			pagination: {
				el: '.swiper-paginations',
				// dynamicBullets: true,
				clickable: true,
			},

			// Navigation arrows
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},

			a11y: false
		});

		function animated_swiper(selector, init) {
			let animated = function animated() {
				$(selector + ' [data-animation]').each(function () {
					let anim = $(this).data('animation');
					let delay = $(this).data('delay');
					let duration = $(this).data('duration');

					$(this).removeClass('anim' + anim)
						.addClass(anim + ' animated')
						.css({
							webkitAnimationDelay: delay,
							animationDelay: delay,
							webkitAnimationDuration: duration,
							animationDuration: duration
						})
						.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
							$(this).removeClass(anim + ' animated');
						});
				});
			};
			animated();
			// Make animated when slide change
			init.on('slideChange', function () {
				$(sliderActive1 + ' [data-animation]').removeClass('animated');
			});
			init.on('slideChange', animated);
		}

		animated_swiper(sliderActive1, sliderInit1);
	}
    




    // testimonial 2 activation
	if (jQuery(".testimonial-active-2").length > 0) {
	let testimonial2 = new Swiper('.testimonial-active-2', {
		slidesPerView: 1,
		spaceBetween: 30,
		// direction: 'vertical',
		loop: true,
	  
		// If we need pagination
		pagination: {
		  el: '.swiper-pagination',
		  clickable: true,
		},
	  
		// Navigation arrows
		navigation: {
		  nextEl: '.swiper-button-next',
		  prevEl: '.swiper-button-prev',
		},
	  
		// And if we need scrollbar
		scrollbar: {
		  el: '.swiper-scrollbar',
		  dynamicBullets: true,
		},
		breakpoints: {
			640: {
			  slidesPerView: 1,
			},
			768: {
			  slidesPerView: 1,
			},
			1024: {
			  slidesPerView: 1,
			},
		  }

	  });
	}

    
    
    // testimonial 1 activation
	if (jQuery(".atestimonial-active").length > 0) {
	let atestimonial1 = new Swiper('.atestimonial-active', {
		slidesPerView: 1,
		spaceBetween: 30,
		// direction: 'vertical',
		loop: true,
	  
		// If we need pagination
		pagination: {
		  el: '.swiper-pagination',
		  clickable: true,
		},
	  
		// Navigation arrows
		navigation: {
		  nextEl: '.swiper-button-next',
		  prevEl: '.swiper-button-prev',
		},
	  
		// And if we need scrollbar
		scrollbar: {
		  el: '.swiper-scrollbar',
		},

	  });
	}
    
	// Nice activation
	$('select').niceSelect();

	  // owlCarousel
	  $(".brand-active").owlCarousel({
		loop: true,
		margin: 30,
		items: 4,
		navText: [
		  '<i class="fal fa-long-arrow-left"></i>',
		  '<i class="fal fa-long-arrow-right"></i>'
		],
		nav: true,
		dots: false,
		responsive: {
		  0: {
			items: 1
		  },
		  767: {
			items: 2
		  },
		  992: {
			items: 3
		  },
          1199: {
			items: 4
		  },
		  1399: {
			items: 4
		  }
		}
	  });


	  	  // owlCarousel
	  $(".countries-active").owlCarousel({
		loop: true,
		margin: 30,
		items: 4,
		navText: [
		  '<i class="fal fa-long-arrow-left"></i>',
		  '<i class="fal fa-long-arrow-right"></i>'
		],
		nav: true,
		dots: false,
		responsive: {
			0: {
				items: 1
			  },
			  767: {
				items: 2
			  },
			  992: {
				items: 3
			  },
			  1199: {
				items: 4
			  },
			  1399: {
				items: 4
			  }
		}
	  });

	// owlCarousel
	$(".abbrand-active").owlCarousel({
		loop: true,
		margin: 0,
		items: 6,
		navText: [
		  '<i class="fal fa-long-arrow-left"></i>',
		  '<i class="fal fa-long-arrow-right"></i>'
		],
		nav: false,
		dots: false,
		responsive: {
		  0: {
			items: 1
		  },
		  767: {
			items: 3
		  },
		  992: {
			items: 6
		  }
		}
	  });


	  // owlCarousel
	  $(".textimonail-active").owlCarousel({
		loop: true,
		margin: 30,
		items: 3,
		navText: [
		  '<i class="fal fa-long-arrow-left"></i>',
		  '<i class="fal fa-long-arrow-right"></i>'
		],
		nav: false,
		dots: true,
		responsive: {
		  0: {
			items: 1
		  },
		  767: {
			items: 2
		  },
		  992: {
			items: 3
		  }
		}
	  });
	  $(".testimonail2-active").owlCarousel({
		loop: true,
		margin: 30,
		items: 1,
		navText: [
		  '<i class="fal fa-angle-left"></i>',
		  '<i class="fal fa-angle-right"></i>'
		],
		nav: true,
		dots: true,
		responsive: {
		  0: {
			items: 1
		  },
		  767: {
			items: 1
		  },
		  992: {
			items: 1
		  }
		}
	  });

       /* magnificPopup img view */
		$(".popup-image").magnificPopup({
			type: "image",
			gallery: {
			enabled: true
			}
		});
       
		/* magnificPopup video view */
		$(".popup-video").magnificPopup({
			type: "iframe",
		});
      // Counter Js

	$('.counter').counterUp({
		delay: 100,
		time: 1000
	});

/*========== Project Grid  ==========*/
var $grid = $('.project-grid').isotope({});
/*========== Project Filter  ==========*/
$('.project-filter').on('click', 'li', function () {
	var filterValue = $(this).attr('data-filter');
	$grid.isotope({
		filter: filterValue
	});
});

//for menu active class
$('.project-filter li').on('click', function(event) {
	$(this).siblings('.active').removeClass('active');
	$(this).addClass('active');
	event.preventDefault();
});




})(jQuery);