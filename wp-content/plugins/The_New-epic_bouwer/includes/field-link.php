<div class="fl-link-field">
	<input type="text" name="<?php echo $name; ?>" value="<?php echo esc_url($value); ?>" class="text fl-link-field-input" placeholder="http://www.example.com" />
	<span class="fl-link-field-select ep-bouwer-button ep-bouwer-button-small" href="javascript:void(0);" onclick="return false;"><?php _e('Select', 'ep-bouwer'); ?></span>
	<div class="fl-link-field-search">
		<span class="fl-link-field-search-title"><?php _e('Enter a post title to search.', 'ep-bouwer'); ?></span>
		<input type="text" name="<?php echo $name; ?>-search" class="text text-full fl-link-field-search-input" placeholder="<?php esc_attr_e( 'Start typing...', 'ep-bouwer' ); ?>" />
		<span class="fl-link-field-search-cancel ep-bouwer-button ep-bouwer-button-small" href="javascript:void(0);" onclick="return false;"><?php _e('Cancel', 'ep-bouwer'); ?></span>
	</div>
</div>