/* Check Form */
ValidationFormSelf("validation-contact");
ValidationFormSelf("validation-cart");
ValidationFormSelf("frm_newsletter");
ValidationFormSelf("validation-user");


/* Exists */
$.fn.exists = function () {
	return this.length;
};

if (window.location.hash === "#_=_") {
	history.replaceState ? history.replaceState(null, null, window.location.href.split("#")[0]) : window.location.hash = "";
}


MIKOTECH.AllPage = function () {

	// $("html").easeScroll({
	// 	frameRate: 50,
	// 	animationTime: 2000,
	// 	stepSize: 120,
	// 	pulseAlgorithm: 1,
	// 	pulseScale: 8,
	// 	pulseNormalize: 1,
	// 	accelerationDelta: 20,
	// 	accelerationMax: 1,
	// 	keyboardSupport:true,
	// 	arrowScroll: 50,
	// 	touchpadSupport:true,
	// 	fixedBackground:true
	// });

	$('.lang-btn').click(function () {
		var dt_lang = $(this).attr('data-lang');
		$('body').removeAttr('class').addClass('font-body lang-current-' + dt_lang);
	});

	var e_find_current = $('.find-current');
	var check_has_current = e_find_current.find('li').hasClass('current-active');
	if (check_has_current) {
		e_find_current.addClass('current-active');
	}


	// $('.eye-btn').click(function () {
	// 	var e = $(this).attr('data-e');

	// 	if (!$(this).hasClass('eye-active')) {
	// 		$(e).attr('type', 'text');
	// 		$(this).addClass('eye-active');
	// 	} else {
	// 		$(this).removeClass('eye-active');
	// 		$(e).attr('type', 'password');
	// 	}
	// });

	// $('.footer-toggle').click(function () {
	// 	var e_id = $(this).attr('data-id');
	// 	if ($(e_id).hasClass('hidden')) {
	// 		$(e_id).removeClass('hidden').addClass('flex');
	// 	} else {
	// 		$(e_id).addClass('hidden').removeClass('flex');
	// 	}
	// });

	// $('.footer-toggle-other').click(function () {
	// 	var e_id = $(this).attr('data-id');
	// 	if ($(e_id).hasClass('hidden')) {
	// 		$(e_id).removeClass('hidden').addClass('block');
	// 	} else {
	// 		$(e_id).addClass('hidden').removeClass('block');
	// 	}
	// });

	$('#search-btn').click(function () {
		var e_search = $('#search-box');
		if (!e_search.hasClass('has-search')) {
			e_search.css({ 'top': '90px', 'z-index': '99999', 'opacity': '100' }).addClass('has-search');
			$('.search-open').removeClass('opacity-100').addClass('opacity-0');
			$('.search-close').addClass('opacity-100').removeClass('opacity-0');
		} else {
			e_search.removeAttr('style').removeClass('has-search');
			$('.search-open').addClass('opacity-100').removeClass('opacity-0');
			$('.search-close').removeClass('opacity-100').addClass('opacity-0');
		}
	});


	$('#view-btn').click(function () {
		var e_search = $('#view-box');
		if (!e_search.hasClass('has-search')) {
			e_search.css({ 'top': '80px', 'z-index': '99999', 'opacity': '100', 'visibility': 'visible' }).addClass('has-search');
			$('.view-open').removeClass('opacity-100').addClass('opacity-0');
			$('.view-close').addClass('opacity-100').removeClass('opacity-0');
		} else {
			e_search.removeAttr('style').removeClass('has-search');
			$('.view-open').addClass('opacity-100').removeClass('opacity-0');
			$('.view-close').removeClass('opacity-100').addClass('opacity-0');
		}
	});


	if ($("#dienthoai").exists()) {
		var cleave = new Cleave('#dienthoai', {
			phone: true,
			phoneRegionCode: 'vn'
		});
	}

	if ($("#age").exists()) {
		var cleave = new Cleave('#age', {
			delimiter: '',
			numeral: true
		});
	}

	var lastScrollTop = 0;
	var height_menu = $('#menu').innerHeight();
	var height_menu_mobile = $('#header').innerHeight();

	$(window).scroll(function (event) {

		var st = $(this).scrollTop();

		if (st <= 0) {

			st = 0;

		}



		if (st > lastScrollTop) {

			if (st > height_menu) {

				document.getElementById("menu").style.top = "-" + height_menu + "px";

				document.getElementById("header").style.top = "-" + height_menu_mobile + "px";

				$('.detail__right').css('top', '20px');

				$('#header').addClass('header-scroll');

			}



		} else if (st <= 0) {

			//document.getElementById("menu").style.top = "0px";

			document.getElementById("menu").style.position = 'fixed';

			//$("#menu").removeClass('shadow-shadow1');
			//$("#menu").removeClass('fix-menu');

			// setTimeout(function(){
			// 	document.getElementById("menu").style.top = '-145px';//"0px";
			// }, 500);


			document.getElementById("menu").style.top = '0px';//"0px";
			// setTimeout(function(){
			// 	document.getElementById("menu").style.top = '31px';//"0px";
			// }, 1000);



			$("#header").removeClass('shadow-shadow2');

			$('.detail__right').css('top', '20px');



			document.getElementById("header").style.top = "0px";

			document.getElementById("header").style.position = 'fixed';

			$('#header').removeClass('header-scroll');

		} else {

			document.getElementById("menu").style.top = '0px';//"0px";

			document.getElementById("menu").style.position = 'fixed';

			//$("#menu").addClass('shadow-shadow1');

			//$("#menu-blur").addClass('opacity-100 h-full -top-full');

			//$("#menu-blur").removeClass('-top-full');

			//$("#menu-blur").addClass('opacity-100 h-full opacity-0');

			//$("#menu-blur").removeClass('opacity-0');



			$("#header").addClass('shadow-shadow2');

			$('.detail__right').css('top', '105px');



			document.getElementById("header").style.top = "0px";

			document.getElementById("header").style.position = 'fixed';

		}

		lastScrollTop = st;

	});

	//### set scroll
	$(function () {
		var $window = $(window),
			win_height_padded = $window.height() * 1.1,
			isTouch = Modernizr.touch;

		//if (isTouch) { $('.revealOnScroll').addClass('animated'); }

		$window.on('scroll load', revealOnScroll);

		function revealOnScroll() {
			var scrolled = $window.scrollTop(),
				win_height_padded = $window.height() * 1.1;

			// Showed...
			$(".revealOnScroll:not(.animated)").each(function () {
				var $this = $(this),
					offsetTop = $this.offset().top;

				if (scrolled + win_height_padded > offsetTop) {
					if ($this.data('timeout')) {
						window.setTimeout(function () {
							$this.addClass('animated ' + $this.attr('data-animation'));
						}, parseInt($this.data('timeout'), 10));
					} else {
						$this.addClass('animated ' + $this.attr('data-animation') + ' ' + offsetTop);
					}
				}
			});
			// Hidden...
			$(".revealOnScroll.animated").each(function (index) {
				var $this = $(this),
					offsetTop = $this.offset().top;
				if (scrolled + win_height_padded < offsetTop) {
					$(this).removeClass('animated animate__fadeIn animate__fadeInLeft animate__fadeInRight animate__fadeInUp animate__backInRight animate__backInLeft animate__zoomIn animate__zoomOut')
				}
			});
		}

		revealOnScroll();
	});

	$(document).on("click", function (event) {
		if ($(event.target).closest(".modal-menu-full").length === 0 && $(event.target).closest(".header-menu-btn").length === 0) {
			$('.modal-menu-close').trigger('click');
		}
	});


	// $('body').on('click', '.scroll-btn', function() {
	// 	console.log('ok');
	// 	var div  = $(this).attr('datae');

	// 	$('html, body').animate({
	// 		scrollTop: $(div).offset().top
	// 	}, 2000);
	// });


	// $(document).on("click", function (event) {
	// 	// If the target is not the container or a child of the container, then process
	// 	// the click event for outside of the container.
	// 	if ($(event.target).closest("#show-content-ajax").length === 0) {
	// 	  	$('.show-popup-close').trigger('click');
	// 	}
	// });


	$('.btn-popup-show').click(function () {
		$('#loading_order').hide();
		$('#show-popup-post').addClass('show-popup-active');
	});

	$("body").on("click", ".show-popup-close", function () {
		$('#show-popup-post').removeClass('show-popup-active');
	});


	// $(document).on("click", function (event) {
	// 	// If the target is not the container or a child of the container, then process
	// 	// the click event for outside of the container.
	// 	if ($(event.target).closest("#show-content-ajax").length === 0) {
	// 	  	$('.show-popup-close').trigger('click');
	// 	}
	// });

	$('.login-account-close').click(function () {
		$('.login-account-contain').removeClass('login-account-contain-open');
	});


	$('.header-open-account').click(function () {
		$('.login-account-contain').addClass('login-account-contain-open');
	});


	$('.btn-toggle-lang').click(function () {
		$('#lang-element').toggle();
	});


	$('.flag-btn').click(function () {
		var lang = $(this).attr('data-lang-act');
		setTimeout(function () {
			$('#lang-main').text(lang);
			console.log(lang);
		}, 1000);

		$('.btn-toggle-lang').trigger('click');
	});


	$('.btn-toggle-footer').click(function () {
		var e = $(this).attr('data-id');
		//var text = $(this).attr('data-text');
		$(e).toggle();

		if (!$(this).hasClass('btn-toggle-footer-active')) {
			$(this).addClass('btn-toggle-footer-active');
		} else {
			$(this).removeClass('btn-toggle-footer-active');
		}
	});


	$('body').on('click', '.scroll-btn', function () {
		var div = $(this).attr('datae');

		//$('.modal-menu-close').trigger('click');

		$('html, body').animate({
			scrollTop: $(div).offset().top
		}, 800);
	});


	// $(document).on("click", function (event) {
	// 	// If the target is not the container or a child of the container, then process
	// 	// the click event for outside of the container.
	// 	if ($(event.target).closest(".modal-menu-full").length === 0 && $(event.target).closest(".header-menu-btn").length === 0 && $(event.target).closest("#show-content-ajax").length === 0) {
	// 		//$('.show-popup-close').trigger('click');
	// 	  	$('.modal-menu-close').trigger('click');
	// 	}
	// });

	GetPhotoZone();

	$('.btn-popup').click(function () {
		var id_e = $(this).attr('data-id');
		var selected_e = $(this).attr('data-selected');
		var name = $(this).attr('data-name');
		//console.log(name);

		$('#sanphammuonmua').val('');
		$(id_e).addClass('form-tuyendung-active');
		$(id_e).find('select[name="loaituyendung"]').val(selected_e);
		$('#sanphammuonmua').val(name);

	});

	$('.menu-search').click(function () {
		if (!$('.menu-search-show').hasClass('menu-search-main-block')) {
			$('.menu-search-show').addClass('menu-search-main-block');
		} else {
			$('.menu-search-show').removeClass('menu-search-main-block');
		}
	});


	$('.menu-search-close').click(function () {
		$('.menu-search-show').removeClass('menu-search-main-block');
	});

	$('.btn-popup').click(function () {
		var id_e = $(this).attr('data-id');
		var selected_e = $(this).attr('data-selected');

		$(id_e).addClass('form-tuyendung-active');
		$(id_e).find('select[name="loaituyendung"]').val(selected_e);

	});

	$('.form-tuyendung-close').click(function () {
		$('#form-tuyendung').removeClass('form-tuyendung-active');
	});


	/*
	$('.login-account-close').click(function(){
		$('.login-account-contain').removeClass('login-account-contain-open');
	});


	$('.header-open-account').click(function(){
		$('.login-account-contain').addClass('login-account-contain-open');
	});*/

	$(document).on("contextmenu", function (e) {
		e.preventDefault();
	});


	/*$(window).scroll(function(){
		var h_header = $('#header').innerHeight();
		var h_menu = $('#menu').innerHeight();
		var w_width = $(window).width();

		if($(this).scrollTop()>100){
			if(!$('.header-contain').hasClass('mobile-menu-sticky')){
				$('.header-contain').addClass('mobile-menu-sticky');
			}
		}else{
			$('.header-contain').removeClass('mobile-menu-sticky');
		}

		if(w_width>1024){
			if($(this).scrollTop()>100){
				if(!$('#menu').hasClass('menu-sticky')){
					$('#menu').addClass('menu-sticky');
				}
			}else{
				$('#menu').removeClass('menu-sticky');
			}
		}
	});*/

	$('.show-menu-close').click(function () {
		$('#show-menu-small').removeClass('visible-menu-small');
	});

	$('.menu-last-item').click(function () {
		var e_menu = $('#show-menu-small');
		if (!e_menu.hasClass('visible-menu-small')) {
			e_menu.addClass('visible-menu-small');
		} else {
			e_menu.removeClass('visible-menu-small');
		}
	});


	// $(window).scroll(function () {
	// 	if ($(this).scrollTop() > 100) $('.back-to-top').fadeIn();
	// 	else $('.back-to-top').fadeOut();
	// });

	$('body').on("click", ".back-to-top", function () {
		$('html, body').animate({ scrollTop: 0 }, 1000);
		return false;
	});

	$('.menu-side-title span').click(function () {
		$(this).parents('li').children('ul').toggle(300);
	});

	$('.header-search button, .header-search-close').click(function () {
		var e_target = $('.header-search-container');

		if (!e_target.hasClass('header-search-active')) {
			e_target.addClass('header-search-active');
		} else {
			e_target.removeClass('header-search-active');
		}
	});


	$('.header-menu-btn').click(function () {
		var e_show = $(this).attr('data-id');
		$(e_show).addClass('modal-menu-show');
		$('.header-menu-btn').css('opacity', '0');
		$('.modal-menu-close').attr('data-id', e_show);
		$('body').addClass('body-menu-mobile');
	});

	$('.modal-menu-close').click(function () {
		var e_show = $(this).attr('data-id');
		$(e_show).removeClass('modal-menu-show');
		$('.header-menu-btn').css('opacity', '1');
		$('body').removeClass('body-menu-mobile');
	});

	$('#menu-sidebar ul li').children('ul').addClass('menu-sidebar-pad');
	$('#menu-sidebar >li').append('<span class="menu-sidebar-right"><i class="fal fa-chevron-right"></i><span>');
	$('#menu-sidebar li').children('ul').parent().append('<span class="menu-sidebar-down" data-change="fa-chevron-down" ><i class="fal fa-chevron-down"></i><span>');
	$('#menu-sidebar >li').hover(function () {
		$('#menu-sidebar li').removeClass('menu-sidebar-active');
		$(this).addClass('menu-sidebar-active');
	});

	$('.menu-sidebar-down').click(function () {
		$(this).parent('li').children('ul').toggle(300);

		var e_idown = $(this).find('i');
		var dataClass = $(this).attr('data-change');

		if (dataClass == 'fa-chevron-down') {
			e_idown.removeClass('fa-chevron-down');
			e_idown.addClass('fa-horizontal-rule');
			$(this).attr('data-change', 'fa-horizontal-rule');
		}
		if (dataClass == 'fa-horizontal-rule') {
			e_idown.addClass('fa-chevron-down');
			e_idown.removeClass('fa-horizontal-rule');
			$(this).attr('data-change', 'fa-chevron-down');
		}

	});
};


