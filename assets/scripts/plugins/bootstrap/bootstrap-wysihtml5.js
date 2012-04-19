;(function($, wysi) {
  "use strict";
  
  var templates = {
    'format':[
        '<li class="dropdown format">'
          , '<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">'
            , '<i class="icon-font"></i>&nbsp;<span class="current-font">Normal text</span>&nbsp;<b class="caret"></b>'
          , '</a>'
          , '<ul class="dropdown-menu">'
            , '<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p">Normal text</a></li>'
            , '<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1">Heading 1</a></li>'
            , '<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2">Heading 2</a></li>'
          , '</ul>'
        , '</li>'].join('\n')
    , 'emphasis':
        '<li>'
          + '<div class="btn-group">' 
            + '<a class="btn" data-wysihtml5-command="bold" title="CTRL+B">Bold</a>' 
            + '<a class="btn" data-wysihtml5-command="italic" title="CTRL+I">Italic</a>' 
          + '</div>' 
        + '</li>'
    , 'lists':
        '<li>' 
          + '<div class="btn-group">' 
            + '<a class="btn dropdown-toggle" data-toggle="dropdown" title="Lists"><i class="icon-list"></i></a>' 
              + '<ul class="dropdown-menu">'
                + '<li><a data-wysihtml5-command="insertUnorderedList" title="Bulleted List">Bulleted List</a></li>' 
                + '<li><a data-wysihtml5-command="insertOrderedList" title="Numbered List">Numbered List</a></li>' 
                + '<li class="divider"></li>'
                + '<li><a data-wysihtml5-command="Indent" title="Indent">Indent</a></li>' 
                + '<li><a data-wysihtml5-command="Outdent" title="Outdent">Outdent</a></li>'                    
              + '</ul>' 
            + '</div>' 
          + '</li>'
    , 'link':
        '<li>' 
          + '<div class="bootstrap-wysihtml5-insert-link-modal modal hide fade">'
          + '<div class="modal-header">'
            + '<a class="close" data-dismiss="modal">×</a>'
              + '<h3>Insert Link</h3>'
            + '</div>'
            + '<div class="modal-body">'
              + '<input value="http://" class="bootstrap-wysihtml5-insert-link-url input-xlarge">'
            + '</div>'
            + '<div class="modal-footer">'
              + '<a class="btn" data-dismiss="modal">Cancel</a>'
              + '<a class="btn btn-primary" data-dismiss="modal">Insert link</a>'
            + '</div>'
          + '</div>'
          + '<a class="btn" data-wysihtml5-command="createLink" title="Link"><i class="icon-share"></i></a>' 
        + '</li>'
    , 'image':
        '<li>' 
          + '<div class="bootstrap-wysihtml5-insert-image-modal modal hide fade">'
            + '<div class="modal-header">'
              + '<a class="close" data-dismiss="modal">×</a>'
              + '<h3>Insert Image</h3>'
            + '</div>'
            + '<div class="modal-body">'
              + '<input value="http://" class="bootstrap-wysihtml5-insert-image-url input-xlarge">'
            + '</div>'
            + '<div class="modal-footer">'
              + '<a class="btn" data-dismiss="modal">Cancel</a>'
              + '<a class="btn btn-primary" data-dismiss="modal">Insert image</a>'
            + '</div>'
          + '</div>'
          + '<a class="btn" data-wysihtml5-command="insertImage" title="Insert image"><i class="icon-picture"></i></a>' 
        + '</li>'
    , 'html': 
        '<li class="pull-right">'
          + '<div class="btn-group">'
            + '<a class="btn" data-wysihtml5-action="change_view" title="Edit HTML"><i class="icon-pencil"></i></a>' 
          + '</div>'
        + '</li>'
  };

  // --------------------------------------------------------------------  

  var defaults = {
      "format"    : true
    , "emphasis"  : true
    , "lists"     : true
    , "link"      : true
    , "image"     : true
    , "html"      : true
    , events      : {}
    , parserRules : {
        tags: {
            "b"    : {}
          , "p"    : {}
          , "abbr" : {}
          , "i"    : {}
          , "br"   : {}
          , "ol"   : {}
          , "ul"   : {}
          , "li"   : {}
          , "h1"   : {}
          , "h2"   : {}
          , "img"  : {
            "check_attributes": {
                "width"  : "numbers"
              , "alt"    : "alt"
              , "src"    : "url"
              , "height" : "numbers"
            }
          }
          , "a"    : {
              set_attributes: {
                  target : "_blank"
                , rel    : "nofollow"
              }
            , check_attributes: {
                  href:   "url" // important to avoid XSS
              }
            }
        }
      }
  };

  // --------------------------------------------------------------------

  var Wysihtml5 = function(el, options) {
    this.el = el;
    this.toolbar = this.createToolbar(el, options || defaults);
    this.editor =  this.createEditor(options);
    
    window.editor = this.editor;

      $('iframe.wysihtml5-sandbox').each(function(i, el){
      $(el.contentWindow).off('focus.wysihtml5').on({
        'focus.wysihtml5' : function(){
           $('li.dropdown').removeClass('open');
         }
      });
    });
  };

  // --------------------------------------------------------------------

  Wysihtml5.prototype = {
    constructor: Wysihtml5,
    
    // --------------------------------------------------------------------
    
    createEditor: function(options) {
      var parserRules = defaults.parserRules; 

      if(options && options.parserRules) {
        parserRules = options.parserRules;
      }
        
      var editor = new wysi.Editor(this.el.attr('id'), {
          toolbar: this.toolbar.attr('id')
        , parserRules: parserRules
      });

        if(options && options.events) {
        for(var eventName in options.events) {
          editor.on(eventName, options.events[eventName]);
        }
      } 

        return editor;
    },
    
    // --------------------------------------------------------------------
    
    createToolbar: function(el, options) {
      var self = this;
      var toolbar = $("<ul/>", {
          'id'    : el.attr('id') + "-wysihtml5-toolbar"
        , 'class' : "wysihtml5-toolbar"
        , 'style' : "display:none"
      });

      for(var key in defaults) {
        var value = false;
        
        if(options[key] != undefined) {
          if(options[key] == true) {
            value = true;
          }
        } else {
          value = defaults[key];
        }
        
        if(value == true) {
          toolbar.append(templates[key]);
          var method = 'init_'+key;
          if (this[method]) this[method](toolbar);
        }
      }

      // update format dropdown text to current format
      toolbar.find("li.format a[data-wysihtml5-command='formatBlock']").click(function(e) {
        var el = $(e.srcElement);
        self.toolbar.find('li.format .current-font').text(el.html())
      });
      
      this.el.before(toolbar);

      //var src_switcher =
        //'<div class="tabbable tabs-below"><ul class="nav nav-tabs">'
        //+   '<li class="active"><a data-toggle="tab">Editor</a></li>'
        //+   '<li><a data-toggle="tab">Source</a></li>'
        //+ '</ul><div>'
      //this.el.after(src_switcher); 
      return toolbar;
    },
    
    // --------------------------------------------------------------------
    // toolbar button init methods

    init_html: function(toolbar) {
      var changeViewSelector = "a[data-wysihtml5-action='change_view']";
      toolbar.find(changeViewSelector).click(function(e) {
        toolbar.find('a.btn').not(changeViewSelector).toggleClass('disabled');
      });
    },
    
    // --------------------------------------------------------------------
    
    init_image: function(toolbar) {
      var self = this;
      var insertImageModal = toolbar.find('.bootstrap-wysihtml5-insert-image-modal');
      var urlInput = insertImageModal.find('.bootstrap-wysihtml5-insert-image-url');
      var insertButton = insertImageModal.find('a.btn-primary');
      var initialValue = urlInput.val();

      var insertImage = function() { 
        var url = urlInput.val();
        urlInput.val(initialValue);
        self.editor.composer.commands.exec("insertImage", url);
      };
      
      urlInput.keypress(function(e) {
        if(e.which == 13) {
          insertImage();
          insertImageModal.modal('hide');
        }
      });

      insertButton.click(insertImage);

      insertImageModal.on('shown', function() {
        urlInput.focus();
      });

      insertImageModal.on('hide', function() { 
        self.editor.currentView.element.focus();
      });

      toolbar.find('a[data-wysihtml5-command=insertImage]').click(function() {
        insertImageModal.modal('show');
      });
    },
    
    // --------------------------------------------------------------------
    
    init_link: function(toolbar) {
      var self = this;
      var insertLinkModal = toolbar.find('.bootstrap-wysihtml5-insert-link-modal');
      var urlInput = insertLinkModal.find('.bootstrap-wysihtml5-insert-link-url');
      var insertButton = insertLinkModal.find('a.btn-primary');
      var initialValue = urlInput.val();

      var insertLink = function() { 
        var url = urlInput.val();
        urlInput.val(initialValue);
        self.editor.composer.commands.exec("createLink", { 
          href: url, 
          target: "_blank", 
          rel: "nofollow" 
        });
      };
      var pressedEnter = false;

      urlInput.keypress(function(e) {
        if(e.which == 13) {
          insertLink();
          insertLinkModal.modal('hide');
        }
      });

      insertButton.click(insertLink);

      insertLinkModal.on('shown', function() {
        urlInput.focus();
      });

      insertLinkModal.on('hide', function() { 
        self.editor.currentView.element.focus();
      });

      toolbar.find('a[data-wysihtml5-command=createLink]').click(function() {
        insertLinkModal.modal('show');
      });
    }
    
    // --------------------------------------------------------------------
    
  };

  // --------------------------------------------------------------------
  // jQuery plugin
  $.fn.wysihtml5 = function (options) {
    return this.each(function () {
      var $this = $(this);
          $this.data('wysihtml5', new Wysihtml5($this, options));
      })
    };

    $.fn.wysihtml5.Constructor = Wysihtml5;

}(window.jQuery, window.wysihtml5));



