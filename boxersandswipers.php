<?php
/*
Plugin Name: Boxers and Swipers
Plugin URI: http://wordpress.org/plugins/boxers-and-swipers/
Version: 1.23
Description: Integrates Colorbox, Slimbox, Nivo Lightbox, Image Lightbox, Photoswipe and Swipebox into WordPress.
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

	require_once( dirname( __FILE__ ) . '/req/BoxersAndSwipersAdmin.php' );
	$boxersandswipersadmin = new BoxersAndSwipersAdmin();
	add_action( 'admin_menu', array($boxersandswipersadmin, 'plugin_menu'));
	add_filter( 'plugin_action_links', array($boxersandswipersadmin, 'settings_link'), 10, 2 );
	add_action( 'admin_footer', array($boxersandswipersadmin, 'load_custom_wp_admin_style2') );
	unset($boxersandswipersadmin);

	include_once( BOXERSANDSWIPERS_PLUGIN_BASE_DIR.'/inc/BoxersAndSwipers.php' );
	$boxersandswipers = new BoxersAndSwipers();
	$device = $boxersandswipers->agent_check();

	$boxersandswipers_effect = get_option('boxersandswipers_effect');
	$boxersandswipers_apply = get_option('boxersandswipers_apply');

	$effect = $boxersandswipers_effect[$device];
	$boxersandswipers->effect = $effect;

	add_filter( 'the_content', array($boxersandswipers, 'add_anchor_tag') );

	// for MediaLibrary Feeder http://wordpress.org/plugins/medialibrary-feeder/
	add_filter( 'post_medialibraryfeed', array($boxersandswipers, 'gallery_filter') );
	// for GalleryLink http://wordpress.org/plugins/gallerylink/
	add_filter( 'post_gallerylink', array($boxersandswipers, 'add_anchor_tag') );
	// for MediaLink http://wordpress.org/plugins/medialink/
	add_filter( 'post_medialink', array($boxersandswipers, 'add_anchor_tag') );

	add_action( 'wp_head', array($boxersandswipers, 'add_header'));
	$boxersandswipers->add_footer();

	unset($boxersandswipers);

?>