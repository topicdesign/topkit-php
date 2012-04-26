$(document).ready(function() {
  Modernizr.load([
    // polyfills
    {
        test : window.JSON
      , nope : 'assets/scripts/libs/json2.min.js'
    }
  ]);
  $('[rel="tooltip"]').tooltip();
});

