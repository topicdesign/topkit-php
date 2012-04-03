<section id="login">
    <?php if (isset($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
        <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <form action="<?php echo site_url('login'); ?>" method="POST" class="well">
        <fieldset>
            <label for="identity" class="text">Identity</label>
                <input type="text" id="identity" name="identity" placeholder="user@example.com" class="text" />
                <p class="help-inline">Your identity can be your <strong>username</strong> or <strong>email address</strong>.</p>
                <br />
            <label for="password" class="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Shhhhh..." class="password" />
                <p class="help-inline">Forgot your password? Request a <a href="<?php echo site_url('forgot_password'); ?>">new password via email</a>.</p>
                <br />
            <label for="remember" class="checkbox">
                <input type="checkbox" id="remember" name="remember" value="TRUE" />Remember this device
            </label>
        </fieldset>
        <fieldset class="buttons">
            <input type="submit" value="Login" class="submit btn btn-primary" />
        </fieldset>
    </form>
</section>
