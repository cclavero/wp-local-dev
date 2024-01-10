<?php
/**
 * Title: Luthier: Footer
 * Slug: luthier/js-default
 * Categories: luthier-patterns
 */
?>

<!-- js -->
<script id="lut-custom" type="text/javascript">

    jQuery(document).ready(function() {
    
        // lang
        var lang = jQuery("html").attr("lang").split("-")[0];
        var langObj = jQuery('a[href="/'+lang+'/"]');
        jQuery(langObj).addClass("selected");

        // page
        var url = window.location;
        var pageObj = jQuery('a[href="'+url+'"]');
        if(pageObj.length > 0) {
            jQuery(pageObj).addClass("selected");
        }

        // print button
        var printObj = jQuery("div.print a.wp-element-button");
        if(printObj.length > 0) {
            jQuery(printObj).on( "click", function() {
                window.print();
            });
        }
    });

</script>
