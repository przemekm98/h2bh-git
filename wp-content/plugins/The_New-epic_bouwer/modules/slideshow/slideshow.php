<?php

/**
 * @class FLSlideshowModule
 */
class FLSlideshowModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Slideshow', 'ep-bouwer'),
			'description'   => __('Display multiple photos in a slideshow view.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer'),
			'editor_export' => false
		));

		$this->add_js('yui3');
		$this->add_js('fl-slideshow');
		$this->add_css('fl-slideshow');
	}

	/**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		// Cache the photo data if using the WordPress media library.
		if($settings->source == 'wordpress') {
			$settings->photo_data = $this->get_wordpress_photos();
		}

		return $settings;
	}

	/**
	 * @method get_source
	 */
	public function get_source()
	{
		// WordPress
		if($this->settings->source == 'wordpress') {
			return $this->get_wordpress_source();
		}

		// SmugMug
		if($this->settings->source == 'smugmug') {
			return $this->get_smugmug_source();
		}
	}

	/**
	 * @method get_wordpress_photos
	 */
	public function get_wordpress_photos()
	{
		$photos     = array();
		$ids        = $this->settings->photos;
		$thumb_w    = get_option('thumbnail_size_w');
		$medium_w   = get_option('medium_size_w');
		$large_w    = get_option('large_size_w');

		if(empty($ids)) {
			return $photos;
		}

		foreach($ids as $id) {

			$photo = EPBOUWERPhoto::get_attachment_data($id);

			// Use the cache if we didn't get a photo from the id.
			if ( ! $photo ) {

				if ( ! isset( $this->settings->photo_data ) ) {
					continue;
				}
				else if ( is_array( $this->settings->photo_data ) ) {
					$photos[ $id ] = $this->settings->photo_data[ $id ];
				}
				else if ( is_object( $this->settings->photo_data ) ) {
					$photos[ $id ] = $this->settings->photo_data->{$id};
				}
				else {
					continue;
				}
			}

			// Only use photos who have the sizes object.
			if(isset($photo->sizes)) {

				// Photo data object
				$data = new stdClass();
				$data->caption = $photo->caption;

				// Photo sizes
				if(isset($photo->sizes->large)) {

					$data->largeURL = $photo->sizes->large->url;

					if($photo->sizes->full->width <= 2560) {
						$data->x3largeURL = $photo->sizes->full->url;
					}
					else {
						$data->x3largeURL = $photo->sizes->large->url;
					}
				}
				else {
					$data->largeURL = $photo->sizes->full->url;
					$data->x3largeURL = $photo->sizes->full->url;
				}

				// Thumb size
				if(isset($photo->sizes->thumbnail)) {
					$data->thumbURL = $photo->sizes->thumbnail->url;
				}
				else {
					$data->thumbURL = $photo->sizes->full->url;
				}

				// Push the photo data
				$photos[$id] = $data;
			}
		}

		return $photos;
	}

	/**
	 * @method get_wordpress_source
	 */
	public function get_wordpress_source()
	{
		$photos = $this->get_wordpress_photos();

		// Build the source js object
		if(count($photos) > 0) {

			$source = 'type: "urls", urls:';
			$objects = array();

			foreach($photos as $photo) {
				$caption = str_replace( array("\r", "\n") , '', nl2br( htmlspecialchars( $photo->caption ) ) );
				$urls = '{' . "\n";
				$urls .= 'thumbURL: "'. $photo->thumbURL .'",';
				$urls .= 'largeURL: "'. $photo->largeURL .'",';
				$urls .= 'x3largeURL: "'. $photo->x3largeURL .'",';
				$urls .= 'caption: "'. $caption .'"';
				$urls .= '}';
				$objects[] = $urls;
			}

			return $source . '[' . implode(',', $objects) . ']';
		}
		else {
			return '';
		}
	}

	/**
	 * @method get_smugmug_source
	 */
	public function get_smugmug_source()
	{
		$gallery_id = array();
		$parts = explode('?', $this->settings->feed_url);

		if(count($parts) == 2) {

			$parts = explode('&', $parts[1]);

			foreach($parts as $part) {
				if(stristr($part, 'data')) {
					$parts = explode('=', $part);
					$gallery_id = explode('_', $parts[1]);
					break;
				}
			}
		}

		if(count($gallery_id) > 0) {
			return 'type: "smugmug", id: "'. $gallery_id[0] .'", key: "'. $gallery_id[1] .'"';
		}
		else {
			return '';
		}
	}

	/**
	 * @method get_nav_buttons
	 */
	public function get_nav_buttons()
	{
		$buttons = array();

		if($this->settings->nav_type == 'buttons') {

			if($this->settings->arrow_buttons) {
				$buttons[] = '"prev"';
			}
			if($this->settings->play_button) {
				$buttons[] = '"play"';
			}
			if($this->settings->arrow_buttons) {
				$buttons[] = '"next"';
			}

			echo implode(',', $buttons);
		}
	}

	/**
	 * @method get_nav_buttons_left
	 */
	public function get_nav_buttons_left()
	{

		$buttons = array();

		if($this->settings->thumbs_button && $this->settings->nav_type != 'thumbs') {
			$buttons[] = '"thumbs"';
		}
		if($this->settings->caption_button) {
			$buttons[] = '"caption"';
		}
		if($this->settings->social_button) {
			$buttons[] = '"social"';
		}
		if($this->settings->nav_type == 'thumbs') {
			$buttons[] = '"prevPage"';
		}

		echo implode(',', $buttons);
	}

	/**
	 * @method get_nav_buttons_right
	 */
	public function get_nav_buttons_right()
	{
		$buttons = array();

		if($this->settings->count) {
			$buttons[] = '"count"';
		}
		if($this->settings->fs_button) {
			$buttons[] = '"fullscreen"';
		}
		if($this->settings->nav_type == 'thumbs') {
			$buttons[] = '"nextPage"';
		}

		echo implode(',', $buttons);
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLSlideshowModule', array(
	'general'       => array(
		'title'         => __('General', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'source'        => array(
						'type'          => 'select',
						'label'         => __('Source', 'ep-bouwer'),
						'default'       => 'wordpress',
						'options'       => array(
							'wordpress'     => __('Media Library', 'ep-bouwer'),
							'smugmug'       => 'SmugMug'
						),
						'help'          => __('Pull images from the WordPress media library or a gallery on your SmugMug site by inserting the RSS feed URL from SmugMug. The RSS feed URL can be accessed by using the get a link function in your SmugMug gallery.', 'ep-bouwer'),
						'toggle'        => array(
							'wordpress'      => array(
								'fields'        => array('photos')
							),
							'smugmug'        => array(
								'fields'        => array('feed_url')
							)
						)
					),
					'photos'        => array(
						'type'          => 'multiple-photos',
						'label'         => __('Photos', 'ep-bouwer')
					),
					'feed_url'      => array(
						'type'          => 'text',
						'label'         => __('Feed URL', 'ep-bouwer')
					)
				)
			),
			'display'       => array(
				'title'         => __('Display', 'ep-bouwer'),
				'fields'        => array(
					'height'        => array(
						'type'          => 'text',
						'label'         => __('Height', 'ep-bouwer'),
						'default'       => '500',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => 'px'
					),
					'color'         => array(
						'type'          => 'select',
						'label'         => __('Skin Color', 'ep-bouwer'),
						'default'       => 'light',
						'options'       => array(
							'light'         => _x( 'Light', 'Color.', 'ep-bouwer' ),
							'dark'          => _x( 'Dark', 'Color.', 'ep-bouwer' )
						),
						'help'          => __('If your overall theme/images are lighter in color, light will display buttons in a darker color scheme and vice versa for dark.', 'ep-bouwer')
					),
					'crop'          => array(
						'type'          => 'select',
						'label'         => __('Crop', 'ep-bouwer'),
						'default'       => '0',
						'options'       => array(
							'0'            => __('No', 'ep-bouwer'),
							'1'            => __('Yes', 'ep-bouwer')
						),
						'help'          => __('Crop set to no will fit the slideshow images to the height you specify and keep the width proportional, whereas crop set to yes will fit the slideshow images to all sides of the content area while cropping the left and right to fit the height you specify.', 'ep-bouwer')
					),
					'protect'       => array(
						'type'          => 'select',
						'label'         => __('Disable Right-Click', 'ep-bouwer'),
						'default'       => 'true',
						'options'       => array(
							'false'         => __('No', 'ep-bouwer'),
							'true'          => __('Yes', 'ep-bouwer')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			),
			'click_action'  => array(
				'title'         => __('Click Action', 'ep-bouwer'),
				'fields'        => array(
					'click_action'  => array(
						'type'          => 'select',
						'label'         => __('Type', 'ep-bouwer'),
						'default'       => 'none',
						'options'       => array(
							'none'          => _x( 'None', 'Click action type.', 'ep-bouwer' ),
							'url'           => __('Link', 'ep-bouwer')
						),
						'toggle'        => array(
							'url'           => array(
								'fields'        => array('click_action_url')
							)
						),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'click_action_url' => array(
						'type'          => 'link',
						'label'         => __('Link URL', 'ep-bouwer'),
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			)
		)
	),
	'playback'      => array(
		'title'         => __('Playback', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'auto_play'     => array(
						'type'          => 'select',
						'label'         => __('Auto Play', 'ep-bouwer'),
						'default'       => 'true',
						'options'       => array(
							'false'         => __('No', 'ep-bouwer'),
							'true'          => __('Yes', 'ep-bouwer')
						)
					),
					'speed'         => array(
						'type'          => 'text',
						'label'         => __('Speed', 'ep-bouwer'),
						'default'       => '3',
						'size'          => '5',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'ep-bouwer' )
					),
					'transition'     => array(
						'type'          => 'select',
						'label'         => __('Transition', 'ep-bouwer'),
						'default'       => 'fade',
						'options'       => array(
							'none'              => _x( 'None', 'Slideshow transition.', 'ep-bouwer' ),
							'fade'              => __('Fade', 'ep-bouwer'),
							'kenBurns'          => __('Ken Burns', 'ep-bouwer'),
							'slideHorizontal'   => __('Slide Horizontal', 'ep-bouwer'),
							'slideVertical'     => __('Slide Vertical', 'ep-bouwer'),
							'blinds'            => __('Blinds', 'ep-bouwer'),
							'bars'              => __('Bars', 'ep-bouwer'),
							'barsRandom'        => __('Random Bars', 'ep-bouwer'),
							'boxes'             => __('Boxes', 'ep-bouwer'),
							'boxesRandom'       => __('Random Boxes', 'ep-bouwer'),
							'boxesGrow'         => __('Boxes Grow', 'ep-bouwer')
						)
					),
					'transitionDuration' => array(
						'type'          => 'text',
						'label'         => __('Transition Speed', 'ep-bouwer'),
						'default'       => '1',
						'size'          => '5',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'ep-bouwer' )
					),
					'randomize'     => array(
						'type'          => 'select',
						'label'         => __('Randomize Photos', 'ep-bouwer'),
						'default'       => 'false',
						'options'       => array(
							'false'         => __('No', 'ep-bouwer'),
							'true'          => __('Yes', 'ep-bouwer')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			)
		)
	),
	'controls'      => array(
		'title'         => __('Controls', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'image_nav'     => array(
						'type'          => 'select',
						'label'         => __('Navigation Arrows', 'ep-bouwer'),
						'default'       => 'true',
						'options'       => array(
							'false'         => __('No', 'ep-bouwer'),
							'true'          => __('Yes', 'ep-bouwer')
						),
						'help'          => __('Navigational arrows allow the visitor to freely move through the images in your slideshow. These are larger arrows that overlay your slideshow images and are separate from the control bar navigational arrows.', 'ep-bouwer')
					)
				)
			),
			'control_bar'   => array(
				'title'         => __('Control Bar', 'ep-bouwer'),
				'fields'        => array(
					'nav_type'      => array(
						'type'          => 'select',
						'label'         => __('Nav Type', 'ep-bouwer'),
						'default'       => 'none',
						'options'       => array(
							'none'          => _x( 'None', 'Nav type.', 'ep-bouwer' ),
							'buttons'       => __('Buttons', 'ep-bouwer'),
							'thumbs'        => __('Thumbs', 'ep-bouwer')
						),
						'toggle'        => array(
							'buttons'       => array(
								'sections'      => array('control_bar_buttons', 'control_bar_overlay', 'thumbs', 'social'),
								'fields'        => array('nav_position', 'arrow_buttons', 'thumbs_button')
							),
							'thumbs'        => array(
								'sections'      => array('control_bar_buttons', 'control_bar_overlay', 'thumbs', 'social'),
								'fields'        => array('nav_position')
							)
						)
					),
					'nav_position'      => array(
						'type'          => 'select',
						'label'         => __('Nav Position', 'ep-bouwer'),
						'default'       => 'bottom',
						'options'       => array(
							'bottom'        => __('Bottom', 'ep-bouwer'),
							'top'           => __('Top', 'ep-bouwer')
						)
					)
				)
			),
			'control_bar_buttons' => array(
				'title'         => __('Control Bar Buttons', 'ep-bouwer'),
				'fields'        => array(
					'arrow_buttons' => array(
						'type'          => 'select',
						'label'         => __('Navigation Arrows', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						)
					),
					'play_button'   => array(
						'type'          => 'select',
						'label'         => __('Play Button', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						)
					),
					'fs_button'     => array(
						'type'          => 'select',
						'label'         => __('Fullscreen Button', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						)
					),
					'count'         => array(
						'type'          => 'select',
						'label'         => __('Photo Count', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						)
					),
					'thumbs_button' => array(
						'type'          => 'select',
						'label'         => __('Thumbs Button', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						)
					),
					'caption_button' => array(
						'type'          => 'select',
						'label'         => __('Caption Button', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						)
					),
					'social_button' => array(
						'type'          => 'select',
						'label'         => __('Social Button', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						)
					)
				)
			),
			'control_bar_overlay' => array(
				'title'         => __('Control Bar Overlay', 'ep-bouwer'),
				'fields'        => array(
					'nav_overlay'   => array(
						'type'          => 'select',
						'label'         => __('Overlay Enabled', 'ep-bouwer'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						),
						'toggle'        => array(
							'1'             => array(
								'fields'        => array('overlay_hide', 'overlay_hide_delay')
							)
						),
						'help'          => __('Control bar overlay specifies if the control bar buttons you choose overlay your slideshow images or site below the slideshow completely.', 'ep-bouwer')
					),
					'overlay_hide'  => array(
						'type'          => 'select',
						'label'         => __('Overlay Hide', 'ep-bouwer'),
						'default'       => 'true',
						'options'       => array(
							'false'         => __('No', 'ep-bouwer'),
							'true'          => __('Yes', 'ep-bouwer')
						),
						'help'          => __('Overlay hide will hide the control bar after however many seconds you specify below. They will reappear upon mouse over.', 'ep-bouwer')
					),
					'overlay_hide_delay' => array(
						'type'          => 'text',
						'label'         => __('Overlay Hide Delay', 'ep-bouwer'),
						'default'       => '3',
						'size'          => '5',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'ep-bouwer' )
					)
				)
			),
			'thumbs' => array(
				'title'         => __('Thumbs', 'ep-bouwer'),
				'fields'        => array(
					'thumbs_size'   => array(
						'type'          => 'text',
						'label'         => __('Thumbs Size', 'ep-bouwer'),
						'default'       => '50',
						'maxlength'     => '3',
						'size'          => '5',
						'description'   => 'px'
					)
				)
			),
			'social'        => array(
				'title'         => __('Social', 'ep-bouwer'),
				'fields'        => array(
					'facebook'      => array(
						'type'          => 'select',
						'label'         => __('Facebook Button', 'ep-bouwer'),
						'default'       => 'true',
						'options'       => array(
							'false'         => __('No', 'ep-bouwer'),
							'true'          => __('Yes', 'ep-bouwer')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'twitter'       => array(
						'type'          => 'select',
						'label'         => __('Twitter Button', 'ep-bouwer'),
						'default'       => 'true',
						'options'       => array(
							'false'         => __('No', 'ep-bouwer'),
							'true'          => __('Yes', 'ep-bouwer')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'google'        => array(
						'type'          => 'select',
						'label'         => __('Google Plus Button', 'ep-bouwer'),
						'default'       => 'true',
						'options'       => array(
							'false'         => __('No', 'ep-bouwer'),
							'true'          => __('Yes', 'ep-bouwer')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'pinterest'     => array(
						'type'          => 'select',
						'label'         => __('Pinterest Button', 'ep-bouwer'),
						'default'       => 'true',
						'options'       => array(
							'false'         => __('No', 'ep-bouwer'),
							'true'          => __('Yes', 'ep-bouwer')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			)
		)
	)
));