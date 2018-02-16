<?php 

EPBOUWERModel::default_settings($settings, array(
	'post_type' => 'post',
	'order_by'  => 'date',
	'order'     => 'DESC',
	'offset'    => 0,
	'users'     => ''
));

?>
<div id="ep-bouwer-settings-section-general" class="fl-loop-builder ep-bouwer-settings-section">

	<table class="fl-form-table">
	<?php 
	
	// Post type
	EPBOUWER::render_settings_field('post_type', array(
		'type'          => 'post-type',
		'label'         => __('Post Type', 'ep-bouwer'),
	), $settings); 
	
	// Order by
	EPBOUWER::render_settings_field('order_by', array(
		'type'          => 'select',
		'label'         => __('Order By', 'ep-bouwer'),
		'options'       => array(
			'ID'            => __('ID', 'ep-bouwer'),
			'date'          => __('Date', 'ep-bouwer'),
			'modified'      => __('Date Last Modified', 'ep-bouwer'),
			'title'         => __('Title', 'ep-bouwer'),
			'author'        => __('Author', 'ep-bouwer'),
			'comment_count' => __('Comment Count', 'ep-bouwer'),
			'menu_order'    => __('Menu Order', 'ep-bouwer'),
			'random'        => __('Random', 'ep-bouwer'),
		)
	), $settings); 
	
	// Order
	EPBOUWER::render_settings_field('order', array(
		'type'          => 'select',
		'label'         => __('Order', 'ep-bouwer'),
		'options'       => array(
			'DESC'          => __('Descending', 'ep-bouwer'),
			'ASC'           => __('Ascending', 'ep-bouwer'),
		)
	), $settings); 
	
	// Offset
	EPBOUWER::render_settings_field('offset', array(
		'type'          => 'text',
		'label'         => _x('Offset', 'How many posts to skip.', 'ep-bouwer'),
		'default'       => '0',
		'size'          => '4',
		'help'          => __('Skip this many posts that match the specified criteria.', 'ep-bouwer')
	), $settings); 
	
	?>
	</table>
</div>
<div id="ep-bouwer-settings-section-filter" class="ep-bouwer-settings-section">
	<h3 class="ep-bouwer-settings-title"><?php _e('Filter', 'ep-bouwer'); ?></h3>
	<?php foreach(EPBOUWERLoop::post_types() as $slug => $type) : ?>
		<table class="fl-form-table fl-loop-builder-filter fl-loop-builder-<?php echo $slug; ?>-filter" <?php if($slug == $settings->post_type) echo 'style="display:table;"'; ?>>
		<?php 
		
		// Posts
		EPBOUWER::render_settings_field('posts_' . $slug, array(
			'type'          => 'suggest',
			'action'        => 'fl_as_posts',
			'data'          => $slug,
			'label'         => $type->label,
			'help'          => sprintf(__('Enter a comma separated list of %s. Only these %s will be shown.', 'ep-bouwer'), $type->label, $type->label)
		), $settings); 
		
		// Taxonomies
		$taxonomies = EPBOUWERLoop::taxonomies($slug);
		
		foreach($taxonomies as $tax_slug => $tax) {

			EPBOUWER::render_settings_field('tax_' . $slug . '_' . $tax_slug, array(
				'type'          => 'suggest',
				'action'        => 'fl_as_terms',
				'data'          => $tax_slug,
				'label'         => $tax->label,
				'help'          => sprintf(__('Enter a comma separated list of %s. Only posts with these %s will be shown.', 'ep-bouwer'), $tax->label, $tax->label)
			), $settings); 
		}
		
		?>
		</table>
	<?php endforeach; ?>
	<table class="fl-form-table">
	<?php

	// Author
	EPBOUWER::render_settings_field('users', array(
		'type'          => 'suggest',
		'action'        => 'fl_as_users',
		'label'         => __('Authors', 'ep-bouwer'),
		'help'          => __('Enter a comma separated list of authors usernames. Only posts with these authors will be shown.', 'ep-bouwer')
	), $settings); 
	
	?>
	</table>
</div>