MIKOTECH.OwlPage = function () {
	if ($(".slide__owl").exists()) {
		function getRandomAnimation() {
			var animationList = ['animate__fadeOut', 'animate__bounce', 'animate__zoomOut', 'animate__zoomIn'];
			return animationList[Math.floor(Math.random() * animationList.length)];
		}
		var owl = $('.slide__owl');

		owl.owlCarousel({
			autoplay: true,
			autoplaySpeed: 2000,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			smartSpeed: 5000,
			animateOut: 'animate__fadeOut',
			margin: 0,
			dots: true,
			nav: false,
			loop: true,
			navText: ["<span class='slide-nav-left'><svg width='48' height='48' viewBox='0 0 48 48' fill='none' xmlns='http://www.w3.org/2000/svg'> <rect width='48' height='48' rx='24' fill='white'/> <path fill-rule='evenodd' clip-rule='evenodd' d='M19.2072 24.5L23.3536 28.6465L22.6465 29.3536L17.6465 24.3536L17.293 24L17.6465 23.6465L22.6465 18.6465L23.3536 19.3536L19.2072 23.5H29.0001H31.0001V24.5H29.0001H19.2072Z' fill='#101010'/> </svg></span>", "<span class='slide-nav-right'><svg width='48' height='48' viewBox='0 0 48 48' fill='none' xmlns='http://www.w3.org/2000/svg'> <rect width='48' height='48' rx='24' transform='matrix(-1 0 0 1 48 0)' fill='white'/> <path fill-rule='evenodd' clip-rule='evenodd' d='M28.7928 24.5L24.6464 28.6465L25.3535 29.3536L30.3535 24.3536L30.707 24L30.3535 23.6465L25.3535 18.6465L24.6464 19.3536L28.7928 23.5H18.9999H16.9999V24.5H18.9999H28.7928Z' fill='#101010'/> </svg></span>"],
			responsive: {
				0: {
					items: 1,
					margin: 0
				}
			},
		});

		owl.on("changed.owl.carousel", function (event) {
			var item = event.item.index;
			$('.slider-name').removeClass('slider-name-animate');
			$('.slider-btn').removeClass('slider-btn-animate');

			if ($('.slide__owl .owl-item').hasClass('active')) {
				$('.slide__owl .owl-item').eq(item).find('.slider-name').addClass('slider-name-animate');
				$('.slide__owl .owl-item').eq(item).find('.slider-btn').addClass('slider-btn-animate');
			}
		});
	}


	if ($(".news__owl").exists()) {
		var owl_list = $('.news__owl');
		owl_list.owlCarousel({
			autoplay: true,
			margin: 24,
			items: 2,
			dots: false,
			autoplayHoverPause: true,
			autoplaySpeed: 2000,
			autoplayTimeout: 5000,
			smartSpeed: 1000,
			nav: true,
			navText: ["<span class='product-nav-left'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z'/></svg></span>", "<span class='product-nav-right'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z'/></svg></span>"],
			loop: true,
			responsive: {
				0: {
					items: 2,
					margin: 10,
					nav: false,
					dots: false,
				},
				380: {
					items: 2,
					margin: 10,
					nav: false,
					dots: false,
				},
				645: {
					items: 3,
					margin: 20,
					nav: false,
					dots: false,
				},
				1025: {
					items: 3,
					margin: 30
				}
			}
		});
	}

    if($(".products__owl").exists()) {
        var owl_list_products = $('.products__owl');
        owl_list_products.owlCarousel({
            autoplay: false,
            margin: 20,
            items: 5,
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 3000,
            autoplayTimeout: 2000,
            smartSpeed: 3000,
            //smartSpeed: 2000,
            loop: true,
            responsive: {
                0: {
                    items: 1,
                    margin: 40,
                    stagePadding: 30,
                },

                600: {
                    items: 2,
                    margin: 20,
                    stagePadding: 20,
                },

                750: {
                    items: 3,
                    margin: 15,
                    stagePadding: 20,
                },
                1028: {
                    items: 4,
                    spaceBetween: 20,
                    nav: true,
                    navText: [
                        "<button class='arrow-left-product'><i class = 'fas fa-arrow-left'></i></button>",
                        "<button class='arrow-right-product'><i class='fas fa-arrow-right'></i></button>"
                    ]
                }
            }
        });
    }


	if ($(".dichvu__owl").exists()) {
		var owl_list = $('.dichvu__owl');
		owl_list.owlCarousel({
			autoplay: false,
			margin: 21,
			items: 1,
			dots: false,
			autoplayHoverPause: true,
			autoplaySpeed: 1000,
			autoplayTimeout: 5000,
			smartSpeed: 1500,
			//smartSpeed: 2000,
			nav: true,
			navText: ["<span class='product-nav-left'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z'/></svg></span>", "<span class='product-nav-right'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z'/></svg></span>"],
			loop: true,
			responsive: {
				0: {
					items: 1,
					margin: 20,
				},
				750: {
					items: 2,
					margin: 20,
				},
				1028: {
					items: 3,
					margin: 30,
				}
			}
		});



		// $('.news-prev').click(function () {
		// 	owl_list.trigger('next.owl.carousel');
		// 	owl_list.trigger('next.owl.carousel');
		// })

		// $('.news-next').click(function () {
		// 	owl_list.trigger('prev.owl.carousel');
		// 	owl_list.trigger('prev.owl.carousel');
		// })
	};

	if ($(".porfolio__owl").exists()) {
		var owl_list = $('.porfolio__owl');
		owl_list.owlCarousel({
			autoplay: true,
			margin: 21,
			items: 1,
			dots: false,
			autoplayHoverPause: true,
			autoplaySpeed: 1000,
			autoplayTimeout: 5000,
			smartSpeed: 1500,
			//smartSpeed: 2000,
			nav: false,
			navText: ["<span class='product-nav-left'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z'/></svg></span>", "<span class='product-nav-right'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z'/></svg></span>"],
			loop: true,
			responsive: {
				0: {
					items: 2,
					margin: 10,
				},
				700: {
					items: 3,
					margin: 20,
				},
				1028: {
					items: 4,
					margin: 20,
				}
			}
		});
	};



	if ($(".typical__owl").exists()) {
		var owl_list = $('.typical__owl');
		owl_list.owlCarousel({
			autoplay: true,
			margin: 21,
			items: 1,
			dots: false,
			autoplayHoverPause: true,
			autoplaySpeed: 1000,
			autoplayTimeout: 5000,
			smartSpeed: 1500,
			//smartSpeed: 2000,
			nav: false,
			navText: ["<span class='typical-nav-left'><svg width='20' height='20' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z'/></svg></span>", "<span class='typical-nav-right'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z'/></svg></span>"],
			loop: true,
			responsive: {
				0: {
					items: 1,
					margin: 15,
				},
				425: {
					items: 2,
					margin: 20,
				},
				725: {
					items: 3,
					margin: 20,
				},
				1028: {
					items: 2.5,
					margin: 30,
				}
			}
		});
	};


	if ($(".customer__owl").exists()) {
		var owl_list = $('.customer__owl');
		owl_list.owlCarousel({
			autoplay: true,
			margin: 21,
			items: 1,
			dots: true,
			autoplayHoverPause: true,
			animateOut: 'animate__fadeOut',
			autoplaySpeed: 1000,
			autoplayTimeout: 5000,
			smartSpeed: 1500,
			//smartSpeed: 2000,
			nav: false,
			navText: ["<span class='product-nav-left'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z'/></svg></span>", "<span class='product-nav-right'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z'/></svg></span>"],
			loop: true,
			responsive: {
				0: {
					items: 2,
					margin: 20,
				},
				420: {
					items: 2,
					margin: 20,
				},
				505: {
					items: 3,
					margin: 20,
				}
			}
		});
	};

	if ($(".product__owl").exists()) {
		var owl_list = $('.product__owl');
		owl_list.owlCarousel({
			autoplay: true,
			margin: 21,
			items: 1,
			dots: true,
			autoplayHoverPause: true,
			animateOut: 'animate__fadeOut',
			autoplaySpeed: 1000,
			autoplayTimeout: 5000,
			smartSpeed: 1500,
			//smartSpeed: 2000,
			nav: false,
			navText: ["<span class='product-nav-left'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z'/></svg></span>", "<span class='product-nav-right'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z'/></svg></span>"],
			loop: true,
			responsive: {
				0: {
					items: 1,
					margin: 20,
				},
				420: {
					items: 2,
					margin: 20,
				},
				505: {
					items: 3,
					margin: 20,
				}
			}
		});
	};


	if ($(".intro__owl").exists()) {
		var owl_list = $('.intro__owl');
		owl_list.owlCarousel({
			autoplay: true,
			margin: 21,
			items: 1,
			dots: false,
			autoplayHoverPause: true,
			animateOut: 'animate__fadeOut',
			autoplaySpeed: 1000,
			autoplayTimeout: 3000,
			smartSpeed: 1500,
			//smartSpeed: 2000,
			nav: false,
			navText: ["<span class='product-nav-left'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z'/></svg></span>", "<span class='product-nav-right'><svg width='26' height='26' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z'/></svg></span>"],
			loop: true,
			responsive: {
				0: {
					items: 3,
					margin: 20,
				},
				505: {
					items: 5,
					margin: 20,
				}
			}
		});
	};


	// if ($(".tintuc__owl").exists()) {
	// 	var owl_tintuclist = $('.tintuc__owl');
	// 	owl_tintuclist.owlCarousel({
	// 		autoplay: false,
	// 		dots: false,
	// 		autoplayHoverPause: true,
	// 		autoplaySpeed: 2000,
	// 		autoplayTimeout: 3000,
	// 		touchDrag: false,
	// 		mouseDrag: false,
	// 		//animateOut: 'animate__fadeOut',
	// 		nav: true,
	// 		navText: ["<span class='slide-nav-right'><img src='img/arrow1.png'></span>", "<span class='slide-nav-left'><img src='img/arrow1.png'></span>"],
	// 		loop: true,
	// 		onInitialized: function () {
	// 			//$('.tintuc__owl').append('<a href="tin-tuc" class="btn-view-product">Xem tất cả</a>');
	// 		},
	// 		responsive: {
	// 			0: {
	// 				items: 2,
	// 				margin: 10,
	// 				nav: false,
	// 				dots: false,
	// 			},
	// 			380: {
	// 				items: 2,
	// 				margin: 10,
	// 				nav: false,
	// 				dots: false,
	// 			},
	// 			645: {
	// 				items: 3,
	// 				margin: 20,
	// 				nav: false,
	// 				dots: false,
	// 			},
	// 			1025: {
	// 				items: 3,
	// 				margin: 36
	// 			}
	// 		}
	// 	});


	// var owl_tin = $('.tintuc_one__owl');
	// owl_tin.owlCarousel({
	// 	autoplay:false,
	// 	dots: false,
	// 	autoplayHoverPause:true,
	// 	touchDrag  : false,
	// 	mouseDrag  : false,
	// 	autoplaySpeed: 2000,
	// 	autoplayTimeout:3000,
	// 	//animateOut: 'animate__fadeOut',
	// 	onChange : counterBC,
	// 	nav: false,
	// 	navText: ["",""],
	// 	loop: true,
	// 	onInitialized: function() {
	// 		//$('.tintuc__owl').append('<a href="tin-tuc" class="btn-view-product">Xem tất cả</a>');
	// 	},
	// 	responsive: {
	// 		0: {
	// 			items: 1,
	// 			margin: 0,
	// 			dots: true
	// 		}
	// 	}
	// });


	// $('.tintuc-prev-flip').click(function() {
	// 	owl_tintuclist.trigger('next.owl.carousel');
	// 	owl_tin.trigger('next.owl.carousel');
	// })

	// $('.tintuc-next-flip').click(function() {
	// 	owl_tintuclist.trigger('prev.owl.carousel');
	// 	owl_tin.trigger('prev.owl.carousel');
	// })

	// function counterBC(event) {
	// 	var item      = event.item.index;
	// 	console.log(event.item.index);
	// }
	//}


	if ($(".thongke__owl").exists()) {
		var owl = $('.thongke__owl');
		owl.owlCarousel({
			autoplay: true,
			margin: 24,
			dots: false,
			autoplayHoverPause: true,
			autoplaySpeed: 1000,
			autoplayTimeout: 3000,
			nav: false,
			navText: ["<span class='slide-nav-right'><img src='img/arrow_ncc.png'></span>", "<span class='slide-nav-left'><img src='img/arrow_ncc.png'></span>"],
			loop: true,
			onInitialized: function () {
				//$('.tieuchi__owl').append('<a href="nha-cung-cap" class="btn-view">Xem tất cả</a>');
			},
			responsive: {
				0: {
					items: 1,
					margin: 10,
				},
				400: {
					items: 2,
					margin: 10,
				},
				645: {
					items: 3,
					margin: 20,
				},
				1025: {
					items: 4,
					margin: 20
				}
			}
		});
	}


	if ($(".doitac__owl").exists()) {
		var owl = $('.doitac__owl');
		owl.owlCarousel({
			autoplay: true,
			margin: 24,
			dots: false,
			autoplayHoverPause: true,
			autoplaySpeed: 1000,
			autoplayTimeout: 5000,
			nav: false,
			navText: ["<span class='slide-nav-right'><img src='img/arrow_ncc.png'></span>", "<span class='slide-nav-left'><img src='img/arrow_ncc.png'></span>"],
			loop: true,
			onInitialized: function () {
				//$('.tieuchi__owl').append('<a href="nha-cung-cap" class="btn-view">Xem tất cả</a>');
			},
			responsive: {
				0: {
					items: 2,
					margin: 10,
				},
				420: {
					items: 3,
					margin: 10,
				},
				645: {
					items: 4,
					margin: 10,
				},
				1025: {
					items: 7,
					margin: 20
				}
			}
		});
	}


	// if ($(".product__owl").exists()) {
	// 	var owlKH = $('.product__owl');
	// 	owlKH.owlCarousel({
	// 		autoplay: true,
	// 		margin: 20,
	// 		dots: false,
	// 		autoplayHoverPause: true,
	// 		autoplaySpeed: 1500,
	// 		autoplayTimeout: 5000,
	// 		smartSpeed: 1000,
	// 		nav: false,
	// 		navText: ["<span class='custom-nav-left'><svg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'> <circle cx='20' cy='20' r='19.5' transform='matrix(-1 0 0 1 40 0)' fill='#F2EDE4' stroke='#008080'/> <g clip-path='url(#clip0_114_558)'> <path d='M23.6733 25.42L22.4933 26.6L15.8933 20L22.4933 13.4L23.6733 14.58L18.2533 20L23.6733 25.42Z' fill='#008080'/> </g> <defs> <clipPath id='clip0_114_558'> <rect width='16' height='16' fill='white' transform='matrix(-1 0 0 1 28 12)'/> </clipPath> </defs> </svg></span>", "<span class='custom-nav-right'><svg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'> <circle cx='20' cy='20' r='19.5' transform='matrix(-1 0 0 1 40 0)' fill='#F2EDE4' stroke='#008080'/> <g clip-path='url(#clip0_114_558)'> <path d='M23.6733 25.42L22.4933 26.6L15.8933 20L22.4933 13.4L23.6733 14.58L18.2533 20L23.6733 25.42Z' fill='#008080'/> </g> <defs> <clipPath id='clip0_114_558'> <rect width='16' height='16' fill='white' transform='matrix(-1 0 0 1 28 12)'/> </clipPath> </defs> </svg></span>"],
	// 		loop: false,
	// 		onInitialized: function () {
	// 			//$('.tieuchi__owl').append('<a href="nha-cung-cap" class="btn-view">Xem tất cả</a>');
	// 		},
	// 		responsive: {
	// 			0: {
	// 				items: 2,
	// 				margin: 20,
	// 				nav: false,
	// 				dots: true,
	// 			},
	// 			420: {
	// 				items: 2,
	// 				margin: 20,
	// 				nav: false,
	// 				dots: true,
	// 			},
	// 			645: {
	// 				items: 3,
	// 				margin: 21,
	// 				nav: false,
	// 				dots: true,
	// 			},
	// 			1025: {
	// 				items: 4,
	// 				margin: 51
	// 			}
	// 		}
	// 	});

	// }


	if ($(".product__owl").exists()) {

		// var owlKH = $('.product__owl');
		// owlKH.owlCarousel({
		// 	autoplay: false,
		// 	margin: 20,
		// 	dots: false,
		// 	autoplayHoverPause: true,
		// 	autoplaySpeed: 1500,
		// 	autoplayTimeout: 5000,
		// 	smartSpeed: 1000,
		// 	nav: false,
		// 	navText: ["<span class='custom-nav-left'><svg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'> <circle cx='20' cy='20' r='19.5' transform='matrix(-1 0 0 1 40 0)' fill='#F2EDE4' stroke='#008080'/> <g clip-path='url(#clip0_114_558)'> <path d='M23.6733 25.42L22.4933 26.6L15.8933 20L22.4933 13.4L23.6733 14.58L18.2533 20L23.6733 25.42Z' fill='#008080'/> </g> <defs> <clipPath id='clip0_114_558'> <rect width='16' height='16' fill='white' transform='matrix(-1 0 0 1 28 12)'/> </clipPath> </defs> </svg></span>", "<span class='custom-nav-right'><svg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'> <circle cx='20' cy='20' r='19.5' transform='matrix(-1 0 0 1 40 0)' fill='#F2EDE4' stroke='#008080'/> <g clip-path='url(#clip0_114_558)'> <path d='M23.6733 25.42L22.4933 26.6L15.8933 20L22.4933 13.4L23.6733 14.58L18.2533 20L23.6733 25.42Z' fill='#008080'/> </g> <defs> <clipPath id='clip0_114_558'> <rect width='16' height='16' fill='white' transform='matrix(-1 0 0 1 28 12)'/> </clipPath> </defs> </svg></span>"],
		// 	loop: true,
		// 	onInitialized: function () {

		// 	},
		// 	responsive: {
		// 		0: {
		// 			items: 1,
		// 			margin: 10,
		// 			nav: false,
		// 			dots: true,
		// 		},
		// 		501: {
		// 			items: 2,
		// 			margin: 20,
		// 			nav: false,
		// 			dots: true,
		// 		},
		// 		645: {
		// 			items: 2,
		// 			margin: 21,
		// 			nav: false,
		// 			dots: true,
		// 		},
		// 		1025: {
		// 			items: 1,
		// 			margin: 30
		// 		}
		// 	}
		// });
	}


	if ($(".banner__owl").exists()) {
		var owlKH = $('.banner__owl');
		owlKH.owlCarousel({
			autoplay: true,
			margin: 20,
			dots: false,
			autoplayHoverPause: true,
			autoplaySpeed: 1500,
			autoplayTimeout: 5000,
			smartSpeed: 1000,
			nav: false,
			navText: ["<span class='custom-nav-left'><svg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'> <circle cx='20' cy='20' r='19.5' transform='matrix(-1 0 0 1 40 0)' fill='#F2EDE4' stroke='#008080'/> <g clip-path='url(#clip0_114_558)'> <path d='M23.6733 25.42L22.4933 26.6L15.8933 20L22.4933 13.4L23.6733 14.58L18.2533 20L23.6733 25.42Z' fill='#008080'/> </g> <defs> <clipPath id='clip0_114_558'> <rect width='16' height='16' fill='white' transform='matrix(-1 0 0 1 28 12)'/> </clipPath> </defs> </svg></span>", "<span class='custom-nav-right'><svg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'> <circle cx='20' cy='20' r='19.5' transform='matrix(-1 0 0 1 40 0)' fill='#F2EDE4' stroke='#008080'/> <g clip-path='url(#clip0_114_558)'> <path d='M23.6733 25.42L22.4933 26.6L15.8933 20L22.4933 13.4L23.6733 14.58L18.2533 20L23.6733 25.42Z' fill='#008080'/> </g> <defs> <clipPath id='clip0_114_558'> <rect width='16' height='16' fill='white' transform='matrix(-1 0 0 1 28 12)'/> </clipPath> </defs> </svg></span>"],
			loop: false,
			onInitialized: function () {
				//$('.tieuchi__owl').append('<a href="nha-cung-cap" class="btn-view">Xem tất cả</a>');
			},
			responsive: {
				0: {
					items: 1,
					margin: 0,
					nav: false,
					dots: true,
				},
				501: {
					items: 2,
					margin: 0,
					nav: false,
					dots: true,
				},
				1025: {
					items: 2,
					margin: 0
				}
			}
		});
	}


	if ($(".khachhang__owl").exists()) {

		var owlKH = $('.khachhang__owl');

		owlKH.owlCarousel({

			autoplay: true,

			margin: 20,

			dots: false,

			autoplayHoverPause: true,

			animateOut: 'animate__fadeOut',

			autoplaySpeed: 1500,

			autoplayTimeout: 5000,

			smartSpeed: 1000,

			nav: true,

			navText: ["<span class='slide-nav-left'><svg width='48' height='48' viewBox='0 0 48 48' fill='none' xmlns='http://www.w3.org/2000/svg'> <rect width='48' height='48' rx='24' fill='#fff'/> <path fill-rule='evenodd' clip-rule='evenodd' d='M19.2072 24.5L23.3536 28.6465L22.6465 29.3536L17.6465 24.3536L17.293 24L17.6465 23.6465L22.6465 18.6465L23.3536 19.3536L19.2072 23.5H29.0001H31.0001V24.5H29.0001H19.2072Z' fill='#2D2D2D'/> </svg></span>", "<span class='slide-nav-right'><svg width='48' height='48' viewBox='0 0 48 48' fill='none' xmlns='http://www.w3.org/2000/svg'> <rect width='48' height='48' rx='24' transform='matrix(-1 0 0 1 48 0)' fill='#fff'/> <path fill-rule='evenodd' clip-rule='evenodd' d='M28.7928 24.5L24.6464 28.6465L25.3535 29.3536L30.3535 24.3536L30.707 24L30.3535 23.6465L25.3535 18.6465L24.6464 19.3536L28.7928 23.5H18.9999H16.9999V24.5H18.9999H28.7928Z' fill='#2D2D2D'/> </svg></span>"],

			loop: true,

			onInitialized: function () {

				//$('.tieuchi__owl').append('<a href="nha-cung-cap" class="btn-view">Xem tất cả</a>');

			},

			responsive: {

				0: {

					items: 1,

					margin: 10,

					nav: false,

					dots: true,

				},

				605: {

					items: 1,

					margin: 20,

					nav: false,

					dots: true,

				},

				645: {

					items: 2,

					margin: 20,

					nav: false,

					dots: true,

				},

				1025: {

					items: 2,

					margin: 24

				}

			}

		});

	}
};



