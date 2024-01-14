<?php

    // Add settings to plugin
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'rental-home'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => null,
        'supports' =>  array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions'),
        'menu_icon' => 'dashicons-palmtree',
        'show_in_rest' => false,
        'rest_base' => 'rental_home',
        'rest_namespace' => 'rental_home',
        'register_meta_box_cb' => function () {
            // All arguments
            include plugin_dir_path(__FILE__) . 'boxs/images.php';
            include plugin_dir_path(__FILE__) . 'boxs/unavailable.php';
            include plugin_dir_path(__FILE__) . 'boxs/characteristics.php';
        }
    );