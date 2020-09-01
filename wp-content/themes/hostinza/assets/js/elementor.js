( function ($, elementor) {
    "use strict";

    var Hostinza = {

        init: function () {
            
            var widgets = {
                'xs-maps.default': Hostinza.Map,
                'xs-testimonial.default': Hostinza.Testimonial,
                'xs-pricing-table.default': Hostinza.Pricing
            };
 
            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });

        },

        Map: function ($scope) {

            var $container = $scope.find('.hostinza-maps'),
                map,
                init,
                pins;
            if (!window.google) {
                return;
            }

            init = $container.data('init');
            pins = $container.data('pins');
            map = new google.maps.Map($container[0], init);

            if (pins) {
                $.each(pins, function (index, pin) {

                    var marker,
                        infowindow,
                        pinData = {
                            position: pin.position,
                            map: map
                        };

                    if ('' !== pin.image) {
                        pinData.icon = pin.image;
                    }

                    marker = new google.maps.Marker(pinData);

                    if ('' !== pin.desc) {
                        infowindow = new google.maps.InfoWindow({
                            content: pin.desc
                        });
                    }

                    marker.addListener('click', function () {
                        infowindow.open(map, marker);
                    });

                    if ('visible' === pin.state && '' !== pin.desc) {
                        infowindow.open(map, marker);
                    }

                });
            }
        },

        Testimonial: function ($scope) {
            var xs_testimonial_slider = $scope.find('.xs-testimonial-slider');
            var xs_testimonial_slider_2 = $scope.find('.xs-testimonial-slider-2');

            if (xs_testimonial_slider.length > 0) {
                xs_testimonial_slider.myOwl({
                    items: 3,
                    center: true,
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn',
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

            if (xs_testimonial_slider_2.length > 0) {
                xs_testimonial_slider_2.myOwl({
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
        },

        Pricing: function(e){
            var xs_pricing_table = e.find('.pricing-matrix-slider');
            let sliderItems = e.find('.pricing-matrix-slider .pricing-matrix-item').length;
            
            let slideControl = null;
            if (sliderItems <= 3) {
                slideControl = false;
            } else if (sliderItems >= 4){
                slideControl = true;
            } else {
                return;
            }
            if(!xs_pricing_table){
                return;
            }
                
            xs_pricing_table.on( 'initialized.owl.carousel translated.owl.carousel', function() {
                var $this = $(this);
                $this.find( '.owl-item.last-child' ).each( function() {
                    $(this).removeClass( 'last-child' );
                });
                $(this).find( '.owl-item.active' ).last().addClass( 'last-child' );
            });
            xs_pricing_table.myOwl({
                items: 3,
                mouseDrag: slideControl,
                autoplay: slideControl,
                nav: true,
                navText: ['<i class="icon icon-arrow-left"></i>', '<i class="icon icon-arrow-right"></i>'],
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
                        mouseDrag: false,
                        loop: false
                    }
                }
            });
            equalHeight();
            function equalHeight(){
                
                let pricingImage = e.find('.pricing-image'),
                    pricingFeature = e.find('.pricing-feature-group');
                if ($(window).width() > 991) {
                    pricingImage.css('height', pricingFeature.outerHeight());
                } else {
                    pricingImage.css('height', 100+'%');
                }
            }
        },

        

    };

    $(window).on('elementor/frontend/init', Hostinza.init);

}(jQuery, window.elementorFrontend) );