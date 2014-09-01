<?php

	//if uninstall not called from WordPress exit
	if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
	    exit();

	$option_names = array(
						'boxersandswipers_apply',
						'boxersandswipers_apply_archive',
						'boxersandswipers_apply_category',
						'boxersandswipers_apply_gallery',
						'boxersandswipers_apply_home',
						'boxersandswipers_apply_pages',
						'boxersandswipers_apply_posts',
						'boxersandswipers_colorbox',
						'boxersandswipers_effect',
						'boxersandswipers_imagelightbox',
						'boxersandswipers_nivolightbox',
						'boxersandswipers_photoswipe',
						'boxersandswipers_slimbox',
						'boxersandswipers_swipebox',
						'boxersandswipers_useragent'
					);

	$args = array(
				'post_type' => 'any',
				'numberposts' => -1
			);
	$allposts = get_posts($args);

	// For Single site
	if ( !is_multisite() ) {
		foreach( $option_names as $option_name ) {
		    delete_option( $option_name );
		}
		foreach( $allposts as $postinfo ) {
			delete_post_meta( $postinfo->ID, 'boxersandswipers_exclude' );
		}
	} else {
	// For Multisite
	    // For regular options.
	    global $wpdb;
	    $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
	    $original_blog_id = get_current_blog_id();
	    foreach ( $blog_ids as $blog_id ) {
	        switch_to_blog( $blog_id );
			foreach( $option_names as $option_name ) {
			    delete_option( $option_name );
			}
			foreach( $allposts as $postinfo ) {
				delete_post_meta( $postinfo->ID, 'boxersandswipers_exclude' );
			}
	    }
	    switch_to_blog( $original_blog_id );

	    // For site options.
		foreach( $option_names as $option_name ) {
		    delete_site_option( $option_name );  
		}
		foreach( $allposts as $postinfo ) {
			delete_post_meta( $postinfo->ID, 'boxersandswipers_exclude' );
		}
	}

?>
