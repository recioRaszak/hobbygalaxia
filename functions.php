<?php

function massive_update_posts()
{
	if (is_admin() && isset($_GET['massiveupdate'])) {

		$paged = ($_GET['massiveupdate']) ? $_GET['massiveupdate'] : 1;

		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 100,
			'paged' => $paged,
		);

		$the_query = new WP_Query($args);

		if ($the_query->have_posts()):
			echo '<div style="position:absolute;left:0;top:0;width:100%;background:#fff;z-index:9999;padding:100px;">';

			while ($the_query->have_posts()):
				$the_query->the_post();
				$url_image_A = get_field('url_eterna_img');
				//$url_image_B = get_field('url_eterna_img_copiar');
				if ($url_image_A && $url_image_A != "") {
					//https://cloud10.todocoleccion.online/postales-cataluna/tc/2022/12/01/17/378914464.jpg
					$url_image_A_split = explode('/', $url_image_A);
					//$url_image_A_split[9]
					$url_image_B_replace = "https://hobbygalaxia.b-cdn.net/tc_pics/" . $url_image_A_split[9];
					echo "<hr>";
					update_field('url_eterna_img_copiar', $url_image_B_replace, get_the_ID());
					echo 'ID: ' . get_the_ID() . '<br>tO:<br>' . $url_image_B_replace;
					echo "<hr>";
				}

			endwhile;
			echo "</div>";

			wp_reset_postdata();
		endif;
	}
}

add_action('admin_init', 'massive_update_posts');
//add_action('acf/init', 'massive_update_posts');

function hobbyGalaxiaStyles()
{
	wp_enqueue_style('hobbyGalaxiaStyles', get_stylesheet_directory_uri() . '/hobbygalaxia.css');
}

add_action('wp_enqueue_scripts', 'hobbyGalaxiaStyles');

add_filter('image_size_names_choose', function () {
	return [
		'thumbnail' => __('Thumbnail', 'textdomain'),
		'medium' => __('Medium', 'textdomain'),
		'large' => __('Large', 'textdomain'),
		'full' => __('Full Size', 'textdomain'),
	];
});

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


add_filter('woocommerce_get_image_size_woocommerce_single', function ($size) {
	return 'medium';
});

add_filter('woocommerce_gallery_thumbnail_size', function ($size) {
	return array(
		'width' => 150,
		'height' => 150,
		'crop' => 1,
	);
});

add_filter('woocommerce_thumbnail_size', function ($size) {
	return 'thumbnail';
});

/**
 * Function to return new placeholder image URL.
 */
function growdev_custom_woocommerce_placeholder( $image_url ) {
	$image_url = 'https://hobbygalaxia.b-cdn.net/hobbygalaxia-image-placeholder.png';  // change this to the URL to your custom placeholder
	return $image_url;
}
add_filter( 'woocommerce_placeholder_img_src', 'growdev_custom_woocommerce_placeholder', 10 );


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
add_action('pre_get_posts', 'rc_modify_query_product');

// Create a function to excplude some categories from the main query
function rc_modify_query_product($query)
{

	// Check if on frontend and main query is modified
	if (!is_admin() && $query->get_post_type() == 'product') {
		$query->set('posts_per_page', '50');
	} // end if
}

// enable acf shortcodes

add_action('acf/init', 'set_acf_settings');
function set_acf_settings()
{
	acf_update_setting('enable_shortcode', true);
}

