<?php
/**
 * Boxers and Swipers
 * 
 * @package    Boxers and Swipers
 * @subpackage BoxersAndSwipersRegist registered in the database
    Copyright (c) 2014- Katsushi Kawamori (email : dodesyoswift312@gmail.com)
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

class BoxersAndSwipersRegist {

	/* ==================================================
	 * Settings register
	 * @since	1.0
	 */
	function register_settings(){

		if ( !get_option('boxersandswipers_apply') ) {
			$posttypes = BoxersAndSwipersAdmin::search_posttype();
			$apply_tbl = array();
			foreach ( $posttypes as $key => $value ) {
				$apply_tbl[$key]['pc'] = 'true';
				$apply_tbl[$key]['tb'] = 'true';
				$apply_tbl[$key]['sp'] = 'true';
				unset($posttypes[$key]);
			}
			update_option( 'boxersandswipers_apply', $apply_tbl );
		}

		if ( !get_option('boxersandswipers_effect') ) {
			$effect_tbl = array(
							'pc' => 'colorbox',
							'tb' => 'nivolightbox',
							'sp' => 'photoswipe'
							);
			update_option( 'boxersandswipers_effect', $effect_tbl );
		}

		if ( !get_option('boxersandswipers_useragent') ) {
			$useragent_tbl = array(
								'tb' => 'iPad|^.*Android.*Nexus(((?:(?!Mobile))|(?:(\s(7|10).+))).)*$|Kindle|Silk.*Accelerated|Sony.*Tablet|Xperia Tablet|Sony Tablet S|SAMSUNG.*Tablet|Galaxy.*Tab|SC-01C|SC-01D|SC-01E|SC-02D',
								'sp' => 'iPhone|iPod|Android.*Mobile|BlackBerry|IEMobile'
							);
			update_option( 'boxersandswipers_useragent', $useragent_tbl );
		}

		if ( !get_option('boxersandswipers_colorbox') ) {
			$colorbox_tbl = array(
								'rel' => 'boxersandswipers',
								'transition' => 'elastic',
								'speed' => 350,
								'title' => 'false',
								'scalePhotos' => 'true',
								'scrolling' => 'true',
								'opacity' => 0.85,
								'open' => 'false',
								'returnFocus' => 'true',
								'trapFocus' => 'true',
								'fastIframe' => 'true',
								'preloading' => 'true',
								'overlayClose' => 'true',
								'escKey' => 'true',
								'arrowKey' => 'true',
								'loop' => 'true',
								'fadeOut' => 300,
								'closeButton' => 'true',
								'current' => 'image {current} of {total}',
								'previous' => 'previous',
								'next' => 'next',
								'close' => 'close',
								'width' => 'false',
								'height' => 'false',
								'innerWidth' => 'false',
								'innerHeight' => 'false',
								'initialWidth' => 300,
								'initialHeight' => 100,
								'maxWidth' => 'false',
								'maxHeight' => 'false',
								'slideshow' => 'true',
								'slideshowSpeed' => 2500,
								'slideshowAuto' => 'false',
								'slideshowStart' => 'start slideshow',
								'slideshowStop' => 'stop slideshow',
								'fixed' => 'false',
								'top' => 'false',
								'bottom' => 'false',
								'left' => 'false',
								'right' => 'false',
								'reposition' => 'true',
								'retinaImage' => 'false'
							);
			update_option( 'boxersandswipers_colorbox', $colorbox_tbl );
		}

		if ( !get_option('boxersandswipers_slimbox') ) {
			$slimbox_tbl = array(
								'loop' => 'false',
								'overlayOpacity' => 0.8,
								'overlayFadeDuration' => 400,
								'resizeDuration' => 400,
								'resizeEasing' => 'swing',
								'initialWidth' => 250,
								'initialHeight' => 250,
								'imageFadeDuration' => 400,
								'captionAnimationDuration' => 400,
								'counterText' => 'Image {x} of {y}',
								'closeKeys' => '[27, 88, 67]',
								'previousKeys' => '[37, 80]',
								'nextKeys' => '[39, 78]'
							);
			update_option( 'boxersandswipers_slimbox', $slimbox_tbl );
		}

		if ( !get_option('boxersandswipers_nivolightbox') ) {
			$nivolightbox_tbl = array(
								'effect' => 'fade',
								'keyboardNav' => 'true',
								'clickOverlayToClose' => 'true'
							);
			update_option( 'boxersandswipers_nivolightbox', $nivolightbox_tbl );
		}

		if ( !get_option('boxersandswipers_imagelightbox') ) {
			$imagelightbox_tbl = array(
								'animationSpeed' => 250,
								'preloadNext' => 'true',
								'enableKeyboard' => 'true',
								'quitOnEnd' => 'false',
								'quitOnImgClick' => 'false',
								'quitOnDocClick' => 'true'
							);
			update_option( 'boxersandswipers_imagelightbox', $imagelightbox_tbl );
		}

		if ( !get_option('boxersandswipers_photoswipe') ) {
			$photoswipe_tbl = array(
								'fadeInSpeed' => 250,
								'fadeOutSpeed' => 500,
								'slideSpeed' => 250,
								'swipeThreshold' => 50,
								'swipeTimeThreshold' => 250,
								'loop' => 'true',
								'slideshowDelay' => 3000,
								'imageScaleMethod' => 'fit',
								'preventHide' => 'false',
								'backButtonHideEnabled' => 'true',
								'captionAndToolbarHide' => 'false',
								'captionAndToolbarHideOnSwipe' => 'true',
								'captionAndToolbarFlipPosition' => 'false',
								'captionAndToolbarAutoHideDelay' => 5000,
								'captionAndToolbarOpacity' => 0.8,
								'captionAndToolbarShowEmptyCaptions' => 'false'
							);
			update_option( 'boxersandswipers_photoswipe', $photoswipe_tbl );
		}

		if ( !get_option('boxersandswipers_swipebox') ) {
			$swipebox_tbl = array(
								'hideBarsDelay' => 3000
							);
			update_option( 'boxersandswipers_swipebox', $swipebox_tbl );
		}

	}

}

?>