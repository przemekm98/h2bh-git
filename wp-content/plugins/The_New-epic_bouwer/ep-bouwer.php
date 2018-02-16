<?php
/**
 * Plugin Name: Epic Bouwer Plugin (Standard Version)
 * Plugin URI: http://epicwebsite.nl/plugins/
 * Description: A drag and drop frontend WordPress page builder plugin that works with almost any theme!
 * Version: 1.6.0.2
 * Author: The Epic Bouwer Team
 * Author URI: http://epicwebsite.nl/plugins/
 * Copyright: (c) 2014 Epic Bouwer
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ep-bouwer
 */
define('EP_BOUWER_VERSION', '1.6.0.2');
define('EP_BOUWER_DIR', plugin_dir_path(__FILE__));
define('EP_BOUWER_URL', plugins_url('/', __FILE__));
define('EP_BOUWER_LITE', false);
define('EP_BOUWER_SUPPORT_URL', 'http://www.epicwebsite.nl/epicbouwer/support/');
define('EP_BOUWER_UPGRADE_URL', 'http://www.epicwebsite.nl/epicbouwer/pricing/');
define('EP_BOUWER_DEMO_URL', 'http://www.epicwebsite.nl/epicbouwer/demo/');
define('EP_BOUWER_OLD_DEMO_URL', 'http://demos.epicwebsite.nl');
define('EP_BOUWER_DEMO_CACHE_URL', 'http://www.epicwebsite.nl/epicbouwer/demo//wp-content/uploads/ep-plugin/cache/');

/* Classes */
require_once 'classes/class-ep-bouwer.php';
require_once 'classes/class-ep-bouwer-admin.php';
require_once 'classes/class-ep-bouwer-admin-posts.php';
require_once 'classes/class-ep-bouwer-auto-suggest.php';
require_once 'classes/class-ep-bouwer-color.php';
require_once 'classes/class-ep-bouwer-icons.php';
require_once 'classes/class-ep-bouwer-loop.php';
require_once 'classes/class-ep-bouwer-model.php';
require_once 'classes/class-ep-bouwer-module.php';
require_once 'classes/class-ep-bouwer-photo.php';
require_once 'classes/class-ep-bouwer-services.php';
require_once 'classes/class-ep-bouwer-update.php';
require_once 'classes/class-ep-bouwer-utils.php';

/* Includes */
require_once 'includes/compatibility.php';
require_once 'includes/updater/updater.php';

/* Plugin Activation */
register_activation_hook(__FILE__,                             'EPBOUWERAdmin::activate');

/* Localization */
add_action('plugins_loaded',                                   'EPBOUWER::load_plugin_textdomain');

/* Updates */
add_action('init',                                             'EPBOUWERUpdate::init');

/* Load Settings and Modules */
add_action('init',                                             'EPBOUWERModel::load_settings', 1);
add_action('init',                                             'EPBOUWERModel::load_modules', 2);

/* Admin Actions */
add_action('init',                                             'EPBOUWERAdmin::init');
add_action('current_screen',                                   'EPBOUWERAdminPosts::init');
add_action('wp_ajax_ep_bouwer_save',                           'EPBOUWERModel::update');
add_action('before_delete_post',                               'EPBOUWERModel::delete_post');
add_action('save_post',                                        'EPBOUWERModel::save_revision');
add_action('wp_restore_post_revision',                         'EPBOUWERModel::restore_revision', 10, 2);

/* Admin Filters */
add_filter('heartbeat_received',                               'EPBOUWERModel::lock_post', 10, 2);
add_filter('redirect_post_location',                           'EPBOUWERAdminPosts::redirect_post_location');
add_filter('page_row_actions',                                 'EPBOUWERAdminPosts::render_row_actions_link');
add_filter('post_row_actions',                                 'EPBOUWERAdminPosts::render_row_actions_link');
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'EPBOUWERAdmin::render_plugin_action_links');
add_filter('all_plugins',                                      'EPBOUWERAdmin::white_label_plugins_page');

/* AJAX Actions */
add_action('fl_ajax_ep_bouwer_save',                          'EPBOUWERModel::update');
add_action('fl_ajax_ep_bouwer_autosuggest',                   'EPBOUWERAutoSuggest::init');
add_action('fl_ajax_ep_bouwer_render_service_settings',       'EPBOUWERServices::render_settings');
add_action('fl_ajax_ep_bouwer_connect_service',               'EPBOUWERServices::connect_service');
add_action('fl_ajax_ep_bouwer_render_service_fields',         'EPBOUWERServices::render_fields');
add_action('fl_ajax_ep_bouwer_delete_service_account',        'EPBOUWERServices::delete_account');
add_action('fl_ajax_ep_bouwer_render_layout',                 'EPBOUWER::render_layout');
add_action('fl_ajax_ep_bouwer_render_preview',                'EPBOUWER::render_preview');
add_action('fl_ajax_ep_bouwer_render_settings_form',          'EPBOUWER::render_settings_form');
add_action('fl_ajax_ep_bouwer_render_global_settings',        'EPBOUWER::render_global_settings');
add_action('fl_ajax_ep_bouwer_render_template_selector',      'EPBOUWER::render_template_selector');
add_action('fl_ajax_ep_bouwer_render_user_template_settings', 'EPBOUWER::render_user_template_settings');
add_action('fl_ajax_ep_bouwer_render_icon_selector',          'EPBOUWER::render_icon_selector');
add_action('fl_ajax_ep_bouwer_render_new_row',                'EPBOUWER::render_new_row');
add_action('fl_ajax_ep_bouwer_render_row_settings',           'EPBOUWER::render_row_settings');
add_action('fl_ajax_ep_bouwer_render_new_column_group',       'EPBOUWER::render_new_column_group');
add_action('fl_ajax_ep_bouwer_render_column_settings',        'EPBOUWER::render_column_settings');
add_action('fl_ajax_ep_bouwer_render_new_module_settings',    'EPBOUWER::render_new_module_settings');
add_action('fl_ajax_ep_bouwer_render_module_settings',        'EPBOUWER::render_module_settings');

/* Actions */
add_action('init',                                             'EPBOUWER::register_templates_post_type');
add_action('send_headers',                                     'EPBOUWER::no_cache_headers');
add_action('wp',                                               'EPBOUWER::ajax');
add_action('wp',                                               'EPBOUWER::init');
add_action('wp_enqueue_scripts',                               'EPBOUWER::layout_styles_scripts');
add_action('wp_enqueue_scripts',                               'EPBOUWER::styles_scripts');
add_action('admin_bar_menu',                                   'EPBOUWER::admin_bar_menu', 999);
add_filter('template_include',                                 'EPBOUWER::render_template', 999);
add_action('wp_footer',                                        'EPBOUWER::include_jquery');
add_action('wp_footer',                                        'EPBOUWER::render_ui');

/* Filters */
add_filter('found_posts',                                      'EPBOUWERLoop::found_posts', 1, 2);
add_filter('body_class',                                       'EPBOUWER::body_class');
add_filter('wp_default_editor',                                'EPBOUWER::default_editor');
add_filter('mce_css',                                          'EPBOUWER::add_editor_css');
add_filter('mce_buttons_2',                                    'EPBOUWER::editor_buttons_2');
add_filter('mce_external_plugins',                             'EPBOUWER::editor_external_plugins', 9999);
add_filter('the_content',                                      'EPBOUWER::render_content');
