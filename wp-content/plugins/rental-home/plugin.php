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
        wp_enqueue_script('unabailable', plugins_url('assets/unabailable.js', __FILE__), ['jquery']);
    }

    error_log(print_r(get_current_screen(), true));
});

// All elements

// Registramos la api del plugin
function api_plugin_rental_home() {
    register_rest_route('wp/v2', 'rental-home', array(
        'methods' => 'GET',
        'callback' => 'get_rental_home',
    ));
}

add_action('rest_api_init', 'api_plugin_rental_home');

function get_rental_home($request) {
    // Creamos un array para almacenar las noticias
    $rental_home = array(); 

    // Configuramos los argumentos de la consulta
    $args = array(
        'post_type' => 'rental_home',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // Realizamos la consulta
    $rental_home_query = new WP_Query($args);

    // Verificamos si hay noticias en la consulta
    if ($rental_home_query->have_posts()) {
        while ($rental_home_query->have_posts()) {
            $rental_home_query->the_post();

            $title = get_the_title();

            // Characteristics
            $bathrooms = get_post_meta(get_the_ID(), 'bathrooms', true);
            $bedrooms = get_post_meta(get_the_ID(), 'bedrooms', true);
            $beds = get_post_meta(get_the_ID(), 'beds', true);
            $baths = get_post_meta(get_the_ID(), 'baths', true);
            $sq_ft = get_post_meta(get_the_ID(), 'sq_ft', true);

            // Imagen principal
            $main_image = get_the_post_thumbnail();

            // Arreglo de imagenes
            $all_images = get_post_meta(get_the_ID(), 'galery_input', true);
            $all_imagenes_array = json_decode($all_images, true);


            // Get slug
            $slug =  get_post_field('post_name', get_the_ID());
            
            
            // Aquí puedes obtener los campos específicos que deseas incluir en la respuesta JSON
            $rental = array(
                'titulo' => $title,
                'slug' => $slug,
                'characteristics' => array(
                    'bathrooms' => intval($bathrooms),
                    'bedrooms' => intval($bedrooms),
                    'beds' => intval($beds),
                    'baths' => intval($baths),
                    'sq_ft' => intval($sq_ft),
                ),
                'main_image' => $main_image,
                'allImages' => $all_imagenes_array,
            );

            // Agregamos la noticia al array de noticias
            $rental_home[] = $rental;
        }
        wp_reset_postdata();
    }

    // Devolvemos la respuesta JSON
    return new WP_REST_Response($rental_home, 200);
}


// Individual post


// Registramos la api del plugin
function api_plugin_rental_home_individual() {
    register_rest_route('wp/v2', 'rental-home/(?P<slug>[a-zA-Z0-9-]+)', array(
        'methods' => 'GET',
        'callback' => 'get_rental_home_individual',
    ));
}

add_action('rest_api_init', 'api_plugin_rental_home_individual');

function get_rental_home_individual($request) {
    // Creamos un array para almacenar las noticias
    $rental_home_individual = array(); 

    // Obtenemos el valor del slug de la URL
    $rental_home_slug = $request['slug'];

    // Configuramos los argumentos de la consulta
    $args = array(
        'post_type' => 'rental_home',
        'posts_per_page' => 1,
        'post_name' => 'casa-tres-monos',
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // Realizamos la consulta
    $rental_home_individual_query = new WP_Query($args);

    // Verificamos si hay noticias en la consulta
    if ($rental_home_individual_query->have_posts()) {



        while ($rental_home_individual_query->have_posts()) {
            $rental_home_individual_query->the_post();

            $title = get_the_title();
            $content = get_the_content();
            $comments = get_comments();

            // Characteristics
            $bathrooms = get_post_meta(get_the_ID(), 'bathrooms', true);
            $bedrooms = get_post_meta(get_the_ID(), 'bedrooms', true);
            $beds = get_post_meta(get_the_ID(), 'beds', true);
            $baths = get_post_meta(get_the_ID(), 'baths', true);
            $sq_ft = get_post_meta(get_the_ID(), 'sq_ft', true);

            // Imagen principal
            $main_image = get_the_post_thumbnail();

            // Arreglo de imagenes
            $all_images = get_post_meta(get_the_ID(), 'galery_input', true);
            $all_imagenes_array = json_decode($all_images, true);


            // Get slug
            $slug =  get_post_field('post_name', get_the_ID());

            // No disponible
            $unabailable = get_post_meta(get_the_ID(), 'dateInput', true);
            $unabailable_array = json_decode($unabailable, true);
            
            
            // Aquí puedes obtener los campos específicos que deseas incluir en la respuesta JSON
            $rental_home_individual = array(
                'titulo' => $title,
                'content' => $content,
                'characteristics' => array(
                    'bathrooms' => intval($bathrooms),
                    'bedrooms' => intval($bedrooms),
                    'beds' => intval($beds),
                    'baths' => intval($baths),
                    'sq_ft' => intval($sq_ft),
                ),
                'main_image' => $main_image,
                'allImages' => $all_imagenes_array,
                'comments' => $comments,
                'unabailable' => $unabailable_array
            );

        }
        wp_reset_postdata();
    }

    // Devolvemos la respuesta JSON
    return new WP_REST_Response($rental_home_individual, 200);
}


include plugin_dir_path(__FILE__) . 'save.php';