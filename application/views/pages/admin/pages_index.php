<section id="admin-pages-index">
    <header>
        <h1>Pages</h1>
    </header>
    <div class="section-content">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>URI</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($pages as $p): ?>
                <tr>
                    <td><?php echo $p->uri; ?></td>
                    <td><?php echo $p->title; ?></td>
                    <td><?php echo $p->description; ?></td>
                    <td><?php echo local_pubdate($p->updated_at, 'Y-m-d'); ?></td>
                    <td>
                        <div class="btn-group pull-right">
                            <a href="#" class="btn"><i class="icon-edit"></i>Edit</a>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="icon-check"></i>Preview</a></li>
                                <li><a href="#"><i class="icon-trash"></i>Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
