(function($){
  var methods = {
    // --------------------------------------------------------------------
    // init properties
    init: function(opts){
      var opts = $.extend({
          '24hr': false
        , steps : 15
      }, opts);
      return this.each(function() {
        var $this = $(this)
          , data = $this.data('timepicker')
        ;
        if ( ! data) {
          // setup auto-complete time options
          var time_opts = []
            , num_hours = (opts['24hr'] && 23) || 12
          ;
          for (var i=0, j = num_hours*60; i < j; i+=opts.steps){
            var h = (Math.floor(i/60) + 1)%(num_hours+1)
              , m = i%60
            ;
          if (m.toString().length == 1) m += '0';
            time_opts.push(h+':'+m);
          };
          // init data object
          $this.data('timepicker', {
            opts: opts
          });
          // inject buttons for AM/PM toggle
          if ( ! opts['24hr']) methods.inject_AMPM_input.apply(this);
          // autocomplete ignoring ':'
          $this.typeahead({
              source: time_opts
            , matcher: function(item){
              var i = item.replace(':', '')
                , q = this.query.replace(':', '')
                ;
              return ~i.toLowerCase().indexOf(q.toLowerCase())
            }
          });
          // maintain string formatting
          $this.on('blur', methods.format_time);
        };
      });
    }
    // --------------------------------------------------------------------
    // reformat time to 00:00
    , format_time: function(e){
      var $this = $(this)
        , str = $this.val().replace(':', '')
        ;
      str = str.substr(0,str.length-2) + ':' + str.substr(-2);
      $this.val(str);
    }
    // --------------------------------------------------------------------
    // add markup/UI for AM/PM toggle and hidden input
    , inject_AMPM_input: function(e){
      var $this = $(this)
        , data = $this.data('timepicker')
        , wrapper = $('<div/>', {
          'class': 'input-append'
        })
        , input = $('<input type="hidden"/>')
          .attr('name',$this.attr('name')+'-ampm')
        , btns = ['AM','PM']
        , val_bits = $this.val().split(' ')
        , ampm = 'PM'
        ;
      if (val_bits.length > 1) {
        $this.val(val_bits[0]);
        ampm = val_bits[1];
      };
      wrapper = $this.wrap(wrapper).parent();
      wrapper.append(input);
      $this.data('timepicker', $.extend(data,{'ampm_input':input}));
      for (var i=0,j=btns.length; i<j; i++){
        var btn = $('<button/>', {
              text: btns[i]
            , 'class': 'btn ' + btns[i]
          })
            .on('click', {obj:this,val:btns[i]}, methods.set_ampm)
          ;
        btn.appendTo(wrapper);
        if (btns[i] == ampm) btn.click();
      };
    }
    // --------------------------------------------------------------------
    // set hidden input value and toggle active button
    , set_ampm: function(e){
      var $this = $(e.data.obj)
        , data = $this.data('timepicker')
        , input = data.ampm_input
        ;
      e.preventDefault();
      input.val(e.data.val);
      $(this)
        .addClass('active')
        .siblings()
        .removeClass('active')
        ;
    }
    // --------------------------------------------------------------------
  }; 
  // --------------------------------------------------------------------
  // init jQuery.timepicker plugin
  $.fn.timepicker = function( method ) {
    if ( methods[method] ) {
      return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.timepicker' );
    }
  };
  // --------------------------------------------------------------------
})(jQuery);

