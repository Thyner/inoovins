var rendered_messages = {};
var emoji_converter;
var wplc_running_chat = {};
var wplc_poll_chat_delay = 5000;
var polling_chat_xhr = null;

jQuery(function () {
    if (localization_data.enable_files) {
        wplc_setup_file_picker();
    }
    if (localization_data.enable_emojis) {
        wplc_setup_emoji_picker();
    }
    if (localization_data.enable_typing) {
        wplc_setup_typing();
    }

    if (localization_data.channel === 'mcu') {
        wplc_setup_mcu_channel();
    }

    emoji_converter = wplc_setup_emoji_converter();
    wplc_change_chat_status(false);

    jQuery("body").on("openChat", function (e, cid) {
        jQuery("#wplc_agent_chat_input").val('');

        if (polling_chat_xhr != null) {
            wplc_running_chat.id = -1;
            polling_chat_xhr.abort();
        }
        //wplc_change_chat_status(false);
        wplc_load_chat_info(cid);
    });

    jQuery("body").on("joinChat", function (e, cid) {

        wplc_init_chat(cid);
    });
});

function wplc_load_chat_info(cid) {
    rendered_messages[cid] = {};
    wplc_get_chat_info_call(cid).then(function (chat) {
            wplc_running_chat = chat.Data;
            wplc_enable_chat(wplc_running_chat)
        },
        function (error) {
            console.log(error);
        });
}

//function wplc_init_chat(cid) {
function wplc_init_chat(cid) {
    if (!!localization_data.agent_accepts_data) {
        wplc_get_chat_agent_call(cid).then(
            function (response) {
                if (!response.ErrorFound) {
                    wplc_chatbox_activate(cid);
                    my_chats.push(cid);
                    wplc_get_chat_messages_call(cid).then(function (response) {
                        if (!response.ErrorFound) {
                            response.Data.forEach((msg) => {
                                wplc_render_message(msg, "server_message", wplc_running_chat);
                            });
                            wplc_change_chat_status(true);

                            if (localization_data.channel !== 'mcu') {
                                wplc_setup_chat_long_poll(wplc_running_chat);
                            } else {
                                wplc_join_chat_socket_session(wplc_running_chat);
                            }
                        }
                    })
                } else {
                    wplc_change_chat_status(false);
                    alert(response.ErrorMessage);
                }
            },
            function (error) {
                console.log(error);
            }
        )
    }
}

function wplc_unload_chat(chat) {
    rendered_messages[chat.id] = {};
    wplc_running_chat = {};
    wplc_change_chat_status(false);
}

function wplc_setup_emoji_picker() {
    jQuery('#wplc_agent_chat_input').emojiPicker(
        {
            iconHeight: 33,
            iconColor: 'white',
            iconBackgroundColor: '#05728f',
            width: '100%',
            fadeTime: 1,
            recentCount: 6,
            button: false,
            showFooter: false,
            container: '.input_msg_write'

        }
    );

    jQuery('#wplc_agent_chat_emojipicker').on('click', function (e) {
        e.preventDefault();
        jQuery('#wplc_agent_chat_input').emojiPicker('toggle');
    })
}

function wplc_setup_file_picker() {
    jQuery("#file_picker").on("click", function () {
            jQuery("#file_input").click();
        }
    );

    jQuery("#file_input").on("change", function () {
        if (jQuery("#file_input").val() === '') {
            return;
        }
        if (!wplc_checkFile(jQuery(this)[0].files[0].name)) {
            return;
        }
        let sending_id = wplc_render_sending_message("File Uploading", wplc_running_chat);
        var formdata = new FormData();
        formdata.append('security', localization_data.nonce);
        formdata.append('name', jQuery(this)[0].files[0].name);
        formdata.append('action', 'wplc_admin_upload_file');
        formdata.append('cid', wplc_running_chat.id);
        formdata.append('file', jQuery(this)[0].files[0]);

        jQuery.ajax({
            url: localization_data.ajaxurl,
            data: formdata,
            type: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            success: function (response) {
                jQuery("#file_input").val('');
                if (!response.ErrorFound) {
                    emoji_converter.colons_mode = false;
                    wplc_remove_message(wplc_running_chat.id, -1, sending_id, "local_message");
                    wplc_render_message({
                        id: response.Data.id,
                        msg: response.Data.fileLink,
                        added_at: response.Data.added_at,
                        originates: response.Data.originates,
                        is_file: true,
                    }, "server_message", wplc_running_chat)
                    if (localization_data.channel === 'mcu') {
                        jQuery('body').trigger('mcu-send-file', {
                            sessionID: wplc_running_chat.session,
                            agentID: localization_data.user_id,
                            url: response.Data.fileLink,
                            name: response.Data.fileName,
                            size: response.Data.fileSize
                        });
                    }
                }
            },
        });

    });
}

