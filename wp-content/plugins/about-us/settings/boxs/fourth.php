<?php
    add_meta_box(
        'fourth',
        'Fourth Section Config',
        function ($post) {

            $title_fourth = get_post_meta( $post->ID, 'title_fourth', true);
            $content_fourth = get_post_meta( $post->ID, 'content_fourth', true);
            

            ?>
            
            <section class="about">
                <section class="section_content">
                    <label for="title_fourth">Add Title</label>
                    <br/>
                    <input type="text" name="title_fourth" id="title_fourth" value="<?= $title_fourth ?>" placeholder="Write here...">                    
                </section>
                <section class="section_content">
                    <label for="content_fourth">Add Content</label>
                    <br/>
                    <section class="editor">
                        <?php
                            wp_editor($content_fourth, 'content_fourth', array('textarea_name' => 'content_fourth'));
                        ?>
                    </section>
                </section>
            </section>


            <?php

        },
        'about',
        'advanced',
        'high'
    );