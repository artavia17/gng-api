<?php

    // Add settings to plugin
    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'resource_experience'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' =>  array( 'title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-admin-multisite',
        'show_in_rest' => false,
        'rest_base' => 'resource_experience',
        'rest_namespace' => 'resource_experience',
    );