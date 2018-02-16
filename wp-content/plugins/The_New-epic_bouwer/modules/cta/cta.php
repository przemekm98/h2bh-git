<?php

/**
 * @class FLCtaModule
 */
class FLCtaModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Call to Action', 'ep-bouwer'),
			'description'   => __('Display a heading, subheading and a button.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer')
		));
	}

	/**
	 * @method get_classname
	 */
	public function get_classname()
	{
		$classname = 'fl-cta-wrap fl-cta-' . $this->settings->layout;

		if($this->settings->layout == 'stacked') {
			$classname .= ' fl-cta-' . $this->settings->alignment;
		}

		return $classname;
	}

	/**
	 * @method render_button
	 */
	public function render_button()
	{
		$btn_settings = array(
			'align'             => '',
			'bg_color'          => $this->settings->btn_bg_color,
			'bg_hover_color'    => $this->settings->btn_bg_hover_color,
			'bg_opacity'        => $this->settings->btn_bg_opacity,
			'border_radius'     => $this->settings->btn_border_radius,
			'border_size'       => $this->settings->btn_border_size,
			'font_size'         => $this->settings->btn_font_size,
			'icon'              => $this->settings->btn_icon,
			'icon_position'		=> $this->settings->btn_icon_position,
			'link'              => $this->settings->btn_link,
			'link_target'       => $this->settings->btn_link_target,
			'padding'           => $this->settings->btn_padding,
			'style'             => $this->settings->btn_style,
			'text'              => $this->settings->btn_text,
			'text_color'        => $this->settings->btn_text_color,
			'text_hover_color'  => $this->settings->btn_text_hover_color,
			'width'             => $this->settings->layout == 'stacked' ? 'auto' : 'full'
		);

		EPBOUWER::render_module_html('button', $btn_settings);
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLCtaModule', array(
	'general'       => array(
		'title'         => __('General', 'ep-bouwer'),
		'sections'      => array(
			'title'         => array(
				'title'         => '',
				'fields'        => array(
					'title'         => array(
						'type'          => 'text',
						'label'         => __('Heading', 'ep-bouwer'),
						'default'       => __('Ready to find out more?', 'ep-bouwer'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-cta-title'
						)
					)
				)
			),
			'text'          => array(
				'title'         => __('Text', 'ep-bouwer'),
				'fields'        => array(
					'text'          => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false,
						'default'       => __('Drop us a line today for a free quote!', 'ep-bouwer'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-cta-text-content'
						)
					)
				)
			)
		)
	),
	'style'        => array(
		'title'         => __('Style', 'ep-bouwer'),
		'sections'      => array(
			'structure'     => array(
				'title'         => __('Structure', 'ep-bouwer'),
				'fields'        => array(
					'layout'        => array(
						'type'          => 'select',
						'label'         => __('Layout', 'ep-bouwer'),
						'default'       => 'inline',
						'options'       => array(
							'inline'        => __('Inline', 'ep-bouwer'),
							'stacked'       => __('Stacked', 'ep-bouwer')
						),
						'toggle'        => array(
							'stacked'       => array(
								'fields'        => array('alignment')
							)
						)
					),
					'alignment'     => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'ep-bouwer'),
						'default'       => 'center',
						'options'       => array(
							'left'      =>  __('Left', 'ep-bouwer'),
							'center'    =>  __('Center', 'ep-bouwer'),
							'right'     =>  __('Right', 'ep-bouwer')
						)
					),
					'spacing'       => array(
						'type'          => 'text',
						'label'         => __('Spacing', 'ep-bouwer'),
						'default'       => '0',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-module-content',
							'property'      => 'padding',
							'unit'          => 'px'
						)
					)
				)
			),
			'title_structure' => array(
				'title'         => __( 'Heading Structure', 'ep-bouwer' ),
				'fields'        => array(
					'title_tag'     => array(
						'type'          => 'select',
						'label'         => __('Heading Tag', 'ep-bouwer'),
						'default'       => 'h3',
						'options'       => array(
							'h1'            => 'h1',
							'h2'            => 'h2',
							'h3'            => 'h3',
							'h4'            => 'h4',
							'h5'            => 'h5',
							'h6'            => 'h6'
						)
					),
					'title_size'    => array(
						'type'          => 'select',
						'label'         => __('Heading Size', 'ep-bouwer'),
						'default'       => 'default',
						'options'       => array(
							'default'       =>  __('Default', 'ep-bouwer'),
							'custom'        =>  __('Custom', 'ep-bouwer')
						),
						'toggle'        => array(
							'custom'        => array(
								'fields'        => array('title_custom_size')
							)
						)
					),
					'title_custom_size' => array(
						'type'              => 'text',
						'label'             => __('Heading Custom Size', 'ep-bouwer'),
						'default'           => '24',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px'
					)
				)
			),
			'colors'        => array(
				'title'         => __('Colors', 'ep-bouwer'),
				'fields'        => array(
					'text_color'    => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'ep-bouwer'),
						'default'       => '',
						'show_reset'    => true
					),
					'bg_color'      => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'ep-bouwer'),
						'default'       => '',
						'show_reset'    => true
					),
					'bg_opacity'    => array(
						'type'          => 'text',
						'label'         => __('Background Opacity', 'ep-bouwer'),
						'default'       => '100',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5'
					)
				)
			)
		)
	),
	'button'        => array(
		'title'         => __('Button', 'ep-bouwer'),
		'sections'      => array(
			'btn_text'      => array(
				'title'         => '',
				'fields'        => array(
					'btn_text'      => array(
						'type'          => 'text',
						'label'         => __('Text', 'ep-bouwer'),
						'default'       => __('Click Here', 'ep-bouwer'),
						'preview'         => array(
							'type'            => 'text',
							'selector'        => '.fl-button-text'
						)
					),
					'btn_icon'      => array(
						'type'          => 'icon',
						'label'         => __('Icon', 'ep-bouwer'),
						'show_remove'   => true
					),
					'btn_icon_position' => array(
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
			'btn_link'      => array(
				'title'         => __('Button Link', 'ep-bouwer'),
				'fields'        => array(
					'btn_link'      => array(
						'type'          => 'link',
						'label'         => __('Link', 'ep-bouwer'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'btn_link_target' => array(
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
			),
			'btn_colors'     => array(
				'title'         => __('Button Colors', 'ep-bouwer'),
				'fields'        => array(
					'btn_bg_color'  => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'ep-bouwer'),
						'default'       => '',
						'show_reset'    => true
					),
					'btn_bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Background Hover Color', 'ep-bouwer'),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'btn_text_color' => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'ep-bouwer'),
						'default'       => '',
						'show_reset'    => true
					),
					'btn_text_hover_color' => array(
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
			'btn_style'     => array(
				'title'         => __('Button Style', 'ep-bouwer'),
				'fields'        => array(
					'btn_style'     => array(
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
								'fields'        => array('btn_bg_opacity', 'btn_border_size')
							)
						)
					),
					'btn_border_size' => array(
						'type'          => 'text',
						'label'         => __('Border Size', 'ep-bouwer'),
						'default'       => '2',
						'description'   => 'px',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					),
					'btn_bg_opacity' => array(
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
			'btn_structure' => array(
				'title'         => __('Button Structure', 'ep-bouwer'),
				'fields'        => array(
					'btn_font_size' => array(
						'type'          => 'text',
						'label'         => __('Font Size', 'ep-bouwer'),
						'default'       => '16',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'btn_padding'   => array(
						'type'          => 'text',
						'label'         => __('Padding', 'ep-bouwer'),
						'default'       => '12',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'btn_border_radius' => array(
						'type'          => 'text',
						'label'         => __('Round Corners', 'ep-bouwer'),
						'default'       => '4',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
						'preview'         => array(
							'type'            => 'css',
							'selector'        => 'a.fl-button',
							'property'        => 'border-radius',
							'unit'            => 'px'
						)
					)
				)
			)
		)
	)
));