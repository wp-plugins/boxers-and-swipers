<?php
/**
 * Boxers and Swipers
 * 
 * @package    Boxers and Swipers
 * @subpackage BoxersAndSwipers Main Functions
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

class BoxersAndSwipers {

	public $effect;
	public $attachments;
	public $foot_count;

	/* ==================================================
	* @param	string	$link
	* @return	string	$link
	* @since	1.0
	*/
	function add_anchor_tag($link) {

		$device = $this->agent_check();
		$boxersandswipers_apply = get_option('boxersandswipers_apply');
		if ( !is_attachment() ) {
			$is_singular_boxersandswipers_apply = $boxersandswipers_apply[get_post_type(get_the_ID())][$device];
		}
		$is_home_boxersandswipers_apply = $boxersandswipers_apply['home'][$device];
		$is_archive_boxersandswipers_apply = $boxersandswipers_apply['archive'][$device];
		$is_category_boxersandswipers_apply = $boxersandswipers_apply['category'][$device];
		$is_gallery_boxersandswipers_apply = $boxersandswipers_apply['gallery'][$device];
		settype($is_singular_boxersandswipers_apply, "boolean");
		settype($is_home_boxersandswipers_apply, "boolean");
		settype($is_archive_boxersandswipers_apply, "boolean");
		settype($is_category_boxersandswipers_apply, "boolean");
		settype($is_gallery_boxersandswipers_apply, "boolean");

		$boxersandswipers_exclude = get_post_meta( get_the_ID(), 'boxersandswipers_exclude' );
		$simplemasonry_apply = get_post_meta( get_the_ID(), 'simplemasonry_apply' );
		$simplenivoslider_apply = get_post_meta( get_the_ID(), 'simplenivoslider_apply' );

		if ( !empty($boxersandswipers_exclude) && $boxersandswipers_exclude[0] ) {
			// Through
		} else if ( class_exists('SimpleMasonry') && get_post_gallery(get_the_ID()) && !empty($simplemasonry_apply) && $simplemasonry_apply[0] === 'true' ) {
			// for Simple Masonry Gallery http://wordpress.org/plugins/simple-masonry-gallery/
			// for Gallery
			if ( $is_gallery_boxersandswipers_apply ) {
				add_filter( 'post_gallery', array(&$this, 'gallery_filter') );
			}
			$link = $this->add_anchor_tag_content($link);
		} else if ( class_exists('SimpleNivoSlider') && !empty($simplenivoslider_apply) && $simplenivoslider_apply[0] === 'true' ) {
			// for Simple Nivo Slider http://wordpress.org/plugins/simple-nivoslider/
			// Through
		} else {
			if ( !is_attachment() ) {
				// for Gallery
				if ( $is_gallery_boxersandswipers_apply ) {
					add_shortcode( 'gallery', array(&$this, 'file_gallery_shortcode') );
					add_filter( 'post_gallery', array(&$this, 'gallery_filter') );
				}
				// for Insert Attachement
				if ( (is_singular() && $is_singular_boxersandswipers_apply) || (is_home() && $is_home_boxersandswipers_apply) || (is_archive() && $is_archive_boxersandswipers_apply) || (is_category() && $is_category_boxersandswipers_apply) ){
					$link = $this->add_anchor_tag_content($link);
				}
			}
		}

		return $link;

	}

	/* ==================================================
	* @param	string	$link
	* @return	$link
	* @since	1.0
	*/
	function add_anchor_tag_content($link) {

		if(preg_match_all("/\s+href\s*=\s*([\"\']?)([^\s\"\'>]+)(\\1)/ims", $link, $result) !== false){
	    	foreach ($result[0] as $value){
				$exts = explode('.', substr($value, 0, -1));
				$ext = end($exts);
				$ext2type = wp_ext2type($ext);
				if ( $ext2type === 'image' ) {
					if ( $this->effect === 'colorbox' ) {
						// colorbox
						$class_name = ' class="boxersandswipers"';
						$titlename = NULL;
						foreach ( $this->attachments as $attachment ) {
							if( strpos($value, get_post_meta( $attachment->ID, '_wp_attached_file', true )) ){
								$titlename = ' title="'.$attachment->post_title.'"';
							}
						}
						$link = str_replace($value, $class_name.$titlename.$value, $link);
					} else if ( $this->effect === 'slimbox' ) {
						//slimbox
						$rel_name = ' rel="boxersandswipers"';
						$titlename = NULL;
						foreach ( $this->attachments as $attachment ) {
							if( strpos($value, get_post_meta( $attachment->ID, '_wp_attached_file', true )) ){
								$titlename = ' title="'.$attachment->post_title.'"';
							}
						}
						$link = str_replace($value, $rel_name.$titlename.$value, $link);
					} else if ( $this->effect === 'nivolightbox' ) {
						//nivolightbox
						$rel_name = ' data-lightbox-gallery="boxersandswipers"';
						$titlename = NULL;
						foreach ( $this->attachments as $attachment ) {
							if( strpos($value, get_post_meta( $attachment->ID, '_wp_attached_file', true )) ){
								$titlename = ' title="'.$attachment->post_title.'"';
							}
						}
						$link = str_replace($value, $rel_name.$titlename.$value, $link);
					} else if ( $this->effect === 'imagelightbox' ) {
						//imagelightbox
						$rel_name = ' data-imagelightbox="boxersandswipers"';
						$titlename = NULL;
						foreach ( $this->attachments as $attachment ) {
							if( strpos($value, get_post_meta( $attachment->ID, '_wp_attached_file', true )) ){
								$titlename = ' title="'.$attachment->post_title.'"';
							}
						}
						$link = str_replace($value, $rel_name.$titlename.$value, $link);
					} else if ( $this->effect === 'photoswipe' ) {
						//photoswipe
						$class_name = ' class="boxersandswipers"';
						$link = str_replace($value, $class_name.$value, $link);
					} else if ( $this->effect === 'swipebox' ) {
						//swipebox
						$rel_name = ' rel="boxers-and-swipers"';
						$class_name = ' class="boxersandswipers"';
						$titlename = NULL;
						foreach ( $this->attachments as $attachment ) {
							if( strpos($value, get_post_meta( $attachment->ID, '_wp_attached_file', true )) ){
								$titlename = ' title="'.$attachment->post_title.'"';
							}
						}
						$link = str_replace($value, $rel_name.$class_name.$titlename.$value, $link);
					}
				}
	    	}
		}
		if(preg_match_all("/<img(.+?)>/i", $link, $result) !== false){
	    	foreach ($result[1] as $value){
				preg_match('/src=\"(.[^\"]*)\"/',$value,$src);
				if ( isset($src[1]) ) {
				$explode = explode("/" , $src[1]);
				$file_name = $explode[count($explode) - 1];
				$alt_name = preg_replace("/(.+)(\.[^.]+$)/", "$1", $file_name);
					if( !strpos($value, 'alt=') ) {
						$alt_name = ' alt="'.$alt_name.'" ';
						$link = str_replace($value, $alt_name.$value, $link);
					}
				}
			}
		}

		return $link;

	}

	/* ==================================================
	* @param	string	$link
	* @return	none
	* @since	1.0
	*/
	function gallery_filter($link) {
		add_filter( 'wp_get_attachment_link', array(&$this, 'add_anchor_tag_gallery'), 10, 6 );	
	}

	/* ==================================================
	* @param	string	$link
	* @return	string	$link
	* @since	1.0
	*/
	function add_anchor_tag_gallery($link, $id, $size, $permalink, $icon, $text) {

		if(preg_match_all("/\s+href\s*=\s*([\"\']?)([^\s\"\'>]+)(\\1)/ims", $link, $result) !== false){
	    	foreach ($result[0] as $value){
				$exts = explode('.', substr($value, 0, -1));
				$ext = end($exts);
				$ext2type = wp_ext2type($ext);
				if ( $ext2type === 'image' ) {
					$titlename = ' title="'.get_the_title($id).'"';
					if ( $this->effect === 'colorbox' ) {
						// colorbox
						$class_name = 'class="boxersandswipers"';
					    $link = str_replace( '<a', '<a '.$class_name.$titlename, $link );
					} else if ( $this->effect === 'slimbox' ) {
						//slimbox
						$rel_name = 'rel="boxersandswipers"';
					    $link = str_replace( '<a', '<a '.$rel_name.$titlename, $link );
					} else if ( $this->effect === 'nivolightbox' ) {
						//nivolightbox
						$rel_name = 'data-lightbox-gallery="boxersandswipers"';
					    $link = str_replace( '<a', '<a '.$rel_name.$titlename, $link );
					} else if ( $this->effect === 'imagelightbox' ) {
						//imagelightbox
						$rel_name = 'data-imagelightbox="boxersandswipers"';
					    $link = str_replace( '<a', '<a '.$rel_name.$titlename, $link );
					} else if ( $this->effect === 'photoswipe' ) {
						//photoswipe
						$class_name = 'class="boxersandswipers" ';
					    $link = str_replace( '<a', '<a '.$class_name, $link );
					} else if ( $this->effect === 'swipebox' ) {
						//swipebox
						$rel_name = 'rel="boxers-and-swipers"';
						$class_name = ' class="boxersandswipers"';
					    $link = str_replace( '<a', '<a '.$rel_name.$class_name.$titlename, $link );
					}
				}
			}
		}

		return $link;

	}

	/* ==================================================
	* @param	none
	* @since	1.5
	*/
	function add_footer($contents){

		if (strstr($contents, '="boxersandswipers"') && $this->foot_count == 0) {

			++$this->foot_count;

			include_once BOXERSANDSWIPERS_PLUGIN_BASE_DIR.'/inc/BoxersAndSwipersAddJs.php';
			$boxersandswipersaddjs = new BoxersAndSwipersAddJs();
			$boxersandswipersaddjs->effect = $this->effect;
			add_action('wp_footer', array($boxersandswipersaddjs, 'add_js'));

			if ($this->effect === 'colorbox'){
				// for COLORBOX
				wp_enqueue_style( 'colorbox',  BOXERSANDSWIPERS_PLUGIN_URL.'/colorbox/colorbox.css' );
				wp_enqueue_script('jquery');
				wp_enqueue_script( 'colorbox', BOXERSANDSWIPERS_PLUGIN_URL.'/colorbox/jquery.colorbox-min.js', null, '1.4.37');
			} else if ($this->effect === 'slimbox'){
				// for slimbox
				wp_enqueue_style( 'slimbox',  BOXERSANDSWIPERS_PLUGIN_URL.'/slimbox/css/slimbox2.css' );
				wp_enqueue_script('jquery');
				wp_enqueue_script( 'slimbox', BOXERSANDSWIPERS_PLUGIN_URL.'/slimbox/js/slimbox2.js', null, '2.05');
			} else if ($this->effect === 'nivolightbox'){
				// for nivolightbox
				wp_enqueue_style( 'nivolightbox',  BOXERSANDSWIPERS_PLUGIN_URL.'/nivolightbox/nivo-lightbox.css' );
				wp_enqueue_style( 'nivolightbox-themes',  BOXERSANDSWIPERS_PLUGIN_URL.'/nivolightbox/themes/default/default.css' );
				wp_enqueue_script('jquery');
				wp_enqueue_script( 'nivolightbox', BOXERSANDSWIPERS_PLUGIN_URL.'/nivolightbox/nivo-lightbox.min.js', null, '1.2.0');
			} else if ($this->effect === 'imagelightbox'){
				// for imagelightbox
				wp_enqueue_style( 'imagelightbox',  BOXERSANDSWIPERS_PLUGIN_URL.'/imagelightbox/imagelightbox.css' );
				wp_enqueue_script('jquery');
				wp_enqueue_script( 'imagelightbox', BOXERSANDSWIPERS_PLUGIN_URL.'/imagelightbox/imagelightbox.min.js');
			} else if ($this->effect === 'photoswipe'){
				// for PhotoSwipe
				wp_enqueue_style( 'photoswipe',  BOXERSANDSWIPERS_PLUGIN_URL.'/photoswipe/photoswipe.css' );
				wp_enqueue_script('jquery');
				wp_enqueue_script( 'klass' , BOXERSANDSWIPERS_PLUGIN_URL.'/photoswipe/klass.min.js', null );
				wp_enqueue_script( 'photoswipe' , BOXERSANDSWIPERS_PLUGIN_URL.'/photoswipe/code.photoswipe.jquery-3.0.5.min.js', null, '3.0.5' );
			} else if ($this->effect === 'swipebox'){
				// for Swipebox
				wp_enqueue_style( 'swipebox',  BOXERSANDSWIPERS_PLUGIN_URL.'/swipebox/css/swipebox.min.css' );
				wp_enqueue_script('jquery');
				wp_enqueue_script( 'swipebox' , BOXERSANDSWIPERS_PLUGIN_URL.'/swipebox/js/jquery.swipebox.min.js', null, '1.3.0.1' );
			}
		}

		return $contents;

	}

	/* ==================================================
	* @param	none
	* @return	string	$device
	* @since	1.0
	*/
	function agent_check(){

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$boxersandswipers_useragent = get_option('boxersandswipers_useragent');

		if(preg_match("{".$boxersandswipers_useragent['tb']."}",$user_agent)){
			//Tablet
			$device = "tb"; 
		}else if(preg_match("{".$boxersandswipers_useragent['sp']."}",$user_agent)){
			//Smartphone
			$device = "sp";
		}else{
			$device = "pc"; 
		}

		return $device;

	}

	/* ==================================================
	* @param	Array	$atts
	* @return	Array	$atts
	* @since	1.5
	*/
	function file_gallery_shortcode( $atts ){

		if ( empty($atts['link']) ) {
		    $atts['link'] = 'file';
		} else if ( $atts['link'] === 'none' ) {
		    $atts['link'] = 'none';
		} else {
		    $atts['link'] = 'file';
		}

	    return gallery_shortcode( $atts );

	}

}

?>