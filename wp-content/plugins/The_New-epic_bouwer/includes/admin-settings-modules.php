<div id="fl-modules-form" class="fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e('Enabled Modules', 'ep-bouwer'); ?></h3>

	<form id="modules-form" action="<?php EPBOUWERAdminSettings::render_form_action( 'modules' ); ?>" method="post">

		<?php if ( EPBOUWERAdminSettings::multisite_support() && ! is_network_admin() ) : ?>
		<label>
			<input class="fl-override-ms-cb" type="checkbox" name="fl-override-ms" value="1" <?php if(get_option('_ep_bouwer_enabled_modules')) echo 'checked="checked"'; ?> />
			<?php _e('Override network settings?', 'ep-bouwer'); ?>
		</label>
		<?php endif; ?>
		
		<div class="fl-settings-form-content">

			<p><?php _e('Check or uncheck modules below to enable or disable them.', 'ep-bouwer'); ?></p>
			<?php

			$categories         = EPBOUWERModel::get_categorized_modules( true );
			$enabled_modules    = EPBOUWERModel::get_enabled_modules();
			$checked            = in_array('all', $enabled_modules) ? 'checked' : '';

			?>
			<label>
				<input class="fl-module-all-cb" type="checkbox" name="fl-modules[]" value="all" <?php echo $checked; ?> />
				<?php _ex( 'All', 'Plugin setup page: Modules.', 'ep-bouwer' ); ?>
			</label>
			<?php foreach ( $categories as $title => $modules ) : ?>
			<h3><?php echo $title; ?></h3>
				<?php
					
				if ( $title == __( 'WordPress Widgets', 'ep-bouwer') ) : 
					
					$checked = in_array('widget', $enabled_modules) ? 'checked' : '';
					
				?>
				<p>
					<label>
						<input class="fl-module-cb" type="checkbox" name="fl-modules[]" value="widget" <?php echo $checked; ?> />
						<?php echo $title; ?>
					</label>
				</p>
				<?php
					
					continue;
				
				endif;
					
				foreach ( $modules as $module ) :
	
					$checked = in_array($module->slug, $enabled_modules) ? 'checked' : '';
	
				?>
				<p>
					<label>
						<input class="fl-module-cb" type="checkbox" name="fl-modules[]" value="<?php echo $module->slug; ?>" <?php echo $checked; ?> />
						<?php echo $module->name; ?>
					</label>
				</p>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</div>
		<p class="submit">
			<input type="submit" name="update" class="button-primary" value="<?php esc_attr_e( 'Save Module Settings', 'ep-bouwer' ); ?>" />
			<?php wp_nonce_field('modules', 'fl-modules-nonce'); ?>
		</p>
	</form>
</div>