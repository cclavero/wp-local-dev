<?php
/**
 * Title: Luthier: 404 Block
 * Slug: luthier/404-block
 * Categories: luthier-patterns
 */

$strs = lut_get_strings(array(
    "not-found" => array(
        "ca" => "404: Recurs no trobat !", 
        "es" => "404: ¡ Recurso no encontrado !" 
    ),
    "not-found-desc" => array(
        "ca" => "Recurs o URL no trobada al WebSite. <a href=\"/ca\">Anar l'inici</a>.", 
        "es" => "Recurso o URL no encontrado en el WebSite. <a href=\"/es\">Ir al inicio</a>." 
    )
));
$imgs = lut_get_imgs(array(
    "404" => "404.jpg"
));
?>
<!-- wp:template-part {"slug":"header","theme":"luthier"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group">

    <!-- wp:group {"style":{"spacing":{"padding":{"top":"60px","bottom":"0","right":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"backgroundColor":"background-alt","layout":{"type":"constrained","contentSize":"860px"},"fontSize":"xxxx-large"} -->
    <div class="wp-block-group" style="padding-top:60px;padding-right:var(--wp--preset--spacing--40);padding-bottom:0;padding-left:var(--wp--preset--spacing--40);">

        <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"60px"}}}} -->
        <div class="wp-block-columns">

            <!-- wp:column {"width":"35%"} -->
            <div class="wp-block-column" style="flex-basis:35%">
            
                <!-- wp:image -->
                <figure class="wp-block-image"><img src="<?php echo($imgs["404"]); ?>" alt="404" /></figure>
                <!-- /wp:image -->
            
            </div>
            <!-- /wp:column -->

            <!-- wp:column {"width":"60%"} -->
            <div class="wp-block-column" style="flex-basis:60%">

                <!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
                <h3 class="wp-block-heading" style="font-style:normal;font-weight:500;font-size:30px;"><?php echo($strs["not-found"]); ?></h3>
                <!-- /wp:heading -->

                <!-- wp:paragraph -->
                <p><?php echo($strs["not-found-desc"]); ?></p>
                <!-- /wp:paragraph -->

            </div>
            <!-- /wp:column -->

        </div>
        <!-- /wp:columns -->

    </div>
    <!-- /wp:group -->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","theme":"luthier"} /-->