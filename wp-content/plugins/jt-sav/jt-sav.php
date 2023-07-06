<?php 
/**
 * Plugin Name: SAV
 * Plugin URI: https://formation31.fr
 * Description: Un plugin pour activer le SAV
 * Author: Jeremy TRAN
 * Version: 1.0
 * Author URI: https://formation31.fr
 */

 function add_style_plugin_sav(){
    wp_enqueue_style('style-sav', plugins_url('<jt-sav>style.css','__FILE__'));
}

add_action('wp_head','add_style_plugin_sav');

//BLOCS SERVICES SHORTCODE

function sf_services($atts,$content=null){
    extract(shortcode_atts(array(
        'bg_services'=>'livraison-rose',
        'icons_services'=>'livraison'
    ),$atts,'sfServices'));

    if(empty($content)){
        $content = 'Livraison gratuite';
    }

    $codehtml="<div class='sf-services $bg_services'><h4 class='$icons_services'>$content</h4></div>";

    return $codehtml;

}

add_shortcode('sfServices','sf_services');

//declaration de woocommerce et activation des modeles de pages
function mytheme_add_woocommerce_support(){
    add_theme_support('woocommerce');
}

add_action('after_setup_theme','mytheme_add_woocommerce_support');

?>