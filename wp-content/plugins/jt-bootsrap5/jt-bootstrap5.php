<?php 
/**
 * Plugin Name: Bootstrap 5
 * Plugin URI: https://formation31.fr
 * Description: Un plugin pour activer le css; les icones et le js de Bootstrap
 * Author: Jeremy TRAN
 * Version: 1.0
 * Author URI: https://formation31.fr
 */

 function add_bootstrap5(){
    wp_enqueue_style('bootstrap-5.3','https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css');

    wp_enqueue_style('bootstrap_icons','https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css');

    wp_enqueue_script('bootstrap-js','https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js');
 }

 add_action('wp_head','add_bootstrap5');
?>