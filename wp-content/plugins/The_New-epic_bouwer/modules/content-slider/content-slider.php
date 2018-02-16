<?php

/**
 * @class FLContentSliderModule
 */
class FLContentSliderModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Content Slider', 'ep-bouwer'),
			'description'   => __('Displays multiple slides with an optional heading and call to action.', 'ep-bouwer'),
			'category'      => __('Advanced Modules', 'ep-bouwer')
		));

		$this->add_css('jquery-bxslider');
		$this->add_js('jquery-bxslider');
	}

	/**
	 * @method render_background
	 */
	public function render_background($slide)
	{
		// Background photo
		if($slide->bg_layout == 'photo' && !empty($slide->bg_photo_src)) {

			echo '<div class="fl-slide-bg-photo" style="background-image: url(' . $slide->bg_photo_src . ');">';

			if(!empty($slide->link) && $slide->cta_type == 'none') {
				echo '<a href="' . $slide->link . '" target="' . $slide->link_target. '"></a>';
			}

			echo '</div>';
		}

		// Background video
		elseif($slide->bg_layout == 'video' && !empty($slide->bg_video)) {
			echo '<div class="fl-slide-bg-video">' . $slide->bg_video . '</div>';
		}
	}

	/**
	 * @method render_content
	 */
	public function render_content($slide)
	{
		if($slide->content_layout != 'none' && $slide->bg_layout != 'video') {

			echo '<div class="fl-slide-content-wrap">';
			echo '<div class="fl-slide-content">';

			if(!empty($slide->title)) {
				echo '<' . $slide->title_tag . ' class="fl-slide-title">' . $slide->title . '</' . $slide->title_tag . '>';
			}
			if(!empty($slide->text)) {
				echo '<div class="fl-slide-text">' . $slide->text . $this->render_link($slide) . '</div>';
			}

			$this->render_button($slide);

			echo '</div>';
			echo '</div>';
		}
	}

	/**
	 * @method render_media
	 */
	public function render_media($slide)
	{
		// Photo
		if($slide->content_layout == 'photo' && !empty($slide->fg_photo_src)) {
			echo '<div class="fl-slide-photo-wrap">';
			echo '<div class="fl-slide-photo">';
			echo '<img class="fl-slide-photo-img" src="' . $slide->fg_photo_src . '" />';
			echo '</div>';
			echo '</div>';
		}
		// Video
		elseif($slide->content_layout == 'video' && !empty($slide->fg_video)) {
			echo '<div class="fl-slide-photo-wrap">';
			echo '<div class="fl-slide-photo">' . $slide->fg_video . '</div>';
			echo '</div>';
		}
	}

	/**
	 * @method render_mobile_media
	 */
	public function render_mobile_media($slide)
	{
		// Photo
		if($slide->content_layout == 'photo') {

			$src = '';

			if($slide->r_photo_type == 'main' && !empty($slide->fg_photo_src)) {
				$src = $slide->fg_photo_src;
			}
			else if($slide->r_photo_type == 'another' && !empty($slide->r_photo_src)) {
				$src = $slide->r_photo_src;
			}

			if(!empty($src)) {
				echo '<div class="fl-slide-mobile-photo">';
				echo '<img class="fl-slide-mobile-photo-img" src="' . $src . '" />';
				echo '</div>';
			}
		}
		// Video
		elseif($slide->content_layout == 'video' && !empty($slide->fg_video)) {
			echo '<div class="fl-slide-mobile-photo">' . $slide->fg_video . '</div>';
		}
		// BG Photo
		elseif($slide->bg_layout == 'photo') {

			$src = '';

			if($slide->r_photo_type == 'main' && !empty($slide->bg_photo_src)) {
				$src = $slide->bg_photo_src;
			}
			else if($slide->r_photo_type == 'another' && !empty($slide->r_photo_src)) {
				$src = $slide->r_photo_src;
			}

			if(!empty($src)) {
				echo '<div class="fl-slide-mobile-photo">';
				echo '<img class="fl-slide-mobile-photo-img" src="' . $src . '" />';
				echo '</div>';
			}
		}
	}

	/**
	 * @method render_link
	 */
	public function render_link($slide)
	{
		if($slide->cta_type == 'link') {
			return '<a href="' . $slide->link . '" target="' . $slide->link_target . '" class="fl-slide-cta-link">' . $slide->cta_text . '</a>';
		}
	}

	/**
	 * @method render_button
	 */
	public function render_button($slide)
	{
		if($slide->cta_type == 'button') {
			
			if ( ! isset( $slide->btn_style ) ) {
				$slide->btn_style = 'flat';
			}

			$btn_settings = array(
				'align'             => '',
				'bg_color'          => $slide->btn_bg_color,
				'bg_hover_color'    => $slide->btn_bg_hover_color,
				'bg_opacity'        => isset( $slide->btn_bg_opacity ) ? $slide->btn_bg_opacity : 0,
				'border_radius'     => $slide->btn_border_radius,
				'border_size'       => isset( $slide->btn_border_size ) ? $slide->btn_border_size : 2,
				'font_size'         => $slide->btn_font_size,
				'icon'              => isset( $slide->btn_icon ) ? $slide->btn_icon : '',
				'icon_position'     => isset( $slide->btn_icon_position ) ? $slide->btn_icon_position : 'before',
				'link'              => $slide->link,
				'link_target'       => $slide->link_target,
				'padding'           => $slide->btn_padding,
				'style'             => ( isset( $slide->btn_3d ) && $slide->btn_3d ) ? 'gradient' : $slide->btn_style,
				'text'              => $slide->cta_text,
				'text_color'        => $slide->btn_text_color,
				'text_hover_color'  => $slide->btn_text_hover_color,
				'width'             => 'auto'
			);

			echo '<div class="fl-slide-cta-button">';
			EPBOUWER::render_module_html('button', $btn_settings);
			echo '</div>';
		}
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLContentSliderModule', array(
	'general'       => array(
		'title'         => __('General', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'height'        => array(
						'type'          => 'text',
						'label'         => __('Height', 'ep-bouwer'),
						'default'       => '400',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => 'px',
						'help'          => __('This setting is the minimum height of the content slider. Content will expand the height automatically.', 'ep-bouwer')
					),
					'auto_play'     => array(
						'type'          => 'select',
						'label'         => __('Auto Play', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						),
						'toggle'        => array(
							'1'             => array(
								'fields'        => array('play_pause')
							)
						)
					),
					'play_pause'    => array(
						'type'          => 'select',
						'label'         => __('Show Play/Pause', 'ep-bouwer'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						)
					),
					'delay'         => array(
						'type'          => 'text',
						'label'         => __('Delay', 'ep-bouwer'),
						'default'       => '5',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'ep-bouwer' )
					),
					'transition'    => array(
						'type'          => 'select',
						'label'         => __('Transition', 'ep-bouwer'),
						'default'       => 'slide',
						'options'       => array(
							'horizontal'    => _x( 'Slide', 'Transition type.', 'ep-bouwer' ),
							'fade'          => __( 'Fade', 'ep-bouwer' )
						)
					),
					'speed'         => array(
						'type'          => 'text',
						'label'         => __('Transition Speed', 'ep-bouwer'),
						'default'       => '0.5',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'ep-bouwer' )
					),
					'arrows'       => array(
						'type'          => 'select',
						'label'         => __('Show Arrows', 'ep-bouwer'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						)
					),
					'dots'          => array(
						'type'          => 'select',
						'label'         => __('Show Dots', 'ep-bouwer'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'ep-bouwer'),
							'1'             => __('Yes', 'ep-bouwer')
						)
					)
				)
			),
			'advanced'      => array(
				'title'         => __('Advanced', 'ep-bouwer'),
				'fields'        => array(
					'max_width'     => array(
						'type'          => 'text',
						'label'         => __('Max Content Width', 'ep-bouwer'),
						'default'       => '1100',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => 'px',
						'help'          => __('The max width that the content area will be within your slides.', 'ep-bouwer')
					)
				)
			)
		)
	),
	'slides'       => array(
		'title'         => __('Slides', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'slides'        => array(
						'type'          => 'form',
						'label'         => __('Slide', 'ep-bouwer'),
						'form'          => 'content_slider_slide', // ID from registered form below
						'preview_text'  => 'label', // Name of a field to use for the preview text
						'multiple'      => true
					)
				)
			)
		)
	)
));

