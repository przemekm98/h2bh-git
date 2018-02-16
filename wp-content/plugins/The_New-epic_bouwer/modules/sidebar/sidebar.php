<?php

/**
 * @class FLSidebarModule
 */
class FLSidebarModule extends EPBOUWERModule {

	/** 
	 * @method __construct
	 */  
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Sidebar', 'ep-bouwer'),
			'description'   => __('Display a WordPress sidebar that has been registered by the current theme.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer'),
			'editor_export' => false
		));
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLSidebarModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'ep-bouwer'), // Tab title
		'file'          => EP_BOUWER_DIR . 'modules/sidebar/includes/settings-general.php'
	)
));