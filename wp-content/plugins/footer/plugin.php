<?php

/*
* Plugin Name:       Footer
* Plugin URI:        https://gngcr.com
* Description:       Footer Administrador
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

    register_post_type('footer', $args);

});




// Asegurarse de que haya solo un único post de este tipo
add_action('wp_loaded', 'ensure_single_custom_footer');

function ensure_single_custom_footer() {
    $existing_footer = get_posts(array('post_type' => 'footer', 'posts_per_page' => 1));

    if (empty($existing_footer)) {
        $footer = array(
            'post_type' => 'footer',
            'post_title' => 'Footer Config',
            'post_status' => 'publish',
        );

        wp_insert_post($footer);


    }
}


// Ocultar la opción "Añadir Nuevo"
add_action('admin_menu', 'remove_add_footer');

function remove_add_footer() {
    
    global $menu;

    remove_submenu_page('edit.php?post_type=footer', 'post-new.php?post_type=footer');

    // Obtener el primer post del tipo 'Footer'
    $first_home_post = get_posts(array(
        'post_type'      => 'footer',
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
        if ($item[2] == 'edit.php?post_type=footer') {
            // Cambia el enlace del menú
            $menu[$key][2] = 'post.php?post=' . $first_post_id . '&action=edit';
            $menu[$key][4] = 'footer-item wp-has-submenu wp-not-current-submenu menu-top menu-icon-slider';
            break;
        }
    }

}


add_action('admin_enqueue_scripts', function () {
    $screen = get_current_screen();

    if ($screen->id === 'footer') {
        wp_enqueue_media();
        wp_enqueue_script('number_phone', plugins_url('assets/app.js', __FILE__), ['jquery']);
    }

    error_log(print_r(get_current_screen(), true));
});


// Registramos la api del plugin
function api_footer() {
    register_rest_route('wp/v2', 'footer', array(
        'methods' => 'GET',
        'callback' => 'get_footer_api',
    ));
}

add_action('rest_api_init', 'api_footer');

function get_footer_api($request) {
    // Creamos un array para almacenar las noticias
    $home = array(); 

    // Configuramos los argumentos de la consulta
    $args = array(
        'post_type' => 'footer',
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

            // Instagram
            $urlInstagram = get_post_meta( get_the_ID(), 'instagram', true);
            $userInstragram = get_post_meta( get_the_ID(), 'userinstagram', true);

            // Address
            $address = get_post_meta( get_the_ID(), 'address', true);

            // Email
            $email = get_post_meta( get_the_ID(), 'email', true);

            // Number
            $numbers = get_post_meta( get_the_ID(), 'phone_numbers', true);
            $numbers_array = json_decode($numbers, true);
            
            // Aquí puedes obtener los campos específicos que deseas incluir en la respuesta JSON
            $home = array(
                'titulo' => $title,
                'instagram' => array(
                    'url' => $urlInstagram,
                    'user' => $userInstragram
                ),
                'address' => $address,
                'email' => $email,
                'number' => $numbers_array
            );

        }
        wp_reset_postdata();
    }

    // Devolvemos la respuesta JSON
    return new WP_REST_Response($home, 200);
}


// Add save file

include plugin_dir_path(__FILE__) . 'save.php';
