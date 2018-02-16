<?php

EPBOUWER::register_settings_form('col', array(
	'title' => __('Column Settings', 'ep-bouwer'),
	'tabs'  => array(
		'style'         => array(
			'title'         => __('Style', 'ep-bouwer'),
			'sections'      => array(
				'general'       => array(
					'title'         => '',
					'fields'        => array(
						'size'          => array(
							'type'          => 'text',
							'label'         => __('Column Width', 'ep-bouwer'),
							'default'       => '',
							'description'   => '%',
							'maxlength'     => '5',
							'size'          => '6',
							'preview'         => array(
								'type'            => 'none'
							)
						)
					)
				),
				'text'          => array(
					'title'         => __('Text', 'ep-bouwer'),
					'fields'        => array(
						'text_color'    => array(
							'type'          => 'color',
							'label'         => __('Color', 'ep-bouwer'),
							'show_reset'    => true,
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'link_color'    => array(
							'type'          => 'color',
							'label'         => __('Link Color', 'ep-bouwer'),
							'show_reset'    => true,
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'hover_color'    => array(
							'type'          => 'color',
							'label'         => __('Link Hover Color', 'ep-bouwer'),
							'show_reset'    => true,
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'heading_color'  => array(
							'type'          => 'color',
							'label'         => __('Heading Color', 'ep-bouwer'),
							'show_reset'    => true,
							'preview'         => array(
								'type'            => 'none'
							)
						)
					)
				),
				'background'    => array(
					'title'         => __('Background', 'ep-bouwer'),
					'fields'        => array(
						'bg_type'      => array(
							'type'          => 'select',
							'label'         => __('Type', 'ep-bouwer'),
							'default'       => 'color',
							'options'       => array(
								'none'          => _x( 'None', 'Background type.', 'ep-bouwer' ),
								'color'         => _x( 'Color', 'Background type.', 'ep-bouwer' ),
								'photo'         => _x( 'Photo', 'Background type.', 'ep-bouwer' ),
							),
							'toggle'        => array(
								'color'         => array(
									'sections'      => array('bg_color')
								),
								'photo'         => array(
									'sections'      => array('bg_photo', 'bg_overlay')
								),
							),
							'preview'         => array(
								'type'            => 'none'
							)
						)
					)
				),
				'bg_color'     => array(
					'title'         => __('Background Color', 'ep-bouwer'),
					'fields'        => array(
						'bg_color'      => array(
							'type'          => 'color',
							'label'         => __('Color', 'ep-bouwer'),
							'show_reset'    => true,
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'bg_opacity'    => array(
							'type'          => 'text',
							'label'         => __('Opacity', 'ep-bouwer'),
							'default'       => '100',
							'description'   => '%',
							'maxlength'     => '3',
							'size'          => '5',
							'preview'         => array(
								'type'            => 'none'
							)
						)
					)
				),
				'bg_photo'     => array(
					'title'         => __('Background Photo', 'ep-bouwer'),
					'fields'        => array(
						'bg_image'      => array(
							'type'          => 'photo',
							'label'         => __('Photo', 'ep-bouwer'),
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'bg_repeat'     => array(
							'type'          => 'select',
							'label'         => __('Repeat', 'ep-bouwer'),
							'default'       => 'none',
							'options'       => array(
								'no-repeat'     => _x( 'None', 'Background repeat.', 'ep-bouwer' ),
								'repeat'        => _x( 'Tile', 'Background repeat.', 'ep-bouwer' ),
								'repeat-x'      => _x( 'Horizontal', 'Background repeat.', 'ep-bouwer' ),
								'repeat-y'      => _x( 'Vertical', 'Background repeat.', 'ep-bouwer' )
							),
							'help'          => __('Repeat applies to how the image should display in the background. Choosing none will display the image as uploaded. Tile will repeat the image as many times as needed to fill the background horizontally and vertically. You can also specify the image to only repeat horizontally or vertically.', 'ep-bouwer'),
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'bg_position'   => array(
							'type'          => 'select',
							'label'         => __('Position', 'ep-bouwer'),
							'default'       => 'center center',
							'options'       => array(
								'left top'      => __('Left Top', 'ep-bouwer'),
								'left center'   => __('Left Center', 'ep-bouwer'),
								'left bottom'   => __('Left Bottom', 'ep-bouwer'),
								'right top'     => __('Right Top', 'ep-bouwer'),
								'right center'  => __('Right Center', 'ep-bouwer'),
								'right bottom'  => __('Right Bottom', 'ep-bouwer'),
								'center top'    => __('Center Top', 'ep-bouwer'),
								'center center' => __( 'Center', 'ep-bouwer' ),
								'center bottom' => __('Center Bottom', 'ep-bouwer')
							),
							'help'          => __('Position will tell the image where it should sit in the background.', 'ep-bouwer'),
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'bg_attachment' => array(
							'type'          => 'select',
							'label'         => __('Attachment', 'ep-bouwer'),
							'default'       => 'scroll',
							'options'       => array(
								'scroll'        => __( 'Scroll', 'ep-bouwer' ),
								'fixed'         => __( 'Fixed', 'ep-bouwer' )
							),
							'help'          => __('Attachment will specify how the image reacts when scrolling a page. When scrolling is selected, the image will scroll with page scrolling. This is the default setting. Fixed will allow the image to scroll within the background if fill is selected in the scale setting.', 'ep-bouwer'),
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'bg_size'       => array(
							'type'          => 'select',
							'label'         => __('Scale', 'ep-bouwer'),
							'default'       => 'cover',
							'options'       => array(
								''              => _x( 'None', 'Background scale.', 'ep-bouwer' ),
								'contain'       => __( 'Fit', 'ep-bouwer'),
								'cover'         => __( 'Fill', 'ep-bouwer')
							),
							'help'          => __('Scale applies to how the image should display in the background. You can select either fill or fit to the background.', 'ep-bouwer'),
							'preview'         => array(
								'type'            => 'none'
							)
						)
					)
				),
				'bg_overlay'     => array(
					'title'         => __('Background Overlay', 'ep-bouwer'),
					'fields'        => array(
						'bg_overlay_color'      => array(
							'type'          => 'color',
							'label'         => __('Overlay Color', 'ep-bouwer'),
							'show_reset'    => true,
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'bg_overlay_opacity'    => array(
							'type'          => 'text',
							'label'         => __('Overlay Opacity', 'ep-bouwer'),
							'default'       => '50',
							'description'   => '%',
							'maxlength'     => '3',
							'size'          => '5',
							'preview'         => array(
								'type'            => 'none'
							)
						)
					)
				),
				'border'       => array(
					'title'         => __('Border', 'ep-bouwer'),
					'fields'        => array(
						'border_type'   => array(
							'type'          => 'select',
							'label'         => __('Type', 'ep-bouwer'),
							'default'       => '',
							'help'          => __('The type of border to use. Double borders must have a width of at least 3px to render properly.', 'ep-bouwer'),
							'options'       => array(
								''       => _x( 'None', 'Border type.', 'ep-bouwer' ),
								'solid'  => _x( 'Solid', 'Border type.', 'ep-bouwer' ),
								'dashed' => _x( 'Dashed', 'Border type.', 'ep-bouwer' ),
								'dotted' => _x( 'Dotted', 'Border type.', 'ep-bouwer' ),
								'double' => _x( 'Double', 'Border type.', 'ep-bouwer' )
							),
							'toggle'        => array(
								''              => array(
									'fields'        => array()
								),
								'solid'         => array(
									'fields'        => array('border_color', 'border_opacity', 'border_top', 'border_bottom', 'border_left', 'border_right')
								),
								'dashed'        => array(
									'fields'        => array('border_color', 'border_opacity', 'border_top', 'border_bottom', 'border_left', 'border_right')
								),
								'dotted'        => array(
									'fields'        => array('border_color', 'border_opacity', 'border_top', 'border_bottom', 'border_left', 'border_right')
								),
								'double'        => array(
									'fields'        => array('border_color', 'border_opacity', 'border_top', 'border_bottom', 'border_left', 'border_right')
								)
							),
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'border_color'  => array(
							'type'          => 'color',
							'label'         => __('Color', 'ep-bouwer'),
							'show_reset'    => true,
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'border_opacity' => array(
							'type'          => 'text',
							'label'         => __('Opacity', 'ep-bouwer'),
							'default'       => '100',
							'description'   => '%',
							'maxlength'     => '3',
							'size'          => '5',
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'border_top'    => array(
							'type'          => 'text',
							'label'         => __('Top Width', 'ep-bouwer'),
							'default'       => '1',
							'description'   => 'px',
							'maxlength'     => '3',
							'size'          => '5',
							'placeholder'   => '0',
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'border_bottom' => array(
							'type'          => 'text',
							'label'         => __('Bottom Width', 'ep-bouwer'),
							'default'       => '1',
							'description'   => 'px',
							'maxlength'     => '3',
							'size'          => '5',
							'placeholder'   => '0',
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'border_left'   => array(
							'type'          => 'text',
							'label'         => __('Left Width', 'ep-bouwer'),
							'default'       => '1',
							'description'   => 'px',
							'maxlength'     => '3',
							'size'          => '5',
							'placeholder'   => '0',
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'border_right'  => array(
							'type'          => 'text',
							'label'         => __('Right Width', 'ep-bouwer'),
							'default'       => '1',
							'description'   => 'px',
							'maxlength'     => '3',
							'size'          => '5',
							'placeholder'   => '0',
							'preview'         => array(
								'type'            => 'none'
							)
						)
					)
				),
			)
		),
		'advanced'      => array(
			'title'         => __('Advanced', 'ep-bouwer'),
			'sections'      => array(
				'margins'       => array(
					'title'         => __('Margins', 'ep-bouwer'),
					'fields'        => array(
						'margin_top'    => array(
							'type'          => 'text',
							'label'         => __( 'Top', 'ep-bouwer' ),
							'default'       => '',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5',
							'placeholder'   => '0',
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'margin_bottom' => array(
							'type'          => 'text',
							'label'         => __( 'Bottom', 'ep-bouwer' ),
							'default'       => '',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5',
							'placeholder'   => '0',
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'margin_left'   => array(
							'type'          => 'text',
							'label'         => __( 'Left', 'ep-bouwer' ),
							'default'       => '',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5',
							'placeholder'   => '0',
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'margin_right'  => array(
							'type'          => 'text',
							'label'         => __( 'Right', 'ep-bouwer' ),
							'default'       => '',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5',
							'placeholder'   => '0',
							'preview'         => array(
								'type'            => 'none'
							)
						)
					)
				),
				'padding'       => array(
					'title'         => __('Padding', 'ep-bouwer'),
					'fields'        => array(
						'padding_top'   => array(
							'type'          => 'text',
							'label'         => __( 'Top', 'ep-bouwer' ),
							'default'       => '',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5',
							'placeholder'   => '0',
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'padding_bottom' => array(
							'type'          => 'text',
							'label'         => __( 'Bottom', 'ep-bouwer' ),
							'default'       => '',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5',
							'placeholder'   => '0',
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'padding_left'  => array(
							'type'          => 'text',
							'label'         => __( 'Left', 'ep-bouwer' ),
							'default'       => '',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5',
							'placeholder'   => '0',
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'padding_right' => array(
							'type'          => 'text',
							'label'         => __( 'Right', 'ep-bouwer' ),
							'default'       => '',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5',
							'placeholder'   => '0',
							'preview'         => array(
								'type'            => 'none'
							)
						)
					)
				),
				'responsive'    => array(
					'title'         => __('Responsive Layout', 'ep-bouwer'),
					'fields'        => array(
						'responsive_display' => array(
							'type'          => 'select',
							'label'         => __('Display', 'ep-bouwer'),
							'options'       => array(
								''                  => __('Always', 'ep-bouwer'),
								'desktop'           => __('Large Devices Only', 'ep-bouwer'),
								'desktop-medium'    => __('Large &amp; Medium Devices Only', 'ep-bouwer'),
								'medium'            => __('Medium Devices Only', 'ep-bouwer'),
								'medium-mobile'     => __('Medium &amp; Small Devices Only', 'ep-bouwer'),
								'mobile'            => __('Small Devices Only', 'ep-bouwer'),
							),
							'help'          => __( 'Choose whether to show or hide this column at different device sizes.', 'ep-bouwer' ),
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'medium_size'   => array(
							'type'          => 'select',
							'label'         => __('Medium Device Width', 'ep-bouwer'),
							'help'          => __( 'The width of this column on medium devices such as tablets.', 'ep-bouwer' ),
							'options'       => array(
								'default'       => __('Default', 'ep-bouwer'),
								'custom'        => __('Custom', 'ep-bouwer'),
							),
							'toggle'               => array(
								'custom'               => array(
									'fields'               => array('custom_medium_size')
								)
							),
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'custom_medium_size' => array(
							'type'          => 'text',
							'label'         => __('Custom Medium Device Width', 'ep-bouwer'),
							'default'       => '100',
							'description'   => '%',
							'maxlength'     => '5',
							'size'          => '6',
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'responsive_size' => array(
							'type'          => 'select',
							'label'         => __('Small Device Width', 'ep-bouwer'),
							'help'          => __( 'The width of this column on small devices such as phones.', 'ep-bouwer' ),
							'options'       => array(
								'default'       => __('Default', 'ep-bouwer'),
								'custom'        => __('Custom', 'ep-bouwer'),
							),
							'toggle'               => array(
								'custom'               => array(
									'fields'               => array('custom_responsive_size')
								)
							),
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'custom_responsive_size' => array(
							'type'          => 'text',
							'label'         => __( 'Custom Small Device Width', 'ep-bouwer' ),
							'default'       => '100',
							'description'   => '%',
							'maxlength'     => '5',
							'size'          => '6',
							'preview'         => array(
								'type'            => 'none'
							)
						)
					)
				),
				'css_selectors' => array(
					'title'         => __('CSS Selectors', 'ep-bouwer'),
					'fields'        => array(
						'id'            => array(
							'type'          => 'text',
							'label'         => __('ID', 'ep-bouwer'),
							'help'          => __( "A unique ID that will be applied to this column's HTML. Must start with a letter and only contain dashes, underscores, letters or numbers. No spaces.", 'ep-bouwer' ),
							'preview'         => array(
								'type'            => 'none'
							)
						),
						'class'         => array(
							'type'          => 'text',
							'label'         => __('CSS Class', 'ep-bouwer'),
							'help'          => __( "A class that will be applied to this column's HTML. Must start with a letter and only contain dashes, underscores, letters or numbers. Separate multiple classes with spaces.", 'ep-bouwer' ),
							'preview'         => array(
								'type'            => 'none'
							)
						)
					)
				)
			)
		)
	)
));