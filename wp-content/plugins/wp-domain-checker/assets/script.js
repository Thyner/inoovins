jQuery(document).ready(function() {
	var form = jQuery('[id="hostinza-domain-form"]');
	if(jQuery('[id="hostinza-domain-form"]').length > 0 ){
		jQuery.each(form, function(x,y){
			console.log(jQuery(y).width())
			if(jQuery(y).width() < 500){
				jQuery(y).addClass('wdc-resp');
			}
		})
	}

	// box_size();
    // function box_size() {
    //     var window_width = jQuery('#wdc-domain-form').width();
	//
    //    // jQuery('.box').removeClass('break-one').removeClass('break-two').removeClass('break-three');
	//
    //     if (window_width <= 1000 && window_width > 900) {
    //         jQuery('#wdc-domain-form').addClass('wdc-resp');
    //     }
    //     else if (window_width <= 900 && window_width > 800) {
    //         jQuery('#wdc-domain-form').addClass('wdc-resp');
    //     }
    //     else if (window_width <= 800) {
    //         jQuery('#wdc-domain-form').addClass('wdc-resp');
    //     }
    // }
});

function wdcInvisrecaptchaCallback(token){

var responses = document.getElementsByClassName('g-recaptcha-response');

for(var i = 0; i <= responses.length; i++){
	if(responses[i].value === token){
		var form = responses[i];
		break;
	}
}

form = form.parentNode.parentNode.parentNode.parentNode;
	var domain = jQuery("input[name='domain']",form).val();
	var item_id = jQuery("input[name='item_id']",form).val();
	var allowed_tld = jQuery("input[name='allowed_tld']",form).val();
	var tld = jQuery("input[name='tld']",form).val();
	var z = jQuery(".g-recaptcha-response",form).attr('id');

	if(z !== undefined)
	{
	  z = z.match(/\d+/)

		if(z === null){
			z = 0;
		}else{
		  z = z[0];
		}
	}
	console.log(z);

	wdc_ajax_check_domain(form,domain,item_id,allowed_tld,tld);
	grecaptcha.reset(z);
	return false;
}

jQuery(document).ready(function() {

	var loading;
	var results;
	var display;
	var action;


		jQuery("div[id='hostinza-domain-form']").on("submit", function(){

		var form = this;
		var domain = jQuery("input[name='domain']",form).val();
		var item_id = jQuery("input[name='item_id']",form).val();
		var allowed_tld = jQuery("input[name='allowed_tld']",form).val();
		var tld = jQuery("input[name='tld']",form).val();
		var z = jQuery(".g-recaptcha-response",form).attr('id');

		if(z !== undefined)
		{
		  z = z.match(/\d+/)

			if(z === null){
				z = 0;
			}else{
			  z = z[0];
			}
		}


			if(jQuery("input[name='domain']",form).val() === "")
				{
					//alert('please enter your domain');
					jQuery("div[id='results']",form).html(unescape('<div class="callout callout-warning alert-warning clearfix"><div class="col-xs-10" style="padding-left:1px;text-align:left;"><i class="glyphicon glyphicon-remove" style="margin-right:10px;"></i> '+wdc_script.req_domain_text+'</div></div>'));

					return false;
				}

				var enable = jQuery('.g-recaptcha', form).length;
				var invis = jQuery("div[id='wdc-recaptcha']",form).attr('data-size');
				if(enable > 0 && invis === 'invisible' && grecaptcha.getResponse(z) === ''){

					grecaptcha.execute(z);
					return false;

			}else	if(enable > 0){
					action = 'wdc_recaptcha';
					var recaptcha_response = jQuery("textarea[name='g-recaptcha-response']",form).val();//eval('grecaptcha.getResponse(wdcs.' + z + ');');
					if(recaptcha_response === ''){
					jQuery("div[id='results']",form).html(unescape('<div class="callout callout-warning alert-warning clearfix"><div class="col-xs-10" style="padding-left:1px;text-align:left;"><i class="glyphicon glyphicon-remove" style="margin-right:10px;"></i> '+wdc_script.recaptcha_text+'</div></div>'));

					return false;
					}

				var recaptcha_data = {
		      		'action': action,
		      		'response': recaptcha_response,
		      		'security' : wdc_ajax.wdc_nonce
		    		};
				jQuery("div[id='results']",form).css('display','none');
				jQuery("div[id='loading']",form).css('display','inline');

				jQuery.ajax({
				type: "GET",
				url: wdc_ajax.ajaxurl,
				action: action,
				data: recaptcha_data,
				success: function(response_y){

				var y = JSON.parse(response_y);

				if(y.success === false && y["error-codes"] === ''){
					jQuery("div[id='loading']",form).css('display','none');
					jQuery("div[id='results']",form).html(unescape('<div class="callout callout-warning alert-warning clearfix"><div class="col-xs-10" style="padding-left:1px;text-align:left;"><i class="glyphicon glyphicon-remove" style="margin-right:10px;"></i> '+wdc_script.recaptcha_text+'</div></div>'));
					eval(grecaptcha.reset(z));
					return false;
				}else if(y.success === false && y["error-codes"] == 'missing-input-secret'){
					jQuery("div[id='loading']",form).css('display','none');
					jQuery("div[id='results']",form).html(unescape('<p class="not-available">The secret parameter is missing.</p>'));
					eval(grecaptcha.reset(z));
					return false;
				}else if(y.success === false && y["error-codes"] == 'invalid-input-secret'){
					jQuery("div[id='loading']",form).css('display','none');
					jQuery("div[id='results']",form).html(unescape('<p class="not-available">The secret parameter is invalid or malformed.</p>'));
					eval(grecaptcha.reset(z));
					return false;
				}else if(y.success === false && y["error-codes"] == 'missing-input-response'){
					jQuery("div[id='loading']",form).css('display','none');
					jQuery("div[id='results']",form).html(unescape('<p class="not-available">The response parameter is missing.</p>'));
					eval(grecaptcha.reset(z));
					return false;
				}else if(y.success === false && y["error-codes"] == 'invalid-input-response'){
					jQuery("div[id='loading']",form).css('display','none');
					jQuery("div[id='results']",form).html(unescape('<p class="not-available">The response parameter is invalid or malformed.</p>'));
					eval(grecaptcha.reset(z));
					return false;
				}

				wdc_ajax_check_domain(form,domain,item_id,allowed_tld,tld);

				return false;
				}
				});
		}else{

				wdc_ajax_check_domain(form,domain,item_id,allowed_tld,tld);
			}
			if(enable > 0){
			eval(grecaptcha.reset(z));
			}
				return false;
	});
	return false;
});

