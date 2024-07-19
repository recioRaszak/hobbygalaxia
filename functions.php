<?php 
add_filter( 'image_size_names_choose', function() {
	return [
		'thumbnail'    => __( 'Thumbnail', 'textdomain' ),
		'medium'       => __( 'Medium', 'textdomain' ),
		'medium_large' => __( 'Medium Large', 'textdomain' ),
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