function footerInlineScript()
{
	?>
	<script>
		jQuery(document).ready(function ($) {

			function provisionalImages() {
				$("img").bind("error", function (e) { 
					var $this = $(this); 
					$(this).addClass("error"); 
				}); 
				$('img.woocommerce-placeholder,img.failedtoload,img.error').each(function () {
					const thisImg = $(this);

					const productLI = $(thisImg).parents('li');
					const picURL = $(productLI).find('input[name="old_photo_url"]').val();
					if (picURL != 'Undefined' && picURL != '') {
						console.log('URL: ' + picURL);
						$(thisImg).removeAttr('srcset');
						$(thisImg).removeAttr('data-src');
						$(thisImg).removeAttr('data-srcset');
						$(thisImg).removeAttr('data-sizes');
						$(thisImg).attr('src', picURL);
						$(thisImg).removeClass('error');

					}

				})
			}
			setTimeout(provisionalImages, 1000);

			document.addEventListener('facetwp-loaded', function () {
				function FWPprovisionalImages() {
					$("img").bind("error", function (e) { 
						var $this = $(this); 
						$(this).addClass("error"); 
					}); 
					$('img.woocommerce-placeholder,img.failedtoload,img.error').each(function () {
						const thisImg = $(this);

						const productLI = $(thisImg).parents('li');
						const picURL = $(productLI).find('input[name="old_photo_url"]').val();
						if (picURL != 'Undefined' && picURL != '') {
							console.log('URL: ' + picURL);
							$(thisImg).removeAttr('srcset');
							$(thisImg).removeAttr('data-src');
							$(thisImg).removeAttr('data-srcset');
							$(thisImg).removeAttr('data-sizes');
							$(thisImg).attr('src', picURL);
							$(thisImg).removeClass('error');
						}

					})
				}
				FWPprovisionalImages();
			});

			<?php
			if ( is_singular('product') ) {
				$product_postid = get_the_ID();
				$external_image_url = get_field('url_eterna_img', $product_postid);
				?>
				function singleProductFixImage() {
				$('.woocommerce-product-gallery__image--placeholder img').removeClass('lazy').removeAttr('data-src');
				$('.woocommerce-product-gallery__image img.error').attr('src','<?php echo $external_image_url;?>').addClass('fixed');
				$('img.fixed').removeClass('error');
				}
				setTimeout(singleProductFixImage, 500);
				<?php
			}
			?>

			<?php if ( is_page('wishlist') || is_page('favoritos') || is_page('mis-favoritos') || is_page('my-wishlists')
			|| is_page('lista-de-deseos') || is_page('listas-de-deseos') || is_page('mis-listas-de-deseos')
			) { ?>
		console.log('es pagina favoritos	');
				if ( $('*[data-fw-wishlist-id]').length || $('*[data-fw-item-id]').length ) {
					$('body').addClass('wishlist-page');
					console.log('hay tabla de favoritos');
				}
				$('.wishlist-page .entry-content .woocommerce').after('<div class="woocommerce-user-tabs-ui woocommerce-account alignwide hidden"></div>');

				let wishlistTable = $('.wishlist-page .entry-content .woocommerce').html();
				$('.wishlist-page .entry-content .woocommerce').remove();

				$('.woocommerce-user-tabs-ui').load('<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?> .entry-content > .alignwide', function(){
					$('.woocommerce-user-tabs-ui .woocommerce-MyAccount-content p').remove();
					$(wishlistTable).appendTo('.woocommerce-user-tabs-ui .woocommerce-MyAccount-content').addClass('wishlist-cloned-inside');
					$('.woocommerce-user-tabs-ui').removeClass('hidden');
					$('.woocommerce-MyAccount-content button').addClass('wp-element-button');
					$('.woocommerce-MyAccount-navigation-link--dashboard').removeClass('is-active');
					$('.woocommerce-MyAccount-navigation-link--fw-wishlist').addClass('is-active');
				});



			<?php
			}
			?>

		});

	</script>
	<?php
}
add_action('wp_footer', 'footerInlineScript');

if ( is_page('wishlist') || is_page('favoritos') || is_page('mis-favoritos') || is_page('my-wishlists')
			|| is_page('lista-de-deseos') || is_page('listas-de-deseos') || is_page('mis-listas-de-deseos')
			) { ?>
<script src="<?php get_bloginfo('url'); ?>/wp-content/plugins/flexible-wishlist/assets/js/front.js"></script>

<?php }




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



function print_child_terms($parent_term, $max_items = 999, $more = true)
{
	$child_terms = get_terms(
		array(
			'taxonomy' => 'product_cat',
			'parent' => $parent_term->term_id,
			'hide_empty' => false,
			'number' => $max_items
		)
	);

	if (!empty($child_terms) && !is_wp_error($child_terms)) {
		echo '<ul class="product-subcats">';
		foreach ($child_terms as $term) {
			$term_link = get_term_link($term);
			echo '<li><a href="' . esc_url($term_link) . '">' . esc_html($term->name) . '</a></li>';
		}
		echo '</ul>';
		
		if ($more) echo '<div class="viewall-link" style="font-size:0.8rem"><a href="' . get_term_link($parent_term) . '">' . __("Ver todo", "hobbygalaxia") . '&nbsp;<span>→</span></a></div>';
	}
}
/* USAGE IN BLOCKS
	$parent_term = get_term_by('slug', 'your-parent-category-slug', 'product_cat');
if ($parent_term) {
	print_child_terms($parent_term, 5); // Print up to 5 child terms
}
	*/


add_filter('facetwp_is_main_query', function ($is_main_query, $query) {
	if (true !== $query->get('facetwp', false)) {
		$is_main_query = false;
	}
	return $is_main_query;
}, 10, 2);

