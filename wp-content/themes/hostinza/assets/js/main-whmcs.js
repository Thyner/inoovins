( function ( $ ) {
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
     
     
     */

    $( window ).on( 'load', function () {



        /*==========================================================
         9. prelaoder
         ======================================================================*/
        $( '#preloader' ).addClass( 'loaded' );

    } ); // END load Function

    $( document ).ready( function () {


        /*==========================================================
         10. preloader close button
         ======================================================================*/
        $( '.prelaoder-btn' ).on( 'click', function ( e ) {
            e.preventDefault();
            if ( !( $( '#preloader' ).hasClass( 'loaded' ) ) ) {
                $( '#preloader' ).addClass( 'loaded' );
            }
        } )

        /*==========================================================
         11. mega navigation menu init
         ======================================================================*/
        if ( $( '.xs-menus' ).length > 0 ) {
            $( '.xs-menus' ).xs_nav( {
                mobileBreakpoint: 992,
            } );
        }

        if ( $( '.xs-modal-popup' ).length > 0 ) {
            $( '.xs-modal-popup' ).magnificPopup( {
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
            } );
        }
    } ); // end ready function

} )( jQuery );