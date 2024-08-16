<?php $categoria_producto = get_queried_object(); 
    if (function_exists('get_field')) {
        the_field('contenido_inferior',$categoria_producto);
    }