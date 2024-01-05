<?php

    // En este apartado guardamos todos los items de las noticias

    add_action('save_post', 'save_application_home');

    function save_application_home($post_id){

        if (!isset($_POST['post_type']) || $_POST['post_type'] !== 'home') return $post_id;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    
        if (!current_user_can('edit_post', $post_id))  return $post_id;

        update_post_meta($post_id, 'title_first', $_POST['title_first']);
        update_post_meta($post_id, 'first_content', $_POST['first_content']);
        update_post_meta($post_id, 'first_galery', $_POST['first_galery']);

    }