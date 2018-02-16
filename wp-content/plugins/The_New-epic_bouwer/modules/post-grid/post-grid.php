<?php

/**
 * @class FLPostGridModule
 */
class FLPostGridModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Posts', 'ep-bouwer'),
			'description'   => __('Display a grid of your WordPress posts.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer'),
			'editor_export' => false,
			'enabled'       => true
		));
	}

	/**
	 * @method enqueue_scripts
	 */
	public function enqueue_scripts()
	{
		if(EPBOUWERModel::is_builder_active() || $this->settings->layout == 'grid') {
			$this->add_js('jquery-masonry');
		}
		if(EPBOUWERModel::is_builder_active() || $this->settings->layout == 'gallery') {
			$this->add_js('fl-gallery-grid');
		}
		if(EPBOUWERModel::is_builder_active() || $this->settings->pagination == 'scroll') {
			$this->add_js('jquery-infinitescroll');
		}
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLPostGridModule', array(
	'layout'        => array(
		'title'         => __('Layout', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'layout'        => array(
						'type'          => 'select',
						'label'         => __('Layout Style', 'ep-bouwer'),
						'default'       => 'grid',
						'options'       => array(
							'grid'          => __('Grid', 'ep-bouwer'),
							'gallery'       => __('Gallery', 'ep-bouwer'),
							'feed'          => __('Feed', 'ep-bouwer'),
						),
						'toggle'        => array(
							'grid'          => array(
								'sections'      => array('grid', 'image', 'content'),
								'fields'        => array('show_author')
							),
							'feed'          => array(
								'sections'      => array('image', 'content'),
								'fields'        => array('image_position', 'show_author', 'show_comments', 'content_type')
							)
						)
					),
					'pagination'     => array(
						'type'          => 'select',
						'label'         => __('Pagination Style', 'ep-bouwer'),
						'default'       => 'numbers',
						'options'       => array(
							'numbers'       => __('Numbers', 'ep-bouwer'),
							'scroll'        => __('Scroll', 'ep-bouwer'),
							'none'          => _x( 'None', 'Pagination style.', 'ep-bouwer' ),
						)
					),
					'posts_per_page' => array(
						'type'          => 'text',
						'label'         => __('Posts Per Page', 'ep-bouwer'),
						'default'       => '10',
						'size'          => '4'
					),
				)
			),
			'grid'          => array(
				'title'         => __('Grid', 'ep-bouwer'),
				'fields'        => array(
					'post_width'    => array(
						'type'          => 'text',
						'label'         => __('Post Width', 'ep-bouwer'),
						'default'       => '300',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'post_spacing'  => array(
						'type'          => 'text',
						'label'         => __('Post Spacing', 'ep-bouwer'),
						'default'       => '60',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
				)
			),
			'image'        => array(
				'title'         => __( 'Featured Image', 'ep-bouwer' ),
				'fields'        => array(
					'show_image'    => array(
						'type'          => 'select',
						'label'         => __('Image', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'1'             => __('Show', 'ep-bouwer'),
							'0'             => __('Hide', 'ep-bouwer')
						),
						'toggle'        => array(
							'1'             => array(
								'fields'        => array('image_size')
							)
						)
					),
					'image_position' => array(
						'type'          => 'select',
						'label'         => __('Position', 'ep-bouwer'),
						'default'       => 'above',
						'options'       => array(
							'above'         => __('Above Text', 'ep-bouwer'),
							'beside'        => __('Beside Text', 'ep-bouwer')
						)
					),
					'image_size'    => array(
						'type'          => 'photo-sizes',
						'label'         => __('Size', 'ep-bouwer'),
						'default'       => 'medium'
					),
				)
			),
			'info'          => array(
				'title'         => __( 'Post Info', 'ep-bouwer' ),
				'fields'        => array(
					'show_author'   => array(
						'type'          => 'select',
						'label'         => __('Author', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'1'             => __('Show', 'ep-bouwer'),
							'0'             => __('Hide', 'ep-bouwer')
						)
					),
					'show_date'     => array(
						'type'          => 'select',
						'label'         => __('Date', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'1'             => __('Show', 'ep-bouwer'),
							'0'             => __('Hide', 'ep-bouwer')
						),
						'toggle'        => array(
							'1'             => array(
								'fields'        => array('date_format')
							)
						)
					),
					'date_format'   => array(
						'type'          => 'select',
						'label'         => __('Date Format', 'ep-bouwer'),
						'default'       => 'M j, Y',
						'options'       => array(
							// Note for developer: I would personally add this as a text field with a default value of get_option( 'date_format' )
							'M j, Y'        => date('M j, Y'),
							'F j, Y'        => date('F j, Y'),
							'm/d/Y'         => date('m/d/Y'),
							'm-d-Y'         => date('m-d-Y'),
							'd M Y'         => date('d M Y'),
							'd F Y'         => date('d F Y'),
							'Y-m-d'         => date('Y-m-d'),
							'Y/m/d'         => date('Y/m/d'),
						)
					),
					'show_comments' => array(
						'type'          => 'select',
						'label'         => __('Comments', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'1'             => __('Show', 'ep-bouwer'),
							'0'             => __('Hide', 'ep-bouwer')
						)
					),
				)
			),
			'content'       => array(
				'title'         => __( 'Content', 'ep-bouwer' ),
				'fields'        => array(
					'show_content'  => array(
						'type'          => 'select',
						'label'         => __('Content', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'1'             => __('Show', 'ep-bouwer'),
							'0'             => __('Hide', 'ep-bouwer')
						)
					),
					'content_type'  => array(
						'type'          => 'select',
						'label'         => __('Content Type', 'ep-bouwer'),
						'default'       => 'excerpt',
						'options'       => array(
							'excerpt'        => __('Excerpt', 'ep-bouwer'),
							'full'           => __('Full Text', 'ep-bouwer')
						)
					),
					'show_more_link' => array(
						'type'          => 'select',
						'label'         => __('More Link', 'ep-bouwer'),
						'default'       => '0',
						'options'       => array(
							'1'             => __('Show', 'ep-bouwer'),
							'0'             => __('Hide', 'ep-bouwer')
						)
					),
					'more_link_text' => array(
						'type'          => 'text',
						'label'         => __('More Link Text', 'ep-bouwer'),
						'default'       => __('Read More', 'ep-bouwer'),
					),
				)
			)
		)
	),
	'content'   => array(
		'title'         => __('Content', 'ep-bouwer'),
		'file'          => EP_BOUWER_DIR . 'includes/loop-settings.php',
	)
));