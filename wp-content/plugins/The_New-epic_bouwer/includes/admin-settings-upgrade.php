<div id="fl-upgrade-form" class="fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e('Upgrade', 'ep-bouwer'); ?></h3>

	<p><?php _e('You are currently running the lite version of the Epic Bouwer plugin. Upgrade today for access to premium features such as advanced modules, templates, support and more!', 'ep-bouwer'); ?></p>

	<input type="button" class="button button-primary" value="<?php _e('Upgrade Now', 'ep-bouwer'); ?>" onclick="window.location.href='<?php echo EPBOUWERModel::get_upgrade_url( array( 'utm_source' => 'external', 'utm_medium' => 'builder', 'utm_campaign' => 'settings-page' ) ); ?>';" style="margin-right: 10px;">

	<input type="button" class="button button-primary" value="<?php _e('Learn More', 'ep-bouwer'); ?>" onclick="window.location.href='http://www.epicwebsite.nl/epicbouwer//?utm_source=external&utm_medium=builder&utm_campaign=settings-page';">

</div>