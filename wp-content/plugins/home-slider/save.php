<?php

    // En este apartado guardamos todos los items de las noticias

    add_action('save_post', 'save_application_slider');

    function save_application_slider($post_id){

        if (!isset($_POST['post_type']) || $_POST['post_type'] !== 'slider') return $post_id;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    
        if (!current_user_can('edit_post', $post_id))  return $post_id;

        update_post_meta($post_id, 'titlebutton', $_POST['titlebutton']);
        update_post_meta($post_id, 'buttonaction', $_POST['buttonaction']);
        update_post_meta($post_id, 'buttonexternal', $_POST['buttonexternal']);

    }