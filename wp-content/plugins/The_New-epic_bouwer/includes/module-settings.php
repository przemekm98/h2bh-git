<?php

$global_settings = EPBOUWERModel::get_global_settings();

EPBOUWER::register_settings_form('module_advanced', array(
	'title'         => __('Advanced', 'ep-bouwer'),
	'sections'      => array(
		'margins'       => array(
			'title'         => __('Margins', 'ep-bouwer'),
			'fields'        => array(
				'margin_top'    => array(
					'type'          => 'text',
					'label'         => __( 'Top', 'ep-bouwer' ),
					'default'       => '',
					'description'   => 'px',
					'maxlength'     => '4',
					'size'          => '5',
					'placeholder'   => $global_settings->module_margins,
					'preview'         => array(
						'type'            => 'none'
					)
				),
				'margin_bottom' => array(
					'type'          => 'text',
					'label'         => __( 'Bottom', 'ep-bouwer' ),
					'default'       => '',
					'description'   => 'px',
					'maxlength'     => '4',
					'size'          => '5',
					'placeholder'   => $global_settings->module_margins,
					'preview'         => array(
						'type'            => 'none'
					)
				),
				'margin_left'   => array(
					'type'          => 'text',
					'label'         => __( 'Left', 'ep-bouwer' ),
					'default'       => '',
					'description'   => 'px',
					'maxlength'     => '4',
					'size'          => '5',
					'placeholder'   => $global_settings->module_margins,
					'preview'         => array(
						'type'            => 'none'
					)
				),
				'margin_right'  => array(
					'type'          => 'text',
					'label'         => __( 'Right', 'ep-bouwer' ),
					'default'       => '',
					'description'   => 'px',
					'maxlength'     => '4',
					'size'          => '5',
					'placeholder'   => $global_settings->module_margins,
					'preview'         => array(
						'type'            => 'none'
					)
				)
			)
		),
		'responsive'   => array(
			'title'         => __('Responsive Layout', 'ep-bouwer'),
			'fields'        => array(
				'responsive_display' => array(
					'type'          => 'select',
					'label'         => __('Display', 'ep-bouwer'),
					'options'       => array(
						''                  => __('Always', 'ep-bouwer'),
						'desktop'           => __('Large Devices Only', 'ep-bouwer'),
						'desktop-medium'    => __('Large &amp; Medium Devices Only', 'ep-bouwer'),
						'medium'            => __('Medium Devices Only', 'ep-bouwer'),
						'medium-mobile'     => __('Medium &amp; Small Devices Only', 'ep-bouwer'),
						'mobile'            => __('Small Devices Only', 'ep-bouwer'),
					),
					'help'          => __( 'Choose whether to show or hide this module at different device sizes.', 'ep-bouwer' ),
					'preview'         => array(
						'type'            => 'none'
					)
				)
			)
		),
		'animation'    => array(
			'title'         => __('Animation', 'ep-bouwer'),
			'fields'        => array(
				'animation'     => array(
					'type'          => 'select',
					'label'         => __('Style', 'ep-bouwer'),
					'options'       => array(
						''              => _x( 'None', 'Animation style.', 'ep-bouwer' ),
						'fade-in'       => _x( 'Fade In', 'Animation style.', 'ep-bouwer' ),
						'slide-left'    => _x( 'Slide Left', 'Animation style.', 'ep-bouwer' ),
						'slide-right'   => _x( 'Slide Right', 'Animation style.', 'ep-bouwer' ),
						'slide-up'      => _x( 'Slide Up', 'Animation style.', 'ep-bouwer' ),
						'slide-down'    => _x( 'Slide Down', 'Animation style.', 'ep-bouwer' ),
					),
					'preview'         => array(
						'type'            => 'none'
					)
				),
				'animation_delay' => array(
					'type'          => 'text',
					'label'         => __('Delay', 'ep-bouwer'),
					'default'       => '0.0',
					'maxlength'     => '4',
					'size'          => '5',
					'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'ep-bouwer' ),
					'help'          => __('The amount of time in seconds before this animation starts.', 'ep-bouwer'),
					'preview'         => array(
						'type'            => 'none'
					)
				)
			)
		),
		'css_selectors' => array(
			'title'         => __('CSS Selectors', 'ep-bouwer'),
			'fields'        => array(
				'id'            => array(
					'type'          => 'text',
					'label'         => __('ID', 'ep-bouwer'),
					'help'          => __( "A unique ID that will be applied to this module's HTML. Must start with a letter and only contain dashes, underscores, letters or numbers. No spaces.", 'ep-bouwer' ),
					'preview'         => array(
						'type'            => 'none'
					)
				),
				'class'         => array(
					'type'          => 'text',
					'label'         => __('Class', 'ep-bouwer'),
					'help'          => __( "A class that will be applied to this module's HTML. Must start with a letter and only contain dashes, underscores, letters or numbers. Separate multiple classes with spaces.", 'ep-bouwer' ),
					'preview'         => array(
						'type'            => 'none'
					)
				)
			)
		)
	)
));