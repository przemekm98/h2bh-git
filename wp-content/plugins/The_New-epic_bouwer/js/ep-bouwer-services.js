(function( $ ) {
	
	/**
	 * JavaScript class for working with third party services.
	 *
	 * @since 1.5.4
	 */
	var EPBOUWERServices = {
		
		/**
		 * Initializes the services logic.
		 *
		 * @return void
		 * @since 1.5.4
		 */
		init: function()
		{
			var body = $('body');
			
			// Standard Events
			body.delegate( '.ep-bouwer-service-select', 'change', this._serviceChange );
			body.delegate( '.ep-bouwer-service-connect-button', 'click', this._connectClicked );
			body.delegate( '.ep-bouwer-service-account-select', 'change', this._accountChange );
			body.delegate( '.ep-bouwer-service-account-delete', 'click', this._accountDeleteClicked );
			
			// Campaign Monitor Events
			body.delegate( '.ep-bouwer-campaign-monitor-client-select', 'change', this._campaignMonitorClientChange );
			
			// MailChimp Events
			body.delegate( '.ep-bouwer-mailchimp-list-select', 'change', this._mailChimpListChange );
		},
		
		/**
		 * Show the lightbox loading graphic and remove errors.
		 *
		 * @param {Object} ele An element within the lightbox.
		 * @return void
		 * @since 1.5.4
		 */
		_startSettingsLoading: function( ele )
		{
			var lightbox    = $( '.ep-bouwer-settings' ),
				wrap        = ele.closest( '.ep-bouwer-service-settings' ),
				error       = $( '.ep-bouwer-service-error' );
			
			lightbox.append( '<div class="ep-bouwer-loading"></div>' );
			wrap.addClass( 'ep-bouwer-service-settings-loading' );
			error.remove();
		},
		
		/**
		 * Remove the lightbox loading graphic.
		 *
		 * @return void
		 * @since 1.5.4
		 */
		_finishSettingsLoading: function()
		{
			var lightbox    = $( '.ep-bouwer-settings' ),
				wrap        = $( '.ep-bouwer-service-settings-loading' );
			
			lightbox.find( '.ep-bouwer-loading' ).remove();
			wrap.removeClass( 'ep-bouwer-service-settings-loading' );
		},
		
		/**
		 * Fires when the service select changes.
		 *
		 * @return void
		 * @since 1.5.4
		 */
		_serviceChange: function()
		{
			var nodeId      = $( '.ep-bouwer-settings' ).data( 'node' ),
				select      = $( this ),
				selectRow   = select.closest( 'tr' ),
				service     = select.val();
			
			selectRow.siblings( 'tr.ep-bouwer-service-account-row' ).remove();
			selectRow.siblings( 'tr.ep-bouwer-service-connect-row' ).remove();
			selectRow.siblings( 'tr.ep-bouwer-service-field-row' ).remove();
			$( '.ep-bouwer-service-error' ).remove();
				
			if ( '' == service ) {
				return;
			}
			
			EPBOUWERServices._startSettingsLoading( select );
			
			EPBOUWER.ajax( {
				action  : 'ep_bouwer_render_service_settings',
				node_id : nodeId,
				service : service
			}, EPBOUWERServices._serviceChangeComplete );
		},
		
		/**
		 * AJAX callback for when the service select changes.
		 *
		 * @param {String} response The JSON response.
		 * @return void
		 * @since 1.5.4
		 */
		_serviceChangeComplete: function( response )
		{
			var data        = JSON.parse( response ),
				wrap        = $( '.ep-bouwer-service-settings-loading' ),
				selectRow   = wrap.find( '.ep-bouwer-service-select-row' );
				
			selectRow.after( data.html );
			EPBOUWERServices._addAccountDelete( wrap );
			EPBOUWERServices._finishSettingsLoading();
		},
		
		/**
		 * Fires when the service connect button is clicked.
		 *
		 * @return void
		 * @since 1.5.4
		 */
		_connectClicked: function()
		{
			var nodeId          = $( '.ep-bouwer-settings' ).data( 'node' ),
				wrap            = $( this ).closest( '.ep-bouwer-service-settings' ),
				select          = wrap.find( '.ep-bouwer-service-select' ),
				connectRows     = wrap.find( '.ep-bouwer-service-connect-row' ),
				connectInputs   = wrap.find( '.ep-bouwer-service-connect-input' ),
				input           = null,
				name            = null,
				i               = 0,
				data            = {
					action          : 'ep_bouwer_connect_service',
					node_id         : nodeId,
					service         : select.val(),
					fields          : {}
				};
			
			for ( ; i < connectInputs.length; i++ ) {
				input                   = connectInputs.eq( i );
				name                    = input.attr( 'name' );
				data['fields'][ name ]  = input.val();
			}
			
			connectRows.hide();
			EPBOUWERServices._startSettingsLoading( select );
			EPBOUWER.ajax( data, EPBOUWERServices._connectComplete );
		},
		
		/**
		 * AJAX callback for when the service connect button is clicked.
		 *
		 * @param {String} response The JSON response.
		 * @return void
		 * @since 1.5.4
		 */
		_connectComplete: function( response )
		{
			var data        = JSON.parse( response ),
				wrap        = $( '.ep-bouwer-service-settings-loading' ),
				selectRow   = wrap.find( '.ep-bouwer-service-select-row' ),
				select      = wrap.find( '.ep-bouwer-service-select' ),
				accountRow  = wrap.find( '.ep-bouwer-service-account-row' ),
				account     = wrap.find( '.ep-bouwer-service-account-select' ),
				connectRows = wrap.find( '.ep-bouwer-service-connect-row' );
			
			if ( data.error ) {
				
				connectRows.show();
				
				if ( 0 === account.length ) {
					select.after( '<div class="ep-bouwer-service-error">' + data.error + '</div>' );
				}
				else {
					account.after( '<div class="ep-bouwer-service-error">' + data.error + '</div>' );
				}
			}
			else {
				connectRows.remove();
				accountRow.remove();
				selectRow.after( data.html );
			}
			
			EPBOUWERServices._addAccountDelete( wrap );
			EPBOUWERServices._finishSettingsLoading();
		},
		
		/**
		 * Fires when the service account select changes.
		 *
		 * @return void
		 * @since 1.5.4
		 */
		_accountChange: function()
		{
			var nodeId      = $( '.ep-bouwer-settings' ).data( 'node' ),
				wrap        = $( this ).closest( '.ep-bouwer-service-settings' ),
				select      = wrap.find( '.ep-bouwer-service-select' ),
				account     = wrap.find( '.ep-bouwer-service-account-select' ),
				connectRows = wrap.find( '.ep-bouwer-service-connect-row' ),
				fieldRows   = wrap.find( 'tr.ep-bouwer-service-field-row' ),
				error       = $( '.ep-bouwer-service-error' ),
				value       = account.val(),
				data        = null;
			
			connectRows.remove();
			fieldRows.remove();
			error.remove();
			
			if ( 'add_new_account' == value ) {
				data = {
					action  : 'ep_bouwer_render_service_settings',
					node_id : nodeId,
					service : select.val(),
					add_new : true
				};
			}
			else if ( '' != value ) {
				data = {
					action  : 'ep_bouwer_render_service_fields',
					node_id : nodeId,
					service : select.val(),
					account : value
				};
			}
			
			if ( data ) {
				EPBOUWERServices._startSettingsLoading( select );
				EPBOUWER.ajax( data, EPBOUWERServices._accountChangeComplete );
			}
			
			EPBOUWERServices._addAccountDelete( wrap );
		},
		
		/**
		 * AJAX callback for when the service account select changes.
		 *
		 * @param {String} response The JSON response.
		 * @return void
		 * @since 1.5.4
		 */
		_accountChangeComplete: function( response )
		{
			var data        = JSON.parse( response ),
				wrap        = $( '.ep-bouwer-service-settings-loading' ),
				accountRow  = wrap.find( '.ep-bouwer-service-account-row' );
			
			accountRow.after( data.html );
			EPBOUWERServices._finishSettingsLoading();
		},
		
		/**
		 * Adds an account delete link.
		 *
		 * @param {Object} wrap An element within the lightbox.
		 * @return void
		 * @since 1.5.4
		 */
		_addAccountDelete: function( wrap )
		{
			var account = wrap.find( '.ep-bouwer-service-account-select' );
			
			if ( account.length > 0 ) {
				
				wrap.find( '.ep-bouwer-service-account-delete' ).remove();
				
				if ( '' != account.val() && 'add_new_account' != account.val() ) {
					account.after( '<a href="javascript:void(0);" class="ep-bouwer-service-account-delete">' + EPBOUWERStrings.deleteAccount + '</a>' );
				}
			}
		},
		
		/**
		 * Fires when the account delete link is clicked.
		 *
		 * @return void
		 * @since 1.5.4
		 */
		_accountDeleteClicked: function()
		{
			var wrap        = $( this ).closest( '.ep-bouwer-service-settings' ),
				select      = wrap.find( '.ep-bouwer-service-select' ),
				account     = wrap.find( '.ep-bouwer-service-account-select' );
			
			if ( confirm( EPBOUWERStrings.deleteAccountWarning ) ) {
			
				EPBOUWER.ajax( {
					action  : 'ep_bouwer_delete_service_account',
					service : select.val(),
					account : account.val()
				}, EPBOUWERServices._accountDeleteComplete );
				
				EPBOUWERServices._startSettingsLoading( account );
			}
		},
		
		/**
		 * AJAX callback for when the account delete link is clicked.
		 *
		 * @return void
		 * @since 1.5.4
		 */
		_accountDeleteComplete: function()
		{
			var wrap   = $( '.ep-bouwer-service-settings-loading' ),
				select = wrap.find( '.ep-bouwer-service-select' );
				
			EPBOUWERServices._finishSettingsLoading();
				
			select.trigger( 'change' );
		},
		
		/* Campaign Monitor
		----------------------------------------------------------*/
		
		/**
		 * Fires when the Campaign Monitor client select is changed.
		 *
		 * @return void
		 * @since 1.5.4
		 */
		_campaignMonitorClientChange: function()
		{
			var nodeId      = $( '.ep-bouwer-settings' ).data( 'node' ),
				wrap        = $( this ).closest( '.ep-bouwer-service-settings' ),
				select      = wrap.find( '.ep-bouwer-service-select' ),
				account     = wrap.find( '.ep-bouwer-service-account-select' ),
				client      = $( this ),
				list        = wrap.find( '.ep-bouwer-service-list-select' ),
				value       = client.val();
			
			if ( 0 != list.length ) {
				list.closest( 'tr' ).remove();
			}
			if ( '' == value ) {
				return;
			}
			
			EPBOUWERServices._startSettingsLoading( select );
			
			EPBOUWER.ajax( {
				action  : 'ep_bouwer_render_service_fields',
				node_id : nodeId,
				service : select.val(),
				account : account.val(),
				client  : value
			}, EPBOUWERServices._campaignMonitorClientChangeComplete );
		},
		
		/**
		 * AJAX callback for when the Campaign Monitor client select is changed.
		 *
		 * @param {String} response The JSON response.
		 * @return void
		 * @since 1.5.4
		 */
		_campaignMonitorClientChangeComplete: function( response )
		{
			var data    = JSON.parse( response ),
				wrap    = $( '.ep-bouwer-service-settings-loading' ),
				client  = wrap.find( '.ep-bouwer-campaign-monitor-client-select' );
			
			client.closest( 'tr' ).after( data.html );
			EPBOUWERServices._finishSettingsLoading();
		},
		
		/* MailChimp
		----------------------------------------------------------*/
		
		/**
		 * Fires when the MailChimp list select is changed.
		 *
		 * @return void
		 * @since 1.6.0
		 */
		_mailChimpListChange: function()
		{
			var nodeId      = $( '.ep-bouwer-settings' ).data( 'node' ),
				wrap        = $( this ).closest( '.ep-bouwer-service-settings' ),
				select      = wrap.find( '.ep-bouwer-service-select' ),
				account     = wrap.find( '.ep-bouwer-service-account-select' ),
				list        = wrap.find( '.ep-bouwer-service-list-select' );
			
			$( '.ep-bouwer-mailchimp-group-select' ).closest( 'tr' ).remove();
			
			if ( '' == list.val() ) {
				return;
			}
			
			EPBOUWERServices._startSettingsLoading( select );
			
			EPBOUWER.ajax( {
				action  : 'ep_bouwer_render_service_fields',
				node_id : nodeId,
				service : select.val(),
				account : account.val(),
				list_id : list.val()
			}, EPBOUWERServices._mailChimpListChangeComplete );
		},
		
		/**
		 * AJAX callback for when the MailChimp list select is changed.
		 *
		 * @param {String} response The JSON response.
		 * @return void
		 * @since 1.6.0
		 */
		_mailChimpListChangeComplete: function( response )
		{
			var data    = JSON.parse( response ),
				wrap    = $( '.ep-bouwer-service-settings-loading' ),
				list    = wrap.find( '.ep-bouwer-service-list-select' );
			
			list.closest( 'tr' ).after( data.html );
			EPBOUWERServices._finishSettingsLoading();
		}
	};

	$ ( function() {
		EPBOUWERServices.init();
	});

})( jQuery );