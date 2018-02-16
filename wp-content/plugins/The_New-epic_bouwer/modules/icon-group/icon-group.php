<?php

/**
 * @class FLIconGroupModule
 */
class FLIconGroupModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Icon Group', 'ep-bouwer'),
			'description'   => __('Display a group of linked Font Awesome icons.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer'),
			'editor_export' => false
		));
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLIconGroupModule', array(
	'icons'         => array(
		'title'         => __('Icons', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'icons'         => array(
						'type'          => 'form',
						'label'         => __('Icon', 'ep-bouwer'),
						'form'          => 'icon_group_form', // ID from registered form below
						'preview_text'  => 'icon', // Name of a field to use for the preview text
						'multiple'      => true
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
					'spacing'       => array(
						'type'          => 'text',
						'label'         => __('Spacing', 'ep-bouwer'),
						'default'       => '10',
						'maxlength'     => '2',
						'size'          => '4',
						'description'   => 'px'
					),
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'ep-bouwer'),
						'default'       => 'center',
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

/**
 * Register a settings form to use in the "form" field type above.
 */
EPBOUWER::register_settings_form('icon_group_form', array(
	'title' => __('Add Icon', 'ep-bouwer'),
	'tabs'  => array(
		'general'       => array( // Tab
			'title'         => __('General', 'ep-bouwer'), // Tab title
			'sections'      => array( // Tab Sections
				'general'       => array( // Section
					'title'         => '', // Section Title
					'fields'        => array( // Section Fields
						'icon'          => array(
							'type'          => 'icon',
							'label'         => __('Icon', 'ep-bouwer')
						),
						'link'          => array(
							'type'          => 'link',
							'label'         => __('Link', 'ep-bouwer')
						)
					)
				)
			)
		)
	)
));