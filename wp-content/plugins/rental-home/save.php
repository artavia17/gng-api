<?php

    // En este apartado guardamos todos los items de las noticias

    add_action('save_post', 'save_application_rental_home');

    function save_application_rental_home($post_id){

        if (!isset($_POST['post_type']) || $_POST['post_type'] !== 'rental_home') return $post_id;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    
        if (!current_user_can('edit_post', $post_id))  return $post_id;

        update_post_meta($post_id, 'galery_input', $_POST['galery_input']);

    }