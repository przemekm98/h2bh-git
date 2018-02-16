<div id="fl-icons-form" class="fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e('Icon Settings', 'ep-bouwer'); ?></h3>
	
	<?php 
	  
	if ( EPBOUWERAdminSettings::multisite_support() && ! is_network_admin() ) {
		
		global $blog_id;
		
		if ( BLOG_ID_CURRENT_SITE == $blog_id ) {
			?>
			<p><?php _e( 'Icons for the main site must be managed in the network admin.', 'ep-bouwer' ); ?></p>
			</div>
			<?php
			return;
		}
	}
		
	?>

	<form id="icons-form" action="<?php EPBOUWERAdminSettings::render_form_action( 'icons' ); ?>" method="post">
		
		<?php if ( EPBOUWERAdminSettings::multisite_support() && ! is_network_admin() ) : ?>
		<label>
			<input class="fl-override-ms-cb" type="checkbox" name="fl-override-ms" value="1" <?php if(get_option('_ep_bouwer_enabled_icons')) echo 'checked="checked"'; ?> />
			<?php _e('Override network settings?', 'ep-bouwer'); ?>
		</label>
		<?php endif; ?>
		
		<div class="fl-settings-form-content">

			<p><?php printf( __( 'Enable or disable icon sets using the options below or upload a custom icon set from either <a%s>Icomoon</a> or <a%s>Fontello</a>.', 'ep-bouwer' ), ' href="https://icomoon.io/" target="_blank"', ' href="http://fontello.com/" target="_blank"' ); ?></p>
			
			<?php 
			
			$enabled_icons  = EPBOUWERModel::get_enabled_icons();
			$icon_sets      = EPBOUWERIcons::get_sets_for_current_site();  
			
			foreach ( $icon_sets as $key => $set ) {
				$checked = in_array( $key, $enabled_icons ) ? ' checked' : '';
				?>
				<p>
					<label>
						<input type="checkbox" name="fl-enabled-icons[]" value="<?php echo $key; ?>" <?php echo $checked; ?>>
						<?php echo ' ' . $set['name']; ?>
						<?php if ( 'core' != $set['type'] ) : ?>
						<a href="javascript:void(0);" class="fl-delete-icon-set" data-set="<?php echo $key; ?>"><?php _ex( 'Delete', 'Plugin setup page: Delete icon set.', 'ep-bouwer' ) ?></a>
						<?php endif; ?>
					</label>
				</p>
				<?php
			}
				
			?>

		</div>
		<p class="submit">
			<input type="button" name="fl-upload-icon" class="button" value="<?php esc_attr_e( 'Upload Icon Set', 'ep-bouwer' ); ?>" />
			<input type="submit" name="fl-save-icons" class="button-primary" value="<?php esc_attr_e( 'Save Icon Settings', 'ep-bouwer' ); ?>" />
			<input type="hidden" name="fl-new-icon-set" value="" />
			<input type="hidden" name="fl-delete-icon-set" value="" />
			<?php wp_nonce_field('icons', 'fl-icons-nonce'); ?>
		</p>
	</form>
</div>