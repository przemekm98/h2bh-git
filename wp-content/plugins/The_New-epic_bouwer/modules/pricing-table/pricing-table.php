<?php

/**
 * @class FLRichTextModule
 */
class FLPricingTableModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Pricing Table', 'ep-bouwer'),
			'description'   => __('A simple pricing table generator.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer')
		));
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLPricingTableModule', array(
	'columns'      => array(
		'title'         => __('Pricing Boxes', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'pricing_columns'     => array(
						'type'         => 'form',
						'label'        => __('Pricing Box', 'ep-bouwer'),
						'form'         => 'pricing_column_form',
						'preview_text' => 'title',
						'multiple'     => true
					),
				)
			)
		)
	),
	'style'       => array(
		'title'         => __('Style', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'spacing'   => array(
						'type'          => 'select',
						'label'         => __('Box Spacing', 'ep-bouwer'),
						'default'       => 'wide',
						'options'       => array(
							'wide'      => __('Wide', 'ep-bouwer'),
							'tight'      => __('Tight', 'ep-bouwer')
						)
					),
					'min_height'   => array(
						'type'          => 'text',
						'label'         => __('Features Min Height', 'ep-bouwer'),
						'default'       => '0',
						'size'          => '5',
						'description'   => 'px',
						'help'          => __('Use this to normalize the height of your boxes when they have different numbers of features.', 'ep-bouwer')
					),
					'border_size'   => array(
						'type'          => 'select',
						'label'         => __('Border Size', 'ep-bouwer'),
						'default'       => 'wide',
						'options'       => array(
							'wide'      => _x( 'Wide', 'Border size.', 'ep-bouwer' ),
							'tight'      => _x( 'Tight', 'Border size.', 'ep-bouwer' )
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
EPBOUWER::register_settings_form('pricing_column_form', array(
	'title' => __( 'Add Pricing Box', 'ep-bouwer' ),
	'tabs'  => array(
		'general'      => array(
			'title'         => __('General', 'ep-bouwer'),
			'sections'      => array(
				'title'       => array(
					'title'         => __( 'Title', 'ep-bouwer' ),
					'fields'        => array(
						'title'          => array(
							'type'          => 'text',
							'label'         => __('Title', 'ep-bouwer'),
						),
						'title_size'        => array(
							'type'          => 'text',
							'label'         => __('Title Size', 'ep-bouwer'),
							'default'       => '24',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => 'px'
						),
					),
				),
				'price-box'       => array(
					'title'         => __( 'Price Box', 'ep-bouwer' ),
					'fields'        => array(
						'price'          => array(
							'type'          => 'text',
							'label'         => __('Price', 'ep-bouwer'),
						),
						'duration'          => array(
							'type'          => 'text',
							'label'         => __('Duration', 'ep-bouwer'),
							'placeholder'   => __( 'per Year', 'ep-bouwer' )
						),
						'price_size'        => array(
							'type'          => 'text',
							'label'         => __('Price Size', 'ep-bouwer'),
							'default'       => '31',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => 'px'
						)
					)
				),
				'button'       => array(
					'title'         => __( 'Button', 'ep-bouwer' ),
					'fields'        => array(
						'button_text'          => array(
							'type'          => 'text',
							'label'         => __('Button Text', 'ep-bouwer')
						),
						'button_url'          => array(
							'type'          => 'link',
							'label'         => __('Button URL', 'ep-bouwer')
						)
					)
				),
				'features'       => array(
					'title'         => _x( 'Features', 'Price features displayed in pricing box.', 'ep-bouwer' ),
					'fields'        => array(
						'features'          => array(
							'type'          => 'text',
							'label'         => '',
							'placeholder'   => __( 'One feature per line. HTML is okay.', 'ep-bouwer' ),
							'multiple'      => true
						)
					)
				)
			)
		),
		'style'      => array(
			'title'         => __('Style', 'ep-bouwer'),
			'sections'      => array(
				'style'       => array(
					'title'         => 'Style',
					'fields'        => array(
						'background'          => array(
							'type'          => 'color',
							'label'         => __('Box Background', 'ep-bouwer'),
							'default'       => 'F2F2F2'
						),
						'foreground'          => array(
							'type'          => 'color',
							'label'         => __('Box Foreground', 'ep-bouwer'),
							'default'       => 'ffffff'
						),
						'column_background'  => array(
							'type'          => 'color',
							'default'       => '66686b',
							'label'         => __('Accent Color', 'ep-bouwer'),
						),
						'column_color'          => array(
							'type'          => 'color',
							'default'       => 'ffffff',
							'label'         => __('Accent Text Color', 'ep-bouwer')
						),
						'margin'        => array(
							'type'          => 'text',
							'label'         => __('Box Top Margin', 'ep-bouwer'),
							'default'       => '0',
							'maxlength'     => '3',
							'size'          => '3',
							'description'   => 'px'
						)
					)
				)
			)
		)
	)
));

