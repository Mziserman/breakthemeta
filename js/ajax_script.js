//Objects definitions
var CurrentState = function($){
	this.init($)
}
CurrentState.prototype = {
	init: function($) {
		this.$ = $;
		this.order = 'date';
		this.search = '';
		this.choiceContainer = $('.panel-choice');
		this.panelContainer = $('.build-list-content');

		this.panels = {
			date: new Panel($, 'date', this.choiceContainer.find('.date'), this.panelContainer.find('#panel-1')),
			rand: new Panel($, 'rand', this.choiceContainer.find('.rand'), this.panelContainer.find('#panel-2')),
			debated: new Panel($, 'debated', this.choiceContainer.find('.debated'), this.panelContainer.find('#panel-3')),
			search: new Panel($, 'search', this.choiceContainer.find('.search-result'), this.panelContainer.find('#panel-4')),
		}

		this.currentPanel = this.panels.date;
		this.addInteractions();
	},
	switchPanel: function(from, to){
		from.hide();
		to.show();
		this.currentPanel = to;
	},
	addInteractions: function() {
		var that = this;
		this.panels.date.button.on('click', function(e){
			e.preventDefault();
			that.switchPanel(that.currentPanel, that.panels.date);
			if (!that.currentPanel.visited){
				that.currentPanel.visited = true;
				that.getBuilds();
			}
		});
		this.panels.rand.button.on('click', function(e){
			e.preventDefault();
			that.switchPanel(that.currentPanel, that.panels.rand);
			if (!that.currentPanel.visited){
				that.currentPanel.visited = true;
				that.getBuilds();
			}
		});
		this.panels.debated.button.on('click', function(e){
			e.preventDefault();
			that.switchPanel(that.currentPanel, that.panels.debated);
			if (!that.currentPanel.visited){
				that.currentPanel.visited = true;
				that.getBuilds();
			}
		});


	},
	getBuilds: function(){
		var orderBy = this.currentPanel.name;
		var offset = this.currentPanel.pagination.offset;
		var posts_per_page = this.currentPanel.pagination.postsPerPage;
		var that = this;
		this.$.post(
		    ajaxurl,
		    {
		        'action': 'get_builds',
		        'offset': offset,
		        'posts_per_page': posts_per_page,
		        'orderby': orderBy,
		    },
		    function(response){
		    	that.currentPanel.container.prepend(response);
	        }
		);
	}
}