/** removes the parentheses () from facet counts. Could also be used to replace with alternate bracketing or other output **/

add_filter('facetwp_facet_html', function ($output, $params) {
	if ('categories' == $params['facet']['name']) {
		$output = preg_replace('/\(|\)|\[|\]/', '', $output);
		$output = str_replace('[', '', $output);
		$output = str_replace(']', '', $output);
	}
	return $output;
}, 10, 2);



// Hierarchical Checkboxes Facet Accordion with 'opened' class for facet-expand icons for custom CSS styling of opened and closed parents
// Add to your (child)( theme's functions.php

// Adds an 'opened' class to facet-expand of an opened parent.
// Closes other parents on same level on click of a parent
// Also works when the initial page load is with a child selected, causing the parent to be 'opened'.
// The style part is just for demonstration. Use the selectors to style the facetwp-expand icons.

add_action('wp_footer', function () { ?>

	<script>
		(function ($) {

			function focusSearch() {
				$('input.facetwp-search').focus();
			}

			$('[data-toggle="#categorias"]').on('click', function () {
				$('#buscador"]').css('display','none');
			});
			$('[data-toggle="#buscador"]').on('click', function () {
				$('#categorias').css('display','none');
			});

			$('.buscador-button').on('click', function () {
				setTimeout(focusSearch,500);
			});

			// Accordion part 1: toggle 'opened' class on click of icons and close other parents on the same level
			$(document).on('click', '.facetwp-type-checkboxes .facetwp-expand', function (e) {
				$(this).toggleClass('opened');
				$(this).closest('.facetwp-checkbox').siblings('.facetwp-checkbox').each(function () {
					$(this).next('.facetwp-depth').removeClass('visible');
					$(this).children('.facetwp-expand').removeClass('opened');
				});
				e.stopPropagation();
			});

			// Accordion part 2: if on first pageload a child is already selected, parent needs a 'opened' class
			$(document).on('facetwp-loaded', function () {
				FWP.hooks.addAction('facetwp/loaded', function () {
					$('.facetwp-type-checkboxes .facetwp-depth').each(function () {
						if ($(this).hasClass('visible')) {
							$(this).prev('.facetwp-checkbox').children('.facetwp-expand').addClass('opened');
						}
					});
				});
			});
		})(jQuery);

	</script>
<?php });


add_action('facetwp_scripts', function () {
	?>
	<script>
		document.addEventListener('facetwp-loaded', function () {
			provisionalImages();
		});
	</script>
	<?php
}, 100);

add_action( 'wp_head', function() {
	?>
	<style>
	  .facetwp-template { 
		opacity:0;
		transition:1s;
	  }
	  .facetwp-template.visible { 
		opacity:1; 
	  }
	</style>
	<?php
  }, 100 );

  add_action( 'facetwp_scripts', function() {
	?>
	<script>
	  document.addEventListener('facetwp-loaded', function() {    
		// Add class 'visible' after refresh, but not on the first page load
		if ( FWP.loaded ) {
		  fUtil('.facetwp-template').addClass('visible');
		  fUtil('.facetwp-reset').addClass('wp-element-button');
		}
	  });
	  
	</script>
	<?php
  }, 100 );


  add_filter( 'facetwp_shortcode_html', function( $output, $atts ) {
	if ( 
		( isset( $atts['facet'] ) && 'reset' == $atts['facet'] ) || 
		( isset( $atts['facet'] ) && 'facetwp-reset' == $atts['facet'] )
	) { // Change "my_facet_name" to the name of your facet
	  $output = str_replace( 'facetwp-reset', 'facetwp-reset wp-element-button ', $output );  // Change "my_facet_name" to the name of your facet and "my-class" to the name of your custom class.
	  // Change "my_facet_name" to the name of your facet and "my-class" to the name of your custom class.
	}
	return $output;
  }, 10, 2 );
  



/**
 * Change number of related products output
 */ 
function woo_related_products_limit() {
	global $product;
	  
	  $args['posts_per_page'] = 15;
	  return $args;
  }
  add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
	function jk_related_products_args( $args ) {
	  $args['posts_per_page'] = 15; // 4 related products
	  //$args['columns'] = 2; // arranged in 2 columns
	  return $args;
  }


















add_action('admin_head', 'adminStyles');

function adminStyles()
{
	echo '<style>
    .categorydiv div.tabs-panel, 
	.customlinkdiv div.tabs-panel, 
	.posttypediv div.tabs-panel, 
	.taxonomydiv div.tabs-panel, 
	.wp-tab-panel {
  max-height: 68vh!important;
  </style>';
}