MIKOTECH.SupportBtn = function () {
	window.onload = (event) => {
		if (SESSIONTOTURIAL != 1) {
			console.log(SESSIONTOTURIAL);
			setTimeout(() => {
				$(".arcontactus-element").fadeIn();
				setTimeout(() => {
					$(".arcontactus-element").fadeOut();
				}, "3500")

			}, "4000")
			var sesition = 1;
			$.ajax({
				url: LANG + "/ajax/ajax-toturial",
				type: "POST",
				dataType: 'html',
				async: false,
				data: { sesition: sesition, _token: $('meta[name="csrf-token"]').attr('content') },
				success: function (result) {
				}
			});
		}
	};

	// $('#arcontactus').draggable({
	// 	handle: "#handle",
	// 	scroll: true,
	// 	containment: ".main-body",
	// 	start: function(event, ui) {},
	// 	drag: function(event, ui) {
	// 		var right = $(window).width() - ui.position.left - 80;
	// 		$("#arcontactus").css({
	// 			right: right,
	// 			transition: 'unset'
	// 		});
	// 	},
	// 	stop: function(event, ui) {
	// 		var width = $(window).width();
	// 		var height_win = $(window).height();
	// 		if (ui.position.left > width / 2) {
	// 			$("#arcontactus").css({
	// 				transition: '0.6s'
	// 			});
	// 			$("#arcontactus").css({
	// 				right: '20px',
	// 				left: 'unset'
	// 			});
	// 			$(".messangers-block").removeClass("change-position");
	// 		} else {
	// 			$("#arcontactus").css({
	// 				left: '20px',
	// 				transition: '0.6s'
	// 			})
	// 			$(".messangers-block").addClass("change-position");
	// 		}
	// 		if (ui.position.top < 200) {
	// 			$(".messangers-block").addClass("change-position-bottom");
	// 		} else {
	// 			$(".messangers-block").removeClass("change-position-bottom");
	// 		}
	// 		if (ui.position.top < 0) {
	// 			$("#arcontactus").css({
	// 				top: 'unset',right: '20px',bottom:'80px',
	// 				transition: '0.6s'
	// 			})
	// 			$(".messangers-block").removeClass("change-position-bottom");
	// 		}
	// 		if (ui.position.top > height_win - 50)
	// 		{
	// 			$("#arcontactus").css({
	// 				top: 'unset',right: '20px',bottom:'80px',
	// 				transition: '0.6s'
	// 			})
	// 		}
	// 	}
	// });

	if ($(window).width() < 800) {
		$("#arcontactus").click(function () {
			if ($(this).hasClass("show")) {
				$(this).removeClass("show");
				$(".pd-compact-mobile").fadeOut();
				$(".main-body").removeClass("main-open");
			}
			else {
				$(this).addClass("show");
				$(".pd-compact-mobile").fadeIn();
				$(".main-body").addClass("main-open");
			}

		})
		$(".pd-close").click(function () {
			$("#arcontactus").removeClass("show");
			$(".pd-compact-mobile").fadeOut();
			$(".main-body").removeClass("main-open");
		})
	}
};

