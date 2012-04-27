<form action="<?php echo current_url(); ?>" method="post" class="form-inline" accept-charset="utf-8">
    <div class="row-fluid">
        <div class="span8">
            <fieldset>
                <div class="control-group">
                    <label for="page-form-title" class="control-label text"><?php echo lang('page-field-title'); ?></label>
                    <div class="controls">
                        <input id="page-form-title" name="title"
                            type="text"
                            value="<?php echo set_value('title',$page->title); ?>"
                            class="text"
                            >
                    </div>
                </div>
                <div class="control-group">
                    <label for="page-form-uri" class="control-label text"><?php echo lang('page-field-uri'); ?></label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><?php echo base_url(); ?></span><input id="page-form-uri" name="uri"
                                type="text"
                                value="<?php echo set_value('uri',$page->uri); ?>" 
                                class="text"
                                >
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="page-form-body" class="control-label textarea"><?php echo lang('page-field-body'); ?></label>
                    <div class="controls">
                        <?php $this->load->view('wysihtml5/toolbar_full'); ?>
                        <textarea id="page-form-body" name="body"
                            rows="16" cols="80"
                            data-role="editor"
                            style="width:100%"
                            ><?php echo set_value('body', $page->body); ?></textarea>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="span4">
            <fieldset class="well">
                <div class="control-group btn-toolbar">
                    <label for="page-form-publish" class="text"><?php echo lang('page-field-published_at'); ?></label>
                    <?php if ( ! $page->published_at || $page->published_at > date_create()): ?>
                    <div class="controls">
                        <input id="page-form-publish" name="publish-date"
                            type="text"
                            value="<?php echo set_value('publish-date',local_date_format($page->published_at, 'Y/m/d')); ?>"
                            class="text input-small"
                            data-role="datepicker"
                            >
                        <input id="page-form-publish-time" name="publish-time"
                            type="text"
                            value="<?php echo set_value('publish-time',local_date_format($page->published_at, 'g:i A')); ?>"
                            class="text input-mini"
                            data-role="timepicker"
                            >
                    </div>
                    <?php else: ?>
                    <p>Published on <?php echo local_date_format($page->published_at, 'Y/m/d g:i A'); ?></p>
                    <?php endif; ?>
                </div>
                <hr/>
                <div class="control-group">
                    <label for="page-form-keywords" class="text"><?php echo lang('page-field-keywords'); ?></label>
                    <div class="controls">
                        <input id="page-form-keywords" name="keywords"
                            type="text"
                            value="<?php echo set_value('keywords',$page->keywords); ?>"
                            class="text"
                            data-role="tagcomplete" 
                            data-source="[&quot;Cats&quot;,&quot;Dogs&quot;,&quot;Mass Hysteria&quot;]"
                            >
                    </div>
                </div>
                <hr/>
                <div class="control-group">
                    <label for="page-form-description" class="textarea"><?php echo lang('page-field-description'); ?></label>
                    <div class="controls">
                        <textarea id="page-form-description" name="description"
                            rows="8" cols="40"
                            style="width:100%"
                            ><?php echo set_value('description', $page->description); ?></textarea>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <fieldset class="form-actions">
            <input id="page-form-save"
                type="submit"
                value="<?php echo lang('form-btn-save'); ?>"
                class="submit btn btn-primary btn-large"
                >
            <input id="page-form-reset"
                type="reset"
                value="<?php echo lang('form-btn-reset'); ?>"
                class="reset btn"
                >
        </fieldset>
    </div>
</form>
