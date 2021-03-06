class App.CommonController

  constructor: () ->

    jQuery.fn.dataTableExt.oSort['featured-asc'] = (x, y) ->
      if $(x).find('i').hasClass('icon-star-empty') and $(y).find('i').hasClass('icon-star')
        -1
      else if $(x).find('i').hasClass('icon-star') and $(y).find('i').hasClass('icon-star-empty')
        1
      else
        0

    jQuery.fn.dataTableExt.oSort['featured-desc'] = (x, y) ->
      if $(x).find('i').hasClass('icon-star-empty') and $(y).find('i').hasClass('icon-star')
        1
      else if $(x).find('i').hasClass('icon-star') and $(y).find('i').hasClass('icon-star-empty')
        -1
      else
        0

    $.extend $.fn.dataTableExt.oStdClasses,
      sSortAsc: 'header headerSortDown'
      sSortDesc: 'header headerSortUp'
      sSortable: 'header'

    columnDefs = []
    $('table thead th').each (i) ->
      if $(this).data('dtsort')
        columnDefs.push
          sType: $(this).data('dtsort')
          aTargets: [i]


    columnDefs.push
      bSortable: false
      aTargets: [parseInt($('table thead th').length - 1, 10)]

    $('section[id^=admin-][id$=-index] table').dataTable
      sDom: "<'row'<'pull-right'l><'span8'f>r>t<'row'<'span8'i><'pagination-right'p>>"
      sPaginationType: 'bootstrap'
      aoColumnDefs: columnDefs

  ## --------------------------------------------------------------------

  init: () ->
    setTimeout @hideUrlBar, 0
    @protectLinks()
    App.is_mobile = @checkMobile()

    @datetimepickers()
    @status_messages()
    @wysihtml5_editors()
    @tag_complete()
    @detect_prompt_links()
    @crop_tool()

    $('[rel=\'tooltip\']').tooltip()

  ## --------------------------------------------------------------------

  datetimepickers: () ->
    selector = 'input[data-role=datepicker]'
    opts =
      format: 'yyyy/mm/dd'
      weekStart: 0
      startDate: -Infinity
      endDate: Infinity
      autoclose: true
      startView: 'month'
      language: 'en'

    $(selector).each ->
      el = $(this)
      data = el.data()
      for i of opts
        d = 'date' + i.charAt(0).toUpperCase() + i.slice(1)
        opts[i] = data[d] or opts[i]
      el.datepicker opts

    $('input[data-role=timepicker]').timepicker()

  ## --------------------------------------------------------------------

  status_messages: () ->
    $('div.status').each ->
      type = $(this).data('type')
      sticky = false
      sticky = true if type is 'error' or type is 'warning'
      $(this).find('ul li').each ->
        $.jnotify $(this).text(), type, sticky

  ## --------------------------------------------------------------------

  wysihtml5_editors: () ->
    editor = $('textarea[data-role=editor]').editor()
    editor.parent().wrap $('<div class="well"/>')

  ## --------------------------------------------------------------------

  tag_complete: () ->
    $('input[data-role=tagcomplete]').tagcomplete()

  ## --------------------------------------------------------------------

  detect_prompt_links: () ->
    $('a[data-prompt]').not('[data-prompt=off]').click (e) ->
      e.preventDefault()
      url = $(this).attr('href')
      title = $(this).attr('title')
      modal = $('<div class="modal"/>')
      modal_str = """
        <div class="modal-header">
          <button class="close" data-dismiss="modal">×</button>
          <h3>Are you sure?</h3>
        </div>
        <div class="modal-body">
          <p>#{title}</p>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn" data-dismiss="modal">Cancel</a>
          <a href="#{url}" class="btn btn-primary">Yes</a>
        </div>
        """
      modal.html(modal_str).modal()

  ## --------------------------------------------------------------------

  crop_tool: () ->
    if $('img.crop').length
      $('img.crop').each ->
        ratio = $(this).data('ratio')
        input = $("input[name='#{$(this).data('name')}']")
        $(this).Jcrop
          aspectRatio: ratio
          onSelect: (c) ->
            input.val JSON.stringify(c)

  ## --------------------------------------------------------------------

  hideUrlBar: () ->
    window.scrollTo 0, 1

  ## --------------------------------------------------------------------

  protectLinks: () ->
    if ('standalone' of navigator) and navigator['standalone']
      curnode = undefined
      location = document.location
      stop = /^(a|html)$/i
      document.addEventListener 'click', ((e) ->
        curnode = e.target
        curnode = curnode.parentNode until (stop).test(curnode.nodeName)

        # Condidions to do this only on links to your own app
        # if you want all links, use if('href' in curnode) instead.
        if (
          'href' of curnode and # is a link
          (chref = curnode.href).replace(location.href, '').indexOf('#') and # is not an anchor
          (
            not (/^[a-z\+\.\-]+:/i).test(chref) or # either does not have a proper scheme (relative links)
            chref.indexOf(location.protocol + '//' + location.host) is 0 # or is in the same protocol and domain
          )
        )
          e.preventDefault()
          location.href = curnode.href
      ), false

  ## --------------------------------------------------------------------

  checkMobile: () ->
    (/iPhone|iPod|Android|BlackBerry/).test navigator.userAgent
