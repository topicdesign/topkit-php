<form action="<?php echo current_url(); ?>"
    method="post"
    class="form-inline"
    accept-charset="utf-8">
    <div class="row-fluid">
        <div class="span8">
            <fieldset>
                <div class="control-group">
                    <label for="redirect-form-request"
                        class="control-label text"
                        ><?php echo lang('redirect-field-request'); ?></label>
                    <div class="controls">
                        <input id="redirect-form-request" name="request"
                            type="text"
                            value="<?php echo set_value('request',$redirect->request); ?>"
                            class="text"
                            required="required"
                            >
                    </div>
                </div>
                <div class="control-group">
                    <label for="redirect-form-target"
                        class="control-label text"
                        ><?php echo lang('redirect-field-target'); ?></label>
                    <div class="controls">
                        <input id="redirect-form-target" name="target"
                            type="text"
                            value="<?php echo set_value('target',$redirect->target); ?>"
                            class="text"
                            >
                    </div>
                </div>
                <div class="control-group">
                    <label for="redirect-form-status_code"
                        class="control-label text"
                        ><?php echo lang('redirect-field-status_code'); ?></label>
                    <div class="controls">
                        <input id="redirect-form-status_code" name="status_code"
                            type="text"
                            value="<?php echo set_value('status_code',$redirect->status_code); ?>"
                            class="text"
                            placeholder="302"
                            >
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row-fluid">
        <fieldset class="form-actions">
            <input id="redirect-form-save"
                type="submit"
                value="<?php echo lang('form-btn-save'); ?>"
                class="submit btn btn-primary btn-large"
                >
            <input id="redirect-form-reset"
                type="reset"
                value="<?php echo lang('form-btn-reset'); ?>"
                class="reset btn"
                >
        </fieldset>
    </div>
</form>
