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

add_action('admin_enqueue_scripts', function () {
    $screen = get_current_screen();

    if ($screen->id === 'about') {
        wp_enqueue_media();
        wp_enqueue_script('about_select', plugins_url('assets/app.js', __FILE__), true);
    }

    error_log(print_r(get_current_screen(), true));
});


// Registramos la api del plugin
function api_about() {
    register_rest_route('wp/v2', 'about', array(
        'methods' => 'GET',
        'callback' => 'get_about_api',
    ));
}

add_action('rest_api_init', 'api_about');

function get_about_api($request) {
    // Creamos un array para almacenar las noticias
    $home = array(); 

    // Configuramos los argumentos de la consulta
    $args = array(
        'post_type' => 'about',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
    );


    // Realizamos la consulta
    $sliders_query = new WP_Query($args);

    // Verificamos si hay noticias en la consulta
    if ($sliders_query->have_posts()) {
        while ($sliders_query->have_posts()) {
            $sliders_query->the_post();

            $title = get_the_title();
            $description = get_the_excerpt();

            // First section
            $title_first = get_post_meta( get_the_ID(), 'title_first', true);
            $content_first = get_post_meta( get_the_ID(), 'content_first', true);

            // Second section
            $title_second = get_post_meta(get_the_ID(), 'title_second', true);
            $content_second = get_post_meta(get_the_ID(), 'content_second', true);

            // Third section
            $title_first_third = get_post_meta(get_the_ID(), 'third_first_title', true); 
            $content_first_third = get_post_meta(get_the_ID(), 'third_first_content', true);
            $title_second_third = get_post_meta(get_the_ID(), 'third_second_title', true);
            $content_second_third = get_post_meta(get_the_ID(), 'third_second_content', true);

            //Fourth
            $title_fourth = get_post_meta(get_the_ID(), 'title_fourth', true);
            $content_fourth = get_post_meta(get_the_ID(), 'content_fourth', true);
            $icons_fourth = get_post_meta(get_the_ID(), 'all_icons', true);
            $icons_json = json_decode($icons_fourth);

            $about = array(
                'titulo' => $title,
                'description' => $description,
                'first_section' => array(
                    'title' => $title_first,
                    'content' => $content_first
                ),
                'second_section' => array(
                    'title' => $title_second,
                    'content' => $content_second
                ),
                'third_section' => array(
                    'first_title' => $title_first_third,
                    'first_content' => $content_first_third,
                    'second_title' => $title_second_third,
                    'second_content' => $content_second_third,
                ),
                'fourth' =>  array(
                    'title' => $title_fourth,
                    'content' => $content_fourth,
                    'icons' => $icons_json
                )
            );

        }
        wp_reset_postdata();
    }

    // Devolvemos la respuesta JSON
    return new WP_REST_Response($about, 200);
}


function allow_svg_upload( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'allow_svg_upload' );

function allow_webp_upload( $mimes ) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter( 'upload_mimes', 'allow_webp_upload' );


// Add save file

include plugin_dir_path(__FILE__) . 'save.php';
