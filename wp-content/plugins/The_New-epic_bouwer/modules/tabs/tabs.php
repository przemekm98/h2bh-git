<?php

/**
 * @class FLTabsModule
 */
class FLTabsModule extends EPBOUWERModule {

	/** 
	 * @method __construct
	 */  
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Tabs', 'ep-bouwer'),
			'description'   => __('Display a collection of tabbed content.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer')
		));
		
		$this->add_css('font-awesome');
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLTabsModule', array(
	'items'         => array(
		'title'         => __('Items', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'items'         => array(
						'type'          => 'form',
						'label'         => __('Item', 'ep-bouwer'),
						'form'          => 'items_form', // ID from registered form below
						'preview_text'  => 'label', // Name of a field to use for the preview text
						'multiple'      => true
					),
				)
			)
		)
	),
	'style'        => array(
		'title'         => __('Style', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(                              
					'layout'        => array(
						'type'          => 'select',
						'label'         => __('Layout', 'ep-bouwer'),
						'default'       => 'horizontal',
						'options'       => array(
							'horizontal'    => __('Horizontal', 'ep-bouwer'),
							'vertical'      => __('Vertical', 'ep-bouwer'),
						)
					),                             
					'border_color'  => array(
						'type'          => 'color',
						'label'         => __('Border Color', 'ep-bouwer'),
						'default'       => 'e5e5e5'
					),    
				)
			)
		)
	)
));

/**
 * Register a settings form to use in the "form" field type above.
 */
EPBOUWER::register_settings_form('items_form', array(
	'title' => __('Add Item', 'ep-bouwer'),
	'tabs'  => array(
		'general'      => array(
			'title'         => __('General', 'ep-bouwer'),
			'sections'      => array(
				'general'       => array(
					'title'         => '',
					'fields'        => array(       
						'label'         => array(
							'type'          => 'text',
							'label'         => __('Label', 'ep-bouwer')
						)
					)
				),
				'content'       => array(
					'title'         => __('Content', 'ep-bouwer'),
					'fields'        => array( 
						'content'       => array(
							'type'          => 'editor',
							'label'         => ''
						)
					)
				)
			)
		)
	)
));