function wplc_checkFile(fileName) {
    let result = false;
    const allowedFileExtensions = ['png', 'pjp', 'jpeg', 'pjpeg', 'pjpeg', 'jpg', 'jfif'];
    const lastDot = fileName.lastIndexOf('.');
    const ext = fileName.substring(lastDot + 1);
    if (allowedFileExtensions.indexOf(ext.toLowerCase()) >= 0) {
        result = true;
    }
    return result;
}

function wplc_setup_typing() {
    jQuery("#wplc_agent_chat_input").on('input', function (e) {
        var inputField = jQuery(this);
        if (!inputField.data("typing")) {
            inputField.data("typing", true);
            setTimeout(function () {
                inputField.data("typing", false);
            }, 250);
            jQuery("body").trigger("mcu-send-typing", {
                sessionID: wplc_running_chat.session,
                agentID: localization_data.user_id
            });
        }
    });
}

function wplc_setup_chat_long_poll(chat) {
    let data = {
        action: 'wplc_admin_long_poll_chat',
        cid: chat.id,
        security: localization_data.nonce,
    };
    wplc_chat_polling(localization_data.ajaxurl, data, chat);
}

function wplc_get_chat_agent_call(chatID) {
    let data = {
        action: 'wplc_set_agent_chat',
        cid: chatID,
        security: localization_data.nonce,
    };
    return jQuery.ajax({
        url: localization_data.ajaxurl,
        data: data,
        type: "POST"
    });
}

function wplc_get_chat_info_call(cid) {
    let data = {
        action: 'wplc_get_chat_info',
        cid: cid,
        security: localization_data.nonce,
    };
    return jQuery.ajax({
        url: localization_data.ajaxurl,
        data: data,
        type: "POST"
    });
}

function wplc_get_chat_messages_call(chatID) {
    let data = {
        action: 'wplc_get_chat_messages',
        cid: chatID,
        security: localization_data.nonce,
    };
    return jQuery.ajax({
        url: localization_data.ajaxurl,
        data: data,
        type: "POST"
    });
}

function wplc_create_message_html(message_data, type, chat) {

    // console.log('msg', message_data);

    let templateIncoming = generate_incoming_message_tempalte();
    let templateOutgoing = generate_outgoing_message_template();

    let sender = parseInt(message_data.originates) === 2 ? chat.name : 'admin';
    let senderType = parseInt(message_data.originates) === 2 ? "user" : "admin";
    let template = senderType == "user" ? templateIncoming : templateOutgoing;

    let avatarName = wplc_isDoubleByte(sender) ? 'Visitor' : sender;
    let avatarEmail = senderType === "user" ? md5(chat.email) : md5(localization_data.agent_email);

    let data = {
        sender: sender,
        mid: message_data.id,
        elementId: type + "_" + message_data.id,
        senderType: senderType,
        message: wplc_decodeHtml(message_data.msg),
        gravatarSource: "//www.gravatar.com/avatar/" + avatarEmail +"?s=64&d=" + encodeURIComponent(localization_data.wplc_protocol + "://ui-avatars.com/api//" + avatarName + "/64/" + wplc_stringToColor(sender) + "/fff")
    };

    if (parseInt(message_data.originates) === -1) {
        data.submessage = 'sending....';
    } else {
        if (parseInt(message_data.originates) === 1) {
            data.submessage = generate_submessage_text(message_data.added_at, 'admin')
        } else {
            data.submessage = generate_submessage_text(message_data.added_at, chat.name);
        }
    }

    for (let propertyName in data) {
        let regx = new RegExp("{{" + propertyName + "}}", 'g');
        template = template.replace(regx, data[propertyName]);
    }

    var messageElement = jQuery(template);
    messageElement.find(".wplc_msg_container").text(data.message);
    return emoji_converter.replace_colons(wplc_linkify_message(messageElement[0].outerHTML, message_data.is_file));
    ;
}

function generate_submessage_text(date, name) {

    var date_added = new Date(date);
    var timezoneOffset = date_added.getTimezoneOffset();
    var result = '';
    if (localization_data.show_date && localization_data.show_time) {
        result = new Date((date_added.getTime() - (timezoneOffset * 60 * 1000))).toLocaleString();
    } else if (localization_data.show_date) {
        result = new Date((date_added.getTime() - (timezoneOffset * 60 * 1000))).toLocaleDateString();
    } else if (localization_data.show_time) {
        result = new Date((date_added.getTime() - (timezoneOffset * 60 * 1000))).toLocaleTimeString();
    }


    if (localization_data.show_name) {
        result = result + ' - ' + name;
    }


    return result;
}

