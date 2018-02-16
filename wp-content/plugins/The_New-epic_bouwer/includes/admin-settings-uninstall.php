<div id="fl-uninstall-form" class="fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e('Uninstall', 'ep-bouwer'); ?></h3>

	<p><?php _e('Clicking the button below will uninstall the page builder plugin and delete all of the data associated with it. You can uninstall or deactivate the page builder from the plugins page instead if you do not wish to delete the data.', 'ep-bouwer'); ?></p>

	<p><strong><?php _e( 'NOTE:', 'ep-bouwer' ); ?></strong> <?php _e( 'The builder does not delete the post meta <code>_ep_bouwer_data</code>, <code>_ep_bouwer_draft</code> and <code>_ep_bouwer_enabled</code> in case you want to reinstall it later. If you do, the builder will rebuild all of its data using those meta values.', 'ep-bouwer' ); ?></p>

	<?php if(is_multisite()) : ?>
	<p><strong style="color:#ff0000;"><?php _e( 'NOTE:', 'ep-bouwer' ); ?></strong> <?php _e('This applies to all sites on the network.', 'ep-bouwer'); ?></p>
	<?php endif; ?>

	<form id="uninstall-form" action="<?php EPBOUWERAdminSettings::render_form_action( 'uninstall' ); ?>" method="post">
		<p>
			<input type="submit" name="uninstall-submit" class="button button-primary" value="<?php _e('Uninstall', 'ep-bouwer'); ?>">
			<?php wp_nonce_field('uninstall', 'fl-uninstall'); ?>
		</p>
	</form>
</div>