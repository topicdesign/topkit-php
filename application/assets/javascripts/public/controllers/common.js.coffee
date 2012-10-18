class App.CommonController

  constructor: () ->
    null

  init: () ->
    setTimeout @hideUrlBar, 0
    @protectLinks()
    App.is_mobile = @checkMobile()

  ## --------------------------------------------------------------------

  hideUrlBar: () ->
    window.scrollTo 0, 1

  protectLinks: () ->
    if ('standalone' of navigator) and navigator['standalone']
      curnode = undefined
      location = document.location
      stop = /^(a|html)$/i
      document.addEventListener "click", ((e) ->
        curnode = e.target
        curnode = curnode.parentNode until (stop).test(curnode.nodeName)

        # Condidions to do this only on links to your own app
        # if you want all links, use if('href' in curnode) instead.
        if (
          "href" of curnode and # is a link
          (chref = curnode.href).replace(location.href, "").indexOf("#") and # is not an anchor
          (
            not (/^[a-z\+\.\-]+:/i).test(chref) or # either does not have a proper scheme (relative links)
            chref.indexOf(location.protocol + "//" + location.host) is 0 # or is in the same protocol and domain
          )
        )
          e.preventDefault()
          location.href = curnode.href
      ), false

  checkMobile: () ->
    (/iPhone|iPod|Android|BlackBerry/).test navigator.userAgent
