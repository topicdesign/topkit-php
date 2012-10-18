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
