<form class="fl-contact-form">

	<?php if ($settings->name_toggle == 'show') : ?>
	<div class="fl-input-group fl-name">
		<label for="fl-name"><?php _ex( 'Name', 'Contact form field label.', 'ep-bouwer' );?></label>
		<span class="fl-contact-error"><?php _e('Please enter your name.', 'ep-bouwer');?></span>
		<input type="text" name="fl-name" value="" placeholder="<?php esc_attr_e( 'Your name', 'ep-bouwer' ); ?>" />
	</div>
	<?php endif; ?>

	<?php if ($settings->subject_toggle == 'show') : ?>
	<div class="fl-input-group fl-subject">
		<label for="fl-subject"><?php _e('Subject', 'ep-bouwer');?></label>
		<span class="fl-contact-error"><?php _e('Please enter a subject.', 'ep-bouwer');?></span>
		<input type="text" name="fl-subject" value="" placeholder="<?php esc_attr_e( 'Subject', 'ep-bouwer' ); ?>" />
	</div>
	<?php endif; ?>

	<?php if ($settings->email_toggle == 'show') : ?>
	<div class="fl-input-group fl-email">
		<label for="fl-email"><?php _e('Email', 'ep-bouwer');?></label>
		<span class="fl-contact-error"><?php _e('Please enter a valid email.', 'ep-bouwer');?></span>
		<input type="email" name="fl-email" value="" placeholder="<?php esc_attr_e( 'Your email', 'ep-bouwer' ); ?>" />
	</div>
	<?php endif; ?>

	<?php if ($settings->phone_toggle == 'show') : ?>
	<div class="fl-input-group fl-phone">
		<label for="fl-phone"><?php _e('Phone', 'ep-bouwer');?></label>
		<span class="fl-contact-error"><?php _e('Please enter a valid phone number.', 'ep-bouwer');?></span>
		<input type="tel" name="fl-phone" value="" placeholder="<?php esc_attr_e( 'Your phone', 'ep-bouwer' ); ?>" />
	</div>
	<?php endif; ?>

	<div class="fl-input-group fl-message">
		<label for="fl-message"><?php _e('Your Message', 'ep-bouwer');?></label>
		<span class="fl-contact-error"><?php _e('Please enter a message.', 'ep-bouwer');?></span>
		<textarea name="fl-message" placeholder="<?php esc_attr_e( 'Your message', 'ep-bouwer' ); ?>"></textarea>
	</div>

	<input type="text" value="<?php echo $settings->mailto_email; ?>" style="display: none;" class="fl-mailto">

	<input type="submit" value="<?php esc_attr_e( 'Send', 'ep-bouwer' ); ?>" class="fl-contact-form-submit" />
	<span class="fl-success" style="display:none;"><?php _e( 'Message Sent!', 'ep-bouwer' ); ?></span>
	<span class="fl-send-error" style="display:none;"><?php _e( 'Message failed. Please try again.', 'ep-bouwer' ); ?></span>
</form>
