<?php

/**
 * @class FLAccordionModule
 */
class FLAccordionModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Accordion', 'ep-bouwer'),
			'description'   => __('Display a collapsible accordion of items.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer')
		));

		$this->add_css('font-awesome');
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLAccordionModule', array(
	'items'         => array(
		'title'         => __('Items', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'items'         => array(
						'type'          => 'form',
						'label'         => __('Item', 'ep-bouwer'),
						'form'          => 'accordion_items_form', // ID from registered form below
						'preview_text'  => 'label', // Name of a field to use for the preview text
						'multiple'      => true
					)
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
					'border_color'  => array(
						'type'          => 'color',
						'label'         => __('Border Color', 'ep-bouwer'),
						'default'       => 'e5e5e5',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-accordion-item',
							'property'      => 'border-color'
						)
					),
					'label_size'   => array(
						'type'          => 'select',
						'label'         => __('Label Size', 'ep-bouwer'),
						'default'       => 'small',
						'options'       => array(
							'small'         => _x( 'Small', 'Label size.', 'ep-bouwer' ),
							'medium'        => _x( 'Medium', 'Label size.', 'ep-bouwer' ),
							'large'         => _x( 'Large', 'Label size.', 'ep-bouwer' )
						),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'item_spacing'     => array(
						'type'          => 'text',
						'label'         => __('Item Spacing', 'ep-bouwer'),
						'default'       => '10',
						'maxlength'     => '2',
						'size'          => '3',
						'description'   => 'px',
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'collapse'   => array(
						'type'          => 'select',
						'label'         => __('Collapse Inactive', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'1'             => __('Yes', 'ep-bouwer'),
							'0'             => __('No', 'ep-bouwer')
						),
						'help'          => __('Choosing yes will keep only one item open at a time. Choosing no will allow multiple items to be open at the same time.', 'ep-bouwer'),
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			)
		)
	)
));

/**
 * Register a settings form to use in the "form" field type above.
 */
EPBOUWER::register_settings_form('accordion_items_form', array(
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