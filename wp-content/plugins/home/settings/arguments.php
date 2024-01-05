<?php

    // Add settings to plugin
    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'home'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' =>  array('title'),
        'menu_icon' => 'dashicons-admin-home',
        'show_in_rest' => true,
        'rest_base' => 'home',
        'rest_namespace' => 'home',
        'register_meta_box_cb' => function () {
            // All arguments
            include plugin_dir_path(__FILE__) . 'boxs/first_section.php';
        }
    );