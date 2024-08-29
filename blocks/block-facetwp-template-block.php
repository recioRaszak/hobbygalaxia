
<div class="genesis-custom-block">

<section class="buscador-searchbox-wrapper">
    <div class="container" style="font-size:2rem">
        <?php echo do_shortcode('[facetwp facet="buscador"]'); ?>
    </div>
</section>
<section class="main-search">
    <div class="panel-left">
        <?php echo do_shortcode('[facetwp facet="reset"]'); ?>
        <?php echo do_shortcode('[facetwp facet="categories"]'); ?>
        <?php echo do_shortcode('[facetwp facet="precio"]'); ?>
        
    </div>
    <div class="panel-results">
        <?php echo do_shortcode('[facetwp template="facet_list_productos"]'); ?>
        <?php echo do_shortcode('[facetwp facet="ver_mas"]'); ?>
    </div>
    <style>
        .hg-section-small {
            padding: 30px 0;
        }

        .buscador-searchbox-wrapper {
            padding:10px;
            text-align: center;
        }
        #buscador {
            padding: 0 !important;
            align-items: flex-start !important;
            justify-content: space-between;
            flex-direction: row !important;
            flex-wrap: wrap !important;
        }

        .facetwp-facet-buscador {
            margin: 0 !important;
        }

        .facetwp-facet-buscador .facetwp-search {
            font-size: 14px;
            line-height: 40px;
            padding: 0 25px 0 15px;
            border-radius: 25px;
            border: 2px solid cornflowerblue;
            min-width: 200px!important;
        }

        #buscador>* {
            max-width: 100% !important;
        }

        .main-search {
            margin-block-start: 0;
            padding: 15px 0 !important;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 0;
            justify-content: space-between;
        }

        .panel-left {
            font-size: 13px;
            padding: 0 15px;
            box-sizing: border-box;
        }

        .panel-results {
            padding-bottom: 90px;
        }

        @media(min-width:640px) {
            .main-search {
                gap: 25px;
            }
            .facetwp-facet-buscador .facetwp-search {
                font-size: 16px;
                line-height: 48px;
                padding: 0 30px 0 20px;
                min-width: 300px!important;
            }
            .facetwp-facet-buscador .facetwp-search .facetwp-icon {

                top: 0;
                bottom: 0;
                margin: auto 5px auto;
                height: 25px;
                opacity: 0.3;
            }

            .panel-left {
                width: 300px;
            }

            .panel-results {
                width: auto;
                width: calc(100vw - 350px);
            }
        }
        .product-result {
            border-radius:5px;
            overflow:hidden;
            break-inside: avoid;
            background:#fff;
            box-shadow: 0 0 10px -3px rgba(0,0,0,0.1);
            margin-bottom:10px;
        }
        .product-result img {
            max-width:100%;
            height:auto;
        }
        .product-result figure {
            margin:0;
        }
        .product-result--inner {
            padding:5px 10px 10px 10px;
        }
        .product-name {
            font-size: 12px;
            margin: 0 0 5px;
        }
        
        .product-result--price {
            font-size: 11px;
            font-weight: 400;
            margin-bottom: 0;
            color:#000;
        }
        @media(min-width:980px) {
            .product-name {
                font-size: 13px;
            }
            .product-result--price {
                font-size: 12px;
            }
        }

        .productresults {
            margin:0;
            padding: 0 5px 10px 5px;
            list-style:none;
            column-count:2;
            column-gap:10px;
            box-sizing:border-box;
            max-width:100vw;
        }
        @media(min-width:640px) {
            .productresults { column-count:2; }
        }
        @media(min-width:1024px) {
            .productresults { column-count:4; }
        }
        @media(min-width:1280px) {
            .productresults { column-count:6; }
        }
        @media(min-width:1400px) {
            .productresults { column-count:8; }
        }
        .facetwp-facet-categories .facetwp-checkbox {
            background-position-y: 3px;
            padding:5px 30px 5px 22px; 
            border-bottom: 1px solid rgba(32, 56, 182,0.5);
            position:relative;
            z-index:1;
        }
        .facetwp-facet-categories .facetwp-checkbox .facetwp-counter {
            font-size:10px;
            line-height:14px;
            min-width:14px;
            border-radius:6px;
            color:#fff;
            background:#000;
            display:inline-block;
            padding:0 3px;
            box-sizing: border-box;
            text-align:center;
        }
        .facetwp-facet-categories .facetwp-checkbox .facetwp-expand {
            float: none;
            display:inline-block;
            cursor:pointer;
            color:transparent;
            width:20px;
            height:20px;
            background:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyMCAyMCI+PGNpcmNsZSBmaWxsPSJub25lIiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4xIiBjeD0iOS41IiBjeT0iOS41IiByPSI5Ij48L2NpcmNsZT48cGF0aCBmaWxsPSJub25lIiBzdHJva2U9IiMwMDAiIGQ9Ik05LjUgNXY5TTUgOS41aDkiPjwvcGF0aD48L3N2Zz4=");
            background-size:100%;
            position:absolute;
            right:0;
            top:5px;
        }
        .facetwp-facet-categories .facetwp-checkbox .facetwp-expand.opened {
            background:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyMCAyMCI+PGNpcmNsZSBmaWxsPSJub25lIiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4xIiBjeD0iOS41IiBjeT0iOS41IiByPSI5Ij48L2NpcmNsZT48cGF0aCBmaWxsPSJub25lIiBzdHJva2U9IiMwMDAiIGQ9Ik01IDkuNWg5Ij48L3BhdGg+PC9zdmc+");
        }
        .facetwp-facet-ver_mas {
            text-align:center;
            margin:25px 0;
        }
        .facetwp-facet-ver_mas .facetwp-load-more {
            color:#000;
            background:#000;
            border-radius:5px;
            min-width:140px;
            border:0;
            color:#fff;
            cursor:pointer;
        }


    </style>
</section>
<figure class="wp-block-image size-large is-resized" data-scroll-lock="" data-toggle="#buscador"
    style="right:0;top:0;margin:5px;position:absolute;cursor:pointer;">
    <img decoding="async" width="20" height="20"
        data-src="https://hobbygalaxia.b-cdn.net/wp-content/uploads/2024/07/svg-close.svg" alt="Cerrar"
        class="wp-image-4569 lazy" style="object-fit:cover;width:40px;height:40px">
</figure>
</div>