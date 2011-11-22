<header id="header">

    <h1><a href="<?php echo site_url(); ?>"><?php echo config_item('site_title'); ?></a></h1>

    <nav>
        <ul>
            <li class="selected"><a href="<?php echo site_url(); ?>">Home</a></li>
        </ul>
    </nav>
    
    <?php if (logged_in()): ?>
    <p><a href="<?php echo site_url('logout'); ?>">Log out</a></p>
    <?php endif; ?>

</header>
