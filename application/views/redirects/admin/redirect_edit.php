<section id="admin-redirect-edit" class="redirect" data-redirect_id="<?php echo $redirect->id; ?>">
    <header>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/redirects'); ?>"><?php echo lang('redirects-admin-title'); ?></a>
            </li>
        <?php if ($redirect->id): ?>
            <li class="active"><span class="divider">/</span><?php echo $redirect->request; ?></li>
        <?php endif; ?>
        </ul>
    </header>
    <div class="section-content">
        <?php $this->load->view('redirects/admin/redirect_form'); ?>
    </div>
</section>
