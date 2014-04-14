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

	/* ==================================================
	* @param	string	$link
	* @return	string	$link
	* @since	1.0
	*/
	function add_anchor_tag($link) {

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
						$class_name = ' class="gallery"';
						$titlename = NULL;
						foreach ( $attachments as $attachment ) {
							if( strpos($value, $attachment->guid) ){
								$titlename = ' title="'.$attachment->post_title.'"';
							}
						}
						$link = str_replace($value, $class_name.$titlename.$value, $link);
					} else if ( $this->effect === 'slimbox' ) {
						//slimbox
						$rel_name = ' rel="lightbox"';
						$titlename = NULL;
						foreach ( $attachments as $attachment ) {
							if( strpos($value, $attachment->guid) ){
								$titlename = ' title="'.$attachment->post_title.'"';
							}
						}
						$link = str_replace($value, $rel_name.$titlename.$value, $link);
					} else if ( $this->effect === 'photoswipe' ) {
						//photoswipe
						$rel_name = ' rel="external"';
						$link = str_replace($value, $rel_name.$value, $link);
					} else if ( $this->effect === 'swipebox' ) {
						//swipebox
						$rel_name = ' rel="'.get_the_ID().'"';
						$class_name = ' class="swipebox"';
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
					$class_name = 'class="gallery"';
				    $link = str_replace( '<a', '<a '.$class_name.$titlename, $link );
				} else if ( $this->effect === 'slimbox' ) {
					//slimbox
					$rel_name = 'rel="lightbox"';
				    $link = str_replace( '<a', '<a '.$rel_name.$titlename, $link );
				} else if ( $this->effect === 'photoswipe' ) {
					//photoswipe
					$rel_name = 'rel="external "';
				    $link = str_replace( '<a', '<a '.$rel_name, $link );
				} else if ( $this->effect === 'swipebox' ) {
					//swipebox
					$rel_name = 'rel="'.get_the_ID().'"';
					$class_name = ' class="swipebox"';
				    $link = str_replace( '<a', '<a '.$rel_name.$class_name.$titlename, $link );
				}
			}
		}

		return $link;

	}

	/* ==================================================
	* @param	string	$link
	* @return	string	$link
	* @since	1.0
	*/
	function add_div_tag($link) {

		if ( $this->effect === 'photoswipe' ) {
			$link = '<div id="PhotoswipeGallery">'.$link.'</div>';
		}

		return $link;

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

}

?>