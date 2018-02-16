(function($){

	/**
	 * The main builder interface class.
	 * 
	 * @since 1.0
	 * @class EPBOUWER
	 */
	EPBOUWER = {
	
		/**
		 * An instance of EPBOUWERPreview for working
		 * with the current live preview.
		 *
		 * @since 1.3.3
		 * @property {EPBOUWERPreview} preview
		 */
		preview                     : null,
	
		/**
		 * An instance of FLLightbox for displaying a list
		 * of actions a user can take such as publish or cancel.
		 *
		 * @since 1.0
		 * @access private
		 * @property {FLLightbox} _actionsLightbox
		 */
		_actionsLightbox            : null,
		
		/**
		 * A jQuery reference to a module element that should be
		 * added to a new row after it has been rendered.
		 *
		 * @since 1.0
		 * @access private
		 * @property {Object} _addModuleAfterRowRender
		 */
		_addModuleAfterRowRender    : null,
		
		/**
		 * The CSS class of the main content wrapper for the
		 * current layout that is being worked on.
		 *
		 * @since 1.0
		 * @access private
		 * @property {String} _contentClass
		 */
		_contentClass               : false,
		
		/**
		 * Whether dragging has been enabled or not.
		 *
		 * @since 1.0
		 * @access private
		 * @property {Boolean} _dragEnabled
		 */
		_dragEnabled                : false,
		
		/**
		 * Whether an element is currently being dragged or not.
		 *
		 * @since 1.0
		 * @access private
		 * @property {Boolean} _dragging
		 */
		_dragging                   : false,
		
		/**
		 * The URL to redirect to when a user leaves the builder.
		 *
		 * @since 1.0
		 * @access private
		 * @property {String} _exitUrl
		 */
		_exitUrl                    : null,
		
		/**
		 * An instance of FLLightbox for displaying settings.
		 *
		 * @since 1.0
		 * @access private
		 * @property {FLLightbox} _lightbox
		 */
		_lightbox                   : null,
		
		/**
		 * A timeout for refreshing the height of lightbox scrollbars
		 * in case the content changes from dynamic settings.
		 *
		 * @since 1.0
		 * @access private
		 * @property {Object} _lightboxScrollbarTimeout
		 */
		_lightboxScrollbarTimeout   : null,
		
		/**
		 * An array that's used to cache which module settings
		 * CSS and JS assets have already been loaded so they
		 * are only loaded once.
		 * 
		 * @since 1.0
		 * @access private
		 * @property {Array} _loadedModuleAssets
		 */
		_loadedModuleAssets         : [],
		
		/**
		 * An object used to store module settings helpers.
		 * 
		 * @since 1.0
		 * @access private
		 * @property {Object} _moduleHelpers
		 */
		_moduleHelpers              : {},
		
		/**
		 * An instance of wp.media used to select multiple photos.
		 * 
		 * @since 1.0
		 * @access private
		 * @property {Object} _multiplePhotoSelector
		 */
		_multiplePhotoSelector      : null,
		
		/**
		 * A jQuery reference to a row that a new column group
		 * should be added to once it's finished rendering.
		 * 
		 * @since 1.0
		 * @access private
		 * @property {Object} _newColGroupParent
		 */
		_newColGroupParent          : null,
		
		/**
		 * The position a column group should be added to within
		 * a row once it finishes rendering.
		 * 
		 * @since 1.0
		 * @access private
		 * @property {Number} _newColGroupPosition
		 */
		_newColGroupPosition        : 0,
		
		/**
		 * The position a row should be added to within
		 * the layout once it finishes rendering.
		 * 
		 * @since 1.0
		 * @access private
		 * @property {Number} _newRowPosition
		 */
		_newRowPosition             : 0,
		
		/**
		 * The ID of a template that the user has selected.
		 * 
		 * @since 1.0
		 * @access private
		 * @property {Number} _selectedTemplateId
		 */
		_selectedTemplateId         : null,
		
		/**
		 * The type of template that the user has selected.
		 * Possible values are "core" or "user".
		 * 
		 * @since 1.0
		 * @access private
		 * @property {String} _selectedTemplateType
		 */ 
		_selectedTemplateType       : null,
		
		/**
		 * An instance of wp.media used to select a single photo.
		 * 
		 * @since 1.0
		 * @access private
		 * @property {Object} _singlePhotoSelector
		 */ 
		_singlePhotoSelector        : null,
		
		/**
		 * An instance of wp.media used to select a single video.
		 * 
		 * @since 1.0
		 * @access private
		 * @property {Object} _singleVideoSelector
		 */ 
		_singleVideoSelector        : null,
		
		/**
		 * Whether the current AJAX update is silent or not. Silent
		 * updates occur without blocking the page with the loading
		 * overlay. If another AJAX request is made during a silent 
		 * update, the loading overlay will be shown and the data for
		 * the second request will be stored so it can be made when 
		 * the silent update completes.
		 * 
		 * @since 1.0
		 * @access private
		 * @property {Boolean} _silentUpdate
		 */ 
		_silentUpdate               : false,
		
		/**
		 * Data for an AJAX request that should be made once a silent
		 * update has completed.
		 * 
		 * @since 1.0
		 * @access private
		 * @property {Object} _silentUpdateCallbackData
		 */ 
		_silentUpdateCallbackData   : null,
	
		/**
		 * Initializes the builder interface.
		 *
		 * @since 1.0
		 * @access private
		 * @method _init
		 */
		_init: function()
		{
			EPBOUWER._initJQueryReadyFix();
			EPBOUWER._initGlobalErrorHandling();
			EPBOUWER._initPostLock();
			EPBOUWER._initClassNames();
			EPBOUWER._initMediaUploader();
			EPBOUWER._initOverflowFix();
			EPBOUWER._initScrollbars();
			EPBOUWER._initLightboxes();
			EPBOUWER._initSortables();
			EPBOUWER._initCoreTemplateSettings();
			EPBOUWER._bindEvents();
			EPBOUWER._bindOverlayEvents();
			EPBOUWER._setupEmptyLayout();
			EPBOUWER._highlightEmptyCols();
			EPBOUWER._showTourOrTemplates();
		},
		
		/**
		 * Prevent errors thrown in jQuery's ready function
		 * from breaking subsequent ready calls. 
		 *
		 * @since 1.4.6
		 * @access private
		 * @method _initJQueryReadyFix
		 */
		_initJQueryReadyFix: function()
		{
			if ( EPBOUWERConfig.debug ) {
				return;
			}
			
			jQuery.fn.oldReady = jQuery.fn.ready;
			
			jQuery.fn.ready = function( fn ) {
				return jQuery.fn.oldReady( function() {
					try {
						if ( 'function' == typeof fn ) {
							fn();
						}
					}
					catch ( e ){
						EPBOUWER.logError( e );
					}
				});
			};
		},
		
		/**
		 * Try to prevent errors from third party plugins
		 * from breaking the builder.
		 *
		 * @since 1.4.6
		 * @access private
		 * @method _initGlobalErrorHandling
		 */
		_initGlobalErrorHandling: function()
		{
			if ( EPBOUWERConfig.debug ) {
				return;
			}
			
			window.onerror = function( message, file, line, col, error ) {
				EPBOUWER.logGlobalError( message, file, line, col, error );
				return true;
			};
		},
		
		/**
		 * Send a wp.heartbeat request to lock editing of this
		 * post so it can only be edited by the current user.
		 *
		 * @since 1.0.6
		 * @access private
		 * @method _initPostLock
		 */
		_initPostLock: function()
		{
			if(typeof wp.heartbeat != 'undefined') {
			
				wp.heartbeat.interval(30);
				
				wp.heartbeat.enqueue('ep_bouwer_post_lock', {
					post_id: $('#fl-post-id').val()
				});
			}
		},
		
		/**
		 * Initializes html and body classes as well as the
		 * builder content class for this post.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initClassNames
		 */
		_initClassNames: function()
		{
			$('html').addClass('ep-bouwer-edit');
			$('body').addClass('ep-bouwer');
			
			if(EPBOUWERConfig.simpleUi) {
				$('body').addClass('ep-bouwer-simple');
			}
			
			EPBOUWER._contentClass = '.ep-bouwer-content-' + EPBOUWERConfig.postId;
		},
		
		/**
		 * Initializes the WordPress media uploader so any files
		 * uploaded will be attached to the current post.
		 *
		 * @since 1.2.2
		 * @access private
		 * @method _initMediaUploader
		 */
		_initMediaUploader: function()
		{
			wp.media.model.settings.post.id = $('#fl-post-id').val();
		},
		
		/**
		 * Third party themes that set their content wrappers to
		 * overflow:hidden break builder overlays. We set them
		 * to overflow:visible while editing.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initOverflowFix
		 */
		_initOverflowFix: function()
		{
			$(EPBOUWER._contentClass).parents().css('overflow', 'visible');
		},
		
		/**
		 * Initializes Nano Scroller scrollbars for the 
		 * builder interface.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initScrollbars
		 */
		_initScrollbars: function()
		{
			$('.fl-nanoscroller').nanoScroller({
				alwaysVisible: true,
				preventPageScrolling: true,
				paneClass: 'fl-nanoscroller-pane',
				sliderClass: 'fl-nanoscroller-slider',
				contentClass: 'fl-nanoscroller-content'
			});
		},
		
		/**
		 * Initializes the lightboxes for the builder interface.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initLightboxes
		 */
		_initLightboxes: function()
		{
			/* Main builder lightbox */
			EPBOUWER._lightbox = new FLLightbox({
				className: 'ep-bouwer-lightbox ep-bouwer-settings-lightbox'
			});
			
			EPBOUWER._lightbox.on('close', EPBOUWER._lightboxClosed);
			
			/* Actions lightbox */
			EPBOUWER._actionsLightbox = new FLLightbox({
				className: 'ep-bouwer-actions-lightbox'
			});
		},
		
		/**
		 * Initializes jQuery sortables for drag and drop.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initSortables
		 */
		_initSortables: function()
		{
			var defaults = {
				appendTo: 'body',
				cursor: 'move',
				cursorAt: {
					left: 25, 
					top: 20
				},
				distance: 1,
				helper: EPBOUWER._blockDragHelper,
				start : EPBOUWER._blockDragStart,
				sort: EPBOUWER._blockDragSort,
				placeholder: 'ep-bouwer-drop-zone',
				tolerance: 'intersect'
			};
			
			// Row layouts from the builder panel.
			$('.ep-bouwer-rows').sortable($.extend({}, defaults, {
				connectWith: EPBOUWER._contentClass + ', ' + 
							 EPBOUWER._contentClass + ' .fl-row-content',
				items: '.ep-bouwer-block-row',
				stop: EPBOUWER._rowDragStop
			}));
			
			// Modules from the builder panel.
			$('.ep-bouwer-modules, .ep-bouwer-widgets').sortable($.extend({}, defaults, {
				connectWith: EPBOUWER._contentClass + ', ' + 
							 EPBOUWER._contentClass + ' .fl-row-content, ' + 
							 EPBOUWER._contentClass + ' .fl-col-content',
				items: '.ep-bouwer-block-module',
				stop: EPBOUWER._moduleDragStop
			}));
			
			// Row position.
			$(EPBOUWER._contentClass).sortable($.extend({}, defaults, {
				handle: '.fl-row-overlay .fl-block-overlay-actions .fl-block-move',
				helper: EPBOUWER._rowDragHelper,
				items: '.fl-row',
				stop: EPBOUWER._rowDragStop
			}));
			
			// Column group position.
			$(EPBOUWER._contentClass + ' .fl-row-content').sortable($.extend({}, defaults, {
				handle: '.fl-row-overlay .fl-block-overlay-actions .fl-block-move',
				helper: EPBOUWER._rowDragHelper,
				items: '.fl-col-group',
				stop: EPBOUWER._rowDragStop
			}));
			
			// Module position.
			$(EPBOUWER._contentClass + ' .fl-col-content').sortable($.extend({}, defaults, {
				connectWith: EPBOUWER._contentClass + ', ' + 
							 EPBOUWER._contentClass + ' .fl-row-content, ' + 
							 EPBOUWER._contentClass + ' .fl-col-content',
				handle: '.fl-module-overlay .fl-block-overlay-actions .fl-block-move',
				helper: EPBOUWER._moduleDragHelper,
				items: '.fl-module',
				stop: EPBOUWER._moduleDragStop
			}));
		},
		
		/**
		 * Binds most of the events for the builder interface.
		 *
		 * @since 1.0
		 * @access private
		 * @method _bindEvents
		 */
		_bindEvents: function()
		{
			/* Links */
			$('a').on('click', EPBOUWER._linkClicked);
			$('.fl-page-nav .nav a').on('click', EPBOUWER._headerLinkClicked);
			
			/* Heartbeat */
			$(document).on('heartbeat-tick', EPBOUWER._initPostLock);
			
			/* Unload Warning */
			$(window).on('beforeunload', EPBOUWER._warnBeforeUnload);  
			
			/* Bar */
			$('.ep-bouwer-tools-button').on('click', EPBOUWER._toolsClicked);
			$('.ep-bouwer-done-button').on('click', EPBOUWER._doneClicked);
			$('.ep-bouwer-add-content-button').on('click', EPBOUWER._showPanel);
			$('.ep-bouwer-templates-button').on('click', EPBOUWER._changeTemplateClicked);
			$('.ep-bouwer-upgrade-button').on('click', EPBOUWER._upgradeClicked);
			$('.ep-bouwer-help-button').on('click', EPBOUWER._helpButtonClicked);
			
			/* Panel */
			$('.ep-bouwer-panel-actions .ep-bouwer-panel-close').on('click', EPBOUWER._closePanel);
			$('.ep-bouwer-blocks-section-title').on('click', EPBOUWER._blockSectionTitleClicked);
			
			/* Drag and Drop */
			$('body').delegate('.ep-bouwer-block', 'mousedown', EPBOUWER._blockDragInit);
			$('body').on('mouseup', EPBOUWER._blockDragCancel);
			
			/* Actions Lightbox */
			$('body').delegate('.ep-bouwer-actions .ep-bouwer-cancel-button', 'click', EPBOUWER._cancelButtonClicked);
			
			/* Save Actions */
			$('body').delegate('.ep-bouwer-save-actions .ep-bouwer-publish-button', 'click', EPBOUWER._publishButtonClicked);
			$('body').delegate('.ep-bouwer-save-actions .ep-bouwer-draft-button', 'click', EPBOUWER._draftButtonClicked);
			$('body').delegate('.ep-bouwer-save-actions .ep-bouwer-discard-button', 'click', EPBOUWER._discardButtonClicked);
			
			/* Tools Actions */
			$('body').delegate('.ep-bouwer-duplicate-page-button', 'click', EPBOUWER._duplicatePageClicked);
			$('body').delegate('.ep-bouwer-save-user-template-button', 'click', EPBOUWER._saveUserTemplateClicked);
			$('body').delegate('.ep-bouwer-global-settings-button', 'click', EPBOUWER._globalSettingsClicked);
			$('body').delegate('.ep-bouwer-global-settings .ep-bouwer-settings-save', 'click', EPBOUWER._saveGlobalSettingsClicked);
			
			/* Template Selector */
			$('body').delegate('.fl-template-category-select', 'change', EPBOUWER._templateCategoryChanged);
			$('body').delegate('.fl-template-preview', 'click', EPBOUWER._templateClicked);
			$('body').delegate('.fl-user-template', 'click', EPBOUWER._userTemplateClicked);
			$('body').delegate('.fl-user-template-edit', 'click', EPBOUWER._editUserTemplateClicked);
			$('body').delegate('.fl-user-template-delete', 'click', EPBOUWER._deleteUserTemplateClicked);
			$('body').delegate('.ep-bouwer-template-replace-button', 'click', EPBOUWER._templateReplaceClicked);
			$('body').delegate('.ep-bouwer-template-append-button', 'click', EPBOUWER._templateAppendClicked);
			$('body').delegate('.ep-bouwer-template-actions .ep-bouwer-cancel-button', 'click', EPBOUWER._templateCancelClicked);
			
			/* User Template Settings */
			$('body').delegate('.ep-bouwer-user-template-settings .ep-bouwer-settings-save', 'click', EPBOUWER._saveUserTemplateSettings);
			
			/* Help Actions */
			$('body').delegate('.ep-bouwer-help-tour-button', 'click', EPBOUWER._startHelpTour);
			$('body').delegate('.ep-bouwer-help-video-button', 'click', EPBOUWER._watchVideoClicked);
			$('body').delegate('.ep-bouwer-knowledge-base-button', 'click', EPBOUWER._viewKnowledgeBaseClicked);
			$('body').delegate('.ep-bouwer-forums-button', 'click', EPBOUWER._visitForumsClicked);
			
			/* Welcome Actions */
			$('body').delegate('.ep-bouwer-no-tour-button', 'click', EPBOUWER._noTourButtonClicked);
			$('body').delegate('.ep-bouwer-yes-tour-button', 'click', EPBOUWER._yesTourButtonClicked);
			
			/* Alert Lightbox */
			$('body').delegate('.ep-bouwer-alert-close', 'click', EPBOUWER._alertClose);
			
			/* Rows */
			$('body').delegate('.fl-row-overlay .fl-block-remove', 'click', EPBOUWER._deleteRowClicked);
			$('body').delegate('.fl-row-overlay .fl-block-copy', 'click', EPBOUWER._rowCopyClicked);
			$('body').delegate('.fl-row-overlay .fl-block-settings', 'click', EPBOUWER._rowSettingsClicked);
			$('body').delegate('.fl-row-overlay .fl-block-move', 'mousedown', EPBOUWER._blockDragInit);
			$('body').delegate('.ep-bouwer-row-settings .ep-bouwer-settings-save', 'click', EPBOUWER._saveSettings);
			
			/* Columns */
			$('body').delegate('.fl-col-overlay', 'click', EPBOUWER._colSettingsClicked);
			$('body').delegate('.fl-col-overlay .fl-block-settings', 'click', EPBOUWER._colSettingsClicked);
			$('body').delegate('.ep-bouwer-col-settings .ep-bouwer-settings-save', 'click', EPBOUWER._saveSettings);
			$('body').delegate('.fl-col-overlay .fl-block-remove', 'click', EPBOUWER._deleteColClicked);
			
			/* Modules */
			$('body').delegate('.fl-module-overlay .fl-block-remove', 'click', EPBOUWER._deleteModuleClicked);
			$('body').delegate('.fl-module-overlay .fl-block-copy', 'click', EPBOUWER._moduleCopyClicked);
			$('body').delegate('.fl-module-overlay .fl-block-move', 'mousedown', EPBOUWER._blockDragInit);
			$('body').delegate('.fl-module-overlay .fl-block-columns', 'click', EPBOUWER._colSettingsClicked);
			$('body').delegate('.fl-module-overlay .fl-block-settings', 'click', EPBOUWER._moduleSettingsClicked);
			$('body').delegate('.fl-module-overlay', 'click', EPBOUWER._moduleSettingsClicked);
			$('body').delegate('.ep-bouwer-module-settings .ep-bouwer-settings-save', 'click', EPBOUWER._saveModuleClicked);
			
			/* Settings */
			$('body').delegate('.ep-bouwer-settings-tabs a', 'click', EPBOUWER._settingsTabClicked);
			$('body').delegate('.ep-bouwer-settings-cancel', 'click', EPBOUWER._settingsCancelClicked);
			
			/* Tooltips */
			$('body').delegate('.fl-help-tooltip-icon', 'mouseover', EPBOUWER._showHelpTooltip);
			$('body').delegate('.fl-help-tooltip-icon', 'mouseout', EPBOUWER._hideHelpTooltip);
			
			/* Multiple Fields */
			$('body').delegate('.ep-bouwer-field-add', 'click', EPBOUWER._addFieldClicked);
			$('body').delegate('.ep-bouwer-field-copy', 'click', EPBOUWER._copyFieldClicked);
			$('body').delegate('.ep-bouwer-field-delete', 'click', EPBOUWER._deleteFieldClicked);
			
			/* Select Fields */
			$('body').delegate('.ep-bouwer-settings-fields select', 'change', EPBOUWER._settingsSelectChanged);
			
			/* Photo Fields */
			$('body').delegate('.fl-photo-field .fl-photo-select', 'click', EPBOUWER._selectSinglePhoto);
			$('body').delegate('.fl-photo-field .fl-photo-edit', 'click', EPBOUWER._selectSinglePhoto);
			$('body').delegate('.fl-photo-field .fl-photo-replace', 'click', EPBOUWER._selectSinglePhoto);
			
			/* Multiple Photo Fields */
			$('body').delegate('.fl-multiple-photos-field .fl-multiple-photos-select', 'click', EPBOUWER._selectMultiplePhotos);
			$('body').delegate('.fl-multiple-photos-field .fl-multiple-photos-edit', 'click', EPBOUWER._selectMultiplePhotos);
			$('body').delegate('.fl-multiple-photos-field .fl-multiple-photos-add', 'click', EPBOUWER._selectMultiplePhotos);
			
			/* Video Fields */
			$('body').delegate('.fl-video-field .fl-video-select', 'click', EPBOUWER._selectSingleVideo);
			$('body').delegate('.fl-video-field .fl-video-replace', 'click', EPBOUWER._selectSingleVideo);
			
			/* Icon Fields */
			$('body').delegate('.fl-icon-field .fl-icon-select', 'click', EPBOUWER._selectIcon);
			$('body').delegate('.fl-icon-field .fl-icon-replace', 'click', EPBOUWER._selectIcon);
			$('body').delegate('.fl-icon-field .fl-icon-remove', 'click', EPBOUWER._removeIcon);
			
			/* Settings Form Fields */
			$('body').delegate('.fl-form-field .fl-form-field-edit', 'click', EPBOUWER._formFieldClicked);
			$('body').delegate('.fl-form-field-settings .ep-bouwer-settings-save', 'click', EPBOUWER._saveFormFieldClicked);
			
			/* Layout Fields */
			$('body').delegate('.fl-layout-field-option', 'click', EPBOUWER._layoutFieldClicked);
			
			/* Links Fields */
			$('body').delegate('.fl-link-field-select', 'click', EPBOUWER._linkFieldSelectClicked);
			$('body').delegate('.fl-link-field-search-cancel', 'click', EPBOUWER._linkFieldSelectCancelClicked);
			
			/* Loop Builder Fields */
			$('body').delegate('.fl-loop-builder select[name=post_type]', 'change', EPBOUWER._loopBuilderPostTypeChange);
		},
		
		/**
		 * Binds the events for overlays that appear when 
		 * mousing over a row, column or module.
		 *
		 * @since 1.0
		 * @access private
		 * @method _bindOverlayEvents
		 */
		_bindOverlayEvents: function()
		{
			var content = $(EPBOUWER._contentClass);
			
			content.delegate('.fl-row', 'mouseenter', EPBOUWER._rowMouseenter);
			content.delegate('.fl-row', 'mouseleave', EPBOUWER._rowMouseleave);
			content.delegate('.fl-row-overlay', 'mouseleave', EPBOUWER._rowMouseleave);
			content.delegate('.fl-col', 'mouseenter', EPBOUWER._colMouseenter);
			content.delegate('.fl-col', 'mouseleave', EPBOUWER._colMouseleave);
			content.delegate('.fl-module', 'mouseenter', EPBOUWER._moduleMouseenter);
			content.delegate('.fl-module', 'mouseleave', EPBOUWER._moduleMouseleave);
		},
		
		/**
		 * Unbinds the events for overlays that appear when 
		 * mousing over a row, column or module.
		 *
		 * @since 1.0
		 * @access private
		 * @method _destroyOverlayEvents
		 */
		_destroyOverlayEvents: function()
		{
			var content = $(EPBOUWER._contentClass);
			
			content.undelegate('.fl-row', 'mouseenter', EPBOUWER._rowMouseenter);
			content.undelegate('.fl-row', 'mouseleave', EPBOUWER._rowMouseleave);
			content.undelegate('.fl-row-overlay', 'mouseleave', EPBOUWER._rowMouseleave);
			content.undelegate('.fl-col', 'mouseenter', EPBOUWER._colMouseenter);
			content.undelegate('.fl-col', 'mouseleave', EPBOUWER._colMouseleave);
			content.undelegate('.fl-module', 'mouseenter', EPBOUWER._moduleMouseenter);
			content.undelegate('.fl-module', 'mouseleave', EPBOUWER._moduleMouseleave);
		},
		
		/**
		 * Disables the default behavior for all links on the page.
		 *
		 * @since 1.0
		 * @access private
		 * @method _linkClicked
		 * @param {Object} e The event object.
		 */
		_linkClicked: function(e)
		{
			e.preventDefault();
		},
		
		/**
		 * Launches the builder for another page if a link in the
		 * builder theme header is clicked.
		 *
		 * @since 1.3.9
		 * @access private
		 * @method _headerLinkClicked
		 * @param {Object} e The event object.
		 */
		_headerLinkClicked: function(e)
		{
			var link = $(this),
				href = link.attr('href');
			
			e.preventDefault();
			
			if ( 'ep-bouwer-template' == EPBOUWERConfig.postType )  {
				return;
			}
			
			EPBOUWER._exitUrl = href.indexOf('?') > -1 ? href : href + '?ep_bouwer';
			EPBOUWER._doneClicked();
		},
		
		/**
		 * Warns the user that their changes won't be saved if
		 * they leave the page while editing settings.
		 *
		 * @since 1.0.6
		 * @access private
		 * @method _warnBeforeUnload
		 * @return {String} The warning message.
		 */ 
		_warnBeforeUnload: function()
		{
			var rowSettings     = $('.ep-bouwer-row-settings').length > 0,
				colSettings     = $('.ep-bouwer-col-settings').length > 0,
				moduleSettings  = $('.ep-bouwer-module-settings').length > 0;
			
			if(rowSettings || colSettings || moduleSettings) {
				return EPBOUWERStrings.unloadWarning;
			}
		},
		
		/* TipTips
		----------------------------------------------------------*/
		
		/**
		 * Initializes tooltip help messages.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _initTipTips
		 */
		_initTipTips: function()
		{
			$('.fl-tip').tipTip();
		},
		
		/**
		 * Removes all tooltip help messages from the screen.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _hideTipTips
		 */
		_hideTipTips: function()
		{
			$('#tiptip_holder').stop().remove();
		},
		
		/* Bar
		----------------------------------------------------------*/
		
		/**
		 * Shows the actions lightbox when the tools button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _toolsClicked
		 */
		_toolsClicked: function()
		{
			var buttons             = {},
				lite                = EPBOUWERConfig.lite,
				postType            = EPBOUWERConfig.postType,
				enabledTemplates    = EPBOUWERConfig.enabledTemplates;
				
			// Duplicate button
			if(postType == 'ep-bouwer-template') {
				if ( typeof window.opener == 'undefined' || ! window.opener ) {
					buttons['duplicate-page'] = EPBOUWERStrings.duplicateTemplate;
				}
			}
			else {
				buttons['duplicate-page'] = EPBOUWERStrings.duplicatePage;
			}
			
			// Template buttons
			if(!lite && postType != 'ep-bouwer-template' && (enabledTemplates == 'enabled' || enabledTemplates == 'user')) {
			
				buttons['save-user-template'] = EPBOUWERStrings.saveTemplate;
				
				if('undefined' != typeof EPBOUWERTemplateSettings) {
					buttons['save-template'] = EPBOUWERStrings.saveCoreTemplate;
				}
			}
			
			// Global settings button 
			buttons['global-settings'] = EPBOUWERStrings.editGlobalSettings;
				
			EPBOUWER._showActionsLightbox({
				'className' : 'ep-bouwer-tools-actions',
				'title'     : EPBOUWERStrings.actionsLightboxTitle,
				'buttons'   : buttons
			});
		},
		
		/**
		 * Shows the actions lightbox when the done button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _doneClicked
		 */
		_doneClicked: function()
		{
			EPBOUWER._showActionsLightbox({
				'className': 'ep-bouwer-save-actions',
				'title': EPBOUWERStrings.actionsLightboxTitle,
				'buttons': {
					'publish': EPBOUWERStrings.publish,
					'draft': EPBOUWERStrings.draft,
					'discard': EPBOUWERStrings.discard
				}
			});
		},
		
		/**
		 * Opens a new window with the upgrade URL when the 
		 * upgrade button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _upgradeClicked
		 */
		_upgradeClicked: function()
		{
			window.open(EPBOUWERConfig.upgradeUrl);
		},
		
		/**
		 * Shows the actions lightbox when the help button is clicked.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _helpButtonClicked
		 */
		_helpButtonClicked: function()
		{
			var buttons = {};
			
			if ( EPBOUWERConfig.help.tour ) {
				buttons['help-tour'] = EPBOUWERStrings.takeHelpTour;
			}
			if ( EPBOUWERConfig.help.video ) {
				buttons['help-video'] = EPBOUWERStrings.watchHelpVideo;
			}
			if ( EPBOUWERConfig.help.knowledge_base ) {
				buttons['knowledge-base'] = EPBOUWERStrings.viewKnowledgeBase;
			}
			if ( EPBOUWERConfig.help.forums ) {
				buttons['forums'] = EPBOUWERStrings.visitForums;
			}
			
			EPBOUWER._showActionsLightbox({
				'className': 'ep-bouwer-help-actions',
				'title': EPBOUWERStrings.actionsLightboxTitle,
				'buttons': buttons
			});
		},
		
		/* Panel
		----------------------------------------------------------*/
		
		/**
		 * Closes the builder's content panel.
		 *
		 * @since 1.0
		 * @access private
		 * @method _closePanel
		 */
		_closePanel: function()
		{
			$('.ep-bouwer-panel').stop(true, true).animate({ right: '-350px' }, 500, function(){ $(this).hide(); });
			$('.ep-bouwer-bar .ep-bouwer-add-content-button').stop(true, true).fadeIn();
		},
		
		/**
		 * Opens the builder's content panel.
		 *
		 * @since 1.0
		 * @access private
		 * @method _showPanel
		 */
		_showPanel: function()
		{
			$('.ep-bouwer-bar .ep-bouwer-add-content-button').stop(true, true).fadeOut();
			$('.ep-bouwer-panel').stop(true, true).show().animate({ right: '0' }, 500);
		},
		
		/**
		 * Opens or closes a section in the builder's content panel
		 * when a section title is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _blockSectionTitleClicked
		 */
		_blockSectionTitleClicked: function()
		{
			var title   = $(this),
				section = title.parent();
				
			if(section.hasClass('fl-active')) {
				section.removeClass('fl-active');
			}
			else {
				$('.ep-bouwer-blocks-section').removeClass('fl-active');
				section.addClass('fl-active');
			}
			
			EPBOUWER._initScrollbars();
		},
		
		/* Save Actions
		----------------------------------------------------------*/
		
		/**
		 * Publishes the layout when the publish button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _publishButtonClicked
		 */
		_publishButtonClicked: function()
		{
			EPBOUWER.showAjaxLoader();
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_save',
				method: 'save_layout',
				render_assets: 0
			}, EPBOUWER._exit);
				
			EPBOUWER._actionsLightbox.close();
		},
		
		/**
		 * Exits the builder when the save draft button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _draftButtonClicked
		 */
		_draftButtonClicked: function()
		{
			EPBOUWER.showAjaxLoader();
			EPBOUWER._actionsLightbox.close();
			EPBOUWER._exit();
		},
		
		/**
		 * Clears changes to the layout when the discard draft button
		 * is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _discardButtonClicked
		 */
		_discardButtonClicked: function()
		{
			var result = confirm(EPBOUWERStrings.discardMessage);
			
			if(result) {
			
				EPBOUWER.showAjaxLoader();
				
				EPBOUWER.ajax({
					action: 'ep_bouwer_save',
					method: 'clear_draft_layout',
					render_assets: 0
				}, EPBOUWER._exit);
					
				EPBOUWER._actionsLightbox.close();
			}
		},
		
		/**
		 * Closes the actions lightbox when the cancel button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _cancelButtonClicked
		 */
		_cancelButtonClicked: function()
		{
			EPBOUWER._exitUrl = null;
			EPBOUWER._actionsLightbox.close();
		},
		
		/**
		 * Redirects the user to the _exitUrl if defined, otherwise 
		 * it redirects the user to the current post without the 
		 * builder active. 
		 *
		 * @since 1.0
		 * @since 1.5.7 Closes the window if we're in a child window.
		 * @access private
		 * @method _exit
		 */
		_exit: function()
		{
			var href 		= window.location.href,
				isTemplate 	= 'ep-bouwer-template' == EPBOUWERConfig.postType;
			
			if ( isTemplate && typeof window.opener != 'undefined' && window.opener ) {
				window.close();
			}
			else {
				
				if ( EPBOUWER._exitUrl ) {
					href = EPBOUWER._exitUrl;
				}
				else {
					href = href.replace('?ep_bouwer', '').replace('&ep_bouwer', '');
				}
				
				window.location.href = href;
			}
		},
		
		/* Tools Actions
		----------------------------------------------------------*/
		
		/**
		 * Duplicates the current post and builder layout.
		 *
		 * @since 1.0
		 * @access private
		 * @method _duplicatePageClicked
		 */
		_duplicatePageClicked: function()
		{
			EPBOUWER._actionsLightbox.close();
			EPBOUWER.showAjaxLoader();
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_save',
				method: 'duplicate_post'
			}, EPBOUWER._duplicatePageComplete);
		},
		
		/**
		 * Redirects the user to the post edit screen of a
		 * duplicated post when duplication is complete.
		 *
		 * @since 1.0
		 * @access private
		 * @method _duplicatePageComplete
		 * @param {Number} The ID of the duplicated post.
		 */
		_duplicatePageComplete: function(response)
		{
			var adminUrl = $('#fl-admin-url').val();
			
			window.location.href = adminUrl + 'post.php?post='+ response +'&action=edit';
		},
		
		/**
		 * Shows the global builder settings lightbox when the global
		 * settings button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _globalSettingsClicked
		 */       
		_globalSettingsClicked: function()
		{
			EPBOUWER._actionsLightbox.close();
			EPBOUWER._showLightbox(false);
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_render_global_settings'
			}, EPBOUWER._globalSettingsLoaded);
		},

		/**
		 * Sets the lightbox content when the global settings have loaded.
		 *
		 * @since 1.0
		 * @access private
		 * @method _globalSettingsLoaded
		 * @param {String} html The HTML for the global settings form.
		 */  
		_globalSettingsLoaded: function(html)
		{
			EPBOUWER._setSettingsFormContent(html);  
					  
			EPBOUWER._initSettingsValidation({
				module_margins: {
					required: true,
					number: true
				},
				row_margins: {
					required: true,
					number: true
				},
				row_padding: {
					required: true,
					number: true
				},
				row_width: {
					required: true,
					number: true
				},
				responsive_breakpoint: {
					required: true,
					number: true
				}
			});
		},

		/**
		 * Saves the global settings when the save button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _saveGlobalSettingsClicked
		 */       
		_saveGlobalSettingsClicked: function()
		{
			var form     = $(this).closest('.ep-bouwer-settings'),
				valid    = form.validate().form(),
				data     = form.serializeArray(),
				settings = {},
				i        = 0;
				
			if(valid) {
					 
				for( ; i < data.length; i++) {
					settings[data[i].name] = data[i].value;
				}
				
				EPBOUWER.showAjaxLoader();
				
				EPBOUWER.ajax({
					action: 'ep_bouwer_save',
					method: 'save_global_settings',
					settings: settings
				}, EPBOUWER._updateLayout);
					
				EPBOUWER._lightbox.close();
			}
		},
		
		/* Template Selector
		----------------------------------------------------------*/
		
		/**
		 * Shows the template selector when the builder is launched
		 * if the current layout is empty.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initTemplateSelector
		 */
		_initTemplateSelector: function()
		{
			var rows = $(EPBOUWER._contentClass).find('.fl-row');
			
			if(rows.length === 0) {
				EPBOUWER._showTemplateSelector();
			}
		},
		
		/**
		 * Shows the template selector when the templates button
		 * has been clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _changeTemplateClicked
		 */
		_changeTemplateClicked: function()
		{
			EPBOUWER._actionsLightbox.close();
			EPBOUWER._showTemplateSelector();
		},
		
		/**
		 * Shows the template selector lightbox.
		 *
		 * @since 1.0
		 * @access private
		 * @method _showTemplateSelector
		 */
		_showTemplateSelector: function()
		{
			if ( EPBOUWERConfig.simpleUi ) {
				return;
			}
			if ( 'ep-bouwer-template' == EPBOUWERConfig.postType ) {
				return;   
			}
			if ( 'disabled' == EPBOUWERConfig.enabledTemplates ) {
				return;
			}
			if ( EPBOUWERConfig.lite ) {
				return;    
			}
			
			EPBOUWER._showLightbox( false );
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_render_template_selector'
			}, EPBOUWER._templateSelectorLoaded );
		},
		
		/**
		 * Sets the lightbox content when the template selector has loaded.
		 *
		 * @since 1.0
		 * @access private
		 * @method _templateSelectorLoaded
		 * @param {String} html The HTML for the template selector.
		 */
		_templateSelectorLoaded: function( html )
		{
			EPBOUWER._setLightboxContent( html );
			
			var select 			= $( '.fl-template-category-select' ),
				userTemplates 	= $( '.fl-user-template' );
			
			// Default to the user templates tab?
			if ( 'user' == EPBOUWERConfig.enabledTemplates || userTemplates.length > 0 ) {
				select.val( 'ep-bouwer-settings-tab-yours' );
				$( '.ep-bouwer-settings-tab' ).removeClass( 'fl-active' );
				$( '#ep-bouwer-settings-tab-yours' ).addClass( 'fl-active' );
			}
			
			// Show the no templates message?
			if ( 0 === userTemplates.length ) {
				$( '.fl-user-templates-message' ).show();
			}
			
			$( 'body' ).trigger( 'ep-bouwer.template-selector-loaded' );
		},
		
		/**
		 * Callback to show a template category when the 
		 * select is changed.
		 *
		 * @since 1.5.7
		 * @access private
		 * @method _templateCategoryChanged
		 */
		_templateCategoryChanged: function()
		{
			$( '.fl-template-selector .ep-bouwer-settings-tab' ).hide();
			$( '#' + $( this ).val() ).show();
		},
		
		/**
		 * Callback for when a user clicks a core template in 
		 * the template selector.
		 *
		 * @since 1.0
		 * @access private
		 * @method _templateClicked
		 */
		_templateClicked: function()
		{
			var template = $(this),
				index    = template.closest('.fl-template-preview').attr('data-id');
			
			if($(EPBOUWER._contentClass).children('.fl-row').length > 0) {
				
				if(index == 0) {
					if(confirm(EPBOUWERStrings.changeTemplateMessage)) {
						EPBOUWER._lightbox._node.hide();
						EPBOUWER._applyTemplate(0, false, 'core');
					}
				}
				else {
					EPBOUWER._selectedTemplateId = index;
					EPBOUWER._selectedTemplateType = 'core';
					EPBOUWER._showTemplateActions();
					EPBOUWER._lightbox._node.hide();
				}                
			}
			else {
				EPBOUWER._applyTemplate(index, false, 'core');
			}
		},
		
		/**
		 * Shows the actions lightbox for replacing and appending templates.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _showTemplateActions
		 */
		_showTemplateActions: function()
		{
			EPBOUWER._showActionsLightbox({
				'className': 'ep-bouwer-template-actions',
				'title': EPBOUWERStrings.actionsLightboxTitle,
				'buttons': {
					'template-replace': EPBOUWERStrings.templateReplace,
					'template-append': EPBOUWERStrings.templateAppend
				}
			});
		},
		
		/**
		 * Replaces the current layout with a template when the replace
		 * button is clicked.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _templateReplaceClicked
		 */
		_templateReplaceClicked: function()
		{
			if(confirm(EPBOUWERStrings.changeTemplateMessage)) {
				EPBOUWER._actionsLightbox.close();
				EPBOUWER._applyTemplate(EPBOUWER._selectedTemplateId, false, EPBOUWER._selectedTemplateType);
			}
		},
		
		/**
		 * Append a template to the current layout when the append
		 * button is clicked.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _templateAppendClicked
		 */
		_templateAppendClicked: function()
		{
			EPBOUWER._actionsLightbox.close();
			EPBOUWER._applyTemplate(EPBOUWER._selectedTemplateId, true, EPBOUWER._selectedTemplateType);
		},
		
		/**
		 * Shows the template selector when the cancel button of
		 * the template actions lightbox is clicked.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _templateCancelClicked
		 */
		_templateCancelClicked: function()
		{
			EPBOUWER._lightbox._node.show();
		},
		
		/**
		 * Applys a template to the current layout by either appending
		 * it or replacing the current layout with it.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _applyTemplate
		 * @param {Number} id The template id.
		 * @param {Boolean} append Whether the new template should be appended or not.
		 * @param {String} type The type of template. Either core or user.
		 */
		_applyTemplate: function(id, append, type)
		{
			append  = typeof append === 'undefined' || !append ? '0' : '1';
			type    = typeof type === 'undefined' ? 'core' : type;
			
			EPBOUWER._lightbox.close();
			EPBOUWER.showAjaxLoader();
		
			if(type == 'core') {
		
				EPBOUWER.ajax({
					action: 'ep_bouwer_save',
					method: 'apply_template',
					template_id: id,
					append: append
				}, EPBOUWER._updateLayout);
			}
			else {
			
				EPBOUWER.ajax({
					action: 'ep_bouwer_save',
					method: 'apply_user_template',
					template_id: id,
					append: append
				}, EPBOUWER._updateLayout);
			}
		},
		
		/* User Template Settings
		----------------------------------------------------------*/
		
		/**
		 * Shows the settings for saving a user defined template 
		 * when the save template button is clicked.
		 *
		 * @since 1.1.3
		 * @access private
		 * @method _saveUserTemplateClicked
		 */
		_saveUserTemplateClicked: function()
		{
			EPBOUWER._actionsLightbox.close();
			EPBOUWER._showLightbox(false);
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_render_user_template_settings'
			}, EPBOUWER._userTemplateSettingsLoaded);
		},
		
		/**
		 * Sets the lightbox content when the user template settings are loaded.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _userTemplateSettingsLoaded
		 * @param {String} html The HTML for the user template settings form.
		 */  
		_userTemplateSettingsLoaded: function(html)
		{
			EPBOUWER._setSettingsFormContent(html);  
					  
			EPBOUWER._initSettingsValidation({
				name: {
					required: true
				}
			});
		},
		
		/**
		 * Saves user template settings when the save button is clicked.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _saveUserTemplateSettings
		 */
		_saveUserTemplateSettings: function()
		{
			var form     = $(this).closest('.ep-bouwer-settings'),
				valid    = form.validate().form(),
				settings = EPBOUWER._getSettings(form);
				
			if(valid) {
					 
				EPBOUWER.showAjaxLoader();
				
				EPBOUWER.ajax({
					action: 'ep_bouwer_save',
					method: 'save_user_template',
					settings: settings
				}, EPBOUWER._saveUserTemplateSettingsComplete);
					
				EPBOUWER._lightbox.close();
			}
		},
		
		/**
		 * Shows a success alert when user template settings have saved.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _saveUserTemplateSettingsComplete
		 */
		_saveUserTemplateSettingsComplete: function()
		{
			EPBOUWER.alert(EPBOUWERStrings.templateSaved);
		},
		
		/**
		 * Callback for when a user clicks a user defined template in 
		 * the template selector.
		 *
		 * @since 1.1.3
		 * @access private
		 * @method _userTemplateClicked
		 */
		_userTemplateClicked: function()
		{
			var id = $(this).attr('data-id');
				
			if($(EPBOUWER._contentClass).children('.fl-row').length > 0) {
			
				if(id == 'blank') {
					if(confirm(EPBOUWERStrings.changeTemplateMessage)) {
						EPBOUWER._lightbox._node.hide();
						EPBOUWER._applyTemplate('blank', false, 'user');
					}
				}
				else {            
					EPBOUWER._selectedTemplateId = id;
					EPBOUWER._selectedTemplateType = 'user';
					EPBOUWER._showTemplateActions();
					EPBOUWER._lightbox._node.hide();
				}
			}
			else {
				EPBOUWER._applyTemplate(id, false, 'user');
			}
		},
		
		/**
		 * Launches the builder in a new tab to edit a user
		 * defined template when the edit link is clicked.
		 *
		 * @since 1.1.3
		 * @access private
		 * @method _editUserTemplateClicked
		 * @param {Object} e The event object.
		 */
		_editUserTemplateClicked: function(e)
		{
			e.preventDefault();
			e.stopPropagation();
			
			window.open($(this).attr('href'));
		},
		
		/**
		 * Deletes a user defined template when the delete link is clicked.
		 *
		 * @since 1.1.3
		 * @access private
		 * @method _deleteUserTemplateClicked
		 * @param {Object} e The event object.
		 */
		_deleteUserTemplateClicked: function(e)
		{
			var template = $( this ).closest( '.fl-user-template' ),
				id		 = template.attr( 'data-id' ),
				all		 = $( '.fl-user-template[data-id=' + id + ']' ),
				parent   = null;
			
			if ( confirm( EPBOUWERStrings.deleteTemplate ) ) {
				
				EPBOUWER.ajax( {
					action: 'ep_bouwer_save',
					method: 'delete_user_template',
					template_id: id
				} );
			
				all.fadeOut( function() {
					
					template = $( this );
					parent 	 = template.closest( '.fl-user-template-category' );
					
					template.remove(); 
					
					if ( 0 === parent.find( '.fl-user-template' ).length ) {
						parent.remove();
					}
					if ( 1 === $( '.fl-user-template' ).length ) {
						$( '.fl-user-templates').hide();
						$( '.fl-user-templates-message').show();
					}
				});
			}
			
			e.stopPropagation();
		},
		
		/* Core Template Settings
		----------------------------------------------------------*/
		
		/**
		 * Initializes the settings for saving core templates.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initCoreTemplateSettings
		 */
		_initCoreTemplateSettings: function()
		{
			if('undefined' != typeof EPBOUWERTemplateSettings) {
				EPBOUWERTemplateSettings.init();
			}
		},
		
		/* Help Actions
		----------------------------------------------------------*/
		
		/**
		 * Shows the getting started video when the watch video button
		 * is clicked.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _initCoreTemplateSettings
		 */
		_watchVideoClicked: function()
		{
			EPBOUWER._actionsLightbox.close();
			EPBOUWER._lightbox.open('<div class="fl-lightbox-header"><h1>' + EPBOUWERStrings.gettingStartedVideo + '</h1></div><div class="ep-bouwer-getting-started-video">' + EPBOUWERConfig.help.video_embed + '</div><div class="fl-lightbox-footer"><span class="ep-bouwer-settings-cancel ep-bouwer-button ep-bouwer-button-large ep-bouwer-button-primary" href="javascript:void(0);">' + EPBOUWERStrings.done + '</span></div>');
		},
		
		/**
		 * Opens a new window with the knowledge base URL when the 
		 * view knowledge base button is clicked.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _viewKnowledgeBaseClicked
		 */
		_viewKnowledgeBaseClicked: function()
		{
			EPBOUWER._actionsLightbox.close();
			
			window.open( EPBOUWERConfig.help.knowledge_base_url );
		},
		
		/**
		 * Opens a new window with the forums URL when the 
		 * visit forums button is clicked.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _visitForumsClicked
		 */
		_visitForumsClicked: function()
		{
			EPBOUWER._actionsLightbox.close();
			
			window.open( EPBOUWERConfig.help.forums_url );
		},
		
		/* Help Tour
		----------------------------------------------------------*/
		
		/**
		 * Shows the help tour or template selector when the builder
		 * is launched.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _showTourOrTemplates
		 */
		_showTourOrTemplates: function()
		{
			if ( ! EPBOUWERConfig.simpleUi && 'ep-bouwer-template' != EPBOUWERConfig.postType ) {
				if ( EPBOUWERConfig.help.tour && EPBOUWERConfig.newUser ) {
					EPBOUWER._showTourLightbox();
				}
				else {
					EPBOUWER._initTemplateSelector();
				}
			}
		},
		
		/**
		 * Shows the actions lightbox with a welcome message for new 
		 * users asking if they would like to take the tour.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _showTourLightbox
		 */
		_showTourLightbox: function()
		{
			EPBOUWER._actionsLightbox.open('<div class="ep-bouwer-actions ep-bouwer-tour-actions"><span class="ep-bouwer-actions-title">'+ EPBOUWERStrings.welcomeMessage +'</span><span class="ep-bouwer-no-tour-button ep-bouwer-button ep-bouwer-button-large">'+ EPBOUWERStrings.noThanks +'</span><span class="ep-bouwer-yes-tour-button ep-bouwer-button ep-bouwer-button-primary ep-bouwer-button-large">'+ EPBOUWERStrings.yesPlease +'</span></div>');
		},
		
		/**
		 * Closes the actions lightbox and shows the template selector 
		 * if a new user declines the tour.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _noTourButtonClicked
		 */
		_noTourButtonClicked: function()
		{
			EPBOUWER._actionsLightbox.close();
			EPBOUWER._initTemplateSelector();
		},
		
		/**
		 * Closes the actions lightbox and starts the tour when a new user
		 * decides to take the tour.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _yesTourButtonClicked
		 */
		_yesTourButtonClicked: function()
		{
			EPBOUWER._actionsLightbox.close();
			EPBOUWERTour.start();
		},
		
		/**
		 * Starts the help tour.
		 *
		 * @since 1.4.9
		 * @access private
		 * @method _startHelpTour
		 */
		_startHelpTour: function()
		{
			EPBOUWER._actionsLightbox.close();
			EPBOUWERTour.start();
		},
		
		/* Layout
		----------------------------------------------------------*/
		
		/**
		 * Shows a message to drop a row or module to get started 
		 * if the layout is empty.
		 *
		 * @since 1.0
		 * @access private
		 * @method _setupEmptyLayout
		 */
		_setupEmptyLayout: function()
		{
			var content = $(EPBOUWER._contentClass);
			
			content.removeClass('ep-bouwer-empty');
			content.find('.ep-bouwer-empty-message').remove();
			
			if(content.children('.fl-row').length === 0) {
				content.addClass('ep-bouwer-empty');
				content.append('<span class="ep-bouwer-empty-message">'+ EPBOUWERStrings.emptyMessage +'</span>');
				EPBOUWER._initSortables();
			}
		},
		
		/**
		 * Sends an AJAX request to render the layout and is typically
		 * used as a callback to many of the builder's save operations.
		 *
		 * @since 1.0
		 * @access private
		 * @method _updateLayout
		 */
		_updateLayout: function()
		{
			EPBOUWER.showAjaxLoader();
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_render_layout'
			}, EPBOUWER._renderLayout);
		},
		
		/**
		 * Removes the current layout and renders a new layout using
		 * the provided data.
		 *
		 * @since 1.0
		 * @access private
		 * @method _renderLayout
		 * @param {Object} data The layout data. May also be a JSON encoded string.
		 * @param {String} data.html The HTML for the new layout.
		 * @param {String} data.css The URL for the layout CSS.
		 * @param {String} data.js The URL for the layout JavaScript.
		 * @param {Function} callback A function to call when the layout has finished rendering.
		 */
		_renderLayout: function(data, callback)
		{
			data = typeof data == 'string' ? JSON.parse(data) : data;
		
			var post    = $('#fl-post-id').val(),
				head    = $('head').eq(0),
				body    = $('body').eq(0),
				content = $(EPBOUWER._contentClass),
				loader  = $('<img src="' + data.css + '" />'),
				oldCss  = $('#ep-bouwer-layout-' + post + '-css'),
				oldJs   = $('script[src*="/cache/' + post + '"]'),
				newCss  = $('<link rel="stylesheet" id="ep-bouwer-layout-' + post + '-css"  href="'+ data.css +'" />'),
				newJs   = $('<script src="'+ data.js +'"></script>');
				
			// Image onerror hack to check if the stylesheet has been loaded.
			loader.on('error', function() 
			{
				// Remove the loader.
				loader.remove();
				
				// Add the new layout css.
				if(oldCss.length > 0) {
					oldCss.after(newCss);
				}
				else {
					head.append(newCss);    
				}
				
				// Set a quick timeout to ensure the css has taken effect.
				setTimeout(function()
				{
					// Set the body height so the page doesn't scroll.
					body.height(body.height());
					
					// Remove the old content and assets.
					content.empty();
					oldCss.remove();
					oldJs.remove();
					
					// Add the new content.
					content.append( EPBOUWER._renderLayoutCleanContent( data.html ) );
					
					// Add the new layout js.
					setTimeout(function(){
						head.append(newJs);
					}, 50);

					// Send the layout rendered event.
					$( EPBOUWER._contentClass ).trigger( 'ep-bouwer.layout-rendered' );
					
					// Remove action overlays so they can reset.
					EPBOUWER._removeAllOverlays();
					
					// Hide the loader.
					EPBOUWER.hideAjaxLoader();
					
					// Run the callback.
					if(typeof callback != 'undefined') {
						callback();
					}
				
				}, 250);
			});
			
			body.append(loader);
		},
		
		/**
		 * Removes scripts that are already on the page from
		 * new HTML content that is going to be rendered.
		 *
		 * @since 1.0
		 * @access private
		 * @method _renderLayoutCleanContent
		 * @param {String} html The new HTML content to clean.
		 * @return {String} The cleaned HTML content.
		 */
		_renderLayoutCleanContent: function( html )
		{
			var cleaned = $( '<div id="fl-cleaned-content">' + html + '</div>' ),
				src     = '',
				script  = null;
			
			cleaned.find( 'script' ).each( function() {
				
				src     = $( this ).attr( 'src' );
				script  = $( 'script[src="' + src + '"]' );
				
				if ( script.length > 0 ) {
					$( this ).remove();
				}
			});
			
			return cleaned.html();
		},
		
		/**
		 * Called by the layout's JavaScript file once it's loaded 
		 * to finish rendering the layout.
		 *
		 * @since 1.0
		 * @access private
		 * @method _renderLayoutComplete
		 */
		_renderLayoutComplete: function()
		{
			EPBOUWER._setupEmptyLayout();
			EPBOUWER._highlightEmptyCols();
			EPBOUWER._initSortables();
			EPBOUWER._resizeLayout();
			EPBOUWER._initMediaElements();
			EPBOUWERLayout.init();
			
			// Reset the body height.
			$('body').height('auto');
		},
		
		/**
		 * Trigger the resize event on the window so elements
		 * in the layout that rely on JavaScript know to resize.
		 *
		 * @since 1.0
		 * @access private
		 * @method _resizeLayout
		 */
		_resizeLayout: function()
		{
			$(window).trigger('resize'); 
				
			if(typeof YUI !== 'undefined') {
				YUI().use('node-event-simulate', function(Y) {
					Y.one(window).simulate("resize");
				});
			}
		},

		/**
		 * Initializes MediaElements.js audio and video players.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initMediaElements
		 */
		_initMediaElements: function()
		{
			var settings = {};
			
			if(typeof $.fn.mediaelementplayer != 'undefined') {
			
				if(typeof _wpmejsSettings !== 'undefined') {
					settings.pluginPath = _wpmejsSettings.pluginPath;
				}
				
				$('.wp-audio-shortcode, .wp-video-shortcode').mediaelementplayer(settings);                
			}
		},
		
		/* Generic Drag and Drop
		----------------------------------------------------------*/
		
		/**
		 * Returns a helper element for a drag operation.
		 *
		 * @since 1.0
		 * @access private
		 * @method _blockDragHelper
		 * @param {Object} e The event object.
		 * @param {Object} item The item being dragged.
		 * @return {Object} The helper element.
		 */
		_blockDragHelper: function (e, item) 
		{
			var helper = item.clone();
			
			item.clone().insertAfter(item);
			helper.addClass('ep-bouwer-block-drag-helper');
			
			return helper;
		},
		
		/**
		 * Initializes a drag operation.
		 *
		 * @since 1.0
		 * @access private
		 * @method _blockDragInit
		 * @param {Object} e The event object.
		 */
		_blockDragInit: function(e)
		{
			var target      = $(e.target),
				item        = null,
				initialPos  = 0;
				
			// Set the _dragEnabled flag.
			EPBOUWER._dragEnabled = true;
			
			// Set the item to a module instance.  
			if(target.closest('.fl-module').length > 0) {
				item = target.closest('.fl-module');
			}
			// Set the item to a row instance.
			else if(target.closest('.fl-row').length > 0) {
				item = target.closest('.fl-row');
			}
			// Set the item to the first visible row.
			else if(target.hasClass('ep-bouwer-block-row')) {
				$('.fl-row').each(function(){
					if(item === null && $(this).offset().top - $(window).scrollTop() > 0) {
						item = $(this);
					}
				});
			}
			// Set the item to the first visible module.
			else if(target.hasClass('ep-bouwer-block-module')) {
				
				$('.fl-module').each(function(){
					if(item === null && $(this).offset().top - $(window).scrollTop() > 0) {
						item = $(this);
					}
				});
			}
			
			// Get the initial scroll position of the item.
			if(item !== null) {
				initialPos = item.offset().top - $(window).scrollTop();
			}
			else {
				item = target;
			}
			
			// Hide the empty message.
			$('.ep-bouwer-empty-message').hide();
			
			// Highlight rows.
			$(EPBOUWER._contentClass + ' .fl-row').addClass('fl-row-highlight');
			
			// Highlight modules.
			if(item.hasClass('fl-module') || item.hasClass('ep-bouwer-block-module')) {
				$(EPBOUWER._contentClass + ' .fl-col').addClass('fl-col-highlight');
			}
			
			// Clean up the UI for dragging.
			EPBOUWER._closePanel();
			EPBOUWER._destroyOverlayEvents();
			EPBOUWER._removeAllOverlays();
			
			// Scroll to the row or module that was dragged.            
			if(initialPos > 0) {
				scrollTo(0, item.offset().top - initialPos);
			}
		},
		
		/**
		 * Callback that fires when dragging starts.
		 *
		 * @since 1.0
		 * @access private
		 * @method _blockDragStart
		 * @param {Object} e The event object.
		 * @param {Object} ui An object with additional info for the drag.
		 */
		_blockDragStart: function(e, ui)
		{
			EPBOUWER._dragging = true;
			
			// Refresh sortables.
			$(EPBOUWER._contentClass).sortable('refreshPositions');
			$(EPBOUWER._contentClass + ' .fl-row-content').sortable('refreshPositions');
			$(EPBOUWER._contentClass + ' .fl-col-content').sortable('refreshPositions');
		},
		
		/**
		 * Callback that fires when an element that is being
		 * dragged is sorted.
		 *
		 * @since 1.0
		 * @access private
		 * @method _blockDragSort
		 * @param {Object} e The event object.
		 * @param {Object} ui An object with additional info for the drag.
		 */
		_blockDragSort: function(e, ui)
		{
			if(typeof ui.placeholder === 'undefined') {
				return;
			}
			
			var parent = ui.placeholder.parent(),
				title  = EPBOUWERStrings.insert;
			
			if(parent.hasClass('fl-col-content')) {
				if(ui.item.hasClass('ep-bouwer-block-module')) {
					title  = ui.item.text();
				}
				else {
					title  = ui.item.attr('data-name');
				}
			}
			else if(parent.hasClass('fl-row-content')) {
				if(ui.item.hasClass('ep-bouwer-block-row')) {
					title  = ui.item.text();
				}
				else {
					title = EPBOUWERStrings.newColumn;
				}
			}
			else if(parent.hasClass('ep-bouwer-content')) {
				if(ui.item.hasClass('ep-bouwer-block-row')) {
					title  = ui.item.text();
				}
				else if(ui.item.hasClass('fl-row')) {
					title = EPBOUWERStrings.row;
				}
				else {
					title = EPBOUWERStrings.newRow;
				}
			}
			
			ui.placeholder.html(title);
		},
		
		/**
		 * Cleans up when a drag operation has stopped.
		 *
		 * @since 1.0
		 * @access private
		 * @method _blockDragStop
		 * @param {Object} e The event object.
		 * @param {Object} ui An object with additional info for the drag.
		 */
		_blockDragStop: function(e, ui)
		{
			var parent     = ui.item.parent(),
				initialPos = parent.offset().top - $(window).scrollTop();

			// Show the panel? 
			if(parent.hasClass('ep-bouwer-blocks-section-content')) {
				EPBOUWER._showPanel();
			}
			
			// Finish dragging. 
			EPBOUWER._dragEnabled = false;
			EPBOUWER._dragging = false;
			EPBOUWER._bindOverlayEvents();
			EPBOUWER._highlightEmptyCols();
			$('.ep-bouwer-empty-message').show();
			
			// Scroll the page back to where it was. 
			scrollTo(0, parent.offset().top - initialPos);
		},
		
		/**
		 * Cleans up when a drag operation has canceled.
		 *
		 * @since 1.0
		 * @access private
		 * @method _blockDragCancel
		 */
		_blockDragCancel: function()
		{
			if(EPBOUWER._dragEnabled && !EPBOUWER._dragging) {
				EPBOUWER._dragEnabled = false;
				EPBOUWER._dragging = false;
				EPBOUWER._bindOverlayEvents();
				EPBOUWER._highlightEmptyCols();
				$('.ep-bouwer-empty-message').show();
			}
		},
		
		/**
		 * Removes all node overlays and hides any tooltip helpies.
		 *
		 * @since 1.0
		 * @access private
		 * @method _removeAllOverlays
		 */
		_removeAllOverlays: function()
		{
			var modules = $('.fl-module');
			
			modules.removeClass('fl-block-overlay-active');
			modules.find('.fl-module-overlay').remove();
			EPBOUWER._removeRowOverlays();
			EPBOUWER._hideTipTips();
		},
		
		/* Rows
		----------------------------------------------------------*/
		
		/**
		 * Adds a dashed border to empty columns.
		 *
		 * @since 1.0
		 * @access private
		 * @method _highlightEmptyCols
		 */
		_highlightEmptyCols: function()
		{
			var rows = $(EPBOUWER._contentClass + ' .fl-row'),
				cols = $(EPBOUWER._contentClass + ' .fl-col');
			
			rows.removeClass('fl-row-highlight');
			cols.removeClass('fl-col-highlight');
			
			cols.each(function(){
				
				var col = $(this);
				
				if(col.find('.fl-module').length === 0) {
					col.addClass('fl-col-highlight');
				}
			});
		},
		
		/**
		 * Removes all row overlays from the page.
		 *
		 * @since 1.0
		 * @access private
		 * @method _removeRowOverlays
		 */
		_removeRowOverlays: function()
		{
			$('.fl-row').removeClass('fl-block-overlay-active');
			$('.fl-row-overlay').remove();
		},
		
		/**
		 * Shows an overlay with actions when the mouse enters a row.
		 *
		 * @since 1.0
		 * @access private
		 * @method _rowMouseenter
		 */
		_rowMouseenter: function()
		{
			var row         = $( this ),
				rowContent  = $( this ).find( '.fl-row-content-wrap' ),
				overlay     = null,
				offset      = null;
			
			if(!row.hasClass('fl-block-overlay-active')) {
				
				row.addClass('fl-block-overlay-active');
				rowContent.append('<div class="fl-row-overlay fl-block-overlay" data-node="'+ row.attr('data-node') +'"><div class="fl-block-overlay-header"><div class="fl-block-overlay-actions"><div class="fl-block-overlay-title">'+ EPBOUWERStrings.row +'</div><i class="fl-block-move fa fa-arrows fl-tip" title="' + EPBOUWERStrings.move + '"></i><i class="fl-block-settings fa fa-wrench fl-tip" title="' + EPBOUWERStrings.rowSettings + '"></i><i class="fl-block-copy fa fa-copy fl-tip" title="' + EPBOUWERStrings.duplicate + '"></i><i class="fl-block-remove fa fa-times fl-tip" title="' + EPBOUWERStrings.remove + '"></i></div><div class="fl-clear"></div></div></div>');
				EPBOUWER._initTipTips();
				
				// Put the actions header on the bottom if it's hidden.
				overlay = row.find( '.fl-row-overlay' );
				offset  = overlay.offset();
				
				if ( offset.top < 43 ) {
					overlay.addClass( 'fl-row-overlay-header-bottom' );
				}
			}
		},
		
		/**
		 * Removes overlays when the mouse leaves a row.
		 *
		 * @since 1.0
		 * @access private
		 * @method _rowMouseleave
		 * @param {Object} e The event object.
		 */
		_rowMouseleave: function(e)
		{
			var toElement       = $(e.toElement) || $(e.relatedTarget),
				isOverlay       = toElement.hasClass('fl-row-overlay'),
				isOverlayChild  = toElement.closest('.fl-row-overlay').length > 0,
				isTipTip        = toElement.is('#tiptip_holder'),
				isTipTipChild   = toElement.closest('#tiptip_holder').length > 0;
			
			if(isOverlay || isOverlayChild || isTipTip || isTipTipChild) {
				return;
			}
			
			EPBOUWER._removeRowOverlays();
		},
		
		/**
		 * Returns a helper element for row drag operations.
		 *
		 * @since 1.0
		 * @access private
		 * @method _rowDragHelper
		 * @return {Object} The helper element.
		 */
		_rowDragHelper: function()
		{
			return $('<div class="ep-bouwer-block-drag-helper" style="width: 190px; height: 45px;">Row</div>');
		},
		
		/**
		 * Callback for when a row drag operation completes.
		 *
		 * @since 1.0
		 * @access private
		 * @method _rowDragStop
		 * @param {Object} e The event object.
		 * @param {Object} ui An object with additional info for the drag.
		 */
		_rowDragStop: function(e, ui)
		{
			var item   = ui.item,
				parent = item.parent();
				
			EPBOUWER._blockDragStop(e, ui);

			// A row was dropped back into the row list.
			if(parent.hasClass('ep-bouwer-rows')) {
				item.remove();
				return;
			}
			// Add a new row.
			else if(item.hasClass('ep-bouwer-block')) {
			
				// A row was dropped into another row.
				if(parent.hasClass('fl-row-content')) {
					EPBOUWER._addColGroup(
						item.closest('.fl-row').attr('data-node'),
						item.attr('data-cols'), 
						parent.children('.fl-col-group, .ep-bouwer-block').index(item)
					);
				}
				// A row was dropped into the main layout.
				else {  
					EPBOUWER._addRow(
						item.attr('data-cols'), 
						parent.children('.fl-row, .ep-bouwer-block').index(item)
					);
				}

				// Remove the helper.
				item.remove();
				
				// Show the builder panel.
				EPBOUWER._showPanel();
				
				// Show the module list.
				$('.ep-bouwer-modules').siblings('.ep-bouwer-blocks-section-title').eq(0).trigger('click');
			}
			// Reorder a row.
			else {
				EPBOUWER._reorderRow(
					item.attr('data-node'), 
					parent.children('.fl-row').index(item)
				);
			}
		},
		
		/**
		 * Reorders a row within the layout.
		 *
		 * @since 1.0
		 * @access private
		 * @method _reorderRow
		 * @param {String} node_id The node ID of the row.
		 * @param {Number} position The new position.
		 */     
		_reorderRow: function(node_id, position)
		{
			EPBOUWER.ajax({
				action: 'ep_bouwer_save',
				method: 'reorder_node',
				node_id: node_id,
				position: position,
				silent: true
			}); 
		},
		
		/**
		 * Adds a new row to the layout.
		 *
		 * @since 1.0
		 * @access private
		 * @method _addRow
		 * @param {String} cols The type of column layout to use.
		 * @param {Number} position The position of the new row.
		 */     
		_addRow: function(cols, position)
		{
			EPBOUWER.showAjaxLoader();
		
			EPBOUWER._newRowPosition = position;
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_render_new_row',
				cols: cols,
				position: position
			}, EPBOUWER._addRowComplete);
		},
		
		/**
		 * Adds the HTML for a new row to the layout when the AJAX
		 * add operation is complete. Adds a module if one is queued
		 * to go in the new row.
		 *
		 * @since 1.0
		 * @access private
		 * @method _addRowComplete
		 * @param {String} response The HTML for the new row.
		 */     
		_addRowComplete: function(response)
		{
			var content = $(EPBOUWER._contentClass),
				rows    = content.find('.fl-row'),
				row     = $(response),
				module  = null,
				form    = null;
				
			if(rows.length === 0 || rows.length == EPBOUWER._newRowPosition) {
				content.append(row);
			}
			else {
				rows.eq(EPBOUWER._newRowPosition).before(row);
			}
			
			EPBOUWER._setupEmptyLayout();
			EPBOUWER._highlightEmptyCols();
			EPBOUWER._initSortables();
			
			// Add a module to the newly created row.
			if(EPBOUWER._addModuleAfterRowRender !== null) {
			
				// Add an existing module. 
				if(EPBOUWER._addModuleAfterRowRender.hasClass('fl-module')) {
					module = EPBOUWER._addModuleAfterRowRender;
					row.find('.fl-col-content').eq(0).append(module);
					EPBOUWER._reorderModule(module);
				}
				
				EPBOUWER._highlightEmptyCols();
				EPBOUWER._addModuleAfterRowRender = null;
			}
		},
		
		/**
		 * Callback for when the delete row button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _deleteRowClicked
		 */
		_deleteRowClicked: function()
		{
			var nodeId = $(this).closest('.fl-row-overlay').attr('data-node'),
				row    = $('.fl-row[data-node='+ nodeId +']'),
				result = null;

			if(!row.find('.fl-module').length) {
				EPBOUWER._deleteRow(row);
			} 
			else {
				result = confirm(EPBOUWERStrings.deleteRowMessage);
				
				if(result) {
					EPBOUWER._deleteRow(row);
				}
			}
			
			EPBOUWER._removeAllOverlays();
		},
		
		/**
		 * Deletes a row.
		 *
		 * @since 1.0
		 * @access private
		 * @method _deleteRow
		 * @param {Object} row A jQuery reference of the row to delete.
		 */
		_deleteRow: function(row)
		{
			EPBOUWER.ajax({
				action: 'ep_bouwer_save',
				method: 'delete_node',
				node_id: row.attr('data-node'),
				render_assets: 0,
				silent: true
			});
			
			row.empty();
			row.remove();
			EPBOUWER._setupEmptyLayout();
			EPBOUWER._removeRowOverlays();
		},
		
		/**
		 * Duplicates a row.
		 *
		 * @since 1.3.8
		 * @access private
		 * @method _rowCopyClicked
		 * @param {Object} e The event object.
		 */ 
		_rowCopyClicked: function(e)
		{
			var nodeId = $(this).closest('.fl-row-overlay').attr('data-node');
			
			EPBOUWER.showAjaxLoader();
			
			EPBOUWER._removeAllOverlays();
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_save',
				method: 'copy_row',
				node_id: nodeId
			}, EPBOUWER._updateLayout);
			
			e.stopPropagation();
		},
		
		/**
		 * Shows the settings lightbox and loads the row settings
		 * when the row settings button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _rowSettingsClicked
		 */
		_rowSettingsClicked: function()
		{
			var nodeId = $(this).closest('.fl-row-overlay').attr('data-node');
			
			EPBOUWER._closePanel();
			EPBOUWER._showLightbox();
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_render_row_settings',
				node_id: nodeId
			}, EPBOUWER._rowSettingsLoaded);
		},
		
		/**
		 * Sets the lightbox content when the row settings have 
		 * loaded and creates a new preview.
		 *
		 * @since 1.0
		 * @access private
		 * @method _rowSettingsLoaded
		 * @param {String} response The HTML for the row settings form.
		 */
		_rowSettingsLoaded: function(response)
		{
			EPBOUWER._setSettingsFormContent(response);
			
			EPBOUWER.preview = new EPBOUWERPreview({ type : 'row' });
		},
		
		/* Columns
		----------------------------------------------------------*/
		
		/**
		 * Shows an overlay with actions when the mouse enters a column.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _colMouseenter
		 */
		_colMouseenter: function()
		{
			var col = $(this);
			
			if(col.find('.fl-module').length > 0) {
				return;
			}
			if(!col.hasClass('fl-block-overlay-active')) {        
				col.addClass('fl-block-overlay-active');
				col.append('<div class="fl-col-overlay fl-block-overlay"><div class="fl-block-overlay-header"><div class="fl-block-overlay-actions"><div class="fl-block-overlay-title">'+ EPBOUWERStrings.column +'</div><i class="fl-block-settings fa fa-wrench fl-tip" title="' + EPBOUWERStrings.columnSettings + '"></i><i class="fl-block-remove fa fa-times fl-tip" title="' + EPBOUWERStrings.remove + '"></i></div><div class="fl-clear"></div></div></div>');
				EPBOUWER._initTipTips();
			}
			
			$('body').addClass('fl-block-overlay-muted');
		},
		
		/**
		 * Removes overlays when the mouse leaves a column.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _colMouseleave
		 * @param {Object} e The event object.
		 */
		_colMouseleave: function(e)
		{
			var col             = $(this),
				toElement       = $(e.toElement) || $(e.relatedTarget),
				hasModules      = col.find('.fl-module').length > 0,
				isTipTip        = toElement.is('#tiptip_holder'),
				isTipTipChild   = toElement.closest('#tiptip_holder').length > 0;
			
			if(hasModules || isTipTip || isTipTipChild) {
				return;
			}
			
			col.removeClass('fl-block-overlay-active');
			col.find('.fl-col-overlay').remove();
			$('body').removeClass('fl-block-overlay-muted');
		},
		
		/**
		 * Shows the settings lightbox and loads the column settings
		 * when the column settings button is clicked.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _colSettingsClicked
		 * @param {Object} e The event object.
		 */
		_colSettingsClicked: function(e)
		{
			var nodeId = $(this).closest('.fl-col').attr('data-node');
			
			EPBOUWER._closePanel();
			EPBOUWER._showLightbox();
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_render_column_settings',
				node_id: nodeId
			}, EPBOUWER._colSettingsLoaded);
			
			e.stopPropagation();
		},
		
		/**
		 * Sets the lightbox content when the column settings have 
		 * loaded and creates a new preview.
		 *
		 * @since 1.1.9
		 * @access private
		 * @method _colSettingsLoaded
		 * @param {String} response The HTML for the column settings form.
		 */
		_colSettingsLoaded: function(response)
		{
			EPBOUWER._setSettingsFormContent(response);
			
			var settings = $('.ep-bouwer-col-settings'),
				nodeId   = settings.data('node'),
				col      = $('.fl-col[data-node="' + nodeId + '"]');
				
			if(col.siblings('.fl-col').length === 0) {
				$(settings).find('#ep-bouwer-settings-section-general').css('display', 'none');
			}
			
			EPBOUWER.preview = new EPBOUWERPreview({ type : 'col' });
		},
		
		/**
		 * Callback for when the delete column button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _deleteColClicked
		 * @param {Object} e The event object.
		 */
		_deleteColClicked: function(e)
		{
			EPBOUWER._deleteCol($(this).closest('.fl-col'));
			EPBOUWER._removeAllOverlays();
			
			e.stopPropagation();
		},
		
		/**
		 * Deletes a column.
		 *
		 * @since 1.0
		 * @access private
		 * @method _deleteCol
		 * @param {Object} col A jQuery reference of the column to delete.
		 */
		_deleteCol: function(col)
		{
			var row   = col.closest('.fl-row'),
				group = col.closest('.fl-col-group'),
				cols  = null,
				width = 0;
				
			col.remove();
			rowCols   = row.find('.fl-col');
			groupCols = group.find('.fl-col');
			
			if(rowCols.length == 0) {
				EPBOUWER._deleteRow(row);
			}
			else {
				
				if(groupCols.length == 0) {
					group.remove();
				}
						
				width = 100/groupCols.length;
				groupCols.css('width', width + '%');
			
				EPBOUWER.ajax({
					action          : 'ep_bouwer_save',
					method          : 'delete_col',
					node_id         : col.attr('data-node'),
					new_width       : width,
					render_assets   : 0,
					silent          : true
				});
			}
		},
		
		/**
		 * Adds a new column group to the layout.
		 *
		 * @since 1.0
		 * @access private
		 * @method _addColGroup
		 * @param {String} nodeId The node ID of the parent row.
		 * @param {String} cols The type of column layout to use.
		 * @param {Number} position The position of the new column group.
		 */
		_addColGroup: function(nodeId, cols, position)
		{
			EPBOUWER.showAjaxLoader();
			
			EPBOUWER._newColGroupParent = $('.fl-node-' + nodeId + ' .fl-row-content');
			EPBOUWER._newColGroupPosition = position;
			
			EPBOUWER.ajax({
				action      : 'ep_bouwer_render_new_column_group',
				cols        : cols,
				node_id     : nodeId,
				position    : position
			}, EPBOUWER._addColGroupComplete);
		},
		
		/**
		 * Adds the HTML for a new column group to the layout when 
		 * the AJAX add operation is complete. Adds a module if one 
		 * is queued to go in the new column group.
		 *
		 * @since 1.0
		 * @access private
		 * @method _addColGroupComplete
		 * @param {String} response The HTML for the new column group.
		 */     
		_addColGroupComplete: function(response)
		{
			var rowContent  = EPBOUWER._newColGroupParent,
				groups      = rowContent.find('.fl-col-group'),
				group       = $(response),
				col         = group.find('.fl-col-content').eq(0),
				module      = null,
				form        = null;
			  
			if(groups.length === 0 || groups.length == EPBOUWER._newColGroupPosition) {
				rowContent.append(group);
			}
			else {
				groups.eq(EPBOUWER._newColGroupPosition).before(group);
			}

			// Add a module to the newly created column group.
			if(EPBOUWER._addModuleAfterRowRender !== null) {
			
				// Add an existing module. 
				if(EPBOUWER._addModuleAfterRowRender.hasClass('fl-module')) {
					module = EPBOUWER._addModuleAfterRowRender;
					col.append(module);
					EPBOUWER._reorderModule(module);
				}
				
				EPBOUWER._addModuleAfterRowRender = null;
			}
			
			EPBOUWER._highlightEmptyCols();
			EPBOUWER._initSortables();
		},
		
		/* Modules
		----------------------------------------------------------*/
		
		/**
		 * Shows an overlay with actions when the mouse enters a module.
		 *
		 * @since 1.0
		 * @access private
		 * @method _moduleMouseenter
		 */
		_moduleMouseenter: function()
		{
			var module        = $(this),
				moduleName    = module.attr('data-name');
			
			if(!module.hasClass('fl-block-overlay-active')) {

				if(module.outerHeight(true) < 20) {
					module.addClass('fl-module-adjust-height');
				}
			
				module.addClass('fl-block-overlay-active');
				module.append('<div class="fl-module-overlay fl-block-overlay"><div class="fl-block-overlay-header"><div class="fl-block-overlay-actions"><div class="fl-block-overlay-title">'+ moduleName +'</div><i class="fl-block-move fa fa-arrows fl-tip" title="' + EPBOUWERStrings.move + '"></i><i class="fl-block-settings fa fa-wrench fl-tip" title="' + EPBOUWERStrings.settings.replace( '%s', moduleName ) + '"></i><i class="fl-block-copy fa fa-copy fl-tip" title="' + EPBOUWERStrings.duplicate + '"></i><i class="fl-block-columns fa fa-columns fl-tip" title="' + EPBOUWERStrings.columnSettings + '"></i><i class="fl-block-remove fa fa-times fl-tip" title="' + EPBOUWERStrings.remove + '"></i></div><div class="fl-clear"></div></div></div>');
				EPBOUWER._initTipTips();
			}
			
			$('body').addClass('fl-block-overlay-muted');
		},
		
		/**
		 * Removes overlays when the mouse leaves a module.
		 *
		 * @since 1.0
		 * @access private
		 * @method _moduleMouseleave
		 * @param {Object} e The event object.
		 */
		_moduleMouseleave: function(e)
		{
			var module          = $(this),
				toElement       = $(e.toElement) || $(e.relatedTarget),
				isTipTip        = toElement.is('#tiptip_holder'),
				isTipTipChild   = toElement.closest('#tiptip_holder').length > 0;
			
			if(isTipTip || isTipTipChild) {
				return;
			}
			
			module.removeClass('fl-module-adjust-height');
			module.removeClass('fl-block-overlay-active');
			module.find('.fl-module-overlay').remove();
			$('body').removeClass('fl-block-overlay-muted');
		},
		
		/**
		 * Returns a helper element for module drag operations.
		 *
		 * @since 1.0
		 * @access private
		 * @method _moduleDragHelper
		 * @param {Object} e The event object.
		 * @param {Object} item The element being dragged.
		 * @return {Object} The helper element.
		 */
		_moduleDragHelper: function(e, item)
		{   
			return $('<div class="ep-bouwer-block-drag-helper">' + item.attr('data-name') + '</div>');
		},
		
		/**
		 * Callback for when a module drag operation completes.
		 *
		 * @since 1.0
		 * @access private
		 * @method _moduleDragStop
		 * @param {Object} e The event object.
		 * @param {Object} ui An object with additional info for the drag.
		 */
		_moduleDragStop: function(e, ui)
		{
			var item     = ui.item,
				parent   = item.parent(),
				position = 0,
				parentId = 0;
			
			EPBOUWER._blockDragStop(e, ui);
			
			// A module was dropped back into the module list.
			if(parent.hasClass('ep-bouwer-modules') || parent.hasClass('ep-bouwer-widgets')) {
				item.remove();
				return;
			}
			// A new module was dropped.
			else if(item.hasClass('ep-bouwer-block')) {
			
				// A new module was dropped into a row position.
				if(parent.hasClass('ep-bouwer-content')) {
					position = parent.children('.fl-row, .ep-bouwer-block').index(item);
					parentId = 0;
				}
				// A new module was dropped into a column position.
				else if(parent.hasClass('fl-row-content')) {
					position = parent.children('.fl-col-group, .ep-bouwer-block').index(item);
					parentId = item.closest('.fl-row').attr('data-node');
				}
				// A new module was dropped into a column.
				else {
					position = parent.children('.fl-module, .ep-bouwer-block').index(item);
					parentId = item.closest('.fl-col').attr('data-node');
				}
				
				// Add the new module.
				EPBOUWER._addModule(parentId, item.attr('data-type'), position, item.attr('data-widget'))
				
				// Remove the drag helper.
				ui.item.remove();
			}
			// A module was dropped into the main layout.
			else if(parent.hasClass('ep-bouwer-content')) {
				position = parent.children('.fl-row, .fl-module').index(item);
				EPBOUWER._addModuleAfterRowRender = item;
				EPBOUWER._addRow('1-col', position);
				item.remove();
			}
			// A module was dropped into a column position.
			else if(parent.hasClass('fl-row-content')) {
				position = parent.children('.fl-col-group, .fl-module').index(item);
				EPBOUWER._addModuleAfterRowRender = item;
				EPBOUWER._addColGroup(item.closest('.fl-row').attr('data-node'), '1-col', position);
				item.remove();
			}
			// A module was dropped into another column.
			else {
				EPBOUWER._reorderModule(item);
			}
			
			EPBOUWER._resizeLayout();
		},
		
		/**
		 * Reorders a module within a column.
		 *
		 * @since 1.0
		 * @access private
		 * @method _reorderModule
		 * @param {Object} module The module element being dragged.
		 */
		_reorderModule: function(module)
		{
			var newParent = module.closest('.fl-col').attr('data-node'),
				oldParent = module.attr('data-parent'),
				node_id   = module.attr('data-node'),
				position  = module.index();
				 
			if(newParent == oldParent) {
				EPBOUWER.ajax({
					action: 'ep_bouwer_save',
					method: 'reorder_node',
					node_id: node_id,
					position: position,
					silent: true
				});
			}
			else {
				module.attr('data-parent', newParent);
			
				EPBOUWER.ajax({
					action: 'ep_bouwer_save',
					method: 'move_node',
					new_parent: newParent,
					node_id: node_id,
					position: position,
					silent: true
				});
			}
		},
		
		/**
		 * Callback for when the delete module button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _deleteModuleClicked
		 * @param {Object} e The event object.
		 */
		_deleteModuleClicked: function(e)
		{
			var module = $(this).closest('.fl-module'),
				result = confirm(EPBOUWERStrings.deleteModuleMessage);
			
			if(result) {
				EPBOUWER._deleteModule(module);
				EPBOUWER._removeAllOverlays();
			}
			
			e.stopPropagation();
		},
		
		/**
		 * Deletes a module.
		 *
		 * @since 1.0
		 * @access private
		 * @method _deleteModule
		 * @param {Object} module A jQuery reference of the module to delete.
		 */
		_deleteModule: function(module)
		{
			var row = module.closest('.fl-row');

			EPBOUWER.ajax({
				action: 'ep_bouwer_save',
				method: 'delete_node',
				node_id: module.attr('data-node'),
				render_assets: 0,
				silent: true
			});
			
			module.empty();
			module.remove();
			row.removeClass('fl-block-overlay-muted');
			EPBOUWER._highlightEmptyCols();
			EPBOUWER._removeAllOverlays();
		},
		
		/**
		 * Duplicates a module.
		 *
		 * @since 1.0
		 * @access private
		 * @method _moduleCopyClicked
		 * @param {Object} e The event object.
		 */ 
		_moduleCopyClicked: function(e)
		{
			var module = $(this).closest('.fl-module');
			
			EPBOUWER.showAjaxLoader();
			EPBOUWER._removeAllOverlays();
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_save',
				method: 'copy_module',
				node_id: module.attr('data-node')
			}, EPBOUWER._updateLayout);
			
			e.stopPropagation();
		},
		
		/**
		 * Shows the settings lightbox and loads the module settings
		 * when the module settings button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _moduleSettingsClicked
		 * @param {Object} e The event object.
		 */ 
		_moduleSettingsClicked: function(e)
		{
			var nodeId   = $(this).closest('.fl-module').attr('data-node'),
				parentId = $(this).closest('.fl-col').attr('data-node'),
				type     = $(this).closest('.fl-module').attr('data-type');
			
			EPBOUWER._showModuleSettings(nodeId, parentId, type);
			
			e.stopPropagation();
		},
		
		/**
		 * Shows the lightbox and loads the settings for a module.
		 *
		 * @since 1.0
		 * @access private
		 * @method _showModuleSettings
		 * @param {String} nodeId The node ID for the module.
		 * @param {String} parentId The node ID for the module's parent.
		 * @param {String} type The type of module.
		 */
		_showModuleSettings: function(nodeId, parentId, type)
		{
			EPBOUWER._closePanel();
			EPBOUWER._showLightbox();
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_render_module_settings',
				node_id: nodeId,
				type: type,
				parent_id: parentId
			}, EPBOUWER._moduleSettingsLoaded);
		},
		
		/**
		 * Sets the lightbox content when the module settings have 
		 * loaded and creates a new preview.
		 *
		 * @since 1.0
		 * @access private
		 * @method _moduleSettingsLoaded
		 * @param {Object} data Preview layout data. Can also be a JSON encoded string.
		 */ 
		_moduleSettingsLoaded: function(data)
		{
			var preview   = typeof data == 'string' ? null : data.layout,
				content   = typeof data == 'string' ? data : data.settings,
				html      = $('<div>'+ content +'</div>'),
				link      = html.find('link.ep-bouwer-settings-css'),
				script    = html.find('script.ep-bouwer-settings-js'),
				form      = html.find('.ep-bouwer-settings'),
				type      = form.attr('data-type'),
				helper    = null;
			
			// Append the settings css and js?
			if($.inArray(type, EPBOUWER._loadedModuleAssets) > -1) {
				link.remove();
				script.remove();
			}
			else {
				$('head').append(link);
				$('head').append(script);
				EPBOUWER._loadedModuleAssets.push(type);
			}
			
			// Set the content.
			EPBOUWER._setSettingsFormContent(html);
			
			// Create a new preview.
			EPBOUWER.preview = new EPBOUWERPreview({ 
				type    : 'module',
				layout  : preview
			});
			
			// Init the settings form helper.
			helper = EPBOUWER._moduleHelpers[type];
			
			if(typeof helper !== 'undefined') {
				EPBOUWER._initSettingsValidation(helper.rules);
				helper.init();
			}
		},
		
		/**
		 * Validates the module settings and saves them if 
		 * the form is valid.
		 *
		 * @since 1.0
		 * @access private
		 * @method _saveModuleClicked
		 */ 
		_saveModuleClicked: function()
		{
			var form      = $(this).closest('.ep-bouwer-settings'),
				type      = form.attr('data-type'),
				id        = form.attr('data-node'),
				helper    = EPBOUWER._moduleHelpers[type],
				valid     = true;
			
			if(typeof helper !== 'undefined') {
				
				form.find('label.error').remove();
				form.validate().hideErrors();
				valid = form.validate().form();
				
				if(valid) {
					valid = helper.submit();
				}
			}
			if(valid) {
				EPBOUWER._saveSettings();
				EPBOUWER._lightbox.close();
			}
			else {
				EPBOUWER._toggleSettingsTabErrors();
			}
		},
		
		/**
		 * Adds a new module to a column and loads the settings.
		 *
		 * @since 1.0
		 * @access private
		 * @method _addModule
		 * @param {String} parentId The node id of the new module's parent.
		 * @param {String} type The type of module to add.
		 * @param {Number} position The position of the new module within its parent.
		 * @param {String} widget The type of widget if this module is a widget.
		 */ 
		_addModule: function(parentId, type, position, widget)
		{
			EPBOUWER.showAjaxLoader();
			
			EPBOUWER.ajax({
				action          : 'ep_bouwer_render_new_module_settings',
				parent_id       : parentId,
				type            : type,
				position        : position,
				node_preview    : 1,
				widget          : typeof widget === 'undefined' ? '' : widget
			}, EPBOUWER._addModuleComplete);
		},
		
		/**
		 * Shows the settings lightbox and sets the content when
		 * the module settings have finished loading.
		 *
		 * @since 1.0
		 * @access private
		 * @method _addModuleComplete
		 * @param {String} response The JSON encoded response.
		 */ 
		_addModuleComplete: function(response)
		{
			var data = JSON.parse(response);
			
			EPBOUWER._showLightbox();
			EPBOUWER._moduleSettingsLoaded(data);
			
			$('.ep-bouwer-module-settings').data('new-module', '1');
		},
		
		/**
		 * Registers a helper class for a module's settings.
		 *
		 * @since 1.0
		 * @method registerModuleHelper
		 * @param {String} type The type of module.
		 * @param {Object} obj The module helper.
		 */ 
		registerModuleHelper: function(type, obj)
		{
			var defaults = {
				rules: {},
				init: function(){},
				submit: function(){ return true; },
				preview: function(){}
			};
			
			EPBOUWER._moduleHelpers[type] = $.extend({}, defaults, obj);
		},
		
		/**
		 * Deprecated. Use the public method registerModuleHelper instead.
		 *
		 * @since 1.0
		 * @access private
		 * @method _registerModuleHelper
		 * @param {String} type The type of module.
		 * @param {Object} obj The module helper.
		 */ 
		_registerModuleHelper: function(type, obj)
		{
			EPBOUWER.registerModuleHelper(type, obj);
		},

		/* Settings
		----------------------------------------------------------*/
		
		/**
		 * Initializes logic for settings forms.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initSettingsForms
		 */ 
		_initSettingsForms: function()
		{
			EPBOUWER._initColorPickers();
			EPBOUWER._initSelectFields();
			EPBOUWER._initMultipleFields();
			EPBOUWER._initAutoSuggestFields();
			EPBOUWER._initLinkFields();
		},
		
		/**
		 * Sets the content for the settings lightbox.
		 *
		 * @since 1.0
		 * @access private
		 * @method _setSettingsFormContent
		 * @param {String} html The HTML content for the lightbox.
		 */ 
		_setSettingsFormContent: function(html)
		{
			EPBOUWER._setLightboxContent(html);
			EPBOUWER._initSettingsForms();
		},
		
		/**
		 * Shows the content for a settings form tab when it is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _settingsTabClicked
		 * @param {Object} e The event object.
		 */ 
		_settingsTabClicked: function(e)
		{
			var tab  = $(this),
				form = tab.closest('.ep-bouwer-settings'),
				id   = tab.attr('href').split('#').pop();
			
			form.find('.ep-bouwer-settings-tab').removeClass('fl-active');
			form.find('#' + id).addClass('fl-active');
			form.find('.ep-bouwer-settings-tabs .fl-active').removeClass('fl-active');
			$(this).addClass('fl-active');
			e.preventDefault();
		},
		
		/**
		 * Reverts an active preview and hides the lightbox when 
		 * the cancel button of a settings lightbox is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _settingsCancelClicked
		 * @param {Object} e The event object.
		 */ 
		_settingsCancelClicked: function(e)
		{
			var moduleSettings = $('.ep-bouwer-module-settings'),
				existingNodes  = null,
				previewModule  = null,
				previewCol     = null,
				existingCol    = null;
			
			if(moduleSettings.length > 0 && typeof moduleSettings.data('new-module') != 'undefined') {
			
				existingNodes = $(EPBOUWER.preview.state.html);
				previewModule = $('.fl-node-' + moduleSettings.data('node'));
				previewCol    = previewModule.closest('.fl-col');
				existingCol   = existingNodes.find('.fl-node-' + previewCol.data('node'));
				
				if(existingCol.length > 0) {
					EPBOUWER._deleteModule(previewModule);
				}
				else {
					EPBOUWER._deleteCol(previewCol);
				}
			}
			
			FLLightbox.closeParent(this);
			
			if(EPBOUWER.preview) {
				EPBOUWER.preview.revert();
				EPBOUWER.preview = null;
			}
		},
		
		/**
		 * Initializes validation logic for a settings form.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initSettingsValidation
		 * @param {Object} rules The validation rules object.
		 * @param {Object} messages Custom messages to show for invalid fields.
		 */ 
		_initSettingsValidation: function(rules, messages)
		{
			var form = $('.ep-bouwer-settings').last();
			
			form.validate({
				ignore: [],
				rules: rules,
				messages: messages,
				errorPlacement: EPBOUWER._settingsErrorPlacement
			});
		},
		
		/**
		 * Places a validation error after the invalid field.
		 *
		 * @since 1.0
		 * @access private
		 * @method _settingsErrorPlacement
		 * @param {Object} error The error element.
		 * @param {Object} element The invalid field.
		 */ 
		_settingsErrorPlacement: function(error, element)
		{
			error.appendTo(element.parent());
		},
		
		/**
		 * Resets all tab error icons and then shows any for tabs
		 * that have fields with errors.
		 *
		 * @since 1.0
		 * @access private
		 * @method _toggleSettingsTabErrors
		 */ 
		_toggleSettingsTabErrors: function()
		{
			var form      = $('.ep-bouwer-settings:visible'),
				tabs      = form.find('.ep-bouwer-settings-tab'),
				tab       = null,
				tabErrors = null,
				i         = 0;
			
			for( ; i < tabs.length; i++) {
				
				tab = tabs.eq(i);
				tabErrors = tab.find('label.error');
				tabLink = form.find('.ep-bouwer-settings-tabs a[href*='+ tab.attr('id') +']');
				tabLink.find('.fl-error-icon').remove();
				tabLink.removeClass('error');
				
				if(tabErrors.length > 0) {
					tabLink.append('<span class="fl-error-icon"></span>');
					tabLink.addClass('error');
				}
			}
		},
		
		/**
		 * Returns an object with key/value pairs for all fields
		 * within a settings form.
		 *
		 * @since 1.0
		 * @access private
		 * @method _getSettings
		 * @param {Object} form The settings form element.
		 * @return {Object} The settings object.
		 */ 
		_getSettings: function(form)
		{
			EPBOUWER._updateEditorFields();
			
			var data     	= form.serializeArray(),
				checkboxes 	= form.find( 'input[type="checkbox"]:not(:checked)' ),
				i        	= 0,
				value	 	= '',
				name     	= '',
				key      	= '',
				matches	 	= [],
				settings 	= {};
				
			// Add unchecked checkboxes to the form data. 
			for ( ; i < checkboxes.length; i++ ) {
				
				name = checkboxes.eq( i ).attr( 'name' );
				
				if ( 'undefined' != name ) {
					
					data.push( {
						name  : name,
						value : ''
					} );
				}
			}
			
			// Loop through the form data.
			for ( i = 0; i < data.length; i++ ) {
				
				value = data[ i ].value.replace( /\r/gm, '' );
				
				// Don't save text editor textareas.
				if ( data[ i ].name.indexOf( 'flrich' ) > -1 ) {
					continue;
				}
				// Support foo[] setting keys.
				else if ( data[ i ].name.indexOf( '[]' ) > -1 ) {
					
					name = data[ i ].name.replace( '[]', '' );
					
					// Support foo[][bar] setting keys.
					if ( name.indexOf( '[' ) > -1 ) {
					
						matches = name.match( /\[(.*)\]/ );
						key  	= matches[ 0 ].replace( /(\[|\])/g, '' );
						name 	= name.replace( matches[ 0 ], '' );
						
						if ( 'undefined' == typeof settings[ name ] ) {
							settings[ name ] = {};
						}
						
						// Support foo[][bar][] setting keys.
						if ( matches[ 0 ].indexOf( '[]' ) > -1 ) {
							
							if ( 'undefined' == typeof settings[ name ][ key ] ) {
								settings[ name ][ key ] = [];
							}
							
							settings[ name ][ key ].push( value );
						}
						// Must be a foo[][bar] setting key.
						else {
							settings[ name ][ key ] = value;	
						}
					}
					// Must be a standard foo[] setting key.
					else {

						if ( 'undefined' == typeof settings[ name ] ) {
							settings[ name ] = [];
						}
						
						settings[ name ].push( value );
					}
				}
				// Standard name/value pair.
				else {
					settings[ data[ i ].name ] = value;
				}
			}
			
			// Update auto suggest values.
			for ( key in settings ) {
				
				if ( 'undefined' != typeof settings[ 'as_values_' + key ] ) {
					
					settings[ key ] = $.grep( 
						settings[ 'as_values_' + key ].split( ',' ), 
						function( n ) { 
							return n != ''; 
						}
					).join( ',' );
					
					try {
						delete settings[ 'as_values_' + key ];
					}
					catch( e ) {}
				}
			}
			
			return settings;
		},
		
		/**
		 * Saves the settings for the current settings form, shows
		 * the loader and hides the lightbox.
		 *
		 * @since 1.0
		 * @access private
		 * @method _saveSettings
		 */ 
		_saveSettings: function()
		{
			var form     = $('.ep-bouwer-settings-lightbox .ep-bouwer-settings'),
				nodeId   = form.attr('data-node'),
				settings = EPBOUWER._getSettings(form);
		
			// Show the loader.
			EPBOUWER.showAjaxLoader();
			
			// Make the AJAX call.
			EPBOUWER.ajax({
				action          : 'ep_bouwer_save',
				method          : 'save_settings',
				node_id         : nodeId,
				settings        : settings
			}, EPBOUWER._saveSettingsComplete);
			
			// Close the lightbox.
			EPBOUWER._lightbox.close();
		},
		
		/**
		 * Renders a new layout when the settings for the current 
		 * form have finished saving. 
		 *
		 * @since 1.0
		 * @access private
		 * @method _saveSettingsComplete
		 * @param {String} response The layout data from the server.
		 */ 
		_saveSettingsComplete: function(response)
		{
			EPBOUWER._renderLayout(response, function() {
				if(EPBOUWER.preview) {
					EPBOUWER.preview.clear();
					EPBOUWER.preview = null;
				}
			});
		},
		
		/* Tooltips
		----------------------------------------------------------*/
		
		/**
		 * Shows a help tooltip in the settings lightbox.
		 *
		 * @since 1.0
		 * @access private
		 * @method _showHelpTooltip
		 */ 
		_showHelpTooltip: function()
		{
			$(this).siblings('.fl-help-tooltip-text').fadeIn();
		},
		
		/**
		 * Hides a help tooltip in the settings lightbox.
		 *
		 * @since 1.0
		 * @access private
		 * @method _hideHelpTooltip
		 */ 
		_hideHelpTooltip: function()
		{
			$(this).siblings('.fl-help-tooltip-text').fadeOut();
		},
		
		/* Auto Suggest Fields
		----------------------------------------------------------*/
		
		/**
		 * Initializes all auto suggest fields within a settings form.
		 *
		 * @since 1.2.3
		 * @access private
		 * @method _initAutoSuggestFields
		 */ 
		_initAutoSuggestFields: function()
		{
			$('.fl-suggest-field').each(EPBOUWER._initAutoSuggestField);
		},
		
		/**
		 * Initializes a single auto suggest field.
		 *
		 * @since 1.2.3
		 * @access private
		 * @method _initAutoSuggestField
		 */ 
		_initAutoSuggestField: function()
		{
			var field = $(this);
				
			field.autoSuggest(EPBOUWER._ajaxUrl({ 
				'fl_action'         : 'ep_bouwer_autosuggest',
				'fl_as_action'      : field.data('action'),
				'fl_as_action_data' : field.data('action-data')
			}), {
				asHtmlID                    : field.attr('name'),
				selectedItemProp            : 'name',
				searchObjProps              : 'name',
				minChars                    : 3,
				keyDelay                    : 1000,
				fadeOut                     : false,
				usePlaceholder              : true,
				emptyText                   : EPBOUWERStrings.noResultsFound,
				showResultListWhenNoMatch   : true,
				preFill                     : field.data('value'),
				queryParam                  : 'fl_as_query',
				afterSelectionAdd           : EPBOUWER._updateAutoSuggestField,
				afterSelectionRemove        : EPBOUWER._updateAutoSuggestField
			});
		},
		
		/**
		 * Updates the value of an auto suggest field.
		 *
		 * @since 1.2.3
		 * @access private
		 * @method _initAutoSuggestField
		 * @param {Object} element The auto suggest field.
		 * @param {Object} item The current selection.
		 * @param {Array} selections An array of selected values.
		 */ 
		_updateAutoSuggestField: function(element, item, selections)
		{
			$(this).siblings('.as-values').val(selections.join(',')).trigger('change');
		},
		
		/* Multiple Fields
		----------------------------------------------------------*/
		
		/**
		 * Initializes all multiple fields in a settings form.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initMultipleFields
		 */ 
		_initMultipleFields: function()
		{
			var multiples = $('.ep-bouwer-field-multiples'),
				multiple  = null,
				fields    = null,
				i         = 0,
				cursorAt  = EPBOUWERConfig.isRtl ? { left: 10 } : { right: 10 };
				
			for( ; i < multiples.length; i++) {
			
				multiple = multiples.eq(i);
				fields = multiple.find('.ep-bouwer-field-multiple');
				
				if(fields.length === 1) {
					fields.eq(0).find('.ep-bouwer-field-actions').addClass('ep-bouwer-field-actions-single');
				}
				else {
					fields.find('.ep-bouwer-field-actions').removeClass('ep-bouwer-field-actions-single');
				}
			}
			
			$('.ep-bouwer-field-multiples').sortable({
				items: '.ep-bouwer-field-multiple',
				cursor: 'move',
				cursorAt: cursorAt,
				distance: 5,
				opacity: 0.5,
				helper: EPBOUWER._fieldDragHelper,
				placeholder: 'ep-bouwer-field-dd-zone',
				stop: EPBOUWER._fieldDragStop,
				tolerance: 'pointer'
			});
		},
		
		/**
		 * Adds a new multiple field to the list when the add
		 * button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _addFieldClicked
		 */ 
		_addFieldClicked: function()
		{
			var button      = $(this),
				fieldName   = button.attr('data-field'),
				fieldRow    = button.closest('tr').siblings('tr[data-field='+ fieldName +']').last(),
				clone       = fieldRow.clone(),
				index       = parseInt(fieldRow.find('label span.ep-bouwer-field-index').html(), 10) + 1;
				
			clone.find('th label span.ep-bouwer-field-index').html(index);
			clone.find('.fl-form-field-preview-text').html('');
			clone.find('input, textarea, select').val('');
			fieldRow.after(clone);
			EPBOUWER._initMultipleFields();
		},
		
		/**
		 * Copies a multiple field and adds it to the list when 
		 * the copy button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _copyFieldClicked
		 */ 
		_copyFieldClicked: function()
		{
			var button      = $(this),
				row         = button.closest('tr'),
				clone       = row.clone(),
				index       = parseInt(row.find('label span.ep-bouwer-field-index').html(), 10) + 1;
				
			clone.find('th label span.ep-bouwer-field-index').html(index);
			row.after(clone);
			EPBOUWER._renumberFields(row.parent());
			EPBOUWER._initMultipleFields();
			EPBOUWER.preview.delayPreview();
		},
		
		/**
		 * Deletes a multiple field from the list when the
		 * delete button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _deleteFieldClicked
		 */ 
		_deleteFieldClicked: function()
		{
			var row     = $(this).closest('tr'),
				parent  = row.parent(),
				result  = confirm(EPBOUWERStrings.deleteFieldMessage);
			
			if(result) {
				row.remove();
				EPBOUWER._renumberFields(parent);
				EPBOUWER._initMultipleFields();
				EPBOUWER.preview.delayPreview();
			}
		},
		
		/**
		 * Renumbers the labels for a list of multiple fields.
		 *
		 * @since 1.0
		 * @access private
		 * @method _renumberFields
		 * @param {Object} table A table element with multiple fields.
		 */ 
		_renumberFields: function(table)
		{
			var rows = table.find('.ep-bouwer-field-multiple'),
				i    = 0;
				
			for( ; i < rows.length; i++) {
				rows.eq(i).find('th label span.ep-bouwer-field-index').html(i + 1);
			}
		},
		
		/**
		 * Returns an element for multiple field drag operations.
		 *
		 * @since 1.0
		 * @access private
		 * @method _fieldDragHelper
		 * @return {Object} The helper element.
		 */ 
		_fieldDragHelper: function()
		{
			return $('<div class="ep-bouwer-field-dd-helper"></div>');
		},
		
		/**
		 * Renumbers and triggers a preview when a multiple field
		 * has finished dragging.
		 *
		 * @since 1.0
		 * @access private
		 * @method _fieldDragStop
		 * @param {Object} e The event object.
		 * @param {Object} ui An object with additional info for the drag.
		 */ 
		_fieldDragStop: function(e, ui)
		{
			EPBOUWER._renumberFields(ui.item.parent());
			
			EPBOUWER.preview.delayPreview();
		},
		
		/* Select Fields
		----------------------------------------------------------*/
		
		/**
		 * Initializes select fields for a settings form.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initSelectFields
		 */ 
		_initSelectFields: function()
		{
			$('.ep-bouwer-settings:visible').find('.ep-bouwer-settings-fields select').trigger('change');
		},
		
		/**
		 * Callback for when a settings form select has been changed.
		 * If toggle data is present, other fields will be toggled
		 * when this select changes.
		 *
		 * @since 1.0
		 * @access private
		 * @method _settingsSelectChanged
		 */ 
		_settingsSelectChanged: function()
		{
			var select  = $(this),
				toggle  = select.attr('data-toggle'),
				hide    = select.attr('data-hide'),
				trigger = select.attr('data-trigger'),
				val     = select.val(),
				i       = 0,
				k       = 0;
			
			// TOGGLE sections, fields or tabs.
			if(typeof toggle !== 'undefined') {
			
				toggle = JSON.parse(toggle);
				
				for(i in toggle) {
					EPBOUWER._settingsSelectToggle(toggle[i].fields, 'hide', '#fl-field-');
					EPBOUWER._settingsSelectToggle(toggle[i].sections, 'hide', '#ep-bouwer-settings-section-');
					EPBOUWER._settingsSelectToggle(toggle[i].tabs, 'hide', 'a[href*=ep-bouwer-settings-tab-');
				}
				
				if(typeof toggle[val] !== 'undefined') {
					EPBOUWER._settingsSelectToggle(toggle[val].fields, 'show', '#fl-field-');
					EPBOUWER._settingsSelectToggle(toggle[val].sections, 'show', '#ep-bouwer-settings-section-');
					EPBOUWER._settingsSelectToggle(toggle[val].tabs, 'show', 'a[href*=ep-bouwer-settings-tab-');
				}
			}
			
			// HIDE sections, fields or tabs.
			if(typeof hide !== 'undefined') {
			
				hide = JSON.parse(hide);
				
				if(typeof hide[val] !== 'undefined') {
					EPBOUWER._settingsSelectToggle(hide[val].fields, 'hide', '#fl-field-');
					EPBOUWER._settingsSelectToggle(hide[val].sections, 'hide', '#ep-bouwer-settings-section-');
					EPBOUWER._settingsSelectToggle(hide[val].tabs, 'hide', 'a[href*=ep-bouwer-settings-tab-');
				}
			}
			
			// TRIGGER select inputs.
			if(typeof trigger !== 'undefined') {
			
				trigger = JSON.parse(trigger);
				
				if(typeof trigger[val] !== 'undefined') {
					if(typeof trigger[val].fields !== 'undefined') {
						for(i = 0; i < trigger[val].fields.length; i++) {
							$('#fl-field-' + trigger[val].fields[i]).find('select').trigger('change');
						}
					}
				}
			}
		},
		
		/**
		 * @since 1.0
		 * @access private
		 * @method _settingsSelectToggle
		 * @param {Array} inputArray
		 * @param {Function} func
		 * @param {String} prefix
		 */ 
		_settingsSelectToggle: function(inputArray, func, prefix)
		{
			var i = 0;
			
			if(typeof inputArray !== 'undefined') {
				for( ; i < inputArray.length; i++) {
					$(prefix + inputArray[i])[func]();
				}
			}
		},
		
		/* Color Pickers
		----------------------------------------------------------*/
		
		/**
		 * Initializes color picker fields for a settings form.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initColorPickers
		 */ 
		_initColorPickers: function()
		{
			$('.fl-color-picker').each(function(){
			
				var wrapper  = $(this),
					picker   = wrapper.find('.fl-color-picker-color'),
					startHex = '#' + wrapper.find('.fl-color-picker-value').val();
					
				picker.ColorPicker({
					color: startHex,
					onShow: function (dialog) {
						$(dialog).fadeIn(500);
						return false;
					},
					onHide: function (dialog) {
						$(dialog).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						picker.css('background-color', '#' + hex);  
						wrapper.removeClass('fl-color-picker-empty');
						wrapper.find('.fl-color-picker-value').val(hex).trigger('change');
					}
				}).css('background-color', startHex);
				
				wrapper.find('.fl-color-picker-clear').on('click', EPBOUWER._clearColorPicker);
			});
		},
		
		/**
		 * Clears the color of a color picker field.
		 *
		 * @since 1.0
		 * @access private
		 * @method _clearColorPicker
		 */ 
		_clearColorPicker: function()
		{
			var button = $(this);
				
			button.siblings('.fl-color-picker-color').css('background-color', 'transparent');
			button.siblings('.fl-color-picker-value').val('').trigger('change');
			button.parent().addClass('fl-color-picker-empty');
		},
		
		/* Single Photo Fields
		----------------------------------------------------------*/
		
		/**
		 * Shows the single photo selector.
		 *
		 * @since 1.0
		 * @access private
		 * @method _selectSinglePhoto
		 */ 
		_selectSinglePhoto: function()
		{
			if(EPBOUWER._singlePhotoSelector === null) {
				EPBOUWER._singlePhotoSelector = wp.media({
					title: EPBOUWERStrings.selectPhoto,
					button: { text: EPBOUWERStrings.selectPhoto },
					library : { type : 'image' },
					multiple: false
				});
			}
			
			EPBOUWER._singlePhotoSelector.once('open', $.proxy(EPBOUWER._singlePhotoOpened, this));
			EPBOUWER._singlePhotoSelector.once('select', $.proxy(EPBOUWER._singlePhotoSelected, this));
			EPBOUWER._singlePhotoSelector.open();
		},
		
		/**
		 * Callback for when the single photo selector is shown.
		 *
		 * @since 1.0
		 * @access private
		 * @method _singlePhotoOpened
		 */ 
		_singlePhotoOpened: function()
		{
			var selection   = EPBOUWER._singlePhotoSelector.state().get('selection'),
				wrap        = $(this).closest('.fl-photo-field'),
				photoField  = wrap.find('input[type=hidden]'),
				photo       = photoField.val(),
				attachment  = null;
				
			if($(this).hasClass('fl-photo-replace')) {
				selection.reset();
				wrap.addClass('fl-photo-empty');
				photoField.val('');
			}
			else if(photo != '') {           
				attachment = wp.media.attachment(photo);
				attachment.fetch();
				selection.add(attachment ? [attachment] : []);
			}
			else {
				selection.reset();
			}
		},
		
		/**
		 * Callback for when a single photo is selected.
		 *
		 * @since 1.0
		 * @access private
		 * @method _singlePhotoSelected
		 */ 
		_singlePhotoSelected: function()
		{
			var photo      = EPBOUWER._singlePhotoSelector.state().get('selection').first().toJSON(),
				wrap       = $(this).closest('.fl-photo-field'),
				photoField = wrap.find('input[type=hidden]'),
				preview    = wrap.find('.fl-photo-preview img'),
				srcSelect  = wrap.find('select');
				
			photoField.val(photo.id);
			preview.attr('src', EPBOUWER._getPhotoSrc(photo));
			wrap.removeClass('fl-photo-empty');
			wrap.find('label.error').remove();
			srcSelect.show();
			srcSelect.html(EPBOUWER._getPhotoSizeOptions(photo));
			srcSelect.trigger('change');
		},
		
		/**
		 * Returns the src URL for a photo.
		 *
		 * @since 1.0
		 * @access private
		 * @method _getPhotoSrc
		 * @param {Object} photo A photo data object.
		 * @return {String} The src URL for a photo.
		 */ 
		_getPhotoSrc: function(photo)
		{
			if(typeof photo.sizes === 'undefined') {
				return photo.url;
			}
			else if(typeof photo.sizes.thumbnail !== 'undefined') {
				return photo.sizes.thumbnail.url;
			}
			else {
				return photo.sizes.full.url;
			}
		},
		
		/**
		 * Builds the options for a photo size select.
		 *
		 * @since 1.0
		 * @access private
		 * @method _getPhotoSizeOptions
		 * @param {Object} photo A photo data object.
		 * @return {String} The HTML for the photo size options.
		 */ 
		_getPhotoSizeOptions: function(photo)
		{
			var html     = '',
				size     = null,
				selected = null,
				titles = {
					full      : EPBOUWERStrings.fullSize,
					large     : EPBOUWERStrings.large,
					medium    : EPBOUWERStrings.medium,
					thumbnail : EPBOUWERStrings.thumbnail
				};
				
			if(typeof photo.sizes === 'undefined') {
				html += '<option value="' + photo.url + '">' + EPBOUWERStrings.fullSize + '</option>';
			}
			else {
				
				for(size in photo.sizes) {
					selected = size == 'full' ? ' selected="selected"' : '';
					html += '<option value="' + photo.sizes[size].url + '"' + selected + '>' + titles[size]  + ' - ' + photo.sizes[size].width + ' x ' + photo.sizes[size].height + '</option>';
				}
			}
			
			return html;
		},
		
		/* Multiple Photo Fields
		----------------------------------------------------------*/
		
		/**
		 * Shows the multiple photo selector.
		 *
		 * @since 1.0
		 * @access private
		 * @method _selectMultiplePhotos
		 */ 
		_selectMultiplePhotos: function()
		{
			var wrap           = $(this).closest('.fl-multiple-photos-field'),
				photosField    = wrap.find('input[type=hidden]'),
				photosFieldVal = photosField.val(),
				content        = photosFieldVal == '' ? '[gallery ids="-1"]' : '[gallery ids="'+ JSON.parse(photosFieldVal).join() +'"]',
				shortcode      = wp.shortcode.next('gallery', content).shortcode,
				defaultPostId  = wp.media.gallery.defaults.id,
				attachments    = null, 
				selection      = null;

			if(_.isUndefined(shortcode.get('id')) && !_.isUndefined(defaultPostId)) {
				shortcode.set('id', defaultPostId);
			}

			attachments = wp.media.gallery.attachments(shortcode);

			selection = new wp.media.model.Selection(attachments.models, {
				props: attachments.props.toJSON(),
				multiple: true
			});

			selection.gallery = attachments.gallery;

			// Fetch the query's attachments, and then break ties from the
			// query to allow for sorting.
			selection.more().done(function() {
				// Break ties with the query.
				selection.props.set({ query: false });
				selection.unmirror();
				selection.props.unset('orderby');
			});

			// Destroy the previous gallery frame.
			if(EPBOUWER._multiplePhotoSelector) {
				EPBOUWER._multiplePhotoSelector.dispose();
			}
			
			// Store the current gallery frame.
			EPBOUWER._multiplePhotoSelector = wp.media({
				frame:     'post',
				state:     $(this).hasClass('fl-multiple-photos-edit') ? 'gallery-edit' : 'gallery-library',
				title:     wp.media.view.l10n.editGalleryTitle,
				editing:   true,
				multiple:  true,
				selection: selection
			}).open();
			
			$(EPBOUWER._multiplePhotoSelector.views.view.el).addClass('fl-multiple-photos-lightbox');
			EPBOUWER._multiplePhotoSelector.once('update', $.proxy(EPBOUWER._multiplePhotosSelected, this));
		},
		
		/**
		 * Callback for when multiple photos have been selected.
		 *
		 * @since 1.0
		 * @access private
		 * @method _multiplePhotosSelected
		 * @param {Object} data The photo data object.
		 */ 
		_multiplePhotosSelected: function(data)
		{
			var wrap        = $(this).closest('.fl-multiple-photos-field'),
				photosField = wrap.find('input[type=hidden]'),
				count       = wrap.find('.fl-multiple-photos-count'),
				photos      = [],
				i           = 0;
			
			for( ; i < data.models.length; i++) {
				photos.push(data.models[i].id);
			}
				
			if(photos.length == 1) {
				count.html('1 ' + EPBOUWERStrings.photoSelected);
			}
			else {
				count.html(photos.length + ' ' + EPBOUWERStrings.photosSelected);
			}
		 
			wrap.removeClass('fl-multiple-photos-empty');
			wrap.find('label.error').remove();
			photosField.val(JSON.stringify(photos)).trigger('change');
		},
		
		/* Single Video Fields
		----------------------------------------------------------*/
		
		/**
		 * Shows the single video selector.
		 *
		 * @since 1.0
		 * @access private
		 * @method _selectSingleVideo
		 */ 
		_selectSingleVideo: function()
		{
			if(EPBOUWER._singleVideoSelector === null) {
			
				EPBOUWER._singleVideoSelector = wp.media({
					title: EPBOUWERStrings.selectVideo,
					button: { text: EPBOUWERStrings.selectVideo },
					library : { type : 'video' },
					multiple: false
				}); 
			}
			
			EPBOUWER._singleVideoSelector.once('select', $.proxy(EPBOUWER._singleVideoSelected, this));
			EPBOUWER._singleVideoSelector.open();
		},
		
		/**
		 * Callback for when a single video is selected.
		 *
		 * @since 1.0
		 * @access private
		 * @method _singleVideoSelected
		 */ 
		_singleVideoSelected: function()
		{
			var video      = EPBOUWER._singleVideoSelector.state().get('selection').first().toJSON(),
				wrap       = $(this).closest('.fl-video-field'),
				image      = wrap.find('.fl-video-preview-img img'),
				filename   = wrap.find('.fl-video-preview-filename'),
				videoField = wrap.find('input[type=hidden]');
			
			image.attr('src', video.icon);
			filename.html(video.filename);
			wrap.removeClass('fl-video-empty');
			wrap.find('label.error').remove();
			videoField.val(video.id).trigger('change');
		},
		
		/* Icon Fields
		----------------------------------------------------------*/
		
		/**
		 * Shows the icon selector.
		 *
		 * @since 1.0
		 * @access private
		 * @method _selectIcon
		 */ 
		_selectIcon: function()
		{
			var self = this;
			
			FLIconSelector.open(function(icon){
				EPBOUWER._iconSelected.apply(self, [icon]);
			});
		},
		
		/**
		 * Callback for when an icon is selected.
		 *
		 * @since 1.0
		 * @access private
		 * @method _iconSelected
		 * @param {String} icon The selected icon's CSS classname.
		 */ 
		_iconSelected: function(icon)
		{
			var wrap       = $(this).closest('.fl-icon-field'),
				iconField  = wrap.find('input[type=hidden]'),
				iconTag    = wrap.find('i'),
				oldIcon    = iconTag.attr('data-icon');
				
			iconField.val(icon).trigger('change');
			iconTag.removeClass(oldIcon);
			iconTag.addClass(icon);
			iconTag.attr('data-icon', icon);
			wrap.removeClass('fl-icon-empty');
			wrap.find('label.error').remove();
		},
		
		/**
		 * Callback for when a selected icon is removed.
		 *
		 * @since 1.0
		 * @access private
		 * @method _removeIcon
		 */ 
		_removeIcon: function()
		{
			var wrap       = $(this).closest('.fl-icon-field'),
				iconField  = wrap.find('input[type=hidden]'),
				iconTag    = wrap.find('i');
				
			iconField.val('').trigger('change');
			iconTag.removeClass();
			iconTag.attr('data-icon', '');
			wrap.addClass('fl-icon-empty');
		},
		
		/* Settings Form Fields
		----------------------------------------------------------*/

		/**
		 * Shows the settings for a nested form field when the
		 * edit link is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _formFieldClicked
		 */  
		_formFieldClicked: function()
		{
			var link                = $(this),
				linkLightboxId      = link.closest('.fl-lightbox-wrap').attr('data-instance-id'),
				linkLightbox        = FLLightbox._instances[linkLightboxId],
				linkLightboxLeft    = linkLightbox._node.find('.fl-lightbox').css('left'),
				linkLightboxTop     = linkLightbox._node.find('.fl-lightbox').css('top'),
				form                = link.closest('.ep-bouwer-settings'),
				type                = link.attr('data-type'),
				settings            = link.siblings('input').val(),
				helper              = EPBOUWER._moduleHelpers[type],
				lightbox            = new FLLightbox({
										  className: 'ep-bouwer-lightbox fl-form-field-settings',
										  destroyOnClose: true
									  });

			link.closest('.ep-bouwer-lightbox').hide();
			link.attr('id', 'fl-' + lightbox._id);
			lightbox.open('<div class="ep-bouwer-lightbox-loading"></div>');
			lightbox.draggable({ handle: '.fl-lightbox-header' });
			$('body').undelegate('.ep-bouwer-settings-cancel', 'click', EPBOUWER._settingsCancelClicked);
			
			lightbox._node.find('.fl-lightbox').css({
				'left': linkLightboxLeft,
				'top': Number(parseInt(linkLightboxTop) + 233) + 'px'
			});
			
			EPBOUWER.ajax({
				action: 'ep_bouwer_render_settings_form',
				type: type,
				settings: settings.replace(/&#39;/g, "'")
			}, 
			function(response) 
			{
				lightbox.setContent(response); 
				lightbox._node.find('form.ep-bouwer-settings').attr('data-type', type); 
				lightbox._node.find('.ep-bouwer-settings-cancel').on('click', EPBOUWER._closeFormFieldLightbox);
				EPBOUWER._initSettingsForms();
				
				if(typeof helper !== 'undefined') {
					EPBOUWER._initSettingsValidation(helper.rules);
					helper.init();
				}
				
				lightbox._node.find('.fl-lightbox').css({
					'left': linkLightboxLeft,
					'top': linkLightboxTop
				});
			});
		},
		
		/**
		 * Closes the settings lightbox for a nested form field when the
		 * cancel or save button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _closeFormFieldLightbox
		 */ 
		_closeFormFieldLightbox: function()
		{
			var instanceId          = $(this).closest('.fl-lightbox-wrap').attr('data-instance-id'),
				lightbox            = FLLightbox._instances[instanceId],
				linkLightbox        = $('.ep-bouwer-settings-lightbox'),
				linkLightboxForm    = linkLightbox.find('form'),
				linkLightboxLeft    = lightbox._node.find('.fl-lightbox').css('left');
				linkLightboxTop     = lightbox._node.find('.fl-lightbox').css('top');
				boxHeight           = 0,
				win                 = $(window),
				winHeight           = win.height();
			
			lightbox._node.find('.fl-lightbox-content').html('<div class="ep-bouwer-lightbox-loading"></div>');
			boxHeight = lightbox._node.find('.fl-lightbox').height();
			
			if(winHeight - 80 > boxHeight) {
				lightbox._node.find('.fl-lightbox').css('top', ((winHeight - boxHeight)/2 - 40) + 'px');
			}
			else {
				lightbox._node.find('.fl-lightbox').css('top', '0px');
			}
			
			lightbox.on('close', function() 
			{
				linkLightbox.show();
				linkLightbox.find('label.error').remove();
				linkLightboxForm.validate().hideErrors();
				EPBOUWER._toggleSettingsTabErrors();
				
				linkLightbox.find('.fl-lightbox').css({
					'left': linkLightboxLeft,
					'top': linkLightboxTop
				});
			});
			
			setTimeout(function()
			{
				lightbox.close();
				$('body').delegate('.ep-bouwer-settings-cancel', 'click', EPBOUWER._settingsCancelClicked);
			}, 500);
		},
		
		/**
		 * Saves the settings for a nested form field when the
		 * save button is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _saveFormFieldClicked
		 * @return {Boolean} Whether the save was successful or not.
		 */  
		_saveFormFieldClicked: function()
		{
			var form          = $(this).closest('.ep-bouwer-settings'),
				lightboxId    = $(this).closest('.fl-lightbox-wrap').attr('data-instance-id'),
				type          = form.attr('data-type'),
				settings      = EPBOUWER._getSettings(form),
				helper        = EPBOUWER._moduleHelpers[type],
				link          = $('.ep-bouwer-settings #fl-' + lightboxId),
				preview       = link.parent().attr('data-preview-text'),
				previewText   = settings[preview],
				selectPreview = $( 'select[name="' + preview + '"]' ),
				tmp           = document.createElement('div'),
				valid         = true;
				
			if ( selectPreview.length > 0 ) {
				previewText = selectPreview.find( 'option[value="' + settings[ preview ] + '"]' ).text();
			}  
			if(typeof helper !== 'undefined') {
				
				form.find('label.error').remove();
				form.validate().hideErrors();
				valid = form.validate().form();
				
				if(valid) {
					valid = helper.submit();
				}
			}
			if(valid) {
			
				if(typeof preview !== 'undefined') {
				
					if(previewText.indexOf('fa fa-') > -1) {
						previewText = '<i class="' + previewText + '"></i>';
					}
					else if(previewText.length > 35) {
						tmp.innerHTML = previewText;
						previewText = (tmp.textContent || tmp.innerText || '').replace(/^(.{35}[^\s]*).*/, "$1")  + '...';
					}
				
					link.siblings('.fl-form-field-preview-text').html(previewText);
				}
				
				link.siblings('input').val(JSON.stringify(settings)).trigger('change');
				
				EPBOUWER._closeFormFieldLightbox.apply(this);
				
				return true;
			}
			else {
				EPBOUWER._toggleSettingsTabErrors();
				return false;
			}
		},
		
		/* Layout Fields
		----------------------------------------------------------*/

		/**
		 * Callback for when the item of a layout field is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _layoutFieldClicked
		 */ 
		_layoutFieldClicked: function()
		{
			var option = $(this);
			
			option.siblings().removeClass('fl-layout-field-option-selected');
			option.addClass('fl-layout-field-option-selected');
			option.siblings('input').val(option.attr('data-value'));
		},
		
		/* Link Fields
		----------------------------------------------------------*/
		
		/**
		 * Initializes all link fields in a settings form.
		 *
		 * @since 1.3.9
		 * @access private
		 * @method _initLinkFields
		 */ 
		_initLinkFields: function()
		{
			$('.fl-link-field').each(EPBOUWER._initLinkField);
		},
		
		/**
		 * Initializes a single link field in a settings form.
		 *
		 * @since 1.3.9
		 * @access private
		 * @method _initLinkFields
		 */ 
		_initLinkField: function()
		{
			var wrap        = $(this),
				searchInput = wrap.find('.fl-link-field-search-input');
				
			searchInput.autoSuggest(EPBOUWER._ajaxUrl({ 
				'fl_action'         : 'ep_bouwer_autosuggest',
				'fl_as_action'      : 'fl_as_links'
			}), {
				asHtmlID                    : searchInput.attr('name'),
				selectedItemProp            : 'name',
				searchObjProps              : 'name',
				minChars                    : 3,
				keyDelay                    : 1000,
				fadeOut                     : false,
				usePlaceholder              : true,
				emptyText                   : EPBOUWERStrings.noResultsFound,
				showResultListWhenNoMatch   : true,
				queryParam                  : 'fl_as_query',
				selectionLimit              : 1,
				afterSelectionAdd           : EPBOUWER._updateLinkField
			});
		},
		
		/**
		 * Updates the value of a link field when a link has been 
		 * selected from the auto suggest menu.
		 *
		 * @since 1.3.9
		 * @access private
		 * @method _updateLinkField
		 * @param {Object} element The auto suggest field.
		 * @param {Object} item The current selection.
		 * @param {Array} selections An array of selected values.
		 */ 
		_updateLinkField: function(element, item, selections)
		{
			var wrap        = element.closest('.fl-link-field'),
				search      = wrap.find('.fl-link-field-search'),
				searchInput = wrap.find('.fl-link-field-search-input'),
				field       = wrap.find('.fl-link-field-input');
			
			field.val(item.value).trigger('keyup');
			searchInput.autoSuggest('remove', item.value);
			search.hide();
		},

		/**
		 * Shows the auto suggest input for a link field.
		 *
		 * @since 1.3.9
		 * @access private
		 * @method _linkFieldSelectClicked
		 */ 
		_linkFieldSelectClicked: function()
		{
			$(this).parent().find('.fl-link-field-search').show();
		},

		/**
		 * Hides the auto suggest input for a link field.
		 *
		 * @since 1.3.9
		 * @access private
		 * @method _linkFieldSelectCancelClicked
		 */ 
		_linkFieldSelectCancelClicked: function()
		{
			$(this).parent().hide();
		},
		
		/* Editor Fields
		----------------------------------------------------------*/
		
		/**
		 * Used to init pre WP 3.9 editors from field.php.
		 *
		 * @since 1.0
		 * @method initEditorField
		 */  
		initEditorField: function(id)
		{
			var newEditor = tinyMCEPreInit.mceInit['flhiddeneditor'];
			
			newEditor['elements'] = id;
			tinyMCEPreInit.mceInit[id] = newEditor;
		},

		/**
		 * Updates all editor fields within a settings form.
		 *
		 * @since 1.0
		 * @access private
		 * @method _updateEditorFields
		 */  
		_updateEditorFields: function()
		{
			var wpEditors = $('.ep-bouwer-settings textarea.wp-editor-area');
			
			wpEditors.each(EPBOUWER._updateEditorField);
		},

		/**
		 * Updates a single editor field within a settings form. 
		 * Creates a hidden textarea with the editor content so 
		 * this field can be saved.
		 *
		 * @since 1.0
		 * @access private
		 * @method _updateEditorField
		 */  
		_updateEditorField: function()
		{
			var textarea  = $( this ),
				wrap      = textarea.closest( '.wp-editor-wrap' ),
				id        = textarea.attr( 'id' ),
				setting   = textarea.closest( '.fl-editor-field' ).attr( 'id' ),
				editor    = typeof tinyMCE == 'undefined' ? false : tinyMCE.get( id ),
				hidden    = textarea.siblings( 'textarea[name="' + setting + '"]' );
			
			// Add a hidden textarea if we don't have one.
			if ( 0 === hidden.length ) {
				hidden = $( '<textarea name="' + setting + '"></textarea>' ).hide();
				textarea.after( hidden );
			}
			
			// Update the hidden textarea content.
			if ( editor && wrap.hasClass( 'tmce-active' ) ) {
				hidden.val( editor.getContent() );
			}
			else if ( 'undefined' != typeof switchEditors ) {
				hidden.val( switchEditors.wpautop( textarea.val() ) );
			}
			else {
				hidden.val( textarea.val() );
			}
		},
		
		/* Loop Builder Fields
		----------------------------------------------------------*/

		/**
		 * Callback for when the post type of a loop builder changes.
		 *
		 * @since 1.2.3
		 * @access private
		 * @method _loopBuilderPostTypeChange
		 */ 
		_loopBuilderPostTypeChange: function()
		{
			var val = $(this).val();
			
			$('.fl-loop-builder-filter').hide();
			$('.fl-loop-builder-' + val + '-filter').show();
		},
		
		/* AJAX
		----------------------------------------------------------*/

		/**
		 * Frontend AJAX for the builder interface.
		 *
		 * @since 1.0
		 * @method ajax
		 * @param {Object} data The data for the AJAX request.
		 * @param {Function} callback A function to call when the request completes.
		 */   
		ajax: function(data, callback)
		{
			var key;
			
			// Show the loader and save the data for
			// later if a silent update is running.
			if(EPBOUWER._silentUpdate) {
				EPBOUWER.showAjaxLoader();
				EPBOUWER._silentUpdateCallbackData = [data, callback];
				return;
			}
			
			// This request is silent, set the flag to true
			// so we know incase another ajax request is made
			// before this one finishes.
			else if(data.silent === true) {
				EPBOUWER._silentUpdate = true;
			}
			
			// Send the post id to the server. 
			data.post_id = $('#fl-post-id').val();
			
			// Tell the server that the builder is active.
			data.ep_bouwer = 1;
			
			// Append the builder namespace to the action.
			data.fl_action = data.action;
			
			// Store the data in a single variable to avoid conflicts.
			data = { ep_bouwer_data: data };
			
			// Do the ajax call.
			return $.post(EPBOUWER._ajaxUrl(), data, function(response) {

				EPBOUWER._ajaxComplete();
			
				if(typeof callback !== 'undefined') {
					callback.call(this, response);
				}
			});
		},

		/**
		 * Callback for when an AJAX request is complete. Runs a
		 * queued AJAX request if a silent update was in progress 
		 * when the last request was made.
		 *
		 * @since 1.0
		 * @access private
		 * @method _ajaxComplete
		 */   
		_ajaxComplete: function()
		{
			var data, callback;
			
			// Set the silent update flag to false
			// so other ajax requests can run.
			EPBOUWER._silentUpdate = false;
			
			// Do an ajax request that was stopped 
			// by a silent ajax request.
			if(EPBOUWER._silentUpdateCallbackData !== null) {
				EPBOUWER.showAjaxLoader();
				data = EPBOUWER._silentUpdateCallbackData[0];
				callback = EPBOUWER._silentUpdateCallbackData[1];
				EPBOUWER._silentUpdateCallbackData = null;
				EPBOUWER.ajax(data, callback);
			}
			
			// We're done, hide the loader incase it's showing.
			else {
				EPBOUWER.hideAjaxLoader();
			}
		},

		/**
		 * Returns a URL for an AJAX request.
		 *
		 * @since 1.0
		 * @access private
		 * @method _ajaxUrl
		 * @param {Object} params An object with key/value pairs for the AJAX query string.
		 * @return {String} The AJAX URL. 
		 */   
		_ajaxUrl: function(params)
		{
			var url     = window.location.href.split( '#' ).shift(),
				param   = null;
			
			if(typeof params !== 'undefined') {
			
				for(param in params) {
					url += url.indexOf('?') > -1 ? '&' : '?';
					url += param + '=' + params[param];
				}
			}
		
			return url;
		},

		/**
		 * Shows the AJAX loading overlay.
		 *
		 * @since 1.0
		 * @method showAjaxLoader
		 */   
		showAjaxLoader: function()
		{
			if( 0 === $( '.ep-bouwer-lightbox-loading' ).length ) {
				$( '.ep-bouwer-loading' ).show();
			}
		},

		/**
		 * Hides the AJAX loading overlay.
		 *
		 * @since 1.0
		 * @method hideAjaxLoader
		 */   
		hideAjaxLoader: function()
		{
			$( '.ep-bouwer-loading' ).hide();
		},
		
		/* Lightboxes
		----------------------------------------------------------*/
		
		/**
		 * Shows the settings lightbox.
		 *
		 * @since 1.0
		 * @access private
		 * @method _showLightbox
		 * @param {Boolean} draggable Whether the lightbox should be draggable or not.
		 */  
		_showLightbox: function(draggable)
		{
			draggable = typeof draggable === 'undefined' ? true : draggable;
			
			EPBOUWER._lightbox.open('<div class="ep-bouwer-lightbox-loading"></div>');
			
			if(draggable) {
				EPBOUWER._lightbox.draggable({
					handle: '.fl-lightbox-header'
				});
			}
			else {
				EPBOUWER._lightbox.draggable(false);
			}
			
			EPBOUWER._removeAllOverlays();
			EPBOUWER._initLightboxScrollbars();
		},
		
		/**
		 * Set the content for the settings lightbox.
		 *
		 * @since 1.0
		 * @access private
		 * @method _setLightboxContent
		 * @param {String} content The HTML content for the lightbox.
		 */  
		_setLightboxContent: function(content)
		{
			EPBOUWER._lightbox.setContent(content);
		},
		
		/**
		 * Initializes the scrollbars for the settings lightbox.
		 *
		 * @since 1.0
		 * @access private
		 * @method _initLightboxScrollbars
		 */  
		_initLightboxScrollbars: function()
		{
			EPBOUWER._initScrollbars();
			EPBOUWER._lightboxScrollbarTimeout = setTimeout(EPBOUWER._initLightboxScrollbars, 500);
		},
		
		/**
		 * Callback to clean things up when the settings lightbox
		 * is closed.
		 *
		 * @since 1.0
		 * @access private
		 * @method _lightboxClosed
		 */  
		_lightboxClosed: function()
		{
			EPBOUWER._lightbox.empty();
			$('div.colorpicker').empty().remove();
			clearTimeout(EPBOUWER._lightboxScrollbarTimeout);
		},
		
		/**
		 * Shows the actions lightbox.
		 *
		 * @since 1.0
		 * @access private
		 * @method _showActionsLightbox
		 * @param {Object} settings An object with settings for the lightbox buttons.
		 */
		_showActionsLightbox: function(settings)
		{
			var buttons = '',
				i       = null;
				
			for(i in settings.buttons) {
				buttons += '<span class="ep-bouwer-'+ i +'-button ep-bouwer-button ep-bouwer-button-large">'+ settings.buttons[i] +'</span>';
			}
			
			EPBOUWER._actionsLightbox.open('<div class="ep-bouwer-actions '+ settings.className +'"><span class="ep-bouwer-actions-title">'+ settings.title +'</span>'+ buttons +'<span class="ep-bouwer-cancel-button ep-bouwer-button ep-bouwer-button-primary ep-bouwer-button-large">'+ EPBOUWERStrings.cancel +'</span></div>');
		},
		
		/* Alert Lightboxes
		----------------------------------------------------------*/
		
		/**
		 * Shows the alert lightbox with a message.
		 *
		 * @since 1.0
		 * @method alert
		 * @param {String} message The message to show.
		 */
		alert: function(message)
		{
			var alert = new FLLightbox({
					className: 'ep-bouwer-lightbox ep-bouwer-alert-lightbox',
					destroyOnClose: true
				}),
				html = '<div class="fl-lightbox-message">' + message + '</div><div class="fl-lightbox-footer"><span class="ep-bouwer-alert-close ep-bouwer-button ep-bouwer-button-large ep-bouwer-button-primary" href="javascript:void(0);">' + EPBOUWERStrings.ok + '</span></div>';
			
			alert.open(html);
		},
		
		/**
		 * Closes the alert lightbox when a child element is clicked.
		 *
		 * @since 1.0
		 * @access private
		 * @method _alertClose
		 */
		_alertClose: function()
		{
			FLLightbox.closeParent(this);
		},
		
		/* Console Logging
		----------------------------------------------------------*/
		
		/**
		 * Logs a message in the console if the console is available.
		 *
		 * @since 1.4.6
		 * @method log
		 * @param {String} message The message to log.
		 */
		log: function( message )
		{
			if ( 'undefined' == typeof window.console || 'undefined' == typeof window.console.log ) {
				return;
			}
			
			console.log( message );
		},
		
		/**
		 * Logs an error in the console if the console is available.
		 *
		 * @since 1.4.6
		 * @method logError
		 * @param {String} error The error to log.
		 */
		logError: function( error )
		{
			var message = null;
			
			if ( 'undefined' == typeof error ) {
				return;
			}
			else if ( 'undefined' != typeof error.stack ) {
				message = error.stack;
			}
			else if ( 'undefined' != typeof error.message ) {
				message = error.message;
			}
			
			if ( message ) {
				EPBOUWER.log( '************************************************************************' );
				EPBOUWER.log( EPBOUWERStrings.errorMessage );
				EPBOUWER.log( message );
				EPBOUWER.log( '************************************************************************' );
			}
		},
		
		/**
		 * Logs a global error in the console if the console is available.
		 *
		 * @since 1.4.6
		 * @method logGlobalError
		 * @param {String} message
		 * @param {String} file
		 * @param {String} line
		 * @param {String} col
		 * @param {String} error
		 */
		logGlobalError: function( message, file, line, col, error )
		{
			EPBOUWER.log( '************************************************************************' );
			EPBOUWER.log( EPBOUWERStrings.errorMessage );
			EPBOUWER.log( EPBOUWERStrings.globalErrorMessage.replace( '{message}', message ).replace( '{line}', line ).replace( '{file}', file ) );
			
			if ( 'undefined' != typeof error && 'undefined' != typeof error.stack ) {
				EPBOUWER.log( error.stack );
				EPBOUWER.log( '************************************************************************' );
			}
		}
	};

	/* Start the party!!! */
	$(function(){
		EPBOUWER._init();
	});

})(jQuery);