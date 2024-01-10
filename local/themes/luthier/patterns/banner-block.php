<?php
/**
 * Title: Luthier: Banner Block
 * Slug: luthier/banner-block
 * Categories: luthier-patterns
 */

$refs = lut_get_refs_ids(array(
    "benvingut-post" => array(
        "ca" => 114, // Benvingut/da 
        "es" => 118  // Bienvenido/a 
    )
)); 
$imgs = lut_get_imgs(array(
    "banner-back" => "banner-back.jpg"
));
?>

<!-- wp:cover {"url":"<?php echo($imgs["banner-back"]); ?>","id":203,"dimRatio":0,"minHeight":580,"isDark":false,"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light" style="min-height:580px;">
    <span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>
    <img class="wp-block-cover__image-background wp-image-203" alt="Cover" src="<?php echo($imgs["banner-back"]); ?>" data-object-fit="cover" />
    <div class="wp-block-cover__inner-container">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"1180px"}} -->
        <div class="wp-block-group">
            
            <!-- wp:columns -->
            <div class="wp-block-columns">
                
                <!-- wp:column -->
                <div class="wp-block-column">
                
                    <!-- Post: Benvingut/da -->
                    <!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
                    <h3 class="wp-block-heading" style="font-style:normal;font-weight:500;font-size:30px;"><?php echo(get_post_field("post_title",$refs["benvingut-post"])); ?></h3>
                    <!-- /wp:heading -->
                    <?php echo(get_post_field("post_content",$refs["benvingut-post"])); ?>

                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->

        </div>
        <!-- /wp:group -->

    </div>
</div>
<!-- /wp:cover -->