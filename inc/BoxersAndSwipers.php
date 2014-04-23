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
	public $apply_home;
	public $apply_posts;
	public $apply_pages;

	/* ==================================================
	* @param	string	$link
	* @return	string	$link
	* @since	1.0
	*/
	function add_anchor_tag($link) {

		if ( (is_home() && $this->apply_home) || (is_single() && $this->apply_posts) || (is_page() && $this->apply_pages) || (is_archive() && $this->apply_archive) || (is_category() && $this->apply_category) ){

			$args = array(
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'numberposts' => -1,
				'post_status' => null,
				'post_parent' => $post->ID
				);
			$attachments = get_posts($args);

			if(preg_match_all("/\s+href\s*=\s*([\"\']?)([^\s\"\'>]+)(\\1)/ims", $link, $result) !== false){
		    	foreach ($result[0] as $value){
					$ext = end(explode('.', substr($value, 0, -1)));
					$ext2type = wp_ext2type($ext);
					if ( $ext2type === 'image' ) {
						if ( $this->effect === 'colorbox' ) {
							// colorbox
							$class_name = ' class="boxersandswipers"';
							$titlename = NULL;
							foreach ( $attachments as $attachment ) {
								if( strpos($value, $attachment->guid) ){
									$titlename = ' title="'.$attachment->post_title.'"';
								}
							}
							$link = str_replace($value, $class_name.$titlename.$value, $link);
						} else if ( $this->effect === 'slimbox' ) {
							//slimbox
							$rel_name = ' rel="boxersandswipers"';
							$titlename = NULL;
							foreach ( $attachments as $attachment ) {
								if( strpos($value, $attachment->guid) ){
									$titlename = ' title="'.$attachment->post_title.'"';
								}
							}
							$link = str_replace($value, $rel_name.$titlename.$value, $link);
						} else if ( $this->effect === 'nivolightbox' ) {
							//nivolightbox
							$rel_name = ' data-lightbox-gallery="boxersandswipers"';
							$titlename = NULL;
							foreach ( $attachments as $attachment ) {
								if( strpos($value, $attachment->guid) ){
									$titlename = ' title="'.$attachment->post_title.'"';
								}
							}
							$link = str_replace($value, $rel_name.$titlename.$value, $link);
						} else if ( $this->effect === 'imagelightbox' ) {
							//imagelightbox
							$rel_name = ' data-imagelightbox="boxersandswipers"';
							$titlename = NULL;
							foreach ( $attachments as $attachment ) {
								if( strpos($value, $attachment->guid) ){
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
							foreach ( $attachments as $attachment ) {
								if( strpos($value, $attachment->guid) ){
									$titlename = ' title="'.$attachment->post_title.'"';
								}
							}
							$link = str_replace($value, $rel_name.$class_name.$titlename.$value, $link);
						}
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
		add_filter( 'wp_get_attachment_link', array(&$this, 'add_anchor_tag_gallery') );	
	}

	/* ==================================================
	* @param	string	$link
	* @return	string	$link
	* @since	1.0
	*/
	function add_anchor_tag_gallery($link) {

		$args = array(
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'numberposts' => -1,
			'post_status' => null,
			'post_parent' => $post->ID
			);
		$attachments = get_posts($args);

		foreach ( $attachments as $attachment ) {
			if( strpos($link, $attachment->guid) ){
				$titlename = ' title="'.$attachment->post_title.'"';
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

		return $link;

	}

	/* ==================================================
	* @param	none
	* @since	1.5
	*/
	function add_header(){

		if ($this->effect === 'colorbox'){
			// for COLORBOX
			wp_enqueue_style( 'colorbox',  BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/colorbox/colorbox.css' );
			wp_enqueue_script( 'colorbox', BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/colorbox/jquery.colorbox-min.js', null, '1.4.37');
		} else if ($this->effect === 'slimbox'){
			// for slimbox
			wp_enqueue_style( 'slimbox',  BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/slimbox/css/slimbox2.css' );
			wp_enqueue_script( 'slimbox', BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/slimbox/js/slimbox2.js', null, '2.05');
		} else if ($this->effect === 'nivolightbox'){
			// for nivolightbox
			wp_enqueue_style( 'nivolightbox',  BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/nivolightbox/nivo-lightbox.css' );
			wp_enqueue_style( 'nivolightbox-themes',  BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/nivolightbox/themes/default/default.css' );
			wp_enqueue_script( 'nivolightbox', BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/nivolightbox/nivo-lightbox.min.js', null, '1.1');
		} else if ($this->effect === 'imagelightbox'){
			// for imagelightbox
			wp_enqueue_style( 'imagelightbox',  BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/imagelightbox/imagelightbox.css' );
			wp_enqueue_script( 'imagelightbox', BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/imagelightbox/imagelightbox.min.js');
		} else if ($this->effect === 'photoswipe'){
			// for PhotoSwipe
			wp_enqueue_style( 'photoswipe',  BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/photoswipe/photoswipe.css' );
			wp_enqueue_script( 'sji' , BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/photoswipe/lib/simple-inheritance.min.js', null );
			wp_enqueue_script( 'photoswipe' , BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/photoswipe/code-photoswipe-1.0.11.min.js', null, '1.0.11' );
		} else if ($this->effect === 'swipebox'){
			// for Swipebox
			wp_enqueue_style( 'swipebox',  BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/swipebox/source/swipebox.css' );
			wp_enqueue_script( 'swipebox' , BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/swipebox/source/jquery.swipebox.min.js', null, '1.2.1' );
		}

	}

	/* ==================================================
	* @param	none
	* @since	1.5
	*/
	function add_footer(){

		include_once BOXERSANDSWIPERS_PLUGIN_BASE_DIR.'/inc/BoxersAndSwipersAddJs.php';
		$boxersandswipersaddjs = new BoxersAndSwipersAddJs();
		$boxersandswipersaddjs->effect = $this->effect;
		add_action('wp_footer', array($boxersandswipersaddjs, 'add_js'));

	}

	/* ==================================================
	* @param	none
	* @return	string	$mode
	* @since	1.0
	*/
	function agent_check(){

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$boxersandswipers_useragent = get_option('boxersandswipers_useragent');

		if(preg_match("{".$boxersandswipers_useragent[tb]."}",$user_agent)){
			//Tablet
			$mode = "tb"; 
		}else if(preg_match("{".$boxersandswipers_useragent[sp]."}",$user_agent)){
			//Smartphone
			$mode = "sp";
		}else{
			$mode = "pc"; 
		}

		return $mode;

	}

	/* ==================================================
	* @param	Array	$atts
	* @return	Array	$atts
	* @since	1.5
	*/
	function file_gallery_shortcode( $atts ){

	    $atts['link'] = 'file';

	    return gallery_shortcode( $atts );

	}

}

?>