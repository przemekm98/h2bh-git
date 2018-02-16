<form class="ep-bouwer-settings <?php echo $form['class']; ?>" <?php echo $form['attrs']; ?>>
	<div class="fl-lightbox-header">
		<h1><?php echo $form['title']; ?></h1>
	</div>
	<?php if(count($form['tabs']) > 1) : ?>
	<div class="ep-bouwer-settings-tabs">
		<?php  $i = 0; foreach($form['tabs'] as $id => $tab) : ?>
		<a href="#ep-bouwer-settings-tab-<?php echo $id; ?>"<?php if($i == 0) echo ' class="fl-active"'; ?>><?php echo $tab['title']; ?></a>
		<?php $i++; endforeach; ?>
	</div>
	<?php endif; ?>
	<div class="ep-bouwer-settings-fields fl-nanoscroller">
		<div class="fl-nanoscroller-content">
			<?php $i = 0; foreach($form['tabs'] as $id => $tab) : // Tabs ?>
			<div id="ep-bouwer-settings-tab-<?php echo $id; ?>" class="ep-bouwer-settings-tab <?php if($i == 0) echo 'fl-active'; ?>">
			
				<?php if(isset($tab['file']) && file_exists($tab['file'])) : // Tab File ?>
				
					<?php include $tab['file']; ?>
					
				<?php else : ?>
					
					<?php if(!empty($tab['description'])) : // Tab Description ?>                            
					<p class="ep-bouwer-settings-tab-description"><?php echo $tab['description']; ?></p>
					<?php endif; ?>
			
					<?php foreach($tab['sections'] as $id => $section) : // Tab Sections ?>
					<div id="ep-bouwer-settings-section-<?php echo $id; ?>" class="ep-bouwer-settings-section">
					
						<?php if(isset($section['file']) && file_exists($section['file'])) : // Section File ?>
				
							<?php include $section['file']; ?>
							
						<?php else : ?>
					
							<?php if(!empty($section['title'])) : // Section Title ?>                            
							<h3 class="ep-bouwer-settings-title"><?php echo $section['title']; ?></h3>
							<?php endif; ?>
							
							<table class="fl-form-table">
								<?php 
								
								foreach($section['fields'] as $name => $field) {  // Fields 
									EPBOUWER::render_settings_field($name, $field, $settings);
								}
								
								?>
							</table>
					
						<?php endif; ?>
					
					</div>
					<?php endforeach; ?>
					
				<?php endif; ?>
			
			</div>
			<?php $i++; endforeach; ?>
		</div>
	</div>
	<div class="fl-lightbox-footer">
		<span class="ep-bouwer-settings-save ep-bouwer-button ep-bouwer-button-large ep-bouwer-button-primary" href="javascript:void(0);" onclick="return false;"><?php _e('Save', 'ep-bouwer'); ?></span>
		<span class="ep-bouwer-settings-cancel ep-bouwer-button ep-bouwer-button-large" href="javascript:void(0);" onclick="return false;"><?php _e('Cancel', 'ep-bouwer'); ?></span>
	</div>
</form>