/**
 * Register the slide settings form.
 */
EPBOUWER::register_settings_form('content_slider_slide', array(
	'title' => __('Slide Settings', 'ep-bouwer'),
	'tabs'  => array(
		'general'        => array( // Tab
			'title'         => __('General', 'ep-bouwer'), // Tab title
			'sections'      => array( // Tab Sections
				'general'       => array(
					'title'     => '',
					'fields'    => array(
						'label'         => array(
							'type'          => 'text',
							'label'         => __('Slide Label', 'ep-bouwer'),
							'help'          => __('A label to identify this slide on the Slides tab of the Content Slider settings.', 'ep-bouwer')
						)
					)
				),
				'background' => array(
					'title'     => __('Background Layout', 'ep-bouwer'),
					'fields'    => array(
						'bg_layout'     => array(
							'type'          => 'select',
							'label'         => __('Type', 'ep-bouwer'),
							'default'       => 'photo',
							'help'          => __('This setting is for the entire background of your slide.', 'ep-bouwer'),
							'options'       => array(
								'photo'         => __('Photo', 'ep-bouwer'),
								'video'         => __('Video', 'ep-bouwer'),
								'color'         => __('Color', 'ep-bouwer'),
								'none'          => _x( 'None', 'Background type.', 'ep-bouwer' )
							),
							'toggle'        => array(
								'photo'         => array(
									'fields'        => array('bg_photo'),
									'sections'      => array('content', 'text')
								),
								'color'         => array(
									'fields'        => array('bg_color'),
									'sections'      => array('content', 'text')
								),
								'video'         => array(
									'fields'        => array('bg_video')
								),
								'none'          => array(
									'sections'      => array('content', 'text')
								)
							)
						),
						'bg_photo'      => array(
							'type'          => 'photo',
							'label'         => __('Background Photo', 'ep-bouwer')
						),
						'bg_color'      => array(
							'type'          => 'color',
							'label'         => __('Background Color', 'ep-bouwer'),
							'show_reset'    => true
						),
						'bg_video'      => array(
							'type'          => 'textarea',
							'label'         => __('Background Video Code', 'ep-bouwer'),
							'rows'          => '6'
						)
					)
				),
				'content'      => array(
					'title'         => __('Content Layout', 'ep-bouwer'),
					'fields'        => array(
						'content_layout' => array(
							'type'          => 'select',
							'label'         => __('Type', 'ep-bouwer'),
							'default'       => 'none',
							'help'          => __('This allows you to add content over or in addition to the background selection above. The location of the content layout can be selected in the style tab.', 'ep-bouwer'),
							'options'       => array(
								'text'          => __('Text', 'ep-bouwer'),
								'photo'         => __('Text &amp; Photo', 'ep-bouwer'),
								'video'         => __('Text &amp; Video', 'ep-bouwer'),
								'none'          => _x( 'None', 'Content type.', 'ep-bouwer' )
							),
							'toggle'        => array(
								'text'          => array(
									'fields'        => array('title', 'text'),
									'sections'      => array('text')
								),
								'photo'         => array(
									'fields'        => array('title', 'text', 'fg_photo'),
									'sections'      => array('text')
								),
								'video'         => array(
									'fields'        => array('title', 'text', 'fg_video'),
									'sections'      => array('text')
								)
							)
						),
						'fg_photo'      => array(
							'type'          => 'photo',
							'label'         => __('Photo', 'ep-bouwer')
						),
						'fg_video'      => array(
							'type'          => 'textarea',
							'label'         => __('Video Embed Code', 'ep-bouwer'),
							'rows'          => '6'
						),
						'title'         => array(
							'type'          => 'text',
							'label'         => __('Heading', 'ep-bouwer')
						),
						'text'          => array(
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 16
						)
					)
				)
			)
		),
		'style'         => array( // Tab
			'title'         => __('Style', 'ep-bouwer'), // Tab title
			'sections'      => array( // Tab Sections
				'title'         => array(
					'title'         => __('Heading', 'ep-bouwer'),
					'fields'        => array(
						'title_tag'     => array(
							'type'          => 'select',
							'label'         => __('Heading Tag', 'ep-bouwer'),
							'default'       => 'h2',
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
							'label'             => __('Heading Size', 'ep-bouwer'),
							'default'           => '24',
							'maxlength'         => '3',
							'size'              => '4',
							'description'       => 'px'
						)
					)
				),
				'text_position' => array(
					'title'         => __('Text Position', 'ep-bouwer'),
					'fields'        => array(
						'text_position' => array(
							'type'          => 'select',
							'label'         => __('Position', 'ep-bouwer'),
							'default'       => 'top-left',
							'help'          => __('The position will move the content layout selections left, right or center over the background of the slide.', 'ep-bouwer'),
							'options'       => array(
								'left'          => __('Left', 'ep-bouwer'),
								'center'        => __('Center', 'ep-bouwer'),
								'right'         => __('Right', 'ep-bouwer')
							)
						),
						'text_width'   => array(
							'type'          => 'text',
							'label'         => __('Width', 'ep-bouwer'),
							'default'       => '50',
							'description'   => '%',
							'maxlength'     => '3',
							'size'          => '5'
						),
						'text_margin_top' => array(
							'type'          => 'text',
							'label'         => __('Top Margin', 'ep-bouwer'),
							'default'       => '60',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5'
						),
						'text_margin_bottom' => array(
							'type'          => 'text',
							'label'         => __('Bottom Margin', 'ep-bouwer'),
							'default'       => '60',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5'
						),
						'text_margin_left' => array(
							'type'          => 'text',
							'label'         => __('Left Margin', 'ep-bouwer'),
							'default'       => '60',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5'
						),
						'text_margin_right' => array(
							'type'          => 'text',
							'label'         => __('Right Margin', 'ep-bouwer'),
							'default'       => '60',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5'
						)
					)
				),
				'text_style'    => array(
					'title'         => __('Text Colors', 'ep-bouwer'),
					'fields'        => array(
						'text_color'    => array(
							'type'          => 'color',
							'label'         => __('Text Color', 'ep-bouwer'),
							'default'       => 'ffffff',
							'show_reset'    => true
						),
						'text_shadow'   => array(
							'type'          => 'select',
							'label'         => __('Text Shadow', 'ep-bouwer'),
							'default'       => '0',
							'options'       => array(
								'0'             => __('No', 'ep-bouwer'),
								'1'             => __('Yes', 'ep-bouwer')
							)
						),
						'text_bg_color'    => array(
							'type'          => 'color',
							'label'         => __('Text Background Color', 'ep-bouwer'),
							'help'          => __('The color applies to the overlay behind text over the background selections.', 'ep-bouwer'),
							'show_reset'    => true
						),
						'text_bg_opacity' => array(
							'type'          => 'text',
							'label'         => __('Text Background Opacity', 'ep-bouwer'),
							'default'       => '70',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => '%'
						),
						'text_bg_height' => array(
							'type'          => 'select',
							'label'         => __('Text Background Height', 'ep-bouwer'),
							'default'       => 'auto',
							'help'          => __('Auto will allow the overlay to fit however long the text content is. 100% will fit the overlay to the top and bottom of the slide.', 'ep-bouwer'),
							'options'       => array(
								'auto'          => _x( 'Auto', 'Background height.', 'ep-bouwer' ),
								'100%'          => '100%'
							)
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
							'help'          => __('The link applies to the entire slide. If choosing a call to action type below, this link will also be used for the text or button.', 'ep-bouwer')
						),
						'link_target'   => array(
							'type'          => 'select',
							'label'         => __('Link Target', 'ep-bouwer'),
							'default'       => '_self',
							'options'       => array(
								'_self'         => __('Same Window', 'ep-bouwer'),
								'_blank'        => __('New Window', 'ep-bouwer')
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
								'link'          => __('Link', 'ep-bouwer'),
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
							'label'         => __('Text', 'ep-bouwer')
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
							'default'       => 'f7f7f7',
							'show_reset'    => true
						),
						'btn_bg_hover_color' => array(
							'type'          => 'color',
							'label'         => __('Background Hover Color', 'ep-bouwer'),
							'show_reset'    => true
						),
						'btn_text_color' => array(
							'type'          => 'color',
							'label'         => __('Text Color', 'ep-bouwer'),
							'default'       => '333333',
							'show_reset'    => true
						),
						'btn_text_hover_color' => array(
							'type'          => 'color',
							'label'         => __('Text Hover Color', 'ep-bouwer'),
							'show_reset'    => true
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
						'btn_font_size' => array(
							'type'          => 'text',
							'label'         => __('Font Size', 'ep-bouwer'),
							'default'       => '16',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => 'px'
						),
						'btn_padding'   => array(
							'type'          => 'text',
							'label'         => __('Padding', 'ep-bouwer'),
							'default'       => '14',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => 'px'
						),
						'btn_border_radius' => array(
							'type'          => 'text',
							'label'         => __('Border Radius', 'ep-bouwer'),
							'default'       => '6',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => 'px'
						)
					)
				)
			)
		),
		'mobile'        => array(
			'title'         => _x( 'Mobile', 'Module settings form tab. Display on mobile devices.', 'ep-bouwer' ),
			'sections'      => array(
				'r_photo'       => array(
					'title'         => __('Mobile Photo', 'ep-bouwer'),
					'fields'        => array(
						'r_photo_type'  => array(
							'type'          => 'select',
							'label'         => __('Type', 'ep-bouwer'),
							'default'       => 'main',
							'help'          => __('You can choose a different photo that the slide will change to on mobile devices or no photo if desired.', 'ep-bouwer'),
							'options'       => array(
								'main'          => __('Use Main Photo', 'ep-bouwer'),
								'another'       => __('Choose Another Photo', 'ep-bouwer'),
								'none'          => __('No Photo', 'ep-bouwer')
							),
							'toggle'        => array(
								'another'       => array(
									'fields'        => array('r_photo')
								)
							)
						),
						'r_photo'    => array(
							'type'          => 'photo',
							'label'         => __('Photo', 'ep-bouwer')
						)
					)
				),
				'r_text_style'   => array(
					'title'         => __('Mobile Text Colors', 'ep-bouwer'),
					'fields'        => array(
						'r_text_color'  => array(
							'type'          => 'color',
							'label'         => __('Text Color', 'ep-bouwer'),
							'default'       => 'ffffff',
							'show_reset'    => true
						),
						'r_text_bg_color' => array(
							'type'          => 'color',
							'label'         => __('Text Background Color', 'ep-bouwer'),
							'default'       => '333333',
							'show_reset'    => true
						)
					)
				)
			)
		)
	)
));