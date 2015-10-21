jQuery(document).ready(function($) {


	// Expand filters list
	$('.aside-list-items a.title').on('click', function(e) {
		e.preventDefault();

		$(this).toggleClass('active');
	});

	//
	// Add champion name as a filter and keep him selected
	//
	$('.champ-list-item').on('click', function(e) {
		e.preventDefault();

		// Remove all other previous selected champions
		$(this).parent().find('.champ-list-item').removeClass('active');

		$(this).toggleClass('active');

		// Get value of selected champion and display it as a filter
		var champ = $(this).find('.champ-name').html();
		if($('.filter-champ').length == 0) {
			$('.filters').append('<div class="filter-button filter-champ red">'+ champ +'</div>');
		}else {
			$('.filters .filter-champ').html(champ);
		}
		
	});

	//
	// Add lane name as a filter and keep it selected
	//
	$('.lanes li').on('click', function(e) {
		e.preventDefault();

		// Remove all other previous selected lanes
		$(this).parent().find('li').removeClass('active');

		$(this).toggleClass('active');
		$('.lanes .title').toggleClass('active');

		// Get value of selected lane and display it as a filter
		var lane = $(this).find('a').html();
		if($('.filter-lane').length == 0){
			$('.filters').append('<div class="filter-button filter-lane blue">'+ lane +'</div>');
		}else {
			$('.filters .filter-lane').html(lane);
		}
		
	});

	//
	// Add role name as a filter and keep it selected
	//
	$('.roles li').on('click', function(e) {
		e.preventDefault();

		// Remove all other previous selected lanes
		$(this).parent().find('li').removeClass('active');

		$(this).toggleClass('active');
		$('.roles .title').toggleClass('active');

		// Get value of selected lane and display it as a filter
		var role = $(this).find('a').html();
		if($('.filter-role').length == 0){
			$('.filters').append('<div class="filter-button filter-role yellow">'+ role +'</div>');
		}else {
			$('.filters .filter-role').html(role);
		}
		
	});


	// Switch to panels on Build List
	$('.panel-choice a').on('click', function(e) {
		e.preventDefault();

		$(this).parent().parent().find('li').removeClass('active');
		$(this).parent().addClass('active');

		$('.build-list-content .panel').removeClass('show');
		$($(this).attr('href')).addClass('show');

	});

});






