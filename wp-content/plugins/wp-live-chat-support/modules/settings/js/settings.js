var validator;
jQuery(document).ready(function ($) {
   // showLoader();
    wplc_handle_errors("#PageError");

    wplc_addBusinessHoursValidationRules();

    validator = jQuery("#sets_form").validate({
        lang: current_locale,
        rules: settings_validation_rules,
        showErrors: wplc_tabs_validation_complete_function,
        submitHandler: function(form) {
            wplc_showLoader();
            jQuery('#bhModal').remove();
            jQuery('#wplc_bh_schedule').val(JSON.stringify(bh_schedules));
            form.submit();
        }
    });

    setupBusinessHours();
    setupAgentsTab();
    setupEmbedCode();

    initiate_gutenberg_settings();
    wplc_changeChannel(jQuery('input[type=radio][name=wplc_channel]:checked').val())

    jQuery('#wplc-multi-included-pages').multiSelect();
    jQuery('#wplc-multi-excluded-pages').multiSelect();
    jQuery('#wplc-multi-excluded-post-types').multiSelect();


   // jQuery("#wplc_settings_page_loader").hide();
    //jQuery(".wrap").fadeIn();

    jQuery("#wplc_sample_ring_tone").on("click", function (e) {
        var v = jQuery('#wplc_ringtone option:selected').attr('playurl');
        wplc_PlaySound(v, e);
    });

    jQuery("#wplc_sample_message_tone").on("click", function (e) {
        var v = jQuery('#wplc_messagetone option:selected').attr('playurl');
        wplc_PlaySound(v, e);
    });


    jQuery('#wplc_agent_select').on('change', function () {
        jQuery('#wplc_add_agent').show();
    });

    jQuery("#wplc_tabs").tabs({
        create: function (event, ui) {
            ///jQuery("#wplc_settings_page_loader").remove();
            jQuery(".wrap").fadeIn();
            jQuery(".wplc_settings_save_notice").fadeIn();
        },
        active: wplc_recallActiveTab(),
        activate: wplc_storeActiveTab
    }).addClass("ui-tabs-vertical ui-helper-clearfix");

    jQuery("#wplc_tabs li").removeClass("ui-corner-top").addClass("ui-corner-left");

    jQuery(".wplc_hide_input").hide();

    jQuery(".wplc_animation_image").on("click", function (e) {
        var self = jQuery(this);
        self.addClass("wplc_animation_active");

        jQuery.each(jQuery(".wplc_animation_image"), function (index, element) {
            if (jQuery(element).data("value") != self.data("value")) {
                jQuery(element).removeClass("wplc_animation_active");
            }

        });

        jQuery.each(jQuery(".wplc_animation_rb"), function (index, element) {
            if (jQuery(element).val() != self.data("value")) {
                jQuery(element).prop('checked', false);
            } else {
                jQuery(element).prop('checked', true);
            }

        });

    });

    jQuery(".wplc_settings_tooltip").tooltip({
        position: {
            my: "left+15 center",
            at: "right center",

        },
        template: '<div class="tooltip wplc_tooltip_control"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        onShow: function () {
            var $trigger = this.getTrigger();
            var offset = $trigger.offset();
            this.getTip().css({
                'top': offset.top,
                'left': offset.left
            });
        }
    });

    jQuery('input[type=radio][name=wplc_channel]').change(function () {
        wplc_changeChannel(this.value, true);
    });
    //hideLoader();
});

function wplc_PlaySound(url, e) {
    if (typeof url !== "undefined") {
        new Audio(url).play()
    }
    e.preventDefault();
}

function wplc_storeActiveTab(event, ui) {
    if (!window.sessionStorage)
        return;

    sessionStorage.setItem(
        "wplc-tabs-index",
        jQuery(event.target).tabs("option", "active")
    );
}

function wplc_recallActiveTab() {
    if (!window.sessionStorage)
        return 0;

    var active = sessionStorage.getItem("wplc-tabs-index");

    if (isNaN(active))
        active = 0;

    return active;
}

