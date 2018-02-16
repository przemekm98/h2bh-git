<?php

/**
 * @class FLButtonModule
 */
class FLButtonModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Button', 'ep-bouwer'),
			'description'   => __('A simple call to action button.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer')
		));
	}

	/**
	 * @method update
	 */
	public function update( $settings )
	{
		// Remove the old three_d setting.
		if ( isset( $settings->three_d ) ) {
			unset( $settings->three_d );
		}
		
		return $settings;
	}

	/**
	 * @method get_classname
	 */
	public function get_classname()
	{
		$classname = 'fl-button-wrap';

		if(!empty($this->settings->width)) {
			$classname .= ' fl-button-width-' . $this->settings->width;
		}
		if(!empty($this->settings->align)) {
			$classname .= ' fl-button-' . $this->settings->align;
		}
		if(!empty($this->settings->icon)) {
			$classname .= ' fl-button-has-icon';
		}

		return $classname;
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLButtonModule', array(
	'general'       => array(
		'title'         => __('General', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'text'          => array(
						'type'          => 'text',
						'label'         => __('Text', 'ep-bouwer'),
						'default'       => __('Click Here', 'ep-bouwer'),
						'preview'         => array(
							'type'            => 'text',
							'selector'        => '.fl-button-text'
						)
					),
					'icon'          => array(
						'type'          => 'icon',
						'label'         => __('Icon', 'ep-bouwer'),
						'show_remove'   => true
					),
					'icon_position' => array(
						'type'          => 'select',
						'label'         => __('Icon Position', 'ep-bouwer'),
						'default'       => 'before',
						'options'       => array(
							'before'        => __('Before Text', 'ep-bouwer'),
							'after'         => __('After Text', 'ep-bouwer')
						)
					)
				)
			),
			'link'          => array(
				'title'         => __('Link', 'ep-bouwer'),
				'fields'        => array(
					'link'          => array(
						'type'          => 'link',
						'label'         => __('Link', 'ep-bouwer'),
						'placeholder'   => __( 'http://www.example.com', 'ep-bouwer' ),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'link_target'   => array(
						'type'          => 'select',
						'label'         => __('Link Target', 'ep-bouwer'),
						'default'       => '_self',
						'options'       => array(
							'_self'         => __('Same Window', 'ep-bouwer'),
							'_blank'        => __('New Window', 'ep-bouwer')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			)
		)
	),
	'style'         => array(
		'title'         => __('Style', 'ep-bouwer'),
		'sections'      => array(
			'colors'        => array(
				'title'         => __('Colors', 'ep-bouwer'),
				'fields'        => array(
					'bg_color'      => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'ep-bouwer'),
						'default'       => '',
						'show_reset'    => true
					),
					'bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Background Hover Color', 'ep-bouwer'),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'text_color'    => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'ep-bouwer'),
						'default'       => '',
						'show_reset'    => true
					),
					'text_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Text Hover Color', 'ep-bouwer'),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			),
			'style'         => array(
				'title'         => __('Style', 'ep-bouwer'),
				'fields'        => array(
					'style'         => array(
						'type'          => 'select',
						'label'         => __('Style', 'ep-bouwer'),
						'default'       => 'flat',
						'options'       => array(
							'flat'          => __('Flat', 'ep-bouwer'),
							'gradient'      => __('Gradient', 'ep-bouwer'),
							'transparent'   => __('Transparent', 'ep-bouwer')
						),
						'toggle'        => array(
							'transparent'   => array(
								'fields'        => array('bg_opacity', 'border_size')
							)
						)
					),
					'border_size'   => array(
						'type'          => 'text',
						'label'         => __('Border Size', 'ep-bouwer'),
						'default'       => '2',
						'description'   => 'px',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					),
					'bg_opacity'    => array(
						'type'          => 'text',
						'label'         => __('Background Opacity', 'ep-bouwer'),
						'default'       => '0',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					)
				)  
			),
			'formatting'    => array(
				'title'         => __('Structure', 'ep-bouwer'),
				'fields'        => array(
					'width'         => array(
						'type'          => 'select',
						'label'         => __('Width', 'ep-bouwer'),
						'default'       => 'auto',
						'options'       => array(
							'auto'          => _x( 'Auto', 'Width.', 'ep-bouwer' ),
							'full'          => __('Full Width', 'ep-bouwer'),
							'custom'        => __('Custom', 'ep-bouwer')
						),
						'toggle'        => array(
							'auto'          => array(
								'fields'        => array('align')
							),
							'full'          => array(),
							'custom'        => array(
								'fields'        => array('align', 'custom_width')
							)
						)
					),
					'custom_width'  => array(
						'type'          => 'text',
						'label'         => __('Custom Width', 'ep-bouwer'),
						'default'       => '200',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'ep-bouwer'),
						'default'       => 'left',
						'options'       => array(
							'center'        => __('Center', 'ep-bouwer'),
							'left'          => __('Left', 'ep-bouwer'),
							'right'         => __('Right', 'ep-bouwer')
						)
					),
					'font_size'     => array(
						'type'          => 'text',
						'label'         => __('Font Size', 'ep-bouwer'),
						'default'       => '16',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'padding'       => array(
						'type'          => 'text',
						'label'         => __('Padding', 'ep-bouwer'),
						'default'       => '12',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'border_radius' => array(
						'type'          => 'text',
						'label'         => __('Round Corners', 'ep-bouwer'),
						'default'       => '4',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					)
				)
			)
		)
	)
));