<div class="ep-bouwer-bar">
	
	<?php if(get_post_type() == 'ep-bouwer-template') : ?>
	
	<div class="ep-bouwer-bar-content">
		<?php if(EPBOUWERModel::get_branding_icon() == '') : ?>
		<span class="ep-bouwer-bar-title ep-bouwer-bar-title-no-icon">
			<?php echo sprintf(__('Template: %s', 'ep-bouwer'), get_the_title($post_id)); ?>
		</span>
		<?php else : ?>
		<span class="ep-bouwer-bar-title">
			<img src="<?php echo EPBOUWERModel::get_branding_icon(); ?>" />
			<span><?php echo sprintf(__('Template: %s', 'ep-bouwer'), get_the_title($post_id)); ?></span>
		</span>
		<?php endif; ?>
		<div class="ep-bouwer-bar-actions">
			<?php if ( $help_button['enabled'] ) : ?>
			<span class="ep-bouwer-help-button ep-bouwer-button"><i class="fa fa-question-circle"></i></span>
			<?php endif ?>
			<span class="ep-bouwer-done-button ep-bouwer-button ep-bouwer-button-primary"><?php _e('Done', 'ep-bouwer'); ?></span>
			<span class="ep-bouwer-tools-button ep-bouwer-button"><?php _e('Tools', 'ep-bouwer'); ?></span>
			<span class="ep-bouwer-add-content-button ep-bouwer-button"><?php _e('Add Content', 'ep-bouwer'); ?></span>
			<div class="fl-clear"></div>
		</div>
		<div class="fl-clear"></div>
	</div>
	
	<?php else : ?>
	
	<div class="ep-bouwer-bar-content">
		<?php if(stristr(home_url(), 'demo.epicbouwer.nl')) : ?>
		<span class="ep-bouwer-bar-title">
			<img src="<?php echo EP_BOUWER_URL; ?>/img/epic.png" />
			<span><?php _e('Page Builder Demo', 'ep-bouwer'); ?></span>
		</span>
		<?php elseif(EPBOUWERModel::get_branding_icon() == '') : ?>
		<span class="ep-bouwer-bar-title ep-bouwer-bar-title-no-icon">
			<?php echo EPBOUWERModel::get_branding(); ?>
		</span>
		<?php else : ?>
		<span class="ep-bouwer-bar-title">
			<img src="<?php echo EPBOUWERModel::get_branding_icon(); ?>" />
			<span><?php echo EPBOUWERModel::get_branding(); ?></span>
		</span>
		<?php endif; ?>
		<div class="ep-bouwer-bar-actions">
			<?php if ( $help_button['enabled'] ) : ?>
			<span class="ep-bouwer-help-button ep-bouwer-button"><i class="fa fa-question-circle"></i></span>
			<?php endif ?>
			<?php if(stristr(home_url(), 'demo.epicbouwer.nl')) : ?>
			<span class="ep-bouwer-upgrade-button ep-bouwer-button"><?php _e('Buy Now!', 'ep-bouwer'); ?></span>
			<?php elseif(EP_BOUWER_LITE === true) : ?>
			<span class="ep-bouwer-upgrade-button ep-bouwer-button"><?php _e('Upgrade!', 'ep-bouwer'); ?></span>
			<?php endif; ?>
			<span class="ep-bouwer-done-button ep-bouwer-button ep-bouwer-button-primary"><?php _e('Done', 'ep-bouwer'); ?></span>
			<span class="ep-bouwer-tools-button ep-bouwer-button"><?php _e('Tools', 'ep-bouwer'); ?></span>
			<?php if(EP_BOUWER_LITE !== true && $enabled_templates != 'disabled') : ?>
			<span class="ep-bouwer-templates-button ep-bouwer-button"><?php _e('Templates', 'ep-bouwer'); ?></span>
			<?php endif; ?>
			<span class="ep-bouwer-add-content-button ep-bouwer-button"><?php _e('Add Content', 'ep-bouwer'); ?></span>
			<div class="fl-clear"></div>
		</div>
		<div class="fl-clear"></div>
	</div>
	
	<?php endif; ?>
	
