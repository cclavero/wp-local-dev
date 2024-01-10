<?php
/**
 * Title: Luthier: Footer
 * Slug: luthier/footer-default
 * Categories: luthier-patterns
 */

$strs = lut_get_strings(array(
    "instruments" => array(
        "ca" => "Instruments", 
        "es" => "Instrumentos" 
    ),
    "accessories" => array(
        "ca" => "Accessoris", 
        "es" => "Accesorios" 
    )
));
$refs = lut_get_refs_ids(array(
    "main-menu" => array(
        "ca" => 35, // Main menu (CA) 
        "es" => 51  // Main menu (ES) 
    ),
    "instruments-menu" => array(
        "ca" => 91, // Instruments (CA)
        "es" => 95  // Instruments (ES) 
    ),
    "reeds-menu" => array(
        "ca" => 102, // Reeds (CA) 
        "es" => 106  // Reeds (ES)
    )
)); 
$links = lut_get_links(array(
    "cert-web-adequada" => "legal/cert-web-adequada-{lang}-ver2.pdf",
    "nota-legal" => "legal/nota-legal-{lang}-ver2.pdf"
));
$imgs = lut_get_imgs(array(
    "logo-web-adequada" => "logo-web-adequada.png"
));
?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|80","right":"var:preset|spacing|50","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50"}},"border":{"top":{"color":"var:preset|color|background-alt","width":"1px"}}},"backgroundColor":"background-alt","layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group has-background-alt-background-color has-background" style="border-top-color: var(--wp--preset--color--background-alt); border-top-width: 1px; padding-top: var(--wp--preset--spacing--80); padding-right: var(--wp--preset--spacing--50); padding-bottom: var(--wp--preset--spacing--60); padding-left: var(--wp--preset--spacing--50)">
    
    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
    <div class="wp-block-columns">

        <!-- wp:column {"width":"35%"} -->
        <div class="wp-block-column" style="flex-basis:35%;">
            
            <!-- wp:columns -->
            <div class="wp-block-columns">

                <!-- wp:column {"width":"20%"} -->
                <div class="wp-block-column" style="flex-basis:20%">
                    <figure class="wp-block-image size-full"><a href="<?php echo($links["cert-web-adequada"]); ?>" title="Web adequada" target="_blank"><img src="<?php echo($imgs["logo-web-adequada"]); ?>" alt="Logo Web adequada" style="width:80px;" /></a></figure>
                </div>
                <!-- /wp:column -->

                <!-- wp:column {"width":"70%"} -->
                <div class="wp-block-column" style="flex-basis:70%">
                    
                    <!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
                    <h3 class="wp-block-heading has-medium-font-size" style="font-style:normal;font-weight:500;"><?php echo get_bloginfo("name"); ?></h3>
                    <!-- /wp:heading -->
                    
                    <!-- wp:paragraph -->
                    <p><a href="<?php echo($links["nota-legal"]); ?>" title="Nota Legal" target="_blank">Nota Legal</a></p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph -->
                    <p>Design & Webmaster: <a href="mailto:carles.clavero@gmail.com" title="carles.clavero@ŋmail.com">Carles Clavero i Matas</a></p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph -->
                    <p>&copy;'2011-<?php echo date("Y"); ?> Jordi Aixalà i Basora </p>
                    <!-- /wp:paragraph -->
                    <!-- wp:social-links {"iconColor":"heading-color","iconColorValue":"#2A2A2A","iconBackgroundColor":"background-alt","iconBackgroundColorValue":"#F4F2F2","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|20"}}}} -->
                    <ul class="wp-block-social-links has-icon-color has-icon-background-color">
                        <!-- wp:social-link {"service":"facebook","url":"https://www.facebook.com/jordi.aixalabasora"} /-->
                    </ul>          
                    <!-- /wp:social-links -->

                </div>
                <!-- /wp:column -->
            
            </div>
            <!-- /wp:columns -->
        
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">

            <!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
            <h3 class="wp-block-heading has-medium-font-size" style="font-style:normal;font-weight:500;">Luthier</h3>
            <!-- /wp:heading -->

            <!-- Menu: Main menu -->
            <!-- wp:navigation {"ref":<?php echo($refs["main-menu"]); ?>,"textColor":"sub-heading-color","overlayBackgroundColor":"background-alt","overlayTextColor":"sub-heading-color","layout":{"type":"flex","justifyContent":"left","orientation":"vertical"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} /-->

        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">

            <!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
            <h3 class="wp-block-heading has-medium-font-size" style="font-style:normal;font-weight:500;"><?php echo($strs["instruments"]); ?></h3>
            <!-- /wp:heading -->

            <!-- Menu: Instruments -->
            <!-- wp:navigation {"ref":<?php echo($refs["instruments-menu"]); ?>,"textColor":"sub-heading-color","overlayBackgroundColor":"background-alt","overlayTextColor":"sub-heading-color","layout":{"type":"flex","justifyContent":"left","orientation":"vertical"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} /-->
            
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">

            <!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
            <h3 class="wp-block-heading has-medium-font-size" style="font-style:normal;font-weight:500;"><?php echo($strs["accessories"]); ?></h3>
            <!-- /wp:heading -->

            <!-- Menu: Reeds -->
            <!-- wp:navigation {"ref":<?php echo($refs["reeds-menu"]); ?>,"textColor":"sub-heading-color","overlayBackgroundColor":"background-alt","overlayTextColor":"sub-heading-color","layout":{"type":"flex","justifyContent":"left","orientation":"vertical"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} /-->

        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->
    
</div>
<!-- /wp:group -->
