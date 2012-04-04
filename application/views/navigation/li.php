<li class="<?php echo get_nav_class($anchor); ?>">
    <?php echo anchor($anchor['href'], $anchor['label'], $anchor['attr']);
        if ($nested && isset($anchor['children']) && ! empty($anchor['children']))
            $this->load->view('navigation/ul', array('anchors'=>$anchor['children']));
    ?>
</li>
