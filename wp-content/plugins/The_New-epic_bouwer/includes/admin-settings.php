<div class="wrap <?php EPBOUWERAdminSettings::render_page_class(); ?>">

	<h2 class="fl-settings-heading">
		<?php EPBOUWERAdminSettings::render_page_heading(); ?>
	</h2>
	
	<?php EPBOUWERAdminSettings::render_update_message(); ?>

	<div class="fl-settings-nav">
		<ul>
			<?php EPBOUWERAdminSettings::render_nav_items(); ?>
		</ul>
	</div>

	<div class="fl-settings-content">
		<?php EPBOUWERAdminSettings::render_forms(); ?>
	</div>
</div>