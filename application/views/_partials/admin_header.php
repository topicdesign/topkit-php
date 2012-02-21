<header id="header">

	<section id="site_information">
		<h1><a href="<?php echo site_url('admin'); ?>"><?php echo config_item('site_title'); ?></a></h1>
		<p class="description"><?php echo config_item('site_description'); ?></p>
	</section>
    
    
    <aside id="account">
      <span data-role="controlgroup">
    		<a href="<?php echo site_url('admin/account'); ?>" data-role="button" data-icon="person">Account</a>
    		<a href="<?php echo site_url(); ?>" data-role="button">Public Site</a>
      		<a href="<?php echo site_url('logout'); ?>" data-role="button">Log Out</a>
      </span>
	</aside>
    
</header>
