jQuery(document).ready(function(e) {

    wplc_handle_errors("#PageError");
    jQuery("body").on("change", "#wplc_trigger_type", set_view_by_trigger_type);
    jQuery("#wplc_trigger_type").trigger("change");

    jQuery("#tr_form").validate({
        lang: current_locale,
        rules: triggers_validation_rules
    });

});

function set_view_by_trigger_type() {
    var selection = jQuery(this).val();

    switch (parseInt(selection)) {
        case 0:
        case 3:
            jQuery("#wplc_trigger_secs_row").hide();
            jQuery("#wplc_trigger_scroll_row").hide();
            break;
        case 1:
            jQuery("#wplc_trigger_secs_row").show();
            jQuery("#wplc_trigger_scroll_row").hide();
            break;
        case 2:
            jQuery("#wplc_trigger_secs_row").hide();
            jQuery("#wplc_trigger_scroll_row").show();
            break;
    }
}