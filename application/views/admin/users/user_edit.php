<section id="admin-user-edit" class="user" data-user_id="<?php echo $user->id; ?>">
    <header>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/users'); ?>"><?php echo lang('users-admin-title'); ?></a>
            </li>
        <?php if ($user->id): ?>
            <li class="active"><span class="divider">/</span><?php echo $user->username; ?></li>
        <?php endif; ?>
        </ul>
    </header>
    <div class="section-content">
        <?php $this->load->view('admin/users/user_form'); ?>
    </div>
</section>
