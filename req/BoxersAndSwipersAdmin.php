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

		wp_enqueue_style( 'jquery-ui-tabs', BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/css/jquery-ui.css' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-tabs-in', BOXERSANDSWIPERS_PLUGIN_URL.'/boxers-and-swipers/js/jquery-ui-tabs-in.js' );

		if( !empty($_POST) ) { $this->options_updated(); }
		$scriptname = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH).'?page=boxersandswipers';

		$boxersandswipers_apply = get_option('boxersandswipers_apply');
		$boxersandswipers_effect = get_option('boxersandswipers_effect');
		$boxersandswipers_useragent = get_option('boxersandswipers_useragent');
		$boxersandswipers_colorbox = get_option('boxersandswipers_colorbox');
		$boxersandswipers_slimbox = get_option('boxersandswipers_slimbox');
		$boxersandswipers_nivolightbox = get_option('boxersandswipers_nivolightbox');
		$boxersandswipers_imagelightbox = get_option('boxersandswipers_imagelightbox');
		$boxersandswipers_photoswipe = get_option('boxersandswipers_photoswipe');
		$boxersandswipers_slideshow = get_option('boxersandswipers_slideshow');
		$boxersandswipers_swipebox = get_option('boxersandswipers_swipebox');

		$posttypes = $this->search_posttype();

		?>

		<div class="wrap">
		<h2>Boxers and Swipers</h2>

	<div id="tabs">
	  <ul>
	    <li><a href="#tabs-1"><?php _e('The default value for each terminal', 'boxersandswipers') ?></a></li>
		<li><a href="#tabs-2">colorbox&nbsp<?php _e('Settings'); ?></a></li>
		<li><a href="#tabs-3">slimbox&nbsp<?php _e('Settings'); ?></a></li>
		<li><a href="#tabs-4">nivolightbox&nbsp<?php _e('Settings'); ?></a></li>
		<li><a href="#tabs-5">imagelightbox&nbsp<?php _e('Settings'); ?></a></li>
		<li><a href="#tabs-6">photoswipe&nbsp<?php _e('Settings'); ?></a></li>
		<li><a href="#tabs-7">swipebox&nbsp<?php _e('Settings'); ?></a></li>
	<!--
		<li><a href="#tabs-8">FAQ</a></li>
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
					<td align="center" valign="middle"><?php _e('Terminal', 'boxersandswipers') ?></td>
					<td align="center" valign="middle"><?php _e('Effect', 'boxersandswipers') ?></td>
					<td align="center" valign="middle"><?php _e('Apply') ?></td>
					<td align="center" valign="middle"><?php _e('User Agent', 'boxersandswipers') ?></td>
					<td align="center" valign="middle"><?php _e('Description') ?></td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>pc</b></td>
					<td align="center" valign="middle">
					<?php $target_effect_pc = $boxersandswipers_effect[pc]; ?>
					<select id="boxersandswipers_effect_pc" name="boxersandswipers_effect_pc">
						<option <?php if ('colorbox' == $target_effect_pc)echo 'selected="selected"'; ?>>colorbox</option>
						<option <?php if ('slimbox' == $target_effect_pc)echo 'selected="selected"'; ?>>slimbox</option>
						<option <?php if ('nivolightbox' == $target_effect_pc)echo 'selected="selected"'; ?>>nivolightbox</option>
						<option <?php if ('imagelightbox' == $target_effect_pc)echo 'selected="selected"'; ?>>imagelightbox</option>
						<option <?php if ('photoswipe' == $target_effect_pc)echo 'selected="selected"'; ?>>photoswipe</option>
						<option <?php if ('swipebox' == $target_effect_pc)echo 'selected="selected"'; ?>>swipebox</option>
					</select>
					</td>
					<td>
					<?php
					$posttypes = $this->search_posttype();
					foreach ( $posttypes as $key => $value ) {
						?>
						<input name="boxersandswipers_apply_pc[<?php echo $key; ?>]" type="checkbox" value="true" <?php if ($boxersandswipers_apply[$key][pc] === 'true') echo 'checked'; ?>><?php echo $value; ?>&nbsp;&nbsp;
						<?php
					}
					?>
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
						<option <?php if ('imagelightbox' == $target_effect_tb)echo 'selected="selected"'; ?>>imagelightbox</option>
						<option <?php if ('photoswipe' == $target_effect_tb)echo 'selected="selected"'; ?>>photoswipe</option>
						<option <?php if ('swipebox' == $target_effect_tb)echo 'selected="selected"'; ?>>swipebox</option>
					</select>
					</td>
					<td>
					<?php
					foreach ( $posttypes as $key => $value ) {
						?>
						<input name="boxersandswipers_apply_tb[<?php echo $key; ?>]" type="checkbox" value="true" <?php if ($boxersandswipers_apply[$key][tb] === 'true') echo 'checked'; ?>><?php echo $value; ?>&nbsp;&nbsp;
						<?php
					}
					?>
					</td>
					<td align="center" valign="middle">
						<textarea id="boxersandswipers_useragent_tb" name="boxersandswipers_useragent_tb" rows="4" cols="80"><?php echo $boxersandswipers_useragent[tb] ?></textarea>

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
						<option <?php if ('imagelightbox' == $target_effect_sp)echo 'selected="selected"'; ?>>imagelightbox</option>
						<option <?php if ('photoswipe' == $target_effect_sp)echo 'selected="selected"'; ?>>photoswipe</option>
						<option <?php if ('swipebox' == $target_effect_sp)echo 'selected="selected"'; ?>>swipebox</option>
					</select>
					</td>
					<td>
					<?php
					$posttypes = $this->search_posttype();
					foreach ( $posttypes as $key => $value ) {
	?>
						<input name="boxersandswipers_apply_sp[<?php echo $key; ?>]" type="checkbox" value="true" <?php if ($boxersandswipers_apply[$key][sp] === 'true') echo 'checked'; ?>><?php echo $value; ?>&nbsp;&nbsp;
						<?php
					}
					?>
					</td>
					<td align="center" valign="middle">
						<textarea id="boxersandswipers_useragent_sp" name="boxersandswipers_useragent_sp" rows="4" cols="80"><?php echo $boxersandswipers_useragent[sp] ?></textarea>

					</td>
				</tr>
			</tbody>
			</table>

			<?php

			?>

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

		</div>
	  </div>

	  <div id="tabs-2">
		<div class="wrap">
			<h2>colorbox&nbsp<?php _e('Settings'); ?>(<a href="http://www.jacklmoore.com/colorbox/" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</h2>	

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

			</table>
			<table>
			<tbody>
				<tr>
					<td align="right" valign="middle">transition</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_transition = $boxersandswipers_colorbox[transition]; ?>
					<select id="boxersandswipers_colorbox_transition" name="boxersandswipers_colorbox_transition">
						<option <?php if ('elastic' == $target_colorbox_transition)echo 'selected="selected"'; ?>>elastic</option>
						<option <?php if ('fade' == $target_colorbox_transition)echo 'selected="selected"'; ?>>fade</option>
						<option <?php if ('none' == $target_colorbox_transition)echo 'selected="selected"'; ?>>none</option>
					</select>
					</td>
					<td align="right" valign="middle">fadeOut</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_fadeOut" name="boxersandswipers_colorbox_fadeOut" value="<?php echo $boxersandswipers_colorbox[fadeOut] ?>" />
					</td>
					<td align="right" valign="middle">slideshow</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_slideshow = $boxersandswipers_colorbox[slideshow]; ?>
					<select id="boxersandswipers_colorbox_slideshow" name="boxersandswipers_colorbox_slideshow">
						<option <?php if ('true' == $target_colorbox_slideshow)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_slideshow)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">speed</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_speed" name="boxersandswipers_colorbox_speed" value="<?php echo $boxersandswipers_colorbox[speed] ?>" />
					</td>
					<td align="right" valign="middle">closeButton</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_closeButton = $boxersandswipers_colorbox[closeButton]; ?>
					<select id="boxersandswipers_colorbox_closeButton" name="boxersandswipers_colorbox_closeButton">
						<option <?php if ('true' == $target_colorbox_closeButton)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_closeButton)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="right" valign="middle">slideshowSpeed</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_slideshowSpeed" name="boxersandswipers_colorbox_slideshowSpeed" value="<?php echo $boxersandswipers_colorbox[slideshowSpeed] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">title</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_title" name="boxersandswipers_colorbox_title" value="<?php echo $boxersandswipers_colorbox[title] ?>" />
					</td>
					<td align="right" valign="middle">current</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_current" name="boxersandswipers_colorbox_current" value="<?php echo $boxersandswipers_colorbox[current] ?>" size="30" />
					</td>
					<td align="right" valign="middle">slideshowAuto</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_slideshowAuto = $boxersandswipers_colorbox[slideshowAuto]; ?>
					<select id="boxersandswipers_colorbox_slideshowAuto" name="boxersandswipers_colorbox_slideshowAuto">
						<option <?php if ('true' == $target_colorbox_slideshowAuto)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_slideshowAuto)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">scalePhotos</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_scalePhotos = $boxersandswipers_colorbox[scalePhotos]; ?>
					<select id="boxersandswipers_colorbox_scalePhotos" name="boxersandswipers_colorbox_scalePhotos">
						<option <?php if ('true' == $target_colorbox_scalePhotos)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_scalePhotos)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="right" valign="middle">previous</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_previous" name="boxersandswipers_colorbox_previous" value="<?php echo $boxersandswipers_colorbox[previous] ?>" />
					</td>
					<td align="right" valign="middle">slideshowStart</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_slideshowStart" name="boxersandswipers_colorbox_slideshowStart" value="<?php echo $boxersandswipers_colorbox[slideshowStart] ?>" size="30" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">scrolling</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_scrolling = $boxersandswipers_colorbox[scrolling]; ?>
					<select id="boxersandswipers_colorbox_scrolling" name="boxersandswipers_colorbox_scrolling">
						<option <?php if ('true' == $target_colorbox_scrolling)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_scrolling)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="right" valign="middle">next</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_next" name="boxersandswipers_colorbox_next" value="<?php echo $boxersandswipers_colorbox[next] ?>" />
					</td>
					<td align="right" valign="middle">slideshowStop</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_slideshowStop" name="boxersandswipers_colorbox_slideshowStop" value="<?php echo $boxersandswipers_colorbox[slideshowStop] ?>" size="30" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">opacity</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_opacity" name="boxersandswipers_colorbox_opacity" value="<?php echo $boxersandswipers_colorbox[opacity] ?>" />
					</td>
					<td align="right" valign="middle">close</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_close" name="boxersandswipers_colorbox_close" value="<?php echo $boxersandswipers_colorbox[close] ?>" />
					</td>
					<td align="right" valign="middle">fixed</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_fixed = $boxersandswipers_colorbox[fixed]; ?>
					<select id="boxersandswipers_colorbox_fixed" name="boxersandswipers_colorbox_fixed">
						<option <?php if ('true' == $target_colorbox_fixed)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_fixed)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">open</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_open = $boxersandswipers_colorbox[open]; ?>
					<select id="boxersandswipers_colorbox_open" name="boxersandswipers_colorbox_open">
						<option <?php if ('true' == $target_colorbox_open)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_open)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="right" valign="middle">width</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_width" name="boxersandswipers_colorbox_width" value="<?php echo $boxersandswipers_colorbox[width] ?>" />
					</td>
					<td align="right" valign="middle">top</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_top" name="boxersandswipers_colorbox_top" value="<?php echo $boxersandswipers_colorbox[top] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">returnFocus</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_returnFocus = $boxersandswipers_colorbox[returnFocus]; ?>
					<select id="boxersandswipers_colorbox_returnFocus" name="boxersandswipers_colorbox_returnFocus">
						<option <?php if ('true' == $target_colorbox_returnFocus)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_returnFocus)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="right" valign="middle">height</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_height" name="boxersandswipers_colorbox_height" value="<?php echo $boxersandswipers_colorbox[height] ?>" />
					</td>
					<td align="right" valign="middle">bottom</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_bottom" name="boxersandswipers_colorbox_bottom" value="<?php echo $boxersandswipers_colorbox[bottom] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">trapFocus</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_trapFocus = $boxersandswipers_colorbox[trapFocus]; ?>
					<select id="boxersandswipers_colorbox_trapFocus" name="boxersandswipers_colorbox_trapFocus">
						<option <?php if ('true' == $target_colorbox_trapFocus)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_trapFocus)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="right" valign="middle">innerWidth</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_innerWidth" name="boxersandswipers_colorbox_innerWidth" value="<?php echo $boxersandswipers_colorbox[innerWidth] ?>" />
					</td>
					<td align="right" valign="middle">left</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_left" name="boxersandswipers_colorbox_left" value="<?php echo $boxersandswipers_colorbox[left] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">fastIframe</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_fastIframe = $boxersandswipers_colorbox[fastIframe]; ?>
					<select id="boxersandswipers_colorbox_fastIframe" name="boxersandswipers_colorbox_fastIframe">
						<option <?php if ('true' == $target_colorbox_fastIframe)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_fastIframe)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="right" valign="middle">innerHeight</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_innerHeight" name="boxersandswipers_colorbox_innerHeight" value="<?php echo $boxersandswipers_colorbox[innerHeight] ?>" />
					</td>
					<td align="right" valign="middle">right</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_right" name="boxersandswipers_colorbox_right" value="<?php echo $boxersandswipers_colorbox[right] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">preloading</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_preloading = $boxersandswipers_colorbox[preloading]; ?>
					<select id="boxersandswipers_colorbox_preloading" name="boxersandswipers_colorbox_preloading">
						<option <?php if ('true' == $target_colorbox_preloading)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_preloading)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="right" valign="middle">initialWidth</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_initialWidth" name="boxersandswipers_colorbox_initialWidth" value="<?php echo $boxersandswipers_colorbox[initialWidth] ?>" />
					</td>
					<td align="right" valign="middle">reposition</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_reposition = $boxersandswipers_colorbox[reposition]; ?>
					<select id="boxersandswipers_colorbox_reposition" name="boxersandswipers_colorbox_reposition">
						<option <?php if ('true' == $target_colorbox_reposition)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_reposition)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">overlayClose</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_overlayClose = $boxersandswipers_colorbox[overlayClose]; ?>
					<select id="boxersandswipers_colorbox_overlayClose" name="boxersandswipers_colorbox_overlayClose">
						<option <?php if ('true' == $target_colorbox_overlayClose)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_overlayClose)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="right" valign="middle">initialHeight</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_initialHeight" name="boxersandswipers_colorbox_initialHeight" value="<?php echo $boxersandswipers_colorbox[initialHeight] ?>" />
					</td>
					<td align="right" valign="middle">retinaImage</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_retinaImage = $boxersandswipers_colorbox[retinaImage]; ?>
					<select id="boxersandswipers_colorbox_retinaImage" name="boxersandswipers_colorbox_retinaImage">
						<option <?php if ('true' == $target_colorbox_retinaImage)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_retinaImage)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">escKey</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_escKey = $boxersandswipers_colorbox[escKey]; ?>
					<select id="boxersandswipers_colorbox_escKey" name="boxersandswipers_colorbox_escKey">
						<option <?php if ('true' == $target_colorbox_escKey)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_escKey)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="right" valign="middle">maxWidth</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_maxWidth" name="boxersandswipers_colorbox_maxWidth" value="<?php echo $boxersandswipers_colorbox[maxWidth] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">arrowKey</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_arrowKey = $boxersandswipers_colorbox[arrowKey]; ?>
					<select id="boxersandswipers_colorbox_arrowKey" name="boxersandswipers_colorbox_arrowKey">
						<option <?php if ('true' == $target_colorbox_arrowKey)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_arrowKey)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="right" valign="middle">maxHeight</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_colorbox_maxHeight" name="boxersandswipers_colorbox_maxHeight" value="<?php echo $boxersandswipers_colorbox[maxHeight] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">loop</td>
					<td align="left" valign="middle">
					<?php $target_colorbox_loop = $boxersandswipers_colorbox[loop]; ?>
					<select id="boxersandswipers_colorbox_loop" name="boxersandswipers_colorbox_loop">
						<option <?php if ('true' == $target_colorbox_loop)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_loop)echo 'selected="selected"'; ?>>false</option>
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
			<h2>slimbox&nbsp<?php _e('Settings'); ?>(<a href="http://www.digitalia.be/software/slimbox2" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</h2>	

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

			<table>
			<tbody>
				<tr>
					<td align="right" valign="middle">loop</td>
					<td align="left" valign="middle">
					<?php $target_slimbox_loop = $boxersandswipers_slimbox[loop]; ?>
					<select id="boxersandswipers_slimbox_loop" name="boxersandswipers_slimbox_loop">
						<option <?php if ('true' == $target_slimbox_loop)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_slimbox_loop)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">overlayOpacity</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_overlayOpacity" name="boxersandswipers_slimbox_overlayOpacity" value="<?php echo $boxersandswipers_slimbox[overlayOpacity] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">overlayFadeDuration</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_overlayFadeDuration" name="boxersandswipers_slimbox_overlayFadeDuration" value="<?php echo $boxersandswipers_slimbox[overlayFadeDuration] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">resizeDuration</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_resizeDuration" name="boxersandswipers_slimbox_resizeDuration" value="<?php echo $boxersandswipers_slimbox[resizeDuration] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">resizeEasing</td>
					<td align="left" valign="middle">
					<?php $target_slimbox_resizeEasing = $boxersandswipers_slimbox[resizeEasing]; ?>
					<select id="boxersandswipers_slimbox_resizeEasing" name="boxersandswipers_slimbox_resizeEasing">
						<option <?php if ('swing' == $target_slimbox_resizeEasing)echo 'selected="selected"'; ?>>swing</option>
						<option <?php if ('linear' == $target_slimbox_resizeEasing)echo 'selected="selected"'; ?>>linear</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">initialWidth</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_initialWidth" name="boxersandswipers_slimbox_initialWidth" value="<?php echo $boxersandswipers_slimbox[initialWidth] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">initialHeight</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_initialHeight" name="boxersandswipers_slimbox_initialHeight" value="<?php echo $boxersandswipers_slimbox[initialHeight] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">imageFadeDuration</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_imageFadeDuration" name="boxersandswipers_slimbox_imageFadeDuration" value="<?php echo $boxersandswipers_slimbox[imageFadeDuration] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">captionAnimationDuration</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_captionAnimationDuration" name="boxersandswipers_slimbox_captionAnimationDuration" value="<?php echo $boxersandswipers_slimbox[captionAnimationDuration] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">counterText</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_counterText" name="boxersandswipers_slimbox_counterText" value="<?php echo $boxersandswipers_slimbox[counterText] ?>" size="30" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">closeKeys</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_closeKeys" name="boxersandswipers_slimbox_closeKeys" value="<?php echo $boxersandswipers_slimbox[closeKeys] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">previousKeys</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_previousKeys" name="boxersandswipers_slimbox_previousKeys" value="<?php echo $boxersandswipers_slimbox[previousKeys] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">nextKeys</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_slimbox_nextKeys" name="boxersandswipers_slimbox_nextKeys" value="<?php echo $boxersandswipers_slimbox[nextKeys] ?>" />
					</td>
				</tr>
			</tbody>
			</table>

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

		</div>
	  </div>
	  <div id="tabs-4">
		<div class="wrap">
			<h2>nivolightbox&nbsp<?php _e('Settings'); ?>(<a href="http://docs.dev7studios.com/jquery-plugins/nivo-lightbox" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</h2>	

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

			<table>
			<tbody>
				<tr>
					<td align="right" valign="middle">effect</td>
					<td align="left" valign="middle">
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
				</tr>
				<tr>
					<td align="right" valign="middle">keyboardNav</td>
					<td align="left" valign="middle">
					<?php $target_nivolightbox_keyboardNav = $boxersandswipers_nivolightbox[keyboardNav]; ?>
					<select id="boxersandswipers_nivolightbox_keyboardNav" name="boxersandswipers_nivolightbox_keyboardNav">
						<option <?php if ('true' == $target_nivolightbox_keyboardNav)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_nivolightbox_keyboardNav)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">clickOverlayToClose</td>
					<td align="left" valign="middle">
					<?php $target_nivolightbox_clickOverlayToClose = $boxersandswipers_nivolightbox[clickOverlayToClose]; ?>
					<select id="boxersandswipers_nivolightbox_clickOverlayToClose" name="boxersandswipers_nivolightbox_clickOverlayToClose">
						<option <?php if ('true' == $target_nivolightbox_clickOverlayToClose)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_nivolightbox_clickOverlayToClose)echo 'selected="selected"'; ?>>false</option>
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
	  <div id="tabs-5">
		<div class="wrap">
			<h2>imagelightbox&nbsp<?php _e('Settings'); ?>(<a href="http://osvaldas.info/image-lightbox-responsive-touch-friendly" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</h2>	

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

			<table>
			<tbody>
				<tr>
					<td align="right" valign="middle">animationSpeed</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_imagelightbox_animationSpeed" name="boxersandswipers_imagelightbox_animationSpeed" value="<?php echo $boxersandswipers_imagelightbox[animationSpeed] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">preloadNext</td>
					<td align="left" valign="middle">
					<?php $target_imagelightbox_preloadNext = $boxersandswipers_imagelightbox[preloadNext]; ?>
					<select id="boxersandswipers_imagelightbox_preloadNext" name="boxersandswipers_imagelightbox_preloadNext">
						<option <?php if ('true' == $target_imagelightbox_preloadNext)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_imagelightbox_preloadNext)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">enableKeyboard</td>
					<td align="left" valign="middle">
					<?php $target_imagelightbox_enableKeyboard = $boxersandswipers_imagelightbox[enableKeyboard]; ?>
					<select id="boxersandswipers_imagelightbox_enableKeyboard" name="boxersandswipers_imagelightbox_enableKeyboard">
						<option <?php if ('true' == $target_imagelightbox_enableKeyboard)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_imagelightbox_enableKeyboard)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">quitOnEnd</td>
					<td align="left" valign="middle">
					<?php $target_imagelightbox_quitOnEnd = $boxersandswipers_imagelightbox[quitOnEnd]; ?>
					<select id="boxersandswipers_imagelightbox_quitOnEnd" name="boxersandswipers_imagelightbox_quitOnEnd">
						<option <?php if ('true' == $target_imagelightbox_quitOnEnd)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_imagelightbox_quitOnEnd)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">quitOnImgClick</td>
					<td align="left" valign="middle">
					<?php $target_imagelightbox_quitOnImgClick = $boxersandswipers_imagelightbox[quitOnImgClick]; ?>
					<select id="boxersandswipers_imagelightbox_quitOnImgClick" name="boxersandswipers_imagelightbox_quitOnImgClick">
						<option <?php if ('true' == $target_imagelightbox_quitOnImgClick)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_imagelightbox_quitOnImgClick)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">quitOnDocClick</td>
					<td align="left" valign="middle">
					<?php $target_imagelightbox_quitOnDocClick = $boxersandswipers_imagelightbox[quitOnDocClick]; ?>
					<select id="boxersandswipers_imagelightbox_quitOnDocClick" name="boxersandswipers_imagelightbox_quitOnDocClick">
						<option <?php if ('true' == $target_imagelightbox_quitOnDocClick)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_imagelightbox_quitOnDocClick)echo 'selected="selected"'; ?>>false</option>
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
	  <div id="tabs-6">
		<div class="wrap">
			<h2>photoswipe&nbsp<?php _e('Settings'); ?>(<a href="https://github.com/dimsemenov/PhotoSwipe/blob/master/README.md" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</h2>	

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

			<table>
			<tbody>
				<tr>
					<td align="right" valign="middle">fadeInSpeed</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_fadeInSpeed" name="boxersandswipers_photoswipe_fadeInSpeed" value="<?php echo $boxersandswipers_photoswipe[fadeInSpeed] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">fadeOutSpeed</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_fadeOutSpeed" name="boxersandswipers_photoswipe_fadeOutSpeed" value="<?php echo $boxersandswipers_photoswipe[fadeOutSpeed] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">slideSpeed</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_slideSpeed" name="boxersandswipers_photoswipe_slideSpeed" value="<?php echo $boxersandswipers_photoswipe[slideSpeed] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">swipeThreshold</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_swipeThreshold" name="boxersandswipers_photoswipe_swipeThreshold" value="<?php echo $boxersandswipers_photoswipe[swipeThreshold] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">swipeTimeThreshold</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_swipeTimeThreshold" name="boxersandswipers_photoswipe_swipeTimeThreshold" value="<?php echo $boxersandswipers_photoswipe[swipeTimeThreshold] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">loop</td>
					<td align="left" valign="middle">
					<?php $target_photoswipe_loop = $boxersandswipers_photoswipe[loop]; ?>
					<select id="boxersandswipers_photoswipe_loop" name="boxersandswipers_photoswipe_loop">
						<option <?php if ('true' == $target_photoswipe_loop)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_loop)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">slideshowDelay</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_slideshowDelay" name="boxersandswipers_photoswipe_slideshowDelay" value="<?php echo $boxersandswipers_photoswipe[slideshowDelay] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">imageScaleMethod</td>
					<td align="left" valign="middle">
					<?php $target_photoswipe_imageScaleMethod = $boxersandswipers_photoswipe[imageScaleMethod]; ?>
					<select id="boxersandswipers_photoswipe_imageScaleMethod" name="boxersandswipers_photoswipe_imageScaleMethod">
						<option <?php if ('fit' == $target_photoswipe_imageScaleMethod)echo 'selected="selected"'; ?>>fit</option>
						<option <?php if ('fitNoUpscale' == $target_photoswipe_imageScaleMethod)echo 'selected="selected"'; ?>>fitNoUpscale</option>
						<option <?php if ('zoom' == $target_photoswipe_imageScaleMethod)echo 'selected="selected"'; ?>>zoom</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">preventHide</td>
					<td align="left" valign="middle">
					<?php $target_photoswipe_preventHide = $boxersandswipers_photoswipe[preventHide]; ?>
					<select id="boxersandswipers_photoswipe_preventHide" name="boxersandswipers_photoswipe_preventHide">
						<option <?php if ('true' == $target_photoswipe_preventHide)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_preventHide)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">backButtonHideEnabled</td>
					<td align="left" valign="middle">
					<?php $target_photoswipe_backButtonHideEnabled = $boxersandswipers_photoswipe[backButtonHideEnabled]; ?>
					<select id="boxersandswipers_photoswipe_backButtonHideEnabled" name="boxersandswipers_photoswipe_backButtonHideEnabled">
						<option <?php if ('true' == $target_photoswipe_backButtonHideEnabled)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_backButtonHideEnabled)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">captionAndToolbarHide</td>
					<td align="left" valign="middle">
					<?php $target_photoswipe_captionAndToolbarHide = $boxersandswipers_photoswipe[captionAndToolbarHide]; ?>
					<select id="boxersandswipers_photoswipe_captionAndToolbarHide" name="boxersandswipers_photoswipe_captionAndToolbarHide">
						<option <?php if ('true' == $target_photoswipe_captionAndToolbarHide)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_captionAndToolbarHide)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">captionAndToolbarHideOnSwipe</td>
					<td align="left" valign="middle">
					<?php $target_photoswipe_captionAndToolbarHideOnSwipe = $boxersandswipers_photoswipe[captionAndToolbarHideOnSwipe]; ?>
					<select id="boxersandswipers_photoswipe_captionAndToolbarHideOnSwipe" name="boxersandswipers_photoswipe_captionAndToolbarHideOnSwipe">
						<option <?php if ('true' == $target_photoswipe_captionAndToolbarHideOnSwipe)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_captionAndToolbarHideOnSwipe)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">captionAndToolbarFlipPosition</td>
					<td align="left" valign="middle">
					<?php $target_photoswipe_captionAndToolbarFlipPosition = $boxersandswipers_photoswipe[captionAndToolbarFlipPosition]; ?>
					<select id="boxersandswipers_photoswipe_captionAndToolbarFlipPosition" name="boxersandswipers_photoswipe_captionAndToolbarFlipPosition">
						<option <?php if ('true' == $target_photoswipe_captionAndToolbarFlipPosition)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_captionAndToolbarFlipPosition)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">captionAndToolbarAutoHideDelay</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_captionAndToolbarAutoHideDelay" name="boxersandswipers_photoswipe_captionAndToolbarAutoHideDelay" value="<?php echo $boxersandswipers_photoswipe[captionAndToolbarAutoHideDelay] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">captionAndToolbarOpacity</td>
					<td align="left" valign="middle">
						<input type="text" id="boxersandswipers_photoswipe_captionAndToolbarOpacity" name="boxersandswipers_photoswipe_captionAndToolbarOpacity" value="<?php echo $boxersandswipers_photoswipe[captionAndToolbarOpacity] ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="middle">captionAndToolbarShowEmptyCaptions</td>
					<td align="left" valign="middle">
					<?php $target_photoswipe_captionAndToolbarShowEmptyCaptions = $boxersandswipers_photoswipe[captionAndToolbarShowEmptyCaptions]; ?>
					<select id="boxersandswipers_photoswipe_captionAndToolbarShowEmptyCaptions" name="boxersandswipers_photoswipe_captionAndToolbarShowEmptyCaptions">
						<option <?php if ('true' == $target_photoswipe_captionAndToolbarShowEmptyCaptions)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_captionAndToolbarShowEmptyCaptions)echo 'selected="selected"'; ?>>false</option>
					</td>
				</tr>
			</tbody>
			</table>

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

		</div>
	  </div>
	  <div id="tabs-7">
		<div class="wrap">
			<h2>swipebox&nbsp<?php _e('Settings'); ?>(<a href="http://brutaldesign.github.io/swipebox/" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</h2>	

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

			<table>
			<tbody>
				<tr>
					<td align="center" valign="middle">hideBarsDelay</td>
					<td align="center" valign="middle">
						<input type="text" id="boxersandswipers_swipebox_hideBarsDelay" name="boxersandswipers_swipebox_hideBarsDelay" value="<?php echo $boxersandswipers_swipebox[hideBarsDelay] ?>" />
					</td>
				</tr>
			</tbody>
			</table>

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

		</div>
	  </div>

	<!--
	  <div id="tabs-8">
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

		$posttypes = $this->search_posttype();

		$apply_tbl = array();
		foreach ( $posttypes as $key => $value ) {
			$apply_tbl[$key][pc] = $_POST['boxersandswipers_apply_pc'][$key];
			$apply_tbl[$key][tb] = $_POST['boxersandswipers_apply_tb'][$key];
			$apply_tbl[$key][sp] = $_POST['boxersandswipers_apply_sp'][$key];
			unset($posttypes[$key]);
		}
		update_option( 'boxersandswipers_apply', $apply_tbl );

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
						'speed' => intval($_POST['boxersandswipers_colorbox_speed']),
						'title' => $_POST['boxersandswipers_colorbox_title'],
						'rel' => 'grouped',
						'scalePhotos' => $_POST['boxersandswipers_colorbox_scalePhotos'],
						'scrolling' => $_POST['boxersandswipers_colorbox_scrolling'],
						'opacity' => floatval($_POST['boxersandswipers_colorbox_opacity']),
						'open' => $_POST['boxersandswipers_colorbox_open'],
						'returnFocus' => $_POST['boxersandswipers_colorbox_returnFocus'],
						'trapFocus' => $_POST['boxersandswipers_colorbox_trapFocus'],
						'fastIframe' => $_POST['boxersandswipers_colorbox_fastIframe'],
						'preloading' => $_POST['boxersandswipers_colorbox_preloading'],
						'overlayClose' => $_POST['boxersandswipers_colorbox_overlayClose'],
						'escKey' => $_POST['boxersandswipers_colorbox_escKey'],
						'arrowKey' => $_POST['boxersandswipers_colorbox_arrowKey'],
						'loop' => $_POST['boxersandswipers_colorbox_loop'],
						'fadeOut' => intval($_POST['boxersandswipers_colorbox_fadeOut']),
						'closeButton' => $_POST['boxersandswipers_colorbox_closeButton'],
						'current' => $_POST['boxersandswipers_colorbox_current'],
						'previous' => $_POST['boxersandswipers_colorbox_previous'],
						'next' => $_POST['boxersandswipers_colorbox_next'],
						'close' => $_POST['boxersandswipers_colorbox_close'],
						'width' => $_POST['boxersandswipers_colorbox_width'],
						'height' => $_POST['boxersandswipers_colorbox_height'],
						'innerWidth' => $_POST['boxersandswipers_colorbox_innerWidth'],
						'innerHeight' => $_POST['boxersandswipers_colorbox_innerHeight'],
						'initialWidth' => intval($_POST['boxersandswipers_colorbox_initialWidth']),
						'initialHeight' => intval($_POST['boxersandswipers_colorbox_initialHeight']),
						'maxWidth' => $_POST['boxersandswipers_colorbox_maxWidth'],
						'maxHeight' => $_POST['boxersandswipers_colorbox_maxHeight'],
						'slideshow' => $_POST['boxersandswipers_colorbox_slideshow'],
						'slideshowSpeed' => intval($_POST['boxersandswipers_colorbox_slideshowSpeed']),
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
						'overlayOpacity' => floatval($_POST['boxersandswipers_slimbox_overlayOpacity']),
						'overlayFadeDuration' => intval($_POST['boxersandswipers_slimbox_overlayFadeDuration']),
						'resizeDuration' => intval($_POST['boxersandswipers_slimbox_resizeDuration']),
						'resizeEasing' => $_POST['boxersandswipers_slimbox_resizeEasing'],
						'initialWidth' => intval($_POST['boxersandswipers_slimbox_initialWidth']),
						'initialHeight' => intval($_POST['boxersandswipers_slimbox_initialHeight']),
						'imageFadeDuration' => intval($_POST['boxersandswipers_slimbox_imageFadeDuration']),
						'captionAnimationDuration' => intval($_POST['boxersandswipers_slimbox_captionAnimationDuration']),
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

		$imagelightbox_tbl = array(
							'animationSpeed' => intval($_POST['boxersandswipers_imagelightbox_animationSpeed']),
							'preloadNext' => $_POST['boxersandswipers_imagelightbox_preloadNext'],
							'enableKeyboard' => $_POST['boxersandswipers_imagelightbox_enableKeyboard'],
							'quitOnEnd' => $_POST['boxersandswipers_imagelightbox_quitOnEnd'],
							'quitOnImgClick' => $_POST['boxersandswipers_imagelightbox_quitOnImgClick'],
							'quitOnDocClick' => $_POST['boxersandswipers_imagelightbox_quitOnDocClick']
						);
		update_option( 'boxersandswipers_imagelightbox', $imagelightbox_tbl );

		$photoswipe_tbl = array(
						'fadeInSpeed' => intval($_POST['boxersandswipers_photoswipe_fadeInSpeed']),
						'fadeOutSpeed' => intval($_POST['boxersandswipers_photoswipe_fadeOutSpeed']),
						'slideSpeed' => intval($_POST['boxersandswipers_photoswipe_slideSpeed']),
						'swipeThreshold' => intval($_POST['boxersandswipers_photoswipe_swipeThreshold']),
						'swipeTimeThreshold' => intval($_POST['boxersandswipers_photoswipe_swipeTimeThreshold']),
						'loop' => $_POST['boxersandswipers_photoswipe_loop'],
						'slideshowDelay' => intval($_POST['boxersandswipers_photoswipe_slideshowDelay']),
						'imageScaleMethod' => $_POST['boxersandswipers_photoswipe_imageScaleMethod'],
						'preventHide' => $_POST['boxersandswipers_photoswipe_preventHide'],
						'backButtonHideEnabled' => $_POST['boxersandswipers_photoswipe_backButtonHideEnabled'],
						'captionAndToolbarHide' => $_POST['boxersandswipers_photoswipe_captionAndToolbarHide'],
						'captionAndToolbarHideOnSwipe' => $_POST['boxersandswipers_photoswipe_captionAndToolbarHideOnSwipe'],
						'captionAndToolbarFlipPosition' => $_POST['boxersandswipers_photoswipe_captionAndToolbarFlipPosition'],
						'captionAndToolbarAutoHideDelay' => intval($_POST['boxersandswipers_photoswipe_captionAndToolbarAutoHideDelay']),
						'captionAndToolbarOpacity' => floatval($_POST['boxersandswipers_photoswipe_captionAndToolbarOpacity']),
						'captionAndToolbarShowEmptyCaptions' => $_POST['boxersandswipers_photoswipe_captionAndToolbarShowEmptyCaptions']
						);
		update_option( 'boxersandswipers_photoswipe', $photoswipe_tbl );

		$swipebox_tbl = array(
						'hideBarsDelay' => intval($_POST['boxersandswipers_swipebox_hideBarsDelay'])
						);
		update_option( 'boxersandswipers_swipebox', $swipebox_tbl );

	}

	/* ==================================================
	 * Update wp_options table.
	 * @since	1.14
	 */
	function search_posttype(){

		$args = array(
		   'public'   => true,
		   '_builtin' => false
		);
		$custom_post_types = get_post_types( $args, 'objects', 'and' ); 
		foreach ( $custom_post_types as $post_type ) {
			$posttypes[$post_type->name] = $post_type->label;
		}

		$posttypes[post] = __('Posts');
		$posttypes[page] = __('Pages');
		$posttypes[home] = __('Home');
		$posttypes[gallery] = __('Gallery');
		$posttypes[category] = __('Categories');
		$posttypes[archive] = __('Archives');

		return $posttypes;

	}

}

?>