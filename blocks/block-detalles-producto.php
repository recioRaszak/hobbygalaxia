<?php
    $prodID = get_the_ID();
    global $product;
    $estado = get_field('estado');
    $defectos = get_field('defectos');
    $year = get_field('year');
    $soporte = get_field('soporte');

    $autor = get_field('autor');
    $editorial = get_field('editorial');
    $paginas = get_field('paginas');
    $encuadernacion = get_field('encuadernacion');
    $impresion = get_field('impresion');

    $sello = get_field('sello');
    $temas_bonus = get_field('temas_bonus');

    $director = get_field('director');
    $reparto_principal = get_field('reparto_principal');
    $extras_destacables = get_field('extras_destacables');

    $embalaje = get_field('embalaje');
    $material_juguete = get_field('material_juguete');

    $subcat_informatica = get_field('subcat_informatica');
    $funcionamiento = get_field('funcionamiento');
    $idioma_array = get_field('idioma');
    $idiomas = "";
    $idiomas_sep = "";
    $sep = "";
    if ( !empty($idioma_array) ) {
        //echo print_r($idioma_array,true);
        foreach ( $idioma_array as $lengua ) {
            $idiomas.=$lengua['label'].$sep;
            $sep = ", ";
        } 
        
    }
/*
    $categorias_coleccionismo = get_the_terms($prodID, 'product_cat' );;

    if (!empty($categorias_coleccionismo)) {
        $listacategorias = "";
        $sep = "";
        foreach ($categorias_coleccionismo as $cat) {
            $listacategorias.=$sep."<a href='".get_term_link($cat)."'>".$cat->name."</a>";
            $sep = ", ";
        }
    } else {
        $listacategorias = " - ";
    }


    $tags_coleccionismo = get_the_terms($prodID, 'product_tag' );

    if (!empty($tags_coleccionismo)) {
        $listags = "";
        $sep = "";
        foreach ($tags_coleccionismo as $tag) {
            $listags.=$sep."<a href='".get_term_link($tag)."'>".$tag->name."</a>";
            $sep = ", ";
        }
    } else {
        $listags = " - ";
    }
*/
    


?>
<style>
    @media(min-width:640px) {
        .product-details-plus ul {
            column-count:2;
        }
    }
