<?php

/**
 * @class FLTestimonialsModule
 */
class FLTestimonialsModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Testimonials', 'ep-bouwer'),
			'description'   => __('An animated tesimonials area.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer')
		));

		$this->add_css('jquery-bxslider');
		$this->add_css('font-awesome');
		$this->add_js('jquery-bxslider');
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLTestimonialsModule', array(
	'general'      => array( // Tab
		'title'         => __('General', 'ep-bouwer'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'layout'       => array(
						'type'          => 'select',
						'label'         => __('Layout', 'ep-bouwer'),
						'default'       => 'compact',
						'options'       => array(
							'wide'             => __('Wide', 'ep-bouwer'),
							'compact'             => __('Compact', 'ep-bouwer')
						),
						'toggle'        => array(
							'compact'      => array(
								'sections'      => array('heading', 'arrow_nav')
							),
							'wide'      => array(
								'sections'      => array('dot_nav')
							)
						),
						'help' => __('Wide is for 1 column rows, compact is for multi-column rows.', 'ep-bouwer')
					)
				)
			),
			'heading'       => array( // Section
				'title'         => __('Heading', 'ep-bouwer'), // Section Title
				'fields'        => array( // Section Fields
					'heading'         => array(
						'type'          => 'text',
						'default'       => __( 'Testimonials', 'ep-bouwer' ),
						'label'         => __('Heading', 'ep-bouwer'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-testimonials-heading'
						)
					),
					'heading_size'         => array(
						'type'          => 'text',
						'label'         => __('Heading Size', 'ep-bouwer'),
						'default'       => '24',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					)
				)
			),
			'slider'       => array( // Section
				'title'         => __('Slider Settings', 'ep-bouwer'), // Section Title
				'fields'        => array( // Section Fields
					'auto_play'     => array(
						'type'          => 'select',
						'label'         => __('Auto Play', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						)
					),
					'pause'         => array(
						'type'          => 'text',
						'label'         => __('Delay', 'ep-bouwer'),
						'default'       => '4',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'ep-bouwer' )
					),
					'transition'    => array(
						'type'          => 'select',
						'label'         => __('Transition', 'ep-bouwer'),
						'default'       => 'slide',
						'options'       => array(
							'horizontal'    => _x( 'Slide', 'Transition type.', 'ep-bouwer' ),
							'fade'          => __( 'Fade', 'ep-bouwer' )
						)
					),
					'speed'         => array(
						'type'          => 'text',
						'label'         => __('Transition Speed', 'ep-bouwer'),
						'default'       => '0.5',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'ep-bouwer' )
					)
				)
			),
			'arrow_nav'       => array( // Section
				'title'         => '',
				'fields'        => array( // Section Fields
					'arrows'       => array(
						'type'          => 'select',
						'label'         => __('Show Arrows', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						),
						'toggle'        => array(
							'1'         => array(
								'fields'        => array('arrow_color')
							)
						)
					),
					'arrow_color'       => array(
						'type'          => 'color',
						'label'         => __('Arrow Color', 'ep-bouwer'),
						'default'       => '999999',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-testimonials-wrap .fa',
							'property'      => 'color'
						)
					)
				)
			),
			'dot_nav'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'dots'       => array(
						'type'          => 'select',
						'label'         => __('Show Dots', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						),
						'toggle'        => array(
							'1'         => array(
								'fields'        => array('dot_color')
							)
						)
					),
					'dot_color'       => array(
						'type'          => 'color',
						'label'         => __('Dot Color', 'ep-bouwer'),
						'default'       => '999999',
						'show_reset'    => true
					)
				)
			)
		)
	),
	'testimonials'      => array( // Tab
		'title'         => __('Testimonials', 'ep-bouwer'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'testimonials'     => array(
						'type'          => 'form',
						'label'         => __('Testimonial', 'ep-bouwer'),
						'form'          => 'testimonials_form', // ID from registered form below
						'preview_text'  => 'testimonial', // Name of a field to use for the preview text
						'multiple'      => true
					),
				)
			)
		)
	)
));


/**
 * Register a settings form to use in the "form" field type above.
 */
EPBOUWER::register_settings_form('testimonials_form', array(
	'title' => __('Add Testimonial', 'ep-bouwer'),
	'tabs'  => array(
		'general'      => array( // Tab
			'title'         => __('General', 'ep-bouwer'), // Tab title
			'sections'      => array( // Tab Sections
				'general'       => array( // Section
					'title'         => '', // Section Title
					'fields'        => array( // Section Fields
						'testimonial'          => array(
							'type'          => 'editor',
							'label'         => ''
						)
					)
				)
			)
		)
	)
));