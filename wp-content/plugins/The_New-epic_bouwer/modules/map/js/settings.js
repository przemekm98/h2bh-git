(function($){

	EPBOUWER.registerModuleHelper('map', {

		rules: {
			address: {
				required: true
			},
			height: {
				required: true,
				number: true
			}
		},
		
		init: function()
		{
			var form   = $('.ep-bouwer-settings'),
				height = form.find('input[name=height]');
			
			height.on('keyup', this._previewHeight);
		},
		
		_previewHeight: function()
		{
			var form   = $('.ep-bouwer-settings'),
				height = form.find('input[name=height]').val(),
				iframe = $(EPBOUWER.preview.classes.node + ' iframe');
			
			if(!isNaN(height)) {
				iframe.attr('height', height + 'px');
			}
		}
	});

})(jQuery);