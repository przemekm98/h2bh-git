(function( $ ) {
	
	/**
	 * Logic for the builder's help tour.
	 *
	 * @class EPBOUWERTour
	 * @since 1.4.9
	 */
	EPBOUWERTour = {
	
		/**
		 * A reference to the Bootstrap Tour object.
		 *
		 * @since 1.4.9
		 * @access private
		 * @property {Tour} _tour
		 */
		_tour: null,
		
		/**
		 * Starts the tour or restarts it if it
		 * has already run.
		 *
		 * @since 1.4.9
		 * @method start
		 */
		start: function()
		{
			if ( ! EPBOUWERTour._tour ) {
				EPBOUWERTour._tour = new Tour( EPBOUWERTour._config() );
				EPBOUWERTour._tour.init();
			}
			else {
				EPBOUWERTour._tour.restart();
			}
			
			EPBOUWERTour._tour.start();
		},
		
		/**
		 * Returns a config object for the tour.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _config
		 * @return {Object}
		 */
		_config: function()
		{
			var config = {
				storage     : false,
				onStart     : EPBOUWERTour._onStart,
				onPrev      : EPBOUWERTour._onPrev,
				onNext      : EPBOUWERTour._onNext,
				onEnd       : EPBOUWERTour._onEnd,
				template    : '<div class="popover" role="tooltip"> <i class="fa fa-times" data-role="end"></i> <div class="arrow"></div> <h3 class="popover-title"></h3> <div class="popover-content"></div> <div class="popover-navigation clearfix"> <button class="ep-bouwer-button ep-bouwer-button-primary ep-bouwer-tour-next" data-role="next">' + EPBOUWERStrings.tourNext + '</button> </div> </div>',
				steps       : [
					{
						animation   : false,
						element     : '.ep-bouwer-bar',
						placement   : 'bottom',
						title       : EPBOUWERStrings.tourTemplatesTitle,
						content     : EPBOUWERStrings.tourTemplates,
						onShown     : function() {
							if ( 0 === $( '.fl-template-selector' ).length ) {
								$( '.popover[class*=tour-]' ).css( 'visibility', 'hidden' );
								EPBOUWER._showTemplateSelector();
							}
							else {
								EPBOUWERTour._templateSelectorLoaded();
							}
						}
					},
					{
						animation   : false,
						element     : '#ep-bouwer-blocks-rows .ep-bouwer-blocks-section-title',
						placement   : 'left',
						title       : EPBOUWERStrings.tourAddRowsTitle,
						content     : EPBOUWERStrings.tourAddRows,
						onShow      : function() {
							EPBOUWERTour._dimSection( 'body' );
							EPBOUWERTour._dimSection( '.ep-bouwer-bar' );
							EPBOUWER._showPanel();
							$( '.fl-template-selector .ep-bouwer-settings-cancel' ).trigger( 'click' );
							$( '#ep-bouwer-blocks-rows .ep-bouwer-blocks-section-title' ).trigger( 'click' );
						}
					},
					{
						animation   : false,
						element     : '#ep-bouwer-blocks-basic .ep-bouwer-blocks-section-title',
						placement   : 'left',
						title       : EPBOUWERStrings.tourAddContentTitle,
						content     : EPBOUWERStrings.tourAddContent,
						onShow      : function() {
							EPBOUWERTour._dimSection( 'body' );
							EPBOUWERTour._dimSection( '.ep-bouwer-bar' );
							EPBOUWER._showPanel();
							$( '#ep-bouwer-blocks-basic .ep-bouwer-blocks-section-title' ).trigger( 'click' );
							$( '.fl-row' ).eq( 0 ).trigger( 'mouseleave' );
							$( '.fl-module' ).eq( 0 ).trigger( 'mouseleave' );
						}
					},
					{
						animation   : false,
						element     : '.fl-row:first-of-type',
						placement   : 'top',
						title       : EPBOUWERStrings.tourEditContentTitle,
						content     : EPBOUWERStrings.tourEditContent,
						onShow      : function() {
							EPBOUWERTour._dimSection( '.ep-bouwer-bar' );
							EPBOUWER._closePanel();
							$( '.fl-row' ).eq( 0 ).trigger( 'mouseenter' );
							$( '.fl-module' ).eq( 0 ).trigger( 'mouseenter' );
						}
					},
					{
						animation   : false,
						element     : '.fl-row:first-of-type .fl-module-overlay .fl-block-overlay-actions',
						placement   : 'top',
						title       : EPBOUWERStrings.tourEditContentTitle,
						content     : EPBOUWERStrings.tourEditContent2,
						onShow      : function() {
							EPBOUWERTour._dimSection( '.ep-bouwer-bar' );
							EPBOUWER._closePanel();
							$( '.fl-row' ).eq( 0 ).trigger( 'mouseenter' );
							$( '.fl-module' ).eq( 0 ).trigger( 'mouseenter' );
						}
					},
					{
						animation   : false,
						element     : '.ep-bouwer-add-content-button',
						placement   : 'bottom',
						title       : EPBOUWERStrings.tourAddContentButtonTitle,
						content     : EPBOUWERStrings.tourAddContentButton,
						onShow      : function() {
							EPBOUWERTour._dimSection( 'body' );
							$( '.fl-row' ).eq( 0 ).trigger( 'mouseleave' );
							$( '.fl-module' ).eq( 0 ).trigger( 'mouseleave' );  
						}
					},
					{
						animation   : false,
						element     : '.ep-bouwer-templates-button',
						placement   : 'bottom',
						title       : EPBOUWERStrings.tourTemplatesButtonTitle,
						content     : EPBOUWERStrings.tourTemplatesButton,
						onShow      : function() {
							EPBOUWERTour._dimSection( 'body' );
						}
					},
					{
						animation   : false,
						element     : '.ep-bouwer-tools-button',
						placement   : 'bottom',
						title       : EPBOUWERStrings.tourToolsButtonTitle,
						content     : EPBOUWERStrings.tourToolsButton,
						onShow      : function() {
							EPBOUWERTour._dimSection( 'body' );
						}
					},
					{
						animation   : false,
						element     : '.ep-bouwer-done-button',
						placement   : 'bottom',
						title       : EPBOUWERStrings.tourDoneButtonTitle,
						content     : EPBOUWERStrings.tourDoneButton,
						onShow      : function() {
							EPBOUWERTour._dimSection( 'body' );
						}
					},
					{
						animation   : false,
						orphan      : true,
						backdrop    : true,
						title       : EPBOUWERStrings.tourFinishedTitle,
						content     : EPBOUWERStrings.tourFinished,
						template    : '<div class="popover" role="tooltip"> <div class="arrow"></div> <i class="fa fa-times" data-role="end"></i> <h3 class="popover-title"></h3> <div class="popover-content"></div> <div class="popover-navigation clearfix"> <button class="ep-bouwer-button ep-bouwer-button-primary ep-bouwer-tour-next" data-role="end">' + EPBOUWERStrings.tourEnd + '</button> </div> </div>',
					}
				]
			};
			
			// Remove the first step if no templates.
			if( EPBOUWERConfig.lite ) {
				config.steps.shift();
			}
			else if ( 'disabled' == EPBOUWERConfig.enabledTemplates ) {
				config.steps.shift();
			}
			else if ( 'ep-bouwer-template' == EPBOUWERConfig.postType ) {
				config.steps.shift();
			}
			
			return config;
		},
		
		/**
		 * Callback for when the tour starts.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _onStart
		 */
		_onStart: function()
		{
			var body = $( 'body' );
			
			body.append( '<div class="ep-bouwer-tour-mask"></div>' );
			body.on( 'ep-bouwer.template-selector-loaded', EPBOUWERTour._templateSelectorLoaded );
			
			if ( 0 === $( '.fl-row' ).length ) {
				$( '.ep-bouwer-content' ).append( '<div class="ep-bouwer-tour-demo-content fl-row fl-row-fixed-width fl-row-bg-none"> <div class="fl-row-content-wrap"> <div class="fl-row-content fl-row-fixed-width fl-node-content"> <div class="fl-col-group"> <div class="fl-col" style="width:100%"> <div class="fl-col-content fl-node-content"> <div class="fl-module fl-module-rich-text" data-type="rich-text" data-name="Text Editor"> <div class="fl-module-content fl-node-content"> <div class="fl-rich-text"> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pellentesque ut lorem non cursus. Sed mauris nunc, porttitor iaculis lorem a, sollicitudin lacinia sapien. Proin euismod orci lacus, et sollicitudin leo posuere ac. In hac habitasse platea dictumst. Maecenas elit magna, consequat in turpis suscipit, ultrices rhoncus arcu. Phasellus finibus sapien nec elit tempus venenatis. Maecenas tincidunt sapien non libero maximus, in aliquam felis tincidunt. Mauris mollis ultricies facilisis. Duis condimentum dignissim tortor sit amet facilisis. Aenean gravida lacus eu risus molestie egestas. Donec ut dolor dictum, fringilla metus malesuada, viverra nunc. Maecenas ut purus ac justo aliquet lacinia. Cras vestibulum elementum tincidunt. Maecenas mattis tortor neque, consectetur dignissim neque tempor nec.</p></div> </div> </div> </div> </div> </div> </div> </div> </div>' );
				EPBOUWER._setupEmptyLayout();
				EPBOUWER._highlightEmptyCols();
			}
		},
		
		/**
		 * Callback for when the tour is navigated
		 * to the previous step.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _onPrev
		 */
		_onPrev: function()
		{
			$( '.ep-bouwer-tour-dimmed' ).remove();
		},
		
		/**
		 * Callback for when the tour is navigated
		 * to the next step.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _onNext
		 */
		_onNext: function()
		{
			$( '.ep-bouwer-tour-dimmed' ).remove();
		},
		
		/**
		 * Callback for when the tour ends.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _onEnd
		 */
		_onEnd: function()
		{
			$( 'body' ).off( 'ep-bouwer.template-selector-loaded' );
			$( '.ep-bouwer-tour-mask' ).remove();
			$( '.ep-bouwer-tour-dimmed' ).remove();
			$( '.ep-bouwer-tour-demo-content' ).remove();

			EPBOUWER._setupEmptyLayout();
			EPBOUWER._highlightEmptyCols();
			EPBOUWER._showPanel();
			EPBOUWER._initTemplateSelector();
		},
		
		/**
		 * Dims a section of the page.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _dimSection
		 * @param {String} selector A CSS selector for the section to dim.
		 */
		_dimSection: function( selector )
		{
			$( selector ).find( '.ep-bouwer-tour-dimmed' ).remove();
			$( selector ).append( '<div class="ep-bouwer-tour-dimmed"></div>' );
		},
		
		/**
		 * Fires when the template selector loads
		 * and positions the popup.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _templateSelectorLoaded
		 */
		_templateSelectorLoaded: function()
		{
			var header = $( '.ep-bouwer-settings-lightbox .fl-lightbox-header' ),
				height = header.height(),
				top    = header.offset().top + 75;
			
			$( '.popover[class*=tour-]' ).css({
				top: ( top + height) + 'px',
				visibility: 'visible'
			});
		}
	};

})( jQuery );