<?php

/**
 * @class FLMapModule
 */
class FLMapModule extends EPBOUWERModule {

	/** 
	 * @method __construct
	 */  
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Map', 'ep-bouwer'),
			'description'   => __('Display a Google map.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer')
		));
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLMapModule', array(
	'general'       => array(
		'title'         => __('General', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'address'       => array(
						'type'          => 'text',
						'label'         => __('Address', 'ep-bouwer'),
						'placeholder'   => __('1865 Winchester Blvd #202 Campbell, CA 95008', 'ep-bouwer'),
						'preview'         => array(
							'type'            => 'refresh'
						)
					),
					'height'        => array(
						'type'          => 'text',
						'label'         => __('Height', 'ep-bouwer'),
						'default'       => '400',
						'size'          => '5',
						'description'   => 'px'
					)
				)
			)
		)
	)
));