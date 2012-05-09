<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>Password reset request from <?php echo config_item('site_title') ?></title>
    </head>
    <body>
        <h1>A password reset request from <?php echo config_item('site_title') ?>:</h1>
        <p>At <?php echo local_pubdate($code->created_at); ?> you requested to reset your password. To reset your password, please click on the link below.</p>
        <quote>
            <?php echo site_url('login/reset/' . $code->code); ?>
        </quote>
    </body>
</html>
