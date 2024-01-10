<?php

// Disallow direct access
if (!defined("ABSPATH")) {die("Forbidden.");}

// Template constants ---------------------------------------------------------

define("LUT_DEBUG", false);
define("LUT_TPL_URI", trailingslashit(get_stylesheet_directory_uri()));
define("LUT_LANG_PATH", LUT_TPL_URI."languages");
define("LUT_CAT_PATH", get_stylesheet_directory()."/assets/catalogue/catalogue.json");
define("LUT_LOC_STRINGS", array(
    "cat-materials" => array(
        "ca" => "Fustes / Model", 
        "es" => "Maderas / Modelo" 
    ),
    "cat-price" => array(
        "ca" => "Preu de venda", 
        "es" => "Precio de venta" 
    ),
    "cat-ask" => array(
        "ca" => "Preguntar", 
        "es" => "Preguntar" 
    ),
    "cat-back" => array(
        "ca" => "Veure tots",
        "es" => "Ver todos"
    ),
    "orders-url" => array(
        "ca" => "consultes-i-comandes",
        "es" => "consultas-y-pedidos"
    ),
    "orders-title" => array(
        "ca" => "Consultes i comandes",
        "es" => "Consultas y pedidos"
    )    
));

// Template functions ---------------------------------------------------------

add_action("wp_enqueue_scripts", function() {
    wp_enqueue_style("lut-parent-style", get_template_directory_uri()."/style.css");
});

function lut_register_pattern_category() {
    $patterns = array();
    $block_pattern_categories = array(
        "luthier-patterns" => array("label" => "Luthier: Patterns")
    );
    $block_pattern_categories = apply_filters("luthier_block_pattern_categories", $block_pattern_categories);
    foreach($block_pattern_categories as $name => $properties) {
        if(!WP_Block_Pattern_Categories_Registry::get_instance()->is_registered($name)) {
            register_block_pattern_category($name, $properties);
        }
    }
}

add_action("init", function() {
    lut_register_pattern_category();
    lut_debug("init");
});

add_action("template_redirect", function() {
    $site_url = get_option("siteurl");
    if(is_category()) {
        wp_redirect($site_url, 301);
        die();
    }
});

add_action("after_setup_theme", function() {
    load_child_theme_textdomain("luthier", LUT_LANG_PATH);
    lut_debug("after_setup_theme");    
});

// Helper functions -----------------------------------------------------------

function lut_debug($obj=null) {
    if(LUT_DEBUG) {
        $func_name = debug_backtrace()[1]['function'];
        echo("<!-- debug:".$func_name.":".print_r($obj,true)." -->\n");
    }
}

function lut_get_refs_ids($refs) {
    $lang = pll_current_language();
    foreach($refs as $key => $value) {
        $refs[$key] = isset($value[$lang]) ? $value[$lang] : 0 ;
    }
    return $refs;
}

function lut_get_strings($strs) {
    return lut_get_refs_ids($strs);
}

function lut_get_urls($base_url, $urls) {
    $lang = pll_current_language();
    foreach($urls as $key => $value) {
        $url = $base_url.$value;
        $url = str_replace("{lang}", $lang,$url);
        $urls[$key] = esc_url($url);
    }
    return $urls;
}

function lut_get_links($links) {
    $base_url = trailingslashit(LUT_TPL_URI."assets/");
    return lut_get_urls($base_url, $links);
}

function lut_get_imgs($imgs) {
    $base_url = trailingslashit(LUT_TPL_URI."assets/img");
    return lut_get_urls($base_url, $imgs);
}

function lut_get_catalogue_loc_items($lang, $items_data) {
    $res = array();
    foreach($items_data as $item) {
        $item_rec = array(
            "item" => isset($item->item->$lang) ? $item->item->$lang : "?item?",
            "price" => $item->price,
            "note" => isset($item->note->$lang) ? $item->note->$lang : "?note?"
        );
        array_push($res, $item_rec);
    }
    return $res;
}

function lut_get_catalogue_loc($lang, $cat_data) {
    $res = array();
    $res["name"] = isset($cat_data->name->$lang) ? $cat_data->name->$lang : "?name?";
    $res["refs"] = array();
    foreach($cat_data->refs as $ref) {
        $res["refs"][$ref->ref] = array(
            "name" => isset($ref->name->$lang) ? $ref->name->$lang : "?name?",
            "items" => lut_get_catalogue_loc_items($lang, $ref->items)
        );
    }
    return $res;
}