function generate_incoming_message_tempalte() {
    let templateIncoming = `<div id="{{elementId}}" class="incoming_msg">`

    if (localization_data.show_avatar) {
        templateIncoming += `  <div class="incoming_msg_img">
                                       <img src="{{gravatarSource}}" alt="{{sender}} avatar">
                                   </div>`
    }

    templateIncoming += `    <div class="received_msg">
                                    <div class="received_withd_msg">
                                        <div class="wplc_msg_container">
                                        </div>
                                        <span class="time_date">{{submessage}}</span>
                                    </div>
                                </div>
                            </div>`
    return templateIncoming;
}

function generate_outgoing_message_template() {
    let templateOutgoing = `<div id="{{elementId}}" class="outgoing_msg">
                                <div class="sent_msg">
                                    <p class="wplc_msg_container"></p>
                                    <span class="time_date">{{submessage}}</span>
                                 </div>`

    if (localization_data.show_avatar) {
        templateOutgoing += `  <div class="incoming_msg_img">
                                       <img src="{{gravatarSource}}" alt="{{sender}} avatar">
                                   </div>`
    }

    templateOutgoing += ` 
                            </div>`

    return templateOutgoing;

}


function wplc_render_sending_message(message, chat) {
    let temp_id = Math.floor(Math.random() * (100001)) - 200000;
    message_data = {
        id: temp_id,
        msg: message,
        added_at: new Date(),
        originates: -1,
    }
    wplc_render_message(message_data, "local_message", chat);
    return temp_id;
}

function wplc_render_message(message_data, type, chat) {
    if (typeof rendered_messages[chat.id] != 'undefined') {
        if (!rendered_messages[chat.id].hasOwnProperty(message_data.originates)) {
            rendered_messages[chat.id][message_data.originates] = [];
        }
        if (rendered_messages[chat.id][message_data.originates].indexOf(message_data.id) < 0) {
            let wplc_chat_box_element = "#wplc_chat_messages";
            let new_message = jQuery(wplc_create_message_html(message_data, type, chat));
            jQuery(wplc_chat_box_element).append(new_message);
            rendered_messages[chat.id][message_data.originates].push(message_data.id);
            wplc_scroll_to_bottom();
        }
    }
}

function wplc_remove_message(chatID, originates, message_id, type) {
    let messageIndex = rendered_messages[chatID][originates].indexOf(message_id);
    if (messageIndex >= 0) {
        let message_element = "#" + type + "_" + message_id;
        jQuery(message_element).remove();
        rendered_messages[chatID][originates].splice(messageIndex, 1);
        wplc_scroll_to_bottom();
    }
}

function wplc_scroll_to_bottom() {

    let height = jQuery('#wplc_chat_messages')[0].scrollHeight;
    jQuery('#wplc_chat_messages').scrollTop(height);
}

function wplc_chatbox_activate(chatID) {
    jQuery(".typing_indicator").hide();

    jQuery("#wplc_admin_close_chat").unbind("click");

    jQuery("#wplc_admin_close_chat").on("click", function () {
        let data = {
            action: 'wplc_admin_close_chat',
            security: localization_data.nonce,
            cid: chatID
        };
        jQuery.ajax({
            url: localization_data.ajaxurl,
            data: data,
            type: "POST",
            success: function (plain_response) {
                wplc_change_chat_status(false);
                if (localization_data.channel === 'mcu') {
                    jQuery("body").trigger("mcu-chat-close", {
                        sessionID: wplc_running_chat.session,
                        agentID: localization_data.user_id,
                        statusID: plain_response.Status
                    });
                }
            },
            error: function (jqXHR, exception) {
                wplc_render_error('Error faced during the chat ending process please try again');
            },
            complete: function (response) {
            }
        });
    });

    jQuery("#wplc_agent_chat_input").keyup(function (event) {
        if (event.keyCode == 13) {
            jQuery("#wplc_admin_send_msg").click();
        }
    });

    jQuery("#wplc_admin_send_msg").on("click", wplc_send_message);

}

