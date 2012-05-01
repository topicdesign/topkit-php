<form action="<?php echo current_url(); ?>"
    method="post"
    class="form-inline"
    accept-charset="utf-8">
    <div class="row-fluid">
        <div class="span8">
            <fieldset>
                <div class="control-group">
                    <label for="user-form-email"
                        class="control-label text"
                        ><?php echo lang('user-field-email'); ?></label>
                    <div class="controls">
                        <input id="user-form-email" name="email"
                            type="text"
                            value="<?php echo set_value('email',$user->email); ?>"
                            class="text"
                            required="required"
                            >
                    </div>
                </div>
                <div class="control-group">
                    <label for="user-form-username"
                        class="control-label text"
                        ><?php echo lang('user-field-username'); ?></label>
                    <div class="controls">
                        <input id="user-form-username" name="username"
                            type="text"
                            value="<?php echo set_value('username',$user->username); ?>"
                            class="text"
                            >
                    </div>
                </div>
                <div class="control-group">
                    <label for="user-form-password"
                        class="control-label password"
                        ><?php echo lang('user-field-password'); ?></label>
                    <div class="controls">
                        <input id="user-form-password" name="password"
                            type="password"
                            value="<?php echo set_value('password'); ?>"
                            class="password"
                            >
                    </div>
                </div>
                <div class="control-group">
                    <label for="user-form-password_conf"
                        class="control-label password"
                        ><?php echo lang('user-field-password_conf'); ?></label>
                    <div class="controls">
                        <input id="user-form-password_conf" name="password_conf"
                            type="password"
                            value="<?php echo set_value('password_conf'); ?>"
                            class="password"
                            >
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row-fluid">
        <fieldset class="form-actions">
            <input id="user-form-save"
                type="submit"
                value="<?php echo lang('form-btn-save'); ?>"
                class="submit btn btn-primary btn-large"
                >
            <input id="user-form-reset"
                type="reset"
                value="<?php echo lang('form-btn-reset'); ?>"
                class="reset btn"
                >
        </fieldset>
    </div>
</form>
