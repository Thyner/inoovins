(function($) {
    "use strict";
    $(document).ready(function() {

             
            if ($(".vps-slider").length > 0) {
                let $this = $(".vps-slider");
                $('.slider-btns').attr('href', sliderplans[12][0]);
                let urilink = sliderplans[12];
        
                let currentplan = 1;
                $this.xsslide('single', sliderplans, currentplan, 'xs', 'horizontal');
                $this.slider({ 
                    animate: true,
                    slide: function( event, ui ) {
                        // title
                        $('.slider-container .title').html(sliderplans[0][ui.value-1]);
                        // price
                        $('.slider-container .price').html(sliderplans[1][ui.value-1]);
                        // description
                        $('.slider-container .desc').html(sliderplans[2][ui.value-1]);
                        // cpu
                        $('.vps-pricing-list .cpu').html(sliderplans[3][ui.value-1]);
                        // brandwidth
                        $('.vps-pricing-list .brandwidth').html(sliderplans[4][ui.value-1]);
                        // brandwidth2
                        $('.vps-pricing-list .brandwidth2').html(sliderplans[5][ui.value-1]);
                        // ram
                        $('.vps-pricing-list .ram').html(sliderplans[6][ui.value-1]);
                        // setup 1
                        $('.vps-pricing-list .setup').html(sliderplans[7][ui.value-1]);
                        // setup 2
                        $('.vps-pricing-list .setup2').html(sliderplans[8][ui.value-1]);
                        // diskspace
                        $('.vps-pricing-list .diskspace').html(sliderplans[9][ui.value-1]);
                        // ip one
                        $('.vps-pricing-list .ip_one').html(sliderplans[10][ui.value-1]);
                        // ip two
                        $('.vps-pricing-list .ip_two').html(sliderplans[11][ui.value-1]);
                        // buttons
                        $('.slider-btns').attr('href', urilink[ui.value-1]);
                    },
                    change: function( event, ui ) {
                        // title
                        $('.slider-container .title').html(sliderplans[0][ui.value-1]);
                        // price
                        $('.slider-container .price').html(sliderplans[1][ui.value-1]);
                        // description
                        $('.slider-container .desc').html(sliderplans[2][ui.value-1]);
                        // cpu
                        $('.vps-pricing-list .cpu').html(sliderplans[3][ui.value-1]);
                        // brandwidth
                        $('.vps-pricing-list .brandwidth').html(sliderplans[4][ui.value-1]);
                        // brandwidth2
                        $('.vps-pricing-list .brandwidth2').html(sliderplans[5][ui.value-1]);
                        // ram
                        $('.vps-pricing-list .ram').html(sliderplans[6][ui.value-1]);
                        // setup 1
                        $('.vps-pricing-list .setup').html(sliderplans[7][ui.value-1]);
                        // setup 2
                        $('.vps-pricing-list .setup2').html(sliderplans[8][ui.value-1]);
                        // diskspace
                        $('.vps-pricing-list .diskspace').html(sliderplans[9][ui.value-1]);
                        // ip one
                        $('.vps-pricing-list .ip_one').html(sliderplans[10][ui.value-1]);
                        // ip two
                        $('.vps-pricing-list .ip_two').html(sliderplans[11][ui.value-1]);
                        // buttons
                        $('.slider-btns').attr('href', urilink[ui.value-1]);
                    }
                });
            }
        
            $('.slider-tigger').on( "click", function() {
                var value= parseInt(this.id.slice(5)) + 1;
                $('.vps-slider').slider('value', value);
                if (!$(this).hasClass('current')) {
                    $(this).addClass('current');
                    $(this).nextAll().removeClass('current');
                    $(this).prevAll().removeClass('current');
                } else {
                    $(this).removeClass('current');
                }
            });

            $('.vps-pricing-list li p').each(function () {
                if (!($(this).text().length)) {
                    $(this).parent().addClass('d-none')
                } else {
                    $(this).parent().removeClass('d-none')
                }
            })
            $('.slider-tigger').on('click', function () {
                $('.vps-pricing-list li p').each(function () {
                    if (!($(this).text().length)) {
                        $(this).parent().addClass('d-none')
                    } else {
                        $(this).parent().removeClass('d-none')
                    }
                })
            })

    }); // end ready function
    
})(jQuery);