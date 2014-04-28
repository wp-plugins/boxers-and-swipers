<?php
/*
Plugin Name: Boxers and Swipers
Plugin URI: http://wordpress.org/plugins/boxers-and-swipers/
Version: 1.10
Description: Integrates Colorbox and Slimbox and Nivo Lightbox and ImageLightbox and Photoswipe and Swipebox into WordPress.
Author: Katsushi Kawamori
Author URI: http://gallerylink.nyanko.org/medialink/boxers-and-swipers/
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
	define("BOXERSANDSWIPERS_PLUGIN_URL", plugins_url($path='',$scheme=null));

	require_once( dirname( __FILE__ ) . '/req/BoxersAndSwipersRegist.php' );
	$boxersandswipersregistandheader = new BoxersAndSwipersRegist();
	add_action('admin_init', array($boxersandswipersregistandheader, 'register_settings'));
	unset($boxersandswipersregistandheader);

	add_action( 'wp_head', wp_enqueue_script('jquery') );

	require_once( dirname( __FILE__ ) . '/req/BoxersAndSwipersAdmin.php' );
	$boxersandswipersadmin = new BoxersAndSwipersAdmin();
	add_action( 'admin_menu', array($boxersandswipersadmin, 'plugin_menu'));
	add_filter( 'plugin_action_links', array($boxersandswipersadmin, 'settings_link'), 10, 2 );
	unset($boxersandswipersadmin);

	include_once( BOXERSANDSWIPERS_PLUGIN_BASE_DIR.'/inc/BoxersAndSwipers.php' );
	$boxersandswipers = new BoxersAndSwipers();
	$mode = $boxersandswipers->agent_check();

	$boxersandswipers_effect = get_option('boxersandswipers_effect');
	$boxersandswipers_apply_home = get_option('boxersandswipers_apply_home');
	$boxersandswipers_apply_posts = get_option('boxersandswipers_apply_posts');
	$boxersandswipers_apply_pages = get_option('boxersandswipers_apply_pages');
	$boxersandswipers_apply_gallery = get_option('boxersandswipers_apply_gallery');
	$boxersandswipers_apply_archive = get_option('boxersandswipers_apply_archive');
	$boxersandswipers_apply_category = get_option('boxersandswipers_apply_category');

	$effect = $boxersandswipers_effect[$mode];
	$apply_home = $boxersandswipers_apply_home[$mode];
	$apply_posts = $boxersandswipers_apply_posts[$mode];
	$apply_pages = $boxersandswipers_apply_pages[$mode];
	$apply_gallery = $boxersandswipers_apply_gallery[$mode];
	$apply_archive = $boxersandswipers_apply_archive[$mode];
	$apply_category = $boxersandswipers_apply_category[$mode];

	$boxersandswipers->effect = $effect;
	$boxersandswipers->apply_home = $apply_home;
	$boxersandswipers->apply_posts = $apply_posts;
	$boxersandswipers->apply_pages = $apply_pages;
	$boxersandswipers->apply_archive = $apply_archive;
	$boxersandswipers->apply_category = $apply_category;

	if ( $apply_home || $apply_posts || $apply_pages || $apply_archive || $apply_category ) {
		add_filter( 'the_content', array($boxersandswipers, 'add_anchor_tag') );
	}
	if ( $apply_gallery ) {
		add_shortcode( 'gallery', array($boxersandswipers, 'file_gallery_shortcode') );
		add_filter( 'post_gallery', array($boxersandswipers, 'gallery_filter') );
	}

	$boxersandswipers->add_header();
	$boxersandswipers->add_footer();

	unset($boxersandswipers);

?>