<form action="<?php echo current_url(); ?>" method="post" accept-charset="utf-8" class="row-fluid form-inline">
    <fieldset class="span6">
        <div class="control-group">
            <label for="page-form-title" class="control-label text">Title</label>
            <div class="controls">
                <input type="text" name="title" value="<?php echo set_value('title',$page->title); ?>" id="page-form-title" class="text">
            </div>
        </div>
        <div class="control-group">
            <label for="page-form-uri" class="control-label text">URL</label>
            <div class="controls">
                <p class="help-block">Only use alpha-numeric characters, dashes, and underscores. Leave blank to auto-generate based on the title.</p>
                <div class="input-prepend">
                    <span class="add-on"><?php echo base_url(); ?></span>
                    <input type="text" name="uri" value="<?php echo set_value('uri',$page->uri); ?>" id="page-form-uri" class="text">
                </div>
            </div>
        </div>
        <div class="control-group">
            <label for="page-form-body" class="control-label textarea">Body</label>
            <div class="controls">
                <textarea name="body" rows="8" cols="40" id="page-form-body"><?php echo set_value('body', $page->body); ?></textarea>
            </div>
        </div>
    </fieldset>
    <fieldset class="well span4">
        <div class="control-group">
            <label for="page-form-publish" class="text">Publish Date</label>
            <div class="controls">
                <input type="text" name="publish" value="<?php echo set_value('publish',local_date_format($page->published_at, 'Y-m-d')); ?>" id="page-form-publish" class="text" data-role="datepicker">
            </div>
        </div>
        <div class="control-group">
            <label for="page-form-keywords" class="text">Keywords</label>
            <div class="controls">
                <input type="text" name="keywords" value="<?php echo set_value('keywords',$page->keywords); ?>" id="page-form-keywords" class="text">
            </div>
        </div>
        <div class="control-group">
            <label for="page-form-description" class="textarea">Description</label>
            <div class="controls">
                <textarea name="description" rows="8" cols="40" id="page-form-description"><?php echo set_value('description', $page->description); ?></textarea>
            </div>
        </div>
    </fieldset>
    <fieldset class="row form-actions">
        <input type="submit" value="Save" id="page-form-save" class="submit btn btn-primary"> 
    </fieldset>
</form>
