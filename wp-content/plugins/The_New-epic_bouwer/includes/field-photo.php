<?php $photo = EPBOUWERPhoto::get_attachment_data($value); ?>
<div class="fl-photo-field ep-bouwer-custom-field<?php if(empty($value) || !$photo) echo ' fl-photo-empty'; if(isset($field['class'])) echo ' ' . $field['class']; ?>">
	<a class="fl-photo-select" href="javascript:void(0);" onclick="return false;"><?php _e('Select Photo', 'ep-bouwer'); ?></a>
	<div class="fl-photo-preview">
		<div class="fl-photo-preview-img">
			<img src="<?php if($photo) echo EPBOUWERPhoto::get_thumb($photo); ?>" />
		</div>
		<select name="<?php echo $name; ?>_src">
			<?php if($photo && isset($settings->{$name . '_src'})) echo EPBOUWERPhoto::get_src_options($settings->{$name . '_src'}, $photo); ?>
		</select>
		<br />
		<a class="fl-photo-edit" href="javascript:void(0);" onclick="return false;"><?php _e('Edit', 'ep-bouwer'); ?></a>
		<a class="fl-photo-replace" href="javascript:void(0);" onclick="return false;"><?php _e('Replace', 'ep-bouwer'); ?></a>
		<div class="fl-clear"></div>
	</div>
	<input name="<?php echo $name; ?>" type="hidden" value='<?php echo $value; ?>' />
</div>