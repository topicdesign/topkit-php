<header id="header" class="navbar">

    <div class="navbar-inner">

        <nav class="container">

            <h1><a href="<?php echo site_url('admin'); ?>" class="brand"><?php echo config_item('site_title'); ?></a></h1>
            
            <ul class="nav pull-right">
                <li><a href="<?php echo site_url(); ?>"><i class="icon-share icon-white"></i> Public Site</a></li>
                <li class="divider-vertical"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('admin/account'); ?>">Account Settings</a></li>
                        <li><a href="<?php echo site_url('logout'); ?>"><i class="icon-off"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>

        </nav>

    </div>
    
</header>
