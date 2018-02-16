<?php

$enabled_templates = EPBOUWERModel::get_enabled_templates();
$template_admin_ui = EPBOUWERModel::is_user_templates_admin_enabled() ? 1 : 0;

?>
<div id="fl-templates-form" class="fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e('Template Settings', 'ep-bouwer'); ?></h3>

	<form id="templates-form" action="<?php EPBOUWERAdminSettings::render_form_action( 'templates' ); ?>" method="post">

		<?php if ( EPBOUWERAdminSettings::multisite_support() && ! is_network_admin() ) : ?>
		<label>
			<input class="fl-override-ms-cb" type="checkbox" name="fl-override-ms" value="1" <?php if(get_option('_ep_bouwer_enabled_templates')) echo 'checked="checked"'; ?> />
			<?php _e('Override network settings?', 'ep-bouwer'); ?>
		</label>
		<?php endif; ?>

		<div class="fl-settings-form-content">

			<h4><?php _e( 'Enable Templates', 'ep-bouwer' ); ?></h4>
			<p><?php _e( 'Use this setting to enable or disable templates in the builder interface.', 'ep-bouwer' ); ?></p>
			<select name="fl-template-settings">
				<option value="enabled" <?php selected( $enabled_templates, 'enabled' ); ?>><?php _e( 'Enable All Templates', 'ep-bouwer' ); ?></option>
				<option value="core" <?php selected( $enabled_templates, 'core' ); ?>><?php _e( 'Enable Core Templates Only', 'ep-bouwer' ); ?></option>
				<option value="user" <?php selected( $enabled_templates, 'user' ); ?>><?php _e( 'Enable User Templates Only', 'ep-bouwer' ); ?></option>
				<option value="disabled" <?php selected( $enabled_templates, 'disabled' ); ?>><?php _e( 'Disable All Templates', 'ep-bouwer' ); ?></option>
			</select>
			
			<h4><?php _e( 'Enable Templates Admin', 'ep-bouwer' ); ?></h4>
			<p><?php _e( 'Use this setting to edit builder templates in the WordPress admin.', 'ep-bouwer' ); ?></p>
			<p>
				<label>
					<input type="checkbox" name="fl-template-admin-ui" value="1" <?php checked( $template_admin_ui, 1 ); ?> />
					<span><?php _e( 'Enable Templates Admin', 'ep-bouwer' ); ?></span>
				</label>
			</p>
			
			<?php
			
			if ( class_exists( 'EPBOUWERTemplatesOverride' ) ) {
				EPBOUWERTemplatesOverride::render_admin_settings();
			}
				
			?>
			
		</div>
		<p class="submit">
			<input type="submit" name="update" class="button-primary" value="<?php esc_attr_e( 'Save Template Settings', 'ep-bouwer' ); ?>" />
			<?php wp_nonce_field('templates', 'fl-templates-nonce'); ?>
		</p>
	</form>
</div>