</div>
<div class="ep-bouwer-panel">
	<div class="ep-bouwer-panel-actions">
		<i class="ep-bouwer-panel-close fa fa-times"></i>
	</div>
	<div class="ep-bouwer-panel-content-wrap fl-nanoscroller">
		<div class="ep-bouwer-panel-content fl-nanoscroller-content">
			<div class="ep-bouwer-blocks">
				<div id="ep-bouwer-blocks-rows" class="ep-bouwer-blocks-section">
					<span class="ep-bouwer-blocks-section-title">
						<?php _e('Row Layouts', 'ep-bouwer'); ?>
						<i class="fa fa-chevron-down"></i>
					</span>
					<div class="ep-bouwer-blocks-section-content ep-bouwer-rows">
						<span class="ep-bouwer-block ep-bouwer-block-row" data-cols="1-col"><?php _e('1 Column', 'ep-bouwer'); ?></span>
						<span class="ep-bouwer-block ep-bouwer-block-row" data-cols="2-cols"><?php _e('2 Columns', 'ep-bouwer'); ?></span>
						<span class="ep-bouwer-block ep-bouwer-block-row" data-cols="3-cols"><?php _e('3 Columns', 'ep-bouwer'); ?></span>
						<span class="ep-bouwer-block ep-bouwer-block-row" data-cols="4-cols"><?php _e('4 Columns', 'ep-bouwer'); ?></span>
						<span class="ep-bouwer-block ep-bouwer-block-row" data-cols="5-cols"><?php _e('5 Columns', 'ep-bouwer'); ?></span>
						<span class="ep-bouwer-block ep-bouwer-block-row" data-cols="6-cols"><?php _e('6 Columns', 'ep-bouwer'); ?></span>
						<span class="ep-bouwer-block ep-bouwer-block-row" data-cols="left-sidebar"><?php _e('Left Sidebar', 'ep-bouwer'); ?></span>   
						<span class="ep-bouwer-block ep-bouwer-block-row" data-cols="right-sidebar"><?php _e('Right Sidebar', 'ep-bouwer'); ?></span>
						<span class="ep-bouwer-block ep-bouwer-block-row" data-cols="left-right-sidebar"><?php _e('Left &amp; Right Sidebar', 'ep-bouwer'); ?></span>
					</div>
				</div>
				<?php foreach($categories as $title => $modules) : ?>
				<div id="ep-bouwer-blocks-<?php echo EPBOUWERModel::get_module_category_slug( $title ); ?>" class="ep-bouwer-blocks-section">
					<span class="ep-bouwer-blocks-section-title">
						<?php echo $title; ?>
						<i class="fa fa-chevron-down"></i>
					</span>
					<?php if($title == __('WordPress Widgets', 'ep-bouwer')) : ?>
					<div class="ep-bouwer-blocks-section-content ep-bouwer-widgets">
						<?php foreach($modules as $module) : ?>
						<span class="ep-bouwer-block ep-bouwer-block-module" data-type="widget" data-widget="<?php echo $module->class; ?>"><?php echo $module->name; ?></span>
						<?php endforeach; ?>
					</div>
					<?php else : ?>
					<div class="ep-bouwer-blocks-section-content ep-bouwer-modules">
						<?php foreach($modules as $module) : ?>
						<span class="ep-bouwer-block ep-bouwer-block-module" data-type="<?php echo $module->slug; ?>"><?php echo $module->name; ?></span>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<div class="ep-bouwer-loading"></div>
<div class="ep-bouwer-hidden-editor">
	<?php wp_editor(' ', 'flhiddeneditor', array('wpautop' => true)); ?>
</div>
<input type="hidden" id="fl-post-id" value="<?php echo $post_id; ?>" />
<input type="hidden" id="fl-admin-url" value="<?php echo admin_url(); ?>" />