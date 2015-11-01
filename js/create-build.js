jQuery(document).ready(function($) {


	/*****************************************************************************************************************
	************************************************ CHAMPION ********************************************************
	*****************************************************************************************************************/



	var Champion = function(options){
		this.init(options);
	};

	Champion.prototype =
	{
		init : function(options)
		{	
			this.main = options.target;
			this.input = this.main.find('[champion-input]');	
			this.select = this.main.find('[champion-select]');
			this.chosen = this.main.find('[champion-chosen]');
			this.chosenName = this.main.find('[champion-chosen-name]');

			this.setEvent();	
		},

		setEvent : function()
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

			})
		},
			
	};

	var champion = new Champion({ target : $('[champion]') });






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
					console.log(newName);
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