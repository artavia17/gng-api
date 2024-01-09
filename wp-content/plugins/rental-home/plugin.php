<?php

/*
* Plugin Name:       Rental Home
* Plugin URI:        https://gngcr.com
* Description:       Rental Home Administrador
* Version:           1.0.0
* Requires at least: 5.2
* Author:            Alonso Artavia
* Author URI:        https://alonsocr.com
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain:       Conocer más del plugin
*/

// Inializamos el plugin

add_action('init', function(){
    // Principal settings
    include plugin_dir_path(__FILE__) . 'settings/labels.php';

    // All arguments
    include plugin_dir_path(__FILE__) . 'settings/arguments.php';

    register_post_type('rental_home', $args);

});

add_action('admin_enqueue_scripts', function () {
    $screen = get_current_screen();

    if ($screen->id === 'rental_home') {
        wp_enqueue_media();
        wp_enqueue_script('galery_images', plugins_url('assets/app.js', __FILE__), ['jquery']);
    }

    error_log(print_r(get_current_screen(), true));
});


include plugin_dir_path(__FILE__) . 'save.php';