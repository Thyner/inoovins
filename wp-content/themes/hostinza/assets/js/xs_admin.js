jQuery( document ).ready( function($)
{
    // Starts by hiding the "Video Options" meta box
    $( "#fw-backend-option-fw-option-video_url" ).addClass( "hidden" );
    $( "#fw-backend-option-fw-option-soundcloud_embed" ).addClass( "hidden" );
    $( "#fw-backend-option-fw-option-gallery" ).addClass( "hidden" );

    if( $( "input#post-format-video" ).is(':checked') ){
        $( "#fw-backend-option-fw-option-video_url" ).removeClass( "hidden" );
    }
    // If "Video" post format is selected, show the "Video Options" meta box
    $( "input#post-format-video" ).on( "change", function() {
        if( $(this).is(':checked') ){
            $( "#fw-backend-option-fw-option-video_url" ).removeClass( "hidden" );
        }
    } );

    if( $( "input#post-format-audio" ).is(':checked') ){
        $( "#fw-backend-option-fw-option-soundcloud_embed" ).removeClass( "hidden" );
    }
    // If "Video" post format is selected, show the "Video Options" meta box
    $( "input#post-format-audio" ).on( "change", function() {
        if( $(this).is(':checked') ){
            $( "#fw-backend-option-fw-option-soundcloud_embed" ).removeClass( "hidden" );
        }
    } );

    if( $( "input#post-format-gallery" ).is(':checked') ){
        $( "#fw-backend-option-fw-option-gallery" ).removeClass( "hidden" );
    }
    // If "Video" post format is selected, show the "Video Options" meta box
    $( "input#post-format-gallery" ).on( "change", function() {
        if( $(this).is(':checked') ){
            $( "#fw-backend-option-fw-option-gallery" ).removeClass( "hidden" );
        }
    } );

});