function wplc_tabs_validation_complete_function(errorMap, errorList) {
    wplc_validation_complete_function(errorMap, errorList, this);

    var errorCount = {};
    jQuery("[name='errorIndicator']").remove();
    for (var errorfield in this.invalid) {
        if (this.invalid[errorfield]) {
            var errorTab = jQuery("[name=" + errorfield + "]").closest("[role='tabpanel']").prop("id");
            errorCount[errorTab] = errorCount[errorTab] != undefined ? errorCount[errorTab] + 1 : 1;
        }
    }

    for (var errorTab in errorCount) {
        var buttonTab = jQuery("li[aria-controls='" + errorTab + "'] a[href='#" + errorTab + "']");
        var buttonhtml = jQuery("li[aria-controls='" + errorTab + "'] a[href='#" + errorTab + "']").html();
        jQuery(buttonTab).html(buttonhtml + "<span name='errorIndicator' style='padding-left:4px; color:red;'>(" + errorCount[errorTab] + ")</span>");
    }
    hideLoader();
}

function wplc_changeChannel(selection, cleanUrl = false) {
    var party_input_element = jQuery("#wplc_chat_party_input");
    var channel_input_element = jQuery("#wplc_channel_url_input");
    var channel_mode_element = jQuery("#wplc_pbx_mode");
    var files_input_element = jQuery("#wplc_files_url_input");

    if (selection === "wp" || selection === "mcu") {
        party_input_element.hide();
        channel_input_element.hide();
        channel_mode_element.hide();
        files_input_element.hide();
    } else if (selection === "phone") {
        if (cleanUrl) {
            party_input_element.val('');
            channel_input_element.val('');
            channel_mode_element.val('');
            files_input_element.val('');
        }
        party_input_element.show();
        channel_input_element.show();
        channel_mode_element.show();
        files_input_element.show();
    }
    setChannelValidationRules(selection);
}

function setupBusinessHours() {
    var modal = jQuery('#bhModal');
    var dayOfWeek = -1;
    modal.on('show.bs.modal', function (event) {
        var button = jQuery(event.relatedTarget); // Button that triggered the modal
        dayOfWeek = button.data('day');

        modal.find('#weekday').val(dayOfWeek);
    });
    renderBhSchedules();

    modal.find('#bhSave').on('click', function (e) {
            e.preventDefault();
            var fromHour = jQuery("#wplc_bh_schedule_from_hours");
            var toHour = jQuery("#wplc_bh_schedule_to_hours");
            var fromMinutes = jQuery("#wplc_bh_schedule_from_minutes");
            var toMinutes = jQuery("#wplc_bh_schedule_to_minutes");

            if (!Array.isArray(bh_schedules)) {
                bh_schedules = [];
            }

            if (bh_schedules[dayOfWeek] != undefined) {
                if (!Array.isArray(bh_schedules[dayOfWeek])) {
                    bh_schedules[dayOfWeek] = [];
                }
            } else {
                bh_schedules[dayOfWeek] = [];
            }


            bh_schedules[dayOfWeek].push({
                code: Math.floor(Math.random() * (100001)),
                from: {h: fromHour.val(), m: fromMinutes.val()},
                to: {h: toHour.val(), m: toMinutes.val()}
            })

            modal.hide().modal('hide');
            renderBhSchedules();
        }
    )
}

function renderBhSchedules() {
    var scheduleTemplate = "<strong>From:</strong> {fromHour}:{fromMinutes}  <strong>To:</strong> {toHour}:{toMinutes}"
    bh_schedules.forEach(function (daySchedules, index) {
        var scheduleList = jQuery("#bh_schedules_" + index);
        scheduleList.empty();
        if (daySchedules !== null && Array.isArray(daySchedules)) {
            daySchedules.forEach(function (schedule) {
                var scheduleString = scheduleTemplate.replace('{fromHour}', schedule.from.h)
                    .replace('{fromMinutes}', schedule.from.m)
                    .replace('{toHour}', schedule.to.h)
                    .replace('{toMinutes}', schedule.to.m);

                scheduleList.append(
                    jQuery('<li style="text-align: left">').append(
                        jQuery('<span>').append(scheduleString)
                    ).append(
                        jQuery('<span data-weekday="' + index + '" data-code="' + schedule.code + '" name="wplc_remove_schedule_' + schedule.code + '" id="wplc_remove_schedule_' + schedule.code + '">').append('<i style="margin-left:5px;" class="fas fa-trash">')
                    )
                );
            });
        }
    })

    jQuery("[name^=wplc_remove_schedule_]").each(function () {
        jQuery(this).on("click", function (e) {
            var elementToDelete = jQuery(this);
            var indexToRemove = bh_schedules[elementToDelete.data('weekday')].findIndex(function (item) {
                return parseInt(item.code) === parseInt(elementToDelete.data('code'));
            })
            bh_schedules[elementToDelete.data('weekday')].splice(indexToRemove, 1);
            renderBhSchedules();
        });
    });

}

