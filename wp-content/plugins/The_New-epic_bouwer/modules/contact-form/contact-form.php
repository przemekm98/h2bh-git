<?php

/**
 * @class FLHtmlModule
 */
class FLContactFormModule extends EPBOUWERModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'           => __('Contact Form', 'ep-bouwer'),
			'description'    => __('A very simple contact form.', 'ep-bouwer'),
			'category'       => __('Advanced Modules', 'ep-bouwer'),
			'editor_export'  => false
		));

		add_action('wp_ajax_ep_bouwer_email', array($this, 'send_mail'));
		add_action('wp_ajax_nopriv_ep_bouwer_email', array($this, 'send_mail'));
	}

	/**
	 * @method send_mail
	 */
	static public function send_mail($params = array()) {

		// Get the contact form post data

		$subject = (isset($_POST['subject']) ? $_POST['subject'] : __('Contact Form Submission', 'ep-bouwer'));
		$mailto = (isset($_POST['mailto']) ? $_POST['mailto'] : null);

		// Build the email
		$template = "";

		if (isset($_POST['name']))  $template .= "Name: $_POST[name] \r\n";
		if (isset($_POST['email'])) $template .= "Email: $_POST[email] \r\n";
		if (isset($_POST['phone'])) $template .= "Phone: $_POST[phone] \r\n";

		$template .= __('Message', 'ep-bouwer') . ": \r\n" . $_POST['message'];

		// Double check the mailto email is proper and send
		if ($mailto && filter_var($mailto, FILTER_VALIDATE_EMAIL)) {
			wp_mail($mailto, $subject, $template);
			die('1');
		} else {
			die($mailto);
		}
	}
}

/**
 * Register the module and its form settings.
 */
EPBOUWER::register_module('FLContactFormModule', array(
	'general'       => array(
		'title'         => __('General', 'ep-bouwer'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'mailto_email'     => array(
						'type'          => 'text',
						'label'         => __('Send To Email', 'ep-bouwer'),
						'default'       => '',
						'placeholder'   => __('example@mail.com', 'ep-bouwer'),
						'help'          => __('The contact form will send to this e-mail', 'ep-bouwer'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'name_toggle'   => array(
						'type'          => 'select',
						'label'         => __('Name Field', 'ep-bouwer'),
						'default'       => 'show',
						'options'       => array(
							'show'      => __('Show', 'ep-bouwer'),
							'hide'      => __('Hide', 'ep-bouwer'),
						)
					),
					'subject_toggle'   => array(
						'type'          => 'select',
						'label'         => __('Subject Field', 'ep-bouwer'),
						'default'       => 'hide',
						'options'       => array(
							'show'      => __('Show', 'ep-bouwer'),
							'hide'      => __('Hide', 'ep-bouwer'),
						)
					),
					'email_toggle'   => array(
						'type'          => 'select',
						'label'         => __('Email Field', 'ep-bouwer'),
						'default'       => 'show',
						'options'       => array(
							'show'      => __('Show', 'ep-bouwer'),
							'hide'      => __('Hide', 'ep-bouwer'),
						)
					),
					'phone_toggle'   => array(
						'type'          => 'select',
						'label'         => __('Phone Field', 'ep-bouwer'),
						'default'       => 'hide',
						'options'       => array(
							'show'      => __('Show', 'ep-bouwer'),
							'hide'      => __('Hide', 'ep-bouwer'),
						)
					),
				)
			)
		)
	)
));