function lut_get_catalogue_item_html($ref, $ref_data) {
    $res = "";
    $strs = lut_get_strings(LUT_LOC_STRINGS);
    $res .= sprintf("<h4>%s: %s</h4>", $ref, $ref_data["name"]);
    $res .= "<table class=\"cat-table\">";
    $res .= sprintf("<thead><tr><th>%s</th><th class=\"price\">%s</th></tr></thead>", $strs["cat-materials"], $strs["cat-price"]);
    $res .= "<tbody>";
    foreach($ref_data["items"] as $item) {
        $res .= "<tr>";
        $res .= sprintf("<td><div class=\"item\">%s</div><div class=\"note\">%s</div></td>", $item["item"], $item["note"]);
        $price = ($item["price"] != "0") ? $price = str_replace(".", ",", sprintf("%0.2f €", $item["price"])) : $strs["cat-ask"] ; 
        $res .= sprintf("<td><span class=\"price\">%s</span></td>", $price);
        $res .= "</tr>";
    }
    $res .= "</tbody>";
    $res .= "</table>";
    return $res;
}

function lut_get_catalogue_html($cat_data) {
    $res = "";
    foreach($cat_data as $section) {
        $res .= sprintf("<h3>%s</h3>", $section["name"]);
        foreach($section["refs"] as $ref => $value) {
            $res .= lut_get_catalogue_item_html($ref, $value);
        }
    }
    return $res;
}

function lut_get_button_html($align, $url, $title) {
    return sprintf("<div class=\"wp-block-button\" style=\"width:46%%;text-align:%s;\"><a class=\"wp-block-button__link wp-element-button\" href=\"%s\">%s</a></div>",
        $align, $url, $title);
}

// Shortcode functions --------------------------------------------------------

add_shortcode("lut_catalogue", function($atts,$contents) {
    $cat_data_contents = file_get_contents(LUT_CAT_PATH);
    $json_data = json_decode($cat_data_contents);
    if($json_data === null) {
        return sprintf("<div class=\"cat-error\">Error: Bad format in catalogue file: %s</div>", LUT_CAT_PATH);
    }
    $lang = pll_current_language();
    $cat_data = (object)array(
        "instruments" => lut_get_catalogue_loc($lang, $json_data->instruments),
        "accessories" => lut_get_catalogue_loc($lang, $json_data->accessories)
    );
    if(!isset($atts["ref"])) { // All the catalog
        return lut_get_catalogue_html($cat_data);
    } else { // Reference
        $ref = $atts["ref"];
        if(array_key_exists($ref, $cat_data->instruments["refs"])) {
            return lut_get_catalogue_item_html($ref, $cat_data->instruments["refs"][$ref]);
        }
        if(array_key_exists($ref, $cat_data->accessories["refs"])) {
            return lut_get_catalogue_item_html($ref, $cat_data->accessories["refs"][$ref]);
        }       
        return sprintf("<div class=\"cat-error\">Error: Bad 'ref' value for catalogue: %s</div>", $atts["ref"]);
    }
    return $res;
});

add_shortcode("lut_catalogue_buttons", function($atts,$contents) {
    $lang = pll_current_language();
    if(!isset($atts["ref"]) || !isset($atts["category"])) { // Error
        return sprintf("<div class=\"cat-error\">Error: Bad 'ref' or 'category' for catalogue: %s,%s</div>", $atts["ref"], $atts["category"]);
    } else { // Add buttons
        $strs = lut_get_strings(LUT_LOC_STRINGS);
        $res = "<div class=\"wp-block-buttons is-layout-flex\">";
        $url = sprintf("/%s/%s?ref=%s", $lang, $strs["orders-url"], $atts["ref"]);
        $res .= lut_get_button_html("left", $url, $strs["orders-title"]);
        $url = sprintf("/%s/%s", $lang, $atts["category"]);
        $res .= lut_get_button_html("right", $url, $strs["cat-back"]);
        $res .= "</div>";
    }
    return $res;
});


?>