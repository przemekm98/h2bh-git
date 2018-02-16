<?php

/**
 * @class FLPhotoModule
 */
class FLPhotoModule extends EPBOUWERModule {

	/**
	 * @property $data
	 */
	public $data = null;

	/**
	 * @property $_editor
	 * @protected
	 */
	protected $_editor = null;

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Photo', 'ep-bouwer'),
			'description'   => __('Upload a photo or display one from the media library.', 'ep-bouwer'),
			'category'      => __('Basic Modules', 'ep-bouwer')
		));
	}

	/**
	 * @method enqueue_scripts
	 */
	public function enqueue_scripts()
	{
		if($this->settings && $this->settings->link_type == 'lightbox') {
			$this->add_js('jquery-magnificpopup');
			$this->add_css('jquery-magnificpopup');
		}
	}

	/**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		// Make sure we have a photo_src property.
		if(!isset($settings->photo_src)) {
			$settings->photo_src = '';
		}

		// Cache the attachment data.
		$data = EPBOUWERPhoto::get_attachment_data($settings->photo);

		if($data) {
			$settings->data = $data;
		}

		// Save a crop if necessary.
		$this->crop();

		return $settings;
	}

	/**
	 * @method delete
	 */
	public function delete()
	{
		$cropped_path = $this->_get_cropped_path();

		if(file_exists($cropped_path['path'])) {
			unlink($cropped_path['path']);
		}
	}

	/**
	 * @method crop
	 */
	public function crop()
	{
		// Delete an existing crop if it exists.
		$this->delete();

		// Do a crop.
		if(!empty($this->settings->crop)) {

			$editor = $this->_get_editor();

			if(!$editor || is_wp_error($editor)) {
				return false;
			}

			$cropped_path = $this->_get_cropped_path();
			$size         = $editor->get_size();
			$new_width    = $size['width'];
			$new_height   = $size['height'];

			// Get the crop ratios.
			if($this->settings->crop == 'landscape') {
				$ratio_1 = 1.43;
				$ratio_2 = .7;
			}
			elseif($this->settings->crop == 'panorama') {
				$ratio_1 = 2;
				$ratio_2 = .5;
			}
			elseif($this->settings->crop == 'portrait') {
				$ratio_1 = .7;
				$ratio_2 = 1.43;
			}
			elseif($this->settings->crop == 'square') {
				$ratio_1 = 1;
				$ratio_2 = 1;
			}
			elseif($this->settings->crop == 'circle') {
				$ratio_1 = 1;
				$ratio_2 = 1;
			}

			// Get the new width or height.
			if($size['width'] / $size['height'] < $ratio_1) {
				$new_height = $size['width'] * $ratio_2;
			}
			else {
				$new_width = $size['height'] * $ratio_1;
			}

			// Make sure we have enough memory to crop.
			@ini_set('memory_limit', '300M');

			// Crop the photo.
			$editor->resize($new_width, $new_height, true);

			// Save the photo.
			$editor->save($cropped_path['path']);

			// Return the new url.
			return $cropped_path['url'];
		}

		return false;
	}

	/**
	 * @method get_data
	 */
	public function get_data()
	{
		if(!$this->data) {

			// Photo source is set to "url".
			if($this->settings->photo_source == 'url') {
				$this->data = new stdClass();
				$this->data->alt = $this->settings->caption;
				$this->data->caption = $this->settings->caption;
				$this->data->link = $this->settings->photo_url;
				$this->data->url = $this->settings->photo_url;
				$this->settings->photo_src = $this->settings->photo_url;
			}

			// Photo source is set to "library".
			else if(is_object($this->settings->photo)) {
				$this->data = $this->settings->photo;
			}
			else {
				$this->data = EPBOUWERPhoto::get_attachment_data($this->settings->photo);
			}

			// Data object is empty, use the settings cache.
			if(!$this->data && isset($this->settings->data)) {
				$this->data = $this->settings->data;
			}
		}

		return $this->data;
	}

	/**
	 * @method get_src
	 */
	public function get_src()
	{
		$src = $this->_get_uncropped_url();

		// Return a cropped photo.
		if($this->_has_source() && !empty($this->settings->crop)) {

			$cropped_path = $this->_get_cropped_path();

			// See if the cropped photo already exists.
			if(file_exists($cropped_path['path'])) {
				$src = $cropped_path['url'];
			}
			// It doesn't, check if this is a demo image.
			elseif(stristr($src, EP_BOUWER_DEMO_URL) && !stristr(EP_BOUWER_DEMO_URL, $_SERVER['HTTP_HOST'])) {
				$src = $this->_get_cropped_demo_url();
			}
			// It doesn't, check if this is a OLD demo image.
			elseif(stristr($src, EP_BOUWER_OLD_DEMO_URL)) {
				$src = $this->_get_cropped_demo_url();
			}
			// A cropped photo doesn't exist, try to create one.
			else {

				$url = $this->crop();

				if($url) {
					$src = $url;
				}
			}
		}

		return $src;
	}

	/**
	 * @method get_link
	 */
	public function get_link()
	{
		$photo = $this->get_data();

		if($this->settings->link_type == 'url') {
			$link = $this->settings->link_url;
		}
		else if($this->settings->link_type == 'lightbox') {
			$link = $photo->url;
		}
		else if($this->settings->link_type == 'file') {
			$link = $photo->url;
		}
		else if($this->settings->link_type == 'page') {
			$link = $photo->link;
		}
		else {
			$link = '';
		}

		return $link;
	}

	/**
	 * @method get_alt
	 */
	public function get_alt()
	{
		$photo = $this->get_data();

		if(!empty($photo->alt)) {
			return htmlspecialchars($photo->alt);
		}
		else if(!empty($photo->description)) {
			return htmlspecialchars($photo->description);
		}
		else if(!empty($photo->caption)) {
			return htmlspecialchars($photo->caption);
		}
		else if(!empty($photo->title)) {
			return htmlspecialchars($photo->title);
		}
	}

	/**
	 * @method _has_source
	 * @protected
	 */
	protected function _has_source()
	{
		if($this->settings->photo_source == 'url' && !empty($this->settings->photo_url)) {
			return true;
		}
		else if($this->settings->photo_source == 'library' && !empty($this->settings->photo_src)) {
			return true;
		}

		return false;
	}

	/**
	 * @method _get_editor
	 * @protected
	 */
	protected function _get_editor()
	{
		if($this->_has_source() && $this->_editor === null) {

			$url_path  = $this->_get_uncropped_url();
			$file_path = str_ireplace(home_url(), ABSPATH, $url_path);

			if(file_exists($file_path)) {
				$this->_editor = wp_get_image_editor($file_path);
			}
			else {
				$this->_editor = wp_get_image_editor($url_path);
			}
		}

		return $this->_editor;
	}

	/**
	 * @method _get_cropped_path
	 * @protected
	 */
	protected function _get_cropped_path()
	{
		$crop        = empty($this->settings->crop) ? 'none' : $this->settings->crop;
		$url         = $this->_get_uncropped_url();
		$cache_dir   = EPBOUWERModel::get_cache_dir();

		if(empty($url)) {
			$filename    = uniqid(); // Return a file that doesn't exist.
		}
		else {
			$pathinfo    = pathinfo($url);
			$dir         = $pathinfo['dirname'];
			$ext         = $pathinfo['extension'];
			$name        = wp_basename($url, ".$ext");
			$new_ext     = strtolower($ext);
			$filename    = "{$name}-{$crop}.{$new_ext}";
		}

		return array(
			'filename' => $filename,
			'path'     => $cache_dir['path'] . $filename,
			'url'      => $cache_dir['url'] . $filename
		);
	}

	/**
	 * @method _get_uncropped_url
	 * @protected
	 */
	protected function _get_uncropped_url()
	{
		if($this->settings->photo_source == 'url') {
			$url = $this->settings->photo_url;
		}
		else if(!empty($this->settings->photo_src)) {
			$url = $this->settings->photo_src;
		}
		else {
			$url = EP_BOUWER_URL . 'img/pixel.png';
		}

		return $url;
	}

	/**
	 * @method _get_cropped_demo_url
	 * @protected
	 */
	protected function _get_cropped_demo_url()
	{
		$info = $this->_get_cropped_path();

		return EP_BOUWER_DEMO_CACHE_URL . $info['filename'];
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLPhotoModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'ep-bouwer'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'photo_source'  => array(
						'type'          => 'select',
						'label'         => __('Photo Source', 'ep-bouwer'),
						'default'       => 'library',
						'options'       => array(
							'library'       => __('Media Library', 'ep-bouwer'),
							'url'           => __('URL', 'ep-bouwer')
						),
						'toggle'        => array(
							'library'       => array(
								'fields'        => array('photo')
							),
							'url'           => array(
								'fields'        => array('photo_url', 'caption')
							)
						)
					),
					'photo'         => array(
						'type'          => 'photo',
						'label'         => __('Photo', 'ep-bouwer')
					),
					'photo_url'     => array(
						'type'          => 'text',
						'label'         => __('Photo URL', 'ep-bouwer'),
						'placeholder'   => __( 'http://www.example.com/my-photo.jpg', 'ep-bouwer' )
					),
					'crop'          => array(
						'type'          => 'select',
						'label'         => __('Crop', 'ep-bouwer'),
						'default'       => '',
						'options'       => array(
							''              => _x( 'None', 'Crop.', 'ep-bouwer' ),
							'landscape'     => __('Landscape', 'ep-bouwer'),
							'panorama'      => __('Panorama', 'ep-bouwer'),
							'portrait'      => __('Portrait', 'ep-bouwer'),
							'square'        => __('Square', 'ep-bouwer'),
							'circle'        => __('Circle', 'ep-bouwer')
						)
					),
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'ep-bouwer'),
						'default'       => 'center',
						'options'       => array(
							'left'          => __('Left', 'ep-bouwer'),
							'center'        => __('Center', 'ep-bouwer'),
							'right'         => __('Right', 'ep-bouwer')
						)
					)
				)
			),
			'caption'       => array(
				'title'         => __('Caption', 'ep-bouwer'),
				'fields'        => array(
					'show_caption'  => array(
						'type'          => 'select',
						'label'         => __('Show Caption', 'ep-bouwer'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('Never', 'ep-bouwer'),
							'hover'         => __('On Hover', 'ep-bouwer'),
							'below'         => __('Below Photo', 'ep-bouwer')
						)
					),
					'caption'       => array(
						'type'          => 'text',
						'label'         => __('Caption', 'ep-bouwer')
					)
				)
			),
			'link'          => array(
				'title'         => 'Link',
				'fields'        => array(
					'link_type'     => array(
						'type'          => 'select',
						'label'         => __('Link Type', 'ep-bouwer'),
						'options'       => array(
							''              => _x( 'None', 'Link type.', 'ep-bouwer' ),
							'url'           => __('URL', 'ep-bouwer'),
							'lightbox'      => __('Lightbox', 'ep-bouwer'),
							'file'          => __('Photo File', 'ep-bouwer'),
							'page'          => __('Photo Page', 'ep-bouwer')
						),
						'toggle'        => array(
							''              => array(),
							'url'           => array(
								'fields'        => array('link_url', 'link_target')
							),
							'file'          => array(),
							'page'          => array()
						),
						'help'          => __('Link type applies to how the image should be linked on click. You can choose a specific URL, the individual photo or a separate page with the photo.', 'ep-bouwer'),
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'link_url'     => array(
						'type'          => 'link',
						'label'         => __('Link URL', 'ep-bouwer'),
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
	)
));