<section id="admin-page-edit" class="page" data-page_id="<?php echo $page->id; ?>">
    <header>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/pages'); ?>"><?php echo lang('page_edit_title'); ?></a>
            </li>
        <?php if ($page->id): ?>
            <li class="active"><span class="divider">/</span><?php echo $page->title; ?></li>
        <?php endif; ?>
        </ul>
    </header>
    <div class="section-content">
        <?php $this->load->view('pages/admin/page_form'); ?>
    </div>
</section>
