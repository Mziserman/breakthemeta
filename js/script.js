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

		if($(this).hasClass('active')) {
			$(this).removeClass('active');
		}else {
			$('.champ-list .active').removeClass('active');
			$(this).addClass('active');
		}

		// Get value of selected champion and display it as a filter
		var champ = $(this).find('.champion-name').html();
		
		if($('.filter-champ').length == 0) {
			$('.filters').append('<div class="filter-button filter-champ red">'+ champ +'<i class="fa fa-times"></i></div>');
		} else {
			$('.filters .filter-champ').html(champ+'<i class="fa fa-times"></i>');
		}

		removeFilter('champ');
		
	});

	//
	// Add lane name as a filter and keep it selected
	//
	$('.lanes li').on('click', function(e) {
		e.preventDefault();

		if($(this).hasClass('active')) {
			$(this).removeClass('active');
		}else {
			$(this).parent().find('li').removeClass('active');
			$(this).addClass('active');
		}

		// Get value of selected lane and display it as a filter
		var lane = $(this).find('a').html();
		if($('.filter-lane').length == 0){
			$('.filters').append('<div class="filter-button filter-lane blue">'+ lane +'<i class="fa fa-times"></i></div>');
		}else {
			$('.filters .filter-lane').html(lane+'<i class="fa fa-times"></i>');
		}
		
		removeFilter('lane');
	});

	//
	// Add role name as a filter and keep it selected
	//
	$('.roles li').on('click', function(e) {
		e.preventDefault();

		if($(this).hasClass('active')) {
			$(this).removeClass('active');
		}else {
			$(this).parent().find('li').removeClass('active');
			$(this).addClass('active');
		}

		// Get value of selected lane and display it as a filter
		var role = $(this).find('a').html();
		if($('.filter-role').length == 0){
			$('.filters').append('<div class="filter-button filter-role yellow">'+ role +'<i class="fa fa-times"></i></div>');
		}else {
			$('.filters .filter-role').html(role+'<i class="fa fa-times"></i>');
		}

		removeFilter('role');
	});


	//
	// Remove filters
	function removeFilter(type) {

		var itemSelected = '';		

		$('.filters .filter-button').on('click', function() {

			var brutValue = $(this).html(),
				cleanValue = brutValue.replace('<i class="fa fa-times"></i>','');
			
			switch(type) {
				case 'champ' : 
					itemSelected = $('.champ-name:contains('+cleanValue+')');
					itemSelected.parent().parent().removeClass('active');
					break;

				case 'lane' :
					itemSelected = $('.lanes a:contains('+cleanValue+')');
					itemSelected.parent().removeClass('active');
					break;

				case 'role' : 
					itemSelected = $('.roles a:contains('+cleanValue+')');
					itemSelected.parent().removeClass('active');
					break; 
			}

		});	
	}

	// Switch to panels on BUILD DETAIL !
	$('.panel-choice-detail a').on('click', function(e) {
		e.preventDefault();

		$(this).parent().parent().find('li').removeClass('active');
		$(this).parent().addClass('active');

		$('.build-content .main .panel').removeClass('show');
		$($(this).attr('href')).addClass('show');
	});

	// Sticky aside menu for BUILD DETAIL
	$(window).on('scroll', function(e){

        if($(this).scrollTop > 350){
             $('.build-content .aside').addClass('sticky');
        } else {
            $('.build-content .aside').removeClass('sticky');
        }    
	});

	// Add active to masteries with points !
	var points = $('.points');
	points.each(function() {
		
		if($(this).attr('data-point') > 0) {
			$(this).parent().addClass('active');
		}
	});

	// Center video in post
	var contentVideo = $('.the-content iframe');
	contentVideo.parent().css('text-align','center');

	// Remove text in login form when the user start writing 
	$('#loginform').find('input[type="text"], input[type=password]').on('keypress', function(e) {

		var that = $(this),
			label = that.prev('label');

		if(that.value == '') {
			label.removeClass('hide');
		} else {
			label.addClass('hide');
		}
	});

	function showForm(elem, form, second) {
		// Display login panel clicking on menu item
		$('.navbar .'+elem+' a').on('click', function(e) {
			e.preventDefault();

			second.removeClass('show');
			second.fadeOut();
			$(this).parent().parent().find('li.login,li.register').removeClass('active');

			if(form.hasClass('show')) {
				$(form).removeClass('show');
				$(form).fadeOut();
				$(this).parent().removeClass('active');
			} else {
				$(form).fadeIn();
				$(form).addClass('show');
				$(this).parent().addClass('active');
			}
		});
	}

	showForm('login', $('#loginform'), $('#registerform'));
	showForm('register', $('#registerform'), $('#loginform'));

	function searchChamp(field, champ){
		field.on('keyup',function(){

				var text = $(this).val();
				text = text.toLowerCase();

				for ( i = 0; i < champ.length; i ++)
				{
					var name = $(champ[i]).find('.champion-name').html();
					name = name.toLowerCase();
					if( name.indexOf(text) == 0 )
					{
						$(champ[i]).removeClass('hide');
					} else {
						$(champ[i]).addClass('hide');
					}
					
				}
			});
	}

	searchChamp($('[champion-search]'), $('[champion-select]'));

	$('.table-line-skill').on('mouseover', function (e) {
		$id = $(this).attr('order-line');
		$('*[order-line='+ $id +']').addClass('line-active');
	});

	$('.table-line-skill').on('mouseout', function (e) {
		$('.table-line-skill').removeClass('line-active');
	});


});






