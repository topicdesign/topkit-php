$(document).ready(function(){
    // jquery is ready
	$('div.alert').each( function() {
		var type = $(this).data('type');
		var sticky = false;
		if (type == 'error' || type == 'warning') {
			sticky = true;
		}
		$(this).find('ul li').each( function() {
			$.jnotify($(this).text(), type, sticky);
		});
        $(this).hide();
	});
});
