<ul>
<?php foreach ($events as $e): ?>
    <li><?php echo anchor(event_url($e), $e->title); ?></li>
<?php endforeach; ?>
</ul>
