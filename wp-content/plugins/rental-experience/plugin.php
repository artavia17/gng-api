<?php

/*
* Plugin Name:       Resource Experience
* Plugin URI:        https://gngcr.com
* Description:       Resource Experience Administrador
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

    register_post_type('resource_experience', $args);

});


// Registramos la api del plugin
function api_plugin_experience() {
    register_rest_route('wp/v2', 'rental-experience', array(
        'methods' => 'GET',
        'callback' => 'get_experience',
    ));
}

add_action('rest_api_init', 'api_plugin_experience');

function get_experience($request) {
    // Creamos un array para almacenar las noticias
    $experiences = array(); 

    // Configuramos los argumentos de la consulta
    $args = array(
        'post_type' => 'resource_experience',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'ASC',
    );

    // Realizamos la consulta
    $experiences_query = new WP_Query($args);

    // Verificamos si hay noticias en la consulta
    if ($experiences_query->have_posts()) {
        while ($experiences_query->have_posts()) {
            $experiences_query->the_post();

            $title = get_the_title();
            $content = get_the_content();
            $image = get_the_post_thumbnail();
            
            // Aquí puedes obtener los campos específicos que deseas incluir en la respuesta JSON
            $experience = array(
                'titulo' => $title,
                'text' => $content,
                'icon' => $image
            );

            // Agregamos la noticia al array de noticias
            $experiences[] = $experience;
        }
        wp_reset_postdata();
    }

    // Devolvemos la respuesta JSON
    return new WP_REST_Response($experiences, 200);
}