function wplc_send_message() {
    var message = jQuery("#wplc_agent_chat_input").val();
    jQuery("#wplc_agent_chat_input").val('');

    if (message !== "") {
        emoji_converter.colons_mode = true;
        var data = {
            action: 'wplc_admin_send_msg',
            security: localization_data.nonce,
            cid: wplc_running_chat.id,
            msg: emoji_converter.replace_unified(message)
        };
        let sending_id = wplc_render_sending_message(message, wplc_running_chat);
        jQuery.ajax({
            url: localization_data.ajaxurl,
            data: data,
            type: "POST",
            success: function (messageResponse) {
                if (!messageResponse.ErrorFound) {
                    jQuery("body").trigger("mcu-send-message", {
                        sessionID: wplc_running_chat.session,
                        agentID: localization_data.user_id,
                        message: message
                    });
                    emoji_converter.colons_mode = false;
                    wplc_remove_message(wplc_running_chat.id, -1, sending_id, "local_message");
                    wplc_render_message({
                        id: messageResponse.Data.id,
                        msg: messageResponse.Data.msg,
                        added_at: messageResponse.Data.added_at,
                        originates: messageResponse.Data.originates,
                    }, "server_message", wplc_running_chat)
                }
            },
            error: function (jqXHR, exception) {
                emoji_converter.colons_mode = false;
                wplc_render_error('Error faced during the send message process please try again');
            },
            complete: function (response) {
            }
        });
    }
}

function wplc_chat_polling(url, data, chat) {
    polling_chat_xhr = jQuery.ajax({
        url: url,
        data: data,
        type: "POST",
        timeout: 120000
    });
    polling_chat_xhr.then(function (response) {
            wplc_poll_chat_delay = 1500;
            if (!response.ErrorFound) {

                if (typeof response.Data !== 'undefined'
                    && typeof response.Data.ActionCodes !== 'undefined'
                    && response.Data.ActionCodes != null) {
                    if (response.Data.ActionCodes.length > 0) {
                        response.Data.ActionCodes.sort((first, second) => {
                            return (new Date(first.added_at)).getTime() - (new Date(second.added_at)).getTime();
                        });

                        data.last_informed = response.Data.ActionCodes[response.Data.ActionCodes.length - 1].code;
                    }
                }

                if (typeof response.Data !== 'undefined' &&
                    response.Data.Messages.length > 0) {
                    _.each(response.Data.Messages, function (msg) {
                        wplc_render_message(msg, 'server_message', chat);
                        wplc_ring_new_chat_message();
                    });
                }
                if ([16, 15, 14, 13].indexOf(parseInt(response.Status)) >= 0) {
                    wplc_running_chat = {};
                    wplc_change_chat_status(false)

                }
            } else {
                wplc_render_error(response.ErrorMessage);
            }
        }
        ,
        function (jqXHR, exception) {
            wplc_poll_chat_delay = 5000;
            if (jqXHR.status == 404) {
                wplc_render_error('Connection Error (404)');
                wplc_running_chat = {};
            } else if (jqXHR.status == 500) {
                wplc_render_error('Connection Error (500) - Retrying in 5 seconds...');
            } else if (exception === 'parsererror') {
                wplc_render_error('Connection Error (JSON Error)');
                wplc_running_chat = {};
            } else if (exception === 'abort') {
                wplc_render_error('Connection Error (Ajax Abort)');
            } else {
                wplc_render_error('Connection Error (Uncaught) - Retrying in 5 seconds...');
            }
        }).always(function (response) {
        if (wplc_running_chat.id == chat.id) {
            setTimeout(function () {
                wplc_chat_polling(url, data, chat);
            }, wplc_poll_chat_delay);
        }
    });
}

function wplc_enable_chat(chat) {
    jQuery("#wplc_chat_name").html(chat.name);

    jQuery("#wplc_chat_email").html(chat.email);

    var avatarName = wplc_isDoubleByte(chat.name) ? 'Visitor' : chat.name;
    var gravatarSource = "//www.gravatar.com/avatar/" + md5(chat.email) + "?s=48&d=" + encodeURIComponent(localization_data.wplc_protocol + "://ui-avatars.com/api//" + avatarName + "/48/" + wplc_stringToColor(chat.name) + "/fff")
    jQuery("#wplc_avatar_user").attr("src", gravatarSource);

    if (chat.hasOwnProperty("other") && chat.other.hasOwnProperty('custom_fields')
        && typeof chat.other.custom_fields !== 'undefined' && chat.other.custom_fields != null) {
        var custom_fields_html = '';
        chat.other.custom_fields.forEach(function (cf) {
            custom_fields_html += `<span class='part1'><b>${cf.name}</b></span>
                <span class='part2'>${cf.value}</span>
                <br/>`;
        });
        jQuery("#chat_custom_fields_info_tooltip").html(custom_fields_html);
        jQuery("#chat_custom_fields_info").show();
    }
    wplc_change_chat_status(true);
  /*  jQuery("#inactive_chat_box").fadeOut();
    jQuery("#active_chat_box")
        .css("display", "flex")
        .hide()
        .fadeIn();*/
}

