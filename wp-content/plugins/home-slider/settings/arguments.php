<?php

    // Add settings to plugin
    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'slider'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' =>  array('title', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-home',
        'show_in_rest' => true,
        'rest_base' => 'sliders',
        'rest_namespace' => 'sliders',
        'register_meta_box_cb' => function () {
            // All arguments
            include plugin_dir_path(__FILE__) . 'boxs/button.php';
        }
    );