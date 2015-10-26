//Objects definitions
var Options = function(){
	this.init()
}
Options.prototype = {
	init: function() {
		this.order = 'date'
	}
}
var Pagination = function(postsPerPage){
	this.init(postsPerPage)
}
Pagination.prototype = {
	init: function(postsPerPage) {
		this.currentPage = 1;
		this.postsPerPage = postsPerPage;

		this.offset = this.getOffset();
	},
	getOffset: function() {
		return (this.currentPage - 1) * this.postsPerPage;
	},
	setNextPage: function(){
		this.currentPage += 1;
		this.offset = this.getOffset()
	},
	setPage: function(page){
		this.currentPage = page;
		this.offset = this.getOffset();
	}
}

jQuery(document).ready(function($){
	var builds_per_page = 10;
	var pagination = new Pagination(builds_per_page);
	var options = new Options();

	$.when(
		$.post(
		    ajaxurl,
		    {
		        'action': 'get_number_of_builds',
		    },
		    function(response){
		    	pagination.pageMax = Math.ceil(response / pagination.postsPerPage)
	        }
	    )
	).then(function(){
		printPagination($, pagination, options);
		addInteractions($, pagination, options);
	})

})
var printPagination = function($, pagination){
	var container = $('.build-list-content').find('.panel');
	var nav_container = $('<div>').addClass('nav-below')
	for (var i = 1; i <= pagination.pageMax; i++){
		if (i == pagination.currentPage){
			nav_container.append($('<span>').addClass('page-numbers').addClass('current').html(i))
		} else {
			nav_container.append($('<a>').addClass('page-numbers').attr('href', i).html(i));	
		}
	}
	container.append(nav_container);
}
var addInteractions = function($, pagination, options){
	$('.panel-choice').on('click', 'a', function(e){
		e.preventDefault();

		$(this).parent().parent().find('li').removeClass('active');
		$(this).parent().addClass('active');

		$('.build-content .main .panel').removeClass('show');
		$($(this).attr('href')).addClass('show');

		options.order = $(this).attr('href');
		
		getBuilds($, pagination, options)
	})

	$('.nav-below').on('click', 'a', function(e){
		e.preventDefault()
		pagination.setPage($(this).html());

		var exCurrentPage = $('.nav-below').find('span');
		exCurrentPage.replaceWith($('<a>').addClass('page-numbers').attr('href', exCurrentPage.html()).html(exCurrentPage.html()));
		var currentPage = $('.nav-below').find("a[href=" + pagination.currentPage + "]")
		currentPage.replaceWith($('<span>').addClass('page-numbers').addClass('current').html(pagination.currentPage))
		getBuilds($, pagination, options);
	})
}

var getBuilds = function($, pagination, options){
	var orderBy = options.order
	var offset = pagination.offset;
	var posts_per_page = pagination.postsPerPage;
	$.post(
	    ajaxurl,
	    {
	        'action': 'get_builds',
	        'offset': offset,
	        'posts_per_page': posts_per_page,
	        'orderby': orderBy
	    },
	    function(response){
	    	$('.build-list-content').find('.blog-build-item').each(function(){
	    		$(this).remove();
	    	});
	    	$('.build-list-content').prepend(response);
        }
	);	
}