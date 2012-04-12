<aside id="sidebar" class="span2">
<?php if ( ! logged_in()): ?>
    <p>Authenticate to access the administration tools.</p>
<?php else: 
        echo get_nav('admin_sidebar', TRUE, 'admin_sidebar');
      endif; ?>
</aside>
