<h2 class="wplc_wizard_title"><?= __("Chat styling")?></h2>
<div class="row">
	<div class="col-md-6 wplc_colorpickers">
        <div class="row">
            <div class="form-group offset-md-3 col-md-6">
                <label class="col-form-label wplc_colorpicker_label" for="base_color"><?= __( "Base Color", 'wp-live-chat-support' ) ?></label>
                <input class="form-control wplc_style_colorpicker" type="color" id="base_color" name="base_color"/>
            </div>
        </div>
        <div class="row">
            <div class="form-group offset-md-3 col-md-6">
                <label class="col-form-label wplc_colorpicker_label" for="agent_color"><?= __( "Agent bubble Color", 'wp-live-chat-support' ) ?></label>
                <input class="form-control wplc_style_colorpicker" type="color" id="agent_color" name="agent_color"/>
            </div>
        </div>
        <div class="row">
            <div class="form-group offset-md-3 col-md-6">
                <label class="col-form-label wplc_colorpicker_label" for="client_color"><?= __( "Client bubble Color", 'wp-live-chat-support' ) ?></label>
                <input class="form-control wplc_style_colorpicker" type="color" id="client_color" name="client_color"/>
            </div>
        </div>
	</div>
	<div class="col-md-6">
		<?php $preview_component->run(); ?>
	</div>
</div>