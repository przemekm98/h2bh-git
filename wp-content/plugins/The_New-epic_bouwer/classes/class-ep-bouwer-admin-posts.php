<?php

/**
 * Handles logic for the post edit screen. 
 *
 * @since 1.0
 */
final class EPBOUWERAdminPosts {
	
	/** 
	 * Sets the body class, loads assets and renders the UI
	 * if we are on a post type that supports the builder.
	 *
	 * @since 1.0
	 * @return void
	 */
	static public function init()
	{
		global $pagenow;
		
		if ( in_array( $pagenow, array( 'post.php', 'post-new.php') ) ) {
			
			$post_types = EPBOUWERModel::get_post_types();
			$screen		= get_current_screen();

			if ( in_array( $screen->post_type, $post_types ) ) {
				add_filter( 'admin_body_class', 'EPBOUWERAdminPosts::body_class' );
				add_action( 'admin_enqueue_scripts', 'EPBOUWERAdminPosts::styles_scripts' );
				add_action( 'edit_form_after_title', 'EPBOUWERAdminPosts::render' );
			}
		}
	}
	 
	/**
	 * Enqueues the CSS/JS for the post edit screen.
	 *
	 * @since 1.0
	 * @return void
	 */	 
	static public function styles_scripts()
	{
		global $wp_version;
		
		// Styles
		wp_enqueue_style( 'ep-bouwer-admin-posts', EP_BOUWER_URL . 'css/ep-bouwer-admin-posts.css', array(), EP_BOUWER_VERSION );
		
		// Legacy WP Styles (3.7 and below)
		if ( version_compare( $wp_version, '3.7', '<=' ) ) {
			wp_enqueue_style( 'ep-bouwer-admin-posts-legacy', EP_BOUWER_URL . 'css/ep-bouwer-admin-posts-legacy.css', array(), EP_BOUWER_VERSION );
		}
		
		// Scripts
		wp_enqueue_script( 'json2' );
		wp_enqueue_script( 'ep-bouwer-admin-posts', EP_BOUWER_URL . 'js/ep-bouwer-admin-posts.js', array(), EP_BOUWER_VERSION );
	}
	 
	/**
	 * Adds classes to the post edit screen body class.
	 *
	 * @since 1.0
	 * @param string $classes The existing body classes.
	 * @return string The body classes.
	 */	 
	static public function body_class( $classes = '' )
	{
		global $wp_version;
		
		// Builder body class
		if ( EPBOUWERModel::is_builder_enabled() ) {
			$classes .= ' ep-bouwer-enabled';
		}
		
		// Pre WP 3.8 body class
		if ( version_compare( $wp_version, '3.8', '<' ) ) {
			$classes .= ' fl-pre-wp-3-8';
		}
		
		return $classes;
	}
	 
	/**
	 * Renders the HTML for the post edit screen.
	 *
	 * @since 1.0
	 * @return void
	 */	 
	static public function render()
	{
		global $post;
		
		$post_type_obj 	= get_post_type_object ( $post->post_type );
		$post_type_name = strtolower( $post_type_obj->labels->singular_name );
		$enabled 		= EPBOUWERModel::is_builder_enabled();
		
		include EP_BOUWER_DIR . 'includes/admin-posts.php';
	}
	 
	/**
	 * Renders the action link for post listing pages.
	 *
	 * @since 1.0
	 * @param array $actions
	 * @return array The array of action data.
	 */	 
	static public function render_row_actions_link( $actions = array() ) 
	{
		global $post;
			
		if ( current_user_can( 'edit_post', $post->ID ) && wp_check_post_lock( $post->ID ) === false ) {
			
			$post_types = EPBOUWERModel::get_post_types();

			if ( in_array( $post->post_type, $post_types ) ) {
				$actions['ep-bouwer'] = '<a href="' . EPBOUWERModel::get_edit_url() . '">' . EPBOUWERModel::get_branding() . '</a>';
			}
		}
		
		return $actions;
	}
	 
	/**
	 * Where to redirect this post on save.
	 *
	 * @since 1.0
	 * @param string $location
	 * @return string The location to redirect this post on save.
	 */	 
	static public function redirect_post_location( $location ) 
	{
		if ( isset( $_POST['ep-bouwer-redirect'] ) ) {
			$location = $_POST['ep-bouwer-redirect'];
		}
		
		return $location;
	}
}