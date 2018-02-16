<form class="ep-bouwer-settings fl-template-selector">
	<div class="fl-lightbox-header">
		
		<h1><?php _e('Layout Templates', 'ep-bouwer'); ?></h1>
		
		<?php if ( $enabled_templates == 'enabled' || ( $enabled_templates == 'core' && count( $templates['categorized'] ) > 1 ) ) : ?>
		<div class="fl-template-category-filter ep-bouwer-settings-fields">
			<select class="fl-template-category-select" name="fl-template-category-select">
				
				<?php if($enabled_templates == 'enabled' || $enabled_templates == 'core') : ?>
					<?php $i = 0; foreach ( $templates['categorized'] as $slug => $category ) : ?>
					<option value="ep-bouwer-settings-tab-<?php echo $slug; ?>"><?php echo $category['name']; ?></option>
					<?php $i++; endforeach; ?>
				<?php endif; ?>
		
				<?php if($enabled_templates == 'enabled' || $enabled_templates == 'user') : ?>
				<option value="ep-bouwer-settings-tab-yours"><?php _e('Your Templates', 'ep-bouwer'); ?></option>
				<?php endif; ?>
				
			</select>
		</div>
		<?php endif; ?>
		
	</div>
	<div class="ep-bouwer-settings-fields fl-nanoscroller">
		<div class="fl-nanoscroller-content">

			<?php $i = 0; if($enabled_templates == 'enabled' || $enabled_templates == 'core') : ?>
			
				<?php foreach ( $templates['categorized'] as $slug => $category ) : ?>
				<div id="ep-bouwer-settings-tab-<?php echo $slug; ?>" class="ep-bouwer-settings-tab<?php if ( 0 === $i ) echo ' fl-active'; ?>">
					<div class="ep-bouwer-settings-section">
						<?php $k = 0; foreach ( $category['templates'] as $template ) : ?>
						<div class="fl-template-preview<?php if(($k + 1) % 3 === 0) echo ' fl-last'; ?>" data-id="<?php echo $template['id']; ?>">
							<div class="fl-template-image">
								<img src="<?php echo $template['image']; ?>" />
							</div>
							<span><?php echo $template['name']; ?></span>
						</div>
						<?php $k++; endforeach; ?>
					</div>
				</div>
				<?php $i++; endforeach; ?>

			<?php endif; ?>

			<?php if($enabled_templates == 'enabled' || $enabled_templates == 'user') : ?>

			<div id="ep-bouwer-settings-tab-yours" class="ep-bouwer-settings-tab">

				<div class="ep-bouwer-settings-section">

					<p class="ep-bouwer-settings-message fl-user-templates-message"><?php _e('You haven\'t saved any templates yet! To do so, create a layout and save it as a template under <strong>Tools &rarr; Save Template</strong>.', 'ep-bouwer'); ?></p>

					<?php if(count($user_templates['templates']) > 0) : ?>
					<div class="fl-user-templates">
						<div class="fl-user-template" data-id="blank">
							<span class="fl-user-template-name"><?php _ex( 'Blank', 'Template name.', 'ep-bouwer' ); ?></span>
							<div class="fl-clear"></div>
						</div>
						<?php foreach($user_templates['categorized'] as $category) : ?>
						
						<div class="fl-user-template-category">
							<?php if ( count( $user_templates['categorized'] ) > 1 ) : ?>
							<div class="fl-user-template-category-name"><?php echo $category['name']; ?></div>
							<?php endif; ?>
							<?php foreach($category['templates'] as $template) : ?>
							<div class="fl-user-template" data-id="<?php echo $template['id']; ?>">
								<div class="fl-user-template-actions">
									<a class="fl-user-template-edit" href="<?php echo add_query_arg('ep_bouwer', '', get_permalink($template['id'])); ?>"><?php _e('Edit', 'ep-bouwer'); ?></a>
									<a class="fl-user-template-delete" href="javascript:void(0);" onclick="return false;"><?php _e('Delete', 'ep-bouwer'); ?></a>
								</div>
								<span class="fl-user-template-name"><?php echo $template['name']; ?></span>
								<div class="fl-clear"></div>
							</div>
							<?php endforeach; ?>
						</div>
							
						<?php endforeach; ?>
						<div class="fl-clear"></div>
					</div>
					<?php endif; ?>

				</div>
			</div>

			<?php endif; ?>

		</div>
	</div>
	<div class="fl-lightbox-footer">
		<span class="ep-bouwer-settings-cancel ep-bouwer-button ep-bouwer-button-large" href="javascript:void(0);" onclick="return false;"><?php _e('Cancel', 'ep-bouwer'); ?></span>
	</div>
</form>