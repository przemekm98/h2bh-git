<?php

/**
 * @class FLSeparatorModule
 */
class FLSeparatorModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Separator', 'ep-bouwer'),
			'description'   => __('A divider line to separate content.', 'ep-bouwer'),
			'category'      => __('Basic Modules', 'ep-bouwer'),
			'editor_export' => false
		));
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLSeparatorModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'ep-bouwer'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'color'         => array(
						'type'          => 'color',
						'label'         => __('Color', 'ep-bouwer'),
						'default'       => 'cccccc',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-separator',
							'property'      => 'border-top-color'
						)
					),
					'opacity'    => array(
						'type'          => 'text',
						'label'         => __('Opacity', 'ep-bouwer'),
						'default'       => '100',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-separator',
							'property'      => 'opacity',
							'unit'          => '%'
						)
					),
					'height'        => array(
						'type'          => 'text',
						'label'         => __('Height', 'ep-bouwer'),
						'default'       => '1',
						'maxlength'     => '2',
						'size'          => '3',
						'description'   => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-separator',
							'property'      => 'border-top-width',
							'unit'          => 'px'
						)
					),
					'style'         => array(
						'type'          => 'select',
						'label'         => __('Style', 'ep-bouwer'),
						'default'       => 'solid',
						'options'       => array(
							'solid'         => _x( 'Solid', 'Border type.', 'ep-bouwer' ),
							'dashed'        => _x( 'Dashed', 'Border type.', 'ep-bouwer' ),
							'dotted'        => _x( 'Dotted', 'Border type.', 'ep-bouwer' ),
							'double'        => _x( 'Double', 'Border type.', 'ep-bouwer' )
						),
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-separator',
							'property'      => 'border-top-style'
						),
						'help'          => __('The type of border to use. Double borders must have a height of at least 3px to render properly.', 'ep-bouwer'),
					)
				)
			)
		)
	)
));