(function ($) {
    "use strict";

    /*------------------------------------------------------------------
    [Table of contents]

    1. my owl function
    2. smooth scroll
    3. custom input type number function
    4. custom input type select function
    5. email patern
    6. equalheight function
    7. pricing fixedtable function
    8. content to center banner section
    9. prelaoder
    10. preloader close button
    11. mega navigation menu init
    12. twitter api init
    13. client slider
    14. testimonial slider
    15. blog post gallery slider
    16. contact form init
    17. video popup init
    18. Side Offset cart menu open
    19.	wow animation init
    20. my custom select init
    21. tab swipe indicator
    22. pricing matrix expand slider
    23. feature section prev class get function
    24. pricing expand function
    25. accordion add class "isActive" function
    26. click and go to current section init
    27. input number increase
    28. right click , ctrl+u and ctrl+shift+i disabled
    29. image dragable false setup
    30. ajaxchimp init
    31. XpeedStudio Maps




    -------------------------------------------------------------------*/

    //Demo Script
    $(".flag-lists li a").on('click', function (event) {
        alert("Hostinza supports WPML plugin! The language list will be automatically added to your pages when you install the plugin. ");
        event.preventDefault();
        return;
    });

    /*==========================================================
                    1. my owl function
    ======================================================================*/
    $.fn.myOwl = function (options) {

        var settings = $.extend({
            items: 1,
            dots: false,
            loop: true,
            mouseDrag: true,
            touchDrag: true,
            nav: false,
            autoplay: false,
            navText: ['', ''],
            margin: 0,
            stagePadding: 0,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            navRewind: false,
            responsive: {},
            animateOut: '',
            animateIn: '',
            smartSpeed: 900,
            center: ''
        }, options);

        return this.owlCarousel({
            items: settings.items,
            loop: settings.loop,
            mouseDrag: settings.mouseDrag,
            touchDrag: settings.touchDrag,
            nav: settings.nav,
            navText: settings.navText,
            dots: settings.dots,
            margin: settings.margin,
            stagePadding: settings.stagePadding,
            autoplay: settings.autoplay,
            autoplayTimeout: settings.autoplayTimeout,
            autoplayHoverPause: settings.autoplayHoverPause,
            animateOut: settings.animateOut,
            animateIn: settings.animateIn,
            responsive: settings.responsive,
            navRewind: settings.navRewind,
            center: settings.center,
            smartSpeed: settings.smartSpeed
        });
    };

    /*==========================================================
                    2. smooth scroll
    ======================================================================*/
    $.fn.scrollView = function () {
        return this.each(function () {
            $('html, body').animate({
                scrollTop: $(this).offset().top
            }, 1000);
        });
    }


    /*==========================================================
                    3. custom input type number function
    ======================================================================*/
    $.fn.customNumber = function (options) {
        var settings = $.extend({
            plusIcon: '',
            minusIcon: ''
        }, options);

        this.append('<span class="add">' + settings.plusIcon + '</span>');
        this.append('<span class="sub">' + settings.minusIcon + '</span>');

        return this.each(function () {
            let spinner = $(this),
                input = spinner.find('input[type="number"]'),
                add = spinner.find('.add'),
                sub = spinner.find('.sub');

            input.parent().on('click', '.sub', function (event) {
                event.preventDefault();
                if (input.val() > parseInt(input.attr('min'), 10)) {
                    input.val(function (i, oldvalue) {
                        return --oldvalue;
                    })
                }
            });
            input.parent().on('click', '.add', function (event) {
                event.preventDefault();
                if (input.val() < parseInt(input.attr('max'), 10)) {
                    input.val(function (i, oldvalue) {
                        return ++oldvalue;
                    })
                }
            });
        });
    }


    /*==========================================================
                    4. custom input type select function
    ======================================================================*/
    $.fn.mySelect = function (options) {
        let $this = $(this),
            numberOfOptions = $(this).children('option');

        $this.addClass('select-hidden');
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="select-styled"></div>');

        let styledSelect = $this.next('.select-styled');
        styledSelect.text($this.children('option').eq(0).text());

        let list = $('<ul />', {
            'class': 'select-options'
        }).insertAfter(styledSelect);

        for (let i = 0; i < numberOfOptions.length; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo(list);
        }

        let listItems = list.children('li');

        styledSelect.on('click', function (e) {
            e.stopPropagation();
            $('.select-styled.active').not(this).each(function () {
                $(this).removeClass('active').next('.select-options').fadeIn();
            });
            $(this).toggleClass('active').next('.select-options').toggle();
            $(this).parent().toggleClass('focus');
        });

        listItems.on('click', function (e) {
            e.stopPropagation();
            styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            list.hide();
            if ($(this).parent().parent().hasClass('focus')) {
                $(this).parent().parent().removeClass('focus');
            }
        });

        $(document).on('click', function () {
            styledSelect.removeClass('active');
            list.hide();
        });
    }

    if ($('.xs-domain-search').length > 0) {
        $('.xs-domain-search').mySelect();
    }
    /*==========================================================
                    5. email patern
    ======================================================================*/
    function email_pattern(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }


    /*==========================================================
                    6. equalheight function
    ======================================================================*/
    function equalHeight() {
        let pricingImage = $('.pricing-image'),
            pricingFeature = $('.pricing-feature-group');

        if ($(window).width() > 991) {
            pricingImage.css('height', pricingFeature.outerHeight());
        } else {
            pricingImage.css('height', 100 + '%');
        }
    }


    /*==========================================================
                    7. pricing fixedtable function
        ======================================================================*/
    function fixedtabel() {

        let table = $('.xs-table');

        if (!($(window).width() > 576)) {
            if ($('.xs-table.fixed-column').length === 0) {
                let fixedCol = table.clone().insertBefore(table).addClass('fixed-column');
            }
        } else {
            $('.xs-table.fixed-column').remove();
        }
        let fixedCol = $('.xs-table.fixed-column');
        fixedCol.find('th:not(:first-child),td:not(:first-child)').remove();

        fixedCol.find('tr').each(function (i, elem) {
            $(this).height(table.find('tr:eq(' + i + ')').height());
        });
    };

    /*==========================================================
                    8. content to center banner section
    ======================================================================*/
    function centerContent() {
        let content = $('.contet-to-center > .container'),
            header = $('.header-transparent');

        if ($(window).width() > 991) {
            content.css('margin-top', header.outerHeight());
        } else {
            content.css('margin-top', 0 + 'px');
        }
    }

    function removebrtag() {
        let content = $('#bridge #main-menu .navbar-nav li a');
        $(content).each(function (index, el) {
            $('br').remove();
        })
    }

    function stickyHeader() {
        var mainheader = $('.nav-sticky'),
            height = mainheader.outerHeight(),
            scroll = $(document).scrollTop();
        $(window).on('load', function () {
            if ($(document).scrollTop() > height) {
                if (mainheader.hasClass('sticky-header')) {
                    mainheader.removeClass('sticky-header');
                } else {
                    mainheader.addClass('sticky-header');
                }
            }
        })
        $(window).on('scroll', function () {
            var scrolled = $(document).scrollTop(),
                header = $('.sticky-header');
            if (scrolled > scroll) {
                header.addClass('sticky');
            } else {
                header.removeClass('sticky');
            }
            if (scrolled === 0) {
                mainheader.removeClass('sticky-header');
            } else {
                mainheader.addClass('sticky-header');
            }
            scroll = $(document).scrollTop();
        });
    }

    /*==========================================================
                    10. skew background width calculate function
    ======================================================================*/
    function skewBgWidthCalc() {
        var skewBg = $('.skew-bg'),
            width = $(window).width();
        skewBg.append('<style>.skew-bg::after{border-left: ' + width + 'px solid transparent}</style>')
    }

    /*==========================================================
 				11. on screen function
    ======================================================================*/
    $.fn.onScreen = function () {
        var offset = this.offset();
        var win = $(window);
        var viewport = {
            top: $(window).scrollTop(),
            left: $(window).scrollLeft()
        };
        viewport.right = viewport.left + $(window).width();
        viewport.bottom = viewport.top + $(window).height();
        offset.right = offset.left + this.outerWidth();
        offset.bottom = offset.top + this.outerHeight();
        return !(viewport.right < offset.left || viewport.left > offset.right || viewport.bottom < offset.top || viewport.top > offset.bottom);
    };

    /*==========================================================
                    12. set logo function
    ======================================================================*/
    function setLogo() {
        $('.xs-logo').each(function () {
            var $this = $(this).children(),
                clone = $this.clone(),
                holder = $('.nav-brand');
            if ($(window).width() > 991) {
                if (holder.children().length > 0) {
                    holder.children().remove();
                }
            } else {
                if (holder.children().length === 0) {
                    holder.append(clone);
                }
            }
        });
    }

    function menuTigger () {
        $('.nav .dropdown').on('click', function () {
            if ($(this).hasClass('open')) {
                $(this).removeClass('open')
            } else {
                $(this).addClass('open')
            }
        })
        $(window).on('resize', function () {
            if ($(window).width() > 991) {
                if ($('.nav .dropdown').hasClass('open')) {
                    $('.nav .dropdown').removeClass('open')
                }
            }
        })
    }

    $(window).on('load', function () {

        $('.menu-item-object-mega_menu').each(function () {
			var parent = $(this).parents('.menu-item');
			if (parent.hasClass('xs-megamenu')) {
				parent.removeClass('xs-megamenu')
			} else {
				parent.addClass('xs-megamenu')
			}
		})

        // equal hight init
        equalHeight();
        // fixedtable init
        fixedtabel();
        // center content
        centerContent();

        removebrtag();

        // sticky header init
        stickyHeader();

        // set logo
        setLogo();

        if ($('<style>.skew-bg::after</style>').length > 0) {
            skewBgWidthCalc();
        }

        /*==========================================================
                    9. prelaoder
        ======================================================================*/
        $('#preloader').addClass('loaded');

    }); // END load Function

    $(document).ready(function () {
        // equal hight init
        equalHeight();
        // fixedtable init
        fixedtabel();
        // center content
        centerContent();

        removebrtag();

        // sticky header init
        stickyHeader();

        // set logo
        setLogo();

        menuTigger ();

        if ($('<style>.skew-bg::after</style>').length > 0) {
            skewBgWidthCalc();
        }
        var domain_query;
        var query;
        $('.domain-search-form input[name="domain_query"]').on('keyup', function () {
            domain_query = $('.domain-search-form').find('input[name="domain_query"]').val();
            query = domain_query + '' + $('.select-styled').text();
            $('.domain-search-form input[name="query"]').attr('value', query);
        })
        $('.select-options li').on('click', function () {
            domain_query = $('.domain-search-form').find('input[name="domain_query"]').val();
            query = domain_query + '' + $(this).text();
            $('.domain-search-form input[name="query"]').attr('value', query);
        })

        $('.pure-form .select-options li').on('click', function () {
            var sld = $('.domain-search-form').find('input[name="domain"]').val();
            if ($('.select-styled').text() != 'All') {
                sld = sld.split('.', 1)[0];
                var domain = sld + '' + $('.select-styled').text();
                $('.domain-search-form input[name="domain"]').attr('value', domain);
            } else {
                sld = sld.split('.', 1)[0];
                $('.domain-search-form input[name="domain"]').attr('value', sld);
            }
        })


        $('#bridge p').each(function () {
            var $this = $(this);
            if ($this.html().replace(/\s|&nbsp;/g, '').length == 0)
                $this.remove();
        });

        /*==========================================================
                    10. preloader close button
        ======================================================================*/
        $('.prelaoder-btn').on('click', function (e) {
            e.preventDefault();
            if (!($('#preloader').hasClass('loaded'))) {
                $('#preloader').addClass('loaded');
            }
        })

        /*==========================================================
                11. mega navigation menu init
        ======================================================================*/
        if ($('.xs-menus').length > 0) {
            $('.xs-menus').xs_nav({
                mobileBreakpoint: 992,
            });
        }


        /*==========================================================
                13. client slider
        ======================================================================*/
        if ($('.xs-client-slider').length > 0) {
            $('.xs-client-slider').myOwl({
                items: 5,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 3
                    },
                    1024: {
                        items: 5
                    }
                }
            });
        }

        /*==========================================================
                14. testimonial slider
        ======================================================================*/
        if ($('.xs-testimonial-slider').length > 0) {
            $('.xs-testimonial-slider').myOwl({
                items: 3,
                center: true,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                margin: 30,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    1024: {
                        items: 3
                    }    
                }
            });
        } 
        /*==========================================================
                    19. testimonial slider 2
        ======================================================================*/
        if ($('.xs-testimonial-slider-2').length > 0) {
            $('.xs-testimonial-slider-2').myOwl({
                items: 3,
                center: true,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                dots: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    920: {
                        items: 2
                    },
                    1024: {
                        items: 3
                    }
                }
            });
        }
        /*==========================================================
                    15. blog post gallery slider
        ======================================================================*/
        if ($('.post-gallery-slider').length > 0) {
            $('.post-gallery-slider').myOwl({
                nav: true,
                navText: ['<i class="icon icon-arrow-left"></i>', '<i class="icon icon-arrow-right"></i>'],
                responsive: {
                    0: {
                        nav: false
                    }
                }
            });
        }

        /*==========================================================
                    16. contact form init
        ======================================================================*/

        $(document).on('submit', '#xs-contact-form', function (event) {
            event.preventDefault();
            /* Act on the event */

            var xs_contact_name = $('#xs_contact_name'),
                xs_contact_email = $('#xs_contact_email'),
                xs_contact_website = $('#xs_contact_website'),
                x_contact_massage = $('#x_contact_massage'),
                xs_contact_submit = $('#xs_contact_submit'),
                xs_contact_error = false;

            $('.xpeedStudio_success_message').remove();

            if (xs_contact_name.val().trim() === '') {
                xs_contact_name.addClass('invaild');
                xs_contact_error = true;
                xs_contact_name.focus();
                return false;
            } else {
                xs_contact_name.removeClass('invaild');
            }
            if (xs_contact_email.val().trim() === '') {
                xs_contact_email.addClass('invaild');
                xs_contact_error = true;
                xs_contact_email.focus();
                return false;
            } else if (!email_pattern(xs_contact_email.val().toLowerCase())) {
                xs_contact_email.addClass('invaild');
                xs_contact_error = true;
                xs_contact_email.focus();
                return false;
            } else {
                xs_contact_email.removeClass('invaild');
            }
            if (xs_contact_website.val().trim() === '') {
                xs_contact_website.addClass('invaild');
                xs_contact_error = true;
                xs_contact_website.focus();
                return false;
            } else {
                xs_contact_website.removeClass('invaild');
            }
            if (x_contact_massage.val().trim() === '') {
                x_contact_massage.addClass('invaild');
                xs_contact_error = true;
                x_contact_massage.focus();
                return false;
            } else {
                x_contact_massage.removeClass('invaild');
            }

            if (xs_contact_error === false) {
                xs_contact_submit.before().hide().fadeIn();
                $.ajax({
                    type: "POST",
                    url: "assets/php/contact-form.php",
                    data: {
                        'xs_contact_name': xs_contact_name.val(),
                        'xs_contact_email': xs_contact_email.val(),
                        'xs_contact_website': xs_contact_website.val(),
                        'x_contact_massage': x_contact_massage.val(),
                    },
                    success: function (result) {
                        xs_contact_submit.after('<p class="xpeedStudio_success_message">' + result + '</p>').hide().fadeIn();

                        setTimeout(function () {
                            $(".xpeedStudio_success_message").fadeOut(1000, function() {
                                $(this).remove();
                            })
                        }, 5000);

                        $('#xs-contact-form')[0].reset();
                    }
                });
            }
        });

        // off autocomplete
        $('input').each(function (e) {
            $(this).attr('autocomplete', 'off');
            $(this).attr('autocorrect', 'off');
        });


        $('.xs-service-block').on('mouseenter', function () {
            if (!$(this).hasClass('active')) {
                $(this).addClass('active')
            }
        });
        $('.xs-service-block').on('mouseleave', function (e) {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
        });


        /*==========================================================
                17. video popup init
        ======================================================================*/
        if ($('.xs-video-popup').length > 0) {
            $('.xs-video-popup').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        }

        /*==========================================================
             18. Side Offset cart menu open
        ======================================================================*/

        if ($('.close-side-widget').length > 0) {
            $('.close-side-widget').on('click', function (e) {
                e.preventDefault();
                $('.cart-group').removeClass('isActive');
            });
        }
        if ($('.navSidebar-button').length > 0) {
            $('.navSidebar-button').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $('.info-group').addClass('isActive');
            });
        }
        if ($('.close-side-widget').length > 0) {
            $('.close-side-widget').on('click', function (e) {
                e.preventDefault();
                $('.info-group').removeClass('isActive');
            });
        }
        $('body').on('click', function (e) {
            $('.info-group').removeClass('isActive');
            $('.cart-group').removeClass('isActive');
        });
        $('.xs-sidebar-widget').on('click', function (e) {
            e.stopPropagation();
        });

        /*=============================================================
                    19.	wow animation init
        =========================================================================*/
        $(function () {
            var wow = new WOW({
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: false,
                live: true,
                scrollContainer: null,
            });
            wow.init();
        });

        /*=============================================================
                    20. my custom select init
        =========================================================================*/

        /*=============================================================
                    21. tab swipe indicator
        =========================================================================*/
        if ($('.tab-swipe').length > 0) {
            $('.tab-swipe').append('<li class="indicator"></li>');
            if ($('.tab-swipe li a').hasClass('active')) {
                let cLeft = $('.tab-swipe li a.active').position().left + 'px',
                    cWidth = $('.tab-swipe li a.active').css('width');
                $('.indicator').css({
                    left: cLeft,
                    width: cWidth
                })
            }
            $('.tab-swipe li a').on('click', function () {
                $('.tab-swipe li a').removeClass('isActive');
                $(this).addClass('isActive');
                let cLeft = $('.tab-swipe li a.isActive').position().left + 'px',
                    cWidth = $('.tab-swipe li a.isActive').css('width');
                $('.indicator').css({
                    left: cLeft,
                    width: cWidth
                })
            });
        }

        /*=============================================================
            22. pricing matrix expand slider
        =========================================================================*/
        if ($('.pricing-matrix-slider').length > 0) {
            $('.pricing-matrix-slider').on('initialized.owl.carousel translated.owl.carousel', function () {
                var $this = $(this);
                $this.find('.owl-item.last-child').each(function () {
                    $(this).removeClass('last-child');
                });
                $(this).find('.owl-item.active').last().addClass('last-child');
            });
            let sliderItems = $(this).find('.pricing-matrix-slider .pricing-matrix-item').length;
            let slideControl = null;
            if (sliderItems <= 3) {
                slideControl = false;
            } else if (sliderItems >= 4){
                slideControl = true;
            } else {
                return;
            }
            $('.pricing-matrix-slider').myOwl({
                items: 3,
                mouseDrag: slideControl,
                autoplay: slideControl,
                nav: true,
                navText: ['<i class="icon icon-arrow-right"></i>', '<i class="icon icon-arrow-left"></i>'],
                loop: false,
                responsive: {
                    0: {
                        items: 1,
                        mouseDrag: true,
                        loop: true,
                    },
                    768: {
                        items: 2,
                        mouseDrag: true
                    },
                    1024: {
                        items: 3,
                        mouseDrag: slideControl,
                        autoplay: slideControl,
                    }
                }
            });
        }

        /*=============================================================
                    23. feature section prev class get function
        =========================================================================*/
        if ($('.xs-feature-section').length > 0) {
            if ($('.xs-feature-section').prev().hasClass('xs-bg-gray')) {
                $('.xs-feature-section').addClass('xs-bg-gray');
            } else {
                $('.xs-feature-section').removeClass('xs-bg-gray');
            }
            if ($('.xs-footer-section').prev().hasClass('xs-bg-gray')) {
                $('.xs-footer-section').children('.xs-feature-section').addClass('xs-bg-gray');
            } else {
                $('.xs-footer-section').children('.xs-feature-section').removeClass('xs-bg-gray');
            }
        };

        /*=============================================================
                    24. pricing expand function
        =========================================================================*/
        if ($('.pricing-expand').length > 0) {
            if ($(window).width() > 991) {
                let pricingContainer = $('.pricing-expand.pricing-matrix'),
                    height = Math.floor(pricingContainer.height()),
                    children = $('.pricing-expand.pricing-matrix .pricing-matrix-slider'),
                    childreHeight = children.height(),
                    gap = $('.pricing-expand.pricing-matrix .gap'),
                    gapHeight = gap.height(),
                    mini = Math.floor((height - ((childreHeight / 2) + (gap.length * 1)))),
                    animSpeed = 500,
                    load_more = $('#load_more_text'),
                    load_more_text = $(load_more).attr('title');


                if (typeof load_more_text !== 'undefined') {
                    pricingContainer.attr('data-height', height + 'px');
                    pricingContainer.attr('data-min', mini + 'px');
                    pricingContainer.css('height', mini + 'px');
                    if ($('.content-collapse-wraper').length === 0) {
                        pricingContainer.after(
                            '<div class="content-collapse-wraper"><a href="#" class="btn btn-primary expand-btn">' + load_more_text + ' <i class="icon icon-arrow_down"></i></a></div>'
                        );
                    }

                    $('.expand-btn').on('click', function (e) {
                        e.preventDefault();
                        let content = $(this).parent().prev();
                        content.animate({
                            'height': content.attr('data-height')
                        }, animSpeed);
                        content.addClass('expand');
                        $(this).addClass('hide');
                    });
                }
            } else {
                if ($('.pricing-matrix').hasClass('pricing-expand')) {
                    $('.pricing-matrix').removeClass('pricing-expand');
                    console.log('hi')
                } else {
                    $('.pricing-matrix').removeClass('pricing-expand');
                }
            }
        }
        $('.pricing-matrix .gap').prev().addClass('border-bottom-0');

        /*=============================================================
                    25. accordion add class "isActive" function
        =========================================================================*/
        if ($('.xs-accordion .card-header > a').length > 0) {
            $('.xs-accordion .card-header > a').on('click', function () {
                if (!$(this).parent().parent().hasClass('isActive')) {
                    $(this).parent().parent().prevAll().removeClass('isActive');
                    $(this).parent().parent().nextAll().removeClass('isActive');
                    $(this).parent().parent().addClass('isActive');
                }
            });
        }

        /*=============================================================
                    26. click and go to current section init
        =========================================================================*/
        $('.comment-reply-link').on('click', function (event) {
            event.preventDefault();
            $('#comment-form').scrollView();
        });

        /*=============================================================
                 27. input number increase
        =========================================================================*/

        $('.custom_number').customNumber({
            plusIcon: '<i class="icon icon-plus"></i>',
            minusIcon: '<i class="icon icon-minus"></i>'
        });



        $('.elementor-custom-embed-play').each(function () {
            $(this).addClass('xs-video-popup gloosy-btn');
            $(this).find('i').removeClass('eicon-play');
            $(this).find('i').addClass('icon icon-play2');
        })
        $('.elementor-widget-video').each(function () {
            $(this).append('<div class="xs-overlay xs-bg-black"></div>');
        })

        /*=============================================================
                 29. image dragable false setup
        =========================================================================*/
        $('img').each(function () {
            $(this).attr('draggable', 'false');
            $(this).on('mousedown', function (event) {
                if (event.preventDefault) {
                    event.preventDefault()
                }
            })
        })

        if ($('.wave_animation').length > 0) {
            $('.wave_animation').parallax();
        }

        if ($('.xs-modal-popup').length > 0) {
            $('.xs-modal-popup').magnificPopup({
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: false,
                callbacks: {
                    beforeOpen: function () {
                        this.st.mainClass = "my-mfp-slide-bottom xs-promo-popup";
                    }
                }
            });
        }
        $('[data-toggle="tooltip"]').tooltip();

        $(document).on('click', '.modal-footer [data-dismiss="modal"]', function () {
            if ($('#modalEmptyCart').hasClass('show')) {
                $('#modalEmptyCart').removeClass('show');
            }
            if ($('#modalEmptyCart').attr('style')) {
                $('#modalEmptyCart').removeAttr('style')
            }
            if ($('body.modal-open').attr('style')) {
                $('body.modal-open').removeAttr('style')
            }
            if ($('body').hasClass('modal-open')) {
                $('body').removeClass('modal-open')
            }
            if ($('.modal-backdrop').length > 0) {
                $('.modal-backdrop').remove();
            }
        })

        //        $('#modalEmptyCart').modal(toggle)
    }); // end ready function

    $(window).on('scroll', function () {
        /*==========================================================
                        43. shuffle letters
        ======================================================================*/
        $('.shuffle-letter-title-wraper').each(function (e) {
            if ($(this).onScreen() && !$(this).hasClass('shuffle-title')) {
                setTimeout(function () {
                    $(this).find('.shuufle-letter-title').shuffleLetters();
                    $(this).addClass('shuffle-title');
                }.bind(this), 400);
            }
        });
    }); // END Scroll Function 

    $(window).on('resize', function () {
        // equal hight init
        equalHeight();
        // fixedtable init
        fixedtabel();
        // center content
        centerContent();

        // set logo
        setLogo();

        if ($('<style>.skew-bg::after</style>').length > 0) {
            skewBgWidthCalc();
        }
    }); // End Resize

    $('#home-banner').append('<div class="icon-bg"></div>');

})(jQuery);