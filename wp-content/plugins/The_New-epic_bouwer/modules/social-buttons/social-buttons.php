<?php

/**
 * @class FLShortcodeModule
 */
class FLSocialButtonModule extends EPBOUWERModule {

	/** 
	 * @method __construct
	 */  
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Social Buttons', 'ep-bouwer'),
			'description'   => __('Displays social buttons.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer'),
			'editor_export' => false
		));
	}

	/** 
	 * @method update
	 * @param $settings {object}
	 */      
	public function update($settings)
	{
		global $post;
		
		// If the URL is not custom, build the current page's URL
		if($settings->url_type == 'current') {
			$settings->the_url = get_permalink($post->ID);
		}  
		else {
			$settings->the_url = $settings->custom_url;
		}
		
		return $settings;
	}

	/** 
	 * Adds the fb-root div to the page footer
	 * @method add_fb_root
	 */      
	public function add_fb_root() 
	{
		add_action('wp_footer', array('FLSocialButtonModule', 'fb_root'));
	}

	/** 
	 * Actually echos the fb_root div
	 * @method fb_root
	 */      
	 public static function fb_root() 
	 {
		echo '<div id="fb-root"></div>';
	 }
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLSocialButtonModule', array(
	'general'       => array(
		'title'         => __('General', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'url_type'   => array(
						'type'          => 'select',
						'label'         => __('Target URL', 'ep-bouwer'),
						'default'       => 'current',
						'options'       => array(
							'custom'      => __('Custom', 'ep-bouwer'),
							'current'     => __('Current Page', 'ep-bouwer')
						),
						'toggle'        => array(
							'custom'      => array(
								'fields'        => array('custom_url')
							)
						),
						'help' => __('The Target URL field correlates to the page you would like your social icons to interface with. For example, if you show Facebook, the user will "Like" whatever you put in this field.', 'ep-bouwer'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'custom_url'   => array(
						'type'          => 'text',
						'label'         => __('Custom URL', 'ep-bouwer'),
						'placeholder' => 'http://www.example.com',
						'preview'       => array(
							'type'          => 'none'
						)
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
					'show_facebook'   => array(
						'type'          => 'select',
						'label'         => __('Show Facebook', 'ep-bouwer'),
						'default'       => 1,
						'options'       => array(
							1      => __('Yes', 'ep-bouwer'),
							0     => __('No', 'ep-bouwer')
						)
					),
					'show_twitter'   => array(
						'type'          => 'select',
						'label'         => __('Show Twitter', 'ep-bouwer'),
						'default'       => 1,
						'options'       => array(
							1      => __('Yes', 'ep-bouwer'),
							0     => __('No', 'ep-bouwer')
						)
					),
					'show_gplus'   => array(
						'type'          => 'select',
						'label'         => __('Show Google+', 'ep-bouwer'),
						'default'       => 1,
						'options'       => array(
							1      => __('Yes', 'ep-bouwer'),
							0     => __('No', 'ep-bouwer')
						)
					)
				)
			)
		)
	)
));