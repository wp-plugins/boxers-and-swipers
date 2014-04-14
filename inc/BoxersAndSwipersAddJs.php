<?php
/**
 * Boxers and Swipers
 * 
 * @package    Boxers and Swipers
 * @subpackage BoxersAndSwipersAddJs Add Javascript
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

class BoxersAndSwipersAddJs {

	public $effect;

	/* ==================================================
	 * Add js
	 * @since	1.0
	 */
	function add_js(){

		if ( $this->effect === 'colorbox' ) {
			$colorbox_tbl = get_option('boxersandswipers_colorbox');
// JS
$boxersandswipers_add_js = <<<BOXERSANDSWIPERS1

<!-- BEGIN: Boxers and Swipers -->
<script type="text/javascript">
jQuery(function(){
	jQuery("a.gallery").colorbox({

BOXERSANDSWIPERS1;

			foreach( $colorbox_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$boxersandswipers_add_js .= str_repeat(' ', 8).$key.': "'.$value.'",'."\n";
				} else {
					$boxersandswipers_add_js .= str_repeat(' ', 8).$key.': '.$value.','."\n";
				}
			}
			$boxersandswipers_add_js = rtrim($boxersandswipers_add_js);
			$boxersandswipers_add_js = rtrim($boxersandswipers_add_js, ",");

$boxersandswipers_add_js .= <<<BOXERSANDSWIPERS2

	});
});
</script>
<!-- END: Boxers and Swipers -->

BOXERSANDSWIPERS2;
		} else if ( $this->effect === 'slimbox' ) {
			$slimbox_tbl = get_option('boxersandswipers_slimbox');
// JS
$boxersandswipers_add_js = <<<BOXERSANDSWIPERS1

<!-- BEGIN: Boxers and Swipers -->
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('a[rel*=lightbox]').slimbox({

BOXERSANDSWIPERS1;

			foreach( $slimbox_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$boxersandswipers_add_js .= str_repeat(' ', 8).$key.': "'.$value.'",'."\n";
				} else {
					$boxersandswipers_add_js .= str_repeat(' ', 8).$key.': '.$value.','."\n";
				}
			}
			$boxersandswipers_add_js = rtrim($boxersandswipers_add_js);
			$boxersandswipers_add_js = rtrim($boxersandswipers_add_js, ",");

$boxersandswipers_add_js .= <<<BOXERSANDSWIPERS2

	});
});
</script>
<!-- END: Boxers and Swipers -->

BOXERSANDSWIPERS2;
		} else if ( $this->effect === 'photoswipe' ) {
			$photoswipe_tbl = get_option('boxersandswipers_photoswipe');
// JS
$boxersandswipers_add_js = <<<BOXERSANDSWIPERS1

<!-- BEGIN: Boxers and Swipers -->
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function(){
		Code.photoSwipe('a', '#PhotoswipeGallery');
		Code.PhotoSwipe.Current.setOptions({

BOXERSANDSWIPERS1;

			foreach( $photoswipe_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$boxersandswipers_add_js .= str_repeat(' ', 8).$key.': "'.$value.'",'."\n";
				} else {
					$boxersandswipers_add_js .= str_repeat(' ', 8).$key.': '.$value.','."\n";
				}
			}
			$boxersandswipers_add_js = rtrim($boxersandswipers_add_js);
			$boxersandswipers_add_js = rtrim($boxersandswipers_add_js, ",");

$boxersandswipers_add_js .= <<<BOXERSANDSWIPERS2

		});
	}, false);
</script>
<!-- END: Boxers and Swipers -->

BOXERSANDSWIPERS2;
		} else if ( $this->effect === 'swipebox' ) {
			$swipebox_tbl = get_option('boxersandswipers_swipebox');
// JS
$boxersandswipers_add_js = <<<BOXERSANDSWIPERS1

<!-- BEGIN: Boxers and Swipers -->
<script type="text/javascript">
jQuery(function() {
	jQuery(".swipebox").swipebox({

BOXERSANDSWIPERS1;

			foreach( $swipebox_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$boxersandswipers_add_js .= str_repeat(' ', 8).$key.': "'.$value.'",'."\n";
				} else {
					$boxersandswipers_add_js .= str_repeat(' ', 8).$key.': '.$value.','."\n";
				}
			}
			$boxersandswipers_add_js = rtrim($boxersandswipers_add_js);
			$boxersandswipers_add_js = rtrim($boxersandswipers_add_js, ",");

$boxersandswipers_add_js .= <<<BOXERSANDSWIPERS2

	});
});
</script>
<!-- END: Boxers and Swipers -->

BOXERSANDSWIPERS2;
		}

		echo $boxersandswipers_add_js;

	}

}
