<?php
/**
 * Title: Luthier: Featured Products Collection
 * Slug: luthier/featured-collection-block
 * Categories: luthier-patterns
 */

$refs = lut_get_refs_ids(array(
    "featured-post" => array(
        "ca" => 137,  // Instruments i accessoris 
        "es" => 139  // Instrumentos y accesorios 
    )
));
?>

<!-- wp:group {"layout":{"type":"constrained","contentSize":"1180px"},"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"80px","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:var(--wp--preset--spacing--50);padding-bottom:80px;padding-left:var(--wp--preset--spacing--50);">

    <!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"medium"} -->
    <h3 class="wp-block-heading" style="font-style:normal;font-weight:500;font-size:30px;"><?php echo(get_post_field("post_title",$refs["featured-post"])); ?></h3>
    <!-- /wp:heading -->
    <?php echo(get_post_field("post_content",$refs["featured-post"])); ?>

</div>
<!-- /wp:group -->    
