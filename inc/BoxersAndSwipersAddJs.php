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
    jQuery(".boxersandswipers").colorbox({

BOXERSANDSWIPERS1;

			$colorbox_set = NULL;
			foreach( $colorbox_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$colorbox_set .= $key.': "'.$value.'",';
				} else {
					$colorbox_set .= $key.': '.$value.',';
				}
			}
			$colorbox_set = rtrim($colorbox_set);
			$colorbox_set = rtrim($colorbox_set, ",");
			$boxersandswipers_add_js .= $colorbox_set;

$boxersandswipers_add_js .= <<<BOXERSANDSWIPERS2

    }).live("click",function(){
        jQuery(".boxersandswipers").colorbox({

BOXERSANDSWIPERS2;

			$boxersandswipers_add_js .= $colorbox_set;

$boxersandswipers_add_js .= <<<BOXERSANDSWIPERS3

        });
        return false;
    });
});
</script>
<!-- END: Boxers and Swipers -->

BOXERSANDSWIPERS3;
		} else if ( $this->effect === 'slimbox' ) {
			$slimbox_tbl = get_option('boxersandswipers_slimbox');
// JS
$boxersandswipers_add_js = <<<BOXERSANDSWIPERS1

<!-- BEGIN: Boxers and Swipers -->
<script type="text/javascript">
jQuery(function() {
    jQuery("a[rel*=boxersandswipers]").slimbox({

BOXERSANDSWIPERS1;

			$slimbox_set = NULL;
			foreach( $slimbox_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$slimbox_set .= $key.': "'.$value.'",';
				} else {
					$slimbox_set .= $key.': '.$value.',';
				}
			}
			$slimbox_set = rtrim($slimbox_set);
			$slimbox_set = rtrim($slimbox_set, ",");
			$boxersandswipers_add_js .= $slimbox_set;

$boxersandswipers_add_js .= <<<BOXERSANDSWIPERS2

    }).live("click",function(){
        jQuery("a[rel*=boxersandswipers]").slimbox({

BOXERSANDSWIPERS2;

			$boxersandswipers_add_js .= $slimbox_set;

$boxersandswipers_add_js .= <<<BOXERSANDSWIPERS3

        });
        return false;
    });
});
</script>
<!-- END: Boxers and Swipers -->

BOXERSANDSWIPERS3;
		} else if ( $this->effect === 'nivolightbox' ) {
			$nivolightbox_tbl = get_option('boxersandswipers_nivolightbox');
// JS
$boxersandswipers_add_js = <<<BOXERSANDSWIPERS1

<!-- BEGIN: Boxers and Swipers -->
<script type="text/javascript">
jQuery(function() {
	jQuery('a[data-lightbox-gallery*="boxersandswipers"]').nivoLightbox({

BOXERSANDSWIPERS1;

			$nivolightbox_set = NULL;
			foreach( $nivolightbox_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$nivolightbox_set .= $key.': "'.$value.'",';
				} else {
					$nivolightbox_set .= $key.': '.$value.',';
				}
			}
			$nivolightbox_set = rtrim($nivolightbox_set);
			$nivolightbox_set = rtrim($nivolightbox_set, ",");
			$boxersandswipers_add_js .= $nivolightbox_set;

$boxersandswipers_add_js .= <<<BOXERSANDSWIPERS2

    }).live("click",function(){
        jQuery('a[data-lightbox-gallery*="boxersandswipers"]').nivoLightbox({

BOXERSANDSWIPERS2;

			$boxersandswipers_add_js .= $nivolightbox_set;

$boxersandswipers_add_js .= <<<BOXERSANDSWIPERS3

        });
        return false;
	});
});
</script>
<!-- END: Boxers and Swipers -->

BOXERSANDSWIPERS3;
		} else if ( $this->effect === 'imagelightbox' ) {
			$imagelightbox_tbl = get_option('boxersandswipers_imagelightbox');
// JS
$boxersandswipers_add_js = <<<BOXERSANDSWIPERS1

<!-- BEGIN: Boxers and Swipers -->
<script type="text/javascript">
jQuery(function() {
	var activityIndicatorOn = function()
	{
		jQuery( '<div id="imagelightbox-loading"><div></div></div>' ).appendTo( 'body' );
	},
	activityIndicatorOff = function()
	{
		jQuery( '#imagelightbox-loading' ).remove();
	},
	overlayOn = function()
	{
		jQuery( '<div id="imagelightbox-overlay"></div>' ).appendTo( 'body' );
	},
	overlayOff = function()
	{
		jQuery( '#imagelightbox-overlay' ).remove();
	},
	closeButtonOn = function( instance )
	{
		jQuery( '<a href="#" id="imagelightbox-close">Close</a>' ).appendTo( 'body' ).on( 'click touchend', function(){ jQuery( this ).remove(); instance.quitImageLightbox(); return false; });
	},
	closeButtonOff = function()
	{
		jQuery( '#imagelightbox-close' ).remove();
	},
	captionOn = function()
	{
		var description = jQuery( 'a[href="' + jQuery( '#imagelightbox' ).attr( 'src' ) + '"] img' ).attr( 'alt' );
		if( description.length > 0 )
			jQuery( '<div id="imagelightbox-caption">' + description + '</div>' ).appendTo( 'body' );
	},
	captionOff = function()
	{
		jQuery( '#imagelightbox-caption' ).remove();
	};
	var instanceBoxersAndSwipers = jQuery( 'a[data-imagelightbox="boxersandswipers"]' ).imageLightbox({

BOXERSANDSWIPERS1;

			foreach( $imagelightbox_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$boxersandswipers_add_js .= str_repeat(' ', 8).$key.': "'.$value.'",'."\n";
				} else {
					$boxersandswipers_add_js .= str_repeat(' ', 8).$key.': '.$value.','."\n";
				}
			}
			$boxersandswipers_add_js = rtrim($boxersandswipers_add_js);

$boxersandswipers_add_js .= <<<BOXERSANDSWIPERS2

		onStart:	 function() { overlayOn(); closeButtonOn( instanceBoxersAndSwipers );},
		onEnd:		 function() { overlayOff(); captionOff(); closeButtonOff(); activityIndicatorOff(); },
		onLoadStart: function() { captionOff(); activityIndicatorOn(); },
		onLoadEnd:	 function() { captionOn(); activityIndicatorOff(); }
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
    Code.photoSwipe('a.boxersandswipers');
    Code.PhotoSwipe.Current.setOptions({

BOXERSANDSWIPERS1;

			foreach( $photoswipe_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$boxersandswipers_add_js .= $key.': "'.$value.'",';
				} else {
					$boxersandswipers_add_js .= $key.': '.$value.',';
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
    jQuery(".boxersandswipers").swipebox({

BOXERSANDSWIPERS1;

			$swipebox_set = NULL;
			foreach( $swipebox_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$swipebox_set .= $key.': "'.$value.'",';
				} else {
					$swipebox_set .= $key.': '.$value.',';
				}
			}
			$swipebox_set = rtrim($swipebox_set);
			$swipebox_set = rtrim($swipebox_set, ",");
			$boxersandswipers_add_js .= $swipebox_set;

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
