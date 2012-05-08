<section id="forgot">
    <h1><?php echo lang('user-forgot-header'); ?></h1>
    <form action="<?php echo site_url('login/forgot'); ?>"
        method="POST"
        class="well"
        >
        <fieldset>
            <div class="controlgroup">
                <label for="identity"
                    class="control-label text"
                    ><?php echo lang('user-field-identity'); ?></label>
                <div class="controls">
                    <input id="identity" name="identity"
                        type="text"
                        placeholder="<?php echo lang('user-field-identity-placeholder'); ?>"
                        class="text"
                        value="<?php echo set_value('identity'); ?>"
                        />
                    <p class="help-inline"><?php echo lang('user-field-identity-help'); ?></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="form-actions">
            <input type="submit"
                value="<?php echo lang('user-forgot-submit-btn'); ?>"
                class="submit btn btn-primary" />
        </fieldset>
    </form>
</section>
