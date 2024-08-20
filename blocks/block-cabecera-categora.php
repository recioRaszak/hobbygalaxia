<div class="genesis-custom-block">
<?php
if ( is_tax() && function_exists('get_field') ) {
    $qobjct = get_queried_object();
    if ($qobjct) { 
        $img_url = get_field('imagen_de_cabecera',$qobjct );
        if ($img_url && $img_url != "") {
            ?>
            <style>
                
                .header-cat {
                    background: url('<?php echo $img_url; ?>') center / cover no-repeat var(--wp--preset--color--foreground);
                    padding:30px 0;
                    display: flex;
                    align-items: flex-end;
                    min-height:400px;
                    position:relative;
                    z-index:1;
                }
                .header-cat::after {
                    position:absolute;
                    left:0;top:0;right:0;bottom:0;
                    content:"";
                    background:rgba(0,0,0,0.4);
                }
                .header-cat * {
                    color:#fff;
                    position:relative;
                    z-index:2;
                    width:100%;
                    max-width:var(--wp--style--global--wide-size);
                }
            </style>
            <?php
            }
        }
    }
?>
</div>