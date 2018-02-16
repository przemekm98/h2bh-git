(function($){

	EPBOUWER.registerModuleHelper('accordion', {

		rules: {
			item_spacing: {
				required: true,
				number: true
			}
		},
		
		init: function()
		{
			var form            = $('.ep-bouwer-settings'),
				labelSize       = form.find('select[name=label_size]'),
				itemSpacing     = form.find('input[name=item_spacing]');
			
			labelSize.on('change', this._previewLabelSize);
			itemSpacing.on('keyup', this._previewItemSpacing);
		},
		
		_previewLabelSize: function()
		{
			var size  = $('.ep-bouwer-settings select[name=label_size]').val(),
				wrap  = EPBOUWER.preview.elements.node.find('.fl-accordion');
				
			wrap.removeClass('fl-accordion-small');
			wrap.removeClass('fl-accordion-medium');
			wrap.removeClass('fl-accordion-large');
			wrap.addClass('fl-accordion-' + size);
		},
		
		_previewItemSpacing: function()
		{
			var spacing = parseInt($('.ep-bouwer-settings input[name=item_spacing]').val(), 10),
				items   = EPBOUWER.preview.elements.node.find('.fl-accordion-item');
				
			items.attr('style', '');
		
			if(isNaN(spacing) || spacing === 0) {
				items.css('margin-bottom', '0px');
				items.not(':last-child').css('border-bottom', 'none');
			}
			else {
				items.css('margin-bottom', spacing + 'px');
			}
		}
	});

})(jQuery);