var Panel = function($, name, button, container) {
	this.init($, name, button, container);
}
Panel.prototype = {
	init: function($, name, button, container) {
		this.$ = $;
		
		this.name = name;
		
		this.button = button;
		this.container = container;
		
		this.pagination = new Pagination(10);
		
		this.active = this.name === 'date';
		this.visited = this.name === 'date';

		this.addInteractions()
	},
	show: function() {
		this.button.addClass('active')
		this.container.removeClass('hide').addClass('show');
		this.button.addClass
		this.active = true;
	},
	hide: function() {
		this.button.removeClass('active')
		this.container.removeClass('show').addClass('hide');
		this.active = false;
	},
	setPageMaxAndPrintPagination: function(pageMax) {
		this.pagination.pageMax = pageMax;
		this.printPaginationAndAddInteraction();
	},
	printPaginationAndAddInteraction: function() {
		var nav_container = this.$('<div>').addClass('nav-below');
		for (var i = 1; i <= this.pagination.pageMax; i++){
			if (i == this.pagination.currentPage){
				nav_container.append(this.$('<span>').addClass('page-numbers').addClass('current').html(i))
			} else {
				nav_container.append(this.$('<a>').addClass('page-numbers').attr('href', i).html(i));	
			}
		}
		this.container.append(nav_container);
		this.addInteractions();
	},
	addInteractions: function() {
		var navContainer = this.container.find('.nav-below');
		var that = this;
		navContainer.on('click', 'a', function(e) {
			e.preventDefault();
			that.pagination.setPage(that.$(this).html());

			var exCurrentPage = navContainer.find('span');
			exCurrentPage.replaceWith(that.$('<a>').addClass('page-numbers').attr('href', exCurrentPage.html()).html(exCurrentPage.html()));
			var currentPage = navContainer.find("a[href=" + that.pagination.currentPage + "]")
			currentPage.replaceWith(that.$('<span>').addClass('page-numbers').addClass('current').html(that.pagination.currentPage))

			that.getBuilds();
		})
	}, 
	getBuilds: function() {
		var orderBy = this.name;
		var offset = this.pagination.offset;
		var posts_per_page = this.pagination.postsPerPage;
		var that = this;
		this.$.post(
		    ajaxurl,
		    {
		        'action': 'get_builds',
		        'offset': offset,
		        'posts_per_page': posts_per_page,
		        'orderby': orderBy,
		    },
		    function(response){
		    	that.container.find('.blog-build-item').remove();
		    	that.container.prepend(response);
	        }
		);
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
	setPage: function(page){
		this.currentPage = page;
		this.offset = this.getOffset();
	}
}

jQuery(document).ready(function($){
	var builds_per_page = 10;
	var pagination = new Pagination(builds_per_page);
	var currentState = new CurrentState($);

	$.when(
		$.post(
		    ajaxurl,
		    {
		        'action': 'get_number_of_builds',
		    },
		    function(response){
		    	pagination.pageMax = Math.ceil(response / pagination.postsPerPage);
		    	currentState.panels.date.setPageMaxAndPrintPagination(Math.ceil(response / pagination.postsPerPage));
		    	currentState.panels.rand.setPageMaxAndPrintPagination(Math.ceil(response / pagination.postsPerPage));
		    	currentState.panels.debated.setPageMaxAndPrintPagination(Math.ceil(response / pagination.postsPerPage));
		    }
	    )
	).then(function(){
		// printPagination($, pagination, currentState);
		// addInteractions($, pagination, currentState);
		console.log(currentState)
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
var addInteractions = function($, pagination, currentState){
	//Switch panel
	$('.panel-choice').on('click', 'a', function(e){
		e.preventDefault();

		$(this).parent().parent().find('li').removeClass('active');
		$(this).parent().addClass('active');

		$('.build-content .main .panel').removeClass('show');
		$($(this).attr('href')).addClass('show');

		currentState.order = $(this).attr('href');
		
		getBuilds($, pagination, currentState)
	})

	//Switch page
	$('.nav-below').on('click', 'a', function(e){
		e.preventDefault()
		pagination.setPage($(this).html());

		var exCurrentPage = $('.nav-below').find('span');
		exCurrentPage.replaceWith($('<a>').addClass('page-numbers').attr('href', exCurrentPage.html()).html(exCurrentPage.html()));
		var currentPage = $('.nav-below').find("a[href=" + pagination.currentPage + "]")
		currentPage.replaceWith($('<span>').addClass('page-numbers').addClass('current').html(pagination.currentPage))

		getBuilds($, pagination, currentState);
	})

	//Search
	$('.search-bar').on('click', 'button', function(e){
		e.preventDefault();
		currentState.search = $(this).parent().find('input').val();
		removePagination($)
		getBuilds($, pagination, currentState);
		currentState.search = '';
	})
}
var removePagination = function($) {
	$('.nav-below').remove();
}
var getBuilds = function($, pagination, currentState){
	var orderBy = currentState.order;
	var search = currentState.search;
	var offset = pagination.offset;
	var posts_per_page = pagination.postsPerPage;
	$.post(
	    ajaxurl,
	    {
	        'action': 'get_builds',
	        'offset': offset,
	        'posts_per_page': posts_per_page,
	        'orderby': orderBy,
	        'search': search
	    },
	    function(response){
	    	$('.build-list-content').find('.blog-build-item').each(function(){
	    		$(this).remove();
	    	});
	    	$('.build-list-content').prepend(response);
        }
	);	
}