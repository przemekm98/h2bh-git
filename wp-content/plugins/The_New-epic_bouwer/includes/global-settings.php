<?php

EPBOUWER::register_settings_form('global', array(
	'title' => sprintf( _x( '%s Settings', '%s stands for custom branded "Page Builder" name.', 'ep-bouwer' ), EPBOUWERModel::get_branding() ),
	'tabs' => array(
		'general'  => array(
			'title'         => __('General', 'ep-bouwer'),
			'description'   => __('Note: These settings apply to all posts and pages.', 'ep-bouwer'),
			'sections'      => array(
				'page_heading'  => array(
					'title'         => __('Default Page Heading', 'ep-bouwer'),
					'fields'        => array(
						'show_default_heading' => array(
							'type'                 => 'select',
							'label'                => _x( 'Show', 'General settings form field label. Intended meaning: "Show page heading?"', 'ep-bouwer' ),
							'default'              => '0',
							'options'              => array(
								'0'                     => __('No', 'ep-bouwer'),
								'1'                     => __('Yes', 'ep-bouwer')
							),
							'toggle'               => array(
								'0'                    => array(
									'fields'               => array('default_heading_selector')
								)
							),
							'help'                     => __('Choosing no will hide the default theme heading for the "Page" post type. You will also be required to enter some basic CSS for this to work if you choose no.', 'ep-bouwer'),
						),
						'default_heading_selector' => array(
							'type'                     => 'text',
							'label'                    => __('CSS Selector', 'ep-bouwer'),
							'default'                  => '.fl-post-header',
							'help'                     => __('Enter a CSS selector for the default page heading to hide it.', 'ep-bouwer')
						)
					)
				),
				'rows'          => array(
					'title'         => __('Rows', 'ep-bouwer'),
					'fields'        => array(
						'row_margins'       => array(
							'type'              => 'text',
							'label'             => __('Margins', 'ep-bouwer'),
							'default'           => '0',
							'maxlength'         => '3',
							'size'              => '5',
							'description'       => 'px'
						),
						'row_padding'       => array(
							'type'              => 'text',
							'label'             => __('Padding', 'ep-bouwer'),
							'default'           => '20',
							'maxlength'         => '3',
							'size'              => '5',
							'description'       => 'px'
						),
						'row_width'         => array(
							'type'              => 'text',
							'label'             => __('Max Width', 'ep-bouwer'),
							'default'           => '1100',
							'maxlength'         => '4',
							'size'              => '5',
							'description'       => 'px',
							'help'                     => __('All rows will default to this width. You can override this and make a row full width in the settings for each row.', 'ep-bouwer')
						),
						'row_width_default' => array(
							'type'    => 'select',
							'label'   => __( 'Default Row Width', 'ep-bouwer' ),
							'default' => 'fixed',
							'options' => array(
								'fixed' => __( 'Fixed', 'ep-bouwer' ),
								'full'  => __( 'Full Width', 'ep-bouwer' )
							),
							'toggle'        => array(
								'full'         => array(
									'fields'        => array('row_content_width_default')
								)
							),
						),
						'row_content_width_default' => array(
							'type'    => 'select',
							'label'   => __( 'Default Row Content Width', 'ep-bouwer' ),
							'default' => 'fixed',
							'options' => array(
								'fixed' => __( 'Fixed', 'ep-bouwer' ),
								'full'  => __( 'Full Width', 'ep-bouwer' )
							),
						)
					)
				),
				'modules'       => array(
					'title'         => __('Modules', 'ep-bouwer'),
					'fields'        => array(
						'module_margins'    => array(
							'type'              => 'text',
							'label'             => __('Margins', 'ep-bouwer'),
							'default'           => '20',
							'maxlength'         => '3',
							'size'              => '5',
							'description'       => 'px'
						)
					)
				),
				'responsive'    => array(
					'title'         => __('Responsive Layout', 'ep-bouwer'),
					'fields'        => array(
						'responsive_enabled'   => array(
							'type'                 => 'select',
							'label'                => _x( 'Enabled', 'General settings form field label. Intended meaning: "Responsive layout enabled?"', 'ep-bouwer' ),
							'default'              => '1',
							'options'              => array(
								'0'                     => __('No', 'ep-bouwer'),
								'1'                     => __('Yes', 'ep-bouwer')
							),
							'toggle'               => array(
								'1'                    => array(
									'fields'               => array('auto_spacing', 'responsive_breakpoint', 'medium_breakpoint')
								)
							)
						),
						'auto_spacing'         => array(
							'type'                 => 'select',
							'label'                => _x( 'Enable Auto Spacing', 'General settings form field label. Intended meaning: "Enable auto spacing for responsive layouts?"', 'ep-bouwer' ),
							'default'              => '1',
							'options'              => array(
								'0'                     => __('No', 'ep-bouwer'),
								'1'                     => __('Yes', 'ep-bouwer')
							),
							'help'              => __('When auto spacing is enabled, the builder will automatically adjust the margins and padding in your layout once the small device breakpoint is reached. Most users will want to leave this enabled.', 'ep-bouwer')
						),
						'medium_breakpoint' => array(
							'type'              => 'text',
							'label'             => __('Medium Device Breakpoint', 'ep-bouwer'),
							'default'           => '992',
							'maxlength'         => '4',
							'size'              => '5',
							'description'       => 'px',
							'help'              => __('The browser width at which the layout will adjust for medium devices such as tablets.', 'ep-bouwer')
						),
						'responsive_breakpoint' => array(
							'type'              => 'text',
							'label'             => __('Small Device Breakpoint', 'ep-bouwer'),
							'default'           => '768',
							'maxlength'         => '4',
							'size'              => '5',
							'description'       => 'px',
							'help'              => __('The browser width at which the layout will adjust for small devices such as phones.', 'ep-bouwer')
						)
					)
				)
			)
		)
	)
));