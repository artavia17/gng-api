<?php
    add_meta_box(
        'second',
        'Second Section Config',
        function ($post) {

            $title_second = get_post_meta( $post->ID, 'title_second', true);
            $content_second = get_post_meta( $post->ID, 'content_second', true);
            

            ?>
            
            <section class="about">
                <section class="section_content">
                    <label for="title_second">Add Title</label>
                    <br/>
                    <input type="text" name="title_second" id="title_second" value="<?= $title_second ?>" placeholder="Write here...">                    
                </section>
                <section class="section_content">
                    <label for="content_second">Add Content</label>
                    <br/>
                    <section class="editor">
                        <?php
                            wp_editor($content_second, 'content_second', array('textarea_name' => 'content_second'));
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