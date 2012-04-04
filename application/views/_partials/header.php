<header id="header">
    <h1>
        <a href="<?php echo site_url(); ?>"><?php echo config_item('site_title'); ?></a>
    </h1>
    <?php echo get_nav(); ?>
<?php if (logged_in()): ?>
    <p><a href="<?php echo site_url('logout'); ?>">Log out</a></p>
<?php endif; ?>

</header>
