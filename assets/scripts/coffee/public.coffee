status_messages = ->
  $("div.status").each ->
    type = $(this).data("type")
    sticky = false
    sticky = true  if type is "error" or type is "warning"
    $(this).find("ul li").each ->
      $.jnotify $(this).text(), type, sticky


$(document).ready ->
  status_messages()
