(function() {
  var columnDefs, crop_tool, datetimepickers, detect_prompt_links, status_messages, tag_complete, wysihtml5_editors;

  datetimepickers = function() {
    var opts, selector;
    selector = "input[data-role=\"datepicker\"]";
    opts = {
      format: "yyyy/mm/dd",
      weekStart: 0,
      startDate: -Infinity,
      endDate: Infinity,
      autoclose: true,
      startView: "month",
      language: "en"
    };
    $(selector).each(function() {
      var d, data, el, i;
      el = $(this);
      data = el.data();
      for (i in opts) {
        d = "date" + i.charAt(0).toUpperCase() + i.slice(1);
        opts[i] = data[d] || opts[i];
      }
      return el.datepicker(opts);
    });
    return $("input[data-role=\"timepicker\"]").timepicker();
  };

  status_messages = function() {
    return $("div.status").each(function() {
      var sticky, type;
      type = $(this).data("type");
      sticky = false;
      if (type === "error" || type === "warning") {
        sticky = true;
      }
      return $(this).find("ul li").each(function() {
        return $.jnotify($(this).text(), type, sticky);
      });
    });
  };

  wysihtml5_editors = function() {
    return $("textarea[data-role=\"editor\"]").editor().parent().wrap($("<div class=\"well\"/>"));
  };

  tag_complete = function() {
    return $("input[data-role=\"tagcomplete\"]").tagcomplete();
  };

  detect_prompt_links = function() {
    return $("a[data-prompt]").not("[data-prompt=\"off\"]").click(function(e) {
      var modal, modal_str, title, url;
      e.preventDefault();
      url = $(this).attr("href");
      title = $(this).attr("title");
      modal = $("<div class=\"modal\"/>");
      modal_str = "";
      modal_str += "<div class=\"modal-header\">" + "<button class=\"close\" data-dismiss=\"modal\">×</button>" + "<h3>Are you sure?</h3>" + "</div>" + "<div class=\"modal-body\">" + "<p>" + title + "</p>" + "</div>" + "<div class=\"modal-footer\">" + "<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Cancel</a>" + "<a href=\"" + url + "\" class=\"btn btn-primary\">Yes</a>" + "</div>";
      return modal.html(modal_str).modal();
    });
  };

  crop_tool = function() {
    if ($("img.crop").length) {
      return $("img.crop").each(function() {
        var input, ratio;
        ratio = $(this).data("ratio");
        input = $("input[name=\"" + $(this).data("name") + "\"]");
        return $(this).Jcrop({
          aspectRatio: ratio,
          onSelect: function(c) {
            return input.val(JSON.stringify(c));
          }
        });
      });
    }
  };

  $(document).ready(function() {
    datetimepickers();
    status_messages();
    wysihtml5_editors();
    tag_complete();
    detect_prompt_links();
    crop_tool();
    return $("[rel=\"tooltip\"]").tooltip();
  });

  jQuery.fn.dataTableExt.oSort["featured-asc"] = function(x, y) {
    if ($(x).find("i").hasClass("icon-star-empty") && $(y).find("i").hasClass("icon-star")) {
      return -1;
    } else if ($(x).find("i").hasClass("icon-star") && $(y).find("i").hasClass("icon-star-empty")) {
      return 1;
    } else {
      return 0;
    }
  };

  jQuery.fn.dataTableExt.oSort["featured-desc"] = function(x, y) {
    if ($(x).find("i").hasClass("icon-star-empty") && $(y).find("i").hasClass("icon-star")) {
      return 1;
    } else if ($(x).find("i").hasClass("icon-star") && $(y).find("i").hasClass("icon-star-empty")) {
      return -1;
    } else {
      return 0;
    }
  };

  $.extend($.fn.dataTableExt.oStdClasses, {
    sSortAsc: "header headerSortDown",
    sSortDesc: "header headerSortUp",
    sSortable: "header"
  });

  columnDefs = [];

  $("table thead th").each(function(i) {
    if ($(this).data("dtsort")) {
      return columnDefs.push({
        sType: $(this).data("dtsort"),
        aTargets: [i]
      });
    }
  });

  columnDefs.push({
    bSortable: false,
    aTargets: [parseInt($("table thead th").length - 1, 10)]
  });

  $("section[id^=admin-][id$=-index] table").dataTable({
    sDom: "<'row'<'pull-right'l><'span8'f>r>t<'row'<'span8'i><'pagination-right'p>>",
    sPaginationType: "bootstrap",
    aoColumnDefs: columnDefs
  });

}).call(this);
