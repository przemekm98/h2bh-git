<?php

/**
 * @class FLHtmlModule
 */
class FLHtmlModule extends EPBOUWERModule {

	/** 
	 * @method __construct
	 */  
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('HTML', 'ep-bouwer'),
			'description'   => __('Display raw HTML code.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer')
		));
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLHtmlModule', array(
	'general'       => array(
		'title'         => __('General', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'html'          => array(
						'type'          => 'code',
						'editor'        => 'html',
						'label'         => '',
						'rows'          => '18',
						'preview'           => array(
							'type'              => 'text',
							'selector'          => '.fl-html'
						)
					)
				)
			)
		)
	)
));