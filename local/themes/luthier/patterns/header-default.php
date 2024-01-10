<?php
/**
 * Title: Luthier: Header
 * Slug: luthier/header-default
 * Categories: luthier-patterns
 */

$refs = lut_get_refs_ids(array(
    "main-menu" => array(
        "ca" => 35, // Main menu (CA) 
        "es" => 51  // Main menu (ES) 
    )
)); 
?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"20px","right":"var:preset|spacing|50","bottom":"20px","left":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group" style="padding-top:20px;padding-right:var(--wp--preset--spacing--50);padding-bottom:20px;padding-left:var(--wp--preset--spacing--50)">
    
    <!-- wp:columns {"verticalAlignment":"top"} -->
    <div class="wp-block-columns">
        
        <!-- wp:column {"width":"35%"} -->
        <div class="wp-block-column" style="flex-basis:35%">

            <!-- Menu: Main menu -->
            <!-- wp:navigation {"ref":<?php echo($refs["main-menu"]); ?>,"textColor":"sub-heading-color","overlayBackgroundColor":"background-alt","overlayTextColor":"sub-heading-color","layout":{"type":"flex","justifyContent":"left"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} /-->

        </div>
        <!-- /wp:column -->

        <!-- wp:column {"width":"55%"} -->
        <div class="wp-block-column" style="flex-basis:55%">
            <!-- wp:site-title {"level":3,"textAlign":"left","style":{"typography":{"fontStyle":"normal","fontWeight":"700","letterSpacing":"2px","fontSize":"24px","lineHeight":"1.1"}},"fontFamily":"plus-jakarta-sans"} /-->
            <!-- wp:site-tagline {"textAlign":"left","style":{"typography":{"fontStyle":"normal","fontWeight":"700","letterSpacing":"2px","fontSize":"18px","lineHeight":"1.1"}},"fontFamily":"plus-jakarta-sans"} /-->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"width":"20%"} -->
        <div class="wp-block-column" style="flex-basis:20%">

            <!-- Menu: Langs -->
            <!-- wp:navigation {"ref":43,"textColor":"sub-heading-color","overlayBackgroundColor":"background-alt","overlayTextColor":"sub-heading-color","layout":{"type":"flex","justifyContent":"right"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} /--></div>
                        
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

</div>
<!-- /wp:group -->