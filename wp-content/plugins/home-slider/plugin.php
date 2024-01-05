<?php

/*
* Plugin Name:       Home Slider
* Plugin URI:        https://gngcr.com
* Description:       Home Slider Administrador
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

    register_post_type('slider', $args);

});


// Registramos la api del plugin
function api_plugin() {
    register_rest_route('wp/v2', 'sliders', array(
        'methods' => 'GET',
        'callback' => 'get_sliders',
    ));
}

add_action('rest_api_init', 'api_plugin');

function get_sliders($request) {
    // Creamos un array para almacenar las noticias
    $sliders = array(); 

    // Configuramos los argumentos de la consulta
    $args = array(
        'post_type' => 'slider',
        'posts_per_page' => -1,
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
            $image = get_the_post_thumbnail();
            $titlebutton = get_post_meta(get_the_ID(), 'titlebutton', true);
            $linkbutton = get_post_meta(get_the_ID(), 'buttonaction', true);
            $externalbutton = get_post_meta(get_the_ID(), 'buttonexternal', true);
            
            // Aquí puedes obtener los campos específicos que deseas incluir en la respuesta JSON
            $slider = array(
                'titulo' => $title,
                'background' => $image,
                'button' => array(
                    'title' => $titlebutton,
                    'link' => $linkbutton,
                    'external' => $externalbutton ? true : false
                )
            );

            // Agregamos la noticia al array de noticias
            $sliders[] = $slider;
        }
        wp_reset_postdata();
    }

    // Devolvemos la respuesta JSON
    return new WP_REST_Response($sliders, 200);
}



include plugin_dir_path(__FILE__) . 'save.php';