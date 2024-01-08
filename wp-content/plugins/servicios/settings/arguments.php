<?php

    // Add settings to plugin
    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'services'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' =>  array( 'title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-insert',
        'show_in_rest' => false,
        'rest_base' => 'services',
        'rest_namespace' => 'services',
    );