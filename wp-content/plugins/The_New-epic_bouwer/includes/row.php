<div<?php EPBOUWER::render_row_attributes( $row ); ?>>
	<div class="fl-row-content-wrap">
		<?php EPBOUWER::render_row_bg( $row ); ?>
		<div class="<?php EPBOUWER::render_row_content_class( $row ); ?>">
		<?php
		
		foreach ( $groups as $group ) {
			EPBOUWER::render_column_group( $group );
		}
		
		?>
		</div>
	</div>
</div>