jQuery('#Search').keypress(function (e) {
	if(e.keyCode === 8){
   	return true;
   	}
    var regex = new RegExp("^[\x7f-\xffa-z\u0400-\u04FFA-Z0-9\-\.]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
     if(e.which == 13) {
     	jQuery(this).submit();
     	return false;
     }

    e.preventDefault();
    return false;
});

function wdc_ajax_check_domain(form,domain,item_id,allowed_tld,tld){
	jQuery("div[id='results']",form).css('display','none').html('');
				jQuery("div[id='loading']",form).css('display','inline');
				jQuery("#Submit",form).prop("disabled", true);
				var data = {
			      		'action': 'wdc_check_domain',
			      		'domain': domain,
						'item_id': item_id,
			      		'allowed_tld': allowed_tld,
			      		'tld': tld,
			      		'security' : wdc_ajax.wdc_nonce
			    		};

				jQuery.post(wdc_ajax.ajaxurl, data, function(response) {
				response = response.data;
				jQuery("#Submit",form).removeAttr('disabled');
				jQuery.each(response.ascii_tld, function(i, data) {
					var x = data;
					var pre_result = '<div id="wdc-tld-'+x+'"></div>'
					jQuery("div[id='results']",form).css('display','block').append(pre_result);
					domain = response.domain+'.'+data;
					idn = response.idn+'.'+response.tld[i];
					var data = {
							'action': 'wdc_display',
							'domain': domain,
							'idn'	: idn,
							'item_id': item_id,
							'allowed_tld': allowed_tld,
							'tld': tld,
							'punny_tld': response.tld[i],
							'security' : wdc_ajax.wdc_nonce
						};

					jQuery.post(wdc_ajax.ajaxurl, data, function(r) {
						response = r.data;
						var tld = response.tld;
						var result_text;
						jQuery("div[id='loading']",form).css('display','inline');
						if(response.status === 0){
							result_text = `<div protocol="${response.protocol}" class="callout callout-danger alert-danger clearfix not-available">
							 				<div class="col-xs-10" style="padding-left:1px;text-align:left;">
												<i class="icon icon-cross-circle" style="margin-right:1px;"></i> ${response.result_text}
											</div>
											<div class="col-xs-2" style="padding-right:1px">${response.additional_button}</div>
											</div>`;
						}else if (response.status === 1) {
							result_text = `<div protocol="${response.protocol}" class="callout callout-success alert-success clearfix available">
							 				<div class="col-xs-10" style="padding-left:1px;text-align:left;">
							 					<i class="icon icon-checked2" style="margin-right:1px;"></i> ${response.result_text}
											</div>
							 				<div class="col-xs-2" style="padding-right:1px">${response.additional_button} ${response.whmcs}</div>
							 				</div>`;
						}else if (response.status === 2) {
							result_text = `<div protocol="${response.protocol}" class="callout callout-warning alert-warning clearfix notfound">
							 				<div class="col-xs-10" style="padding-left:1px;text-align:left;">
							 					<i class="glyphicon glyphicon-exclamation-sign" style="margin-right:1px;"></i> ${response.result_text}
							 				</div>
							 				</div>`;
						}else if (response.status === 3) {
							result_text = `<div class="callout callout-warning alert-warning clearfix">
											<div class="col-xs-10" style="padding-left:1px;text-align:left;">
												<i class="glyphicon glyphicon-exclamation-sign" style="margin-right:1px;"></i> ${response.result_text}
												</div>
											</div>`;
						}
						jQuery("div[id='results'] div[id='wdc-tld-"+tld+"']",form).css('display','block').append(result_text);

					}).always(function() {
					     jQuery("div[id='loading']",form).css('display','none');
					});

				});


				});

}
