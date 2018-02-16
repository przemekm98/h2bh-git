<div<?php EPBOUWER::render_column_group_attributes( $group ); ?>>
	<?php foreach ( $cols as $col ) : ?>
	<div<?php echo EPBOUWER::render_column_attributes( $col ); ?>>
		<div class="fl-col-content fl-node-content">
		<?php EPBOUWER::render_modules( $col->node ); ?>
		</div>
	</div>
	<?php endforeach; ?>
</div>