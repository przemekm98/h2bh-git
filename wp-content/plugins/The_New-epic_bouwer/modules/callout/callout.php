<?php

/**
 * @class FLCalloutModule
 */
class FLCalloutModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Callout', 'ep-bouwer'),
			'description'   => __('A heading and snippet of text with an optional link, icon and image.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer')
		));
	}

	/**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		// Cache the photo data.
		if(!empty($settings->photo)) {

			$data = EPBOUWERPhoto::get_attachment_data($settings->photo);

			if($data) {
				$settings->photo_data = $data;
			}
		}

		return $settings;
	}

	/**
	 * @method delete
	 */
	public function delete()
	{
		// Delete photo module cache.
		if($this->settings->image_type == 'photo' && !empty($this->settings->photo_src)) {
			$module_class = get_class(EPBOUWERModel::$modules['photo']);
			$photo_module = new $module_class();
			$photo_module->settings = new stdClass();
			$photo_module->settings->photo_source = 'library';
			$photo_module->settings->photo_src = $this->settings->photo_src;
			$photo_module->settings->crop = $this->settings->photo_crop;
			$photo_module->delete();
		}
	}

	/**
	 * @method get_classname
	 */
	public function get_classname()
	{
		$classname = 'fl-callout fl-callout-' . $this->settings->align;

		if($this->settings->image_type == 'photo') {
			$classname .= ' fl-callout-has-photo fl-callout-photo-' . $this->settings->photo_position;
		}
		else if($this->settings->image_type == 'icon') {
			$classname .= ' fl-callout-has-icon fl-callout-icon-' . $this->settings->icon_position;
		}

		return $classname;
	}

	/**
	 * @method render_title
	 */
	public function render_title()
	{
		echo '<' . $this->settings->title_tag . ' class="fl-callout-title">';

		$this->render_image('left-title');

		echo '<span>';

		if(!empty($this->settings->link)) {
			echo '<a href="' . $this->settings->link . '" target="' . $this->settings->link_target . '" class="fl-callout-title-link">';
		}

		echo $this->settings->title;

		if(!empty($this->settings->link)) {
			echo '</a>';
		}

		echo '</span>';

		$this->render_image('right-title');

		echo '</' . $this->settings->title_tag . '>';
	}

	/**
	 * @method render_text
	 */
	public function render_text()
	{
		echo '<div class="fl-callout-text">' . $this->settings->text . '</div>';
	}

	/**
	 * @method render_link
	 */
	public function render_link()
	{
		if($this->settings->cta_type == 'link') {
			echo '<a href="' . $this->settings->link . '" target="' . $this->settings->link_target . '" class="fl-callout-cta-link">' . $this->settings->cta_text . '</a>';
		}
	}

	/**
	 * @method render_button
	 */
	public function render_button()
	{
		if($this->settings->cta_type == 'button') {

			$btn_settings = array(
				'align'             => '',
				'bg_color'          => $this->settings->btn_bg_color,
				'bg_hover_color'    => $this->settings->btn_bg_hover_color,
				'bg_opacity'        => $this->settings->btn_bg_opacity,
				'border_radius'     => $this->settings->btn_border_radius,
				'border_size'       => $this->settings->btn_border_size,
				'font_size'         => $this->settings->btn_font_size,
				'icon'              => $this->settings->btn_icon,
				'icon_position'     => $this->settings->btn_icon_position,
				'link'              => $this->settings->link,
				'link_target'       => $this->settings->link_target,
				'padding'           => $this->settings->btn_padding,
				'style'             => $this->settings->btn_style,
				'text'              => $this->settings->cta_text,
				'text_color'        => $this->settings->btn_text_color,
				'text_hover_color'  => $this->settings->btn_text_hover_color,
				'width'             => $this->settings->btn_width
			);

			echo '<div class="fl-callout-button">';
			EPBOUWER::render_module_html('button', $btn_settings);
			echo '</div>';
		}
	}

	/**
	 * @method render_image
	 */
	public function render_image($position)
	{
		if($this->settings->image_type == 'photo' && $this->settings->photo_position == $position) {

			if(empty($this->settings->photo)) {
				return;
			}

			$photo_data = EPBOUWERPhoto::get_attachment_data($this->settings->photo);

			if(!$photo_data) {
				$photo_data = $this->settings->photo_data;
			}

			$photo_settings = array(
				'align'         => 'center',
				'crop'          => $this->settings->photo_crop,
				'link_target'   => $this->settings->link_target,
				'link_type'     => 'url',
				'link_url'      => $this->settings->link,
				'photo'         => $photo_data,
				'photo_src'     => $this->settings->photo_src,
				'photo_source'  => 'library'
			);

			echo '<div class="fl-callout-photo">';
			EPBOUWER::render_module_html('photo', $photo_settings);
			echo '</div>';
		}
		else if($this->settings->image_type == 'icon' && $this->settings->icon_position == $position) {

			$icon_settings = array(
				'bg_color'       => $this->settings->icon_bg_color,
				'bg_hover_color' => $this->settings->icon_bg_hover_color,
				'color'          => $this->settings->icon_color,
				'exclude_wrapper'=> true,
				'hover_color'    => $this->settings->icon_hover_color,
				'icon'           => $this->settings->icon,
				'link'           => $this->settings->link,
				'link_target'    => $this->settings->link_target,
				'size'           => $this->settings->icon_size,
				'text'           => '',
				'three_d'        => $this->settings->icon_3d
			);

			EPBOUWER::render_module_html('icon', $icon_settings);
		}
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLCalloutModule', array(
	'general'       => array(
		'title'         => __('General', 'ep-bouwer'),
		'sections'      => array(
			'title'         => array(
				'title'         => '',
				'fields'        => array(
					'title'         => array(
						'type'          => 'text',
						'label'         => __('Heading', 'ep-bouwer'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-callout-title'
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
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-callout-text'
						)
					)
				)
			)
		)
	),
	'style'         => array(
		'title'         => __('Style', 'ep-bouwer'),
		'sections'      => array(
			'overall_structure' => array(
				'title'         => __('Structure', 'ep-bouwer'),
				'fields'        => array(
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Overall Alignment', 'ep-bouwer'),
						'default'       => 'left',
						'options'       => array(
							'center'        => __('Center', 'ep-bouwer'),
							'left'          => __('Left', 'ep-bouwer'),
							'right'         => __('Right', 'ep-bouwer')
						),
						'help'          => __('The alignment that will apply to all elements within the callout.', 'ep-bouwer'),
						'preview'       => array(
							'type'          => 'none'
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
			)
		)
	),
	'image'         => array(
		'title'         => __('Image', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'image_type'    => array(
						'type'          => 'select',
						'label'         => __('Image Type', 'ep-bouwer'),
						'default'       => 'photo',
						'options'       => array(
							'none'          => _x( 'None', 'Image type.', 'ep-bouwer' ),
							'photo'         => __('Photo', 'ep-bouwer'),
							'icon'          => __('Icon', 'ep-bouwer')
						),
						'toggle'        => array(
							'none'          => array(),
							'photo'         => array(
								'sections'      => array('photo')
							),
							'icon'          => array(
								'sections'      => array('icon', 'icon_colors', 'icon_structure')
							)
						)
					)
				)
			),
			'photo'         => array(
				'title'         => __('Photo', 'ep-bouwer'),
				'fields'        => array(
					'photo'         => array(
						'type'          => 'photo',
						'label'         => __('Photo', 'ep-bouwer')
					),
					'photo_crop'    => array(
						'type'          => 'select',
						'label'         => __('Crop', 'ep-bouwer'),
						'default'       => '',
						'options'       => array(
							''              => _x( 'None', 'Crop', 'ep-bouwer' ),
							'landscape'     => __('Landscape', 'ep-bouwer'),
							'panorama'      => __('Panorama', 'ep-bouwer'),
							'portrait'      => __('Portrait', 'ep-bouwer'),
							'square'        => __('Square', 'ep-bouwer'),
							'circle'        => __('Circle', 'ep-bouwer')
						)
					),
					'photo_position' => array(
						'type'          => 'select',
						'label'         => __('Position', 'ep-bouwer'),
						'default'       => 'above-title',
						'options'       => array(
							'above-title'   => __('Above Heading', 'ep-bouwer'),
							'below-title'   => __('Below Heading', 'ep-bouwer'),
							'left'          => __('Left of Text and Heading', 'ep-bouwer'),
							'right'         => __('Right of Text and Heading', 'ep-bouwer')
						)
					)
				)
			),
			'icon'          => array(
				'title'         => __('Icon', 'ep-bouwer'),
				'fields'        => array(
					'icon'          => array(
						'type'          => 'icon',
						'label'         => __('Icon', 'ep-bouwer')
					),
					'icon_position' => array(
						'type'          => 'select',
						'label'         => __('Position', 'ep-bouwer'),
						'default'       => 'left-title',
						'options'       => array(
							'above-title'   => __('Above Heading', 'ep-bouwer'),
							'below-title'   => __('Below Heading', 'ep-bouwer'),
							'left-title'    => __( 'Left of Heading', 'ep-bouwer' ),
							'right-title'   => __( 'Right of Heading', 'ep-bouwer' ),
							'left'          => __('Left of Text and Heading', 'ep-bouwer'),
							'right'         => __('Right of Text and Heading', 'ep-bouwer')
						)
					)
				)
			),
			'icon_colors'   => array(
				'title'         => __('Icon Colors', 'ep-bouwer'),
				'fields'        => array(
					'icon_color'    => array(
						'type'          => 'color',
						'label'         => __('Color', 'ep-bouwer'),
						'show_reset'    => true
					),
					'icon_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Hover Color', 'ep-bouwer'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'icon_bg_color' => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'ep-bouwer'),
						'show_reset'    => true
					),
					'icon_bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Background Hover Color', 'ep-bouwer'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'icon_3d'       => array(
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
			'icon_structure' => array(
				'title'         => __('Icon Structure', 'ep-bouwer'),
				'fields'        => array(
					'icon_size'     => array(
						'type'          => 'text',
						'label'         => __('Size', 'ep-bouwer'),
						'default'       => '30',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					)
				)
			)
		)
	),
	'cta'           => array(
		'title'         => __('Call To Action', 'ep-bouwer'),
		'sections'      => array(
			'link'          => array(
				'title'         => __('Link', 'ep-bouwer'),
				'fields'        => array(
					'link'          => array(
						'type'          => 'link',
						'label'         => __('Link', 'ep-bouwer'),
						'help'          => __('The link applies to the entire module. If choosing a call to action type below, this link will also be used for the text or button.', 'ep-bouwer'),
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
			'cta'           => array(
				'title'         => __('Call to Action', 'ep-bouwer'),
				'fields'        => array(
					'cta_type'      => array(
						'type'          => 'select',
						'label'         => __('Type', 'ep-bouwer'),
						'default'       => 'none',
						'options'       => array(
							'none'          => _x( 'None', 'Call to action.', 'ep-bouwer' ),
							'link'          => __('Text', 'ep-bouwer'),
							'button'        => __('Button', 'ep-bouwer')
						),
						'toggle'        => array(
							'none'          => array(),
							'link'          => array(
								'fields'        => array('cta_text')
							),
							'button'        => array(
								'fields'        => array('cta_text', 'btn_icon', 'btn_icon_position'),
								'sections'      => array('btn_colors', 'btn_structure')
							)
						)
					),
					'cta_text'      => array(
						'type'          => 'text',
						'label'         => __('Text', 'ep-bouwer'),
						'default'		=> __('Read More', 'ep-bouwer'),
					),
					'btn_icon'      => array(
						'type'          => 'icon',
						'label'         => __('Button Icon', 'ep-bouwer'),
						'show_remove'   => true
					),
					'btn_icon_position' => array(
						'type'          => 'select',
						'label'         => __('Button Icon Position', 'ep-bouwer'),
						'default'       => 'before',
						'options'       => array(
							'before'        => __('Before Text', 'ep-bouwer'),
							'after'         => __('After Text', 'ep-bouwer')
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
					'btn_width'     => array(
						'type'          => 'select',
						'label'         => __('Button Width', 'ep-bouwer'),
						'default'       => 'auto',
						'options'       => array(
							'auto'          => _x( 'Auto', 'Width.', 'ep-bouwer' ),
							'full'          => __('Full Width', 'ep-bouwer')
						)
					),
					'btn_font_size' => array(
						'type'          => 'text',
						'label'         => __('Font Size', 'ep-bouwer'),
						'default'       => '14',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'btn_padding'   => array(
						'type'          => 'text',
						'label'         => __('Padding', 'ep-bouwer'),
						'default'       => '10',
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
						'description'   => 'px'
					)
				)
			)
		)
	)
));