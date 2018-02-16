<?php

/**
 * @class FLVideoModule
 */
class FLVideoModule extends EPBOUWERModule {

	/**
	 * @property $data
	 */
	public $data = null;

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Video', 'ep-bouwer'),
			'description'   => __('Render a WordPress or embedable video.', 'ep-bouwer'),
			'category'      => __('Basic Modules', 'ep-bouwer')
		));

		$this->add_js('jquery-fitvids');
	}

	/**
	 * @method get_data
	 */
	public function get_data()
	{
		if(!$this->data) {

			$this->data = EPBOUWERPhoto::get_attachment_data($this->settings->video);

			if(!$this->data && isset($this->settings->data)) {
				$this->data = $this->settings->data;
			}
			if($this->data) {
				$parts                  = explode('.', $this->data->filename);
				$this->data->extension  = array_pop($parts);
				$this->data->poster     = isset($this->settings->poster_src) ? $this->settings->poster_src : '';
				$this->data->loop       = isset($this->settings->loop) && $this->settings->loop ? ' loop="yes"' : '';
				$this->data->autoplay   = isset($this->settings->autoplay) && $this->settings->autoplay ? ' autoplay="yes"' : '';
			}
		}

		return $this->data;
	}

	/**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		// Cache the attachment data.
		if($settings->video_type == 'media_library') {

			$video = EPBOUWERPhoto::get_attachment_data($settings->video);

			if($video) {
				$settings->data = $video;
			}
		}

		return $settings;
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLVideoModule', array(
	'general'       => array(
		'title'         => __('General', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'video_type'       => array(
						'type'          => 'select',
						'label'         => __('Video Type', 'ep-bouwer'),
						'default'       => 'wordpress',
						'options'       => array(
							'media_library'     => __('Media Library', 'ep-bouwer'),
							'embed'             => __('Embed', 'ep-bouwer')
						),
						'toggle'        => array(
							'media_library'      => array(
								'fields'      => array('video', 'poster', 'autoplay', 'loop')
							),
							'embed'     => array(
								'fields'      => array('embed_code')
							)
						)
					),
					'video'          => array(
						'type'          => 'video',
						'label'         => __( 'Video', 'ep-bouwer' )
					),
					'poster'         => array(
						'type'          => 'photo',
						'label'         => _x( 'Poster', 'Video preview/fallback image.', 'ep-bouwer' )
					),
					'autoplay'       => array(
						'type'          => 'select',
						'label'         => __('Auto Play', 'ep-bouwer'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'loop'           => array(
						'type'          => 'select',
						'label'         => __('Loop', 'ep-bouwer'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'embed_code'     => array(
						'type'          => 'textarea',
						'label'         => __( 'Video Embed Code', 'ep-bouwer' ),
						'rows'          => '6'
					)
				)
			)
		)
	)
));