jQuery(document).ready(function($) {


	// Expand filters list
	$('.aside-list-items a.title').on('click', function(e) {
		e.preventDefault();

		$(this).toggleClass('active');
	});

});