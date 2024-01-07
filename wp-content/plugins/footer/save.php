<?php

    // En este apartado guardamos todos los items de las noticias

    add_action('save_post', 'save_application_footer');

    function save_application_footer($post_id){

        if (!isset($_POST['post_type']) || $_POST['post_type'] !== 'footer') return $post_id;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    
        if (!current_user_can('edit_post', $post_id))  return $post_id;

        update_post_meta($post_id, 'instagram', $_POST['instagram']);
        update_post_meta($post_id, 'address', $_POST['address']);
        update_post_meta($post_id, 'phone_numbers', $_POST['phone_numbers']);
        update_post_meta($post_id, 'email', $_POST['email']);
        update_post_meta($post_id, 'userinstagram', $_POST['userinstagram']);


    }