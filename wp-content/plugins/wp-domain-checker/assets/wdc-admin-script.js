jQuery(document).ready(function() {

var select = jQuery("select[name='wdc-options_integration']").val();
	if(select === "disable"){
		jQuery('.row-10').hide();
        jQuery('.row-11').hide();
		jQuery('.row-18').hide();
	}else if(select === "whmcs"){
        wdc_whmcs();
    }else if(select === "whmcs_bridge"){
        wdc_whmcs_bridge();
    }else if(select === "woocommerce"){
		wdc_woocommerce();
	}else if(select === "custom"){
		wdc_custom();
	}

function wdc_whmcs(){
    jQuery('.row-18').hide();
    jQuery('.row-11').hide();
    jQuery('.row-10').show(400);
    jQuery("label[for='wdc-options_additional_button_link']").text("WHMCS URL");
    jQuery("tr.row-10 p").html("e.g: http://billing.host.com (<a href='https://asdqwe.net/wordpress-plugins/wp-domain-checker-docs/' target='_blank'>Documentation</a>)");

}

function wdc_whmcs_bridge(){
    jQuery('.row-18').hide();
    jQuery('.row-11').hide();
    jQuery('.row-10').show(400);
    jQuery("label[for='wdc-options_additional_button_link']").text("Site URL");
    jQuery("tr.row-10 p").html("e.g: http://asdqwehost.com (<a href='https://asdqwe.net/wordpress-plugins/wp-domain-checker-docs/' target='_blank'>Documentation</a>)");

}

function wdc_woocommerce(){
    jQuery('.row-11').show();
	jQuery('.row-18').show();
	jQuery('.row-10').show(400);
	jQuery("label[for='wdc-options_additional_button_link']").text("Product ID");
    jQuery("tr.row-10 p").html("e.g: 1234 (<a href='https://asdqwe.net/wordpress-plugins/wp-domain-checker-docs/' target='_blank'>Documentation</a>)");

}
function wdc_custom(){
    jQuery('.row-11').hide();
	jQuery('.row-18').hide();
	jQuery('.row-10').show(400);
	jQuery("label[for='wdc-options_additional_button_link']").text("Custom URL");
    jQuery("tr.row-10 p").html("Available template tag {domain},{sld},{tld} e.g: https://who.godaddy.com/whoisverify.aspx?domain={domain} (<a href='https://asdqwe.net/wordpress-plugins/wp-domain-checker-docs/' target='_blank'>Documentation</a>)");

}

jQuery("select[name='wdc-options_integration']").change(function() {
    if (this.value == "whmcs") {
        jQuery('.row-10').hide();
        wdc_whmcs();
    }
    else if (this.value == "whmcs_bridge") {
        jQuery('.row-10').hide();
        wdc_whmcs_bridge();
    }else if(this.value == "woocommerce"){
    	jQuery('.row-10').hide();
    	wdc_woocommerce();
    }else if(this.value == "custom"){
    	jQuery('.row-10').hide();
    	wdc_custom();
    }else if(this.value == "disable"){
    	jQuery('.row-10').hide(400);
        jQuery('.row-18').hide();
    	jQuery('.row-11').hide();
    }
});

jQuery("#whois-update").click(function() {

jQuery(this).addClass('install-now updating-message');
jQuery(this).text('Updating...');
jQuery(this).addClass('disabled');

        var data = {
                    'action': 'wdc_update_whois',
                    'security' : wdc_ajax.wdc_nonce
                    };
        jQuery.post(wdc_ajax.ajaxurl, data, function(response) {

        if(response == 'ok'){
            location.reload();
        }else if(response == '503'){
            alert('Service unavailable, please try again later..');
            location.reload();

        }else if(response == 'denied'){
            alert('Service unavailable, please try again later..');
            location.reload();
        }

    });


});

});
