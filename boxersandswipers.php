<?php
/*
Plugin Name: Boxers and Swipers
Plugin URI: http://wordpress.org/plugins/boxers-and-swipers/
Version: 1.2
Description: Integrates Colorbox and Slimbox and Photoswipe and Swipebox into WordPress.
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
	$effect = $boxersandswipers_effect[$mode];

	$boxersandswipers->effect = $effect;
	add_filter( 'the_content', array($boxersandswipers, 'add_anchor_tag') );
	add_filter( 'post_gallery', array($boxersandswipers, 'gallery_filter') );
	add_filter( 'the_content', array($boxersandswipers, 'add_div_tag') );
	unset($boxersandswipers);

	$pluginurl = plugins_url($path='',$scheme=null);
	if ($effect === 'colorbox'){
		// for COLORBOX
		wp_enqueue_style( 'colorbox',  $pluginurl.'/boxers-and-swipers/colorbox/colorbox.css' );
		wp_enqueue_script( 'colorbox', $pluginurl.'/boxers-and-swipers/colorbox/jquery.colorbox-min.js', null, '1.4.37');
	} else if ($effect === 'slimbox'){
		// for slimbox
		wp_enqueue_style( 'slimbox',  $pluginurl.'/boxers-and-swipers/slimbox/css/slimbox2.css' );
		wp_enqueue_script( 'slimbox', $pluginurl.'/boxers-and-swipers/slimbox/js/slimbox2.js', null, '2.05');
	} else if ($effect === 'photoswipe'){
		// for PhotoSwipe
		wp_enqueue_style( 'photoswipe',  $pluginurl.'/boxers-and-swipers/photoswipe/photoswipe.css' );
		wp_enqueue_script( 'sji' , $pluginurl.'/boxers-and-swipers/photoswipe/lib/simple-inheritance.min.js', null );
		wp_enqueue_script( 'photoswipe' , $pluginurl.'/boxers-and-swipers/photoswipe/code-photoswipe-1.0.11.min.js', null, '1.0.11' );
	} else if ($effect === 'swipebox'){
		// for Swipebox
		wp_enqueue_style( 'swipebox',  $pluginurl.'/boxers-and-swipers/swipebox/source/swipebox.css' );
		wp_enqueue_script( 'swipebox' , $pluginurl.'/boxers-and-swipers/swipebox/source/jquery.swipebox.min.js', null, '1.2.1' );
	}

	include_once dirname(__FILE__).'/inc/BoxersAndSwipersAddJs.php';
	$boxersandswipersaddjs = new BoxersAndSwipersAddJs();
	$boxersandswipersaddjs->effect = $effect;
	add_action('wp_footer', array($boxersandswipersaddjs, 'add_js'));

?>