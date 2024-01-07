<?php

/*
* Plugin Name:       About Us
* Plugin URI:        https://gngcr.com
* Description:       About Us Administrador
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

    register_post_type('about', $args);

});

// Al momento de cargar el plugin, estar seguro de validar que exista el primer post

add_action('wp_loaded', 'ensure_single_custom_about_us');

function ensure_single_custom_about_us(){

    $existing_about_us = get_posts(
        array(
            'post_type' => 'about',
            'post_per_page' => 1
        )
    );

    if(empty($existing_about_us)){

        $about_us = array(
            'post_type' => 'about',
            'post_title' => 'About Us Settings',
            'post_status' => 'publish'
        );

        wp_insert_post($about_us);

    }

}


// Remove items of menu

add_action('admin_menu', 'remove_add_about');

function remove_add_about(){

    global $menu;

    remove_submenu_page('edit.php?post_type=about', 'post-new.php?post_type=about');

    // Obtener el primer post del menu

    $first_about_post = get_posts( array(

        'post_type' => 'about',
        'posts_per_page' => 1

    ));

    if(!$first_about_post) return null;

    $first_post_id = $first_about_post[0]->ID;

    foreach( $menu as $key => $item ){

        if($item[2] == 'edit.php?post_type=about'){

            // Cambiamos el enlace del menu

            $menu[$key][2] = 'post.php?post=' . $first_post_id . '&action=edit';
            $menu[$key][4] = 'about-item wp-has-submenu wp-not-current-submenu menu-top menu-icon-slider';

            break;

        }

    }

}

// Add save file

include plugin_dir_path(__FILE__) . 'save.php';