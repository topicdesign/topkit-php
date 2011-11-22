<div id="login">
    
    <?php if (isset($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
        <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <form action="<?php echo site_url('login'); ?>" method="POST">

        <fieldset>
            <label for="username">Username/Email</label>
                <input type="text" id="username" name="username" />
                <br />
            <label for="password">Password</label>
                <input type="password" id="password" name="password" />
                <br />
            <label for="remember">Remember</label>
                <input type="checkbox" id="remember" name="remember" value="remember" />
        </fieldset>
        <fieldset>
            <input type="submit" value="Login" />
        </fieldset>

    </form>

</div>
