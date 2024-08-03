<?php 
add_filter( 'image_size_names_choose', function() {
	return [
		'thumbnail'    => __( 'Thumbnail', 'textdomain' ),
		'medium'       => __( 'Medium', 'textdomain' ),
		'large'        => __( 'Large', 'textdomain' ),
		'full'         => __( 'Full Size', 'textdomain' ),
	];
} );

/*
    T	thumbnail	400x300	
    M	medium	1024x768	
    ML	medium_large	768x0	
    L	large	1500x1500	
    W1	1536x1536	1536x1536	
    W2	2048x2048	2048x2048	
    WO	woocommerce_thumbnail	300x300	
    WO	woocommerce_single	                600x0	
    WO	woocommerce_gallery_thumbnail	100x100
*/


 add_filter( 'woocommerce_get_image_size_woocommerce_single', function( $size ) {
	return 'medium';
} );

 add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
    return array(
		'width' => 150,
		'height' => 150,
		'crop' => 1,
		);
	} );

add_filter( 'woocommerce_thumbnail_size', function( $size ) {
    return 'thumbnail';
} );
/*


function cc_mime_types($mimes) {
	$mimes['xla|xls|xlt|xlw'] = 'application/vnd.ms-excel';
	$mimes['json'] = 'application/json';
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');


/*
function external_mediaurl($wp_get_attachment_url){
	$external_mediadir = 'https://cachitoswp.com/hobbygalaxia_uploads/';
	$filename = basename($wp_get_attachment_url );
	$newurl = $external_mediadir.$filename;
	if (!is_admin() ) {
		
		return $newurl;
	} else {
		return $wp_get_attachment_url;
	}
}
add_filter('wp_get_attachment_url', 'external_mediaurl');
*/



// Load our function when hook is set
add_action( 'pre_get_posts', 'rc_modify_query_product' );

// Create a function to excplude some categories from the main query
function rc_modify_query_product( $query ) {

	// Check if on frontend and main query is modified
	if ( ! is_admin() && $query->get_post_type() == 'product') {
        $query->set( 'posts_per_page', '40' );
    } // end if
}

// enable acf shortcodes

add_action( 'acf/init', 'set_acf_settings' );
function set_acf_settings() {
    acf_update_setting( 'enable_shortcode', true );
}
