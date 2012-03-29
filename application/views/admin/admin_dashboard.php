<section id="admin-dashboard">
    <header>
        <h1>Dashboard</h1>
    </header>
    <div class="section-content">
        <ul class="unstyled">
            <li id="dashboard-analytics">
                <a href="http://www.google.com/analytics/" data-role="button" rel="external"><?php echo lang('dashboard_analytics') ?></a>
            </li>
            <li id="dashboard-event">
                <a href="<?php echo site_url('admin/events/edit'); ?>" data-role="button"><?php echo lang('dashboard_event') ?></a>
            </li>
            <li id="dashboard-artist">
                <a href="<?php echo site_url('admin/arts/edit'); ?>" data-role="button" data-inactive="1"><?php echo lang('dashboard_artist') ?></a>
            </li>
            <li id="dashboard-user">
                <a href="<?php echo site_url('admin/users/edit'); ?>" data-role="button"><?php echo lang('dashboard_user') ?></a>
            </li>
        </ul>
    </div>
</section>
