<div class="ep-bouwer-service-settings">
	<table class="fl-form-table">
		<?php 
		
		// Get the service type.
		$service_type = null;
	
		if ( isset( $section['services'] ) && $section['services'] != 'all' ) {
			$service_type = $section['services'];
		}
		
		// Get the service data.
		$services = EPBOUWERServices::get_services_data( $service_type );
		
		// Remove services that don't meet the requirements.
		if ( isset( $services['mailpoet'] ) && ! class_exists( 'WYSIJA' ) ) {
			unset( $services['mailpoet'] );
		}
		
		// Build the select options.
		$options  = array( '' => __( 'Choose...', 'ep-bouwer' ) );
		
		foreach ( $services as $key => $service ) {
			$options[ $key ] = $service['name'];
		}
		
		// Render the service select.
		EPBOUWER::render_settings_field( 'service', array(
			'row_class'     => 'ep-bouwer-service-select-row',
			'class'         => 'ep-bouwer-service-select',
			'type'          => 'select',
			'label'         => __( 'Service', 'ep-bouwer' ),
			'options'       => $options,
			'preview'       => array(
				'type'          => 'none'
			)
		), $settings ); 
		
		?>
	</table>
</div>