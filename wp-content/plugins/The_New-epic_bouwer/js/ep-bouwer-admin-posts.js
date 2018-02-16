(function($){

	/**
	 * Helper class for dealing with the post edit screen.
	 *
	 * @class EPBOUWERAdminPosts
	 * @since 1.0
	 * @static
	 */
	EPBOUWERAdminPosts = {
		
		/**
		 * Initializes the builder for the post edit screen. 
		 *
		 * @since 1.0
		 * @method init
		 */
		init: function()
		{
			$('.fl-enable-editor').on('click', this._enableEditorClicked);
			$('.fl-enable-builder').on('click', this._enableBuilderClicked);
			$('.fl-launch-builder').on('click', this._launchBuilderClicked);
			
			/* WPML Support */
			$('#icl_cfo').on('click', this._wpmlCopyClicked);
		},
		
		/**
		 * Fires when the text editor button is clicked 
		 * and switches the current post to use that 
		 * instead of the builder. 
		 *
		 * @since 1.0
		 * @access private
		 * @method _enableEditorClicked
		 */        
		_enableEditorClicked: function()
		{
			if ( ! $( 'body' ).hasClass( 'ep-bouwer-enabled' ) ) {
				return;
			}
			if ( confirm( EPBOUWERAdminPostsStrings.switchToEditor ) ) {
			
				$('.ep-bouwer-admin-tabs a').removeClass('fl-active');
				$(this).addClass('fl-active');
				
				EPBOUWERAdminPosts.ajax({
					action: 'ep_bouwer_save',
					method: 'disable',
				}, EPBOUWERAdminPosts._enableEditorComplete);
			}
		},
 
		/**
		 * Callback for enabling the editor.
		 *
		 * @since 1.0
		 * @access private
		 * @method _enableEditorComplete
		 */          
		_enableEditorComplete: function()
		{
			$('body').removeClass('ep-bouwer-enabled');
			$(window).resize();
		},

		/**
		 * Callback for enabling the editor.
		 *
		 * @since 1.0
		 * @access private
		 * @method _enableBuilderClicked
		 */         
		_enableBuilderClicked: function()
		{
			if($('body').hasClass('ep-bouwer-enabled')) {
				return;
			}
			else {
				$('.ep-bouwer-admin-tabs a').removeClass('fl-active');
				$(this).addClass('fl-active');
				EPBOUWERAdminPosts._launchBuilder();
			}
		},

		/**
		 * Fires when the page builder button is clicked 
		 * and switches the current post to use that 
		 * instead of the text editor. 
		 *
		 * @since 1.0
		 * @access private
		 * @method _launchBuilderClicked
		 * @param {Object} e An event object.
		 */   
		_launchBuilderClicked: function(e)
		{
			e.preventDefault();
			
			EPBOUWERAdminPosts._launchBuilder();
		},

		/**
		 * Callback for enabling the builder.
		 *
		 * @since 1.0
		 * @access private
		 * @method _launchBuilder
		 */   
		_launchBuilder: function()
		{
			var redirect = $('.fl-launch-builder').attr('href'),
				title    = $('#title');
			
			if(typeof title !== 'undefined' && title.val() == '') {
				title.val('Post #' + $('#post_ID').val());
			}
			
			$(window).off('beforeunload');
			$('body').addClass('ep-bouwer-enabled');
			$('.ep-bouwer-loading').show();
			$('form#post').append('<input type="hidden" name="ep-bouwer-redirect" value="' + redirect + '" />');
			$('form#post').submit();
		},
		
		/**
		 * Fires when the WPML copy button is clicked.
		 *
		 * @since 1.1.7
		 * @access private
		 * @method _wpmlCopyClicked
		 * @param {Object} e An event object.
		 */   
		_wpmlCopyClicked: function(e)
		{
			var originalPostId = $('#icl_translation_of').val();
			
			if(typeof originalPostId !== 'undefined') {
			
				$('.ep-bouwer-loading').show();
				
				EPBOUWERAdminPosts.ajax({
					action: 'ep_bouwer_save',
					method: 'duplicate_wpml_layout',
					original_post_id: originalPostId
				}, EPBOUWERAdminPosts._wpmlCopyComplete);
			}
		},
		
		/**
		 * Callback for when the WPML copy button is clicked.
		 *
		 * @since 1.1.7
		 * @access private
		 * @method _wpmlCopyComplete
		 * @param {String} response The JSON encoded response.
		 */   
		_wpmlCopyComplete: function(response)
		{
			var response = JSON.parse(response);
			
			$('.ep-bouwer-loading').hide();
			
			if(response.has_layout && response.enabled) {
				$('body').addClass('ep-bouwer-enabled');
			}
		},

		/**
		 * Makes an AJAX request.
		 *
		 * @since 1.0
		 * @method ajax
		 * @param {Object} data An object with data to send in the request.
		 * @param {Function} callback A function to call when the request is complete.
		 */   
		ajax: function(data, callback)
		{
			data.post_id = $('#post_ID').val();
			
			$('.ep-bouwer-loading').show();
			
			$.post(ajaxurl, data, function(response) {

				EPBOUWERAdminPosts._ajaxComplete();
			
				if(typeof callback !== 'undefined') {
					callback.call(this, response);
				}
			});
		},

		/**
		 * Generic callback for when an AJAX request is complete.
		 *
		 * @since 1.0
		 * @access private
		 * @method _ajaxComplete
		 */   
		_ajaxComplete: function()
		{
			$('.ep-bouwer-loading').hide();
		}
	};

	/* Initializes the post edit screen. */
	$(function(){
		EPBOUWERAdminPosts.init();
	});

})(jQuery);