<h2 class="wplc_wizard_title"><?= __( "3CX PBX settings" ) ?></h2>
<div class="row mx-2">
    <div class="col-md-12">
        <div class="form-row">
            <div class="form-group col-md-12" id="existing_pbx_settings">
                <label class="col-form-label" for="clickToTalkUrl"><?= __( "3CX Click2Talk url", 'wp-live-chat-support' ) ?></label>
                <input id="clickToTalkUrl" name="clickToTalkUrl" class="form-control" type="text">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="col-form-label" for="c2cMode"><?= __( "Mode", 'wp-live-chat-support' ) ?></label>
                <select class="form-control" name="c2cMode">
                    <option value="all"><?= __( "Phone, Video and Chat", 'wp-live-chat-support' ) ?></option>
                    <option value="videochat"><?= __( "Video and Chat", 'wp-live-chat-support' ) ?></option>
                    <option value="phonechat"><?= __( "Phone and Chat", 'wp-live-chat-support' ) ?></option>
                    <option value="phone"><?= __( "Only Phone", 'wp-live-chat-support' ) ?></option>
                    <option value="chat"<?= __( "Only Chat", 'wp-live-chat-support' ) ?></option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="c2cAuthType"><?= __( "Authentication", 'wp-live-chat-support' ) ?></label>
                <select class="form-control" name="c2cAuthType">
                    <option value="both"><?= __( "Name and Email", 'wp-live-chat-support' ) ?></option>
                    <option value="email"><?= __( "Email", 'wp-live-chat-support' ) ?></option>
                    <option value="name"><?= __( "Name", 'wp-live-chat-support' ) ?></option>
                    <option value="none"><?= __( "No auth required", 'wp-live-chat-support' ) ?></option>
                </select>
            </div>
        </div>
    </div>
</div>