<?php

/**
 * @class FLIconModule
 */
class FLIconModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Icon', 'ep-bouwer'),
			'description'   => __('Display an icon and optional title.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer'),
			'editor_export' => false
		));
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLIconModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'ep-bouwer'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'icon'          => array(
						'type'          => 'icon',
						'label'         => __('Icon', 'ep-bouwer')
					)
				)
			),
			'link'          => array(
				'title'         => 'Link',
				'fields'        => array(
					'link'          => array(
						'type'          => 'link',
						'label'         => __('Link', 'ep-bouwer'),
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
			),
			'text'          => array(
				'title'         => 'Text',
				'fields'        => array(
					'text'          => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false
					)
				)
			)
		)
	),
	'style'         => array( // Tab
		'title'         => __('Style', 'ep-bouwer'), // Tab title
		'sections'      => array( // Tab Sections
			'colors'        => array( // Section
				'title'         => __('Colors', 'ep-bouwer'), // Section Title
				'fields'        => array( // Section Fields
					'color'         => array(
						'type'          => 'color',
						'label'         => __('Color', 'ep-bouwer'),
						'show_reset'    => true
					),
					'hover_color' => array(
						'type'          => 'color',
						'label'         => __('Hover Color', 'ep-bouwer'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'bg_color'      => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'ep-bouwer'),
						'show_reset'    => true
					),
					'bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Background Hover Color', 'ep-bouwer'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'three_d'       => array(
						'type'          => 'select',
						'label'         => __('Gradient', 'ep-bouwer'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						)
					)
				)
			),
			'structure'     => array( // Section
				'title'         => __('Structure', 'ep-bouwer'), // Section Title
				'fields'        => array( // Section Fields
					'size'          => array(
						'type'          => 'text',
						'label'         => __('Size', 'ep-bouwer'),
						'default'       => '30',
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
					)
				)
			)
		)
	)
));