<div id="fl-editing-form" class="fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e('Editing Settings', 'ep-bouwer'); ?></h3>

	<form id="editing-form" action="<?php EPBOUWERAdminSettings::render_form_action( 'editing' ); ?>" method="post">

		<?php if ( EPBOUWERAdminSettings::multisite_support() && ! is_network_admin() ) : ?>
		<label>
			<input class="fl-override-ms-cb" type="checkbox" name="fl-override-ms" value="1" <?php if(get_option('_ep_bouwer_editing_capability')) echo 'checked="checked"'; ?> />
			<?php _e('Override network settings?', 'ep-bouwer'); ?>
		</label>
		<?php endif; ?>

		<div class="fl-settings-form-content">

			<p><?php printf( __( 'Set the <a%s>capability</a> required for users to access advanced builder editing such as adding, deleting or moving modules.', 'ep-bouwer' ), ' href="http://codex.wordpress.org/Roles_and_Capabilities#Capability_vs._Role_Table" target="_blank"' ); ?></p>

			<input type="text" name="fl-editing-capability" value="<?php echo esc_html(EPBOUWERModel::get_editing_capability()); ?>" class="regular-text" />

		</div>
		<p class="submit">
			<input type="submit" name="update" class="button-primary" value="<?php esc_attr_e( 'Save Editing Settings', 'ep-bouwer' ); ?>" />
			<?php wp_nonce_field('editing', 'fl-editing-nonce'); ?>
		</p>
	</form>
</div>