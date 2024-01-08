<?php

    // En este apartado guardamos todos los items de las noticias

    add_action('save_post', 'save_application_about');

    function save_application_about($post_id){

        if (!isset($_POST['post_type']) || $_POST['post_type'] !== 'about') return $post_id;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    
        if (!current_user_can('edit_post', $post_id))  return $post_id;

        // First section

        update_post_meta($post_id, 'title_first', $_POST['title_first']);
        update_post_meta($post_id, 'content_first', $_POST['content_first']);

        // Second section

        update_post_meta($post_id, 'title_second', $_POST['title_second']);
        update_post_meta($post_id, 'content_second', $_POST['content_second']);

        // Third section

        update_post_meta($post_id, 'third_first_title', $_POST['third_first_title']);
        update_post_meta($post_id, 'third_first_content', $_POST['third_first_content']);
        update_post_meta($post_id, 'third_second_title', $_POST['third_second_title']);
        update_post_meta($post_id, 'third_second_content', $_POST['third_second_content']);

        // Fourth section

        update_post_meta($post_id, 'title_fourth', $_POST['title_fourth']);
        update_post_meta($post_id, 'content_fourth', $_POST['content_fourth']);
        update_post_meta($post_id, 'all_icons', $_POST['all_icons']);

    }

    