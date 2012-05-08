<section id="login">
    <h1><?php echo lang('user-login-header'); ?></h1>
    <form action="<?php echo current_url(); ?>"
        method="POST"
        class="well"
        >
        <fieldset>
            <div class="control-group">
                <label for="identity"
                    class="control-label text"
                    ><?php echo lang('user-field-identity'); ?></label>
                <div class="controls">
                    <input id="identity" name="identity"
                        type="text"
                        placeholder="<?php echo lang('user-field-identity-placeholder'); ?>"
                        value="<?php echo set_value('identity'); ?>"
                        class="text"
                        />
                    <p class="help-inline"><?php echo lang('user-field-identity-help'); ?></p>
                </div>
            </div>
            <div class="control-group">
                <label for="password"
                    class="control-label password"
                    >Password</label>
                <div class="controls">
                    <input id="password" name="password"
                        type="password"
                        value="<?php echo set_value('password'); ?>"
                        placeholder="<?php echo lang('user-field-password-placeholder'); ?>"
                        class="password"
                        />
                        <p class="help-inline"><?php echo lang('user-field-password-help'); ?></p>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <label for="remember"
                        class="control-label checkbox inline"
                        ><input id="remember" name="remember"
                            type="checkbox"
                            value="TRUE"
                            /><?php echo lang('user-field-remember-me'); ?></label>
                </div>
            </div>
        </fieldset>
        <fieldset class="form-actions">
            <input type="submit"
                value="<?php echo lang('user-login-submit-btn'); ?>"
                class="submit btn btn-primary"
                />
        </fieldset>
    </form>
</section>
