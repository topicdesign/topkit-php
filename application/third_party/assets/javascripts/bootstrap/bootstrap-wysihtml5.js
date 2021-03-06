;(function($, wysi){
  var parserRules = {
      classes: {}
    , tags: {
      "tr": {
        "add_class": {
          "align": "align_text"
        }
      },
      "strike": {
      },
      "form": {
        "rename_tag": "div"
      },
      "rt": {
        "rename_tag": "span"
      },
      "code": {},
      "acronym": {
        "rename_tag": "span"
      },
      "br": {
        "add_class": {
          "clear": "clear_br"
        }
      },
      "details": {
        "rename_tag": "div"
      },
      "h4": {
        "add_class": {
          "align": "align_text"
        }
      },
      "em": {},
      "title": {
      },
      "multicol": {
        "rename_tag": "div"
      },
      "figure": {
        "rename_tag": "div"
      },
      "xmp": {
        "rename_tag": "span"
      },
      "small": {
        "rename_tag": "span",
        "set_class": "wysiwyg-font-size-smaller"
      },
      "area": {
      },
      "time": {
        "rename_tag": "span"
      },
      "dir": {
        "rename_tag": "ul"
      },
      "bdi": {
        "rename_tag": "span"
      },
      "command": {
      },
      "ul": {},
      "progress": {
        "rename_tag": "span"
      },
      "dfn": {
        "rename_tag": "span"
      },
      "iframe": {
      },
      "figcaption": {
        "rename_tag": "div"
      },
      "a": {
        "check_attributes": {
          "href": "url"
        }
      },
      "img": {
        "check_attributes": {
          "width": "numbers",
          "alt": "alt",
          "src": "url",
          "height": "numbers"
        },
        "add_class": {
          "align": "align_img"
        }
      },
      "rb": {
        "rename_tag": "span"
      },
      "footer": {
        "rename_tag": "div"
      },
      "noframes": {
      },
      "abbr": {
        "rename_tag": "span"
      },
      "u": {},
      "bgsound": {
      },
      "sup": {
        "rename_tag": "span"
      },
      "address": {
        "rename_tag": "div"
      },
      "basefont": {
      },
      "nav": {
        "rename_tag": "div"
      },
      "h1": {
        "add_class": {
          "align": "align_text"
        }
      },
      "head": {
      },
      "tbody": {
        "add_class": {
          "align": "align_text"
        }
      },
      "dd": {
        "rename_tag": "div"
      },
      "s": {
        "rename_tag": "span"
      },
      "li": {},
      "td": {
        "check_attributes": {
          "rowspan": "numbers",
          "colspan": "numbers"
        },
        "add_class": {
          "align": "align_text"
        }
      },
      "object": {
      },
      "div": {
        "add_class": {
          "align": "align_text"
        }
      },
      "option": {
        "rename_tag": "span"
      },
      "select": {
        "rename_tag": "span"
      },
      "i": {
        "rename_tag": "em"
      },
      "track": {
      },
      "wbr": {
      },
      "fieldset": {
        "rename_tag": "div"
      },
      "big": {
        "rename_tag": "span",
        "set_class": "wysiwyg-font-size-larger"
      },
      "button": {
        "rename_tag": "span"
      },
      "noscript": {
      },
      "svg": {
      },
      "input": {
      },
      "table": {},
      "keygen": {
      },
      "h5": {
        "add_class": {
          "align": "align_text"
        }
      },
      "meta": {
      },
      "map": {
        "rename_tag": "div"
      },
      "isindex": {
      },
      "mark": {
        "rename_tag": "span"
      },
      "caption": {
        "add_class": {
          "align": "align_text"
        }
      },
      "tfoot": {
        "add_class": {
          "align": "align_text"
        }
      },
      "base": {
      },
      "video": {
      },
      "strong": {},
      "canvas": {
      },
      "output": {
        "rename_tag": "span"
      },
      "marquee": {
        "rename_tag": "span"
      },
      "b": {
        "rename_tag": "strong"
      },
      "q": {
        "check_attributes": {
          "cite": "url"
        }
      },
      "applet": {
      },
      "span": {},
      "rp": {
        "rename_tag": "span"
      },
      "spacer": {
      },
      "source": {
      },
      "aside": {
        "rename_tag": "div"
      },
      "frame": {
      },
      "section": {
        "rename_tag": "div"
      },
      "body": {
        "rename_tag": "div"
      },
      "ol": {},
      "nobr": {
        "rename_tag": "span"
      },
      "html": {
        "rename_tag": "div"
      },
      "summary": {
        "rename_tag": "span"
      },
      "var": {
        "rename_tag": "span"
      },
      "del": {
      },
      "blockquote": {
        "check_attributes": {
          "cite": "url"
        }
      },
      "style": {
      },
      "device": {
      },
      "meter": {
        "rename_tag": "span"
      },
      "h3": {
        "add_class": {
          "align": "align_text"
        }
      },
      "textarea": {
        "rename_tag": "span"
      },
      "embed": {
      },
      "hgroup": {
        "rename_tag": "div"
      },
      "font": {
        "rename_tag": "span",
        "add_class": {
          "size": "size_font"
        }
      },
      "tt": {
        "rename_tag": "span"
      },
      "noembed": {
      },
      "thead": {
        "add_class": {
          "align": "align_text"
        }
      },
      "blink": {
        "rename_tag": "span"
      },
      "plaintext": {
        "rename_tag": "span"
      },
      "xml": {
      },
      "h6": {
        "add_class": {
          "align": "align_text"
        }
      },
      "param": {
      },
      "th": {
        "check_attributes": {
          "rowspan": "numbers",
          "colspan": "numbers"
        },
        "add_class": {
          "align": "align_text"
        }
      },
      "legend": {
        "rename_tag": "span"
      },
      "hr": {},
      "label": {
        "rename_tag": "span"
      },
      "dl": {
        "rename_tag": "div"
      },
      "kbd": {
        "rename_tag": "span"
      },
      "listing": {
        "rename_tag": "div"
      },
      "dt": {
        "rename_tag": "span"
      },
      "nextid": {
      },
      "pre": {},
      "center": {
        "rename_tag": "div",
        "set_class": "wysiwyg-text-align-center"
      },
      "audio": {
      },
      "datalist": {
        "rename_tag": "span"
      },
      "samp": {
        "rename_tag": "span"
      },
      "col": {
      },
      "article": {
        "rename_tag": "div"
      },
      "cite": {},
      "link": {
      },
      "script": {
      },
      "bdo": {
        "rename_tag": "span"
      },
      "menu": {
        "rename_tag": "ul"
      },
      "colgroup": {
      },
      "ruby": {
        "rename_tag": "span"
      },
      "h2": {
        "add_class": {
          "align": "align_text"
        }
      },
      "ins": {
        "rename_tag": "span"
      },
      "p": {
        "add_class": {
          "align": "align_text"
        }
      },
      "sub": {
        "rename_tag": "span"
      },
      "comment": {
      },
      "frameset": {
      },
      "optgroup": {
        "rename_tag": "span"
      },
      "header": {
        "rename_tag": "div"
      }
    }
  }; // end parserRules
  var events = {
    focus: function(){
      // ensure starting <p> if empty
      if(this.textareaElement.value === '') {
        var self = this;
        setTimeout(function() {
          self.composer.selection.surround(document.createElement('p'));
          self.stopObserving('focus:composer', events.focus);
        }, 10);
      }
    }
  };
  // --------------------------------------------------------------------
  var wysihtml5_defaults = {
    // https://github.com/xing/wysihtml5/wiki/Configuration
      name:                 null
    , style:                true
    , toolbar:              null
    , autoLink:             true
    , parserRules:          parserRules
    , parser:               wysihtml5.dom.parse || Prototype.K
    , composerClassName:    "wysihtml5-editor"
    , bodyClassName:        "wysihtml5-supported"
    , stylesheets:          []
    , placeholderText:      null
    , allowObtectResizing:  true
    , supportTouchDevices:  true
  }; // end wysihtml5_defaults
  // --------------------------------------------------------------------
  var tool_init = {
    format: function(el){
      var $this = $(this)
        , data  = $this.data('editor')
        , btn   = el.find('a[data-wysihtml5-command="formatBlock"]')
        ;
      // update dropdown label with selected format
      btn.click(function(e){
          $('.current-font', el).text($(e.srcElement).html())
        })
        ;
      // data.editor.on('focus:composer', function(){
        // console.log('focus:composer', this);
      // });
    }
    // --------------------------------------------------------------------
    , source: function(el){
      var $this    = $(this)
        , data     = $this.data('editor')
        , btn    = el.find("a[data-wysihtml5-action='change_view']")
        ;
      // toggle active state of all buttons when viewing source
      btn.click(function(e) {
          $(this).find('i')
            .toggleClass('icon-eye-open icon-eye-close')
            ;
          data.toolbar.find('a.btn')
              .not(btn)
              .toggleClass('disabled')
              ;
        });
    }
    // --------------------------------------------------------------------
    , image: function(el) {
      var $this        = $(this)
        , data         = $this.data('editor')
        , modal        = el.find('.wysihtml5-insert-image-modal')
        , upload_btn   = modal.find('.wysihtml5-upload-file')
        , inputs       = modal.find('input')
        , url_input    = modal.find('#wysihtml5-insert-image-url')
        , alt_input    = modal.find('#wysihtml5-insert-image-alt')
        , width_input  = modal.find('#wysihtml5-insert-image-width')
        , height_input = modal.find('#wysihtml5-insert-image-height')
        , submit_btn   = modal.find('div.modal-footer a.btn-primary')
        , cancel_btns  = modal.find('a[data-dismiss="modal"]')
        ;
      modal.on({
        'shown': function(){
          url_input.focus();
        }
        , 'hide': function(){
          data.editor.currentView.element.focus();
          reset_inputs();
        }
      });
      var insert_image = function(){
        data.editor.composer.commands.exec("insertImage", {
            src    : 'http://' + url_input.val()
          , alt    : alt_input.val()
          , width  : width_input.val()
          , height : height_input.val()
        });
        reset_inputs();
      };
      // set data for restoring input vals
      inputs.each(function(){
        $(this).data('init_val', $(this).val());
        $(this).keypress(function(e){
          if(e.which == 13) { // enter
            insert_image();
            modal.modal('hide');
          }
        });
      });
      var reset_inputs = function(){
        inputs.each(function(){
          $(this).val($(this).data('init_val'));
        });
      }
      // populate modal with object
      var fill_modal = function(file){
        url_input.val(file.url.replace('http://', ''));
        alt_input.val(file.client_name);
        width_input.val(file.image_width);
        height_input.val(file.image_height);
        modal.modal('show');
      };
      // bind buttons
      el.find('a.wysihtml5-insertImage')
        .click(function() {
          if($(this).hasClass('disabled')) return;
          data.editor.currentView.element.focus();
          modal.modal('show');
        })
        ;
      submit_btn.click(insert_image);
      cancel_btns.click(function(){
        reset_inputs();
      });
      // allow for upload/callback
      upload_btn.click(function(e){
        e.preventDefault();
        helpers.upload_file.apply($this,['image', {
            data   : {}
          , events : {
              upload : fill_modal
            , cancel : function(){
              reset_inputs();
              modal.modal('show');
            }
          }
        }]);
      });
    }
    // --------------------------------------------------------------------
    , link: function(el){
      var $this       = $(this)
        , data        = $this.data('editor')
        , modal       = el.find('.bootstrap-wysihtml5-insert-link-modal')
        , upload_btn  = modal.find('.wysihtml5-upload-file')
        , inputs      = modal.find('input')
        , url_input   = modal.find('#wysihtml5-insert-link-url')
        , email_input   = modal.find('#wysihtml5-insert-email-url')
        , text_input  = modal.find('#wysihtml5-insert-link-text')
        , prefix_btns  = modal.find('label[for="wysihtml5-insert-link-url"] button')
        , submit_btn  = modal.find('a.btn-primary')
        , cancel_btns = modal.find('a[data-dismiss="modal"]')
        ;
      modal.on({
        'shown': function() {
          url_input.focus();
        }
        , 'hide': function(){
          data.editor.currentView.element.focus();
        }
      });
      var insert_link = function(){
        var prefix = 'http://',
            link_input = url_input;
        if (email_input.val()) {
          prefix = 'mailto:';
          link_input = email_input;
        };
        data.editor.composer.commands.exec("createLink", {
            href   : prefix + link_input.val()
          , text   : text_input.val()
        });
        reset_inputs();
      };
      // set data for restoring input vals
      inputs.each(function(){
        $(this).data('init_val', $(this).val());
        $(this).keypress(function(e){
          if(e.which == 13) { // enter
            insert_link();
            modal.modal('hide');
          }
        });
      });
      var reset_inputs = function(){
        inputs.each(function(){
          $(this).val($(this).data('init_val'));
        });
      }
      // populate modal with object
      var fill_modal = function(file){
        url_input.val(file.url.replace('http://', ''));
        text_input.val(file.client_name);
        modal.modal('show');
      };
      // bind buttons
      prefix_btns.click(function(e){
        e.preventDefault();
        if ( ! $(this).hasClass('active')) {
          $('label[for="wysihtml5-insert-link-url"]').siblings().toggle();
        };
      });
      submit_btn.click(insert_link);
      cancel_btns.click(function(){
        reset_inputs();
      });
      el.find('.createLink')
        .click(function() {
          if($(this).hasClass('disabled')) return;
          data.editor.currentView.element.focus();
          modal.modal('show');
        })
        ;
      // allow for upload/callback
      upload_btn.click(function(e){
        e.preventDefault();
        helpers.upload_file.apply($this,['any', {
            data  : {}
          , events : {
              upload : fill_modal
            , cancel : function(){
              reset_inputs();
              modal.modal('show');
            }
          }
        }]);
      });
    }
    // --------------------------------------------------------------------
    , embed: function(el){
      var $this       = $(this)
        , data        = $this.data('editor')
        , modal       = el.find('.bootstrap-wysihtml5-embed-modal')
        , input       = modal.find('#wysihtml5-embed')
        , init_val    = input.val()
        , submit_btn  = modal.find('div.modal-footer a.btn-primary')
        ;
      modal.on({
        'shown': function() {
          input.focus();
        }
        , 'hide': function(){
          data.editor.currentView.element.focus();
        }
      });
      var insert_html = function(){
        data.editor.composer.commands.exec('insertHtml', input.val());
        input.val(init_val);
        submit_btn.unbind('click', insert_html);
      };
      // bind buttons
      submit_btn.click(insert_html);
      el.find('.wysihtml5-embed')
        .click(function() {
          if($(this).hasClass('disabled')) return;
          data.editor.currentView.element.focus();
          modal.modal('show')
        })
        ;
    }
    // --------------------------------------------------------------------
  }; // end tool_init
  // --------------------------------------------------------------------
  var methods = {
    // --------------------------------------------------------------------
    // init properties
    init: function(opts){
      var opts = $.extend(true, {
          parserRules: parserRules
        , events: events
        }, wysihtml5_defaults, opts)
        ;
      return this.each(function(){
        var $this = $(this)
          , data = $this.data('editor')
        ;
        if ( ! data) {
          // init data object
          $this.data('editor', {
            events: opts.events
          });
          // convert wysihtml5 opts
          var wysi_opts = {};
          for (i in wysihtml5_defaults) {
            wysi_opts[i] = opts[i];
          };
          methods.init_toolbar.apply(this);
          methods.init_editor.apply(this, [wysi_opts]);
          methods.init_tools.apply(this);
        };
      });
    }
    // --------------------------------------------------------------------
    // initialize toolbar markup
    , init_toolbar: function(btns, tmpls){
      var $this      = $(this)
        , data       = $this.data('editor')
        , toolbar_id = "wysihtml5-toolbar-" + $this.attr('id')
        , toolbar    = $this.siblings('.wysihtml5-toolbar:first')
        ;
      toolbar.attr('id', toolbar_id);
      data.toolbar = toolbar;
    }
    // --------------------------------------------------------------------
    , init_editor: function(opts){
      var $this = $(this)
        , data  = $this.data('editor')
        ;
      opts.toolbar = data.toolbar.attr('id');
      data.editor = new wysi.Editor($this.attr('id'), opts);
      if(data.events) {
        for(var eventName in data.events) {
          data.editor.on(eventName, data.events[eventName]);
        }
      }
    }
    // --------------------------------------------------------------------
    , init_tools: function(){
      var $this = $(this)
        , data  = $this.data('editor')
        , els   = data.toolbar.children('li')
        ;
      els.each(function(){
        var method = $(this).data('wysihtml5Tool');
        if (method && tool_init[method]){
          tool_init[method].apply($this, [$(this)]);
        }
      });
    }
    // --------------------------------------------------------------------
  };
  // --------------------------------------------------------------------
  var helpers = {
    // --------------------------------------------------------------------
    upload_file: function(type, opts){
      var $this       = $(this)
        , data        = $this.data('editor')
        , form        = $this.parents('form')
        , modal       = $('div.wysihtml5-upload-file-modal')
        , input       = modal.find('input[name="userfile"]')
        , init_val    = input.val()
        , submit_btn  = modal.find('div.modal-footer a.btn-primary')
        , cancel_btns = modal.find('a[data-dismiss="modal"]')
        , upload_url  = input.data('wysihtml5Target')
        , events      = $.extend(true, {
            upload: null
          , cancel: null
        },opts.events)
        ;
      modal
        .on({
          'shown': clear_alerts
        })
        .modal('show');
      var upload_success = function(data, textStatus, jqXHR){
        modal.modal('hide');
        submit_btn.unbind('click', submit);
        if (typeof events.upload === 'function'){
          events.upload.apply($this, [data]);
        }
      };
      var upload_complete = function(jqXHR, textStatus){
        input.val(init_val);
      };
      var upload_error = function(jqXHR, textStatus, errorThrown){
        var error = $('<div/>', {
            'class': 'alert alert-error'
          , html: '<a class="close" data-dismiss="alert" href="#">×</a>'
            + '<h4 class="alert-heading">'+errorThrown+'</h4>'
            + jqXHR.responseText
        });
        $('div.modal-body', modal).prepend(error);
      };
      var clear_alerts = function(){
        modal.find('div.alert').remove();
      };
      input.change(clear_alerts);
      var submit = function(){
        clear_alerts();
        form.ajaxSubmit({
            url      : upload_url + '/' + type
          , dataType : 'json'
          , data     : opts.data
          , success  : upload_success
          , error    : upload_error
          , complete : upload_complete
        });
      };
      submit_btn.click(submit);
      cancel_btns.click(function(){
        input.val(init_val);
        if (typeof events.cancel === 'function'){
          events.cancel();
        }
      });
    }
    // --------------------------------------------------------------------
  }; // end helpers
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

