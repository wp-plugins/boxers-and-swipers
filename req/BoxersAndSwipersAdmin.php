<?php
/**
 * Boxers and Swipers
 * 
 * @package    Boxers and Swipers
 * @subpackage BoxersAndSwipersAdmin Management screen
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

class BoxersAndSwipersAdmin {

	/* ==================================================
	 * Add a "Settings" link to the plugins page
	 * @since	1.0
	 */
	function settings_link( $links, $file ) {
		static $this_plugin;
		if ( empty($this_plugin) ) {
			$this_plugin = BOXERSANDSWIPERS_PLUGIN_BASE_FILE;
		}
		if ( $file == $this_plugin ) {
			$links[] = '<a href="'.admin_url('options-general.php?page=boxersandswipers').'">'.__( 'Settings').'</a>';
		}
			return $links;
	}

	/* ==================================================
	 * Settings page
	 * @since	1.0
	 */
	function plugin_menu() {
		add_options_page( 'Boxers and Swipers Options', 'Boxers and Swipers', 'manage_options', 'boxersandswipers', array($this, 'plugin_options') );
	}


	/* ==================================================
	 * Settings page
	 * @since	1.0
	 */
	function plugin_options() {

		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		$pluginurl = plugins_url($path='',$scheme=null);

		wp_enqueue_style( 'jquery-ui-tabs', $pluginurl.'/boxers-and-swipers/css/jquery-ui.css' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-tabs-in', $pluginurl.'/boxers-and-swipers/js/jquery-ui-tabs-in.js' );

		if( !empty($_POST) ) { $this->options_updated(); }
		$scriptname = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH).'?page=boxersandswipers';

		$boxersandswipers_effect = get_option('boxersandswipers_effect');
		$boxersandswipers_useragent = get_option('boxersandswipers_useragent');
		$boxersandswipers_colorbox = get_option('boxersandswipers_colorbox');
		$boxersandswipers_slimbox = get_option('boxersandswipers_slimbox');
		$boxersandswipers_nivolightbox = get_option('boxersandswipers_nivolightbox');
		$boxersandswipers_photoswipe = get_option('boxersandswipers_photoswipe');
		$boxersandswipers_slideshow = get_option('boxersandswipers_slideshow');
		$boxersandswipers_swipebox = get_option('boxersandswipers_swipebox');

		?>

		<div class="wrap">
		<h2>Boxers and Swipers</h2>

	<div id="tabs">
	  <ul>
	    <li><a href="#tabs-1"><?php _e('The default value for each terminal', 'boxersandswipers') ?></a></li>
		<li><a href="#tabs-2"><?php _e('The default value for effects.', 'boxersandswipers') ?></a></li>
		<li><a href="#tabs-3"><?php _e('Caution:'); ?></a></li>
	<!--
		<li><a href="#tabs-4">FAQ</a></li>
	 -->
	  </ul>

	  <div id="tabs-1">
		<div class="wrap">

	<form method="post" action="<?php echo $scriptname; ?>">
			<h2><?php _e('The default value for each terminal', 'boxersandswipers') ?></h2>	

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

			<table border="1">
			<tbody>
				<tr>
					<td align="center" valign="middle"><b><?php _e('Terminal', 'boxersandswipers') ?></b></td>
					<td align="center" valign="middle"><b><?php _e('Effect', 'boxersandswipers') ?></b></td>
					<td align="center" valign="middle"><b><?php _e('User Agent', 'boxersandswipers') ?></b></td>
					<td align="center" valign="middle"><b><?php _e('Description') ?></b></td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>pc</b></td>
					<td align="center" valign="middle">
					<?php $target_effect_pc = $boxersandswipers_effect[pc]; ?>
					<select id="boxersandswipers_effect_pc" name="boxersandswipers_effect_pc">
						<option <?php if ('colorbox' == $target_effect_pc)echo 'selected="selected"'; ?>>colorbox</option>
						<option <?php if ('slimbox' == $target_effect_pc)echo 'selected="selected"'; ?>>slimbox</option>
						<option <?php if ('nivolightbox' == $target_effect_pc)echo 'selected="selected"'; ?>>nivolightbox</option>
						<option <?php if ('photoswipe' == $target_effect_pc)echo 'selected="selected"'; ?>>photoswipe</option>
						<option <?php if ('swipebox' == $target_effect_pc)echo 'selected="selected"'; ?>>swipebox</option>
					</select>
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>tablet</b></td>
					<td align="center" valign="middle">
					<?php $target_effect_tb = $boxersandswipers_effect[tb]; ?>
					<select id="boxersandswipers_effect_tb" name="boxersandswipers_effect_tb">
						<option <?php if ('colorbox' == $target_effect_tb)echo 'selected="selected"'; ?>>colorbox</option>
						<option <?php if ('slimbox' == $target_effect_tb)echo 'selected="selected"'; ?>>slimbox</option>
						<option <?php if ('nivolightbox' == $target_effect_tb)echo 'selected="selected"'; ?>>nivolightbox</option>
						<option <?php if ('photoswipe' == $target_effect_tb)echo 'selected="selected"'; ?>>photoswipe</option>
						<option <?php if ('swipebox' == $target_effect_tb)echo 'selected="selected"'; ?>>swipebox</option>
					</select>
					</td>
					<td align="center" valign="middle">
						<textarea id="boxersandswipers_useragent_tb" name="boxersandswipers_useragent_tb" rows="4" cols="120"><?php echo $boxersandswipers_useragent[tb] ?></textarea>

					</td>
					<td align="left" valign="middle" rowspan="2"><?php _e('| Specify separated by. Regular expression is possible.', 'boxersandswipers'); ?></td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>smartphone</b></td>
					<td align="center" valign="middle">
					<?php $target_effect_sp = $boxersandswipers_effect[sp]; ?>
					<select id="boxersandswipers_effect_sp" name="boxersandswipers_effect_sp">
						<option <?php if ('colorbox' == $target_effect_sp)echo 'selected="selected"'; ?>>colorbox</option>
						<option <?php if ('slimbox' == $target_effect_sp)echo 'selected="selected"'; ?>>slimbox</option>
						<option <?php if ('nivolightbox' == $target_effect_sp)echo 'selected="selected"'; ?>>nivolightbox</option>
						<option <?php if ('photoswipe' == $target_effect_sp)echo 'selected="selected"'; ?>>photoswipe</option>
						<option <?php if ('swipebox' == $target_effect_sp)echo 'selected="selected"'; ?>>swipebox</option>
					</select>
					</td>
					<td align="center" valign="middle">
						<textarea id="boxersandswipers_useragent_sp" name="boxersandswipers_useragent_sp" rows="4" cols="120"><?php echo $boxersandswipers_useragent[sp] ?></textarea>

					</td>
				</tr>
			</tbody>
			</table>

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

		</div>
	  </div>

	  <div id="tabs-2">
		<div class="wrap">
			<h2><?php _e('The default value for effects.', 'boxersandswipers') ?></h2>	

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

			<table border="1">
			<tbody>
				<tr>
					<td align="center" valign="middle" colspan="2">colorbox(<a href="http://www.jacklmoore.com/colorbox/" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</td>
					<td align="center" valign="middle" colspan="2">slimbox(<a href="http://www.digitalia.be/software/slimbox2" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</td>
					<td align="center" valign="middle" colspan="2">nivolightbox(<a href="http://docs.dev7studios.com/jquery-plugins/nivo-lightbox" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</td>
					<td align="center" valign="middle" colspan="2">photoswipe(<a href="https://github.com/dimsemenov/PhotoSwipe/blob/master/README.md" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</td>
					<td align="center" valign="middle" colspan="2">swipebox(<a href="http://brutaldesign.github.io/swipebox/" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</td>
				</tr>
				<tr>
					<td align="center" valign="middle">transition</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_transition = $boxersandswipers_colorbox[transition]; ?>
					<select id="boxersandswipers_colorbox_transition" name="boxersandswipers_colorbox_transition">
						<option <?php if ('elastic' == $target_colorbox_transition)echo 'selected="selected"'; ?>>elastic</option>
						<option <?php if ('fade' == $target_colorbox_transition)echo 'selected="selected"'; ?>>fade</option>
						<option <?php if ('none' == $target_colorbox_transition)echo 'selected="selected"'; ?>>none</option>
					</select>
					</td>
					<td align="center" valign="middle">loop</td>
					<td align="center" valign="middle">
					<?php $target_slimbox_loop = $boxersandswipers_slimbox[loop]; ?>
					<select id="boxersandswipers_slimbox_loop" name="boxersandswipers_slimbox_loop">
						<option <?php if ('true' == $target_slimbox_loop)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_slimbox_loop)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">effect</td>
					<td align="center" valign="middle">
					<?php $target_nivolightbox_effect = $boxersandswipers_nivolightbox[effect]; ?>
					<select id="boxersandswipers_nivolightbox_effect" name="boxersandswipers_nivolightbox_effect">
						<option <?php if ('fade' == $target_nivolightbox_effect)echo 'selected="selected"'; ?>>fade</option>
						<option <?php if ('fadeScale' == $target_nivolightbox_effect)echo 'selected="selected"'; ?>>fadeScale</option>
						<option <?php if ('slideLeft' == $target_nivolightbox_effect)echo 'selected="selected"'; ?>>slideLeft</option>
						<option <?php if ('slideRight' == $target_nivolightbox_effect)echo 'selected="selected"'; ?>>slideRight</option>
						<option <?php if ('slideUp' == $target_nivolightbox_effect)echo 'selected="selected"'; ?>>slideUp</option>
						<option <?php if ('slideDown' == $target_nivolightbox_effect)echo 'selected="selected"'; ?>>slideDown</option>
						<option <?php if ('fall' == $target_nivolightbox_effect)echo 'selected="selected"'; ?>>fall</option>
					</select>
					</td>
					<td align="center" valign="middle">fadeInSpeed</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_fadeInSpeed" name="boxersandswipers_photoswipe_fadeInSpeed" value="<?php echo $boxersandswipers_photoswipe[fadeInSpeed] ?>" size="10" />
					</td>
					<td align="center" valign="middle">hideBarsDelay</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_swipebox_hideBarsDelay" name="boxersandswipers_swipebox_hideBarsDelay" value="<?php echo $boxersandswipers_swipebox[hideBarsDelay] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">speed</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_speed" name="boxersandswipers_colorbox_speed" value="<?php echo $boxersandswipers_colorbox[speed] ?>" size="10" />
					</td>
					<td align="center" valign="middle">overlayOpacity</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_overlayOpacity" name="boxersandswipers_slimbox_overlayOpacity" value="<?php echo $boxersandswipers_slimbox[overlayOpacity] ?>" size="10" />
					</td>
					<td align="center" valign="middle">keyboardNav</td>
					<td align="center" valign="middle">
					<?php $target_nivolightbox_keyboardNav = $boxersandswipers_nivolightbox[keyboardNav]; ?>
					<select id="boxersandswipers_nivolightbox_keyboardNav" name="boxersandswipers_nivolightbox_keyboardNav">
						<option <?php if ('true' == $target_nivolightbox_keyboardNav)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_nivolightbox_keyboardNav)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">fadeOutSpeed</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_fadeOutSpeed" name="boxersandswipers_photoswipe_fadeOutSpeed" value="<?php echo $boxersandswipers_photoswipe[fadeOutSpeed] ?>" size="10" />
					</td>
					<td colspan="2" rowspan="40"></td>
				</tr>
				<tr>
					<td align="center" valign="middle">title</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_title" name="boxersandswipers_colorbox_title" value="<?php echo $boxersandswipers_colorbox[title] ?>" size="10" />
					</td>
					<td align="center" valign="middle">overlayFadeDuration</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_overlayFadeDuration" name="boxersandswipers_slimbox_overlayFadeDuration" value="<?php echo $boxersandswipers_slimbox[overlayFadeDuration] ?>" size="10" />
					</td>
					<td align="center" valign="middle">clickOverlayToClose</td>
					<td align="center" valign="middle">
					<?php $target_nivolightbox_clickOverlayToClose = $boxersandswipers_nivolightbox[clickOverlayToClose]; ?>
					<select id="boxersandswipers_nivolightbox_clickOverlayToClose" name="boxersandswipers_nivolightbox_clickOverlayToClose">
						<option <?php if ('true' == $target_nivolightbox_clickOverlayToClose)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_nivolightbox_clickOverlayToClose)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">slideSpeed</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_slideSpeed" name="boxersandswipers_photoswipe_slideSpeed" value="<?php echo $boxersandswipers_photoswipe[slideSpeed] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">scalePhotos</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_scalePhotos = $boxersandswipers_colorbox[scalePhotos]; ?>
					<select id="boxersandswipers_colorbox_scalePhotos" name="boxersandswipers_colorbox_scalePhotos">
						<option <?php if ('true' == $target_colorbox_scalePhotos)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_scalePhotos)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">resizeDuration</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_resizeDuration" name="boxersandswipers_slimbox_resizeDuration" value="<?php echo $boxersandswipers_slimbox[resizeDuration] ?>" size="10" />
					</td>
					<td colspan="2" rowspan="38"></td>
					<td align="center" valign="middle">swipeThreshold</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_swipeThreshold" name="boxersandswipers_photoswipe_swipeThreshold" value="<?php echo $boxersandswipers_photoswipe[swipeThreshold] ?>" size="10" />
					</td>
				<tr>
					<td align="center" valign="middle">scrolling</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_scrolling = $boxersandswipers_colorbox[scrolling]; ?>
					<select id="boxersandswipers_colorbox_scrolling" name="boxersandswipers_colorbox_scrolling">
						<option <?php if ('true' == $target_colorbox_scrolling)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_scrolling)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">resizeEasing</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_resizeEasing" name="boxersandswipers_slimbox_resizeEasing" value="<?php echo $boxersandswipers_slimbox[resizeEasing] ?>" size="10" />
					</td>
					<td align="center" valign="middle">swipeTimeThreshold</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_swipeTimeThreshold" name="boxersandswipers_photoswipe_swipeTimeThreshold" value="<?php echo $boxersandswipers_photoswipe[swipeTimeThreshold] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">opacity</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_opacity" name="boxersandswipers_colorbox_opacity" value="<?php echo $boxersandswipers_colorbox[opacity] ?>" size="10" />
					</td>
					<td align="center" valign="middle">initialWidth</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_initialWidth" name="boxersandswipers_slimbox_initialWidth" value="<?php echo $boxersandswipers_slimbox[initialWidth] ?>" size="10" />
					</td>
					<td align="center" valign="middle">loop</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_loop = $boxersandswipers_photoswipe[loop]; ?>
					<select id="boxersandswipers_photoswipe_loop" name="boxersandswipers_photoswipe_loop">
						<option <?php if ('true' == $target_photoswipe_loop)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_loop)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">open</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_open = $boxersandswipers_colorbox[open]; ?>
					<select id="boxersandswipers_colorbox_open" name="boxersandswipers_colorbox_open">
						<option <?php if ('true' == $target_colorbox_open)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_open)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">initialHeight</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_initialHeight" name="boxersandswipers_slimbox_initialHeight" value="<?php echo $boxersandswipers_slimbox[initialHeight] ?>" size="10" />
					</td>
					<td align="center" valign="middle">slideshowDelay</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_slideshowDelay" name="boxersandswipers_photoswipe_slideshowDelay" value="<?php echo $boxersandswipers_photoswipe[slideshowDelay] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">returnFocus</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_returnFocus = $boxersandswipers_colorbox[returnFocus]; ?>
					<select id="boxersandswipers_colorbox_returnFocus" name="boxersandswipers_colorbox_returnFocus">
						<option <?php if ('true' == $target_colorbox_returnFocus)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_returnFocus)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">imageFadeDuration</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_imageFadeDuration" name="boxersandswipers_slimbox_imageFadeDuration" value="<?php echo $boxersandswipers_slimbox[imageFadeDuration] ?>" size="10" />
					</td>
					<td align="center" valign="middle">imageScaleMethod</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_imageScaleMethod = $boxersandswipers_photoswipe[imageScaleMethod]; ?>
					<select id="boxersandswipers_photoswipe_imageScaleMethod" name="boxersandswipers_photoswipe_imageScaleMethod">
						<option <?php if ('fit' == $target_photoswipe_imageScaleMethod)echo 'selected="selected"'; ?>>fit</option>
						<option <?php if ('fitNoUpscale' == $target_photoswipe_imageScaleMethod)echo 'selected="selected"'; ?>>fitNoUpscale</option>
						<option <?php if ('zoom' == $target_photoswipe_imageScaleMethod)echo 'selected="selected"'; ?>>zoom</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">trapFocus</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_trapFocus = $boxersandswipers_colorbox[trapFocus]; ?>
					<select id="boxersandswipers_colorbox_trapFocus" name="boxersandswipers_colorbox_trapFocus">
						<option <?php if ('true' == $target_colorbox_trapFocus)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_trapFocus)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">captionAnimationDuration</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_captionAnimationDuration" name="boxersandswipers_slimbox_captionAnimationDuration" value="<?php echo $boxersandswipers_slimbox[captionAnimationDuration] ?>" size="10" />
					</td>
					<td align="center" valign="middle">preventHide</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_preventHide = $boxersandswipers_photoswipe[preventHide]; ?>
					<select id="boxersandswipers_photoswipe_preventHide" name="boxersandswipers_photoswipe_preventHide">
						<option <?php if ('true' == $target_photoswipe_preventHide)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_preventHide)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">fastIframe</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_fastIframe = $boxersandswipers_colorbox[fastIframe]; ?>
					<select id="boxersandswipers_colorbox_fastIframe" name="boxersandswipers_colorbox_fastIframe">
						<option <?php if ('true' == $target_colorbox_fastIframe)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_fastIframe)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">counterText</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_counterText" name="boxersandswipers_slimbox_counterText" value="<?php echo $boxersandswipers_slimbox[counterText] ?>" size="10" />
					<td align="center" valign="middle">backButtonHideEnabled</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_backButtonHideEnabled = $boxersandswipers_photoswipe[backButtonHideEnabled]; ?>
					<select id="boxersandswipers_photoswipe_backButtonHideEnabled" name="boxersandswipers_photoswipe_backButtonHideEnabled">
						<option <?php if ('true' == $target_photoswipe_backButtonHideEnabled)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_backButtonHideEnabled)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">preloading</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_preloading = $boxersandswipers_colorbox[preloading]; ?>
					<select id="boxersandswipers_colorbox_preloading" name="boxersandswipers_colorbox_preloading">
						<option <?php if ('true' == $target_colorbox_preloading)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_preloading)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">closeKeys</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_closeKeys" name="boxersandswipers_slimbox_closeKeys" value="<?php echo $boxersandswipers_slimbox[closeKeys] ?>" size="10" />
					<td align="center" valign="middle">captionAndToolbarHide</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_captionAndToolbarHide = $boxersandswipers_photoswipe[captionAndToolbarHide]; ?>
					<select id="boxersandswipers_photoswipe_captionAndToolbarHide" name="boxersandswipers_photoswipe_captionAndToolbarHide">
						<option <?php if ('true' == $target_photoswipe_captionAndToolbarHide)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_captionAndToolbarHide)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">overlayClose</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_overlayClose = $boxersandswipers_colorbox[overlayClose]; ?>
					<select id="boxersandswipers_colorbox_overlayClose" name="boxersandswipers_colorbox_overlayClose">
						<option <?php if ('true' == $target_colorbox_overlayClose)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_overlayClose)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">previousKeys</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_previousKeys" name="boxersandswipers_slimbox_previousKeys" value="<?php echo $boxersandswipers_slimbox[previousKeys] ?>" size="10" />
					</td>
					<td align="center" valign="middle">captionAndToolbarHideOnSwipe</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_captionAndToolbarHideOnSwipe = $boxersandswipers_photoswipe[captionAndToolbarHideOnSwipe]; ?>
					<select id="boxersandswipers_photoswipe_captionAndToolbarHideOnSwipe" name="boxersandswipers_photoswipe_captionAndToolbarHideOnSwipe">
						<option <?php if ('true' == $target_photoswipe_captionAndToolbarHideOnSwipe)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_captionAndToolbarHideOnSwipe)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">escKey</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_escKey = $boxersandswipers_colorbox[escKey]; ?>
					<select id="boxersandswipers_colorbox_escKey" name="boxersandswipers_colorbox_escKey">
						<option <?php if ('true' == $target_colorbox_escKey)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_escKey)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">nextKeys</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_nextKeys" name="boxersandswipers_slimbox_nextKeys" value="<?php echo $boxersandswipers_slimbox[nextKeys] ?>" size="10" />
					</td>
					<td align="center" valign="middle">captionAndToolbarFlipPosition</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_captionAndToolbarFlipPosition = $boxersandswipers_photoswipe[captionAndToolbarFlipPosition]; ?>
					<select id="boxersandswipers_photoswipe_captionAndToolbarFlipPosition" name="boxersandswipers_photoswipe_captionAndToolbarFlipPosition">
						<option <?php if ('true' == $target_photoswipe_captionAndToolbarFlipPosition)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_captionAndToolbarFlipPosition)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">arrowKey</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_arrowKey = $boxersandswipers_colorbox[arrowKey]; ?>
					<select id="boxersandswipers_colorbox_arrowKey" name="boxersandswipers_colorbox_arrowKey">
						<option <?php if ('true' == $target_colorbox_arrowKey)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_arrowKey)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td colspan="2" rowspan="28"></td>
					<td align="center" valign="middle">captionAndToolbarAutoHideDelay</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_captionAndToolbarAutoHideDelay" name="boxersandswipers_photoswipe_captionAndToolbarAutoHideDelay" value="<?php echo $boxersandswipers_photoswipe[captionAndToolbarAutoHideDelay] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">loop</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_loop = $boxersandswipers_colorbox[loop]; ?>
					<select id="boxersandswipers_colorbox_loop" name="boxersandswipers_colorbox_loop">
						<option <?php if ('true' == $target_colorbox_loop)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_loop)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">captionAndToolbarOpacity</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_captionAndToolbarOpacity" name="boxersandswipers_photoswipe_captionAndToolbarOpacity" value="<?php echo $boxersandswipers_photoswipe[captionAndToolbarOpacity] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">fadeOut</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_fadeOut" name="boxersandswipers_colorbox_fadeOut" value="<?php echo $boxersandswipers_colorbox[fadeOut] ?>" size="10" />
					</td>
					<td align="center" valign="middle">captionAndToolbarShowEmptyCaptions</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_captionAndToolbarShowEmptyCaptions = $boxersandswipers_photoswipe[captionAndToolbarShowEmptyCaptions]; ?>
					<select id="boxersandswipers_photoswipe_captionAndToolbarShowEmptyCaptions" name="boxersandswipers_photoswipe_captionAndToolbarShowEmptyCaptions">
						<option <?php if ('true' == $target_photoswipe_captionAndToolbarShowEmptyCaptions)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_captionAndToolbarShowEmptyCaptions)echo 'selected="selected"'; ?>>false</option>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">closeButton</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_closeButton = $boxersandswipers_colorbox[closeButton]; ?>
					<select id="boxersandswipers_colorbox_closeButton" name="boxersandswipers_colorbox_closeButton">
						<option <?php if ('true' == $target_colorbox_closeButton)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_closeButton)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td colspan="2" rowspan="25"></td>
				</tr>
				<tr>
					<td align="center" valign="middle">current</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_current" name="boxersandswipers_colorbox_current" value="<?php echo $boxersandswipers_colorbox[current] ?>" size="30" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">previous</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_previous" name="boxersandswipers_colorbox_previous" value="<?php echo $boxersandswipers_colorbox[previous] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">next</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_next" name="boxersandswipers_colorbox_next" value="<?php echo $boxersandswipers_colorbox[next] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">close</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_close" name="boxersandswipers_colorbox_close" value="<?php echo $boxersandswipers_colorbox[close] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">width</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_width" name="boxersandswipers_colorbox_width" value="<?php echo $boxersandswipers_colorbox[width] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">height</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_height" name="boxersandswipers_colorbox_height" value="<?php echo $boxersandswipers_colorbox[height] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">innerWidth</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_innerWidth" name="boxersandswipers_colorbox_innerWidth" value="<?php echo $boxersandswipers_colorbox[innerWidth] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">innerHeight</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_innerHeight" name="boxersandswipers_colorbox_innerHeight" value="<?php echo $boxersandswipers_colorbox[innerHeight] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">initialWidth</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_initialWidth" name="boxersandswipers_colorbox_initialWidth" value="<?php echo $boxersandswipers_colorbox[initialWidth] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">initialHeight</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_initialHeight" name="boxersandswipers_colorbox_initialHeight" value="<?php echo $boxersandswipers_colorbox[initialHeight] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">maxWidth</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_maxWidth" name="boxersandswipers_colorbox_maxWidth" value="<?php echo $boxersandswipers_colorbox[maxWidth] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">maxHeight</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_maxHeight" name="boxersandswipers_colorbox_maxHeight" value="<?php echo $boxersandswipers_colorbox[maxHeight] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">slideshow</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_slideshow = $boxersandswipers_colorbox[slideshow]; ?>
					<select id="boxersandswipers_colorbox_slideshow" name="boxersandswipers_colorbox_slideshow">
						<option <?php if ('true' == $target_colorbox_slideshow)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_slideshow)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">slideshowSpeed</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_slideshowSpeed" name="boxersandswipers_colorbox_slideshowSpeed" value="<?php echo $boxersandswipers_colorbox[slideshowSpeed] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">slideshowAuto</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_slideshowAuto = $boxersandswipers_colorbox[slideshowAuto]; ?>
					<select id="boxersandswipers_colorbox_slideshowAuto" name="boxersandswipers_colorbox_slideshowAuto">
						<option <?php if ('true' == $target_colorbox_slideshowAuto)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_slideshowAuto)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">slideshowStart</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_slideshowStart" name="boxersandswipers_colorbox_slideshowStart" value="<?php echo $boxersandswipers_colorbox[slideshowStart] ?>" size="20" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">slideshowStop</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_slideshowStop" name="boxersandswipers_colorbox_slideshowStop" value="<?php echo $boxersandswipers_colorbox[slideshowStop] ?>" size="20" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">fixed</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_fixed = $boxersandswipers_colorbox[fixed]; ?>
					<select id="boxersandswipers_colorbox_fixed" name="boxersandswipers_colorbox_fixed">
						<option <?php if ('true' == $target_colorbox_fixed)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_fixed)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">top</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_top" name="boxersandswipers_colorbox_top" value="<?php echo $boxersandswipers_colorbox[top] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">bottom</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_bottom" name="boxersandswipers_colorbox_bottom" value="<?php echo $boxersandswipers_colorbox[bottom] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">left</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_left" name="boxersandswipers_colorbox_left" value="<?php echo $boxersandswipers_colorbox[left] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">right</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_right" name="boxersandswipers_colorbox_right" value="<?php echo $boxersandswipers_colorbox[right] ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">reposition</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_reposition = $boxersandswipers_colorbox[reposition]; ?>
					<select id="boxersandswipers_colorbox_reposition" name="boxersandswipers_colorbox_reposition">
						<option <?php if ('true' == $target_colorbox_reposition)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_reposition)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">retinaImage</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_retinaImage = $boxersandswipers_colorbox[retinaImage]; ?>
					<select id="boxersandswipers_colorbox_retinaImage" name="boxersandswipers_colorbox_retinaImage">
						<option <?php if ('true' == $target_colorbox_retinaImage)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_retinaImage)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
			</tbody>
			</table>

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

		</div>
	  </div>

	  <div id="tabs-3">
		<div class="wrap">
			<h2><?php _e('Caution:'); ?></h2>

			<li><?php _e('If you are using an image gallery of WordPress, please describe the short code as follows.', boxersandswipers);?> : <a href="http://codex.wordpress.org/Gallery_Shortcode" target="_blank"><code>[gallery link="file"]</code></a></li>

		</div>
	  </div>

	<!--
	  <div id="tabs-4">
		<div class="wrap">
		<h2>FAQ</h2>

		</div>
	  </div>
	-->

	</form>
	</div>

		</div>
		<?php
	}

	/* ==================================================
	 * Update wp_options table.
	 * @since	1.0
	 */
	function options_updated(){

		$effect_tbl = array(
						'pc' => $_POST['boxersandswipers_effect_pc'],
						'tb' => $_POST['boxersandswipers_effect_tb'],
						'sp' => $_POST['boxersandswipers_effect_sp'],
						);
		update_option( 'boxersandswipers_effect', $effect_tbl );

		$useragent_tbl = array(
						'tb' => stripslashes($_POST['boxersandswipers_useragent_tb']),
						'sp' => stripslashes($_POST['boxersandswipers_useragent_sp'])
						);
		update_option( 'boxersandswipers_useragent', $useragent_tbl );

		$colorbox_tbl = array(
						'transition' => $_POST['boxersandswipers_colorbox_transition'],
						'speed' => $_POST['boxersandswipers_colorbox_speed'],
						'title' => $_POST['boxersandswipers_colorbox_title'],
						'rel' => 'grouped',
						'scalePhotos' => $_POST['boxersandswipers_colorbox_scalePhotos'],
						'scrolling' => $_POST['boxersandswipers_colorbox_scrolling'],
						'opacity' => $_POST['boxersandswipers_colorbox_opacity'],
						'open' => $_POST['boxersandswipers_colorbox_open'],
						'returnFocus' => $_POST['boxersandswipers_colorbox_returnFocus'],
						'trapFocus' => $_POST['boxersandswipers_colorbox_trapFocus'],
						'fastIframe' => $_POST['boxersandswipers_colorbox_fastIframe'],
						'preloading' => $_POST['boxersandswipers_colorbox_preloading'],
						'overlayClose' => $_POST['boxersandswipers_colorbox_overlayClose'],
						'escKey' => $_POST['boxersandswipers_colorbox_escKey'],
						'arrowKey' => $_POST['boxersandswipers_colorbox_arrowKey'],
						'loop' => $_POST['boxersandswipers_colorbox_loop'],
						'fadeOut' => $_POST['boxersandswipers_colorbox_fadeOut'],
						'closeButton' => $_POST['boxersandswipers_colorbox_closeButton'],
						'current' => $_POST['boxersandswipers_colorbox_current'],
						'previous' => $_POST['boxersandswipers_colorbox_previous'],
						'next' => $_POST['boxersandswipers_colorbox_next'],
						'close' => $_POST['boxersandswipers_colorbox_close'],
						'width' => $_POST['boxersandswipers_colorbox_width'],
						'height' => $_POST['boxersandswipers_colorbox_height'],
						'innerWidth' => $_POST['boxersandswipers_colorbox_innerWidth'],
						'innerHeight' => $_POST['boxersandswipers_colorbox_innerHeight'],
						'initialWidth' => $_POST['boxersandswipers_colorbox_initialWidth'],
						'initialHeight' => $_POST['boxersandswipers_colorbox_initialHeight'],
						'maxWidth' => $_POST['boxersandswipers_colorbox_maxWidth'],
						'maxHeight' => $_POST['boxersandswipers_colorbox_maxHeight'],
						'slideshow' => $_POST['boxersandswipers_colorbox_slideshow'],
						'slideshowSpeed' => $_POST['boxersandswipers_colorbox_slideshowSpeed'],
						'slideshowAuto' => $_POST['boxersandswipers_colorbox_slideshowAuto'],
						'slideshowStart' => $_POST['boxersandswipers_colorbox_slideshowStart'],
						'slideshowStop' => $_POST['boxersandswipers_colorbox_slideshowStop'],
						'fixed' => $_POST['boxersandswipers_colorbox_fixed'],
						'top' => $_POST['boxersandswipers_colorbox_top'],
						'bottom' => $_POST['boxersandswipers_colorbox_bottom'],
						'left' => $_POST['boxersandswipers_colorbox_left'],
						'right' => $_POST['boxersandswipers_colorbox_right'],
						'reposition' => $_POST['boxersandswipers_colorbox_reposition'],
						'retinaImage' => $_POST['boxersandswipers_colorbox_retinaImage']
						);
		update_option( 'boxersandswipers_colorbox', $colorbox_tbl );

		$slimbox_tbl = array(
						'loop' => $_POST['boxersandswipers_slimbox_loop'],
						'overlayOpacity' => $_POST['boxersandswipers_slimbox_overlayOpacity'],
						'overlayFadeDuration' => $_POST['boxersandswipers_slimbox_overlayFadeDuration'],
						'resizeDuration' => $_POST['boxersandswipers_slimbox_resizeDuration'],
						'resizeEasing' => $_POST['boxersandswipers_slimbox_resizeEasing'],
						'initialWidth' => $_POST['boxersandswipers_slimbox_initialWidth'],
						'initialHeight' => $_POST['boxersandswipers_slimbox_initialHeight'],
						'imageFadeDuration' => $_POST['boxersandswipers_slimbox_imageFadeDuration'],
						'captionAnimationDuration' => $_POST['boxersandswipers_slimbox_captionAnimationDuration'],
						'counterText' => $_POST['boxersandswipers_slimbox_counterText'],
						'closeKeys' => $_POST['boxersandswipers_slimbox_closeKeys'],
						'previousKeys' => $_POST['boxersandswipers_slimbox_previousKeys'],
						'nextKeys' => $_POST['boxersandswipers_slimbox_nextKeys']
						);
		update_option( 'boxersandswipers_slimbox', $slimbox_tbl );

		$nivolightbox_tbl = array(
						'effect' => $_POST['boxersandswipers_nivolightbox_effect'],
						'keyboardNav' => $_POST['boxersandswipers_nivolightbox_keyboardNav'],
						'clickOverlayToClose' => $_POST['boxersandswipers_nivolightbox_clickOverlayToClose']
						);
		update_option( 'boxersandswipers_nivolightbox', $nivolightbox_tbl );

		$photoswipe_tbl = array(
						'fadeInSpeed' => $_POST['boxersandswipers_photoswipe_fadeInSpeed'],
						'fadeOutSpeed' => $_POST['boxersandswipers_photoswipe_fadeOutSpeed'],
						'slideSpeed' => $_POST['boxersandswipers_photoswipe_slideSpeed'],
						'swipeThreshold' => $_POST['boxersandswipers_photoswipe_swipeThreshold'],
						'swipeTimeThreshold' => $_POST['boxersandswipers_photoswipe_swipeTimeThreshold'],
						'loop' => $_POST['boxersandswipers_photoswipe_loop'],
						'slideshowDelay' => $_POST['boxersandswipers_photoswipe_slideshowDelay'],
						'imageScaleMethod' => $_POST['boxersandswipers_photoswipe_imageScaleMethod'],
						'preventHide' => $_POST['boxersandswipers_photoswipe_preventHide'],
						'backButtonHideEnabled' => $_POST['boxersandswipers_photoswipe_backButtonHideEnabled'],
						'captionAndToolbarHide' => $_POST['boxersandswipers_photoswipe_captionAndToolbarHide'],
						'captionAndToolbarHideOnSwipe' => $_POST['boxersandswipers_photoswipe_captionAndToolbarHideOnSwipe'],
						'captionAndToolbarFlipPosition' => $_POST['boxersandswipers_photoswipe_captionAndToolbarFlipPosition'],
						'captionAndToolbarAutoHideDelay' => $_POST['boxersandswipers_photoswipe_captionAndToolbarAutoHideDelay'],
						'captionAndToolbarOpacity' => $_POST['boxersandswipers_photoswipe_captionAndToolbarOpacity'],
						'captionAndToolbarShowEmptyCaptions' => $_POST['boxersandswipers_photoswipe_captionAndToolbarShowEmptyCaptions']
						);
		update_option( 'boxersandswipers_photoswipe', $photoswipe_tbl );

		$swipebox_tbl = array(
						'hideBarsDelay' => $_POST['boxersandswipers_swipebox_hideBarsDelay']
						);
		update_option( 'boxersandswipers_swipebox', $swipebox_tbl );

	}

}

?>