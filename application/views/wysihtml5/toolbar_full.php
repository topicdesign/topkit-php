<ul class="wysihtml5-toolbar">
  <li data-wysihtml5-tool="format" class="dropdown format">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
      <i class="icon-font"></i>&nbsp;<span class="current-font">Normal text</span>&nbsp;<b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
      <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p">Normal text</a></li>
      <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1">Heading 1</a></li>
      <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2">Heading 2</a></li>
    </ul>
  </li>
  <li data-wysihtml5-tool="emphasis">
    <div class="btn-group">
      <a class="btn" data-wysihtml5-command="formatInline" data-wysihtml5-command-value="strong" title="CTRL+B">Bold</a>
      <a class="btn" data-wysihtml5-command="formatInline" data-wysihtml5-command-value="em" title="CTRL+I">Italic</a>
    </div>
  </li>
  <li data-wysihtml5-tool="lists">
    <div class="btn-group">
      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Lists"><i class="icon-list"></i></a>
        <ul class="dropdown-menu">
          <li><a data-wysihtml5-command="insertUnorderedList" title="Bulleted List">Bulleted List</a></li>
          <li><a data-wysihtml5-command="insertOrderedList" title="Numbered List">Numbered List</a></li>
          <li class="divider"></li>
          <li><a data-wysihtml5-command="Indent" title="Indent">Indent</a></li>
          <li><a data-wysihtml5-command="Outdent" title="Outdent">Outdent</a></li>
        </ul>
      </div>
  </li>
  <li data-wysihtml5-tool="link">
    <div class="bootstrap-wysihtml5-insert-link-modal modal hide fade">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
          <h3>Insert Link</h3>
        </div>
      <div class="modal-body">
        <label for="insert-link-url">URL:</label>
        <input id="insert-link-url" value="http://" class="bootstrap-wysihtml5-insert-link-url input-xlarge">
        <br />
        <label for="insert-link-text">Link text:</label>
        <input id="insert-link-text" value="" class="bootstrap-wysihtml5-insert-link-text input-xlarge">
      </div>
      <div class="modal-footer">
        <a class="btn" data-dismiss="modal">Cancel</a>
        <a class="btn btn-primary" data-dismiss="modal">Insert link</a>
      </div>
    </div>
    <a class="btn createLink" title="Link"><i class="icon-share"></i></a>
  </li>
    <li data-wysihtml5-tool="image">
        <div class="wysihtml5-insert-image-modal modal hide fade">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Insert Image</h3>
            </div>
            <div class="modal-body form-inline">
                <div class="control-group">
                    <label for="wysihtml5-insert-image-url" class="text">URL</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">http://</span><input id="wysihtml5-insert-image-url" placeholder="example.com/image.jpg" class="input-xlarge">
                        </div>
                        <span>&nbsp;OR&nbsp;</span>
                        <button class="btn wysihtml5-upload-file" data-dismiss="modal"><i class="icon-upload"></i>Upload New</button>
                    </div>
                </div>
                <div class="control-group">
                    <label for="wysihtml5-insert-image-alt" class="text">Alternative Text</label>
                    <div class="controls">
                        <input placeholder="Short text description" id="wysihtml5-insert-image-alt" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label for="wysihtml5-insert-image-width" class="text">Size</label>
                    <div class="controls">
                        <div class="input-append">
                            <input id="wysihtml5-insert-image-width" class="input-mini" placeholder="width"><span class="add-on">px</span>
                        </div>
                        <span>&nbsp;X&nbsp;</span>
                        <div class="input-append">
                            <input id="wysihtml5-insert-image-height" class="input-mini" placeholder="height"><span class="add-on">px</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn" data-dismiss="modal">Cancel</a>
                <a class="btn btn-primary" data-dismiss="modal">Insert image</a>
            </div>
        </div>
        <a class="btn wysihtml5-insertImage" title="Insert image"><i class="icon-picture"></i></a>
    </li>
  <li data-wysihtml5-tool="html" class="pull-right">
    <div class="btn-group">
      <a class="btn" data-wysihtml5-action="change_view" title="Edit HTML"><i class="icon-pencil"></i></a>
    </div>
  </li>
</ul>

<div class="wysihtml5-upload-file-modal modal hide fade">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Upload File</h3>
    </div>
    <div class="modal-body">
        <input type="file" class="file input-file wysihtml5-upload"
            name="userfile"
            data-wysihtml5-target="<?php echo site_url('files/upload'); ?>"
         />
        <hr />
        <p>Browser for previously uploaded files in progress...</p>
    </div>
    <div class="modal-footer">
        <a class="btn" data-dismiss="modal">Cancel</a>
        <a class="btn btn-primary">Upload File</a>
    </div>
</div>
