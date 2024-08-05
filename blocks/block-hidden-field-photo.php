<?php if ( function_exists('get_field') ) { 
    $post_ID =get_the_ID(); ?>
<input data-id="<?= $post_ID;?>" type="hidden" value="<?php echo get_field('url_eterna_img_copiar',$post_ID ); ?>" name="old_photo_url"/>
<?php }