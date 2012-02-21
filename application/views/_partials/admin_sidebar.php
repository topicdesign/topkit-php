<aside id="sidebar" class="inline_grid first">
	<menu id="modules" type="toolbar">
	    <a href="<?php echo site_url('admin'); ?>" data-role="button">Dashboard</a>
        <?php
        $links = array(
            array(
                'label'         => 'Settings',
                'url'           => site_url('admin/settings'),
                'require'       => array(
                    'setting'   => 'update'
                ),
                'data'          => array(
                    'inactive'      => TRUE
                )
            ),
            array(
                'label'         => 'Events',
                'url'           => site_url('admin/events'),
                'require'       => array(
                    'event'   => 'update'
                ),
                'data'          => array(
                    'inactive'      => TRUE
                )
            ),
            array(
                'label'         => 'Pages',
                'url'           => site_url('admin/pages'),
                'require'       => array(
                    'page'      => 'update'
                ),
                'data'          => array(
                    'inactive'      => TRUE
                )
            ),
            array(
                'label'         => 'Members',
                'url'           => site_url('admin/members'),
                'require'       => array(
                    'user'      => 'manage'
                ),
            ),
            array(
                'label'         => 'Users',
                'url'           => site_url('admin/users'),
                'require'       => array(
                    'user'      => 'manage'
                ),
            ),
        );
        echo get_module_menu($links);
        ?>
	</menu>

</aside>
