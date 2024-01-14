<?php

    // En este apartado guardamos todos los items de las noticias

    add_action('save_post', 'save_application_rental_home');

    function save_application_rental_home($post_id){

        if (!isset($_POST['post_type']) || $_POST['post_type'] !== 'rental_home') return $post_id;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    
        if (!current_user_can('edit_post', $post_id))  return $post_id;

        update_post_meta($post_id, 'galery_input', $_POST['galery_input']);
        update_post_meta($post_id, 'dateInput', $_POST['dateInput']);
        update_post_meta($post_id, 'bedrooms', $_POST['bedrooms']);
        update_post_meta($post_id, 'bathrooms', $_POST['bathrooms']);
        update_post_meta($post_id, 'beds', $_POST['beds']);
        update_post_meta($post_id, 'baths', $_POST['baths']);
        update_post_meta($post_id, 'sq_ft', $_POST['sq_ft']);
    }