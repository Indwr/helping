(function ($) {

    "use strict";

    $(document).on('ready', function () {

        // Header Style and Scroll to Top
        function headerStyle() {
            if ($('.main-header').length) {
                var windowpos = $(window).scrollTop();
                var siteHeader = $('.main-header');
                var scrollLink = $('.scroll-top');
                if (windowpos >= 250) {
                    siteHeader.addClass('fixed-header');
                    scrollLink.fadeIn(300);
                } else {
                    siteHeader.removeClass('fixed-header');
                    scrollLink.fadeOut(300);
                }
            }
        }
        headerStyle();


        
        // dropdown menu

        var mobileWidth = 992;
        var navcollapse = $('.navigation li.dropdown');

        navcollapse.hover(function() {
            if ($(window).innerWidth() >= mobileWidth) {
                $(this).children('ul').stop(true, false, true).slideToggle(300);
                $(this).children('.megamenu').stop(true, false, true).slideToggle(300);
            }
        });


        //Submenu Dropdown Toggle
        if ($('.main-header .navigation li.dropdown ul').length) {
            $('.main-header .navigation li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');

            //Dropdown Button
            $('.main-header .navigation li.dropdown .dropdown-btn').on('click', function () {
                $(this).prev('ul').slideToggle(500);
                $(this).prev('.megamenu').slideToggle(800);
            });

            //Disable dropdown parent link
            $('.navigation li.dropdown > a').on('click', function (e) {
                e.preventDefault();
            });
        }

        //Submenu Dropdown Toggle
        if ($('.main-header .main-menu').length) {
            $('.main-header .main-menu .navbar-toggle').on('click', function () {
                $(this).prev().prev().next().next().children('li.dropdown').hide();
            });

        }


        //Main Slider Carousel
    if ($('.main-slider-carousel').length) {
        $('.main-slider-carousel').owlCarousel({
            loop:true,
            margin:0,
            nav:true,
            dots:false,
            animateOut: 'slideOutDown',
            animateIn: 'fadeIn',
            active: true,
            smartSpeed: 1000,
            autoplay: 5000,
            navText: [ '<span class="fas fa-arrow-left"></span>', '<span class="fas fa-arrow-right"></span>' ],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1200:{
                    items:1
                }
            }
        });         
    }


        // SHOW - HIDE - BOX SEARCH ON MENU
		$('.button-search').on('click', function () {
			$('.nav-search').toggleClass('hide');
		});
		// HIDE BOX SEARCH WHEN CLICK OUTSIDE
		if ($(window).width() > 767){
			$('body').on('click', function (event) {
				if ($('.button-search').has(event.target).length == 0 && !$('.button-search').is(event.target)
					&& $('.nav-search').has(event.target).length == 0 && !$('.nav-search').is(event.target)) {
					if ($('.nav-search').hasClass('hide') == false) {
						$('.nav-search').toggleClass('hide');
					};
				}
			});
		}
        

        /* Fact Counter + Text Count */
        if ($('.single-fact').length) {
            $('.single-fact').appear(function () {

                var $t = $(this),
                    n = $t.find(".count-text").attr("data-stop"),
                    r = parseInt($t.find(".count-text").attr("data-speed"), 10);

                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: $t.find(".count-text").text()
                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function () {
                            $t.find(".count-text").text(Math.floor(this.countNum));
                        },
                        complete: function () {
                            $t.find(".count-text").text(this.countNum);
                        }
                    });
                }

            }, {
                accY: 0
            });
        }






        //Single Item Carousel
        if ($('.single-item-carousel').length) {
            $('.single-item-carousel').slick({
                infinite: true,
                autoplay: true,
                arrows: true,
                prevArrow: '<button class="client-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow: '<button class="client-next"><i class="fas fa-chevron-right"></i></button>',
                pauseOnHover: false,
                autoplaySpeed: 2000,
                slidesToShow: 1,
                slidesToScroll: 1,
            });
        }



        /*Three item vertical Slider */
        if ($('.featured-tab-content').length) {
            $('.featured-tab-content').slick({
                infinite: true,
                autoplay: true,
                arrows: true,
                prevArrow: '<button class="featured-prev"><i class="fas fa-chevron-up"></i></button>',
                nextArrow: '<button class="featured-next"><i class="fas fa-chevron-down"></i></button>',
                vertical: true,
                pauseOnHover: false,
                autoplaySpeed: 2000,
                slidesToShow: 3,
                slidesToScroll: 1,
            });
        }

        //three Item Carousel
        if ($('.three-item-carousel').length) {
            $('.three-item-carousel').slick({
                infinite: true,
                autoplay: false,
                arrows: false,
                prevArrow: '<button class="expert-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow: '<button class="expert-next"><i class="fas fa-chevron-right"></i></button>',
                pauseOnHover: false,
                autoplaySpeed: 2000,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }

        //Four Item Carousel
        if ($('.four-item-carousel').length) {
            $('.four-item-carousel').slick({
                infinite: true,
                autoplay: true,
                arrows: false,
                prevArrow: '<button class="expert-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow: '<button class="expert-next"><i class="fas fa-chevron-right"></i></button>',
                pauseOnHover: false,
                autoplaySpeed: 2000,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }



        //LightBox / Fancybox
        if($('.lightbox-image').length) {
            $('.lightbox-image').fancybox({
                openEffect  : 'none',
                closeEffect : 'none',
                helpers : {
                    media : {}
                }
            });
        }


        //Stacked Image Carousel
        if($('.stacked-image-carousel').length){
            function slideSwitch() {
                var $active = $('.stacked-image-carousel .slides .slide.active');
                if ($active.length == 0) $active = $('.stacked-image-carousel .slides .slide:last');
                var $next =  $active.next().length ? $active.next() : $('.stacked-image-carousel .slides .slide:first');
                $('.stacked-image-carousel .slides .slide').removeClass('active');
                $next.addClass('active');
            }
            
            var myVar = setInterval(function(){slideSwitch();},5000);

            $('.stacked-image-carousel .slides .slide').click(function() {
                var current = $(this).attr('class','slide');
                $('.stacked-image-carousel .slides .slide').removeClass('active');
                $(current).addClass('active');
                clearInterval(myVar);
                slideSwitch();
            });
        }
    



        
        
        // Projects Load More Ajax
        if($('.project-load').length){
            $('.project-load').simpleLoadMore({
              item: '.gallery-box',
              count: 9,
              itemsToLoad: 3,
              btnHTML: '<div class="gallery-btn text-center mt-25 mb-25"><a href="gallery.html" class="theme-btn">Browse All</a></div>'
            });
        }


        // Our Experts Load More Ajax
        if($('.experts-load').length){
            $('.experts-load').simpleLoadMore({
              item: '.every-expert',
              count: 8,
              itemsToLoad: 4,
              btnHTML: '<div class="col-md-12"><div class="expert-btn text-center mt-10 mb-45"><a href="#" class="theme-btn">Show More</a></div></div>'
            });
        }


        // Blog Load More Ajax
        if($('.blog-load').length){
            $('.blog-load').simpleLoadMore({
              item: '.news-box',
              count: 9,
              itemsToLoad: 3,
              btnHTML: '<div class="blog-btn text-center mt-25 mb-30"><a href="blog.html" class="theme-btn">Show More</a></div>'
            });
        }


        // Scroll to a Specific Div
        if ($('.scroll-to-target').length) {
            $(".scroll-to-target").on('click', function () {
                var target = $(this).attr('data-target');
                // animate
                $('html, body').animate({
                    scrollTop: $(target).offset().top
                }, 1000);

            });
        }


        /* Gallery With Filters */
        if ($('.gallery-filter').length) {
            $('.gallery-filter').mixItUp({});
        }




        /*Gallery Magnific Popup */
        if ($.fn.magnificPopup) {
            $('.gallery-overlay a').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out',
                    opener: function (openerElement) {
                        return openerElement.is('a') ? openerElement : openerElement.find('a');
                    }
                }
            });
        }


        // Scroll Down to Specific Area
        $(".scroll").on('click', function (e) {
            e.preventDefault();
            var hash = this.hash;
            var position = $(hash).offset().top;
            $("html").animate({
                scrollTop: position
            }, 2000);
        });


        // main-header background color chnage whene click on navbar-toggle
        $(".navbar-toggle").on('click', function () {
            $('.main-header').toggleClass('bg-blue');
        });


        // jQuery Nice Select
        $('select').niceSelect();


        // Elements Animation
        if ($('.wow').length) {
            var wow = new WOW({
                boxClass: 'wow', // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset: 0, // distance to the element when triggering the animation (default is 0)
                mobile: false, // trigger animations on mobile devices (default is true)
                live: true // act on asynchronously loaded content (default is true)
            });
            wow.init();
        }


    });



    /* ==========================================================================
       When document is resize, do
       ========================================================================== */

    $(window).on('resize', function () {
        var mobileWidth = 992;
        var navcollapse = $('.navigation li.dropdown');
        navcollapse.children('ul').hide();
        navcollapse.children('.megamenu').hide();


        // main-header background color remove whene window resize
        if ($(window).innerWidth() >= mobileWidth) {
            $('.main-header').removeClass('bg-black');
        }

    });


    /* ==========================================================================
       When document is scroll, do
       ========================================================================== */

    $(window).on('scroll', function () {

        // Header Style and Scroll to Top
        function headerStyle() {
            if ($('.main-header').length) {
                var windowpos = $(window).scrollTop();
                var siteHeader = $('.main-header');
                var scrollLink = $('.scroll-top');
                if (windowpos >= 100) {
                    siteHeader.addClass('fixed-header');
                    scrollLink.fadeIn(300);
                } else {
                    siteHeader.removeClass('fixed-header');
                    scrollLink.fadeOut(300);
                }
            }
        }

        headerStyle();

    });

    /* ==========================================================================
       When document is loaded, do
       ========================================================================== */

    $(window).on('load', function () {

        //Hide Loading Box (Preloader)
        function handlePreloader() {
            if ($('.preloader').length) {
                $('.preloader').delay(200).fadeOut(500);
            }
        }
        handlePreloader();
    });



})(window.jQuery);