/* Cart */

MIKOTECH.Cart = function () {

	function ViewCart(cmd = 'popup-cart') {

		$.ajax({

			url: LANG + "/ajax/ajax-cart",

			type: "POST",

			dataType: 'html',

			async: false,

			data: { cmd: cmd, _token: $('meta[name="csrf-token"]').attr('content') },

			success: function (result) {

				$.fancybox.close();

				//$("#popup-cart .modal-body").html(result);

				//$('#popup-cart').modal('show');

				$('.fixmodel_cart_view').html(result);

				$('#fixmodel_cart').addClass('active');

				$('#fixmodel_cart').addClass('show-cart');

				$('#fix_site_overlay').addClass('active');

				$('#fixmodel_cart_site_close, .fix_site_overlay').click(function () {

					$('#fixmodel_cart').removeClass('active');

					$('#fixmodel_cart').removeClass('show-cart');

					$('#fix_site_overlay').removeClass('active');

				});

			}

		});

	}





	$("body").on("click", ".fix_cart_count", function () {
		$('.fixmodel_title').removeClass('hidden').addClass('block');
		$('.fixmodel_title_thongbao').removeClass('block').addClass('hidden');
		ViewCart();
	});

	$("body").on("click", ".fix_thongbao", function () {
		$('.fixmodel_title_thongbao').removeClass('hidden').addClass('block');
		$('.fixmodel_title').removeClass('block').addClass('hidden');
		ViewCart('thongbao');
	});


	$("body").on("click", ".sidebar-tab-tools", function () {
		//console.log('ok');
		var id = $(this).attr('data-id');
		var isDaxem = $(this).attr('data-daxem');
		var isReserve = $(this).attr('data-reserve');

		if (isDaxem == 0) {
			$('#sidebar-tab-hasno').text(LANG_KEY['danhdaudadoc']);
		} else if (isDaxem == 1) {
			$('#sidebar-tab-hasno').text(LANG_KEY['danhdauchuadoc']);
		}

		$('.sidebar-btn-status-isview').attr('data-status', isReserve);
		$('.sidebar-tab-showtool').addClass('sidebar-tab-showtool-active');
		$('.sidebar-btn-status').attr('data-id', id);
	});


	$("body").on("click", ".sidebar-tab-showtool-layout", function () {
		$('.sidebar-tab-showtool').removeClass('sidebar-tab-showtool-active');
	});


	$("body").on("click", ".sidebar-btn-cancel", function () {
		$('.sidebar-tab-showtool-layout').trigger('click');
	});


	$("body").on("click", ".sidebar-btn-status", function () {
		var status = $(this).attr('data-status');
		var id = $(this).attr('data-id');
		var e_find = $('.sidebar-tab-inform-item-' + id).find('.sidebar-tab-tools');

		$.ajax({
			url: 'account/change-status-inform',
			type: "GET",
			dataType: 'html',
			data: { status: status, id: id },
			success: function (result) {
				if (status == 'chuaxem') {
					$('.sidebar-tab-inform-item-' + id).removeClass('sidebar-tab-inform-item-hasview');
					$('.sidebar-tab-new-' + id).removeClass('hidden');
					e_find.attr('data-daxem', 0);
					e_find.attr('data-reserve', 'daxem');
				} else if (status == 'daxem') {
					$('.sidebar-tab-inform-item-' + id).addClass('sidebar-tab-inform-item-hasview');
					$('.sidebar-tab-new-' + id).addClass('hidden');
					e_find.attr('data-daxem', 1);
					e_find.attr('data-reserve', 'chuaxem');
				} else if (status == 'xoa') {
					$('.sidebar-tab-inform-item-' + id).remove();
				}
				$('.sidebar-tab-showtool-layout').trigger('click');
			}
		});
	});


	$("body").on("click", ".change-prop-btn", function () {

		var code = $(this).attr('data-code');

		var id = $(this).attr('data-id');



		$.ajax({

			url: LANG + "/ajax/ajax-cart",

			type: "POST",

			dataType: 'html',

			async: false,

			data: { cmd: 'popup-change-cart', code: code, id: id, _token: $('meta[name="csrf-token"]').attr('content') },

			success: function (result) {

				$('.model_changecart_contain').html(result);

				$('.cartchange_site_overlay').addClass('active');

				$('.model_change_cart').addClass('active');



				$('#model_changecart_site_close, .cartchange_site_overlay').click(function () {

					$('#model_change_cart').removeClass('active');

					$('#cartchange_site_overlay').removeClass('active');

					$('#cartchange_site_overlay').removeClass('active');

				});



				$('.gallery_cart_product').owlCarousel({

					items: 1,

					autoplay: false,

					loop: true,

					lazyLoad: true,

					mouseDrag: true,

					autoplayHoverPause: true,

					margin: 0,

					nav: false,

					dots: true,

					responsiveClass: true

				});



				if ($("#model_changecart_site .SizefirstOption").exists()) {

					$('#model_changecart_site').find('.SizefirstOption').trigger('click');

				}

			}

		});

	});


	$("body").on("click", ".btn-like-product", function () {
		var id = $(this).attr('data-id');
		var e = $(this);

		$.ajax({
			url: LANG + '/ajax/ajax-add-like-post',
			type: "POST",
			dataType: 'json',
			async: true,
			data: { id: id, _token: $('meta[name="csrf-token"]').attr('content') },
			success: function (result) {
				if (result) {
					//$('.box-share-like-number').text(result.count);
					if (result.result == false) {
						Swal.fire({
							position: 'top',
							icon: result.icon,
							title: '<p class="h6">' + result.text + '</p>',
							showConfirmButton: false,
							timer: 2000,
							toast: true
						});

						$('.btn-like-product').removeClass('btn-like-product-active');
					} else {
						if (!e.hasClass('btn-like-product-active')) {
							e.addClass('btn-like-product-active');
						} else {
							e.removeClass('btn-like-product-active');
						}
					}
				}

			},
			complete: function () {
				// if(!e.hasClass('btn-like-product-active')){
				// 	e.addClass('btn-like-product-active');
				// }else{
				// 	e.removeClass('btn-like-product-active');
				// }
			}
		});
	});


	// $("body").on("click", ".btn-like-product", function(){
	// 	var id = $(this).attr('data-id');

	// 	$.ajax({
	// 		url: "ajax/ajax-add-like-post",
	// 		type: "POST",
	// 		dataType: 'html',
	// 		async: false,
	// 		data: {id:id,_token:$('meta[name="csrf-token"]').attr('content')},
	// 		success: function(result){
	// 			if(!$(this).hasClass('btn-like-product-active')){
	// 				$(this).addClass('btn-like-product-active');
	// 			}else{
	// 				$(this).removeClass('btn-like-product-active');
	// 			}
	// 		}
	// 	});

	// });



	$('body').on('click', '#model_changecart_site .size-pro-detail', function () {

		SizeClick(this);

	});





	$('.box-product-item').each(function () {

		if (!$(this).find('.color-btn').exists()) {

			var e_select = $(this).find('select[name="cart-size"]');

			var e_item = e_select.parents('.box-product-item');



			var idproduct = e_item.find('.box-product-btncart').attr('data-id');

			var id_mau = e_item.find('.color-active').attr('data-id');

			var id_size = e_select.val();



			if (id_mau > 0) {

				$.ajax({

					type: "POST",

					url: LANG + '/ajax/ajax-get-size',

					dataType: 'json',

					data: { idproduct: idproduct, idmau: id_mau, idsize: id_size, _token: $('meta[name="csrf-token"]').attr('content') },

					success: function (result) {

						e_item.find('.box-product-newprice').text(result.giamoi);

						e_item.find('.box-product-oldprice').text(result.gia);

						e_item.find('.box-product-value').text(result.giakm);

					}

				});

			}

		}

	});





	$('body').on('click', '.color-btn', function () {

		var id = $(this).attr('data-id');

		var idproduct = $(this).attr('data-idproduct');

		var e_size = $(this).parents('.box-product-sizecolor').find('.box-product-listsize select');

		var e_item = $(this).parents('.box-product-item');



		$(this).parent('.box-product-listcolor').find('input[name="cart-color"]').val(id);

		$(this).parent('.box-product-listcolor').find('.color-btn').removeClass('color-active');

		$(this).addClass('color-active');



		$.ajax({

			type: "POST",

			url: LANG + '/ajax/ajax-get-size',

			dataType: 'json',

			data: { idproduct: idproduct, idmau: id, _token: $('meta[name="csrf-token"]').attr('content') },

			success: function (result) {

				e_size.html(result.select);

				e_item.find('.box-product-newprice').text(result.giamoi);

				e_item.find('.box-product-oldprice').text(result.gia);

				e_item.find('.box-product-value').text(result.giakm);

				//console.log(result.giamoi);

				//console.log(result.gia);

			}

		});

	});



	$('body').on('change', 'select[name="cart-size"]', function () {

		console.log('select change');

		var e_item = $(this).parents('.box-product-item');



		var idproduct = e_item.find('.box-product-btncart').attr('data-id');

		var id_mau = e_item.find('.color-active').attr('data-id');

		var id_size = $(this).val();



		$.ajax({

			type: "POST",

			url: LANG + '/ajax/ajax-get-size',

			dataType: 'json',

			data: { idproduct: idproduct, idmau: id_mau, idsize: id_size, _token: $('meta[name="csrf-token"]').attr('content') },

			success: function (result) {

				//e_size.html(result.select);

				e_item.find('.box-product-newprice').text(result.giamoi);

				e_item.find('.box-product-oldprice').text(result.gia);

				e_item.find('.box-product-value').text(result.giakm);

				//console.log(result.giamoi);

				//console.log(result.gia);

			}

		});

	});



	$('.box-product-detail .color-active').each(function () {

		$(this).trigger('click');

	});





	$('body').on('click', '.btn-buy-cart', function () {

		var id = $(this).data("id");

		var action = $(this).data("action");

		var quantity = ($("#quantity").val()) ? $("#quantity").val() : 1;

		var mau = ($(this).parent('.box-product-img').find('input[name="cart-color"]').val()) ? $(this).parent('.box-product-img').find('input[name="cart-color"]').val() : 0;

		var size = ($(this).parent('.box-product-img').find('input[name="cart-size"]').val()) ? $(this).parent('.box-product-img').find('input[name="cart-size"]').val() : 0;

		//var size =($(this).parent('.box-product-img').find('select[name="cart-size"]').val()) ? $(this).parent('.box-product-img').find('select[name="cart-size"]').val() : 0;



		if (id) {

			$.ajax({

				url: LANG + "/ajax/ajax-cart",

				type: "POST",

				dataType: 'json',

				async: false,

				data: { cmd: 'add-cart', id: id, mau: mau, size: size, quantity: quantity, _token: $('meta[name="csrf-token"]').attr('content') },

				success: function (result) {

					if (result.is_soluong == false) {

						Swal.fire({

							position: 'center',

							icon: 'info',

							title: '<p class="h5">' + result.thongbao_status + '</p>',

							showConfirmButton: false,

							timer: 2500,

							toast: true

						})

						return false;

					}

					if (result.warning && result.warning != '') {

						Swal.fire({

							position: 'center',

							icon: 'warning',

							title: '<p class="h5">' + result.warning + '</p>',

							showConfirmButton: false,

							timer: 2500,

							toast: true

						})

						return false;

					}

					if (action == 'addnow') {

						$('.ajax-count-cart').each(function () {

							$(this).html(result.max);

						});

						ViewCart();

					} else if (action == 'buynow') {

						window.location = CONFIG_BASE + "gio-hang";

					}

				}

			});

		}

	});





	$("body").on("click", ".js-action-cart", function () {

		var mau = ($(".color-pro-detail.active input").val()) ? $(".color-pro-detail.active input").val() : 0;

		var size = ($(".size-pro-detail.active input").val()) ? $(".size-pro-detail.active input").val() : 0;

		var id = $(this).attr("data-id");

		var action = $(this).attr("data-action");

		var isDebit = $(this).attr("data-debit");

		var quantity = ($("#quantity").val()) ? $("#quantity").val() : 1;

		var oldcode = $(this).attr("data-oldcode");

		$('.fixmodel_title').removeClass('hidden').addClass('block');

		$('.fixmodel_title_thongbao').removeClass('block').addClass('hidden');


		if (id) {

			$('#loading_order').show();

			$.ajax({

				url: LANG + '/ajax/ajax-cart',

				type: "POST",

				dataType: 'json',

				async: true,

				data: { cmd: 'add-cart', id: id, mau: mau, size: size, quantity: quantity, oldcode: oldcode, action: action, _token: $('meta[name="csrf-token"]').attr('content') },

				success: function (result) {

					$('.model_changecart_site_close').trigger('click');

					if (result.is_soluong == false) {

						Swal.fire({

							position: 'center',

							icon: 'info',

							title: '<p class="h5">' + result.thongbao_status + '</p>',

							showConfirmButton: false,

							timer: 2500,

							toast: true

						})

						setTimeout(function () {

							$('#loading_order').hide();

						}, 2500);



						return false;

					}



					if (action == 'addnow') {



						$('.ajax-count-cart').each(function () {

							$(this).html(result.max);

						});



						$.ajax({

							url: LANG + '/ajax/ajax-cart',

							type: "POST",

							dataType: 'html',

							async: false,

							data: { cmd: 'popup-cart', _token: $('meta[name="csrf-token"]').attr('content') },

							success: function (result) {

								$('.ajax-count-cart').each(function () {

									$(this).html(result.max);

								});

								$('#loading_order').hide();

								ViewCart();

							}

						});

					} else if (action == 'buynow') {

						if (isDebit == 'false') {
							window.location = CONFIG_BASE + "gio-hang";
						} else {
							window.location = CONFIG_BASE + "gio-hang?" + "debit=true";
						}

					} else if (action == 'changenow') {

						$('.ajax-count-cart').each(function () {

							$(this).html(result.max);

						});

						ViewCart();

						$('.model_changecart_site_close').trigger('click');

						$('#loading_order').hide();

					}

				}

			});

		}

	});


	$("body").on("click", ".js-action-cart-size", function () {

		var mau = ($(".color-pro-detail.active input").val()) ? $(".color-pro-detail.active input").val() : 0;

		var size = $(this).attr("data-id-size");

		var id = $(this).attr("data-id");

		var action = $(this).attr("data-action");

		var isDebit = $(this).attr("data-debit");

		var quantity = ($("#quantity").val()) ? $("#quantity").val() : 1;

		var oldcode = $(this).attr("data-oldcode");

		$('.fixmodel_title').removeClass('hidden').addClass('block');

		$('.fixmodel_title_thongbao').removeClass('block').addClass('hidden');


		if (id) {

			$('#loading_order').show();

			$.ajax({

				url: LANG + '/ajax/ajax-cart',

				type: "POST",

				dataType: 'json',

				async: true,

				data: { cmd: 'add-cart', id: id, mau: mau, size: size, quantity: quantity, oldcode: oldcode, action: action, _token: $('meta[name="csrf-token"]').attr('content') },

				success: function (result) {

					$('.model_changecart_site_close').trigger('click');

					if (result.is_soluong == false) {

						Swal.fire({

							position: 'center',

							icon: 'info',

							title: '<p class="h5">' + result.thongbao_status + '</p>',

							showConfirmButton: false,

							timer: 2500,

							toast: true

						})

						setTimeout(function () {

							$('#loading_order').hide();

						}, 2500);



						return false;

					}



					if (action == 'addnow') {



						$('.ajax-count-cart').each(function () {

							$(this).html(result.max);

						});



						$.ajax({

							url: LANG + '/ajax/ajax-cart',

							type: "POST",

							dataType: 'html',

							async: false,

							data: { cmd: 'popup-cart', _token: $('meta[name="csrf-token"]').attr('content') },

							success: function (result) {

								$('.ajax-count-cart').each(function () {

									$(this).html(result.max);

								});

								$('#loading_order').hide();

								ViewCart();

							}

						});

					} else if (action == 'buynow') {

						if (isDebit == 'false') {
							window.location = CONFIG_BASE + "gio-hang";
						} else {
							window.location = CONFIG_BASE + "gio-hang?" + "debit=true";
						}

					} else if (action == 'changenow') {

						$('.ajax-count-cart').each(function () {

							$(this).html(result.max);

						});

						ViewCart();

						$('.model_changecart_site_close').trigger('click');

						$('#loading_order').hide();

					}

				}

			});

		}

	});





	$("body").on("click", ".del-procart", function () {

		let code = $(this).data("code");

		let ship = $(".price-ship").val();

		Swal.fire({

			title: '<h5>' + LANG_KEY['bancochacmuonxoasanphamnay'] + '?</h5>',

			showDenyButton: true,

			confirmButtonText: LANG_KEY['dongy'],

			denyButtonText: LANG_KEY['huybo'],

		}).then((result) => {

			if (result.isConfirmed) {

				$.ajax({

					type: "POST",

					url: LANG + '/ajax/ajax-cart',

					dataType: 'json',

					data: { cmd: 'delete-cart', code: code, ship: ship, _token: $('meta[name="csrf-token"]').attr('content') },

					success: function (result) {

						$('.ajax-count-cart').each(function () {

							$(this).html(result.max);

						});

						//$('.count-cart').html(result.max);

						if (result.max) {

							$('.price-temp').val(result.temp);

							$('.load-price-temp').html(result.tempText);

							$('.price-total').val(result.total);

							$('.coupon-temp').val(result.coupon);

							$('.load-price-discount').html(result.couponText);

							$('.load-price-total').html(result.totalText);

							$(".procart-" + code).remove();

							if (result.total >= 5000) {

								$('.payments-alepay').removeClass('d-none');

							} else {

								$('.payments-alepay').addClass('d-none');

								$('#payments-3').prop('checked', false);

								$('#payments-4').prop('checked', false);

							}

						} else {

							$(".wrap-cart").html('<a href="" class="empty-cart text-decoration-none"><i class="fa fa-cart-arrow-down"></i><p>' + LANG_KEY['no_products_in_cart'] + '</p><span>' + LANG_KEY['back_to_home'] + '</span></a>');

						}

					}

				});

			}

		});

	});



	$("body").on("click", ".counter-procart", function () {

		var $button = $(this);

		var input = $button.parent().find("input");

		var id = input.data('pid');

		var code = input.data('code');

		var oldValue = $button.parent().find("input").val();

		if ($button.text() == "+") quantity = parseFloat(oldValue) + 1;

		else if (oldValue > 1) quantity = parseFloat(oldValue) - 1;



		$button.parent().find("input").val(quantity);

		update_cart(id, code, quantity);

	});



	$("body").on("change", "input.quantity-procat", function () {

		var quantity = $(this).val();

		var id = $(this).data("pid");

		var code = $(this).data("code");

		update_cart(id, code, quantity);

	});



	if ($(".select-city-cart").exists()) {

		$(".select-city-cart").change(function () {

			var id = $(this).val();

			load_district(id);

			//load_ship();

		});

	}

	if ($("#nhanhangtaishop").exists()) {

		$("#nhanhangtaishop").change(function () {

			if ($(this).is(":checked")) {

				load_ship(0, 1);

				$('.info_nhanhang').animate({ height: 'show' }, 400);

				$('.default_address').animate({ height: 'hide' }, 200);

				$('.dienthoai').attr({ 'id': 'dienthoai1', 'name': 'dienthoai1' });



				$('.dienthoai1').attr({ 'id': 'dienthoai', 'name': 'dienthoai' });

				$('.dienthoai1').prop('required', true);

				$('.ten').prop('required', true);



				$('#city').prop('required', false);

				$('#district').prop('required', false);

				$('#wards').prop('required', false);

				$('#diachi').prop('required', false);



			} else {

				let id = $('#id_address_delivery').val();

				if (id = 'undefined') {

					let id_dist = $('#district').val();

					load_ship(id_dist);

					$('.info_nhanhang').animate({ height: 'hide' }, 200);

					$('.default_address').animate({ height: 'show' }, 400);



					$('.dienthoai1').attr({ 'id': 'dienthoai1', 'name': 'dienthoai1' });

					$('.dienthoai').attr({ 'id': 'dienthoai', 'name': 'dienthoai' });



					$('#city').prop('required', true);

					$('#district').prop('required', true);

					$('#wards').prop('required', true);

					$('#diachi').prop('required', true);

				} else {

					$.ajax({

						url: LANG + '/ajax/getIdDistrict.php',

						type: 'POST',

						dataType: 'json',

						data: { id: id },

					})

						.done(function (res) {

							//load_ship(res.id_district);

							$('.info_nhanhang').animate({ height: 'hide' }, 200);

							$('.default_address').animate({ height: 'show' }, 400);

							$('.dienthoai1').attr({ 'id': 'dienthoai1', 'name': 'dienthoai1' });

							$('.dienthoai').attr({ 'id': 'dienthoai', 'name': 'dienthoai' });

							$('.dienthoai1').prop('required', false);

							$('.ten').prop('required', false);

						})

						.fail(function () {

							console.log("error");

						})

				}



			}

		});

	}



	if ($(".select-district-cart").exists()) {

		$(".select-district-cart").change(function () {

			var id = $(this).val();

			load_wards(id);

			load_ship(id);

		});

	}



	if ($(".select-wards-cart").exists()) {

		$(".select-wards-cart").change(function () {

			var id = $(this).val();

		});

	}



	if ($(".payments-label").exists()) {

		$(".payments-label").click(function () {

			var payments = $(this).data("payments");

			$(".payments-cart .payments-label, .payments-info").removeClass("active");

			$(this).addClass("active");

			$(".payments-info-" + payments).addClass("active");

		});

	}



	$('body').on('click', '.js-change-quantity', function () {
		//$(".js-change-quantity").click(function(){

		var $button = $(this);

		var oldValue = $("#quantity").val();

		if ($button.attr("data-action") == "plus") {

			var newVal = parseFloat(oldValue) + 1;

		} else {

			if (oldValue > 1) var newVal = parseFloat(oldValue) - 1;

			else var newVal = 1;

		}

		console.log(newVal);

		$("#quantity").val(newVal);

	});





	if ($(".btn-payment-cart").exists()) {



		$('#loading_order').hide();



		$('.btn-payment-cart').click(function () {

			$.ajax({

				url: LANG + '/ajax/ajax-check-cart',

				type: "GET",

				dataType: 'json',

				async: true,

				success: function (result) {

					if (result.success == false) {

						if (result.data) {

							$('.cart-warning-product').addClass('d-none');

							var data = result.data;

							for (let i in data) {

								$('.cart-warning-' + i).removeClass('d-none');

								if (data[i] > 0) {

									$('.cart-warning-' + i).text('(Sản phẩm này chỉ còn ' + data[i] + ' sản phẩm)');

									//console.log(data[i]);

								} else {

									$('.cart-warning-' + i).text('(Sản phẩm này vừa mới hết hàng)');

									//console.log(0);

								}

							}

						}



						//console.log('error ajax-check-cart');

						return false;

					} else {

						var forms = document.getElementsByClassName('form-cart');

						var validation = Array.prototype.filter.call(forms, function (form) {

							if (form.checkValidity() === false) {

								event.preventDefault();

								event.stopPropagation();

								console.log('error validate');

							} else {

								$('#loading_order').show();

								form.submit();

							}

							form.classList.add('was-validated');

						});

					}

				}

			});



			return false;

		});

	}





	if ($("#voucher").exists()) {

		$('#voucher-check-btn').click(function () {

			var voucher_code = $('#voucher').val();

			var dienthoai = $('#dienthoai').val();

			let ship = $(".price-ship").val();



			$.ajax({

				url: LANG + "/ajax/ajax-check-voucher",

				type: 'POST',

				dataType: 'json',

				data: { voucher_code: voucher_code, dienthoai: dienthoai, ship: ship, _token: $('meta[name="csrf-token"]').attr('content') },

			})

				.done(function (result) {

					if (result.status == false) {

						if (result.text && result.text != '') { $('#voucher-content').removeClass('text-success').addClass('d-block text-error').text(result.text); }

						$('.load-price-coupon').text(result.sotien_duocgiam_text);

					} else {

						if (result.text && result.text != '') { $('#voucher-content').removeClass('text-error').addClass('d-block text-success').text(result.text); }

						$('input[name="coupon-temp"]').val(result.sotien_duocgiam);

						$('.load-price-coupon').text(result.sotien_duocgiam_text);

						$('.load-price-total').text(result.tongtien_saugiam_text);

					}

				})

				.fail(function () {

					console.log("error");

				})

		});

	}



	// var cleave = new Cleave('#dienthoai', {

	// 	phone: true,

	// 	phoneRegionCode: 'vn'

	// });

};



/* Ready */
$(document).ready(function () {
	MIKOTECH.AllPage();
	MIKOTECH.OwlPage();
});
