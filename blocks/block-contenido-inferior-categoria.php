<?php $categoria_producto = get_queried_object(); 
    if (function_exists('get_field')) { ?>

        <section class="genesis-custom-block">
        <?php
        the_field('contenido_inferior',$categoria_producto);
        ?>
        </section>
        <?php
    }