<?php

/*
* Plugin Name:       Home
* Plugin URI:        https://gngcr.com
* Description:       Home Administrador
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

    register_post_type('home', $args);

});


// Asegurarse de que haya solo un único post de este tipo
add_action('wp_loaded', 'ensure_single_custom_slider');

function ensure_single_custom_slider() {
    $existing_sliders = get_posts(array('post_type' => 'home', 'posts_per_page' => 1));

    if (empty($existing_sliders)) {
        $slider = array(
            'post_type' => 'home',
            'post_title' => 'Home',
            'post_status' => 'publish',
        );

        wp_insert_post($slider);


    }
}

// Ocultar la opción "Añadir Nuevo"
add_action('admin_menu', 'remove_add_new_menu_item');

function remove_add_new_menu_item() {
    
    global $menu;

    remove_submenu_page('edit.php?post_type=home', 'post-new.php?post_type=home');

    // Obtener el primer post del tipo 'home'
    $first_home_post = get_posts(array(
        'post_type'      => 'home',
        'posts_per_page' => 1,
    ));

    $first_post_id = 0;

    // Verificar si hay posts
    if ($first_home_post) {
        // Acceder al ID del primer post
        $first_post_id = $first_home_post[0]->ID;

    }

    // Encuentra el índice del menú que deseas cambiar
    foreach ($menu as $key => $item) {
        if ($item[2] == 'edit.php?post_type=home') {
            // Cambia el enlace del menú
            $menu[$key][2] = 'post.php?post=' . $first_post_id . '&action=edit';
            break;
        }
    }

}

add_action('admin_enqueue_scripts', function () {
    $screen = get_current_screen();

    if ($screen->id === 'home') {
        wp_enqueue_media();
        wp_enqueue_script('image-slider-uploader', plugins_url('assets/app.js', __FILE__), ['jquery']);
    }

    error_log(print_r(get_current_screen(), true));
});


include plugin_dir_path(__FILE__) . 'save.php';