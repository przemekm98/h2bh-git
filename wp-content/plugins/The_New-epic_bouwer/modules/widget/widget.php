<?php

/**
 * @class FLWidgetModule
 */
class FLWidgetModule extends EPBOUWERModule {

    /** 
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Widget', 'ep-bouwer'),
            'description'   => __('Display a WordPress widget.', 'ep-bouwer'),
            'category'   	=> __('WordPress Widgets', 'ep-bouwer'),
            'editor_export' => false
        ));
    }

    /** 
     * @method update
     */  
    public function update( $settings )
    {
	    global $wp_widget_factory;
	    
	    // Make sure we have a widget.
	    if ( ! isset( $settings->widget ) || ! isset( $wp_widget_factory->widgets[ $settings->widget ] ) ) {
		    return $settings;
	    }
	    
	    // Get the widget instance.
	    $factory  = $wp_widget_factory->widgets[ $settings->widget ];
	    $class    = get_class( $factory );
	    $instance = new $class( $factory->id_base, $factory->name, $factory->widget_options );
	    
	    // Get the widget settings.
	    $settings_key = 'widget-' . $instance->id_base;
	    $widget_settings = array();
	    
	    if ( isset( $settings->$settings_key ) ) {
	        $widget_settings = ( array )$settings->$settings_key;
	    }
	    
	    // Run the widget update method.
	    $widget_settings = $instance->update( $widget_settings, array() );
	    
	    // Save the widget settings as an object.
	    if ( is_array( $widget_settings ) ) {
		    $settings->$settings_key = ( object )$widget_settings;
	    }
	    
	    // Return the settings.
	    return $settings;
    }
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLWidgetModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'ep-bouwer'), // Tab title
        'file'          => EP_BOUWER_DIR . 'modules/widget/includes/settings-general.php'
    )
));