<div class="wrap">

	<?php if(!$status) : ?>
	<p style="padding:10px 20px; background: #d54e21; color: #fff;">
		<?php _e('UPDATES UNAVAILABLE! Please subscribe or enter your licence key below to enable automatic updates.', 'ep-bouwer'); ?>
		&nbsp;<a style="color: #fff;" href="<?php echo EPBOUWERModel::get_upgrade_url( array( 'utm_source' => 'external', 'utm_medium' => 'builder', 'utm_campaign' => 'settings-page' ) ); ?>" target="_blank"><?php _e('Subscribe Now', 'ep-bouwer'); ?> &raquo;</a>
	</p>
	<?php endif; ?>

	<h3 class="fl-settings-form-header">
		<?php _e('Updates &amp; Support Subscription', 'ep-bouwer'); ?>
		<span> &mdash; </span>
		<?php if($status) : ?>
		<i style="color:#3cb341;"><?php _e('Active!', 'ep-bouwer'); ?></i>
		<?php else : ?>
		<i style="color:#ae5842;"><?php _e('Not Active!', 'ep-bouwer'); ?></i>
		<?php endif; ?>
	</h3>

	<?php if(isset($_POST['fl-updater-nonce'])) : ?>
	<div class="updated">
		<p><?php _e('Email address saved!', 'ep-bouwer'); ?></p>
	</div>
	<?php endif; ?>

	<p>
		<?php echo sprintf( __( 'Enter your <a%s>licence key</a> to enable remote updates and support.', 'ep-bouwer' ), ' href="http://www.epicwebsite.nl/epicbouwer/my-account/?utm_source=external&utm_medium=builder&utm_campaign=settings-page" target="_blank"' ) ?>
	</p>
	<?php if(is_multisite()) : ?>
	<p>
		<strong><?php _e( 'NOTE:', 'ep-bouwer' ); ?></strong> <?php _e('This applies to all sites on the network.', 'ep-bouwer'); ?>
	</p>
	<?php endif; ?>
	<form action="" method="post">

		<input type="password" name="email" value="<?php echo self::get_subscription_email(); ?>" class="regular-text" />

		<p class="submit">
			<input type="submit" name="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Subscription Settings', 'ep-bouwer' ); ?>">
			<?php wp_nonce_field('updater-nonce', 'fl-updater-nonce'); ?>
		</p>
	</form>

</div>