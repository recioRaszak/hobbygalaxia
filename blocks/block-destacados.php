<style>
    .myfeaturedposts {
        list-style: none;
        gap:10px;
        padding:0;
        flex-direction:column;
    }

    @media(min-width:640px) {
        .myfeaturedposts {
            flex-direction:row;
        }
    }

    .myfeaturedposts img,
    .myfeaturedpost img {
        width:auto;
        max-width:250%;
        margin:0;
        height:auto;
        min-height:100%;
        position:absolute;
        left:50%;
        top:50%;
        transform:translate(-50%, -50%);
        z-index:1;
    }
/*
    .myfeaturedpost {
        display:inline-block;
        width:45%;
    }
        
    @media(min-width:1024px) {
        .myfeaturedpost {
            width:30%;
        }
    }
        */

    
    .postcard {
        position:relative;
        overflow:hidden;
        border-radius:5px;
        height:100%;
        width:100%;
        display:flex;
        flex-direction:column;
        justify-content:flex-end;
        align-items:flex-start;
        box-sizing:border-box;
        padding:0;
        margin:0;
        min-height:65vh;

    }
    .postcard--image {
        position:relative;
        z-index:1;
        width:100%;
        height:100%;
        overflow:hidden;
        display:flex;
        justify-content:center;
        align-items:center;
        box-sizing:border-box;
    }

    .postcard--content {
        position:absolute;
        z-index:3;left:0;bottom:0;width:100%;padding:40px 20px 20px 20px;
        box-sizing: border-box;
        background:linear-gradient(180deg,rgba(0,0,0,0) 0%,rgba(0,0,0,0.3) 20%,rgba(0,0,0,1) 100%);
    
    }
    .postcard--title {
        font-size:1.2rem;
        font-weight:bold;
    }
    .postcard--excerpt p {    
        color:#fff;
        margin:10px 0 0 0;
        font-size:0.9rem;
    }

</style>

<?php
    $block_config = block_config();
    
    $randnum = rand(1, 9); // random number for cache busting
    //echo "<pre>".print_r($block_config,true)."</pre>";

    $post_type = block_value('post_type');
    $fuente =    block_value('fuente'); // latest / realationship
    $count =     block_value('count'); // number of posts to display
    $slider =    block_value('slider'); // true / false

    $wrapper_cls = " wp-block-columns alignwide columnas-cats is-layout-flex wp-container-core-columns-is-layout-1 wp-block-columns-is-layout-flex ";
    $items_cls = " myfeaturedpost wp-block-column is-layout-flow wp-block-column-is-layout-flow ";
    $slick_attr = "";
    $item_attr = "";

    if ($slider || $slider==1) {
        /*
        $wrapper_cls = " wp-block-gb-for-slick-slider-slick-slider slick-slider"; // wp-block-gb-for-slick-slider-slick-slider slick-initialized slick-slider
        */
        $slick_attr = " data-slick=\"{'dots':true,'arrows':true,'slidesToShow':3,'slidesToScroll':1,'infinite':true,'adaptiveHeight':true,'autoplay':false,'autoplaySpeed':1500,'fade':false,'speed':1000,'centerMode':true,'responsive': [{'breakpoint':1280,'settings':{'slidesToShow':3,'slidesToScroll':1,'arrows':true,'dots':true}},{'breakpoint':640,'settings':{'slidesToShow':2,'slidesToScroll':1,'arrows':true,'dots':true}}]}\" ";
        /*
        $items_cls = " myfeaturedpost wp-block-gb-for-slick-slider-slick-slider-item is-layout-flow wp-block-slick-slider-item-is-layout-flow ";
        $item_attr =' style="margin-right:0px;margin-left:0px" ';
        */
    }

    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => $count,
        'order' => 'DESC',
        'orderby' => 'date',
    );

    query_posts($args);

    if (have_posts()) {
        
        ?>
        <section class="genesis-custom-block my-featured-posts" style="max-width:var(--wp--style--global--wide-size);">
        <ul  style="max-width:var(--wp--style--global--wide-size);" class="myfeaturedposts myfeaturedposts--<?php echo $randnum; ?> <?php echo  $wrapper_cls; ?>"  >
            <?php while ( have_posts() ) {
                the_post();
               ?>
                <li class="<?php echo  $items_cls; ?>" <?php echo  $item_attr; ?> >
                    <a href="<?php the_permalink();?>" class="postcard" style="display:block;overflow:hidden;position:relative;z-index:1;">
                        <?php the_post_thumbnail('medium', array('class' => 'post-thumbb')); ?>
                        <div class="postcard--content" style="">
                            <h3  class="postcard--title" style="margin:0;color:#fff"><?php the_title();?></h3>
                            <div class="postcard--excerpt">
                                <?php the_excerpt('30');?>
                                <p><?php echo __('Leer más','hobbygalaxia');?> →</p>
                            </div>   
                        </div>
                    </a>
                </li>
            <?php }
            ?>
        </ul>
        </section>
        <?php
    }
    wp_reset_postdata();

    function slick_script() {
        echo "<script>
            jQuery(document).ready(function($){
                $('.myfeaturedposts').slick({
                    'dots':true,
                    'arrows':true,
                    'infinite':true,
                    'adaptiveHeight':false,
                    'autoplay':false,
                    'autoplaySpeed':1500,
                    'fade':false,
                    'speed':1000,
                    'slidesToShow':3,
                    'slidesToScroll':3,
                    'centerMode':true,
                    'responsive': [
                        {'breakpoint':1280,'settings':{'slidesToShow':3,'slidesToScroll':1,'arrows':true,'dots':true}},
                        {'breakpoint':640,'settings':{'slidesToShow':2,'slidesToScroll':1,'arrows':true,'dots':true}}
                    ]
                });
            });
        </script>";
    }
    if ( $slider==1 || $slider ) {
        add_action('wp_footer','slick_script',999);
    }
    