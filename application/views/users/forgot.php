<section id="forgot">
    <h1>Forgot your password?</h1>
    <form action="<?php echo site_url('login/forgot'); ?>" method="POST" class="well">
        <fieldset>
            <label for="identity" class="text">Identity</label>
                <input type="text" id="identity" name="identity" placeholder="user@example.com" class="text" value="<?php echo set_value('identity'); ?>" />
                <p class="help-inline">Your identity can be your <strong>username</strong> or <strong>email address</strong>.</p>
        </fieldset>
        <fieldset class="form-actions">
            <input type="submit" value="Send reactivation email" class="submit btn btn-primary" />
        </fieldset>
    </form>
</section>
