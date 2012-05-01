<section id="admin-users-index">
    <header>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/users'); ?>"><?php echo lang('users-admin-title'); ?></a>
            </li>
        </ul>
    </header>
    <div class="section-content">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th class="pull-right">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?php echo $u->username; ?></td>
                    <td><?php echo $u->email; ?></td>
                    <td><?php echo local_date_format($u->created_at, 'Y-m-d'); ?></td>
                    <td>
                        <div class="btn-group pull-right">
                            <a href="<?php echo site_url('admin/users/edit/'.$u->id); ?>" class="btn"><i class="icon-edit"></i>&nbsp;Edit</a>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="icon-repeat"></i>&nbsp;Reset Password</a></li>
                                <li><a href="#"><i class="icon-remove"></i>&nbsp;Deactivate</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <footer>
        <a class="btn" href="<?php echo site_url('admin/users/edit'); ?>"><i class="icon-plus"></i>&nbsp;New User</a>
    </footer>
</section>
