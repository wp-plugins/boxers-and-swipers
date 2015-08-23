<?php
/*
Plugin Name: Boxers and Swipers
Plugin URI: http://wordpress.org/plugins/boxers-and-swipers/
Version: 2.27
Description: Integrates Colorbox, Slimbox, Nivo Lightbox, Image Lightbox, Photoswipe and Swipebox into WordPress.
Author: Katsushi Kawamori
Author URI: http://riverforest-wp.info/
Text Domain: boxersandswipers
Domain Path: /languages
*/

/*  Copyright (c) 2014- Katsushi Kawamori (email : dodesyoswift312@gmail.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; version 2 of the License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

	load_plugin_textdomain('boxersandswipers', false, basename( dirname( __FILE__ ) ) . '/languages' );

	define("BOXERSANDSWIPERS_PLUGIN_BASE_FILE", plugin_basename(__FILE__));
	define("BOXERSANDSWIPERS_PLUGIN_BASE_DIR", dirname(__FILE__));
	define("BOXERSANDSWIPERS_PLUGIN_URL", plugins_url($path='boxers-and-swipers',$scheme=null));

	require_once( BOXERSANDSWIPERS_PLUGIN_BASE_DIR . '/req/BoxersAndSwipersRegist.php' );
	$boxersandswipersregistandheader = new BoxersAndSwipersRegist();
	add_action('admin_init', array($boxersandswipersregistandheader, 'register_settings'));
	unset($boxersandswipersregistandheader);

	require_once( BOXERSANDSWIPERS_PLUGIN_BASE_DIR . '/req/BoxersAndSwipersAdmin.php' );
	$boxersandswipersadmin = new BoxersAndSwipersAdmin();
	add_action( 'admin_menu', array($boxersandswipersadmin, 'plugin_menu'));
	add_action( 'admin_menu', array($boxersandswipersadmin, 'add_exclude_boxersandswipers_custom_box'));
	add_action( 'save_post', array($boxersandswipersadmin, 'save_exclude_boxersandswipers_postdata'));
	add_filter( 'plugin_action_links', array($boxersandswipersadmin, 'settings_link'), 10, 2 );
	add_filter('manage_posts_columns', array($boxersandswipersadmin, 'posts_columns_boxersandswipers'));
	add_action('manage_posts_custom_column', array($boxersandswipersadmin, 'posts_custom_columns_boxersandswipers'), 10, 2);
	add_filter('manage_pages_columns', array($boxersandswipersadmin, 'pages_columns_boxersandswipers'));
	add_action('manage_pages_custom_column', array($boxersandswipersadmin, 'pages_custom_columns_boxersandswipers'), 10, 2);
	add_action( 'admin_enqueue_scripts', array($boxersandswipersadmin, 'load_custom_wp_admin_style') );
	add_action( 'admin_footer', array($boxersandswipersadmin, 'load_custom_wp_admin_style2') );
	unset($boxersandswipersadmin);

	include_once( BOXERSANDSWIPERS_PLUGIN_BASE_DIR.'/inc/BoxersAndSwipers.php' );
	$boxersandswipers = new BoxersAndSwipers();
	$device = $boxersandswipers->agent_check();

	$boxersandswipers_effect = get_option('boxersandswipers_effect');
	$boxersandswipers_apply = get_option('boxersandswipers_apply');

	$boxersandswipers->effect = $boxersandswipers_effect[$device];
	$boxersandswipers_attachment_args = array(
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'numberposts' => -1
		);
	$boxersandswipers->attachments = get_posts($boxersandswipers_attachment_args);

	add_action( 'wp_enqueue_scripts', array($boxersandswipers, 'add_header'));

	add_filter( 'the_content', array($boxersandswipers, 'add_anchor_tag'));

	// for MediaLibrary Feeder http://wordpress.org/plugins/medialibrary-feeder/
	add_filter( 'post_medialibraryfeed', array($boxersandswipers, 'gallery_filter') );
	// for GalleryLink http://wordpress.org/plugins/gallerylink/
	add_filter( 'post_gallerylink', array($boxersandswipers, 'add_anchor_tag') );
	// for MediaLink http://wordpress.org/plugins/medialink/
	add_filter( 'post_medialink', array($boxersandswipers, 'add_anchor_tag') );

	$boxersandswipers->add_footer();

	unset($boxersandswipers);

?>