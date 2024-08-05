<?php 

function massive_update_posts() {
	if ( is_admin() && isset( $_GET['massiveupdate']) ) {

		$paged = ( $_GET['massiveupdate'] ) ? $_GET['massiveupdate'] : 1;

		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => 100,
			'paged' => $paged,
		);

		$the_query = new WP_Query($args);

		if ($the_query->have_posts()) :
			echo '<div style="position:absolute;left:0;top:0;width:100%;background:#fff;z-index:9999;padding:100px;">';

			while ($the_query->have_posts()) : $the_query->the_post();
				$url_image_A = get_field('url_eterna_img');
				//$url_image_B = get_field('url_eterna_img_copiar');
				if ( $url_image_A && $url_image_A != "" ) {
				//https://cloud10.todocoleccion.online/postales-cataluna/tc/2022/12/01/17/378914464.jpg
				$url_image_A_split = explode('/', $url_image_A);
				//$url_image_A_split[9]
				$url_image_B_replace = "https://hobbygalaxia.b-cdn.net/tc_pics/".$url_image_A_split[9];
					echo "<hr>";
					update_field('url_eterna_img_copiar', $url_image_B_replace , get_the_ID());
					echo 'ID: '. get_the_ID().'<br>tO:<br>'.$url_image_B_replace;
					echo "<hr>";
				}

			endwhile;
			echo "</div>";

			wp_reset_postdata();
		endif;
	}
}

add_action( 'admin_init', 'massive_update_posts' );
//add_action('acf/init', 'massive_update_posts');



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

function footerInlineScript() 
	{
		?>
		<script>
			jQuery(document).ready(function($) {

				function provisionalImages() {
					$('img.woocommerce-placeholder').each(function() {
						const thisImg = $(this);
						
						const productLI = $(thisImg).parents('li');
						const picURL = $(productLI).find('input[name="old_photo_url"]').val();
						if (picURL!='Undefined' && picURL!='') {
						console.log('URL: '+picURL);
						$(thisImg).removeAttr('srcset');
						$(thisImg).removeAttr('data-src');
						$(thisImg).removeAttr('data-srcset');
						$(thisImg).removeAttr('data-sizes');
						$(thisImg).attr('src', picURL);

						}

					})
				}
				setTimeout(provisionalImages,1000);
			});
			
		</script>
		<?php

	}
	add_action('wp_footer', 'footerInlineScript');





	/*
	add_action('acf/init', 'custom_code');

function custom_code() {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'mycptype'
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
            $testa = get_field('br_type');
            $testb = get_field('br_category');
            if ($testa === 'Apples') {
                update_field('br_featured', '0', get_the_ID());
            }
        endwhile;
        wp_reset_postdata();
    endif;
}
	*/



	function print_child_terms($parent_term, $max_items = -1) {
		$child_terms = get_terms(array(
			'taxonomy' => 'product_cat',
			'parent' => $parent_term->term_id,
			'hide_empty' => false,
			'number' => $max_items
		));
	
		if (!empty($child_terms) && !is_wp_error($child_terms)) {
			echo '<ul>';
			foreach ($child_terms as $term) {
				$term_link = get_term_link($term);
				echo '<li><a href="' . esc_url($term_link) . '">' . esc_html($term->name) . '</a></li>';
			}
			echo '</ul>';
		}
	}
/* USAGE IN BLOCKS
	$parent_term = get_term_by('slug', 'your-parent-category-slug', 'product_cat');
if ($parent_term) {
    print_child_terms($parent_term, 5); // Print up to 5 child terms
}
	*/

	