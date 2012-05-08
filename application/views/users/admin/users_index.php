<section id="admin-users-index">
    <header>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/users'); ?>"><?php echo lang('users-admin-title'); ?></a>
            </li>
        </ul>
    <?php if (can('create', 'user')): ?>
        <a class="btn" href="<?php echo site_url('admin/users/edit'); ?>"><i class="icon-plus"></i>&nbsp;New User</a>
    <?php endif; ?>
    </header>
    <div class="section-content">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created</th>
                <?php if (can('update', 'user')): ?>
                    <th class="pull-right">Actions</th>
                <?php endif; ?>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?php echo $u->username; ?></td>
                    <td><?php echo $u->email; ?></td>
                    <td><?php echo local_date_format($u->created_at, 'Y-m-d'); ?></td>
                <?php if (can('update', 'user')): ?>
                    <td>
                        <div class="btn-group pull-right">
                            <a href="<?php echo site_url('admin/users/edit/'.$u->id); ?>" class="btn"><i class="icon-edit"></i>&nbsp;Edit</a>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="icon-repeat"></i>&nbsp;Reset Password</a></li>
                            <?php if (can('delete', $u)): ?>
                                <li><a href="#"><i class="icon-remove"></i>&nbsp;Deactivate</a></li>
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
