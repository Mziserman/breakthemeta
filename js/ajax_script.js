//Objects definitions
var filter = function($) {
	this.init($)
}
filter.prototype = {
	init: function($) {
		this.$ = $;
		this.champion = '';
		this.lane = '';
		this.role = '';
	}
}

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
			search: new Panel($, 'search', this.choiceContainer.find('.search-result'), this.panelContainer.find('#panel-3')),
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
		this.panels.search.button.on('click', function(e){
			e.preventDefault();
			that.switchPanel(that.currentPanel, that.panels.search);
		})
		this.$('.search-bar').on('click', 'button', function(e){
			e.preventDefault()
			that.search = that.$(this).parent().find('input').val();
			that.getSearchResults();
		})
		this.$('.champ-list').find('ul').find('.champ-list-item').on('click', 'a', function(e){
    		that.filterStatus.championId = that.$(this).attr('href');
    		that.getNumberFilteredBuilds();
    	})
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
	},
	getFilteredBuilds: function(){
		var orderBy = this.currentPanel.name;
		var offset = this.currentPanel.pagination.offset;
		var posts_per_page = this.currentPanel.pagination.postsPerPage;
		var championId = this.filterStatus.championId
		var that = this;
		this.$.post(
		    ajaxurl,
		    {
		        'action': 'get_filtered_builds',
		        'offset': offset,
		        'posts_per_page': posts_per_page,
		        'orderby': orderBy,
		        'championId': championId
		    },
		    function(response){
		    	that.currentPanel.container.find('.blog-build-item').remove()
		    	that.currentPanel.filterVisited = true;
		    	that.currentPanel.container.prepend(response);
	        }
		);
	},
	getNumberFilteredBuilds: function() {
		var orderBy = this.currentPanel.name;
		var offset = this.currentPanel.pagination.offset;
		var posts_per_page = this.currentPanel.pagination.postsPerPage;
		var championId = this.filterStatus.championId
		var that = this;
		this.$.post(
		    ajaxurl,
		    {
		        'action': 'get_number_filtered_builds',
		        'offset': offset,
		        'posts_per_page': posts_per_page,
		        'orderby': orderBy,
		        'championId': championId
		    },
		    function(response){
		    	that.panels.date.removePagination();
		    	that.panels.rand.removePagination();
		    	that.panels.date.setPageMaxAndPrintPagination(Math.ceil(response / that.panels.date.pagination.postsPerPage));
    			that.panels.rand.setPageMaxAndPrintPagination(Math.ceil(response / that.panels.rand.pagination.postsPerPage));
    			that.getFilteredBuilds()
	        }
		)
		
		
	},
	getSearchResults: function() {
		var search = this.search;
		var that = this;
		this.$.post(
		    ajaxurl,
		    {
		        'action': 'get_builds',
		        'search': search
		    },
		    function(response){
   				that.switchPanel(that.currentPanel, that.panels.search);
   				if (!that.currentPanel.visited){
					that.currentPanel.visited = true;
					that.currentPanel.button.css('display', 'inline-block');
				}
		    	that.panels.search.container.empty().prepend(response);
	        }
		);
	},
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
		
		this.visited = this.name === 'date';
		this.filterVisited = false;

		this.addInteractions()
	},
	show: function() {
		this.button.addClass('active')
		this.container.removeClass('hide').addClass('show');
		this.button.addClass
	},
	hide: function() {
		this.button.removeClass('active')
		this.container.removeClass('show').addClass('hide');
	},
	removePagination: function() {
		this.container.find('.nav-below').remove()
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
	var currentState = new CurrentState($);

	$.post(
	    ajaxurl,
	    {
	        'action': 'get_number_of_builds',
	    },
	    function(response){
	    	currentState.panels.date.setPageMaxAndPrintPagination(Math.ceil(response / currentState.panels.date.pagination.postsPerPage));
	    	currentState.panels.rand.setPageMaxAndPrintPagination(Math.ceil(response / currentState.panels.rand.pagination.postsPerPage));
	    }
    )

})
