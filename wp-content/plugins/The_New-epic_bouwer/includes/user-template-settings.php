<?php

EPBOUWER::register_settings_form('user_template', array(
	'title' => __('Save Template', 'ep-bouwer'),
	'tabs' => array(
		'general'  => array(
			'title'         => __('General', 'ep-bouwer'),
			'description'   => __('Save the current layout as a template that can be reused under <strong>Templates &rarr; Your Templates</strong>.', 'ep-bouwer'),
			'sections'      => array(
				'general'       => array(
					'title'         => '',
					'fields'        => array(
						'name'          => array(
							'type'          => 'text',
							'label'         => _x( 'Name', 'Template name.', 'ep-bouwer' )
						)
					)
				)
			)
		)
	)
));