;(function($, wysi){
  var btn_templates = {
    'format':
        '<li class="dropdown format">'
          + '<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">'
            + '<i class="icon-font"></i>&nbsp;<span class="current-font">Normal text</span>&nbsp;<b class="caret"></b>'
          + '</a>'
          + '<ul class="dropdown-menu">'
            + '<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p">Normal text</a></li>'
            + '<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1">Heading 1</a></li>'
            + '<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2">Heading 2</a></li>'
          + '</ul>'
        + '</li>'
    , 'emphasis':
        '<li>'
          + '<div class="btn-group">' 
            + '<a class="btn" data-wysihtml5-command="bold" title="CTRL+B">Bold</a>' 
            + '<a class="btn" data-wysihtml5-command="italic" title="CTRL+I">Italic</a>' 
          + '</div>' 
        + '</li>'
    , 'lists':
        '<li>' 
          + '<div class="btn-group">' 
            + '<a class="btn dropdown-toggle" data-toggle="dropdown" title="Lists"><i class="icon-list"></i></a>' 
              + '<ul class="dropdown-menu">'
                + '<li><a data-wysihtml5-command="insertUnorderedList" title="Bulleted List">Bulleted List</a></li>' 
                + '<li><a data-wysihtml5-command="insertOrderedList" title="Numbered List">Numbered List</a></li>' 
                + '<li class="divider"></li>'
                + '<li><a data-wysihtml5-command="Indent" title="Indent">Indent</a></li>' 
                + '<li><a data-wysihtml5-command="Outdent" title="Outdent">Outdent</a></li>'                    
              + '</ul>' 
            + '</div>' 
          + '</li>'
    , 'link':
        '<li>' 
          + '<div class="bootstrap-wysihtml5-insert-link-modal modal hide fade">'
          + '<div class="modal-header">'
            + '<a class="close" data-dismiss="modal">×</a>'
              + '<h3>Insert Link</h3>'
            + '</div>'
            + '<div class="modal-body">'
              + '<input value="http://" class="bootstrap-wysihtml5-insert-link-url input-xlarge">'
            + '</div>'
            + '<div class="modal-footer">'
              + '<a class="btn" data-dismiss="modal">Cancel</a>'
              + '<a class="btn btn-primary" data-dismiss="modal">Insert link</a>'
            + '</div>'
          + '</div>'
          + '<a class="btn" data-wysihtml5-command="createLink" title="Link"><i class="icon-share"></i></a>' 
        + '</li>'
    , 'image':
        '<li>' 
          + '<div class="bootstrap-wysihtml5-insert-image-modal modal hide fade">'
            + '<div class="modal-header">'
              + '<a class="close" data-dismiss="modal">×</a>'
              + '<h3>Insert Image</h3>'
            + '</div>'
            + '<div class="modal-body">'
              + '<input value="http://" class="bootstrap-wysihtml5-insert-image-url input-xlarge">'
            + '</div>'
            + '<div class="modal-footer">'
              + '<a class="btn" data-dismiss="modal">Cancel</a>'
              + '<a class="btn btn-primary" data-dismiss="modal">Insert image</a>'
            + '</div>'
          + '</div>'
          + '<a class="btn" data-wysihtml5-command="insertImage" title="Insert image"><i class="icon-picture"></i></a>' 
        + '</li>'
    , 'html': 
        '<li class="pull-right">'
          + '<div class="btn-group">'
            + '<a class="btn" data-wysihtml5-action="change_view" title="Edit HTML"><i class="icon-pencil"></i></a>' 
          + '</div>'
        + '</li>'
  };
  var wysihtml5_defaults = {
    // Give the editor a name, the name will also be set as class name on the iframe and on the iframe's body
      name:                 null
    // Whether the editor should look like the textarea (by adopting styles)
    , style:                true
    // Id of the toolbar element, pass falsey value if you don't want any toolbar logic
    , toolbar:              null
    // Whether urls, entered by the user should automatically become clickable-links
    , autoLink:             true
    // Object which includes parser rules (set this to examples/rules/spec.json or your own spec, otherwise only span tags are allowed!)
    , parserRules:          null
    // Parser method to use when the user inserts content via copy & paste
    , parser:               wysihtml5.dom.parse || Prototype.K
    // Class name which should be set on the contentEditable element in the created sandbox iframe, can be styled via the 'stylesheets' option
    , composerClassName:    "wysihtml5-editor"
    // Class name to add to the body when the wysihtml5 editor is supported
    , bodyClassName:        "wysihtml5-supported"
    // Array (or single string) of stylesheet urls to be loaded in the editor's iframe
    , stylesheets:          []
    // Placeholder text to use, defaults to the placeholder attribute on the textarea element
    , placeholderText:      null
    // Whether the composer should allow the user to manually resize images, tables etc.
    , allowObjectResizing:  true
    // Whether the rich text editor should be rendered on touch devices (wysihtml5 >= 0.3.0 comes with basic support for iOS 5)
    , supportTouchDevices:  true
  };
  var methods = {
    // --------------------------------------------------------------------
    // init properties
    init: function(opts){
      var opts = $.extend(true, {
            btn_templates: btn_templates
          , toolbar_btns: ['format','emphasis','lists','link','image']
        }, wysihtml5_defaults, opts)
        ;
      return this.each(function(){
        var $this = $(this)
          , data = $this.data('editor')
        ;
        if ( ! data) {
          // init data object
          $this.data('editor', {});
          // convert wysihtml5 opts
          var wysi_opts = {};
          for (i in wysihtml5_defaults) {
            wysi_opts[i] = opts[i];
          };
          methods.init_toolbar.apply(this, [
              opts.toolbar_btns
            , opts.btn_templates
          ]);
          methods.init_editor.apply(this, [wysi_opts]);
        };
      });
    }
    // --------------------------------------------------------------------
    // initialize toolbar markup
    , init_toolbar: function(btns, tmpls){
      var $this = $(this)
        , data = $this.data('editor')
        , toolbar_wrapper = $("<ul/>", {
          'id'    : $this.attr('id') + "-wysihtml5-toolbar"
        , 'class' : "wysihtml5-toolbar"
        //, 'style' : "display:none"
      });
      for (var i=0, j=btns.length; i < j; i++) {
        var btn_tmpl = tmpls[btns[i]];
        toolbar_wrapper.append(btn_tmpl);
      };
      $this.before(toolbar_wrapper);
      data.toolbar = toolbar_wrapper;
    }
    // --------------------------------------------------------------------
    , init_editor: function(opts){
      var $this = $(this)
        , data = $this.data('editor')
        ;
      opts.toolbar = data.toolbar.attr('id');
      data.editor = new wysi.Editor($this.attr('id'), opts);
    } 
    // --------------------------------------------------------------------
  }; 
  // --------------------------------------------------------------------
  // init jQuery.editor plugin
  $.fn.editor = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'object' || ! method) {
      return methods.init.apply(this, arguments);
    } else {
      $.error('Method ' +  method + ' does not exist on jQuery.editor');
    }
  };
  // --------------------------------------------------------------------
})(jQuery, wysihtml5);

