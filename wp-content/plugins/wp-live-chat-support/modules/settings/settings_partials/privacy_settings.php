<h3><?php _e("Privacy", 'wp-live-chat-support') ?></h3>
<table class="wp-list-table wplc_list_table widefat fixed striped pages">
    <tbody>
      <tr>
        <td width="250" valign="top">
          <label for="wplc_gdpr_enabled"><?=__("Enable privacy controls", 'wp-live-chat-support'); ?> <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?=__('Disabling will disable all GDPR related options, this is not advised.', 'wp-live-chat-support'); ?>"></i></label>
        </td>
        <td>
          <input type="checkbox" class="wplc_check" name="wplc_gdpr_enabled" value="1" <?= (isset($wplc_settings->wplc_gdpr_enabled) && $wplc_settings->wplc_gdpr_enabled == '1' ? 'checked' : ''); ?>>
          <a href="https://www.eugdpr.org/" target="_blank"><?=__("Importance of GDPR Compliance", 'wp-live-chat-support'); ?></a>
        </td>
      </tr>

      <tr>
        <td width="250" valign="top">
          <label for="wplc_gdpr_notice_company"><?=__("Organization name", 'wp-live-chat-support'); ?></label>
        </td>
        <td>
          <input type="text" name="wplc_gdpr_notice_company" value="<?= (isset($wplc_settings->wplc_gdpr_notice_company) ? esc_attr(stripslashes($wplc_settings->wplc_gdpr_notice_company)) : get_bloginfo('name')); ?>">
        </td>
      </tr>

      <tr>
        <td width="250" valign="top">
          <label for="wplc_gdpr_notice_retention_purpose"><?=__("Data retention purpose", 'wp-live-chat-support'); ?></label>
        </td>
        <td>
          <input maxlength="80" type="text" name="wplc_gdpr_notice_retention_purpose" value="<?= (isset($wplc_settings->wplc_gdpr_notice_retention_purpose) ? esc_attr($wplc_settings->wplc_gdpr_notice_retention_purpose) : __('Chat/Support', 'wp-live-chat-support')); ?>">
        </td>
      </tr>

      <tr>
        <td width="250" valign="top">
          <label for="wplc_gdpr_notice_retention_period"><?=__("Data retention period", 'wp-live-chat-support'); ?></label>
        </td>
        <td>
          <input type="number" name="wplc_gdpr_notice_retention_period" min="1" max="730" value="<?= (isset($wplc_settings->wplc_gdpr_notice_retention_period) ? intval($wplc_settings->wplc_gdpr_notice_retention_period) : 30); ?>"> <?=__('days', 'wp-live-chat-support'); ?>
        </td>
      </tr>

      <tr>
        <td width="250" valign="top">
          <label><?=__("GDPR notice to visitors", 'wp-live-chat-support'); ?>
            <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?=__('Users will be asked to accept the notice shown here, in the form of a check box.', 'wp-live-chat-support'); ?>"></i>
          </label>
        </td>
        <td>
          <span>
            <?php
              echo wplc_gdpr_generate_retention_agreement_notice($wplc_settings);
              echo "<br><br>";
              echo apply_filters('wplc_gdpr_create_opt_in_checkbox_filter', "");
              ?>
          </span>
        </td>
      </tr>


      <tr>
        <td width="250" valign="top">
          <label><?=__("Use a custom text for GDPR notice", 'wp-live-chat-support'); ?>
            <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?=__('You can display a custom GDPR notice to your website visitors. Be sure to include all relevant informations according to GDPR directives.', 'wp-live-chat-support'); ?>"></i>
          </label>
        </td>
        <td>
          <p><input type="checkbox" class="wplc_check" name="wplc_gdpr_custom" value="1" <?= (isset($wplc_settings->wplc_gdpr_custom) && $wplc_settings->wplc_gdpr_custom == '1' ? 'checked' : ''); ?>> </p>

          <textarea cols="45" rows="5" maxlength="1000" name="wplc_gdpr_notice_text"><?= esc_textarea($wplc_settings->wplc_gdpr_notice_text); ?></textarea>
        </td>
      </tr>

    </tbody>
  </table>