<?php

/**
 * @class FLHeadingModule
 */
class FLHeadingModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Heading', 'ep-bouwer'),
			'description'   => __('Display a title/page heading.', 'ep-bouwer'),
			'category'      => __('Basic Modules', 'ep-bouwer')
		));
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLHeadingModule', array(
	'general'       => array(
		'title'         => __('General', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'heading'        => array(
						'type'            => 'text',
						'label'           => __('Heading', 'ep-bouwer'),
						'default'         => '',
						'preview'         => array(
							'type'            => 'text',
							'selector'        => '.fl-heading-text'
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
						'preview'         => array(
							'type'            => 'none'
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
						'preview'         => array(
							'type'            => 'none'
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
					'color'          => array(
						'type'          => 'color',
						'show_reset'    => true,
						'label'         => __('Text Color', 'ep-bouwer')
					)
				)
			),
			'structure'     => array(
				'title'         => __('Structure', 'ep-bouwer'),
				'fields'        => array(
					'alignment'     => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'ep-bouwer'),
						'default'       => 'left',
						'options'       => array(
							'left'      =>  __('Left', 'ep-bouwer'),
							'center'    =>  __('Center', 'ep-bouwer'),
							'right'     =>  __('Right', 'ep-bouwer')
						),
						'preview'         => array(
							'type'            => 'css',
							'selector'        => '.fl-heading',
							'property'        => 'text-align'
						)
					),
					'tag'           => array(
						'type'          => 'select',
						'label'         => __( 'HTML Tag', 'ep-bouwer' ),
						'default'       => 'h3',
						'options'       => array(
							'h1'            =>  'h1',
							'h2'            =>  'h2',
							'h3'            =>  'h3',
							'h4'            =>  'h4',
							'h5'            =>  'h5',
							'h6'            =>  'h6'
						)
					),
					'font_size'     => array(
						'type'          => 'select',
						'label'         => __('Font Size', 'ep-bouwer'),
						'default'       => 'default',
						'options'       => array(
							'default'       =>  __('Default', 'ep-bouwer'),
							'custom'        =>  __('Custom', 'ep-bouwer')
						),
						'toggle'        => array(
							'custom'        => array(
								'fields'        => array('custom_font_size')
							)
						)
					),
					'custom_font_size' => array(
						'type'          => 'text',
						'label'         => __('Custom Font Size', 'ep-bouwer'),
						'default'       => '24',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					)
				)
			),
			'r_structure'   => array(
				'title'         => __( 'Mobile Structure', 'ep-bouwer' ),
				'fields'        => array(
					'r_alignment'   => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'ep-bouwer'),
						'default'       => 'default',
						'options'       => array(
							'default'       =>  __('Default', 'ep-bouwer'),
							'custom'        =>  __('Custom', 'ep-bouwer')
						),
						'toggle'        => array(
							'custom'        => array(
								'fields'        => array('r_custom_alignment')
							)
						),
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'r_custom_alignment' => array(
						'type'          => 'select',
						'label'         => __('Custom Alignment', 'ep-bouwer'),
						'default'       => 'center',
						'options'       => array(
							'left'      =>  __('Left', 'ep-bouwer'),
							'center'    =>  __('Center', 'ep-bouwer'),
							'right'     =>  __('Right', 'ep-bouwer')
						),
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'r_font_size'   => array(
						'type'          => 'select',
						'label'         => __('Font Size', 'ep-bouwer'),
						'default'       => 'default',
						'options'       => array(
							'default'       =>  __('Default', 'ep-bouwer'),
							'custom'        =>  __('Custom', 'ep-bouwer')
						),
						'toggle'        => array(
							'custom'        => array(
								'fields'        => array('r_custom_font_size')
							)
						),
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'r_custom_font_size' => array(
						'type'          => 'text',
						'label'         => __('Custom Font Size', 'ep-bouwer'),
						'default'       => '24',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
						'preview'         => array(
							'type'            => 'none'
						)
					)
				)
			)
		)
	)
));