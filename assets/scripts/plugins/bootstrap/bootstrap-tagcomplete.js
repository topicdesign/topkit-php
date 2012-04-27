/*!
 * jQuery Bootstrap-TagComplete
 *
 * @author      Topic Deisgn
 * @license     http://creativecommons.org/licenses/BSD/
 * @version     0.0.1
 */
;(function($){
  // public methods
  var methods = {
    // --------------------------------------------------------------------
    // init properties
    init: function(opts){
      var opts = $.extend(true, {
            seperator : ', '
          , source    : null
        }, opts)
        ;
      return this.each(function(){
        var $this = $(this)
          , data  = $this.data('tagcomplete')
        ;
        if ( ! data) {
          // init data object
          $this.data('tagcomplete', {
              seperator : opts.seperator
            , tags      : []
          });
          helpers.replace_input.apply(this);
          methods.source.apply(this, [opts.source]);
          helpers.inject_tags.apply(this);
        };
      });
    }
    // --------------------------------------------------------------------
    , source: function(src){
      var $this = $(this)
        , data  = $this.data('tagcomplete')
        ;
      src = src || $this.data('source');
      if (typeof(src)=='string') {
        try {
          src = JSON.parse(src);
        } catch(e) {
          return $.get(src)
            .success(function(data){
              methods.source.apply($this, [data]);
            })
            .error(function(){
              $.error('jQuery.tagcomplete unable to get remote source: '+src);
            })
            ;
        }
      };
      if ( ! src instanceof Array) {
        $.error('Unable to parse jQuery.tagcomplete source.');
      };
      data.source = src;
    }
    // --------------------------------------------------------------------
    , add_tag: function(tag){
      var $this   = $(this)
        , data    = $this.data('tagcomplete')
        , tag_btn = $('<button/>', {
            class : 'btn btn-mini'
          , html  : tag
          , click : function(e){
              e.preventDefault();
          }
        })
        , close_btn = $('<button/>', {
            class : 'btn btn-mini'
          , html  : '<i class="icon-trash"></i>'
          , click : function(e){
              e.preventDefault();
              methods.remove_tag.apply($this,[tag]); 
              $(this).parent().remove();
          }
        })
        , btn_group = $('<div/>', {
            class: "btn-group"
          }).append(tag_btn, close_btn)
        ;
      data.tag_wrapper.append(btn_group);
      data.tags.push(tag);
      data.source.splice(data.source.indexOf(tag),1);
      helpers.update_tag_inputs.apply(this);
    }
    , remove_tag: function(tag){
      var $this = $(this)
        , data  = $this.data('tagcomplete')
        ;
      data.tags.splice(data.tags.indexOf(tag),1);
      data.source.push(tag);
      helpers.update_tag_inputs.apply(this);
    }
    // --------------------------------------------------------------------
  }; 
  // private methods
  var helpers = {
    // swap input for typeahead
    replace_input: function(){
      var $this = $(this)
        , data  = $this.data('tagcomplete')
        , input = $('<input type="text"/>')
        ;
      $this.hide().before(input);
      input
        .wrap('<div class="input-prepend"/>')
        .before('<span class="add-on"><i class="icon-plus"></i></span>')
      input.on({
        keypress: function(e){
          switch(e.keyCode) {
            case 9:  // tab
            case 13: // enter
            case 27: // escape
              e.preventDefault();
              methods.add_tag.apply($this, [$(this).val()]);
              $(this).val('');
              break
            case 38: // up arrow
              if(e.type === 'keydown'){
                e.preventDefault();
                this.prev();
              }
              break
            case 40: // down arrow
              if(e.type === 'keydown'){
                e.preventDefault();
                this.next();
              }
              break
          }
          e.stopPropagation();
        }
        , change: function(e){
          methods.add_tag.apply($this, [$(this).val()]);
          $(this).val('');
        }
      });
      data.input = input;
    }
    // --------------------------------------------------------------------
    // setup tag wrapper
    , inject_tags: function(){
      var $this   = $(this)
        , data    = $this.data('tagcomplete')
        , wrapper = $('<div/>',{
          class: 'btn-toolbar'
        })
        , tags = $this.val()
        ;
      $this.before(wrapper);
      wrapper.attr('style', 'padding-top:0.5em');
      data.tag_wrapper = wrapper;
      if (tags.length) {
        tags = tags.split(data.seperator);
        for (var i=0, j=tags.length; i < j; i++) {
          methods.add_tag.apply($this, [tags[i]]);
        };
      } else {
        helpers.update_tag_inputs.apply(this);
      }
    }
    // --------------------------------------------------------------------
    // set autocomplete source
    , update_tag_inputs: function(){
      var $this = $(this)
        , data  = $this.data('tagcomplete')
        , val   = ''
        ;
      if (data.tags.length) {
        val = data.tags.join(data.seperator);
      }
      $this.val(val);
      data.input.typeahead({
        source: data.source
      });
    }
    
  };
  // --------------------------------------------------------------------
  // init jQuery.tagcomplete plugin
  $.fn.tagcomplete = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'object' || ! method) {
      return methods.init.apply(this, arguments);
    } else {
      $.error('Method ' +  method + ' does not exist on jQuery.tagcomplete');
    }
  };
  // --------------------------------------------------------------------
})(jQuery, wysihtml5);

