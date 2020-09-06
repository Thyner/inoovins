var emoji_converter;
jQuery(function () {
    emoji_converter = wplc_setup_emoji_converter();
    var messageElements =jQuery(".history_chat_message");
    messageElements.hide();

    jQuery.each( messageElements,function(index,message){
        jQuery(message).html( emoji_converter.replace_colons(jQuery(message).html()));
    })

    messageElements.show();
});
