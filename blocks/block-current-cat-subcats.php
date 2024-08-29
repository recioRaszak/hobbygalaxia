<style>
    .current-cat-subcats {
        overflow:hidden;
        transition:2s;
        max-height:9999px;
        position:relative;
    }

    .current-cat-subcats.somesubcats {
        max-height:120px;
        padding-bottom:40px;
    }
    .current-cat-subcats.somesubcats::after {
        content:"(...)";
        position:absolute;
        left:0;
        bottom:-5px;
    }

    .current-cat-subcats .product-subcats {
    margin-left:0;
    padding-left:0;
    font-size:12px;

}
.current-cat-subcats--title {
    font-size:1.1rem;
    margin:0 0 20px 0;
}
@media(min-width:1024px) {
    .current-cat-subcats .product-subcats {
        font-size:14px;
    }
    .current-cat-subcats--title {
        font-size:1.2rem;
    }
}
.current-cat-subcats .product-subcats li {
    list-style:none;
    display:inline;
}
.current-cat-subcats .product-subcats li a {
    display:inline-block;
    padding:5px 30px;
    background:transparent;
    text-decoration:none;
    border:2px solid;
    line-height:1.2;
    margin:0 5px 10px 0;
}

.current-cat-subcats .product-subcats li a:hover {
    background:var(--wp--preset--color--foreground);
    color:#fff;
}
</style>
<?php
if ( is_tax() ) {
    $qobjct = get_queried_object();
    if ($qobjct) {
        echo "<section class='genesis-custom-block current-cat-subcats' style='max-width:var(--wp--style--global--wide-size);'>";
        echo "<h2 class='current-cat-subcats--title'>".__("Subcategorias", "hobbygalaxia")."</h2>";
        print_child_terms($qobjct, 999, false);
        echo "</section>"; // Print up to 5 child terms
        echo "<p class='product-subcats-showall hidden' style='cursor:pointer;margin-bottom:30px;text-decoration:underline;max-width:var(--wp--style--global--wide-size);'><strong>+ ".__("Mostrar más subcategorías", "hobbygalaxia")."</strong></p>";
       
        ?>
        <script>
            jQuery(document).ready(function($){
                const subcats = $('.current-cat-subcats .product-subcats li');
                if ( !subcats.length ) {
                    $('.current-cat-subcats--title').remove();
                }
                if ( subcats.length > 8 ) {
                   $('.current-cat-subcats').addClass('somesubcats');
                   $('.product-subcats-showall').removeClass('hidden');
                }
                $('.product-subcats-showall').on('click', function(e) {
                    e.preventDefault();
                    $('.current-cat-subcats').removeClass('somesubcats');
                    $(this).addClass('hidden');
                });
            });
        </script>
        <?php
    }
}