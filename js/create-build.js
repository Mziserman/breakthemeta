jQuery(document).ready(function($) {


	/*****************************************************************************************************************
	************************************************ CHAMPION ********************************************************
	*****************************************************************************************************************/



	var Champion = function($){
		this.init($);
	};

	Champion.prototype =
	{
		init : function($)
		{
			that = this;
			this.main = $('[create-build]');
			this.$ = $;
			this.input = this.main.find('[champion-input]');	
			this.select = this.main.find('[champion-select]');
			this.chosen = this.main.find('[champion-chosen]');
			this.chosenName = this.main.find('[champion-chosen-name]');

			this.spells = {
				q: that.main.find('[order-img-q]'),
				w: that.main.find('[order-img-w]'),
				e: that.main.find('[order-img-e]'),
				r: that.main.find('[order-img-r]'),
				passive: that.main.find('[order-img-passive]')
			};

			this.setEvent($);	
		},

		setEvent : function($)
		{
			var that = this;

			this.select.on('click',function(e){
				e.preventDefault();

				var id = $(this).find('input').val();
				var src = $(this).find('img').attr('src');
				var name = $(this).find('.champion-name').html();

				that.chosen.attr('src',src);
				that.chosenName.html(name);
				that.input.val(id);

				that.setSpellsImg(id,$);

			})
		},

		setSpellsImg : function(id,$)
		{
			that = this;
			this.$.post(
			    ajax_url,
			    {
			        'action': 'get_spells_pictures',
			        'championId': id
			    },
			    function(response){
			    	img = $.parseJSON(response);

			    	that.spells.q.attr('src',img.q_spell);
			    	that.spells.w.attr('src',img.w_spell);
			    	that.spells.e.attr('src',img.e_spell);
			    	that.spells.r.attr('src',img.r_spell);
			    	that.spells.passive.attr('src',img.passive);
		        }
			);
		},
			
	};

	var champion = new Champion($);






	/*****************************************************************************************************************
	************************************************ item ************************************************************
	*****************************************************************************************************************/




	var Item = function(options){
		this.init(options);
	};

	Item.prototype =
	{
		init : function(options)
		{
			that = this;

			this.main = options.target;

			this.begin = {
				chosen: that.main.find('[begin-item-chosen]'),
				input: that.main.find('[begin-item-input]'),	
				select: that.main.find('[begin-item-select]'),
				chosenName: that.main.find('[begin-item-name]')
			}

			this.end = {
				chosen: that.main.find('[end-item-chosen]'),
				input: that.main.find('[end-item-input]'),	
				select: that.main.find('[end-item-select]'),
				chosenName: that.main.find('[end-item-name]')
			}

			this.setEvent(this.begin);
			this.setEvent(this.end);

		},

		setEvent : function(objet)
		{
			var that = this,
				select = objet.select;
				chosen = objet.chosen;

			select.on('click',function(e){
				e.preventDefault();

				var id = $(this).find('input').val();
				var src = $(this).find('img').attr('src');
				var name = $(this).find('.item-name').html();

				that.addItem(objet,id,src,name);
			});

			chosen.on('click',function(e){
				e.preventDefault();
				that.removeItem(this);
			});
		},

		addItem : function(objet,newId,newSrc, newName)
		{
			var that = this,
				data = objet.chosen;

			for ( i = 0; i < data.length; i ++ )
			{
				var input = $(data[i]).find('input');
				var img = $(data[i]).find('img');
				var span = $(data[i]).find('.item-chosen-name');
				if ( input.val() == '' && img.attr('src') == '' )
				{

					input.val(newId);
					img.attr('src',newSrc);
					span.html(newName);
					break;
				}
			}
		},

		removeItem : function(chosen)
		{
			$(chosen).find('input').val('');
			$(chosen).find('img').attr('src','');
			$(chosen).find('.item-chosen-name').empty() ;
		},
			
	};

	var item = new Item({ target : $('[item]') });




	/*****************************************************************************************************************
	************************************************ skill order *****************************************************
	*****************************************************************************************************************/




	var order = function(options){
		this.init(options);
	};

	order.prototype =
	{
		init : function(options)
		{
			that = this;

			this.main = options.target;

			this.select = this.main.find('[order-select]');

			this.setEvent(this.select);

		},

		setEvent : function(select)
		{
			var that = this;

			select.on('click',function(e){
				e.preventDefault();

				that.updateSpell(this);

			});
		},

		updateSpell : function(self)
		{
			var that = this,
				level = $(self).attr('order-level'),
				line = $(self).attr('order-line'),
				input = $(self).find('input');

			if ( input.val() == 1 ){
				input.val(0);
				$(self).removeClass('active');

			} else if ( input.val() == 0 ) {
				input.val(1);
				$(self).addClass('active');

				for ( i = 1; i <= 5; i ++ )
				{
					if ( i != line )
					{
						$('[order-level='+level+'][order-line='+i+']').removeClass("active");
						$('[order-level='+level+'][order-line='+i+']').find('input').val(0);
					}
				}
			}
			
		},
			
	};

	var order = new order({ target : $('[skill-order]') });



	/*****************************************************************************************************************
	************************************************ summoner spells *************************************************
	*****************************************************************************************************************/



	var Summoner = function(options){
		this.init(options);
	};

	Summoner.prototype =
	{
		init : function(options)
		{
			that = this;

			this.main = options.target;

			this.input = this.main.find('[summoner-input]');	
			this.select = this.main.find('[summoner-select]');	
			this.chosen = this.main.find('[summoner-chosen]');	


			this.setEvent();

		},

		setEvent : function(objet)
		{
			var that = this;

			this.select.on('click',function(e){
				e.preventDefault();

				var id = $(this).find('input').val();
				var src = $(this).find('img').attr('src');

				that.addItem(id,src);
			});

			this.chosen.on('click',function(e){
				e.preventDefault();
				that.removeItem(this);
			});
		},



		addItem : function(newId,newSrc)
		{
			var that = this,
				data = this.chosen,
				preExist = 0;

				// securité pour les doublons
			for ( i = 0; i < data.length; i ++ )
			{
				var input = $(data[i]).find('input');
				var img = $(data[i]).find('img');
				if ( input.val() == newId && img.attr('src') == newSrc )
				{
					preExist = 1;
					break;
				}
			}

			if ( preExist == 0 )
			{
				for ( i = 0; i < data.length; i ++ )
				{
					var input = $(data[i]).find('input');
					var img = $(data[i]).find('img');
					if ( input.val() == '' && img.attr('src') == '' )
					{
						input.val(newId);
						img.attr('src',newSrc);
						break;
					}
				}
			}
			
		},

		removeItem : function(chosen)
		{
			$(chosen).find('input').val('');
			$(chosen).find('img').attr('src','');
		},
			
	};

	var summoner = new Summoner({ target : $('[summoner]') });


	/*****************************************************************************************************************
	************************************************ runes ************************************************************
	*****************************************************************************************************************/



	var Item = function(options){
		this.init(options);
	};

	Item.prototype =
	{
		init : function(options)
		{
			that = this;

			this.main = options.target;

			this.red = {
				chosen: that.main.find('[red-runes-chosen]'),
				input: that.main.find('[red-runes-input]'),	
				select: that.main.find('[red-runes-select]')
			}

			this.yellow = {
				chosen: that.main.find('[yellow-runes-chosen]'),
				input: that.main.find('[yellow-runes-input]'),	
				select: that.main.find('[yellow-runes-select]')
			}

			this.blue = {
				chosen: that.main.find('[blue-runes-chosen]'),
				input: that.main.find('[blue-runes-input]'),	
				select: that.main.find('[blue-runes-select]')
			}

			this.black = {
				chosen: that.main.find('[black-runes-chosen]'),
				input: that.main.find('[black-runes-input]'),	
				select: that.main.find('[black-runes-select]')
			}

			this.setEvent(this.red);
			this.setEvent(this.yellow);
			this.setEvent(this.blue);
			this.setEvent(this.black);

		},

		setEvent : function(objet)
		{
			var that = this,
				select = objet.select;
				chosen = objet.chosen;

			select.on('click',function(e){
				e.preventDefault();

				var id = $(this).find('input').val();
				var src = $(this).find('img').attr('src');

				that.addItem(objet,id,src);
			});

			chosen.on('click',function(e){
				e.preventDefault();
				that.removeItem(this);
			});
		},

		addItem : function(objet,newId,newSrc)
		{

			var that = this,
				data = objet.chosen;

			for ( i = 0; i < data.length; i ++ )
			{
				var input = $(data[i]).find('input');
				var img = $(data[i]).find('img');
				if ( input.val() == '' && img.attr('src') == '' )
				{
					input.val(newId);
					img.attr('src',newSrc);
					break;
				}
			}
		},

		removeItem : function(chosen)
		{
			$(chosen).find('input').val('');
			$(chosen).find('img').attr('src','');
		},
			
	};

	var item = new Item({ target : $('[runes]') });



});