//Objects definitions

var Controler = function($, currentState) {
	this.init($, currentState)
}
Controler.prototype = {
	init: function($, currentState) {
		this.$ = $;
		this.currentState = currentState;

		this.choiceContainer = $('.panel-choice');
		this.panelContainer = $('.build-list-content');

		this.panels = {
			date: new Panel($, 'date', this.choiceContainer.find('.date'), this.panelContainer.find('#panel-1')),
			like: new Panel($, 'like', this.choiceContainer.find('.like'), this.panelContainer.find('#panel-2')),
			search: new Panel($, 'search', this.choiceContainer.find('.search-result'), this.panelContainer.find('#panel-3')),
		}

		this.currentState.setCurrentPanel(this.panels.date)
		this.currentState.setNotCurrentPanel(this.panels.like)
		this.addInteractions()
	},
	switchPanel: function(from, to){
		from.hide();
		to.show();
		this.currentState.currentPanel = to;
		this.currentState.notCurrentPanel = from;
	},
	addInteractions: function() {
		var that = this;
		//Switch panels
		
		this.panels.date.button.on('click', function(e){
			e.preventDefault();
			that.switchPanel(that.currentState.currentPanel, that.panels.date);
			if (!that.currentState.currentPanel.visited){
				that.currentState.currentPanel.visited = true;
				if ( that.currentState.filterChampion == '' && that.currentState.filterLane == '' && that.currentState.filterRole == '' ) {
					that.getBuilds();
				} else {
					that.getFilteredBuilds();
				}
			}
		});
		this.panels.like.button.on('click', function(e){
			e.preventDefault();
			that.switchPanel(that.currentState.currentPanel, that.panels.like);
			if (!that.currentState.currentPanel.visited){
				that.currentState.currentPanel.visited = true;
				if ( that.currentState.filterChampion == '' && that.currentState.filterLane == '' && that.currentState.filterRole == '' ) {
					that.getBuilds();
				} else {
					that.getFilteredBuilds();
				}
			}
		});
	

		this.panels.search.button.on('click', function(e){
			e.preventDefault();
			that.switchPanel(that.currentState.currentPanel, that.panels.search);
		})
		
		
		//Search
		this.$('.search-bar').on('click', 'button', function(e){
			e.preventDefault()
			that.search = that.$(this).parent().find('input').val();
			that.getSearchResults();
		})

		//Filter
		this.$('.champ-list').find('ul').find('.champ-list-item').on('click', 'a', function(e){
			e.preventDefault();
    		that.currentState.filterChampion = that.$(this).attr('href');
    		that.getNumberFilteredBuilds();
    		that.currentState.notCurrentPanel.visited = false;
    	})

    	this.$('.filters').on('click', '.filter-champ', function(e) {
    		that.$(this).remove();
    		that.currentState.filterChampion = '';
    		that.currentState.currentPanel.container.find('.blog-build-item').remove();
    		that.getBuilds();

	   		that.currentState.notCurrentPanel.visited = false;
    	})
	},
	getBuilds: function(){
		var action = this.currentState.currentPanel.name == 'date' ? 'get_builds_ordered_by_date' : 'get_builds_ordered_by_likes';
		var offset = this.currentState.currentPanel.pagination.offset;
		var posts_per_page = this.currentState.currentPanel.pagination.postsPerPage;
		var that = this;
		this.$.post(
		    ajaxurl,
		    {
		        'action': action,
		        'offset': offset,
		        'posts_per_page': posts_per_page,
		    },
		    function(response){
		    	that.currentState.currentPanel.container.prepend(response);
	        }
		);
	},
	getFilteredBuilds: function(){
		var action = this.currentState.currentPanel.name == 'date' ? 'get_filtered_builds_ordered_by_date' : 'get_filtered_builds_ordered_by_likes';
		var orderBy = this.currentState.currentPanel.name
		var offset = this.currentState.currentPanel.pagination.offset;
		var posts_per_page = this.currentState.currentPanel.pagination.postsPerPage;
		var championId = this.currentState.filterChampion;
		var laneId = this.currentState.filterLane;
		var roleId = this.currentState.filterRole;
		var that = this;
		this.$.post(
		    ajaxurl,
		    {
		        'action': action,
		        'offset': offset,
		        'posts_per_page': posts_per_page,
		        'orderby': orderBy,
		        'championId': championId,
		        'laneId': laneId,
		        'roleId': roleId,
		    },
		    function(response){
		    	that.currentState.currentPanel.container.find('.blog-build-item').remove()
		    	that.currentState.currentPanel.container.prepend(response);
	        }
		);
	},
	getNumberFilteredBuilds: function() {
		var posts_per_page = this.currentState.currentPanel.pagination.postsPerPage;
		var championId = this.currentState.filterChampion;
		var that = this;
		this.$.post(
		    ajaxurl,
		    {
		        'action': 'get_number_filtered_builds',
		        'championId': championId
		    },
		    function(response){
		    	that.panels.date.removePagination();
		    	that.panels.like.removePagination();
		    	that.panels.date.setPageMaxAndPrintPagination(Math.ceil(response / that.panels.date.pagination.postsPerPage));
    			that.panels.like.setPageMaxAndPrintPagination(Math.ceil(response / that.panels.like.pagination.postsPerPage));
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
		        'action': 'get_search_results',
		        'search': search
		    },
		    function(response){
   				that.switchPanel(that.currentState.currentPanel, that.panels.search);
   				if (!that.currentState.currentPanel.visited){
					that.currentState.currentPanel.visited = true;
					that.currentState.currentPanel.button.css('display', 'inline-block');
				}
		    	that.panels.search.container.empty().prepend(response);
	        }
		);
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
		this.filterChampion = '';
		this.filterLane = '';
		this.filterRole = '';

	},
	setCurrentPanel: function(currentPanel) {
		this.currentPanel = currentPanel;
	},
	setNotCurrentPanel: function(notCurrentPanel) {
		this.notCurrentPanel = notCurrentPanel;
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
		var action = this.name == 'date' ? "get_builds_ordered_by_date" : "get_builds_ordered_by_likes" ;
		console.log(action)
		var offset = this.pagination.offset;
		var posts_per_page = this.pagination.postsPerPage;
		var that = this;
		this.$.post(
		    ajaxurl,
		    {
		        'action': action,
		        'offset': offset,
		        'posts_per_page': posts_per_page,
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
	var controler = new Controler($, currentState)
	$.post(
	    ajaxurl,
	    {
	        'action': 'get_number_of_builds',
	    },
	    function(response){

	    	controler.panels.date.setPageMaxAndPrintPagination(Math.ceil(response / controler.panels.date.pagination.postsPerPage));
	    	controler.panels.like.setPageMaxAndPrintPagination(Math.ceil(response / controler.panels.like.pagination.postsPerPage));
	    	
	    }
    )

})
