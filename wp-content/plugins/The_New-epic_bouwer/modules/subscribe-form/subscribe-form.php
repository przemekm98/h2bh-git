<?php

/**
 * A module that adds a simple subscribe form to your layout
 * with third party optin integration.
 *
 * @since 1.5.2
 */
class FLSubscribeFormModule extends EPBOUWERModule {

	/** 
	 * @since 1.5.2
	 * @return void
	 */  
	public function __construct()
	{
		parent::__construct( array(
			'name'          => __( 'Subscribe Form', 'ep-bouwer' ),
			'description'   => __( 'Adds a simple subscribe form to your layout.', 'ep-bouwer' ),
			'category'      => __( 'Advanced Modules', 'ep-bouwer' ),
			'editor_export' => false
		));
		
		add_action( 'wp_ajax_ep_bouwer_subscribe_form_submit', array( $this, 'submit' ) );
		add_action( 'wp_ajax_nopriv_ep_bouwer_subscribe_form_submit', array( $this, 'submit' ) );
	}

	/** 
	 * Called via AJAX to submit the subscribe form. 
	 *
	 * @since 1.5.2
	 * @return string The JSON encoded response.
	 */  
	public function submit()
	{
		$name       = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : false;
		$email      = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : false;
		$node_id    = isset( $_POST['node_id'] ) ? sanitize_text_field( $_POST['node_id'] ) : false;
		$result     = array(
			'action'    => false,
			'error'     => false,
			'message'   => false,
			'url'       => false
		);
		
		if ( $email && $node_id ) {
			
			$module   = EPBOUWERModel::get_module( $node_id );
			$settings = $module->settings;
			
			// Subscribe.
			$instance = EPBOUWERServices::get_service_instance( $settings->service );
			$response = $instance->subscribe( $settings, $email, $name );
			
			// Check for an error from the service.
			if ( $response['error'] ) {
				$result['error'] = $response['error'];
			}
			// Setup the success data.
			else {
				
				$result['action'] = $settings->success_action;
				
				if ( 'message' == $settings->success_action ) {
					$result['message']  = $settings->success_message;
				}
				else {
					$result['url']  = $settings->success_url;
				}
			}
		}
		else {
			$result['error'] = __( 'There was an error subscribing. Please try again.', 'ep-bouwer' );
		}
		
		echo json_encode( $result );
		
		die();
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module( 'FLSubscribeFormModule', array(
	'general'       => array(
		'title'         => __( 'General', 'ep-bouwer' ),
		'sections'      => array(
			'service'       => array(
				'title'         => '',
				'file'          => EP_BOUWER_DIR . 'includes/service-settings.php',
				'services'      => 'autoresponder'
			),
			'structure'        => array(
				'title'         => __( 'Structure', 'ep-bouwer' ),
				'fields'        => array(
					'layout'        => array(
						'type'          => 'select',
						'label'         => __( 'Layout', 'ep-bouwer' ),
						'default'       => 'stacked',
						'options'       => array(
							'stacked'       => __( 'Stacked', 'ep-bouwer' ),
							'inline'        => __( 'Inline', 'ep-bouwer' ),
						)
					),
					'show_name'     => array(
						'type'          => 'select',
						'label'         => __( 'Name Field', 'ep-bouwer' ),
						'default'       => 'show',
						'options'       => array(
							'show'          => __( 'Show', 'ep-bouwer' ),
							'hide'          => __( 'Hide', 'ep-bouwer' ),
						)
					)
				)
			),
			'success'       => array(
				'title'         => __( 'Success', 'ep-bouwer' ),
				'fields'        => array(
					'success_action' => array(
						'type'          => 'select',
						'label'         => __( 'Success Action', 'ep-bouwer' ),
						'options'       => array(
							'message'       => __( 'Show Message', 'ep-bouwer' ),
							'redirect'      => __( 'Redirect', 'ep-bouwer' )
						),
						'toggle'        => array(
							'message'       => array(
								'fields'        => array( 'success_message' )
							),
							'redirect'      => array(
								'fields'        => array( 'success_url' )
							)
						),
						'preview'       => array(
							'type'             => 'none'  
						)
					),
					'success_message' => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false,
						'rows'          => 8,
						'default'       => __( 'Thanks for subscribing! Please check your email for further instructions.', 'ep-bouwer' ),
						'preview'       => array(
							'type'             => 'none'  
						)
					),
					'success_url'  => array(
						'type'          => 'link',
						'label'         => __( 'Success URL', 'ep-bouwer' ),
						'preview'       => array(
							'type'             => 'none'  
						)
					)
				)
			)
		)
	),
	'button'        => array(
		'title'         => __( 'Button', 'ep-bouwer' ),
		'sections'      => array(
			'btn_general'   => array(
				'title'         => '',
				'fields'        => array(
					'btn_text'      => array(
						'type'          => 'text',
						'label'         => __( 'Button Text', 'ep-bouwer' ),
						'default'       => __( 'Subscribe!', 'ep-bouwer' )
					),
					'btn_icon'      => array(
						'type'          => 'icon',
						'label'         => __( 'Button Icon', 'ep-bouwer' ),
						'show_remove'   => true
					),
					'btn_icon_position' => array(
						'type'          => 'select',
						'label'         => __('Icon Position', 'ep-bouwer'),
						'default'       => 'before',
						'options'       => array(
							'before'        => __('Before Text', 'ep-bouwer'),
							'after'         => __('After Text', 'ep-bouwer')
						)
					)
				)
			),
			'btn_colors'     => array(
				'title'         => __( 'Button Colors', 'ep-bouwer' ),
				'fields'        => array(
					'btn_bg_color'  => array(
						'type'          => 'color',
						'label'         => __( 'Background Color', 'ep-bouwer' ),
						'default'       => '',
						'show_reset'    => true
					),
					'btn_bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __( 'Background Hover Color', 'ep-bouwer' ),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'btn_text_color' => array(
						'type'          => 'color',
						'label'         => __( 'Text Color', 'ep-bouwer' ),
						'default'       => '',
						'show_reset'    => true
					),
					'btn_text_hover_color' => array(
						'type'          => 'color',
						'label'         => __( 'Text Hover Color', 'ep-bouwer' ),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			),
			'btn_style'     => array(
				'title'         => __( 'Button Style', 'ep-bouwer' ),
				'fields'        => array(
					'btn_style'     => array(
						'type'          => 'select',
						'label'         => __( 'Style', 'ep-bouwer' ),
						'default'       => 'flat',
						'options'       => array(
							'flat'          => __( 'Flat', 'ep-bouwer' ),
							'gradient'      => __( 'Gradient', 'ep-bouwer' ),
							'transparent'   => __( 'Transparent', 'ep-bouwer' )
						),
						'toggle'        => array(
							'transparent'   => array(
								'fields'        => array( 'btn_bg_opacity', 'btn_border_size' )
							)
						)
					),
					'btn_border_size' => array(
						'type'          => 'text',
						'label'         => __( 'Border Size', 'ep-bouwer' ),
						'default'       => '2',
						'description'   => 'px',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					),
					'btn_bg_opacity' => array(
						'type'          => 'text',
						'label'         => __( 'Background Opacity', 'ep-bouwer' ),
						'default'       => '0',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					)
				)  
			),
			'btn_structure' => array(
				'title'         => __( 'Button Structure', 'ep-bouwer' ),
				'fields'        => array(
					'btn_font_size' => array(
						'type'          => 'text',
						'label'         => __( 'Font Size', 'ep-bouwer' ),
						'default'       => '14',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'btn_padding'   => array(
						'type'          => 'text',
						'label'         => __( 'Padding', 'ep-bouwer' ),
						'default'       => '10',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'btn_border_radius' => array(
						'type'          => 'text',
						'label'         => __( 'Round Corners', 'ep-bouwer' ),
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