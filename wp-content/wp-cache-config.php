<?php
/*
WP-Cache Config Sample File

See wp-cache.php for author details.
*/

$wp_cache_cron_check = 1;
$wp_cache_make_known_anon = 0;
$wp_cache_mutex_disabled = 1;
$wpsc_save_headers = 0;
$cache_rebuild_files = 0;
$wp_cache_mod_rewrite = 1;
$wp_cache_front_page_checks = 1;
$wp_cache_mobile_enabled = 0;
$wp_cache_mfunc_enabled = 0;
$wp_supercache_304 = 0;
$wp_cache_no_cache_for_get = 0;
$wp_cache_disable_utf8 = 0;
$wp_super_cache_late_init = 0;
$cached_direct_pages = array(  );
$wp_cache_home_path = '/';
$cache_page_secret = 'b02791042d4fe024f0dfcb792cdef3d1';
$wp_cache_debug_username = 'c6aa1345fea20f68abe953f3502ddd92';
$wpsc_last_post_update = 1508832169; //Added by WP-Cache Manager
$wp_super_cache_comments = '1'; //Added by WP-Cache Manager
$cache_jetpack = '1'; //Added by WP-Cache Manager
$cache_schedule_interval = 'daily'; //Added by WP-Cache Manager
$cache_gc_email_me = 0; //Added by WP-Cache Manager
$cache_scheduled_time = '00:00'; //Added by WP-Cache Manager
$wp_cache_mobile_groups = ''; //Added by WP-Cache Manager
$wp_cache_mobile_prefixes = 'w3c , w3c-, acs-, alav, alca, amoi, audi, avan, benq, bird, blac, blaz, brew, cell, cldc, cmd-, dang, doco, eric, hipt, htc_, inno, ipaq, ipod, jigs, kddi, keji, leno, lg-c, lg-d, lg-g, lge-, lg/u, maui, maxo, midp, mits, mmef, mobi, mot-, moto, mwbp, nec-, newt, noki, palm, pana, pant, phil, play, port, prox, qwap, sage, sams, sany, sch-, sec-, send, seri, sgh-, shar, sie-, siem, smal, smar, sony, sph-, symb, t-mo, teli, tim-, tosh, tsm-, upg1, upsi, vk-v, voda, wap-, wapa, wapi, wapp, wapr, webc, winw, winw, xda , xda-'; //Added by WP-Cache Manager
$wp_cache_refresh_single_only = 0;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          $wp_cache_home_path = '//'; //Added by WP-Cache Manager
$wp_cache_slash_check = 1;
if ( ! defined('WPCACHEHOME') )
	define( 'WPCACHEHOME', WP_CONTENT_DIR . "/plugins/wp-super-cache/" ); //Added by WP-Cache Manager

$cache_compression = 0; // Super cache compression
$cache_enabled = true;
$super_cache_enabled = true;
$cache_max_time = '1800'; //Added by WP-Cache Manager
//$use_flock = true; // Set it true or false if you know what to use
$cache_path = '/var/www/vhosts/how2behealthy.nl/httpdocs/wp-content/cache'; //Added by WP-Cache Manager
$file_prefix = 'wp-cache-';
$ossdlcdn = 0;

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   $wp_cache_mutex_disabled = 1; //Added by WP-Cache Manager

// Just modify it if you have conflicts with semaphores
$sem_id = 1698496235; //Added by WP-Cache Manager

if ( '/' != substr($cache_path, -1)) {
	$cache_path .= '/';
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             $wp_super_cache_front_page_check = '1'; //Added by WP-Cache Manager
$wp_super_cache_front_page_notification = '1'; //Added by WP-Cache Manager

$wp_cache_object_cache = 0;
$wp_cache_anon_only = 0;
$wp_supercache_cache_list = 0;
$wp_cache_debug_to_file = 0;
$wp_super_cache_debug = '1'; //Added by WP-Cache Manager
$wp_cache_debug_level = 5;
$wp_cache_debug_ip = ''; //Added by WP-Cache Manager
$wp_cache_debug_log = 'e8257a4d769940ae1c5b0e941b6781ba.txt';
$wp_cache_debug_email = '';
$wp_cache_pages[ "search" ] = 0; //Added by WP-Cache Manager
$wp_cache_pages[ "feed" ] = 0; //Added by WP-Cache Manager
$wp_cache_pages[ "category" ] = 0; //Added by WP-Cache Manager
$wp_cache_pages[ "home" ] = 0; //Added by WP-Cache Manager
$wp_cache_pages[ "frontpage" ] = 0; //Added by WP-Cache Manager
$wp_cache_pages[ "tag" ] = 0; //Added by WP-Cache Manager
$wp_cache_pages[ "archives" ] = 0; //Added by WP-Cache Manager
$wp_cache_pages[ "pages" ] = 0; //Added by WP-Cache Manager
$wp_cache_pages[ "single" ] = 0; //Added by WP-Cache Manager
$wp_cache_pages[ "author" ] = 0; //Added by WP-Cache Manager
$wp_cache_hide_donation = 0;
$wp_cache_not_logged_in = 0;
$wp_cache_clear_on_post_edit = 1;
$wp_cache_hello_world = 0;
