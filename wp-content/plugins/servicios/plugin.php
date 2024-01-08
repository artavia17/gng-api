<?php

/*
* Plugin Name:       Our Services
* Plugin URI:        https://gngcr.com
* Description:       Our Services Administrador
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

    register_post_type('services', $args);

});


// Registramos la api del plugin
function api_plugin_services() {
    register_rest_route('wp/v2', 'services', array(
        'methods' => 'GET',
        'callback' => 'get_services',
    ));
}

add_action('rest_api_init', 'api_plugin_services');

function get_services($request) {
    // Creamos un array para almacenar las noticias
    $services = array(); 

    // Configuramos los argumentos de la consulta
    $args = array(
        'post_type' => 'services',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // Realizamos la consulta
    $services_query = new WP_Query($args);

    // Verificamos si hay noticias en la consulta
    if ($services_query->have_posts()) {
        while ($services_query->have_posts()) {
            $services_query->the_post();

            $title = get_the_title();
            $content = get_the_content();
            $image = get_the_post_thumbnail();
            
            // Aquí puedes obtener los campos específicos que deseas incluir en la respuesta JSON
            $service = array(
                'titulo' => $title,
                'content' => $content,
                'image' => $image
            );

            // Agregamos la noticia al array de noticias
            $services[] = $service;
        }
        wp_reset_postdata();
    }

    // Devolvemos la respuesta JSON
    return new WP_REST_Response($services, 200);
}