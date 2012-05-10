<section id="admin-redirects-index">
    <header>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/redirects'); ?>"><?php echo lang('redirects-admin-title'); ?></a>
            </li>
        </ul>
    <?php if (can('create', 'redirect')): ?>
        <a class="btn" href="<?php echo site_url('admin/redirects/edit'); ?>"><i class="icon-plus"></i>&nbsp;New Redirect</a>
    <?php endif; ?>
    </header>
    <div class="section-content">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Request</th>
                    <th>Target</th>
                    <th>Status Code</th>
                <?php if (can('update', 'redirect')): ?>
                    <th class="pull-right">Actions</th>
                <?php endif; ?>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($redirects as $r): ?>
                <tr>
                    <td><?php echo $r->request; ?></td>
                    <td><?php echo $r->target; ?></td>
                    <td><?php echo $r->status_code; ?></td>
                <?php if (can('update', 'redirect')): ?>
                    <td>
                        <div class="btn-group pull-right">
                            <a href="<?php echo site_url('admin/redirects/edit/'.$r->id); ?>" class="btn"><i class="icon-edit"></i>&nbsp;Edit</a>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                            <?php if (can('delete', $r)): ?>
                                <li><a href="#"><i class="icon-remove"></i>&nbsp;Delete</a></li>
                            <?php endif; ?>
                            </ul>
                        </div>
                    </td>
                <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
