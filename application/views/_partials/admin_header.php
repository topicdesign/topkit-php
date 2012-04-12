<header id="header" class="navbar">
    <div class="navbar-inner">
        <nav class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a href="<?php echo site_url('admin'); ?>" class="brand"><?php echo config_item('site_title'); ?></a>
            <div class="nav-collapse">
                <ul class="nav pull-right">
                    <li><a href="<?php echo site_url(); ?>"><i class="icon-share icon-white"></i> Public Site</a></li>
                <?php if (logged_in()): ?>
                    <li class="divider-vertical"></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user icon-white"></i>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('admin/account'); ?>">Account Settings</a></li>
                            <li><a href="<?php echo site_url('logout'); ?>"><i class="icon-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
</header>
