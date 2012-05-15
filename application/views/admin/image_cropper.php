<section id="admin-image-cropper">
    <header>
        <ul class="breadcrumb">
            <li>
                <?php echo lang('image_cropper_title'); ?>
            </li>
        </ul>
    </header>
    <div class="section-content">
        <form action="<?php echo site_url(uri_string()); ?>" method="post">
        <?php foreach ($sizes as $size): ?>
            <fieldset>
                <h2><?php echo $size['label']; ?></h2>
                <img src="<?php echo site_url('assets/uploads/'.$file_name); ?>" 
                    alt="" 
                    class="crop" 
                    data-ratio="<?php echo $size['width'] / $size['height']; ?>" 
                    data-name="<?php echo $size['label']; ?>" 
                    />
                <p class="instructions"><?php echo $size['instructions']; ?></p>
                <input type="hidden" name="<?php echo $size['label']; ?>" class="dimensions" />
            </fieldset>
        <?php endforeach; ?>
            <fieldset>
                <input type="submit" value="Submit" />
            </fieldset>
        </form>
    </div>
</section>
