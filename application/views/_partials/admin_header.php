<header id="header" class="navbar">

    <div class="navbar-inner">

        <div class="container">

            <a href="<?php echo site_url('admin'); ?>" class="brand"><?php echo config_item('site_title'); ?></a>
            
            <ul class="nav pull-right">
                  <li><a href="<?php echo site_url('admin/account'); ?>"><i class="icon-user icon-white"></i></a></li>
                  <li><a href="<?php echo site_url(); ?>"><i class="icon-share icon-white"></i> Public Site</a></li>
                  <li><a href="<?php echo site_url('logout'); ?>"><i class="icon-off icon-white"></i> Log Out</a></li>
            </ul>

        </div>

    </div>
    
</header>