function wplc_change_chat_status(enabled) {
    let endChatElement = jQuery("#wplc_admin_close_chat");
    let chatInputElement = jQuery("#wplc_agent_chat_input");
    jQuery("#chat_custom_fields_info").hide();
    endChatElement.attr("disabled", !enabled);
    if (!enabled) {
        jQuery("#active_chat_box").fadeOut();
        jQuery("#inactive_chat_box").fadeIn();
    } else {
        jQuery("#inactive_chat_box").hide();
        jQuery("#active_chat_box")
            .css("display", "flex")
            .hide()
            .fadeIn();
    }

    jQuery("#file_picker").attr("disabled", !enabled);
    jQuery("#wplc_admin_send_msg").attr("disabled", !enabled);
    jQuery("#wplc_agent_chat_emojipicker").attr("disabled", !enabled);
    jQuery("#quick_resp_btn").attr("disabled", !enabled);
    chatInputElement.attr("disabled", !enabled);
    chatInputElement.attr('placeholder', enabled ? "Type a message" : "Chat session ended.");
}

function wplc_render_error(error, chatID) {
    if (window.console) {
        console.log(error);
    }

    jQuery("#admin_chat_box_area_" + chatID).append("<small>" + error + "</small><br>");
    wplc_scroll_to_bottom();
}

function wplc_ring_new_chat_message() {
    if (!!localization_data.enable_ring) {
        new Audio(localization_data.ring_file).play()
    }
}

function wplc_linkify_message(message, is_file) {

    var displayText = is_file ? "Download / Open File" : "";
    return anchorme(message, {
        attributes: [
            {
                name: 'target',
                value: '_blank'
            },
            {
                name: 'rel',
                value: 'noopener noreferrer'
            }
        ],
        displayText: displayText,
        customTlds: ["local"]
    })

}

function wplc_add_quick_response(response) {
    jQuery("#wplc_agent_chat_input").val(response);
    jQuery("#wplc_agent_chat_input").focus();
}

function wplc_setup_mcu_channel() {
    jQuery("body").unbind('mcu-socket-connected');
    jQuery("body").on('mcu-socket-connected', function (e) {
        jQuery("#wplc_connecting_loader").hide();
        wplc_set_chat_panel_ui();
    });

    jQuery("body").unbind('mcu-socket-connecting');
    jQuery("body").on('mcu-socket-connecting', function (e) {
        jQuery("#wplc_connecting_loader").show();
        wplc_unload_chat(wplc_running_chat);
        jQuery("#chat_list_body").empty();
        jQuery("#wplc_chat_panel").hide();

    });

    jQuery("body").unbind('mcu-new-message');
    jQuery("body").on('mcu-new-message', function (e, message) {
        if (message.sessionId === wplc_running_chat.session) {
            wplc_render_message(message, 'server_message', wplc_running_chat);
            wplc_ring_new_chat_message();
        } else {
            update_badge_counter(message.sessionId);
        }
    });

    jQuery("body").unbind('mcu-chat-ended');
    jQuery("body").on('mcu-chat-ended', function (e, sessionID) {
        if (sessionID === wplc_running_chat.session) {
            wplc_change_chat_status(false);
        }
    });


    jQuery("body").unbind('mcu-chat-close', chat_close_event);
    jQuery("body").on('mcu-chat-close', chat_close_event);

    /* if (!!localization_data.agent_accepts_data) {
         jQuery("body").trigger('mcu-setup-socket');
     }*/

}

function chat_close_event(e, data) {
    if (data.sessionID === wplc_running_chat.session) {
        wplc_change_chat_status(false);
    }
}

function wplc_join_chat_socket_session(chat) {
    jQuery("body").trigger('mcu-socket-join', {sessionID: chat.session, agentID: localization_data.user_id});
}

function wplc_escape_html(s, forAttribute) {
    return s.replace(forAttribute ? /[&<>'"]/g : /[&<>]/g, function (c) {
        var esc_map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        };
        return esc_map[c];
    });
}

function update_badge_counter(sessionID) {
    var badge = jQuery(".chat_list.wplc_p_cul[data-sid='" + sessionID + "'] #wplc_message_count");
    var counter = badge.text();
    counter = counter == '' ? 1 : parseInt(counter) + 1;
    badge.html(counter);
    badge.show();
}