</style>
<div class="product-details-plus">
    <ul class="uk-list uk-list-line  uk-grid uk-child-width-1-2@s">
        

        <?php if ( $estado!=""  && !empty($estado) )?>
        <li><strong><?php echo __('Estado','hobbygalaxia');?>:</strong> <?php echo $estado;?>

        <?php if ( $defectos!="" && $defectos!=" " && !empty($defectos) ) { ?>
        <li><strong><?php echo __('Defectos','hobbygalaxia');?>:</strong> <?php echo $defectos;?>
        <?php } ?>

        <?php if ( $year!=""  && $year!=" "  &&!empty($year) ) ?>
        <li><strong><?php echo __('Año','hobbygalaxia');?>:</strong> <?php echo $year;?>

        <?php if ( $soporte!=""  && !empty($soporte) && $soporte!="-") ?>
        <li><strong><?php echo __('Soporte','hobbygalaxia');?>:</strong> <?php echo $soporte;?>


        <?php  // 133 libros

            if (has_term(133, 'product_cat', $prodID)) { ?>
            <?php if ( $autor!=""  && !empty($autor) ) ?>
            <li><strong><?php echo __('Autor','hobbygalaxia');?>:</strong> <?php echo $autor;?>

            <?php if ( $editorial!=""  && !empty($editorial) ) ?>
            <li><strong><?php echo __('Editorial','hobbygalaxia');?>:</strong> <?php echo $editorial;?>

            <?php if ( $paginas!=""  && !empty($paginas) ) ?>
            <li><strong><?php echo __('Número de páginas','hobbygalaxia');?>:</strong> <?php echo $paginas;?>

            <?php if ( $idiomas!=""  && !empty($idiomas) ) ?>
            <li><strong><?php echo __('Idioma','hobbygalaxia');?>:</strong> <?php echo $idiomas;?>

            <?php if ( $encuadernacion!="" && !empty($encuadernacion) ) ?>
            <li><strong><?php echo __('Encuadernacion','hobbygalaxia');?>:</strong> <?php echo $encuadernacion;?>
            
            <?php if ( $impresion!=""  && !empty($impresion) ) ?>
            <li><strong><?php echo __('Impresión','hobbygalaxia');?>:</strong> <?php echo $impresion;?>
        <?php } ?>


        <?php  // 25 musica

            if (has_term(25, 'product_cat', $prodID)) { ?>
            <?php if ( $sello!=""  && !empty($sello)  ) ?>
            <li><strong><?php echo __('Sello','hobbygalaxia');?>:</strong> <?php echo $sello;?>
            
            <?php if ( $temas_bonus!=""  && !empty($temas_bonus) ) ?>
            <li><strong><?php echo __('Temas bonus','hobbygalaxia');?>:</strong> <?php echo $temas_bonus;?>
        <?php } ?>

        <?php  // 28 libros

            if (has_term(28, 'product_cat', $prodID)) { ?>
            <?php if ( $director!=""  && !empty($director) ) ?>
            <li><strong><?php echo __('Director','hobbygalaxia');?>:</strong> <?php echo $director;?>
            
            <?php if ( $reparto_principal!=""  && !empty($reparto_principal) ) ?>
            <li><strong><?php echo __('Reparto principal','hobbygalaxia');?>:</strong> <?php echo $reparto_principal;?>

            <?php if ( $idiomas!=""  && !empty($idiomas) ) ?>
            <li><strong><?php echo __('Idiomas','hobbygalaxia');?>:</strong> <?php echo $idiomas;?>

            

            <?php if ( $extras_destacables!=""  && !empty($extras_destacables) ) ?>
            <li class="uk-width-1-1 uk-column-1-2"><strong><?php echo __('Extras destacables','hobbygalaxia');?>:</strong> <?php echo $extras_destacables;?>
        <?php } ?>



    <?php  // 29 - informatica
        if (has_term(29, 'product_cat', $prodID)) { ?>

                <?php if ( $embalaje!=""  && !empty($embalaje) ) ?>
                <li><strong><?php echo __('Embalaje','hobbygalaxia');?>:</strong> <?php echo $embalaje;?>

                <?php if ( $material_juguete!=""  && !empty($material_juguete) ) ?>
                <li><strong><?php echo __('Material','hobbygalaxia');?>:</strong> <?php echo $material_juguete;?>

                <?php if ( $subcat_informatica!=""  && !empty($subcat_informatica) ) ?>
                <li><strong><?php echo __('Subcategoria informática','hobbygalaxia');?>:</strong> <?php echo $subcat_informatica;?>

                <?php if ( $funcionamiento!=""  && !empty($funcionamiento) ) ?>
                <li><strong><?php echo __('Funcionamiento','hobbygalaxia');?>:</strong> <?php echo $funcionamiento;?>
    <?php } ?>

    </ul>

    <div class="uk-margin uk-text-center uk-text-left@s">
        <h3>
            <?php echo __('Comprar ahora');?> <strong>&laquo;<?php the_title();?>&raquo;</strong>
        </h3>
        <p class="uk-text-large"><?php echo __('Precio','blockytoys');?>: <strong><?php echo $product->get_price();?> €</strong></p>
        <p><a href='<?php echo $product->add_to_cart_url();?>'>
            <button class="single_add_to_cart_button button alt wp-element-button"><?php echo __('Añadir al carrito','hobbygalaxia');?></button></a></p>
        <?php /* 
        <div class="uk-margin uk-text-center">
            <?php 
				get_template_part('template-parts/coolector-boton');
			?>
            <button uk-toggle="target: #contraoffer" class="uk-button uk-button-secondary uk-button-large button-nyp" style="padding:0 15px 0 20px;text-align:center;overflow:visible">
                <?php echo __('Hacer una oferta');?>&nbsp;
                <span uk-icon="icon:reply;ratio:1.5" class="uk-icon"></span>
            </button>
        </div> 
        */ ?>
    </div>

</div>
<script>
jQuery(document).ready(function($){
    $('.product-details-plus').appendTo('#tab-description');
});
</script>
