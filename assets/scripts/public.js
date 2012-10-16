(function() {
  var status_messages;

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

  $(document).ready(function() {
    return status_messages();
  });

}).call(this);
