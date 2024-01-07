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
            $menu[$key][4] = 'home-item wp-has-submenu wp-not-current-submenu menu-top menu-icon-slider';
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


// Registramos la api del plugin
function api_home() {
    register_rest_route('wp/v2', 'home', array(
        'methods' => 'GET',
        'callback' => 'get_home',
    ));
}

add_action('rest_api_init', 'api_home');

function get_home($request) {
    // Creamos un array para almacenar las noticias
    $home = array(); 

    // Configuramos los argumentos de la consulta
    $args = array(
        'post_type' => 'home',
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
            $title_first = get_post_meta(get_the_ID(), 'title_first', true);
            $content_first = get_post_meta(get_the_ID(), 'first_content', true);
            $galery_first = get_post_meta(get_the_ID(), 'first_galery', true);
            $array_galery = json_decode($galery_first, true);
            $image_two = get_the_post_thumbnail();
            $title_second = get_post_meta(get_the_ID(), 'title_second', true);
            $content_second = get_post_meta(get_the_ID(), 'second_content', true);
            $titlebutton = get_post_meta(get_the_ID(), 'titlebutton_secont', true);
            $linkbutton = get_post_meta(get_the_ID(), 'buttonaction_secont', true);
            $externalbutton = get_post_meta(get_the_ID(), 'buttonexternal_secont', true);
            
            // Aquí puedes obtener los campos específicos que deseas incluir en la respuesta JSON
            $home = array(
                'titulo' => $title,
                'first_section' => array(
                    'title' =>  $title_first,
                    'content' => $content_first,
                    'galery' => $array_galery
                ),
                'second_section' => array(
                    'title' =>  $title_second,
                    'content' => $content_second,
                    'image' => $image_two,
                    'button' => array(
                        'title' => $titlebutton,
                        'link' => $linkbutton,
                        'external' => $externalbutton ? true : false
                    )
                ),
            );

        }
        wp_reset_postdata();
    }

    // Devolvemos la respuesta JSON
    return new WP_REST_Response($home, 200);
}


include plugin_dir_path(__FILE__) . 'save.php';