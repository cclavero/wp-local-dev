<?php
/**
 * Title: Luthier: About Us Block
 * Slug: luthier/about-us-block
 * Categories: luthier-patterns
 */

$refs = lut_get_refs_ids(array(
    "about-us-post" => array(
        "ca" => 125,  // Qui sóc i què faig
        "es" => 133  // Quién soy y qué hago
    )
));
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"60px","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"background-alt","layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group has-background-alt-background-color has-background" style="padding-top:0;padding-right:var(--wp--preset--spacing--50);padding-bottom:60px;padding-left:var(--wp--preset--spacing--50);">

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"60px"}}}} -->
    <div class="wp-block-columns">

        <!-- wp:column -->
        <div class="wp-block-column">

            <!-- Post: Qui sóc i què faig -->
            <!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
            <h3 class="wp-block-heading" style="font-style:normal;font-weight:500;font-size:30px;"><?php echo(get_post_field("post_title",$refs["about-us-post"])); ?></h3>
            <!-- /wp:heading -->
            <?php echo(get_post_field("post_content",$refs["about-us-post"])); ?>

        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

</div>
<!-- /wp:group -->
