window.App ||= {}
App.initiatedClasses = {}
App.Collections = {}
App.Models = {}
App.Views = {}

App.UTIL =
  exec: (controller, action = 'init') ->
    if App[controller] # try to find a controller
      # create a controller object or re-use it if already present
      klass = App.initiatedClasses[controller] ||= new App[controller]

      # check if both a controller and an action are usable
      if typeof klass is "object" and typeof klass[action] is "function"
        klass[action]() # call the function
  init: ->
    body = $("body") # this is where your data-router-class and data-router-action attributes live
    controller = body.data("router-class")
    action = body.data("router-action")

    # CommonController#init is executed on every page, useful for generic stuff
    this.exec "CommonController"
    this.exec controller
    this.exec controller, action

## --------------------------------------------------------------------

$ ->
  App.UTIL.init()

## --------------------------------------------------------------------
# usage: log('inside coolFunc', this, arguments);
# paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = ->
  log.history = log.history or []
  log.history.push arguments
  if @console
    arguments.callee = arguments.callee.caller
    console.log Array::slice.call(arguments)

# make it safe to use console.log always
((b) ->
  c = ->
  d = "assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(",")

  while a = d.pop()
    b[a] = b[a] or c
) window.console = window.console or {}

# place any jQuery/helper plugins in here, instead of separate, slower script files.
