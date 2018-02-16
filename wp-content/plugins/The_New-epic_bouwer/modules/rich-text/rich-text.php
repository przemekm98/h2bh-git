<?php

/**
 * @class FLRichTextModule
 */
class FLRichTextModule extends EPBOUWERModule {

	/** 
	 * @method __construct
	 */  
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Text Editor', 'ep-bouwer'),
			'description'   => __('A WYSIWYG text editor.', 'ep-bouwer'),
			'category'      => __('Basic Modules', 'ep-bouwer')
		));
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLRichTextModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'ep-bouwer'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'text'          => array(
						'type'          => 'editor',
						'label'         => '',
						'rows'          => 16,
						'preview'         => array(
							'type'             => 'text',
							'selector'         => '.fl-rich-text'  
						)
					)
				)
			)
		)
	)
));