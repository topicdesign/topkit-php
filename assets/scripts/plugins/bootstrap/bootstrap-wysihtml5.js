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
        "remove": 1
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
        "remove": 1
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
        "remove": 1
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
        "remove": 1
      },
      "ul": {},
      "progress": {
        "rename_tag": "span"
      },
      "dfn": {
        "rename_tag": "span"
      },
      "iframe": {
        "remove": 1
      },
      "figcaption": {
        "rename_tag": "div"
      },
      "a": {
        "check_attributes": {
          "href": "url"
        },
        "set_attributes": {
          "rel": "nofollow",
          "target": "_blank"
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
        "remove": 1
      },
      "abbr": {
        "rename_tag": "span"
      },
      "u": {},
      "bgsound": {
        "remove": 1
      },
      "sup": {
        "rename_tag": "span"
      },
      "address": {
        "rename_tag": "div"
      },
      "basefont": {
        "remove": 1
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
        "remove": 1
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
        "remove": 1
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
        "remove": 1
      },
      "wbr": {
        "remove": 1
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
        "remove": 1
      },
      "svg": {
        "remove": 1
      },
      "input": {
        "remove": 1
      },
      "table": {},
      "keygen": {
        "remove": 1
      },
      "h5": {
        "add_class": {
          "align": "align_text"
        }
      },
      "meta": {
        "remove": 1
      },
      "map": {
        "rename_tag": "div"
      },
      "isindex": {
        "remove": 1
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
        "remove": 1
      },
      "video": {
        "remove": 1
      },
      "strong": {},
      "canvas": {
        "remove": 1
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
        "remove": 1
      },
      "span": {},
      "rp": {
        "rename_tag": "span"
      },
      "spacer": {
        "remove": 1
      },
      "source": {
        "remove": 1
      },
      "aside": {
        "rename_tag": "div"
      },
      "frame": {
        "remove": 1
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
        "remove": 1
      },
      "blockquote": {
        "check_attributes": {
          "cite": "url"
        }
      },
      "style": {
        "remove": 1
      },
      "device": {
        "remove": 1
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
        "remove": 1
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
        "remove": 1
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
        "remove": 1
      },
      "h6": {
        "add_class": {
          "align": "align_text"
        }
      },
      "param": {
        "remove": 1
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
        "remove": 1
      },
      "pre": {},
      "center": {
        "rename_tag": "div",
        "set_class": "wysiwyg-text-align-center"
      },
      "audio": {
        "remove": 1
      },
      "datalist": {
        "rename_tag": "span"
      },
      "samp": {
        "rename_tag": "span"
      },
      "col": {
        "remove": 1
      },
      "article": {
        "rename_tag": "div"
      },
      "cite": {},
      "link": {
        "remove": 1
      },
      "script": {
        "remove": 1
      },
      "bdo": {
        "rename_tag": "span"
      },
      "menu": {
        "rename_tag": "ul"
      },
      "colgroup": {
        "remove": 1
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
        "remove": 1
      },
      "frameset": {
        "remove": 1
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
        , data = $this.data('editor')
        ;
      // update dropdown label with selected format
      el.find('a[data-wysihtml5-command="formatBlock"]')
        .click(function(e){
          $('.current-font', el).text($(e.srcElement).html())
        })
        ;
      data.editor.on('focus:composer', function(){
        // console.log('focus:composer', this);
      });
    }
    // --------------------------------------------------------------------
    , html: function(el){
      var $this = $(this)
        , data = $this.data('editor')
        , selector = "a[data-wysihtml5-action='change_view']"
        ;
      // toggle active state of all buttons when viewing source
      data.toolbar.find(selector)
        .click(function(e) {
          data.toolbar.find('a.btn')
            .not(selector)
            .toggleClass('disabled')
            ;
        });
    }
    // --------------------------------------------------------------------
    , image: function(el) {
      var $this = $(this)
        , data = $this.data('editor')
        , insertImageModal = el.find('.bootstrap-wysihtml5-insert-image-modal')
        , urlInput = insertImageModal.find('.bootstrap-wysihtml5-insert-image-url')
        , insertButton = insertImageModal.find('a.btn-primary')
        , initialValue = urlInput.val()
        , insertImage = function(){
          var url = urlInput.val();
          urlInput.val(initialValue);
          data.editor.composer.commands.exec("insertImage", url);
        }
        ;
      urlInput.keypress(function(e){
        if(e.which == 13) {
          insertImage();
          insertImageModal.modal('hide');
        }
      });
      insertButton.click(insertImage);
      insertImageModal.on({
        'shown': function(){
          urlInput.focus();
        }
        , 'hide': function(){
          data.editor.currentView.element.focus();
        }
      });
      el.find('a[data-wysihtml5-command=insertImage]')
        .click(function() {
          insertImageModal.modal('show');
        })
        ;
    }
    // --------------------------------------------------------------------
    , link: function(el){
      var $this = $(this)
        , data = $this.data('editor')
        , insertLinkModal = el.find('.bootstrap-wysihtml5-insert-link-modal')
        , urlInput = insertLinkModal.find('.bootstrap-wysihtml5-insert-link-url')
        , insertButton = insertLinkModal.find('a.btn-primary')
        , initialValue = urlInput.val()
        , insertLink = function(){
          var url = urlInput.val();
          urlInput.val(initialValue);
          data.editor.composer.commands.exec("createLink", {
            href: url,
            target: "_blank",
            rel: "nofollow"
          });
        }
        ;

      urlInput.keypress(function(e) {
        if(e.which == 13) {
          insertLink();
          insertLinkModal.modal('hide');
        }
      });

      insertButton.click(insertLink);

      insertLinkModal.on({
        'shown': function() {
          urlInput.focus();
        }
        , 'hide': function(){
          data.editor.currentView.element.focus();
        }
      });

      el.find('a[data-wysihtml5-command=createLink]')
        .click(function() {
          insertLinkModal.modal('show');
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
          //   btn_templates: btn_templates
          // , toolbar_btns: ['format','emphasis','lists','link','image']
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
      var $this = $(this)
        , data = $this.data('editor')
        , toolbar_id = "wysihtml5-toolbar-" + $this.attr('id')
        , toolbar = $this.siblings('.wysihtml5-toolbar:first')
        ;
      toolbar.attr('id', toolbar_id);
      data.toolbar = toolbar;
    }
    // --------------------------------------------------------------------
    , init_editor: function(opts){
      var $this = $(this)
        , data = $this.data('editor')
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
        , data = $this.data('editor')
        , els = data.toolbar.children('li')
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