function setupEmbedCode() {
    if (jQuery("#wplc_embed_code_viewer").length > 0) {
        var embed_code_viewer = ace.edit('wplc_embed_code_viewer');
        embed_code_viewer.$blockScrolling = Infinity;
        embed_code_viewer.setTheme('ace/theme/monokai');
        embed_code_viewer.getSession().setMode('ace/mode/html');
        embed_code_viewer.setOptions({
            readOnly: true,
            wrap: true
        });
        var callUsNode = jQuery(jQuery('#wplc_embed_code_viewer_textarea').val()).find("call-us");
        if (callUsNode.length <= 0) {
            callUsNode = jQuery(jQuery('#wplc_embed_code_viewer_textarea').val()).find("call-us-phone");
        }

        var embed_code = '';
        if (callUsNode.length > 0) {
            embed_code = callUsNode[0].outerHTML;
        }

        embed_code_viewer.setValue(embed_code, 1);
    }
}

function setupAgentsTab() {

    jQuery("#wplc_add_agent").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var newAgentBox = jQuery("#wplc_agent_box_template").clone();
        var selectedAgent = jQuery("#wplc_agent_select option:selected");

        newAgentBox.insertBefore(jQuery(this).closest("#wplc_add_new_agent_box"));
        newAgentBox.find(".wplc_agent_img").attr("src", "//www.gravatar.com/avatar/" + md5(selectedAgent.data("email")) + "?s=60&d=//ui-avatars.com/api//"+selectedAgent.data("name")+"/64/"+wplc_stringToColor(selectedAgent.data("name"))+"/fff");
        newAgentBox.find(".wplc_agent_name").html(selectedAgent.data("name"));
        newAgentBox.find(".wplc_agent_email").html(selectedAgent.data("email"));
        newAgentBox.find(".wplc_agent_edit").attr("href", settings_localization_data.edit_user_url + '?user_id=' + selectedAgent.val() + '#wplc-user-fields');
        newAgentBox.attr("id","wplc_agent_li_"+selectedAgent.val());
        newAgentBox.attr('data-local', true);
        newAgentBox.attr('data-id', selectedAgent.val());
        jQuery("#wplc_agents_to_add").val(jQuery("#wplc_agents_to_add").val()+selectedAgent.val()+',');
        newAgentBox.show();
    })

    jQuery("body").on("click", ".wplc_remove_agent", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var agentBox = jQuery(this).closest(".wplc_agent_box");
        var agentID = agentBox.data("id");


        jQuery("#wplc_agent_select").append();
        if( !agentBox.data("local")) {
            jQuery("#wplc_agents_to_remove").val(jQuery("#wplc_agents_to_remove").val() + agentID + ',');
        }else
        {
             var localAddedAgents = jQuery("#wplc_agents_to_add").val().split(",");
             localAddedAgents.splice(localAddedAgents.indexOf(agentID.toString()),1);
             jQuery("#wplc_agents_to_add").val(localAddedAgents.join());
        }
        agentBox.remove();
    });
}

function setChannelValidationRules(selectedChannel) {
    if(selectedChannel == 'phone')
    {
        jQuery("#wplc_channel_url_input").rules("add", {
            required: true
        });
        jQuery("#wplc_pbx_mode").rules("add", {
            required: true
        });
    }
    else
    {
        jQuery("#wplc_channel_url_input").rules("remove" );
        jQuery("#wplc_pbx_mode").rules("remove" );

        validator.resetForm();
    }
}
