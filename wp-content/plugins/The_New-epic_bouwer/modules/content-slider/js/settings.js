(function($){

	EPBOUWER.registerModuleHelper('content-slider', {

		rules: {
			height: {
				required: true,
				number: true
			},
			delay: {
				required: true,
				number: true
			},
			speed: {
				required: true,
				number: true
			},
			max_width: {
				required: true,
				number: true
			},
			'slides[]': {
				required: true
			}
		}
	});
	
	EPBOUWER.registerModuleHelper('content_slider_slide', {

		rules: {
			label: {
				required: true
			}
		},
		
		init: function()
		{
			var form          = $('.fl-form-field-settings'),
				bgLayout      = form.find('select[name=bg_layout]'),
				contentLayout = form.find('select[name=content_layout]');
			
			bgLayout.on('change', this._toggleMobileTab);
			bgLayout.on('change', this._toggleTextAndCtaTabs);
			contentLayout.on('change', this._toggleMobileTab);
			contentLayout.on('change', this._toggleTextAndCtaTabs);
			contentLayout.trigger('change');
		},
		
		submit: function()
		{
			var form          = $('.ep-bouwer-settings'),
				bgLayout      = form.find('select[name=bg_layout]').val(),
				contentLayout = form.find('select[name=content_layout]').val();
				
			if(bgLayout == 'none' && contentLayout == 'none') {
				EPBOUWER.alert(EPBOUWERStrings.contentSliderSelectLayout);
				return false;
			}
			
			return true;
		},
		
		_toggleTextAndCtaTabs: function()
		{
			var form          = $('.ep-bouwer-settings'),
				bgLayout      = form.find('select[name=bg_layout]').val(),
				contentLayout = form.find('select[name=content_layout]').val(),
				show          = true;
				  
			if(bgLayout == 'video' || contentLayout == 'none') {
				show = false;
			}
			
			if(show) {
				$('a[href*=ep-bouwer-settings-tab-style]').show();
				$('a[href*=ep-bouwer-settings-tab-cta]').show();
			}
			else {
				$('a[href*=ep-bouwer-settings-tab-style]').hide();
				$('a[href*=ep-bouwer-settings-tab-cta]').hide();
			}
		},
		
		_toggleMobileTab: function()
		{
			var form          = $('.ep-bouwer-settings'),
				bgLayout      = form.find('select[name=bg_layout]').val(),
				contentLayout = form.find('select[name=content_layout]').val(),
				show          = true,
				showPhoto     = true,
				showText      = true;
			
			// Hide or show tab.    
			if(bgLayout == 'video' || (bgLayout != 'photo' && contentLayout == 'none')) {
				show = false;
			}
			
			if(show) {
				$('a[href*=ep-bouwer-settings-tab-mobile]').show();
			}
			else {
				$('a[href*=ep-bouwer-settings-tab-mobile]').hide();
			}
			
			// Hide or show text.
			if(contentLayout == 'none') {
				showText = false;
			}
			
			if(showText) {
				$('#ep-bouwer-settings-section-r_text_style').show();
			}
			else {
				$('#ep-bouwer-settings-section-r_text_style').hide();
			}
			
			// Hide or show photos.
			if(bgLayout != 'photo' && contentLayout != 'photo') {
				showPhoto = false;
			}
			
			if(showPhoto) {
				$('#ep-bouwer-settings-section-r_photo').show();
			}
			else {
				$('#ep-bouwer-settings-section-r_photo').hide();
			}
		}
	});

})(jQuery);