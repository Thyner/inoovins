var settings_validation_rules = {
    wplc_settings_enabled: {
        required: true
    },
    wplc_settings_align: {
        required: true
    },
    wplc_settings_fill: {
        required: true
    },
    wplc_settings_font: {
        required: true
    },
    wplc_settings_base_color: {
        required: true
    },
    wplc_settings_agent_color: {
        required: true
    },
    wplc_settings_client_color: {
        required: true
    },
    wplc_powered_by_link: {
        required: true
    },
    wplc_require_user_info: {
        required: true
    },
    wplc_user_alternative_text: {
        required: true
    },
    wplc_pro_na: {
        required: true
    },
    wplc_offline_initial_message: {
        required: true
    },
    wplc_offline_finish_message: {
        required: true
    },
    wplc_pro_offline_btn_send: {
        required: true
    },
    wplc_chat_title: {
        required: true
    },
    wplc_pro_fst3: {
        required: true
    },
    wplc_button_start_text: {
        required: true
    },
    wplc_chat_intro: {
        required: true
    },
    wplc_text_chat_ended: {
        required: true
    },
    wplc_close_btn_text: {
        required: true
    },
    wplc_user_welcome_chat: {
        required: true
    },
    wplc_welcome_msg: {
        required: true
    },
    wplc_ringtone: {
        required: true
    },
    wplc_messagetone: {
        required: true
    },
    wplc_animation: {
        required: true
        /*
         function() {
                    var result = false;
                    jQuery.each(jQuery(".wplc_animation_rb"), function (index, element) {
                        if (jQuery(element).is(':checked')) {
                            result = true;
                            return false; //this breaks the loop
                        }
                    });
                    return result;
                }
         */
    },
    wplc_newtheme: {
        required: true
    },
    wplc_user_no_answer: {
        required: true
    },
    wplc_gdpr_notice_company: {
        required: true
    },
    wplc_gdpr_notice_retention_purpose: {
        required: true,
        maxlength: 80
    },
    wplc_default_department: {
        required: true
    },
    wplc_pro_chat_email_address: {
        required: true
    },
    wplc_send_transcripts_to: {
        required: true
    },
    wplc_et_email_header: {
        required: true
    },
    wplc_et_email_footer: {
        required: true
    },
    wplc_et_email_body: {
        required: true
    },
    wplc_user_default_visitor_name: {
        required: true
    },
    wplc_gdpr_notice_text:{
        maxlength: 1000
    },
    wplc_bh_schedule: {
        checkTimeOverlaps: true,
        normalizer: function (value) {
            return bh_schedules;
        }
    },
    wplc_pro_auto_first_response_chat_msg:{
        maxlength: 250
    }

}

function wplc_dateRangeOverlaps(first_start, first_end, second_start, second_end) {
    var result = false;
    if (
        (first_start <= second_start && second_start <= first_end) ||
        (first_start <= second_end && second_end <= first_end) ||
        (second_start < first_start && first_end < second_end)
    ) {
        result = true;
    }
    return result;
}

function wplc_addBusinessHoursValidationRules() {
    jQuery.validator.addMethod('checkTimeOverlaps', function (value, element, params) {
        var result = true;
        if (value !== null && Array.isArray(value)) {
            value.forEach(function (daySchedules, index) {
                //javascript foreach can't break, so we have to check the current result state to avoid override its value when error found.
                if (result && daySchedules !== null && Array.isArray(daySchedules)) {
                    for (var i = 0; i < daySchedules.length; i ++) {
                        for (var j = i+1; j < daySchedules.length; j ++) {

                            var firstStartTimeString = new Date('1970-01-01T' +   daySchedules[i].from.h+':'+daySchedules[i].from.m+':00Z');
                            var firstEndTimeString = new Date('1970-01-01T' +    daySchedules[i].to.h+':'+daySchedules[i].to.m+':00Z');

                            if(firstStartTimeString>=firstEndTimeString){
                                result = false;
                                break;
                            }

                            var secondStartTimeString =new Date('1970-01-01T' +  daySchedules[j].from.h+':'+daySchedules[j].from.m+':00Z');
                            var secondEndTimeString =new Date('1970-01-01T' +    daySchedules[j].to.h+':'+daySchedules[j].to.m+':00Z');

                            if(secondStartTimeString>=secondEndTimeString){
                                result = false;
                                break;
                            }

                            result = !wplc_dateRangeOverlaps(firstStartTimeString, firstEndTimeString, secondStartTimeString, secondEndTimeString);
                            if(!result)
                            {
                                break;
                            }
                        }
                        if(!result)
                        {
                            break;
                        }
                    }
                }
            })
        }
        return result;
    }, "There are schedule overlaps please check your configuration");
}

