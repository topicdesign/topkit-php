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
        <input value="http://" class="bootstrap-wysihtml5-insert-link-url input-xlarge">
      </div>
      <div class="modal-footer">
        <a class="btn" data-dismiss="modal">Cancel</a>
        <a class="btn btn-primary" data-dismiss="modal">Insert link</a>
      </div>
    </div>
    <a class="btn" data-wysihtml5-command="createLink" title="Link"><i class="icon-share"></i></a>
  </li>
  <li data-wysihtml5-tool="image">
    <div class="bootstrap-wysihtml5-insert-image-modal modal hide fade">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Insert Image</h3>
      </div>
      <div class="modal-body">
        <input value="http://" class="bootstrap-wysihtml5-insert-image-url input-xlarge">
      </div>
      <div class="modal-footer">
        <a class="btn" data-dismiss="modal">Cancel</a>
        <a class="btn btn-primary" data-dismiss="modal">Insert image</a>
      </div>
    </div>
    <a class="btn" data-wysihtml5-command="insertImage" title="Insert image"><i class="icon-picture"></i></a>
  </li>
  <li data-wysihtml5-tool="html" class="pull-right">
    <div class="btn-group">
      <a class="btn" data-wysihtml5-action="change_view" title="Edit HTML"><i class="icon-pencil"></i></a>
    </div>
  </li>
</ul>
