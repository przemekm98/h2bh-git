<?php

// Get the query data.
$query = EPBOUWERLoop::query($settings);

// Render the posts.
if($query->have_posts()) :

?>
<div class="fl-post-<?php echo $settings->layout; ?>" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<?php

	while($query->have_posts()) {

		$query->the_post();

		include $module->dir . 'includes/post-' . $settings->layout . '.php';
	}

	?>
	<div class="fl-post-grid-sizer"></div>
</div>
<div class="fl-clear"></div>
<?php endif; ?>
<?php

// Render the pagination.
if($settings->pagination != 'none' && $query->have_posts()) :

?>
<div class="ep-bouwer-pagination"<?php if($settings->pagination == 'scroll') echo ' style="display:none;"'; ?>>
	<?php EPBOUWERLoop::pagination($query); ?>
</div>
<?php endif; ?>
<?php

// Render the empty message.
if(!$query->have_posts() && (defined('DOING_AJAX') || isset($_REQUEST['ep_bouwer']))) :

?>
<div class="fl-post-grid-empty"><?php _e( 'No posts found.', 'ep-bouwer' ); ?></div>
<?php

endif;

wp_reset_postdata();

?>